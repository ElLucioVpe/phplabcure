
  <a id="show-sidebar" class="btn btn-sm btn-dark pt-5 bg-darker" style="z-index:1000;" href="#">
    <i class="fa fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper pt-5">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="#">Memet</a>
        <div id="close-sidebar">
          <i class="fa fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        @if($user = Auth::user())
        <div class="user-pic">
          <img class="img-responsive img-rounded" src="{{url('storage/avatar/'.$user->avatarUser)}}"
            alt="User picture">
        </div>
        @else
        <div class="user-pic">
          <img class="img-responsive img-rounded" src="{{url('storage/avatar/ninguno.png')}}"
            alt="User picture">
        </div>
        @endif
        <div class="user-info">
          @if($user = Auth::user())
            <span class="user-name">
              <strong>{{$user->nickUser}}</strong>
            </span>
            <span class="user-role">{{$user->tipoUser}}</span>
            <span class="user-status">
              <i class="fa fa-circle"></i>
              <span>En linea</span>
            </span>
          @else
            <span class="user-name">
              <strong><a href="/login" style="color:#b8bfce">Inicie Sesion</a></strong>
            </span>
            <span class="user-status">
              <i class="fa fa-circle" style="color:grey"></i>
              <span>Offline</span>
            </span>
          @endif
        </div>
      </div>
      <!-- sidebar-header  -->
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>General</span>
          </li>
          <li>
            <a href="/">
              <i class="fa fa-image"></i>
              <span>Memes</span>
            </a>
          </li>
          @if($user = Auth::user())
          <li>
            <a href="/perfilUser/{{$user->correoUser}}">
              <i class="fa fa-user"></i>
              <span>Ver Perfil</span>
            </a>
          </li>
          <li>
            <a href="/subirMeme">
              <i class="fa fa-upload"></i>
              <span>Subir Meme</span>
            </a>
          </li>
          @else
          <li>
            <a href="/login">
              <i class="fa fa-user"></i>
              <span>Ver Perfil</span>
            </a>
          </li>
          <li>
            <a href="/login">
              <i class="fa fa-upload"></i>
              <span>Subir Meme</span>
            </a>
          </li>
          @endif
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-caret-square-o-down"></i>
              <span>Suscripciones</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                @if($user = Auth::user())
                  <li>
                    <a href="/suscripciones/{{$user->correoUser}}">Ver todas</a>
                  </li>
                  @foreach($user->suscripcions as $sus)
                    @if(!$sus->ignora)
                    <li>
                      <a href="{{route('buscar', [$sus->Tag_nombreTag, 'true'])}}">{{$sus->Tag_nombreTag}}</a>
                    </li>
                    @endif
                  @endforeach
                @else
                <li>
                  <a href="#">Necesita iniciar sesion</a>
                </li>
                @endif
              </ul>
            </div>
          </li>
          @if($user = Auth::user())
          <li>
            <a href="javascript:logout()">
              <i class="fa fa-sign-out"></i>
              <span>Cerrar Sesion</span>
            </a>
          </li>
          @endif
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
  </nav>
  <!-- sidebar-wrapper  -->

<script>
    //Funciones de SideBar
    if($(window).width() < 1000) {
        $(".page-wrapper").removeClass("toggled");
    }
    jQuery(function ($) {

      $(".sidebar-dropdown > a").click(function() {
      $(".sidebar-submenu").slideUp(200);
      if (
      $(this)
        .parent()
        .hasClass("active")
      ) {
      $(".sidebar-dropdown").removeClass("active");
      $(this)
        .parent()
        .removeClass("active");
      } else {
      $(".sidebar-dropdown").removeClass("active");
      $(this)
        .next(".sidebar-submenu")
        .slideDown(200);
      $(this)
        .parent()
        .addClass("active");
      }
      });

      $("#close-sidebar").click(function() {
      $(".page-wrapper").removeClass("toggled");
      });
      $("#show-sidebar").click(function() {
      $(".page-wrapper").addClass("toggled");
      });

});
</script>

    
    