<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Microblogging network example to learn the Laravel PHP framework">
    <meta name="author" content="Jose Trezza">

    <title>@yield('title', '¡Bienvenido a Gaia!')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/global.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/jtrezza-lightbox.css')}}" rel="stylesheet">
    
    <!-- jQuery & Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/mustache.js/0.7.2/mustache.min.js"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/global.js')}}"></script>
    <script src="{{asset('assets/js/jtrezza.lightBox.js')}}"></script>
    @yield('head')
    <style type="text/css">
      .jumbotron{
        background-image: url("{{asset('assets/images/green_funeral.jpg')}}");
      }
    </style>
  </head>

  <body>
    <!-- <div style="height: 50px; background-color: #428bca; text-align:center; vertical-align: middle; color: #FFF !important; font-size:30pt 16pt !important; font-weight:bold; padding-top:15px;">¡Feliz cumpleaños Kathe!</div> -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{url('/')}}">Gaia</a>
        </div>
        <?php if (!Auth::check()): ?>
        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form" method="POST" action="{{url('/login')}}">
            <div class="form-group">
              <input type="text" placeholder="Username" class="form-control" name="username">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-success">Entrar</button>
          </form>
        </div><!--/.navbar-collapse -->
        <?php else: ?>

        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php $user = Auth::user()->username; ?>
            <li id="menu_inicio"><a href="{{url('/timeline')}}"><span class="glyphicon glyphicon-home">&nbsp;</span>Inicio</a></li>
            <li id="menu_profile"><a href="{{url('/profile',$user)}}"><span class="glyphicon glyphicon-user">&nbsp;</span>Perfil</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">       
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cuenta <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Editar perfil</a></li>
                <li><a href="#" onclick="requestNotificationPermission()">Activar notif. de escritorio</a></li>
                <li><a href="{{url('/logout')}}">Salir</a></li>
              </ul>              
            </li>
            <li></li>
          </ul>

          

          <form role="search" class="navbar-right navbar-form" method="post" action="{{url('users/search')}}">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Buscar usuarios" name="busqueda">
            </div>
            <button type="submit" class="btn btn-default glyphicon glyphicon-search"></button>&nbsp;
            <a href="#" onclick="mostrarCajaPost();" class="btn btn-primary glyphicon glyphicon-pencil"></a>
          </form>
        </div><!--/.navbar-collapse -->
        <?php endif; ?>
      </div>
    </div>
    
    @yield('content')

      <hr>

      <footer class="text-center">
        <p> &copy; 2014 jtrezza</p>
      </footer>
      @include('prompt')
      <?php if(Auth::check()): ?>
        <input type="hidden" id="hdd_usuario_id" value="{{Auth::user()->id}}"/>
        <input type="hidden" id="hdd_ruta_post" value="{{url('posts')}}"/>
      <?php endif; ?>
  </body>
</html>