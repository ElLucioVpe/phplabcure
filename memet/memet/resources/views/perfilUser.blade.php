@extends('plantilla')

@section('content')
    <div class="perfil">
            <div class="modal-content w-75 mx-auto mt-3">
                <div class="modal-header mx-auto">
                    <h4 class="modal-title">Perfil de {{$userMostrar->nickUser}}
                        @if($user = Auth::user())
                            @if($user->correoUser == $userMostrar->correoUser)
                            <a href="{{route('editarUser', ['correoUser' => $userMostrar->correoUser])}}"><i class="fa fa-edit"></i></a>
                            @endif
                        @endif
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-inline">
                        <div class="mx-4">
                            <img src="{{ url('storage/avatar/'.$userMostrar->avatarUser) }}" name="avatar" width="140" height="140" border="0">
                        </div>
                        <div class="datos-user">
                            <h3 class="media-heading">{{$userMostrar->nickUser}}
                                @if($recompensas->titulo != "")
                                    <small>[{{$recompensas->titulo}}]</small>
                                @endif
                                <small><span class="badge badge-info">Nivel {{$nivelUser}}</span></small>
                            </h3>
                            
                            @if(!empty($recompensas->medallas))
                                <h5>
                                    @foreach($recompensas->medallas as $medalla)
                                        <!-- Las medallas se guardan como html para poder ser mas personalizadas -->
                                        {!! $medalla !!}
                                    @endforeach
                                </h5>
                                <hr/>
                            @endif

                            <h5>
                                @if($userMostrar->memes->count() == 1)
                                    <span class="badge badge-success">{{$userMostrar->memes->count()}} Publicacion</span>
                                @else
                                    <span class="badge badge-success">{{$userMostrar->memes->count()}} Publicaciones</span>
                                @endif
                            <h5>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <table class="table">
                        <tr>
                            <th>Publicaciones</th>
                        </tr>
                        @foreach ($userMostrar->memes as $meme)
                            <tr>
                                <td>
                                    <a class="text-dark font-weight-bold" href="{{route('mostrarMeme',['idMeme'=>$meme->idMeme])}}">
                                        {{$meme->tituloMeme}}</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
@endsection
