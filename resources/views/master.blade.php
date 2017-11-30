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
          <link rel="stylesheet" href="{{ asset('public/Css/jquery.dataTables.min.css') }}" media="screen">    
          <link rel="stylesheet" href="{{ asset('public/Css/buttons.dataTables.min.css') }}" media="screen">    
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
         


           <style type="text/css">
              .glyphicon-refresh-animate {
                  -animation: spin .7s infinite linear;
                  -webkit-animation: spin2 .7s infinite linear;
              }

              @-webkit-keyframes spin2 {
                  from { -webkit-transform: rotate(0deg);}
                  to { -webkit-transform: rotate(360deg);}
              }
              .imagen-error{
                border-radius:5px;
                border: solid;
                border-color: #b94a48;
                border-width: 1px;
              }
          </style>
           <style type="text/css">
              .glyphicon-refresh-animate {
                  -animation: spin .7s infinite linear;
                  -webkit-animation: spin2 .7s infinite linear;
              }

              @-webkit-keyframes spin2 {
                  from { -webkit-transform: rotate(0deg);}
                  to { -webkit-transform: rotate(360deg);}
              }
          </style>
          <style type="text/css">
              input, select, textarea{
                 text-transform: uppercase;
              }
          </style> 
      @show
      @section('script')
          <script src="{{ asset('public/Js/jquery.js') }}"></script>
          <script src="{{ asset('public/Js/jquery-ui.js') }}"></script>
          <script src="{{ asset('public/Js/jquery.dataTables.min.js') }}"></script>
          <script src="{{ asset('public/Js/dataTables.buttons.min.js') }}"></script>
          <script src="{{ asset('public/Js/buttons.flash.min.js') }}"></script>
          <script src="{{ asset('public/Js/jszip.min.js') }}"></script>
          <script src="{{ asset('public/Js/pdfmake.min.js') }}"></script>
          <script src="{{ asset('public/Js/vfs_fonts.js') }}"></script>
          <script src="{{ asset('public/Js/buttons.html5.min.js') }}"></script>
          <script src="{{ asset('public/Js/buttons.print.min.js') }}"></script>
          <script src="{{ asset('public/Js/bootstrap.min.js') }}"></script>
          <script src="{{ asset('public/Js/main.js') }}"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>
        

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
                  
                      <li class=”{{ Request::is( 'persona_tipo') ? 'active' : '' }}”><a href="{{ URL::to( 'persona_tipo') }}">Asignación tipo persona</a></li>                  
                  
                      <li class=”{{ Request::is( 'persona_permiso') ? 'active' : '' }}”><a href="{{ URL::to( 'persona_permiso') }}">Asignación de permisos</a></li>                  
                  
                      <li class=”{{ Request::is( 'metodologo_agrupacion') ? 'active' : '' }}”><a href="{{ URL::to( 'metodologo_agrupacion') }}">Administración Metodólogos</a></li>                  
                  
                </ul>
              </li>
              <li>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">SIAB <span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="themes">
                  
                      <li><a href="{{ URL::to( 'rud') }}">Registro único de deportistas (RUD)</a></li>

                      <!--<li><a href="{{ URL::to( 'irrd') }}">Ingreso, retiro y reingreso de deportistas</a></li>-->
                      

                      <li><a href="{{ URL::to( 'psico') }}">Valoración psicosocial</a></li>
                  
                      <li><a href="{{ URL::to( 'domicilio') }}">Visita domiciliaria</a></li>
                  
                      <li><a href="{{ URL::to( 'actividad') }}">Actividades de intervención</a></li>
                  
                      <li><a href="{{ URL::to( 'suministros') }}">Suministros, apoyos y servicios</a></li>
                  
                </ul>
              </li>
              <li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">TÉCNICO <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#" style="color:#1995dc">ENTRENADORES</a></li>    
                      <li class=”{{ Request::is( 'rue') ? 'active' : '' }}”><a href="{{ URL::to( 'rue') }}">Registro único de entrenadores (RUE)</a></li>                  
                      <li class=”{{ Request::is( 'VEntrenadorDeportista') ? 'active' : '' }}”><a href="{{ URL::to( 'VEntrenadorDeportista') }}">Vinculación de entrenadores y deportistas</a></li>                  
                      <li class="divider"></li>
                      <li><a href="#" style="color:#1995dc">REGISTRO LÍNEA DEPORTIVA</a></li>                      
                      
                        <li class=”{{ Request::is( 'configuracion') ? 'active' : '' }}”><a href="{{ URL::to( 'configuracion') }}">Configuración</a></li>
                      
                                            
                      <li class="divider"></li>
                      <li><a href="#" style="color:#1995dc">PLANES DE ENTRENAMIENTO</a>
                         <li class=”{{ Request::is( 'registro_plan') ? 'active' : '' }}”><a href="{{ URL::to( 'registro_plan') }}">Gestor de planes de entrenamiento</a></li>                       
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="#" style="color:#1995dc">ASISTENCIA DE ENTRENAMIENTO</a>
                        <li class=”{{ Request::is( 'gestor_entrenamientos') ? 'active' : '' }}”><a href="{{ URL::to( 'gestor_entrenamientos') }}">Gestor de entrenamientos</a></li>
                      </li>                                            
                      <li class="divider"></li>
                      <li><a href="#" style="color:#1995dc">CALENDARIO DE COMPETENCIAS</a></li>                      
                      
                        <li class=”{{ Request::is( 'eventos') ? 'active' : '' }}”><a href="{{ URL::to( 'eventos') }}">Gestor de eventos</a></li>
                        <li class=”{{ Request::is( 'certamen') ? 'active' : '' }}”><a href="{{ URL::to( 'certamen') }}">Gestor de certámenes deportivos</a></li>
                        <li class=”{{ Request::is( 'asignacion_pruebas') ? 'active' : '' }}”><a href="{{ URL::to( 'asignacion_pruebas') }}">Asignación de pruebas deportivas</a></li>
                        <li class=”{{ Request::is( 'denegacion_pruebas') ? 'active' : '' }}”><a href="{{ URL::to( 'denegacion_pruebas') }}">Denegación de pruebas deportivas</a></li>
                        <li class=”{{ Request::is( 'mis_pruebas') ? 'active' : '' }}”><a href="{{ URL::to( 'registro_resultados') }}">Mis pruebas deportivas</a></li>
                      
                      
                      <li class="divider"></li>
                      <li><a href="#" style="color:#1995dc">TEST PEDAGÓGICOS</a></li>                                            
                        <li class=”{{ Request::is( 'gestor_test') ? 'active' : '' }}”><a href="{{ URL::to( 'gestor_test') }}">Gestor de Test Pedagógicos</a></li>
                        <li class=”{{ Request::is( 'registro_test_deportista') ? 'active' : '' }}”><a href="{{ URL::to( 'registro_test_deportista') }}"> Asignación Test a Deportista</a></li>

                      <li class="divider"></li>
                      <li><a href="#" style="color:#1995dc">VISITAS TÉCNICAS</a></li>                                            
                      <li class="divider"></li>
                      <!--<li class="divider"></li>
                      <li class=”{{ Request::is( 'configuracion') ? 'active' : '' }}”>
                        <a href="{{ URL::to( 'configuracion') }}">Agrupación</a>
                      </li>                      
                      <li class=”{{ Request::is( 'deporte') ? 'active' : '' }}”>
                        <a href="{{ URL::to( 'deporte') }}">Deporte</a>
                      </li>
                      <li class=”{{ Request::is( 'modalidad') ? 'active' : '' }}”>
                        <a href="{{ URL::to( 'modalidad') }}">Modalidad</a>
                      </li>

                      <li class=”{{ Request::is('rama') ? 'active' : '' }}”>
                        <a href="{{ URL::to( 'rama') }}">Rama</a>
                      </li>

                      <li class=”{{ Request::is('categoria') ? 'active' : '' }}”>
                        <a href="{{ URL::to( 'categoria') }}">Categoria</a></li>
                      <li><a href="#">Prueba/División</a></li>-->
                    </ul>
                </li>
              </li>
              <li>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">UCAD <span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="themes">
                  <li><a href="#" style="color:#1995dc">HISTORIA CLINICA</a></li>
                  <li class="divider"></li>
                  <li class=”{{ Request::is( 'historia_inicial') ? 'active' : '' }}”><a href="{{ URL::to( 'historia_inicial') }}">Registro Consulta Medica</a></li>
                </ul>
              </li>

              <li>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">REPORTES <span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="themes">
                  <li><a href="#" style="color:#1995dc">DEPORTISTAS</a></li>
                        <li class=”{{ Request::is( 'total_deportistas') ? 'active' : '' }}”><a href="{{ URL::to( 'total_deportistas') }}">Total Deportistas</a></li>

                      <li class="divider"></li>
                </ul>
              </li>
            </ul>

            <!--<form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Buscar">
                </div>                
                <button type="submit" class="btn btn-default">Ir</button>
            </form>-->

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
                <p class="lead"><h1>Área de Deportes</h1></p>
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





