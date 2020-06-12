<?php

namespace App\Http\Controllers;

use App\Tag_has_Meme;
use App\Tag;
use Illuminate\Http\Request;

class Tag_has_MemeController extends Controller
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
    public function store($idMeme, $nombreTag)
    {
        $tagMAgregar = new Tag_has_Meme;
        /*
        $request->validate(['Tag_nombreTag'=>'required']);
        $request->validate(['Meme_idMeme'=>'required']);
        */

        $tagMAgregar->timestamps = false;
        $tagMAgregar->Tag_nombreTag = $nombreTag;
        $tagMAgregar->Meme_idMeme = $idMeme;

        //save
        $tagMAgregar->save();

        //return back()->with('agregar', 'El meme fue subido con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag_has_Meme  $tag_has_Meme
     * @return \Illuminate\Http\Response
     */
    public function show(Tag_has_Meme $tag_has_Meme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag_has_Meme  $tag_has_Meme
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag_has_Meme $tag_has_Meme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag_has_Meme  $tag_has_Meme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag_has_Meme $tag_has_Meme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag_has_Meme  $tag_has_Meme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag_has_Meme $tag_has_Meme)
    {
        //
    }

    public function addTags($idMeme, $listaTags){
        foreach($listaTags as $tag) {
            $tempTag = Tag :: find($tag);
            if($tempTag == null) app('App\Http\Controllers\TagController')->store($tag);
            
            $this->store($idMeme, $tag);
        }
    }
}
