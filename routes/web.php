<?php

use App\Http\Controllers\TareasCtrl;
use App\Http\Controllers\UsersCtrl;
use App\Http\Controllers\ClientesCtrl;
use App\Http\Controllers\CuotasCtrl;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('plantilla');
});


Route::controller(TareasCtrl::class)->group(function () {
    Route::get('/tarea/pendientes', 'verPendientes')->name('tarea.pendientes');
    Route::get('/tarea/{id}/borrado', 'confirmarBorrado')->name('tarea.confirmarBorrado');
    Route::get('/tarea/{id}/cambiarEstado', 'cambiarEstado')->name('tarea.cambiarEstado');
    Route::put('/tarea/{id}/completar', 'completar')->name('tarea.completar');
    // Con la siguiente ruta compruebo si trata de acceder a la url manualmente sin pasar por el formulario de confirmacion de completado
    // Si lo intenta, redirige al listado de tareas
    Route::get('/tarea/{id}/completar', 'index')->name('tarea.completar');
});
Route::resource('tarea', TareasCtrl::class);

Route::controller(UsersCtrl::class)->group(function () {
    Route::get('/usuario/{id}/borrado', 'confirmarBorrado')->name('usuario.confirmarBorrado');
});
Route::resource('usuario', UsersCtrl::class);

Route::controller(ClientesCtrl::class)->group(function () {
    Route::get('/cliente/{id}/borrado', 'confirmarBorrado')->name('cliente.confirmarBorrado');
});
Route::resource('cliente', ClientesCtrl::class);

Route::controller(CuotasCtrl::class)->group(function () {
    Route::get('/cuota/creaRemesa', 'crearRemesa')->name('cuota.crearRemesa');
    Route::post('/cuota/agregaRemesa', 'agregarRemesa')->name('cuota.agregarRemesa');
    Route::get('/cuota/{id}/borrado', 'confirmarBorrado')->name('cuota.confirmarBorrado');
    Route::get('/cuota/{id}/listar', 'listarCuotasCliente')->name('cuota.listarCuotasCliente');
    Route::get('/cuota/{id}/crearCuota', 'crearCuota')->name('cuota.crearCuota');
    Route::post('/cuota/{id}/agregarCuota', 'agregarCuota')->name('cuota.agregarCuota');
    Route::get('/cuota/{id}/pendientes', 'listarCuotasPendientes')->name('cuota.listarCuotasPendientes');
    Route::put('/cuota/{id}/corregir', 'corregir')->name('cuota.corregir');
});
Route::resource('cuota', CuotasCtrl::class);
