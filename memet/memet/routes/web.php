<?php

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

Route::get('/registro', function () {
    return view('altaUser');
});

Route::post('/crearCuenta','UserController@store')->name('store2');

Route::get('/', function () {
    return view('index');
});

Route::post('/subirMeme','MemeController@store')->name('store');

Route::get('/subir', function () {
    return view('altaMeme');
});
