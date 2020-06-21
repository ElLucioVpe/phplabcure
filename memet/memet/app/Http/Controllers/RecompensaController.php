<?php

namespace App\Http\Controllers;

use App\Recompensa;
use App\User_hasRecompensa;
use Illuminate\Http\Request;

class RecompensaController extends Controller
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
    public function store($idRecompensa, $correoUser)
    {
        $relacion = User_hasRecompensa::where('correoUser', '=', $correoUser)
        ->where('idRecompensa', '=', $idRecompensa)->first();

        if($relacion == null) {
            $hasrecompensa = new User_hasRecompensa;

            $hasrecompensa->timestamps = false;
            $hasrecompensa->idRecompensa = $idRecompensa;
            $hasrecompensa->correoUser = $correoUser;
            $hasrecompensa->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User_hasRecompensa  $User_hasRecompensa
     * @return \Illuminate\Http\Response
     */
    public function show(User_hasRecompensa $User_hasRecompensa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User_hasRecompensa  $User_hasRecompensa
     * @return \Illuminate\Http\Response
     */
    public function edit(User_hasRecompensa $User_hasRecompensa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User_hasRecompensa  $User_hasRecompensa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User_hasRecompensa $User_hasRecompensa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User_hasRecompensa  $User_hasRecompensa
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_hasRecompensa $User_hasRecompensa)
    {
        //
    }

    public function darRecompensa($correoUser, $nivel) {
        $recompensas = Recompensa::where('nivel', '=', $nivel)->get();

        if($recompensas != null) {
            foreach($recompensas as $recom) {
                $this->store($recom->id, $correoUser);
            }
        }
    }
}