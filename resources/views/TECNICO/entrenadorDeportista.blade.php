@extends('master')
@section('script')
  @parent
    <script src="{{ asset('public/Js/buscar_personas.js') }}"></script>     
    <script src="{{ asset('public/Js/Tecnico/EntrenadoresDeportistas.js') }}"></script>
    <script src="{{ asset('public/Js/bootstrap-datepicker.js') }}"></script>   
    {{Html::style('public/Css/bootstrap-datepicker3.css')}}      
@stop  
@section('content')
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>VINCULACIÓN DE ENTRENADORES Y DEPORTISTAS</h3></center>
 <input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
    <div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
        <div class="content">
            <br>
            <center>
                <h4>Ingrese el número de cédula del entrenador al cual desea asignarle los deportistas, para la conformación del equipo de trabajo</h4>
            </center>
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Buscar entrenador</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">
                            <div id="alerta" class="col-xs-12" style="display:none;">
                              <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                Datos actualizados satisfactoriamente.
                              </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="input-group">                                        
                                    <input id="buscador" name="buscador" type="text" class="form-control" placeholder="Buscar" value="" onkeypress="return ValidaCampo(event);">
                                    <span class="input-group-btn">
                                        <button id="buscar" data-role="buscar" data-buscador="buscar-rud" class="btn btn-default" type="button">
                                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                        </button>
                                    </span>
                                </div>
                                <div tabindex="-1" id="mensaje-incorrectoB" class=" text-left alert alert-success alert-danger" role="alert" style="display: none; margin-top: 10px;">
                                    <strong>Error </strong> <span id="mensajeIncorrectoB"></span>
                                </div>
                            </div>
                            <div class="container" id="loading" style="display:none;">
                                <center><button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button></center>
                            </div>
                            <form id="registro" name="registro">
                                <div class="col-xs-12" id="tablaPersonas"></div>
                                <br>
                                <div class="col-xs-12">
                                    <ul id="personas"></ul>
                                    <li class="list-group-item" id="GestorDeportistas" style="display:none;">
                                        <div class="list-group-item">
                                            <h4>Datos del entrenador</h4>
                                            <br>
                                            <h5 class="list-group-item-heading" style="text-transform: uppercase;" id="Nombres">
                                            </h5>
                                            <div class="row">
                                                <div class="col-xs-12 col-md-4">
                                                    <div class="row">
                                                        <input type="hidden" id="Id_Persona" name="Id_Persona">
                                                        <div class="col-xs-12 col-sm-6 col-md-3"><small id="Identificacion"></small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                            
                                        <br> 
                                        <div class="row">
                                            <div class="form-group"  id="mensaje_evento1">
                                                <div id="alert_evento1"></div>
                                            </div>
                                        </div>
                                        <div class="row" align="right">
                                            <button type="button" class="btn btn-success" value="" name="AgregarDeportista" id="AgregarDeportista" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Agregar Deportista</button>
                                        </div>
                                        <div class="panel-body">
                                            <h4>Datos de los deportistas</h4>
                                            <br>
                                            <div id="deportistasEntrenadorD" name="deportistasEntrenadorD" style="display: none;"></div>
                                        </div>  
                                    </li>                                    
                                </div>
                                <div id="paginador" class="col-xs-12"></div>                            
                            </div>                                
                        </form>
                    </div>
                </div>
            </div>
        </div>        
<!-- ------------------------------------------------------------------------------------ -->
    <div class="modal fade bs-example-modal-lg" id="loading" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <center><button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button></center>
                </div>
            </div>
        </div>
    </div>

<!-- ---------------------------AGREGAR CERTAMEN--------------------------- -->
    <div class="modal fade bs-example-modal-lg" id="VincularDeportistaD" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Vincular Deportistas</h4>
                 </div>
                <form id="VincularDeportistaF" name="VincularDeportistaF">  
                    <br><br>
                    <input type="hidden" id="Id_Entrenador" name="Id_Entrenador">
                    <div class="content">
                        <div class="panel">                                               
                            <ul class="list-group" id="seccion_uno" name="seccion_uno">
                               <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Deportistas</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <select class="form-control selectpicker" name="Deportistas" id="Deportistas" data-live-search="true">
                                                <option value="">Seleccionar</option>           
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <center>
                                                <button type="button" class="btn btn-success ver" value="" name="AgregarVinculo" id="AgregarVinculo" >Agregar deportista</button>
                                            </center>
                                        </div>
                                    </div>
                                </li>
                            </ul>   
                            <div class="form-group"  id="mensaje_vinculacion" style="display: none;">
                                <div id="alert_vinculacion"></div>
                            </div>                         
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
<th><center>DEPORTE</center></th>