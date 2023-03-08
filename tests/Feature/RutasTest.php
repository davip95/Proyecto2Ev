<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Cuota;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RutasTest extends TestCase
{
    public function test_home()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_login()
    {
        $response = $this->get('/login');
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('auth.login');
    }

    public function test_logout()
    {
        $usuario = User::first();
        $response = $this->actingAs($usuario)
            ->get('logout');
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('auth.login');
    }

    public function test_forgot_password()
    {
        $response = $this->get('forgot-password');
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('auth.forgot-password');
    }

    public function test_tarea()
    {
        $usuario = User::first();
        $response = $this->actingAs($usuario)
            ->get('/tarea');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('tareas.tareasVer');
        $response->assertViewHas('tareas');
    }

    public function test_incidencia()
    {
        $response = $this->get('/tarea/crearIncidencia');
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('tareas.tareaCrearIncidencia');
    }

    public function test_tarea_create()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $response = $this->actingAs($usuario)
            ->get('/tarea/create');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('tareas.tareaCrear');
    }

    public function test_ver_incidencias()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $response = $this->actingAs($usuario)
            ->get('tarea/incidencias');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('tareas.tareasVerIncidencias');
        $response->assertViewHas('incidencias');
    }

    public function test_pendientes()
    {
        $usuario = User::first();
        $response = $this->actingAs($usuario)
            ->get('tarea/pendientes');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('tareas.tareasVerPendientes');
        $response->assertViewHas('tareas');
    }

    public function test_tarea_borrado()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $tarea = Tarea::first()->id;
        $response = $this->actingAs($usuario)
            ->get('tarea/' . $tarea . '/borrado');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('tareas.tareaEliminar');
        $response->assertViewHas('tarea');
    }

    public function test_tarea_cambiar()
    {
        $usuario = User::where('tipo', 'operario')->first();
        $tarea = Tarea::where('estado', 'P')->first()->id;
        $response = $this->actingAs($usuario)
            ->get('tarea/' . $tarea . '/cambiarEstado');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('tareas.tareaCompletar');
        $response->assertViewHas('tarea');
    }

    public function test_tarea_completar()
    {
        $usuario = User::where('tipo', 'operario')->first();
        $tarea = Tarea::where('estado', 'P')->first()->id;
        $response = $this->actingAs($usuario)
            ->get('tarea/' . $tarea . '/completar');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('tareas.tareasVer');
        $response->assertViewHas('tareas');
    }

    public function test_tarea_ver()
    {
        $usuario = User::where('tipo', 'operario')->first();
        $tarea = Tarea::first()->id;
        $response = $this->actingAs($usuario)
            ->get('tarea/' . $tarea);

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('tareas.tareaVerDetalles');
        $response->assertViewHas('tarea');
    }

    public function test_tarea_editar()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $tarea = Tarea::first()->id;
        $response = $this->actingAs($usuario)
            ->get('tarea/' . $tarea . '/edit');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('tareas.tareaModificar');
        $response->assertViewHas('tarea');
    }

    public function test_cliente()
    {
        $usuario = User::first();
        $response = $this->actingAs($usuario)
            ->get('/cliente');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('clientes.clientesVer');
        $response->assertViewHas('clientes');
    }

    public function test_cliente_create()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $response = $this->actingAs($usuario)
            ->get('/cliente/create');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('clientes.clienteCrear');
    }

    public function test_cliente_ver()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $cliente = Cliente::first()->id;
        $response = $this->actingAs($usuario)
            ->get('cliente/' . $cliente);

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('clientes.clienteVerDetalles');
        $response->assertViewHas('cliente');
    }

    public function test_cliente_editar()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $cliente = Cliente::first()->id;
        $response = $this->actingAs($usuario)
            ->get('cliente/' . $cliente . '/edit');


        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('clientes.clienteModificar');
        $response->assertViewHas('cliente');
    }

    public function test_cliente_borrado()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $cliente = Cliente::first()->id;
        $response = $this->actingAs($usuario)
            ->get('cliente/' . $cliente . '/borrado');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('clientes.clienteEliminar');
        $response->assertViewHas('cliente');
    }

    public function test_cuota()
    {
        $usuario = User::first();
        $response = $this->actingAs($usuario)
            ->get('cuota');
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('auth.login');
    }

    public function test_remesa()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $response = $this->actingAs($usuario)
            ->get('/cuota/creaRemesa');
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('cuotas.cuotasCrearRemesa');
        $response->assertViewHas('clientes');
    }

    public function test_cuota_create()
    {
        $usuario = User::first();
        $response = $this->actingAs($usuario)
            ->get('cuota/create');
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('auth.login');
    }

    public function test_cuotas_listar_clientes()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $cliente = Cliente::first()->id;
        $response = $this->actingAs($usuario)
            ->get('cuota/' . $cliente . '/listar');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('cuotas.cuotasClienteVer');
        $response->assertViewHas('cuotas');
        $response->assertViewHas('cliente');
    }

    public function test_cuota_crear()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $cliente = Cliente::first()->id;
        $response = $this->actingAs($usuario)
            ->get('cuota/' . $cliente . '/crearCuota');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('cuotas.cuotaCrear');
        $response->assertViewHas('cliente');
    }

    public function test_cuota_see()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $cliente = Cliente::find(32)->id;
        $response = $this->actingAs($usuario)
            ->get('cuota/' . $cliente . '/crearCuota');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertSee('Añadir cuota a ');
    }

    public function test_cuota_show()
    {
        $usuario = User::first();
        $response = $this->actingAs($usuario)
            ->get('cuota/1');
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('auth.login');
    }

    public function test_cuota_editar()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $cuota = Cuota::first()->id;
        $response = $this->actingAs($usuario)
            ->get('cuota/' . $cuota . '/edit');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('cuotas.cuotaCorregir');
        $response->assertViewHas('cuota');
    }

    public function test_cuota_borrar()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $cuota = Cuota::first()->id;
        $response = $this->actingAs($usuario)
            ->get('cuota/' . $cuota . '/borrado');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('cuotas.cuotaEliminar');
        $response->assertViewHas('cuota');
    }

    public function test_cuotas_listar_pendientes()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $cliente = Cliente::first()->id;
        $response = $this->actingAs($usuario)
            ->get('cuota/' . $cliente . '/pendientes');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('cuotas.cuotasClientePendientes');
        $response->assertViewHas('cuotas');
        $response->assertViewHas('cliente');
    }

    public function test_usuario()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $response = $this->actingAs($usuario)
            ->get('/usuario');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('usuarios.usuariosVer');
        $response->assertViewHas('usuarios');
    }

    public function test_usuario_create()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $response = $this->actingAs($usuario)
            ->get('/usuario/create');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('usuarios.usuarioCrear');
    }

    public function test_usuario_borrado()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $us = User::where('tipo', 'operario')->first()->id;
        $response = $this->actingAs($usuario)
            ->get('usuario/' . $us . '/borrado');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('usuarios.usuarioEliminar');
        $response->assertViewHas('usuario');
    }

    public function test_usuario_ver()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $us = User::where('tipo', 'operario')->first()->id;
        $response = $this->actingAs($usuario)
            ->get('usuario/' . $us);

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('usuarios.usuarioVerDetalles');
        $response->assertViewHas('usuario');
    }

    public function test_usuario_editar()
    {
        $usuario = User::where('tipo', 'administrador')->first();
        $us = User::where('tipo', 'operario')->first()->id;
        $response = $this->actingAs($usuario)
            ->get('usuario/' . $us . '/edit');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
        $response->assertViewIs('usuarios.usuarioModificar');
        $response->assertViewHas('usuario');
    }
}
