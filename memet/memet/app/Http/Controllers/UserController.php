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
        $request->validate(['correo'=>'required']);
        //sacamos los timestamps
        $userAgregar->timestamps = false;
        $userAgregar->correoUser = $request->correo;
        $userAgregar->nickUser =  $request->nick;
        $userAgregar->passwordUser =  $request->password;
        $userAgregar->tipoUser =  "normy";
        $userAgregar->experienciaUser =  0;

        $UserAvatar ="gualby.png";
        
        

        if($request->avatar!=null){
            $request->validate(['avatar'=>'image|mimes:jpeg,png,jpg|max:2048']);
            $image = $request->file('avatar');
            $new_name = $request->correo.'.png';
            $image->move(public_path("profileImages"),$new_name);

            $userAgregar->avatarUser =  $request->correo.'.png';
        }else{
            $userAgregar->avatarUser =  $UserAvatar;
        }

        //Hacemos save en bd
        $userAgregar->save();

        //Aca podriamos retornar al index logeado o al login
        return back()->with('agregar','Cuenta creada con exito'); 
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
    public function edit($correoUser)
    {
        $userActualizar = User::findOrFail($correoUser);
        return view('editarUser',compact('userActualizar'));
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
        $userUpdate = User :: findOrFail($correoUser);
        $userUpdate->timestamps = false;
        $userUpdate->nickUser=$request->nickUser;
        $userUpdate->passwordUser=$request->passwordUser;


       if($request->avatar!=null){
            $request->validate(['avatar'=>'image|mimes:jpeg,png,jpg|max:2048']);
            $image = $request->file('avatar');
            $new_name = $correoUser.'.png';
            $image->move(public_path("profileImages"),$new_name); 

            
        if($userUpdate->avatarUser == "gualby.png"){
            $userUpdate->avatarUser= $correoUser.'.png';
        }

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
        $userEliminar =  User :: findOrFail($correoUser);
        $userEliminar->delete();
        return back()->with('eliminar','User eliminado con exito');
    }

    public function nivelUsuario($experiencia)
    {
        $nivel = (int) (floor(25 + sqrt(625 + 100 * $experiencia)) / 50);
        return $nivel;
    }
}
