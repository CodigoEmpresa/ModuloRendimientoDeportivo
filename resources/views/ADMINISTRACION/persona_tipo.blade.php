@extends('master')
@section('script')
  @parent
    <script src="{{ asset('public/Js/buscar_personas.js') }}"></script>     
    <script src="{{ asset('public/Js/ADMINISTRACION/persona_tipo.js') }}"></script>
    <script src="{{ asset('public/Js/bootstrap-datepicker.js') }}"></script>   
    {{Html::style('public/Css/bootstrap-datepicker3.css')}}      
@stop  
@section('content')
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>ASIGNACIÓN DE TIPO PERSONA</h3></center>
 <input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
    <div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
        <div class="content">
            <br>
            <center>
                <h4>Ingrese el número de cédula de la persona a la cual le va a gestionar los "Tipos"</h4>
            </center>
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Buscar persona</h3>
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
                            <form id="registro" name="registro">
                                <div class="col-xs-12"><br></div>
                                    <div class="col-xs-12">
                                        <ul id="personas"></ul>
                                        <li class="list-group-item" id="AsignarPersonas" style="display:none;">
                                            <div class="list-group-item">
                                                <h5 class="list-group-item-heading" style="text-transform: uppercase;" id="Nombres">
                                                </h5>
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-4">
                                                        <div class="row">
                                                            <input type="hidden" id="Id_Persona" name="Id_Persona">
                                                            <div class="col-xs-12 col-sm-6 col-md-3"><small id="Identificacion"></small></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12 col-md-4">
                                                        <div class="row">
                                                            <label class="control-label" for="Id_TipoDocumento">Tipo de persona</label>
                                                            <select name="Tipo_Persona" id="Tipo_Persona" class="form-control">
                                                                <option value="">Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-md-4">
                                                        <div class="form-group text-center">
                                                            <button type="button" class="btn btn-primary" id="AgregarTipo">Agregar</button>
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
                                            <div class="panel-body">
                                                <table id="personaTipoTabla" name="personaTipoTabla" class="display nowrap" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th><center>TIPO</center></th>
                                                            <th><center>OPCIÓN</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>                                         
                                                    </tbody> 
                                                </table>
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
@stop