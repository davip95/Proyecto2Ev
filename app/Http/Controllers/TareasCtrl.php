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
        $tareas = Tarea::orderByDesc('fechacreacion')->paginate(4);
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
        $fechaCreacion = $request->fechacreacion;
        $estado = $request->estado;
        $fechaFin = $request->fechafin;
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
            'estado' => [
                'required', 'max:45',
                function ($attribute, $value, $fail) use ($fechaFin) {
                    if ($value == 'R' && $fechaFin == null) {
                        $fail('No puede marcar la tarea Realizada (R) sin una fecha de realización.');
                    }
                }
            ],
            'users_id' => ['required', 'max:45'],
            'fechacreacion' => [
                'required', 'date_format:Y-m-d\TH:i',
                function ($attribute, $value, $fail) {
                    if ($value != date("Y-m-d\TH:i")) {
                        $fail('La fecha de creación no se puede modificar.');
                    }
                },
            ],
            'fechafin' => [
                'nullable', 'date_format:Y-m-d\TH:i',
                function ($attribute, $value, $fail) use ($fechaCreacion, $estado) {
                    if ($value <= $fechaCreacion) {
                        $fail('La fecha de realización debe ser posterior a la de creación.');
                    }
                    if ($value != null && $estado != 'R') {
                        $fail('Para introducir una fecha de realización el estado debe ser Realizada (R).');
                    }
                }
            ],
            'anotaantes' => ['nullable', 'max:100'],
            'anotapost' => ['nullable', 'max:100'],
        ]);
        $tarea = Tarea::create($datos);
        return view('tareas.tareaVerDetalles', compact('tarea'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tarea = Tarea::find($id);
        return view('tareas.tareaVerDetalles', compact('tarea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarea = Tarea::find($id);
        $operarios = User::select('id', 'name')->where('tipo', '=', 'operario')->get();
        $provincias = Provincia::select('nombre')->get();
        $clientes = Cliente::select('id', 'nombre')->get();
        return view('tareas.tareaModificar', compact('tarea', 'operarios', 'provincias', 'clientes'));
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
        $fechaCreacion = Tarea::find($id)->fechacreacion;
        $fechaFin = $request->fechafin;
        $estado = $request->estado;
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
            'estado' => [
                'required', 'max:45',
                function ($attribute, $value, $fail) use ($fechaFin) {
                    if ($value == 'R' && $fechaFin == null) {
                        $fail('No puede marcar la tarea Realizada (R) sin una fecha de realización.');
                    }
                }
            ],
            'users_id' => ['required', 'max:45'],
            'fechacreacion' => ['required', 'max:45', function ($attribute, $value, $fail) use ($fechaCreacion) {
                if ($value != $fechaCreacion) {
                    $fail('La fecha de creación no se puede modificar.');
                }
            }],
            'fechafin' => [
                'nullable', 'date_format:Y-m-d\TH:i',
                function ($attribute, $value, $fail) use ($fechaCreacion, $estado) {
                    if ($value <= $fechaCreacion) {
                        $fail('La fecha de realización debe ser posterior a la de creación.');
                    }
                    if ($value != null && $estado != 'R') {
                        $fail('Para introducir una fecha de realización el estado debe ser Realizada (R).');
                    }
                }
            ],
            'anotaantes' => ['nullable', 'max:100'],
            'anotapost' => ['nullable', 'max:100'],
        ]);
        Tarea::find($id)->update($datos);
        $tarea = Tarea::find($id);
        return view('tareas.tareaVerDetalles', compact('tarea'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // SOLO CON SOFTDELETE
    }

    public function verPendientes()
    {
        $tareas = Tarea::where('estado', '=', 'P')->paginate(4);
        return view('tareas.tareasVerPendientes', compact('tareas'));
    }

    public function confirmarBorrado($id)
    {
        $tarea = Tarea::find($id);
        return view('tareas.tareaEliminar', compact('tarea'));
    }

    public function borrar($id)
    {
        $tarea = Tarea::find($id);
        $tarea->delete();
        return view('tareas.tareaEliminada', compact('id'));
    }

    public function cambiarEstado($id)
    {
        $tarea = Tarea::find($id);
        return view('tareas.tareaCompletar', compact('tarea'));
    }

    public function completar(Request $request, $id)
    {
        $tarea = Tarea::find($id);
        $fechaCreacion = $tarea->fechacreacion;
        $datos = $request->validate([
            'estado' => [
                'required', 'max:45',
                function ($attribute, $value, $fail) {
                    if ($value != 'R') {
                        $fail('Para completar la tarea el estado debe ser Realizada (R).');
                    }
                },
            ],
            'fechafin' => [
                'required', 'date_format:Y-m-d\TH:i',
                function ($attribute, $value, $fail) use ($fechaCreacion) {
                    if ($value <= $fechaCreacion) {
                        $fail('La fecha de realización debe ser posterior a la de creación.');
                    }
                }
            ],
            'anotaantes' => ['nullable', 'max:100'],
            'anotapost' => ['nullable', 'max:100'],
        ]);
        $tarea->update($datos);
        return view('tareas.tareaVerDetalles', compact('tarea'));
    }
}
