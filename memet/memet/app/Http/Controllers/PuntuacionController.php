<?php

namespace App\Http\Controllers;

use App\Puntuacion;
use Illuminate\Http\Request;

class PuntuacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //----------------------------------
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //-----------------------------------
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        $puntuacionAgregar = new Puntuacion;
        //
        $request->validate(['User_correoUser'=>'required']);
        $request->validate(['Meme_idMeme'=>'required']);
        //
        $puntuacionAgregar->timestamps = false;
        $puntuacionAgregar->User_correoUser = $request->User_correoUser;
        $puntuacionAgregar->Meme_idMeme = $request->Meme_idMeme;
        $puntuacionAgregar->valorPuntuacion = $request->valorPuntuacion;
        //save
        $puntuacionAgregar->save();

        return back()->with('agregar', 'A puntuado con exito el meme');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Puntuacion  $puntuacion
     * @return \Illuminate\Http\Response
     */
    public function show($correoUser, $meme_id)
    {
        $puntuacionMostrar = App\Puntuacion ::where('User_correoUser', '=', $correoUser)
        ->where('Meme_idMeme', '=', $meme_id)
        ->first();
        return view('mostrar', compact('puntuacionMostrar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Puntuacion  $puntuacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Puntuacion $puntuacion)
    {
        //--------------------------------
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Puntuacion  $puntuacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puntuacion $puntuacion)
    {
        //--------------------------------
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puntuacion  $puntuacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($correoUser, $meme_id)
    {
        $puntuacionEliminar = App\Puntuacion ::where('User_correoUser', '=', $correoUser)
        ->where('Meme_idMeme', '=', $meme_id)
        ->first();
        $puntuacionEliminar->delete();
        return back()->with('eliminar', 'Dejo de puntuar este meme');
    }
}
