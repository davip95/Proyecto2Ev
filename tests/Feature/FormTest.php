<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormTest extends TestCase
{
    public function test_cliente_store()
    {
        $usuario = User::where('tipo', 'administrador')->first();

        $response = $this->actingAs($usuario)
            ->post('cliente', [
                'nombre' => 'Pepito',
                'correo' => 'pepito@gmail.com',
                'pais' => 'ESP',
                'cif' => 'W4968350A',
                'telefono' => '665668662',
                'cuentacorriente' => 'ES5500789921495485331132',
                'importemensual' => '169.65',
            ]);

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }

        $response->assertViewIs('clientes.clienteVerDetalles');
        $response->assertViewHas('cliente');
    }
}
