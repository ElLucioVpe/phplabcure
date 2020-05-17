<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $userAgregar = new User;
        //validacion back podemos hacerla o no shkerre
        $request->validate(['correoUser'=>'required']);
        //sacamos los timestamps
        $userAgregar->timestamps = false;
        $userAgregar->correoUser = $request->correoUser;
        $userAgregar->nickUser =  $request->nickUser;
        $userAgregar->passwordUser =  $request->passwordUser;
        $userAgregar->tipoUser =  $request->tipoUser;
        $userAgregar->nivelUser =  $request->nivelUser;
        $UserAvatar ="gualby.jpg";
        if($request->avatarUser!=null){
        $userAgregar->avatarUser =  $request->avatarUser;
        }else{
        $userAgregar->avatarUser =  $UserAvatar;
        }
        //Hacemos save en bd
        $userAgregar->save();
        //Aca podriamos retornar al index logeado o al login
        return back()->with('agregar','User agregado con exito'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $correoUser)
    {
        $userUpdate = App\User :: findOrFail($correoUser);
        $userUpdate->timestamps = false;
        $userUpdate->nickUser=$request->nickUser;
        $userUpdate->passwordUser=$request->passwordUser;
        if($request->passwordUser!=null){
        $userUpdate->avatarUser=$request->avatarUser;
        }
        $userUpdate->save();
        return back()->with('update', 'User Actualizado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($correoUser)
    {
        $userEliminar =  App\User :: findOrFail($correoUser);
        $userEliminar->delete();
        return back()->with('eliminar','User eliminado con exito');
    }
}
