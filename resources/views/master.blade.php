<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />

      @section('style')
          <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
          <link rel="stylesheet" href="{{ asset('public/Css/jquery-ui.css') }}" media="screen">    
          <link rel="stylesheet" href="{{ asset('public/Css/bootstrap.min.css') }}" media="screen">   
          <link rel="stylesheet" href="{{ asset('public/Css/sticky-footer.css') }}" media="screen">    
      @show
      @section('script')
          <script src="{{ asset('public/Js/jquery.js') }}"></script>
          <script src="{{ asset('public/Js/jquery-ui.js') }}"></script>
          <script src="{{ asset('public/Js/bootstrap.min.js') }}"></script>
          <script src="{{ asset('public/Js/main.js') }}"></script>

          <meta name="csrf-token" content="{{ csrf_token() }}" />
          <script type="text/javascript">
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
          </script>
      @show

      <title>Módulo Rendimiento Deportivo</title>
  </head>

  <body>
      
       <!-- Menu Módulo -->
       <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <a href="/" class="navbar-brand">SIM</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Administración <span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="themes">
                  <li><a href="#" style="color:#1995dc">Gestor de personas</a></li>
                  <li class="divider"></li>
                  <li class=”{{ Request::is( 'personas') ? 'active' : '' }}”><a href="{{ URL::to( 'personas') }}">Gestión de personas</a></li>                  
                </ul>
              </li>
              <li>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">SIAB <span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="themes">
                  <li><a href="#" style="color:#1995dc">Gestor de entrenadores</a></li>
                  <li class="divider"></li>
                  <li><a href="rud">Registro único de deportistas</a></li>
                  <li><a href="psico">Valoración psicosocial</a></li>
                </ul>
              </li>
              <li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">TÉCNICO <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li class="divider"></li>
                      <li><a href="#">Configuración</a></li>
                      <li class="divider"></li>
                      <li class=”{{ Request::is( 'configuracion') ? 'active' : '' }}”>
                        <a href="{{ URL::to( 'configuracion') }}">Agrupación</a>
                      </li>
                      <li class=”{{ Request::is( 'deporte') ? 'active' : '' }}”>
                        <a href="{{ URL::to( 'deporte') }}">Deporte</a>
                      </li>
                      <li class=”{{ Request::is( 'modalidad') ? 'active' : '' }}”>
                        <a href="{{ URL::to( 'modalidad') }}">Modalidad</a>
                      </li>

                      <li><a href="#">Ramas</a></li>
                      <li><a href="#">Categoria</a></li>
                      <li><a href="#">Prueba/División</a></li>
                    </ul>
                </li>
              </li>
              <li>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">UCAD <span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="themes">
                  <li><a href="#">Default</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Sub-Item 1</a></li>
                </ul>
              </li>
            </ul>

            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Buscar">
                </div>                
                <button type="submit" class="btn btn-default">Ir</button>
            </form>

            <ul class="nav navbar-nav navbar-right">
              <li><a href="http://www.idrd.gov.co/sitio/idrd/" target="_blank">I.D.R.D</a></li>
              <li><a href="#">Cerrar Sesión</a></li>
            </ul>

          </div>
        </div>
      </div>
      <!-- FIN Menu Módulo -->
        
      <!-- Contenedor información módulo -->
      </br></br>
      <div class="container">
          <div class="page-header" id="banner">
            <div class="row">
              <div class="col-lg-8 col-md-7 col-sm-6">
                <h1>MÓDULO RENDIMIENTO DEPORTIVO</h1>
                <p class="lead"><h1>Área de deportes</h1></p>
              </div>
              <div class="col-lg-4 col-md-5 col-sm-6">
                 <div align="right"> 
                    <img src="public/Img/IDRD.JPG" width="50%" heigth="40%"/>
                 </div>                    
              </div>
            </div>
          </div>        
      </div>
      <!-- FIN Contenedor información módulo -->

      <!-- Contenedor panel principal -->
      <div class="container">
          @yield('content')
      </div>        
      <!-- FIN Contenedor panel principal -->
  </body>

</html>





