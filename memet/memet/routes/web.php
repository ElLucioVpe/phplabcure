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

Route::get('/', function () {
    return view('index');
});

Route::get('/registro', function () {
    return view('altaUser');
});
Route::post('/crearCuenta','UserController@store')->name('store');

Route::get('/editarUser/{correoUser}','UserController@editar')->name('editarUser');
Route::put('/update/{correoUser}','UserController@update')->name('updateUser');

Route::get('/subirMeme', function () {
    return view('altaMeme');
});

Route::post('/subirMeme','MemeController@store')->name('storeMeme');

Route::get('/suscripciones/{correoUser}','SuscripcionController@suscripcionesUser')->name('suscripciones');

Route::delete('/eliminarSuscripcion/{correoUser}/{tag}','SuscripcionController@destroy')->name('eliminarSuscripcion');


