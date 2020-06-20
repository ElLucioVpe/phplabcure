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
Route::get('/','MemeController@index')->name('index');
/*Route::get('/', function () {
    return view('index');
});*/

Route::get('/registro', function () {
    return view('altaUser');
});
Route::post('/registro','UserController@store')->name('storeUser');
Route::get('/login', function () {
    return view('login');
});
Route::post('/login','UserController@loginUser')->name('login');
Route::post('/logout','UserController@logoutUser')->name('logout');

Route::get('/perfilUser/{correoUser}','UserController@show')->name('perfilUser');
Route::get('/editarUser/{correoUser}','UserController@edit')->name('editarUser');
Route::put('/update/{correoUser}','UserController@update')->name('updateUser');
Route::delete('/eliminarUser/{correoUser}','UserController@destroy')->name('eliminarUser');

Route::get('/subirMeme', function () {
    return view('altaMeme');
});

Route::get('/mostrarMeme/{idMeme}','MemeController@show')->name('mostrarMeme');
Route::post('/subirMeme','MemeController@store')->name('storeMeme');
Route::post('/puntuarMeme/{correoUser}/{meme_id}/{valor}','PuntuacionController@puntuarMeme')->name('puntuarMeme');

Route::get('/suscripciones/{correoUser}','SuscripcionController@suscripcionesUser')->name('suscripciones');
Route::post('/suscribirseTag/{ignora}/{nombreTag}/{correoUser}','SuscripcionController@suscribirseTag')->name('suscribirseTag');
Route::delete('/eliminarSuscripcion/{correoUser}/{tag}','SuscripcionController@destroy')->name('eliminarSuscripcion');

Route::get('/searchTag','TagController@searchTag')->name('searchTag');
Route::post('/crearTag','TagController@store')->name('storeTag');
Route::post('/agregarTag','Tag_has_MemeController@store')->name('storeTag_has_Meme');
