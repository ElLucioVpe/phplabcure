@extends('plantilla')

@section('content')

@if($user = Auth::user())

 @if($user->correoUser == $userActualizar->correoUser)

    <h3 class="text-center mb-3 pt-3">Editar Tu Perfil {{$userActualizar->correoUser}}</h3>

        <form action="{{route('updateUser', $userActualizar->correoUser)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <input type="text" name="nickUser" id="nickUser" class="form-control" value=" {{$userActualizar->nickUser}}">
            </div>
            <div class="form-group">
                <input type="password" name="passwordUser" id="passwordUser" class="form-control" value=" {{$userActualizar->passwordUser}}">
            </div>
            <div>
                <center>
                <img src="{{ url('/') }}/profileImages/{{$userActualizar->avatarUser}}" height="400" width=auto>
                </center>
            </div>
            <div class="form-group">
                <input type="file" name="avatar" id="avatar" class="form-control">
            </div>
           

            <button type="submit" class="btn btn-success btn-block">Modificar</button>

        </form>
 
    <form action="{{route('eliminarUser', $userActualizar->correoUser)}}" method="POST" class="d-inline">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">Eliminar Cuenta</button>
    </form>

    @if (session('update'))
    <div class="alert alert-success mt-3">
        {{session('update')}}
    </div>
    @endif

 @else
    <script type="text/javascript">
        window.location = "{{ url('/index') }}";
    </script>
 @endif
@else
    <script type="text/javascript">
        window.location = "{{ url('/index') }}";
    </script>
@endif
@endsection