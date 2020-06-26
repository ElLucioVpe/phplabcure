@extends('plantilla')

@section('content')
<div class="pt-5 container">
    <center>
    <div class="col-md-5">
        <div class="card mx-auto">
            <div class="card-header bg-dark">
                <h3 class="text-center text-white">Login</h3>
            </div>
            <div class="card-body">
                <form class="form-signin" method="post" action="{{route('login')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Ingrese su mail</label>
                        <input type="email" name="correoUser" class="form-control" placeholder="Email" required="" autofocus=""/>
                    </div>
                    <div class="form-group">
                        <label>Ingrese su contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required=""/>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" class="btn btn-outline-primary" value="Iniciar Sesion" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    </center>
</div>
@endsection