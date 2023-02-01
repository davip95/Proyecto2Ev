<?php

use App\Http\Controllers\LoginCtrl;
use App\Http\Controllers\TareasCtrl;
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
    //Route::post('/tarea/{id}/borrar', 'borrar')->name('tarea.borrar');
    // Con la siguiente ruta compruebo si trata de acceder a la url manualmente sin pasar por el formulario de confirmacion de borrado
    // Si lo intenta, redirige al listado de tareas
    //Route::get('/tarea/{id}/borrar', 'index')->name('tarea.borrar');
    Route::get('/tarea/{id}/cambiarEstado', 'cambiarEstado')->name('tarea.cambiarEstado');
    Route::put('/tarea/{id}/completar', 'completar')->name('tarea.completar');
    // Con la siguiente ruta compruebo si trata de acceder a la url manualmente sin pasar por el formulario de confirmacion de completado
    // Si lo intenta, redirige al listado de tareas
    Route::get('/tarea/{id}/completar', 'index')->name('tarea.completar');
});
Route::resource('tarea', TareasCtrl::class);
