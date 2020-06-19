@extends('plantilla')

@section('content')

<div class="pt-5 row">
      
    <div class="col-md-12">

        {{--Form--}}
        <center>
        <div class="col-md-6">
            <h3 class="text-center mb-4">Crear Cuenta</h3>

            <form action="{{route('storeUser')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo Electronico" required>
                </div>
                @error('correo')
                    <div class="alert alert-danger">
                        El correo Ya esta utilizado
                    </div>
                @enderror
                <div class="form-group">
                    <input type="text" name="nick" id="nick" class="form-control" placeholder="NickName" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="password" required>
                </div>
                <div class="form-group">
                    <input type="file" name="avatar" id="avatar" class="form-control">
                </div>

                <button type="submit" class="btn btn-success btn-block">Crear Cuenta</button>

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