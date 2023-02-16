<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Cuota;
use Carbon\Carbon;

class CuotasCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->action([AuthenticatedSessionController::class, 'destroy']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->action([AuthenticatedSessionController::class, 'destroy']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->action([AuthenticatedSessionController::class, 'destroy']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->action([AuthenticatedSessionController::class, 'destroy']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clientes = Cliente::select('id', 'nombre')->get();
        $cuota = Cuota::find($id);
        return view('cuotas.cuotaCorregir', compact('clientes', 'cuota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pagada = $request->pagada;
        $fechapago = $request->fechapago;
        $datos = $request->validate([
            'concepto' => ['required', 'max:45'],
            'fechaemision' => ['required', 'date_format:Y-m-d\TH:i'],
            'pagada' => [
                'required', 'boolean',
                function ($attribute, $value, $fail) use ($fechapago) {
                    if ($value == '1' && $fechapago == null) {
                        $fail('No puede marcar la cuota pagada sin una fecha de pago.');
                    }
                }
            ],
            'fechapago' => [
                'nullable', 'date_format:Y-m-d\TH:i',
                function ($attribute, $value, $fail) use ($pagada) {
                    if ($value != null && $pagada == '0') {
                        $fail('Para introducir una fecha de pago la cuota se debe marcar como pagada (Sí).');
                    }
                }
            ],
            'importe' => ['required', 'between:0,99999.99'],
            'notas' => ['nullable', 'max:200'],
            'clientes_id' => ['required']
        ]);
        $cuota = Cuota::find($id);
        $cuota->update($datos);
        return $this->listarCuotasCliente($cuota->clientes_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cuota = Cuota::find($id);
        $cuota->delete();
        return view('cuotas.cuotaEliminada', ['id' => $id]);
    }

    public function crearRemesa()
    {
        $clientes = Cliente::select('id', 'nombre', 'importemensual', 'moneda')->paginate(4);
        return view('cuotas.cuotasCrearRemesa', compact('clientes'));
    }

    public function agregarRemesa(Request $request)
    {
        // Inicializo el array de remesa que incluirá arrays de datos de la cuota mensual de cada cliente
        $remesa = [];
        // Obtengo el mes y el año para ponerlo junto al id del cliente como concepto de la cuota
        $fecha = Carbon::now()->format("F/Y");
        $notas = $request->validate([
            'notas' => ['nullable', 'max:200'],
        ]);
        $clientes = Cliente::select('id', 'nombre', 'importemensual')->get();
        foreach ($clientes as $cliente) {
            $datos['concepto'] = $cliente->id . "_" . $fecha;
            $datos['fechaemision'] = Carbon::now()->format("Y-m-d\TH:i");
            $datos['importe'] = $cliente->importemensual;
            $datos['pagada'] = false;
            $datos['notas'] = $notas['notas'];
            $datos['clientes_id'] = $cliente->id;
            array_push($remesa, $datos);
        }
        Cuota::insert($remesa);
        return view('cuotas.cuotasRemesaAgregada');
    }

    public function confirmarBorrado($id)
    {
        $cuota = Cuota::find($id);
        return view('cuotas.cuotaEliminar', compact('cuota'));
    }

    public function listarCuotasCliente($id)
    {
        $cliente = Cliente::find($id);
        $cuotas = Cuota::select()->where('clientes_id', $id)->orderBy('fechaemision')->paginate(4);
        return view('cuotas.cuotasClienteVer', compact('cliente', 'cuotas'));
    }

    public function listarCuotasPendientes($id)
    {
        $cliente = Cliente::find($id);
        $cuotas = Cuota::select()->where('clientes_id', $id)->where('pagada', 0)->orderBy('fechaemision')->paginate(4);
        return view('cuotas.cuotasClientePendientes', compact('cliente', 'cuotas'));
    }

    public function crearCuota($id)
    {
        $cliente = Cliente::find($id);
        return view('cuotas.cuotaCrear', compact('cliente'));
    }

    public function agregarCuota(Request $request, $id)
    {
        $datos = $request->validate([
            'concepto' => ['required', 'max:45'],
            'importe' => ['required', 'between:0,99999.99'],
            'notas' => ['nullable', 'max:200'],
        ]);
        $datos['fechaemision'] = Carbon::now()->format("Y-m-d\TH:i");
        $datos['pagada'] = false;
        $datos['clientes_id'] = $id;
        Cuota::insert($datos);
        return $this->listarCuotasCliente($id);
    }
}
