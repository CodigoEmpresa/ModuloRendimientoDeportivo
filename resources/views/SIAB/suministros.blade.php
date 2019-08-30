@extends('master')
@section('script')
  @parent
    <script src="{{ asset('public/Js/buscar_personas.js') }}"></script>     
    <script src="{{ asset('public/Js/SIAB/suministros.js') }}"></script>   
    <script src="{{ asset('public/Js/bootstrap-datepicker.js') }}"></script>   
    {{Html::style('public/Css/bootstrap-datepicker3.css')}}      
@stop  
@section('content')
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>SUMINISTROS, APOYOS Y SERVICIOS</h3></center>
 <input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
    <div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
        <div class="content">
            <br>
            <center>
                <h4>Ingrese el número de cédula o nombres de la persona o deportista que va a buscar</h4>
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
                            <div class="col-xs-12" id="tablaPersonas"></div>
                            <br>
                            <div class="col-xs-12">
                                <ul id="personas"></ul>
                            </div>
                            <div id="paginador" class="col-xs-12"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="loading" style="display:none;">
        <center><button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button></center>
    </div>
    <div id="BotoneraAcciones" name ="BotoneraAcciones" style="display:none;" >
        <div class="list-group-item">
            <h5 class="list-group-item-heading" style="text-transform: uppercase;" id="Nombres">
            </h5>
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-3"><small id="Identificacion"></small></div>
                    </div>
                </div>
                <br>
            </div>
            <br><br>
            <button type="button" class="btn btn-primary" name="SuministrosComplementos" id="SuministrosComplementos">Ver complementos</button>
            <button type="button" class="btn btn-default" name="SuministrosAlimentos" id="SuministrosAlimentos">Ver Alimentación</button>
            <button type="button" class="btn btn-info" name="ApoyoServicios" id="ApoyoServicios">Ver apoyos y servicios</servicios>
        </div>        
    </div>
    <form id="SuministrosComplementosF" name="SuministrosComplementosF" style="display:none;">
        <input type="hidden" name="deportista1" id="deportista1" value=""/>
        <br>
        <h4>Lista de complementos agregados recientemente</h4>
        <div align="right">
            <button type="button" class="btn btn-success" name="Agregar_Complemento" id="Agregar_Complemento">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Agregar Complemento
            </button>
        </div>
        <br>
        <table id="TablaComplementos" class="display nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><center>Complemento</center></th>
                    <th><center>Cantidad</center></th>
                    <th><center>Valor unitario</center></th>
                    <th><center>Valor total</center></th>
                    <th><center>Fecha</center></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><center>Complemento</center></th>
                    <th><center>Cantidad</center></th>
                    <th><center>Valor unitario</center></th>
                    <th><center>Valor total</center></th>
                    <th><center>Fecha</center></th>
                </tr>
            </tfoot>
            <tbody id="ListaComplemento">                    
            </tbody> 
        </table>
        <br><br>
        <div id="Agregar_ComplementoD" style="display:none;">
            <center><h5>Agregar Complemento</h5></center>
            <br>
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="inputEmail" class="control-label" >Tipo de complemento:</label>
                </div>
                <div class="form-group col-md-4">
                    <select name="TipoComplemento" id="TipoComplemento" class="form-control">
                        <option value="">Seleccionar</option>                         
                        @foreach($TipoComplemento as $TipoComplemento)
                            <option value="{{ $TipoComplemento['Id'] }}">{{ $TipoComplemento['Nombre_Tipo_Complemento'] }}</option>
                        @endforeach                           
                    </select>                    
                </div>
                <div class="form-group col-md-2">
                    <label for="inputEmail" class="control-label" >Complemento:</label>
                </div>
                <div class="form-group col-md-4">
                    <select name="Complemento" id="Complemento" class="form-control">
                        <option value="">Seleccionar</option>                                                 
                    </select>                   
                    <input type="hidden" name="ValorComplemento" id="ValorComplemento"> 
                </div>
                <div id="PrecioOtroD" style="display:none;">
                    <div class="form-group col-md-2">
                        <label for="inputEmail" class="control-label" >Precio por unidad:</label>
                    </div>
                    <div class="form-group col-md-4">
                       <input class="form-control" placeholder="Precio por unidad" type="text" name="PrecioOtro" id="PrecioOtro">
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputEmail" class="control-label" >Cantidad:</label>
                </div>
                <div class="form-group col-md-4">
                   <input class="form-control" placeholder="Cantidad" type="text" name="Cantidad" id="Cantidad">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputEmail" class="control-label" id="FechaExpedicionL">Fecha Expedición:</label>
                </div>                
                <div class="form-group col-md-4">
                    <div class="input-group date form-control" id="FechaComplementoDate" style="border: none;">
                        <input id="FechaComplemento" class="form-control " type="text" value="" name="FechaComplemento" default="" data-date="" data-behavior="FechaComplemento">
                    <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                    </div>    
                </div>    
            </div>
            <br>
            <center>
                <button type="button" class="btn btn-info" name="RegistrarComplemento" id="RegistrarComplemento">Registrar Complemento</button>
            </center>
            <br>
            <div class="form-group"  id="mensaje_complemento" style="display: none;">
                <div id="alert_complemento"></div>
            </div> 
            <br><br>
        </div>
    </form>
    <form id="SuministrosAlimentacionF" name="SuministrosAlimentosF" style="display:none;">
        <input type="hidden" name="deportista2" id="deportista2" value=""/>
        <br>
        <h4>Lista de ayudas alimentarias agregadas recientemente</h4>
        <div align="right">
            <button type="button" class="btn btn-success" name="Agregar_Alimentacion" id="Agregar_Alimentacion">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Agregar Alimento
            </button>
        </div>
        <br>
        <table id="TablaAlimentacion" class="display nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><center>Tipo de alimentación</center></th>
                    <th><center>Alimentación</center></th>
                    <th><center>Cantidad</center></th>
                    <th><center>Valor unitario</center></th>
                    <th><center>Valor total</center></th>
                    <th><center>Fecha</center></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><center>Tipo de alimentación</center></th>
                    <th><center>Alimentación</center></th>
                    <th><center>Cantidad</center></th>
                    <th><center>Valor unitario</center></th>
                    <th><center>Valor total</center></th>
                    <th><center>Fecha</center></th>
                </tr>
            </tfoot>
            <tbody id="ListaAlimentacion">                    
            </tbody> 
        </table>
        <div id="Agregar_AlimentacionD" style="display:none;">
            <center><h5>Agregar Alimentacion</h5></center>
            <br>
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="inputEmail" class="control-label" >Tipo Alimentación:</label>
                </div>
                <div class="form-group col-md-4">
                    <select name="TipoAlimentacion" id="TipoAlimentacion" class="form-control">
                        <option value="">Seleccionar</option>                         
                        @foreach($TipoAlimentacion as $TipoAlimentacion)
                            <option value="{{ $TipoAlimentacion['Id'] }}">{{ $TipoAlimentacion['Nombre_Tipo_Alimentacion'] }}</option>
                        @endforeach                           
                    </select>                    
                </div>
                <div class="form-group col-md-2">
                    <label for="inputEmail" class="control-label" >Alimentacion:</label>
                </div>
                <div class="form-group col-md-4">
                    <select name="Alimentacion" id="Alimentacion" class="form-control">
                        <option value="">Seleccionar</option>                                                 
                    </select>     
                    <input type="hidden" name="ValorAlimentacion" id="ValorAlimentacion">                          
                </div>
                <div class="form-group col-md-2">
                    <label for="inputEmail" class="control-label" >Cantidad:</label>
                </div>
                <div class="form-group col-md-4">
                    <input class="form-control" placeholder="Cantidad" type="text" name="CantidadAlimentacion" id="CantidadAlimentacion">         
                </div>
                <div class="form-group col-md-2">
                    <label for="inputEmail" class="control-label" >Fecha:</label>
                </div>
                <div class="form-group col-md-4">
                   <div class="input-group date form-control" id="FechaAlimentacionDate" style="border: none;">
                        <input id="FechaAlimentacion" class="form-control " type="text" value="" name="FechaAlimentacion" default="" data-date="" data-behavior="FechaAlimentacion">
                    <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                    </div>    
                </div>
            </div>
            <br>
            <center>
                <button type="button" class="btn btn-info" name="RegistrarAlimentacion" id="RegistrarAlimentacion">Registrar Alimentacion</button>
            </center>
            <br>
            <div class="form-group"  id="mensaje_alimentacion" style="display: none;">
                <div id="alert_alimentacion"></div>
            </div> 
            <br><br>
        </div>
    </form>
    <form id="ApoyoServiciosF" name="ApoyoServiciosF" style="display:none;">
        <input type="hidden" name="deportista3" id="deportista3" value=""/>
        <br>
        <h4>Lista de apoyos económicos agregados recientemente</h4>
        <div align="right">
            <button type="button" class="btn btn-success" name="Agregar_Apoyo" id="Agregar_Apoyo">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Agregar Apoyo
            </button>
        </div>
        <br>
         <table id="TablaApoyos" class="display nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><center>Apoyo</center></th>
                    <th><center>Valor</center></th>
                    <th><center>Fecha</center></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><center>Apoyo</center></th>
                    <th><center>Valor</center></th>
                    <th><center>Fecha</center></th>
                </tr>
            </tfoot>
            <tbody id="ListaApoyos">                    
            </tbody> 
        </table>
        <div id="Agregar_ApoyoD" style="display:none;">
            <center><h5>Agregar Apoyo</h5></center>
            <br>
            <div class="row">
                <div class="form-group col-md-1">
                    <label for="inputEmail" class="control-label" >Tipo Apoyo:</label>
                </div>
                <div class="form-group col-md-3">
                    <select name="TipoApoyo" id="TipoApoyo" class="form-control">
                        <option value="">Seleccionar</option>                         
                        @foreach($Apoyo as $Apoyo)
                            <option value="{{ $Apoyo['Id'] }}">{{ $Apoyo['Nombre_Apoyo'] }}</option>
                        @endforeach                           
                    </select>                    
                </div>
                <div class="form-group col-md-1">
                    <label for="inputEmail" class="control-label" >Valor:</label>
                </div>
                <div class="form-group col-md-3">
                    <input class="form-control" placeholder="Valor" type="text" name="ValorApoyo" id="ValorApoyo">         
                </div>
                <div class="form-group col-md-1">
                    <label for="inputEmail" class="control-label" >Fecha:</label>
                </div>
                <div class="form-group col-md-3">
                   <div class="input-group date form-control" id="FechaApoyoDate" style="border: none;">
                        <input id="FechaApoyo" class="form-control " type="text" value="" name="FechaApoyo" default="" data-date="" data-behavior="FechaApoyo">
                    <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                    </div>    
                </div>
            </div>
            <br>
            <center>
                <button type="button" class="btn btn-info" name="RegistrarApoyo" id="RegistrarApoyo">Registrar Apoyo</button>
            </center>
            <br>
            <div class="form-group"  id="mensaje_apoyo" style="display: none;">
                <div id="alert_apoyo"></div>
            </div> 
            <br><br>
        </div>
    </form>
@stop