@extends('plantilla')

@section('content')

<div class="row">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <div class="col-md-12">

        {{--Form--}}
        <center>
        <div class="col-md-6">
            <h3 class="text-center mb-4">Subir Meme</h3>

            <form action="{{route('storeMeme')}}" method="POST" enctype="multipart/form-data" id="subirMeme">
                <div class="form-group">
                    <label for="titulo">Titulo:</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Nuevo Meme">
                </div>
                
                @csrf
                <div class="form-group">
                    <label for="rutaMeme">Seleccione una archivo para subir:</label>
                    <input type="file" name="rutaMeme" id="rutaMeme" placeholder="Meme" required>
                    <embed id="memeFile" src="" width="450" height="300" hidden>
                </div>
                @error('correo')
                    <div class="alert alert-danger">
                        Por favor seleccione una imagen o video para subir.
                    </div>
                @enderror
            
                <div class="form-group">
                    <label for="tags">Tag/s:</label>
                    <input type="text" name="tags" id="tags" placeholder="Tag/s">
                </div>

                <input type="hidden" name="correoUser" id="correoUser" value="estebanleivas103@gmail.com">

                <button type="submit" class="btn btn-success btn-block">Subir</button>
            </form>

            @if (session('agregar'))
                <div class="alert alert-success mt-3">
                    {{session('agregar')}}
                </div>
            @endif
            
            <script>
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
            </script>

        </div>
         {{--Fin Form--}}
        </center>

    </div>
   
</div>

@endsection