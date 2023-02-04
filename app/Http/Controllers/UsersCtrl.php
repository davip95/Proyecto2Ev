<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::orderByDesc('fechaalta')->paginate(4);
        return view('usuarios.usuariosVer', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.usuarioCrear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        // Almaceno la fecha del momento de creación del usuario para mostrarla como fecha de alta
        $datos['fechaalta'] = date("Y-m-d\TH:i");
        // Elimino el campo passrep del array de datos ya que no es necesario insertarlo en la base de datos
        unset($datos['passrep']);
        $usuario = User::create($datos);
        return view('usuarios.usuarioVerDetalles', compact('usuario'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);
        return view('usuarios.usuarioVerDetalles', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        return view('usuarios.usuarioModificar', compact('usuario'));
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
            'fechaalta' => ['required', 'date_format:Y-m-d\TH:i'],
            'tipo' => ['required', 'max:45'],
        ]);
        User::find($id)->update($datos);
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
        $usuario = User::find($id);
        $usuario->delete();
        return view('usuarios.usuarioEliminado', ['id' => $id]);
    }

    public function confirmarBorrado($id)
    {
        $usuario = User::find($id);
        return view('usuarios.usuarioEliminar', compact('usuario'));
    }
}
