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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        //dd($remesa);
        Cuota::insert($remesa);
        return view('cuotas.cuotasRemesaAgregada');
    }
}
