@extends('plantilla')

@section('content')

    <div class="info-meme">
        <div class="modal-content w-75 mx-auto mt-3">
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
                        <span class="badge badge-secondary mx-1">{{$tag->nombreTag}}</span>
                    @endforeach
                </div>
                <hr/>
                <div class="form-inline">
                    <h5 class="mx-auto">
                        <button id="like" type="button" class="btn btn-outline-dark" onclick="puntuarMeme('1')">
                            <i class="fa fa-thumbs-up"></i>
                            <span class="badge badge-success">{{$puntuaciones[0]}}</span>
                        </button>
                        <button id="dislike" type="button" class="btn btn-outline-dark" onclick="puntuarMeme('0')">
                            <i class="fa fa-thumbs-down"></i>
                            <span class="badge badge-danger">{{$puntuaciones[1]}}</span>
                        </button>
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        function puntuarMeme(value) {
            //test
            var user = 'test@test.com';
            var meme = {{$memeMostrar->idMeme}};

            $.ajax({ 
                type:'POST',
                url:'http://localhost:8000/puntuarMeme/'+user+'/'+meme+'/'+value,
                success:function(data){
                    console.log(data.success);
                },
                error:function(){
                    console.log("Sucedio un error en la puntuacion");
                }
            });
        }

    </script>
@endsection