@extends('plantilla')

@section('content')

@if($user = Auth::user())

 @if($user->correoUser == $userActualizar->correoUser || $user->tipoUser == 'Admin')
<div class="pt-5 row">
    <div class="col-md-12">
        <center>
        <div class="col-md-8">
            <div class="card mx-auto">
                <div class="card-header bg-dark">
                    <h3 class="text-center text-white">Edita Tu Perfil {{$userActualizar->nickUser}}</h3>
                </div>
                <div class="card-body">
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
                        <button type="submit" class="btn btn-outline-success btn-block">Modificar</button>

                    </form>
                    <hr/>
                    <center>
                    <form action="{{route('eliminarUser', $userActualizar->correoUser)}}" method="POST" class="d-inline" onsubmit="return confirm('¿Esta seguro que desea eliminar su cuenta?');">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger mx-auto">Eliminar Cuenta</button>
                    </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
    @if (session('update'))
    <div class="alert alert-success mt-3">
        {{session('update')}}
    </div>
    @endif
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