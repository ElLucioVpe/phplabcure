<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $suscripcionAgregar = new Suscripcion;
        //
        $request->validate(['User_correoUser'=>'required']);
        $request->validate(['Tag_nombreTag'=>'required']);
        //
        $suscripcionAgregar->timestamps = false;
        $suscripcionAgregar->User_correoUser = $request->User_correoUser;
        $suscripcionAgregar->Tag_nombreTag = $request->Tag_nombreTag;
        $suscripcionAgregar->ignora = $request->ignora;
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
        $suscripcionMostrar = App\Suscripcion ::where('User_correoUser', '=', $correoUser)
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
        $suscripcionModificar = App\Suscripcion ::where('User_correoUser', '=', $correoUser)
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
    public function update(Request $request, $correoUser, $nombreTag)
    {
        $suscripcionUpdate = App\Suscripcion ::where('User_correoUser', '=', $correoUser)
        ->where('Tag_nombreTag', '=', $nombreTag)
        ->first();
        $suscripcionUpdate->timestamps = false;
        $suscripcionUpdate->ignora = $request->ignora;

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
        $suscripcionEliminar = App\Suscripcion ::where('User_correoUser', '=', $correoUser)
        ->where('Tag_nombreTag', '=', $nombreTag)
        ->first();
        $suscripcionEliminar->delete();
        return back()->with('eliminar', 'Se elimino la suscripcion con exito');
    }
}
