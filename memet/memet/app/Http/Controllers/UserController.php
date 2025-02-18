<?php

namespace App\Http\Controllers;

use Auth;
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
        $userAgregar->passwordUser = bcrypt($request->password);
        $userAgregar->tipoUser =  "Usuario";
        $userAgregar->experienciaUser =  0;

        $UserAvatar ="ninguno.png";

        if($request->avatar!=null){
            $request->validate(['avatar'=>'image|mimes:jpeg,png,jpg|max:2048']);
            $image = $request->file('avatar');
            $new_name = $request->correo.'.png';
            $image->move(storage_path('app/public/avatar'),$new_name);

            $userAgregar->avatarUser =  $request->correo.'.png';
        }else{
            $userAgregar->avatarUser = $UserAvatar;
        }

        //Hacemos save en bd
        $userAgregar->save();

        //Aca podriamos retornar al index logeado o al login
        Auth::login($userAgregar);
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($correoUser)
    {
        $userMostrar = User::findOrFail($correoUser);
        $nivelUser = $this->nivelUsuario($userMostrar->experienciaUser);

        //Recompensas
        $recompensas = new \stdClass;
        $recompensas->titulo = $this->getRecompensa($userMostrar->recompensas, 'Titulo');
        $recompensas->medallas = $this->getRecompensa($userMostrar->recompensas, 'Medalla');
        //

        return view('perfilUser',compact('userMostrar', 'nivelUser', 'recompensas'));
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
        $rutaAvatar = public_path('storage/avatar');
        return view('editarUser',compact('userActualizar', 'rutaAvatar'));
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

        if($request->passwordUser != '' && $request->passwordUser != null)
            $userUpdate->passwordUser=bcrypt($request->passwordUser);


        if($request->avatar!=null){
            $request->validate(['avatar'=>'image|mimes:jpeg,png,jpg|max:2048']);
            $image = $request->file('avatar');
            $new_name = $correoUser.'.png';
            $image->move(storage_path('app/public/avatar'),$new_name); 

            
            if($userUpdate->avatarUser == "ninguno.png"){
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
    
        $userEliminar->puntuacions()->delete();
        $userEliminar->suscripcions()->delete();
        
        $Mcontroller = new MemeController();
        foreach ( $userEliminar->memes as $Meme) {
            $Mcontroller->desreferenciarMeme($Meme->idMeme);
        }

        $userEliminar->delete();
        return redirect()->route('index');
    }

    public function nivelUsuario($experiencia)
    {
        $nivel = (int) (floor(25 + sqrt(625 + 100 * $experiencia)) / 50);
        return $nivel;
    }

    public function loginUser(Request $request){
        $credentials = $request->only('correoUser', 'password');

        if(Auth::attempt($credentials)) return redirect()->route('index');
        else return redirect()->route('login');
    }

    public function logoutUser(){
        Auth::logout();
    }

    public function gainEXP($correoUser, $exp) {
        $user = User::findOrFail($correoUser);
        $user->timestamps = false;

        $nivelAnterior = $this->nivelUsuario($user->experienciaUser);
        $user->experienciaUser += $exp;
        $nuevoNivel = $this->nivelUsuario($user->experienciaUser);

        if($nuevoNivel > $nivelAnterior) {
            app('App\Http\Controllers\RecompensaController')->darRecompensa($correoUser, $nuevoNivel);
        }

        $user->save();
    }

    public function getRecompensa($recompensas, $tipoReward) {
        $nivelReward = 0;
        $retorno = "";
        
        //tipoReward existe para poder hacer distintas acciones segun el tipo
        //Por ejemplo, el titulo queremos obtener solamente el de mayor nivel

        if($tipoReward == "Medalla") $retorno = array();

        foreach($recompensas as $recom) {
            if($recom->tipo == $tipoReward) {
                if($tipoReward == "Titulo") {
                    if($recom->nivel > $nivelReward) {
                        $nivelReward = $recom->nivel;
                        $retorno = $recom->contenido;
                    }
                }
                if($tipoReward == "Medalla") {
                    $retorno[] = $recom->contenido;
                }
            }
        }

        return $retorno;
    }
}
