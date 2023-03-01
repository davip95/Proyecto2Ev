<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cuota;
use App\Models\Pais;
use Illuminate\Http\Request;

class ClientesCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::orderByDesc('pais')->paginate(4);
        // Para cada cliente, busco el nombre del pais y de la moneda para mostrarlos en lugar de la nomenclatura ISO
        foreach ($clientes as $cliente) {
            $cliente->pais = Pais::select('nombre')->where('iso3', $cliente['pais'])->first()->nombre;
            // Compruebo si el pais del cliente tiene moneda para que en ese caso, se muestre el nombre de la moneda
            if ($cliente->moneda != '-')
                $cliente->moneda = Pais::select('nombre_moneda')->where('iso_moneda', $cliente['moneda'])->first()->nombre_moneda;
        }
        return view('clientes.clientesVer', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Pais::select('iso3', 'nombre', 'iso_moneda', 'nombre_moneda')->where('iso_moneda', '!=', null)->orderBy('nombre')->get();
        return view('clientes.clienteCrear', compact('paises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'max:45'],
            'correo' => ['required', 'max:45', 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/'],
            'pais' => ['required', 'max:3'],
            'cif' => ['required', 'max:45', 'regex:/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/'],
            'telefono' => ['required', 'max:45', 'regex:/(\+34|0034|34)?[ -]*(6|7|8|9)[ -]*([0-9][ -]*){8}/'],
            'cuentacorriente' => ['required', 'max:45', 'regex:/^([A-Z]{2}[ \-]?[0-9]{2})(?=(?:[ \-]?[A-Z0-9]){9,30}$)((?:[ \-]?[A-Z0-9]{3,5}){2,7})([ \-]?[A-Z0-9]{1,3})?$/'],
            'importemensual' => ['required', 'between:0.01,99999.99'],
        ]);
        // Almaceno la moneda del pais seleccionado para guardar su iso3 en la bd
        $moneda = Pais::select('iso_moneda')->where('iso3', $datos['pais'])->first();
        // Compruebo si el pais no tiene moneda y le asigno el valor '-' para indicar que no tiene
        // if ($moneda->iso_moneda == null)
        //     $moneda->iso_moneda = '-';
        $datos['moneda'] = $moneda->iso_moneda;
        $cliente = Cliente::create($datos);
        return view('clientes.clienteVerDetalles', compact('cliente'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        $cliente->pais = Pais::select('nombre')->where('iso3', $cliente['pais'])->first()->nombre;
        // Compruebo si el pais del cliente tiene moneda para que en ese caso, se muestre el nombre de la moneda
        if ($cliente->moneda != '-')
            $cliente->moneda = Pais::select('nombre_moneda')->where('iso_moneda', $cliente['moneda'])->first()->nombre_moneda;
        return view('clientes.clienteVerDetalles', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        $paises = Pais::select('iso3', 'nombre', 'iso_moneda', 'nombre_moneda')->where('iso_moneda', '!=', null)->orderBy('nombre')->get();
        return view('clientes.clienteModificar', compact('cliente', 'paises'));
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
        $datos = $request->validate([
            'nombre' => ['required', 'max:45'],
            'correo' => ['required', 'max:45', 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/'],
            'pais' => ['required', 'max:3'],
            'cif' => ['required', 'max:45', 'regex:/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/'],
            'telefono' => ['required', 'max:45', 'regex:/(\+34|0034|34)?[ -]*(6|7|8|9)[ -]*([0-9][ -]*){8}/'],
            'cuentacorriente' => ['required', 'max:45', 'regex:/^([A-Z]{2}[ \-]?[0-9]{2})(?=(?:[ \-]?[A-Z0-9]){9,30}$)((?:[ \-]?[A-Z0-9]{3,5}){2,7})([ \-]?[A-Z0-9]{1,3})?$/'],
            'importemensual' => ['required', 'between:0,99999.99'],
        ]);
        // Almaceno la moneda del pais seleccionado para guardar su iso3 en la bd
        $moneda = Pais::select('iso_moneda')->where('iso3', $datos['pais'])->first();
        // Compruebo si el pais no tiene moneda y le asigno el valor '-' para indicar que no tiene
        // if ($moneda->iso_moneda == null)
        //     $moneda->iso_moneda = '-';
        $datos['moneda'] = $moneda->iso_moneda;
        Cliente::find($id)->update($datos);
        return $this->show($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cuotas = Cuota::select()->where('clientes_id', $id)->get();
        foreach ($cuotas as $cuota) {
            $cuota->delete();
        }
        $cliente->delete();
        return view('clientes.clienteEliminado', ['id' => $id]);
    }

    public function confirmarBorrado($id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.clienteEliminar', compact('cliente'));
    }
}
