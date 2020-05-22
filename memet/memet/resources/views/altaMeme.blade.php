@extends('plantilla')

@section('content')

<div class="row">
      
    <div class="col-md-12">

        {{--Form--}}
        <center>
        <div class="col-md-6">
            <h3 class="text-center mb-4">Subir Meme</h3>

            <form action="{{route('store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="rutameme">Seleccione una archivo para subir:</label>
                    <input type="file" name="rutameme" id="rutameme" placeholder="Meme" required>
                </div>
                @error('correo')
                    <div class="alert alert-danger">
                        Por favor seleccione una imagen o video para subir.
                    </div>
                @enderror

                <button type="submit" class="btn btn-success btn-block">Subir</button>

            </form>

            @if (session('agregar'))
                <div class="alert alert-success mt-3">
                    {{session('agregar')}}
                </div>
            @endif


        </div>
         {{--Fin Form--}}
        </center>

    </div>
   
</div>

@endsection