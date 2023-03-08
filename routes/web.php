<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\TareasCtrl;
use App\Http\Controllers\UsersCtrl;
use App\Http\Controllers\ClientesCtrl;
use App\Http\Controllers\CuotasCtrl;
use App\Http\Controllers\LoginCtrl;
use App\Http\Controllers\LoginGoogleCtrl;
use App\Http\Controllers\PayPalController;
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
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/auth/github/redirect', [LoginCtrl::class, 'redirectToProvider']);

Route::get('/auth/github/callback', [LoginCtrl::class, 'handleProviderCallback']);

Route::get('/auth/google/redirect', [LoginGoogleCtrl::class, 'redirectToProvider']);

Route::get('/auth/google/callback', [LoginGoogleCtrl::class, 'handleProviderCallback']);

Route::controller(TareasCtrl::class)->group(function () {
    Route::get('/tarea/crearIncidencia', 'crearIncidencia')->name('tarea.crearIncidencia');
    Route::post('/tarea/agregarIncidencia', 'agregarIncidencia')->name('tarea.agregarIncidencia');
    Route::get('/tarea/pendientes', 'verPendientes')->middleware('auth')->name('tarea.pendientes');
    Route::get('/tarea/incidencias', 'verIncidencias')->middleware('auth')->middleware('admin')->name('tarea.incidencias');
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
    Route::get('/losrusos', 'verRusos')->middleware('auth')->middleware('admin')->name('cliente.verRusos');
    Route::get('/losrusospdf', 'verRusosPDF')->middleware('auth')->middleware('admin')->name('cliente.verRusosPDF');
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
    Route::get('/cuota/{id}/pdf', 'crearPDF')->middleware('auth')->middleware('admin')->name('cuota.pdf');
});
Route::resource('cuota', CuotasCtrl::class)->middleware('auth')->middleware('admin');

Route::get('/paypal/pay/{cuota}', [PayPalController::class, 'payWithPayPal'])->name('paypal.pay');
Route::get('/paypal/status/{cuota}', [PayPalController::class, 'payPalStatus'])->name('paypal.status');
Route::get('/pagocorrecto', [PayPalController::class, 'pagoCorrecto'])->name('pagoCorrecto');
Route::get('/paypal/failed', [PayPalController::class, 'pagoFallado'])->name('pagoFallado');
