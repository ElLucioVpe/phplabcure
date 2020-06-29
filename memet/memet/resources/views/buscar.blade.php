@extends('plantilla')

@section('content')

    <div class="pt-5 container">
        <div class="row">
            <div class="col">
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-memes" role="tabpanel" aria-labelledby="nav-new-tab">
                        @foreach ($memes as $meme)
                        <div class="card mx-auto meme-card">
                            <div class="card-body">
                                <small class="card-text autor">
                                    <a href="{{url('perfilUser').'/'.($meme->user->correoUser ?? 'eliminado')}}" style="color:black;">
                                        {{$meme->user->nickUser ?? 'usuario eliminado'}}
                                    </a>
                                </small>
                                <p class="card-text titulo"><a href="{{url('mostrarMeme/'.$meme->idMeme)}}" style="color:black">{{$meme->tituloMeme}}</a></p>
                                <img class="card-img-bottom" src="{{url('storage/memes/'.$meme->rutaMeme)}}">
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <div class="btn-group">
                                        <button id="like" type="button" class="btn btn btn-outline-dark" onclick="puntuarMeme({{$meme->idMeme}},'1')">
                                            <i class="fa fa-thumbs-up"></i>
                                        </button>
                                        <button id="dislike" type="button" class="btn btn btn-outline-dark" onclick="puntuarMeme({{$meme->idMeme}},'0')">
                                            <i class="fa fa-thumbs-down"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>

    @if($user = Auth::user())
        <script type="text/javascript"> var user = '{{$user->correoUser}}'; </script>
    @else 
        <script type="text/javascript"> var user = "none"; </script>
    @endif

    <script type="text/javascript">
        function puntuarMeme(meme, value) {
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
                        
                    },
                    error:function() {
                        console.log("Sucedio un error en la puntuacion");
                    }
                });
            } else alert("Inicie Sesion");
        }
    </script>

@endsection
