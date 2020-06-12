@extends('plantilla')

@section('content')

<div class="row mt-3">
    <div class="col-md-12">

        {{--Form--}}
        <center>
        <div class="col-md-6">
            <h3 class="text-center mb-4">Subir Meme</h3>

            <form action="{{route('storeMeme')}}" method="POST" enctype="multipart/form-data" id="subirMeme">
                <div class="form-group">
                    <label for="tituloMeme">Titulo:</label>
                    <input type="text" name="tituloMeme" id="tituloMeme" placeholder="Nuevo Meme">
                </div>
                
                @csrf
                <div class="form-group">
                    <label for="rutaMeme">Seleccione una archivo para subir:</label>
                    <input type="file" name="rutaMeme" id="rutaMeme" placeholder="Meme" required>
                    <embed id="memeFile" src="" width="450" height="300" hidden>
                </div>
                @error('rutaMeme')
                    <div class="alert alert-danger">
                        Por favor seleccione una imagen o video para subir.
                    </div>
                @enderror

                <div class="form-group">
                    <label id="tagsLabel">Tag/s:<br/><small>(Haga click en un tag para removerlo)</small></label>
                    <div id="tagSpans">
                        <!--Ejemplo de Span
                            <span class="badge badge-primary m-1">nombreTag</span>
                        -->
                    </div>
                    <div id="tagInputs">
                        <!--Ejemplo de Input
                            <input type="hidden" name="tags[]" value="nombreTag"/>
                        -->
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" name="tag_search" id="tag_search" placeholder="Ingresa un tag" class="form-control">
                        </div>
                        <div id="tag_list"></div>                    
                    </div>
                </div>

                <input type="hidden" name="correoUser" id="correoUser" value="test@test.com">

                <button type="submit" class="btn btn-success btn-block">Subir</button>
            </form>

            @if (session('agregar'))
                <div class="alert alert-success mt-3">
                    {{session('agregar')}}
                </div>
            @endif
            
            <script type="text/javascript">
                $(document).ready(function () {

                    $("#rutaMeme").change(function () {
                        filePreview(this);
                    });


                    function filePreview(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#rutaMeme + embed').remove();
                                $('#rutaMeme').after('<embed src="'+e.target.result+'" width="450" height="300">');
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    $('#tag_search').on('keyup',function() {
                        var query = $(this).val(); 
                        $.ajax({ 
                            type:'GET',
                            url:"{{route('searchTag')}}",
                            data:{'nombreTag':query},
                            success:function(data){
                                $('#tag_list').html(data);
                            },
                            error:function(){
                                alert("Sucedio un error en la operación\nInicie Sesion si no lo ha hecho");
                            }
                        });
                    });

                    $(document).on('click', 'li', function(){
                        var nombreTag = $(this).data('value');
                        $('#tag_list').html("");

                        //Agrego el tag al array
                        var tagInputs = $('#tagInputs');
                        $('<input />', { 
                            type: 'hidden',
                            name: 'tags[]',
                            id: nombreTag+"_input",
                            value: nombreTag
                        }).appendTo(tagInputs);

                        //Agrego una span representativa del tag, con la opcion de eliminarlo del array
                        var tagSpans = $('#tagSpans');
                        if(nombreTag.length>50) nombreTag = nombreTag.substring(0, 50)+"...";
                        
                        $('<span />', {
                            class: 'badge badge-primary m-1',
                            text: nombreTag
                        }).appendTo(tagSpans) ;
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

@endsection