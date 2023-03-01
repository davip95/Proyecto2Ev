<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Tarea;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->tipo == 'administrador') {
            $usuarios = User::orderByDesc('fechaalta')->paginate(4);
            return view('usuarios.usuariosVer', compact('usuarios'));
        } else
            return redirect()->action([AuthenticatedSessionController::class, 'destroy']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->tipo == 'administrador') {
            return view('usuarios.usuarioCrear');
        } else
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
        if (Auth::user()->tipo == 'administrador') {
            // Almaceno la contraseña para comprobar que coincide con su repeticion en la validacion
            $pass = $request->password;
            $datos = $request->validate([
                'name' => ['required', 'max:255', 'alpha_num'],
                'email' => ['required', 'max:255', 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/'],
                'password' => ['required', 'max:255'],
                'passrep' => [
                    'required', 'max:255',
                    function ($attribute, $value, $fail) use ($pass) {
                        if ($value != $pass) {
                            $fail('Las contraseñas no coinciden.');
                        }
                    }
                ],
                'dni' => ['required', 'max:45', 'regex:/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/'],
                'telefono' => ['required', 'max:45', 'regex:/(\+34|0034|34)?[ -]*(6|7|8|9)[ -]*([0-9][ -]*){8}/'],
                'direccion' => ['required', 'max:45'],
                'tipo' => ['required', 'max:45'],
            ]);
            // Encripto la contraseña para poder utilizar el login de Breeze
            $datos['password'] = Hash::make($request->password);
            // Almaceno la fecha del momento de creación del usuario para mostrarla como fecha de alta
            $datos['fechaalta'] = date("Y-m-d\TH:i");
            // Elimino el campo passrep del array de datos ya que no es necesario insertarlo en la base de datos
            unset($datos['passrep']);
            $usuario = User::create($datos);
            return view('usuarios.usuarioVerDetalles', compact('usuario'));
        } else
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
        if (Auth::user()->tipo == 'administrador' || $id == Auth::user()->id) {
            $usuario = User::find($id);
            return view('usuarios.usuarioVerDetalles', compact('usuario'));
        } else
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
        if (Auth::user()->tipo == 'administrador' || $id == Auth::user()->id) {
            $usuario = User::find($id);
            return view('usuarios.usuarioModificar', compact('usuario'));
        } else
            return redirect()->action([AuthenticatedSessionController::class, 'destroy']);
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
        if (Auth::user()->tipo == 'administrador' || $id == Auth::user()->id) {
            // Almaceno la contraseña para comprobar que coincide con su repeticion en la validacion
            $pass = $request->password;
            if (Auth::user()->tipo == 'administrador') {
                $datos = $request->validate([
                    'name' => ['required', 'max:255', 'alpha_num'],
                    'email' => ['required', 'max:255', 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/'],
                    'password' => ['required', 'max:255'],
                    'passrep' => [
                        'required', 'max:255',
                        function ($attribute, $value, $fail) use ($pass) {
                            if ($value != $pass) {
                                $fail('Las contraseñas no coinciden.');
                            }
                        }
                    ],
                    'dni' => ['required', 'max:45', 'regex:/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/'],
                    'telefono' => ['required', 'max:45', 'regex:/(\+34|0034|34)?[ -]*(6|7|8|9)[ -]*([0-9][ -]*){8}/'],
                    'direccion' => ['required', 'max:45'],
                    'fechaalta' => ['required', 'date_format:Y-m-d\TH:i'],
                    'tipo' => ['required', 'max:45'],
                ]);
            } else {
                $datos = $request->validate([
                    'name' => ['required', 'max:255', 'alpha_num'],
                    'email' => ['required', 'max:255', 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/'],
                    'password' => ['required', 'max:255'],
                    'passrep' => [
                        'required', 'max:255',
                        function ($attribute, $value, $fail) use ($pass) {
                            if ($value != $pass) {
                                $fail('Las contraseñas no coinciden.');
                            }
                        }
                    ],
                    'dni' => ['required', 'max:45', 'regex:/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/'],
                    'telefono' => ['required', 'max:45', 'regex:/(\+34|0034|34)?[ -]*(6|7|8|9)[ -]*([0-9][ -]*){8}/'],
                    'direccion' => ['required', 'max:45'],
                    'fechaalta' => ['required', 'date_format:Y-m-d\TH:i'],
                ]);
            }
            $datos['password'] = Hash::make($datos['password']);
            User::find($id)->update($datos);
            return $this->show($id);
        } else
            return redirect()->action([AuthenticatedSessionController::class, 'destroy']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->tipo == 'administrador') {
            // Borro primero el usuario asignado en todas sus tareas
            $usuario = User::find($id);
            $tareas = Tarea::select()->where('users_id', $id)->get();
            foreach ($tareas as $tarea) {
                $tarea->update(['users_id' => null]);
            }
            $usuario->delete();
            return view('usuarios.usuarioEliminado', ['id' => $id]);
        } else
            return redirect()->action([AuthenticatedSessionController::class, 'destroy']);
    }

    public function confirmarBorrado($id)
    {
        if (Auth::user()->tipo == 'administrador') {
            $usuario = User::find($id);
            return view('usuarios.usuarioEliminar', compact('usuario'));
        } else
            return redirect()->action([AuthenticatedSessionController::class, 'destroy']);
    }
}
