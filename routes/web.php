<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TareasCtrl;
use App\Http\Controllers\UsersCtrl;
use App\Http\Controllers\ClientesCtrl;
use App\Http\Controllers\CuotasCtrl;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';


Route::controller(TareasCtrl::class)->group(function () {
    Route::get('/tarea/pendientes', 'verPendientes')->middleware('auth')->name('tarea.pendientes');
    Route::get('/tarea/incidencias', 'verIncidencias')->middleware('auth')->middleware('admin')->name('tarea.incidencias');
    // LAS DOS RUTAS SIGUIENTES PUEDE QUE NO HAGAN FALTA SI SACO EL clientes_id DE UNA VARIABLE DE SESION PARA EL STORE DE UNA INCIDENCIA 
    // Route::get('/tarea/{id}/incidencia', 'crearIncidencia')->middleware('auth')->name('tarea.crearIncidencia');
    // Route::post('/tarea/{id}/incidencia', 'guardarIncidencia')->middleware('auth')->name('tarea.guardarIncidencia');
    Route::get('/tarea/{id}/borrado', 'confirmarBorrado')->middleware('auth')->middleware('admin')->name('tarea.confirmarBorrado');
    Route::get('/tarea/{id}/cambiarEstado', 'cambiarEstado')->middleware('auth')->middleware('operario')->name('tarea.cambiarEstado');
    Route::put('/tarea/{id}/completar', 'completar')->middleware('auth')->middleware('operario')->name('tarea.completar');
    // Con la siguiente ruta compruebo si trata de acceder a la url manualmente sin pasar por el formulario de confirmacion de completado
    // Si lo intenta, redirige al listado de tareas
    Route::get('/tarea/{id}/completar', 'index')->middleware('auth')->middleware('operario')->name('tarea.completar');
});
Route::resource('tarea', TareasCtrl::class)->middleware('auth');

Route::controller(UsersCtrl::class)->group(function () {
    Route::get('/usuario/{id}/borrado', 'confirmarBorrado')->middleware('auth')->middleware('admin')->name('usuario.confirmarBorrado');
});
Route::resource('usuario', UsersCtrl::class)->middleware('auth');

Route::controller(ClientesCtrl::class)->group(function () {
    Route::get('/cliente/{id}/borrado', 'confirmarBorrado')->middleware('auth')->middleware('admin')->name('cliente.confirmarBorrado');
});
Route::resource('cliente', ClientesCtrl::class)->middleware('auth')->middleware('admin');

Route::controller(CuotasCtrl::class)->group(function () {
    Route::get('/cuota/creaRemesa', 'crearRemesa')->middleware('auth')->middleware('admin')->name('cuota.crearRemesa');
    Route::post('/cuota/agregaRemesa', 'agregarRemesa')->middleware('auth')->middleware('admin')->name('cuota.agregarRemesa');
    Route::get('/cuota/{id}/borrado', 'confirmarBorrado')->middleware('auth')->middleware('admin')->name('cuota.confirmarBorrado');
    Route::get('/cuota/{id}/listar', 'listarCuotasCliente')->middleware('auth')->middleware('admin')->name('cuota.listarCuotasCliente');
    Route::get('/cuota/{id}/crearCuota', 'crearCuota')->middleware('auth')->middleware('admin')->name('cuota.crearCuota');
    Route::post('/cuota/{id}/agregarCuota', 'agregarCuota')->middleware('auth')->middleware('admin')->name('cuota.agregarCuota');
    Route::get('/cuota/{id}/pendientes', 'listarCuotasPendientes')->middleware('auth')->middleware('admin')->name('cuota.listarCuotasPendientes');
});
Route::resource('cuota', CuotasCtrl::class)->middleware('auth')->middleware('admin');
