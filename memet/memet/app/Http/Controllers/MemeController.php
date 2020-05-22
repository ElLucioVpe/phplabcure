<?php

namespace App\Http\Controllers;

use App\Meme;
use Illuminate\Http\Request;

class MemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //-----------------------------
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //-----------------------------
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        $memeAgregar = new Meme;
        //
        $request->validate(['rutaMeme'=>'required']);
        $request->validate(['rutaMeme'=>'image|mimes:jpeg,png,jpg|max:2048']);
        //$request->validate(['tags'=>'required']);
        //

        $memeAgregar->timestamps = false;
        $memeAgregar->fechaMeme = date("Y-m-d H-i-s");
        $memeAgregar->User_correoUser = $request->correoUser;

        $image = $request->file('rutaMeme');
        $file_name = str_replace('.', '-', $request->correoUser);
        $file_name = $memeAgregar->fechaMeme.preg_replace('/[^A-Za-z0-9\-]/', '-', $file_name).".png";
        $image->move(public_path("memeFiles"), $file_name);
        $memeAgregar->rutaMeme = $file_name;

        //save
        $memeAgregar->save();

        return back()->with('agregar', 'El meme fue subido con exito');
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Meme  $meme
     * @return \Illuminate\Http\Response
     */
    public function show($idMeme)
    {
        $memeMostrar = App\Meme :: findOrFail($idMeme);
        return view('mostrar', compact('memeMostrar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Meme  $meme
     * @return \Illuminate\Http\Response
     */
    public function edit($idMeme)
    {
        $memeModificar = App\Meme :: findOrFail($idMeme);
        return view('editar', compact('memeModificar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meme  $meme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idMeme)
    {
        $memeUpdate = App\Meme :: findOrFail($idMeme);
        $memeUpdate->timestamps = false;
        //$memeUpdate->fechaMeme = $request->fechaMeme;
        $memeUpdate->rutaMeme = $request->rutaMeme;
        $memeUpdate->tags = $request->tags;
        return back()->with('update', 'El meme fue modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meme  $meme
     * @return \Illuminate\Http\Response
     */
    public function destroy($idMeme)
    {
        $memeEliminar = App\Meme :: findOrFail($idMeme);
        $memeEliminar->delete();
        return back()->with('eliminar', 'El meme fue eliminado con exito');
    }
}
