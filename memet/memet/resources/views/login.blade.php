@extends('plantilla')

@section('content')
<div class="pt-5 container">
    <form method="post" action="{{route('login')}}">
        {{ csrf_field() }}
        <div class="form-group">
        <label>Enter Email</label>
        <input type="email" name="correoUser" class="form-control" />
        </div>
        <div class="form-group">
        <label>Enter Password</label>
        <input type="password" name="password" class="form-control" />
        </div>
        <div class="form-group">
        <input type="submit" name="login" class="btn btn-primary" value="Login" />
        </div>
   </form>
</div>
@endsection