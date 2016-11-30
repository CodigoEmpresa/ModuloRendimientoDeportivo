@extends('master')

@section('script')
    @parent
    <script src="{{ asset('public/Js/Tecnico/evento.js') }}"></script> 
    @stop

@section('content')
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>GESTOR DE EVENTOS DEPORTIVOS</h3></center>
 <input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
    <div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
        <div class="content">
            <div align="right">
                <button type="button" class="btn btn-success" name="Enviar" id="Crear_Nuevo">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Crear evento nuevo
                </button>
            </div>
            <br><br>            
            <div class="panel-body">
                <table id="eventosTabla" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><center>EVENTO DEPORTIVO</center></th>
                            <th><center>CLASIFICACIÓN</center></th>
                            <th><center>NIVEL</center></th>
                            <th><center>OPCIONES</center></th>
                        </tr>
                    </thead>
                    <tbody> 
                    @foreach($Evento as $Evento)
                        <tr>
                            <td>{{ $Evento['Nombre_Evento'] }}</td>
                            <td>{{ $Evento->clasificacionDeportiva['Nombre_Clasificacion_Deportista'] }}</td>
                            <td>{{ $Evento->tipoNivel['Nombre_Tipo_Nivel'] }}</td>
                            <td>
                                <center>
                                    <button type="button" class="btn btn-info ver VerModificar" value="{{$Evento['Id']}}" name="VerModificar" id="VerModificar" ><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>Ver Evento</button>
                                    <!--<button type="button" class="btn btn-danger ver VerEliminar" value="{{$Evento['Id']}}" name="VerEliminar" id="VerEliminar" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar evento</button>-->
                                </center>
                            </td>
                        </tr>
                    @endforeach  
                    </tbody> 
                </table>
                <!-- ---------------------------AGREGAR EVENTO--------------------------- -->
                <div class="modal fade bs-example-modal-lg" id="creaEventoD" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Crear Nuevo Evento</h4>
                             </div>
                            <form id="creaEventoF" name="creaEventoF" style="display:none;">  
                            <input class="form-control" type="hidden" name="Id_Evento" id="Id_Evento">     
                                <br><br>
                                <div class="modal-body">                                 
                                    <div class="panel">                                               
                                        <ul class="list-group" id="seccion_uno" name="seccion_uno">
                                           <li class="list-group-item">
                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label">Clasificación deportiva</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="Clasificacion_Id" id="Clasificacion_Id" class="form-control">
                                                            <option value="">Seleccionar</option>     
                                                            @foreach($ClasificacionDeportista as $ClasificacionDeportistas)
                                                                <option value="{{ $ClasificacionDeportistas['Id'] }}">{{ $ClasificacionDeportistas['Nombre_Clasificacion_Deportista'] }}</option>
                                                            @endforeach                                                   
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label">Tipo nivel</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="Tipo_Nivel_Id" id="Tipo_Nivel_Id" class="form-control">
                                                            <option value="">Seleccionar</option>   
                                                            @foreach($TipoNivel as $TipoNivels)
                                                                <option value="{{ $TipoNivels['Id'] }}">{{ $TipoNivels['Nombre_Tipo_Nivel'] }}</option>
                                                            @endforeach                                                      
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label">Nombre del evento</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input class="form-control" type="text" style="text-transform: uppercase;" name="Nombre_Evento" id="Nombre_Evento">
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <center>
                                                            <button type="button" class="btn btn-success ver" value="" name="Agregar" id="Agregar">Agregar evento</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        </center>
                                                    </div>                                                
                                                </div>
                                                <div class="row">
                                                    <div class="form-group"  id="mensaje_evento1">
                                                        <div id="alert_evento1"></div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>                            
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ---------------------------EVENTO DATOS--------------------------- -->
                <div class="modal fade bs-example-modal-lg" id="verEventoD" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="TituloE"></h4>
                             </div>
                            <ul class="nav nav-tabs">
                              <li role="presentation" id="InicioEventoLi" class="active"><a id="InicioEvento">Datos</a></li>
                              <li role="presentation" id="DeportesEventoLi" ><a id="DeportesEvento" >Deportes</a></li>
                            </ul>

                        <form id="verEventoF" name="verEventoF" style="display:none;">  
                        <input class="form-control" type="hidden" name="Id_EventoDatos" id="Id_EventoDatos">     
                        <input class="form-control" type="text" style="text-transform: uppercase;" name="Id_ClasificacionDatos" id="Id_ClasificacionDatos">     
                            <div class="modal-body">                                 
                                <div><center><h3>Datos del evento</h3></center></div>
                                <div class="panel">                                               
                                    <ul class="list-group" id="seccion_uno" name="seccion_uno">
                                       <li class="list-group-item">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label">Clasificación deportiva</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <select name="Clasificacion_IdDatos" id="Clasificacion_IdDatos" class="form-control">
                                                        <option value="">Seleccionar</option>     
                                                        @foreach($ClasificacionDeportista as $ClasificacionDeportista)
                                                            <option value="{{ $ClasificacionDeportista['Id'] }}">{{ $ClasificacionDeportista['Nombre_Clasificacion_Deportista'] }}</option>
                                                        @endforeach                                                   
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label">Tipo nivel</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <select name="Tipo_Nivel_IdDatos" id="Tipo_Nivel_IdDatos" class="form-control">
                                                        <option value="">Seleccionar</option>   
                                                        @foreach($TipoNivel as $TipoNivel)
                                                            <option value="{{ $TipoNivel['Id'] }}">{{ $TipoNivel['Nombre_Tipo_Nivel'] }}</option>
                                                        @endforeach                                                      
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label">Nombre del evento</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input class="form-control" type="text" style="text-transform: uppercase;" name="Nombre_EventoDatos" id="Nombre_EventoDatos">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <center>
                                                        <button type="button" class="btn btn-primary ver" value="" name="Modificar" id="Modificar">Modificar evento</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                    </center>
                                                </div>                                                
                                            </div>
                                            <div class="row">
                                                <div class="form-group"  id="mensaje_evento2">
                                                    <div id="alert_evento2"></div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>                            
                                </div>
                            </div>
                        </form>

                        <form id="deporteEventoF" name="deporteEventoF" style="display:none;">  
                            <input class="form-control" type="hidden" name="Id_EventoDep" id="Id_EventoDep">     
                            <div class="modal-body">    
                                <div><center><h3>Deportes relacionados al evento</h3></center></div>                             
                                <div class="panel">  
                                    <div class="content">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                              <h3 class="panel-title">Agregar deporte a este evento</h3>
                                            </div>
                                            <div class="panel-body">
                                                <ul class="list-group" id="seccion_uno" name="seccion_uno">
                                                   <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail" class="control-label">Deporte</label>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <select name="Deporte_Id" id="Deporte_Id" class="selectpicker form-control" data-live-search="true">
                                                                    <option value="">Seleccionar</option>                                                                         
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <button type="button" class="btn btn-success ver" value="" name="AgregarDeporte" id="AgregarDeporte">Agregar Deporte</button>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>        

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group"  id="mensaje_evento3">
                                            <div id="alert_evento3"></div>
                                        </div>
                                    </div>
                                    <div class="panel">  
                                    <div class="content">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                              <h3 class="panel-title">Lista de deportes relacionados a este evento</h3>
                                            </div>
                                            <div class="panel-body">
                                                <table id="deportesTabla" class="display nowrap" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th><center>DEPORTE</center></th>
                                                            <th><center>CLASIFICACIÓN</center></th>
                                                            <th><center>OPCIÓN</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>                                         
                                                    </tbody> 
                                                </table>
                                            </div>
                                        </div>
                                    </div>         
                                                                                                        
                                    <!--<ul class="list-group" id="seccion_uno" name="seccion_uno">
                                       <li class="list-group-item">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label">Clasificación deportiva</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <select name="Clasificacion_IdDatos" id="Clasificacion_IdDatos" class="form-control">
                                                        <option value="">Seleccionar</option>     
                                                        @foreach($ClasificacionDeportista as $ClasificacionDeportista)
                                                            <option value="{{ $ClasificacionDeportista['Id'] }}">{{ $ClasificacionDeportista['Nombre_Clasificacion_Deportista'] }}</option>
                                                        @endforeach                                                   
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label">Tipo nivel</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <select name="Tipo_Nivel_IdDatos" id="Tipo_Nivel_IdDatos" class="form-control">
                                                        <option value="">Seleccionar</option>   
                                                        @foreach($TipoNivel as $TipoNivel)
                                                            <option value="{{ $TipoNivel['Id'] }}">{{ $TipoNivel['Nombre_Tipo_Nivel'] }}</option>
                                                        @endforeach                                                      
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label">Nombre del evento</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input class="form-control" type="text" style="text-transform: uppercase;" name="Nombre_EventoDatos" id="Nombre_EventoDatos">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <center>
                                                        <button type="button" class="btn btn-info ver" value="" name="Modificar" id="Modificar">Modificar evento</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                    </center>
                                                </div>                                                
                                            </div>
                                            <div class="row">
                                                <div class="form-group"  id="mensaje_evento1">
                                                    <div id="alert_evento1"></div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>  -->                          
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--<form id="eliminaEventoF" name="eliminaEventoF" style="display:none;">  
                <input class="form-control" type="hidden" name="Id_EventoE" id="Id_EventoE">     
                    <br><br>
                    <div class="content">
                        <div id="TituloE" style="text-align:center;">  <h3>Eliminar evento</h3>  </div>                          
                        <div class="panel">                                               
                            <ul class="list-group" id="seccion_uno" name="seccion_uno">
                               <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-9">
                                            <label for="inputEmail" class="control-label">
                                                ¿Desea eliminar el evento de forma permanente del sistema?. <br>Tenga en cuenta que si elimina un evento se eliminará por defecto todos los datos relacionados ha este evento. Si no esta seguro de este cambio por favor diríjase al administrador del sistema."
                                            </label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button type="button" class="btn btn-danger ver" value="" name="EliminarEvento" id="EliminarEvento">Eliminar evento</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>-->
               <!-- <div class="form-group"  id="mensaje_evento" style="display: none;">
                    <div id="alert_evento"></div>
                </div>-->
            </div>
        </div>
    </div>    
@stop