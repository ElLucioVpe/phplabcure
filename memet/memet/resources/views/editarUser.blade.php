@extends('plantilla')

@section('content')

@if($user = Auth::user())

 @if($user->correoUser == $userActualizar->correoUser || $user->tipoUser == 'Admin')

    <h3 class="text-center mb-3 pt-3">Edita Tu Perfil {{$userActualizar->nickUser}}</h3>

    <div class="mx-auto">
        <form action="{{route('updateUser', $userActualizar->correoUser)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <input type="text" name="nickUser" id="nickUser" class="form-control" value=" {{$userActualizar->nickUser}}">
            </div>
            <div class="form-group">
                <input type="password" name="passwordUser" id="passwordUser" class="form-control" placeholder="***************">
            </div>
            <div>
                <center>
                    <img src="{{ url('storage/avatar/'.$userActualizar->avatarUser) }}" height="150" width=auto>
                </center>
            </div>
            <div class="form-group">
                <input type="file" name="avatar" id="avatar" class="form-control">
            </div>
            <button type="submit" class="btn btn-success btn-block">Modificar</button>

        </form>
        <center>
        <form action="{{route('eliminarUser', $userActualizar->correoUser)}}" method="POST" class="d-inline" onsubmit="return confirm('¿Esta seguro que desea eliminar su cuenta?');">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger mx-auto">Eliminar Cuenta</button>
        </form>
        </center>
    </div>
    @if (session('update'))
    <div class="alert alert-success mt-3">
        {{session('update')}}
    </div>
    @endif

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