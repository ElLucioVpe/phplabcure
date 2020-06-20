<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-darker">
    <a class="navbar-brand" href="/">Memet</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/subirMeme">Subir meme</a>
            </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0 ml-auto mr-2">
            <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Buscar">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
        <ul class="navbar-nav">
            @if(Auth::guest())
                <li class="nav-item active">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/registro">Registrate!</a>
                </li>
            @elseif($user = Auth::user())
                <li class="nav-item active">
                    <a class="nav-link" href="/perfilUser/{{$user->correoUser}}">{{$user->nickUser}}</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="javascript:logout()">Cerrar Sesion</a>
                </li>

                <script>
                    function logout() {
                        $.ajax({
                            method: 'POST',
                            url: "{{ route('logout') }}",
                            success: function(){
                                console.log("Se cerro sesion con exito");
                                window.location.href = "{{ route('index') }}";
                            },
                            error: function() {
                                console.log("AJAX error: Hubo un error inesperado al cerrar sesion");
                            }
                        });
                    }
                </script>
            @endif
        </ul>
    </div>
</nav>
