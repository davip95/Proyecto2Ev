<?php

use App\Http\Controllers\LoginCtrl;
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

Route::controller(UsersCtrl::class)->group(function () {
    Route::get('/', 'login');
});

Route::controller(TareasCtrl::class)->group(function () {
    Route::get('/', 'login');
});
