@extends('plantilla')

@section('content')
    <div class="perfil">
            <div class="modal-content w-75 mx-auto mt-3">
                <div class="modal-header mx-auto">
                    <h4 class="modal-title">Perfil de {{$userMostrar->nickUser}}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-inline">
                        <div class="mx-4">
                            <img src="{{ url('storage/avatar/'.$userMostrar->avatarUser) }}" name="avatar" width="140" height="140" border="0">
                        </div>
                        <div class="datos-user">
                            <h3 class="media-heading">{{$userMostrar->nickUser}}
                                <small><span class="badge badge-info">Nivel {{$nivelUser}}</span></small>
                            </h3>
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
