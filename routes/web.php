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

/*Route::controller(UsersCtrl::class)->group(function () {
    Route::get('/', 'login');
});*/

/*Route::controller(TareasCtrl::class)->group(function () {
    Route::get('tareas/tareaCrear', 'crear');
});*/

Route::resource('tarea', TareasCtrl::class);
