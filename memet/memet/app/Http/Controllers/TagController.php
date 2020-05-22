<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tagAgregar = new Tag;
        $request->validate(['nombreTag'=>'required']);
        $tagAgregar->timestamps = false;
        $tagAgregar->nombreTag = $request->nombreTag;
        $tagAgregar->save();
        return back()->with('agregar','Tag agregado con exito');   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($nombreTag)
    {
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nombreTag)
    {
        $tagUpdate = App\Tag :: findOrFail($nombreTag);
        $tagUpdate->timestamps = false;
        //No se que editar aca, perdoname esteby soy tontito
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($nombreTag)
    {
        $TagEliminar =  App\Tag :: findOrFail($nombreTag);
        $TagEliminar->delete();
        return back()->with('eliminar','El tag ha sido eliminado con exito');
    }
}
