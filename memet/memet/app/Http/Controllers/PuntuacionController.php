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
    public function store($correoUser, $meme_id, $valor) 
    {
        $puntuacionAgregar = new Puntuacion;
        /*
        $request->validate(['User_correoUser'=>'required']);
        $request->validate(['Meme_idMeme'=>'required']);
        */
        $puntuacionAgregar->timestamps = false;
        $puntuacionAgregar->User_correoUser = $correoUser;
        $puntuacionAgregar->Meme_idMeme = $meme_id;
        $puntuacionAgregar->valorPuntuacion = $valor;
        //save
        $puntuacionAgregar->save();

        return back()->with('agregar', 'Ha puntuado con exito el meme');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Puntuacion  $puntuacion
     * @return \Illuminate\Http\Response
     */
    public function show($correoUser, $meme_id)
    {
        $puntuacionMostrar = Puntuacion ::where('User_correoUser', '=', $correoUser)
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
    public function update($correoUser, $meme_id)
    {
        $puntuacionUpdate = Puntuacion ::where('User_correoUser', '=', $correoUser)
        ->where('Meme_idMeme', '=', $meme_id)
        ->first();

        $puntuacionUpdate->timestamps = false;
        if($puntuacionUpdate->valorPuntuacion == 1) $puntuacionUpdate->valorPuntuacion = 0;
        else $puntuacionUpdate->valorPuntuacion = 1;

        $puntuacionUpdate->save();

        return back()->with('update', 'El meme fue modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puntuacion  $puntuacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($correoUser, $meme_id)
    {
        $puntuacionEliminar = Puntuacion ::where('User_correoUser', '=', $correoUser)
        ->where('Meme_idMeme', '=', $meme_id)
        ->first();
        $puntuacionEliminar->delete();
        return back()->with('eliminar', 'Dejo de puntuar este meme');
    }

    public function puntuarMeme($correoUser, $meme_id, $valor) {
        $puntuacion = Puntuacion ::where('User_correoUser', '=', $correoUser)
        ->where('Meme_idMeme', '=', $meme_id)
        ->first();
        
        $operacion = ["", $valor];

        if($puntuacion == null) { 
            $this->store($correoUser, $meme_id, $valor);
            $operacion[0] = "store";
        } else if($puntuacion->valorPuntuacion != $valor) {
            $this->update($correoUser, $meme_id);
            $operacion[0] = "update";
        } else {
            $this->destroy($correoUser, $meme_id);
            $operacion[0] = "destroy";
        }

        return $operacion;
        
    }
}
