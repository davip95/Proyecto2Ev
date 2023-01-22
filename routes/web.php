<?php

use App\Http\Controllers\LoginCtrl;
use App\Http\Controllers\TareasCtrl;
use Illuminate\Support\Facades\Route;

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

Route::get('/tarea/pendientes', [TareasCtrl::class, 'verPendientes'])->name('tarea.pendientes');
Route::get('/tarea/{tarea}/borrado', [TareasCtrl::class, 'confirmarBorrado'])->name('tarea.confirmarBorrado');
Route::get('/tarea/{tarea}/borrar', [TareasCtrl::class, 'borrar'])->name('tarea.borrar');
Route::get('/tarea/{tarea}/cambiarEstado', [TareasCtrl::class, 'cambiarEstado'])->name('tarea.cambiarEstado');
Route::post('/tarea/{tarea}/completar', [TareasCtrl::class, 'completar'])->name('tarea.completar');
Route::resource('tarea', TareasCtrl::class);
