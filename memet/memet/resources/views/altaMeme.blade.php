@extends('plantilla')

@section('content')

<x-header/>

<div class="pt-5 container">

    <div class="row">

        <div class="col-md-12">

            {{--Form--}}
            <center>
            <div class="col-md-6">
                <h3 class="text-center mb-4">Subir Meme</h3>

                <form action="{{route('store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="rutaMeme">Seleccione una archivo para subir:</label>
                        <input type="file" name="rutaMeme" id="rutaMeme" placeholder="Meme" required>
                    </div>
                    @error('correo')
                        <div class="alert alert-danger">
                            Por favor seleccione una imagen o video para subir.
                        </div>
                    @enderror

                    <div class="form-group">
                        <label for="tags">Tag/s:</label>
                        <input type="text" name="tags" id="tags" placeholder="Meme">
                    </div>

                    <input type="hidden" name="correoUser" id="correoUser" value="usuarioSesion">

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

</div>

@endsection
