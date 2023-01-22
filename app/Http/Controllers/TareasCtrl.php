<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Provincia;
use App\Models\Cliente;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareasCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareas = Tarea::orderByDesc('fechacreacion')->get();
        return view('tareas.tareasVer', compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $operarios = User::select('id', 'name')->where('tipo', '=', 'operario')->get();
        $provincias = Provincia::select('nombre')->get();
        $clientes = Cliente::select('id', 'nombre')->get();
        return view('tareas.tareaCrear', compact('operarios', 'provincias', 'clientes'));
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
            'clientes_id' => ['required', 'max:45'],
            'nombre' => ['required', 'max:45'],
            'apellidos' => ['required', 'max:45'],
            'telefono' => ['required', 'max:45', 'regex:/(\+34|0034|34)?[ -]*(6|7|8|9)[ -]*([0-9][ -]*){8}/'],
            'descripcion' => ['required', 'max:100'],
            'correo' => ['required', 'max:100', 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/'],
            'direccion' => ['required', 'max:100'],
            'poblacion' => ['required', 'max:45'],
            'codpostal' => ['required', 'max:45', 'regex:/^(?:0[1-9]|[1-4]\d|5[0-2])\d{3}$/'],
            'provincia' => ['required', 'max:45'],
            'estado' => ['required', 'max:45'],
            'users_id' => ['required', 'max:45'],
            'fechacreacion' => ['required', 'max:45', 'date_equals:today'],
            'fechafin' => ['nullable', 'exclude_unless:estado,R', 'after:fechacracion'],
            'anotaantes' => ['nullable', 'max:100'],
            'anotapost' => ['nullable', 'max:100'],
        ]);
        // Guardo la fecha de creacion en formato fecha y hora para el datetime de la base de datos
        $datos['fechacreacion'] = date("Y-m-d H:i:s");
        $tarea = Tarea::create($datos);
        return redirect()->route('tarea.index');
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
}
