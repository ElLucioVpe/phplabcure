<?php

namespace App\Http\Controllers;

use Auth;
use App\Meme;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class MemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $memes = Meme::all();
        //Recomendados
        $memesREC = new Collection();
        if($user = Auth::user()) {
            $recomendados = app('App\Http\Controllers\SuscripcionController')->getRecomendadosIgnorados($user->correoUser);
            $memesREC = $recomendados->seguidos;

            //Filtro de tags ignorados
            $memesREC = $memesREC->diff($recomendados->ignorados);
            $memes = $memes->diff($recomendados->ignorados);
        }
        //

        $memesNEW = $memes->sortBy(function($meme){
            return $meme->fechaMeme;
        })->reverse();

        $memesHOT = $memes->sortBy(function($meme)
        {
            $count = 0;
            foreach($meme->puntuacions as $puntuacion) {
                if($puntuacion->valorPuntuacion == 1) $count++;
            }
            return $count;
        })->reverse();


        return view('index', compact('memesNEW', 'memesHOT', 'memesREC'));
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
        $request->validate(['tituloMeme'=>'required']);
        $request->validate(['rutaMeme'=>'required']);
        $request->validate(['rutaMeme'=>'image|mimes:jpeg,png,jpg|max:4096']);
        $request->validate(['correoUser'=>'required']);
        //$request->validate(['tags'=>'required']);
        //
        date_default_timezone_set('America/Montevideo');
        $memeAgregar->timestamps = false;
        $memeAgregar->tituloMeme = $request->tituloMeme;
        $memeAgregar->fechaMeme = date("Y-m-d H-i-s");
        $memeAgregar->User_correoUser = $request->correoUser;

        //Guardo imagen
        $image = $request->file('rutaMeme');
        $file_name = str_replace('.', '-', $request->correoUser);
        $file_name = $memeAgregar->fechaMeme.preg_replace('/[^A-Za-z0-9\-]/', '-', $file_name).".png";
        $image->move(storage_path("app/public/memes"), $file_name);
        $memeAgregar->rutaMeme = $file_name;
        //save
        $memeAgregar->save();

        
        //Agrego Tags
        if($request->tags != null) {
            app('App\Http\Controllers\Tag_has_MemeController')->addTags($memeAgregar->getKey(), $request->tags);
        }

        //Gana experiencia
        app('App\Http\Controllers\UserController')->gainEXP($memeAgregar->User_correoUser, 50);

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
        $memeMostrar = Meme :: findOrFail($idMeme);
        $puntuaciones = [0,0];

        $memeMostrar->fechaMeme = preg_replace('/-/', '/', $memeMostrar->fechaMeme);

        foreach($memeMostrar->puntuacions as $pun) {
            if($pun->valorPuntuacion) $puntuaciones[0]++;
            else $puntuaciones[1]++;
        }

        return view('mostrarMeme', compact('memeMostrar', 'puntuaciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Meme  $meme
     * @return \Illuminate\Http\Response
     */
    public function edit($idMeme)
    {
        $memeActualizar = Meme :: findOrFail($idMeme);
        return view('editarMeme', compact('memeActualizar'));
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
        $memeUpdate = Meme :: findOrFail($idMeme);
        $memeUpdate->timestamps = false;
        $memeUpdate->tituloMeme = $request->tituloMeme;

        //Remuevo todos los Tags del meme, para evitar que se mantengan los que se removieron en la view
        app('App\Http\Controllers\Tag_has_MemeController')->removeTags($idMeme);
        //Agrego Tags
        if($request->tags != null) {
            app('App\Http\Controllers\Tag_has_MemeController')->addTags($idMeme, $request->tags);
        }

        $memeUpdate->save();
        return back()->with('updateMeme', 'El meme fue modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meme  $meme
     * @return \Illuminate\Http\Response
     */
    public function destroy($idMeme)
    {
        $memeEliminar = Meme :: findOrFail($idMeme);
        
        app('App\Http\Controllers\Tag_has_MemeController')->removeTags($idMeme);//Remuevo todos los Tags del meme
        $memeEliminar->delete();
        return redirect()->route('index');
    }

    public function desreferenciarMeme($idMeme)
    {
        $memeUpdate = Meme :: findOrFail($idMeme);
        $memeUpdate->timestamps = false;
        $memeUpdate->User_correoUser = null;
        $memeUpdate->save();
    }
}
