@extends('plantilla')

@section('content')

@if($user = Auth::user())

 @if($user->correoUser == $correoUser || $user->tipoUser == 'Admin')
 <div class="pt-5 row">
    <div class="col-md-8 mx-auto">
        <div class="card text-center mx-auto">
            <div class="card-header bg-dark">
                <h2 class="text-white">Suscripciones</h2>
            </div>
            <div class="card-body">

                <table class="table">
                    <tr>
                        <th>Tag</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach ($suscripciones as $sus)
                        <tr>
                            <td>{{$sus->Tag_nombreTag}}</td>
                            @if ($sus->ignora)
                                <td>Ignorado</td>
                            @else
                                <td>Seguido</td>
                            @endif
                            <td>
                                <form action="{{route('eliminarSuscripcion',['correoUser'=>$sus->User_correoUser, 'tag'=>$sus->Tag_nombreTag])}}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </table>
                @if (session('eliminarSuscripcion'))
                    <div class="alert alert-success mt-3">
                        {{session('eliminarSuscripcion')}}
                    </div>
                @endif
            
            </div>
        </div>
    </div>
 </div>
 @else
    <script type="text/javascript">
        window.location = "{{ route('index') }}";
    </script>
 @endif
@else
    <script type="text/javascript">
        window.location = "{{ route('index') }}";
    </script>
@endif   
@endsection