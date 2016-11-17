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
                                    <button type="button" class="btn btn-info ver VerModificar" value="{{$Evento['Id']}}" name="VerModificar" id="VerModificar" ><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>Modificar evento</button>
                                    <button type="button" class="btn btn-danger ver VerEliminar" value="{{$Evento['Id']}}" name="VerEliminar" id="VerEliminar" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar evento</button>
                                </center>
                            </td>
                        </tr>
                    @endforeach  
                    </tbody> 
                </table>
                <form id="creaEventoF" name="creaEventoF" style="display:none;">  
                <input class="form-control" type="hidden" name="Id_Evento" id="Id_Evento">     
                    <br><br>
                    <div class="content">
                        <div id="Titulo" style="text-align:center;">                            
                        </div>  
                        <!-- ---------------------------PASO 1--------------------------- -->
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
                                                @foreach($ClasificacionDeportista as $ClasificacionDeportista)
                                                    <option value="{{ $ClasificacionDeportista['Id'] }}">{{ $ClasificacionDeportista['Nombre_Clasificacion_Deportista'] }}</option>
                                                @endforeach                                                   
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Tipo nivel</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <select name="Tipo_Nivel_Id" id="Tipo_Nivel_Id" class="form-control">
                                                <option value="">Seleccionar</option>   
                                                @foreach($TipoNivel as $TipoNivel)
                                                    <option value="{{ $TipoNivel['Id'] }}">{{ $TipoNivel['Nombre_Tipo_Nivel'] }}</option>
                                                @endforeach                                                      
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Nombre del evento</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input class="form-control" type="text" name="Nombre_Evento" id="Nombre_Evento">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <center>
                                                <button type="button" class="btn btn-success ver" value="" name="Agregar" id="Agregar" style="display:none;" >Agregar evento</button>
                                                <button type="button" class="btn btn-info ver" value="" name="Modificar" id="Modificar" style="display:none;">Modificar evento</button>
                                            </center>
                                        </div>
                                    </div>
                                </li>
                            </ul>                            
                        </div>
                    </div>
                </form>
                <form id="eliminaEventoF" name="eliminaEventoF" style="display:none;">  
                <input class="form-control" type="hidden" name="Id_EventoE" id="Id_EventoE">     
                    <br><br>
                    <div class="content">
                        <div id="TituloE" style="text-align:center;">  <h3>Eliminar evento</h3>  </div>  
                        <!-- ---------------------------PASO 1--------------------------- -->
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
                </form>
                <div class="form-group"  id="mensaje_evento" style="display: none;">
                    <div id="alert_evento"></div>
                </div>
            </div>
        </div>
    </div>    
@stop