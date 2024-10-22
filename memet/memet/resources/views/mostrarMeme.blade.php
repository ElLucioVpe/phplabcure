@extends('plantilla')

@section('content')

    <div class="info-meme">
        <div class="modal-content mx-auto mt-3 modal-memet">
            <div id="user-link" class="modal-header">
                <div class="form-inline">
                    <small>Subido por:&nbsp</small>
                    <a href="{{url('perfilUser').'/'.($memeMostrar->user->correoUser ?? 'eliminado')}}" style="color:black;">
                        {{$memeMostrar->user->nickUser ?? 'usuario eliminado'}}
                    </a>
                </div>
                @if($user = Auth::user())
                    @if($user->correoUser == $memeMostrar->user->correoUser || $user->tipoUser == 'Admin')
                        <a href="{{route('editarMeme', $memeMostrar->idMeme)}}"><i class="fa fa-edit"></i></a>
                    @endif
                @endif
            </div>
            <div class="modal-header">
                <h5 class="modal-title">{{$memeMostrar->tituloMeme}}</h5>
                <p class="media-heading">
                    <small>{{$memeMostrar->fechaMeme}}</small>
                </p>
            </div>
            <div class="modal-body mx-auto">
                <div class="div-meme">
                    <img src="{{ url('storage/memes/'.$memeMostrar->rutaMeme) }}" name="meme" width="100%" height="auto" border="0">
                </div>   
            </div>
            <div class="modal-footer-float-left">
                <div class="tags-meme form-inline">
                    @foreach($memeMostrar->tags as $tag) 
                        <h5>
                            <span class="badge badge-secondary mx-1">
                                <a onclick="mostrarVentanaTag('{{$tag->nombreTag}}')" href="#aboutModal" data-toggle="modal" 
                                    data-target="#tagActions" style="color: white;">
                                @if(strlen($tag->nombreTag)<=50)
                                    {{$tag->nombreTag}}
                                @else
                                    {{substr($tag->nombreTag, 0, 50)."..."}}
                                @endif
                                </a>
                            </span>
                        </h5>
                    @endforeach
                </div>
                <!-- Ventana Suscribirse/Ignorar Tag -->
                <div class="modal fade" id="tagActions" tabindex="-1" role="dialog" aria-labelledby="tagActionsLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header mx-auto">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title" id="tagActionsLabel">Tag</h4>
                                </div>
                            <div class="modal-body mx-auto">
                                <button type="button" class="btn btn-outline-success" data-dismiss="modal" onclick="accionTag(false)">
                                    Suscribirse
                                </button>
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" onclick="accionTag(true)">
                                    Ignorar
                                </button>
                                <button type="button" class="btn btn-outline-dark" data-dismiss="modal" onclick="buscarTag()">
                                    Buscar
                                </button>
                            </div>
                            <div class="modal-footer mx-auto">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -->
                <hr/>
                <div class="form-inline">
                    <h5 class="mx-auto">
                        <button id="like" type="button" class="btn btn-outline-dark" onclick="puntuarMeme('1')">
                            <i class="fa fa-thumbs-up"></i>
                            <span id="like-span" class="badge badge-success">{{$puntuaciones[0]}}</span>
                        </button>
                        <button id="dislike" type="button" class="btn btn-outline-dark" onclick="puntuarMeme('0')">
                            <i class="fa fa-thumbs-down"></i>
                            <span id="dislike-span" class="badge badge-danger">{{$puntuaciones[1]}}</span>
                        </button>
                    </h5>
                </div>
            </div>
            <div id="comments">
                @comments([
                    'model' => $memeMostrar,
                    'perPage' => 50
                ])
            </div>
        </div>
    </div>

    @if($user = Auth::user())
        <script type="text/javascript"> var user = '{{$user->correoUser}}'; </script>
    @else 
        <script type="text/javascript"> var user = "none"; </script>
    @endif

    <script type="text/javascript">
        function puntuarMeme(value) {
            var meme = {{$memeMostrar->idMeme}};
            console.log(user);
            if(user != "none") {
                $.ajax({ 
                    type:'POST',
                    url:"{{url('/puntuarMeme')}}"+'/'+user+'/'+meme+'/'+value,
                    success:function(data){
                        console.log(data);
                        var span = "like-span";
                        var anti_span = "dislike-span";
                        if(data[1] == 0) {
                            span = "dislike-span";
                            anti_span = "like-span";
                        }

                        if(data[0] == "store") 
                            document.getElementById(span).textContent = parseInt(document.getElementById(span).innerText)+1;
                        else if(data[0] == "destroy")
                            document.getElementById(span).textContent = parseInt(document.getElementById(span).innerText)-1;
                        else if(data[0] == "update") {
                            document.getElementById(span).textContent = parseInt(document.getElementById(span).innerText)+1;
                            document.getElementById(anti_span).textContent = parseInt(document.getElementById(anti_span).innerText)-1;
                        }
                        
                    },
                    error:function() {
                        console.log("Sucedio un error en la puntuacion");
                    }
                });
            } else alert("Inicie Sesion");
        }

        function mostrarVentanaTag(tag) {
            $('#tagActionsLabel').html(tag);
            //console.log('update label to:'+$('#tagActionsLabel').html);
        }

        function buscarTag() {
            var tag = $('#tagActionsLabel').html();
            window.location = "/buscar/"+tag+"/true";
        }

        function accionTag(ignora) {
            var tag = $('#tagActionsLabel').html();

            if(user != "none") {
                $.ajax({ 
                    type:'POST',
                    url:"{{url('/suscribirseTag')}}"+'/'+ignora+'/'+tag+'/'+user,
                    success:function(data){
                        if(data == "store" || data == "update") {
                            if(!ignora) alert("Usted se ha suscripto al tag con exito");
                            else alert("Usted ha ignorado el tag con exito");
                        } else if(data == "destroy") {
                            if(!ignora) alert("Usted ya estaba suscripto al tag, por lo tanto ha dejado de estarlo");
                            else alert("Usted ya habia ignorado el tag, por lo tanto ha dejado de hacerlo");
                        }
                    },
                    error:function(){
                        alert("Sucedio un error en la operación\nInicie Sesion si no lo ha hecho");
                    }
                });
            } else alert("Inicie Sesion");
        }

    </script>

@endsection