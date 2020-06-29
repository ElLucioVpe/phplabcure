<?php

namespace App\Http\Controllers;

use Auth;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

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
    public function store($nombreTag)
    {
        $tagAgregar = new Tag;
        //$request->validate(['nombreTag'=>'required']);
        $tagAgregar->timestamps = false;
        $tagAgregar->nombreTag = $nombreTag;
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
        $tagUpdate = Tag :: findOrFail($nombreTag);
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
        $TagEliminar = Tag :: findOrFail($nombreTag);
        $TagEliminar->delete();
        return back()->with('eliminar','El tag ha sido eliminado con exito');
    }

    public function searchTag(Request $request){
        
        if($request->ajax()) {
          
            $data = Tag::where('nombreTag', 'LIKE', $request->nombreTag.'%')->get();
            $tagEspecifico = Tag :: find($request->nombreTag);
            $output = '';

            if($request->nombreTag != "") {

                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                
                $clase_li = "list-group-item memeli";
                if($request->tipo == "enHeader") $clase_li = "list-group-item headerli";
                
                if($tagEspecifico == null && $request->tipo == "enMeme") $output .= '<li class="'.$clase_li.'" data-value="'.$request->nombreTag.'">'.'Crear Tag: '.$request->nombreTag.'</li>';
                
                if (count($data)>0) {
                    foreach ($data as $row){
                        $output .= '<li class="'.$clase_li.'" data-value="'.$row->nombreTag.'">'.$row->nombreTag.'</li>';
                    }
                }
                $output .= '</ul>';
            }
                
            return $output;
        }
    }

    public function getRecomendadosIgnorados($tags) {
        $memes = new \stdClass();
        $memes->seguidos = new Collection();
        $memes->ignorados = new Collection();

        if($tags != "" && $tags != null) {
            foreach($tags->seguidos as $nombreTag) {
                $temp = Tag :: findOrFail($nombreTag);
                $memes->seguidos = $memes->seguidos->merge($temp->memes);
            }
            foreach($tags->ignorados as $nombreTag) {
                $temp = Tag :: findOrFail($nombreTag);
                $memes->ignorados = $memes->ignorados->merge($temp->memes);
            }
        }

        return $memes;
    }
    
    public function getMemesTag($nombreTag, $especifico) { 
        $especifico = filter_var($especifico, FILTER_VALIDATE_BOOLEAN);
        $memes = new Collection();

        if($especifico){
            $temp = Tag :: find($nombreTag);
            if($temp != null) $memes = $temp->memes;
        } else {
            $tags = Tag::where('nombreTag', 'LIKE', $nombreTag.'%')->get();
            foreach($tags as $tag){
                $memes = $memes->merge($tag->memes);
            }
        }
        return $memes;
    }

    //Por si luego queremos reutilizar getMemesTag
    public function buscador(Request $request, $busqueda, $especifico) {

        if($busqueda == null || $busqueda == '') {
            $busqueda = $request->busqueda;
            $especifico = $request->especifico;
        }

        $memes = $this->getMemesTag($busqueda, $especifico)->sortBy(function($meme){
             return $meme->fechaMeme;
        })->reverse();
        return view('buscar', compact('memes'));
    }
}
