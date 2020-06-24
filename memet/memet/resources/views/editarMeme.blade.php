@extends('plantilla')

@section('content')

@if(Auth::guest())
    <script type="text/javascript">
        window.location = "{{ url('/login') }}";
    </script>
@elseif($user = Auth::user())

    @if($user->correoUser == $memeActualizar->user->correoUser || $user->tipoUser == 'Admin')

    <div class="row mt-3">
        <div class="col-md-12">

            {{--Form--}}
            <center>
            <div class="col-md-6">
                <h3 class="text-center mb-4">Editar Meme</h3>

                <form action="{{route('updateMeme', $memeActualizar->idMeme)}}" method="POST" id="editarMeme">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="tituloMeme">Titulo:</label>
                        <input type="text" name="tituloMeme" id="tituloMeme" value="{{$memeActualizar->tituloMeme}}">
                    </div>
                    
                    <div class="form-group">
                        <embed id="memeFile" src="{{ url('storage/memes/'.$memeActualizar->rutaMeme) }}" height="300">
                    </div>

                    <div class="form-group">
                        <label id="tagsLabel">Tag/s:<br/><small>(Haga click en un tag para removerlo)</small></label>
                        <div id="tagSpans">
                            <!--Ejemplo de Span e Input
                                <span class="badge badge-primary m-1">nombreTag</span>
                                <input type="hidden" name="tags[]" value="nombreTag"/>
                            -->
                            @foreach($memeActualizar->tags as $tag)
                                @if(strlen($tag->nombreTag)>50)
                                <span class="badge badge-primary m-1">{{substr($tag->nombreTag ,0, 50)."..."}}</span>
                                @else
                                <span class="badge badge-primary m-1">{{$tag->nombreTag}}</span>
                                @endif
                                <input id="{{$tag->nombreTag.'_input'}}" type="hidden" name="tags[]" value="{{$tag->nombreTag}}"/>
                            @endforeach
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" name="tag_search" id="tag_search" placeholder="Ingresa un tag" class="form-control">
                            </div>
                            <div id="tag_list"></div>                    
                        </div>
                    </div>
                    

                    <button type="submit" class="btn btn-success btn-block">Editar</button>
                </form>
                <form action="{{route('eliminarMeme', $memeActualizar->idMeme)}}" method="POST" class="d-inline" onsubmit="return confirm('¿Esta seguro que desea eliminar el meme?');">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger mx-auto">Eliminar Meme</button>
                </form>
                

                @if (session('agregar'))
                    <div class="alert alert-success mt-3">
                        {{session('agregar')}}
                    </div>
                @endif
                
                <script type="text/javascript">
                    $(document).ready(function () {

                        $('#tag_search').on('keyup',function() {
                            var query = $(this).val(); 
                            $.ajax({ 
                                type:'GET',
                                url:"{{route('searchTag')}}",
                                data:{'nombreTag':query, 'tipo':'enMeme'},
                                success:function(data){
                                    $('#tag_list').html(data);
                                },
                                error:function(){
                                    alert("Sucedio un error en la operación\nInicie Sesion si no lo ha hecho");
                                }
                            });
                        });

                        $(document).on('click', 'li.memeli', function(){
                            var nombreTag = $(this).data('value');
                            var tagSpans = $('#tagSpans');
                            $('#tag_list').html("");
                            //Agrego una span representativa del tag, con la opcion de eliminarlo del array
                            if(nombreTag.length>50) nombreTag = nombreTag.substring(0, 50)+"...";
                            
                            $('<span />', {
                                class: 'badge badge-primary m-1',
                                text: nombreTag
                            }).appendTo(tagSpans);

                            //Agrego el tag al array
                            $('<input />', { 
                                type: 'hidden',
                                name: 'tags[]',
                                id: nombreTag+"_input",
                                value: nombreTag
                            }).appendTo(tagSpans);
                        });

                        $(document).on('click', 'span', function(){
                            //Elimino el tag del array y tambien su badge
                            var nombreTag = $(this).text();
                            document.getElementById(nombreTag+"_input").remove();
                            $(this).remove();
                        });

                    });
                </script>

            </div>
            {{--Fin Form--}}
            </center>

        </div>
    
    </div>
    @else
    <script type="text/javascript">
        window.location = "{{ route('index') }}";
    </script>
    @endif
@endif
@endsection