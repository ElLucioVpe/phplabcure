<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Suscripcion;

use Illuminate\Http\Request;

class SuscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function suscripcionesUser($correoUser) 
    {
        $user = User :: findOrFail($correoUser);
        $suscripciones = $user->suscripcions;

        return view('suscripciones', compact('suscripciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //-------------------------------
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($ignora, $nombreTag, $correoUser)
    {
        $suscripcionAgregar = new Suscripcion;
        /*
        $request->validate(['User_correoUser'=>'required']);
        $request->validate(['Tag_nombreTag'=>'required']);
        */
        $suscripcionAgregar->timestamps = false;
        $suscripcionAgregar->User_correoUser = $correoUser;
        $suscripcionAgregar->Tag_nombreTag = $nombreTag;
        $suscripcionAgregar->ignora = $ignora;
        //save
        $suscripcionAgregar->save();

        return back()->with('agregar', 'Se ha suscrito/ignorado el tag con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function show($correoUser, $nombreTag)
    {
        $suscripcionMostrar = Suscripcion ::where('User_correoUser', '=', $correoUser)
        ->where('Tag_nombreTag', '=', $nombreTag)
        ->first();
        return view('mostrar', compact('suscripcionMostrar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function edit($correoUser, $nombreTag)
    {
        $suscripcionModificar = Suscripcion ::where('User_correoUser', '=', $correoUser)
        ->where('Tag_nombreTag', '=', $nombreTag)
        ->first();

        return view('editar', compact('suscripcionModificar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function update($ignora, $nombreTag, $correoUser)
    {
        $suscripcionUpdate = Suscripcion ::where('User_correoUser', '=', $correoUser)
        ->where('Tag_nombreTag', '=', $nombreTag)
        ->first();
        $suscripcionUpdate->timestamps = false;
        $suscripcionUpdate->ignora = $ignora;
        $suscripcionUpdate->save();

        return back()->with('update', 'Se ha modificado la suscripcion con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function destroy($correoUser, $nombreTag)
    {
        $suscripcionEliminar = Suscripcion ::where('User_correoUser', '=', $correoUser)
        ->where('Tag_nombreTag', '=', $nombreTag)
        ->first();
        $suscripcionEliminar->delete();
        return back()->with('eliminar', 'Se elimino la suscripcion con exito');
    }

    public function suscribirseTag($ignora, $nombreTag, $correoUser) {
        $suscripcion = Suscripcion ::where('User_correoUser', '=', $correoUser)
        ->where('Tag_nombreTag', '=', $nombreTag)
        ->first();

        $ignora = filter_var($ignora, FILTER_VALIDATE_BOOLEAN); //verifico/convierto boolean
        $operacion = "";

        if($suscripcion == null) {
            $this->store($ignora, $nombreTag, $correoUser);
            $operacion = "store"; 
        } else if($suscripcion->ignora != $ignora) {
            $this->update($ignora, $nombreTag, $correoUser);
            $operacion = "update"; 
        } else {
            $this->destroy($correoUser, $nombreTag);
            $operacion = "destroy"; 
        }

        return $operacion;
    }

    public function getRecomendadosIgnorados($correoUser)
    {
        $user = User :: findOrFail($correoUser);
        $suscripciones = $user->suscripcions;
        $tags = new \stdClass();
        $tags->seguidos = array();
        $tags->ignorados = array();

        foreach($suscripciones as $sus) {
            if($sus->ignora) $tags->ignorados[] = $sus->Tag_nombreTag;
            else $tags->seguidos[] = $sus->Tag_nombreTag;
        }
        
        $memes = app('App\Http\Controllers\TagController')->getRecomendadosIgnorados($tags);
        return $memes;
    }
}
