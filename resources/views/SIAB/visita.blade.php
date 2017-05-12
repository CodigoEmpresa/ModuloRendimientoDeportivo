@extends('master')
@section('script')
  @parent
    <script src="{{ asset('public/Js/buscar_personas.js') }}"></script>     
    <script src="{{ asset('public/Js/SIAB/visita.js') }}"></script>   
    <script src="{{ asset('public/Js/bootstrap-datepicker.js') }}"></script>   
    {{Html::style('public/Css/bootstrap-datepicker3.css')}}   
@stop  
@section('content')
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>VISITA DOMICILIARIA</h3></center>
 <input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/> 
    <div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
        <div class="content">
            <br>
            <center>
                <h4>Ingrese el número de cédula o nombres de la persona o deportista que va a registrar</h4>
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
                                        <button id="buscar" data-role="buscar" data-buscador="buscar" class="btn btn-default" type="button">
                                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                        </button>
                                    </span>
                                </div>
                                <div tabindex="-1" id="mensaje-incorrectoB" class=" text-left alert alert-success alert-danger" role="alert" style="display: none; margin-top: 10px;">                                    
                                    <strong>Error </strong> <span id="mensajeIncorrectoB"></span>
                                </div>
                            </div>
                            <br><br><br>
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
<!-- ------------------------------------------------------------------------------------ -->
        <form id="visitaF" name="visitaF" >            
            <div id="camposRegistro" style="display:none;" >                
                <input type="hidden" name="persona" id="persona" value=""/>
                <input type="hidden" name="deportista" id="deportista" value=""/>
                <input type="hidden" name="visita" id="visita" value=""/>
                <br><br>
                <div class="content">
                    <div align="right">
                        <button type="button" class="btn btn-info" name="Enviar" id="Agregar_Visista">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Agregar visita domiciliaria
                        </button>
                    </div>
                    <br><br>
                    <div class="panel-body">
                        <table id="TablaVisitas" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><center>N°</center></th>
                                    <th><center>FECHA DE LA VISITA</center></th>
                                    <th><center>OPCIÓN</center></th>
                                </tr>
                            </thead>
                            <tbody>                                                
                            </tbody> 
                        </table>
                    </div>
                </div>
                <div class="content panel panel-default" id="FormularioAddVisista" style="display:none">
                    <div class="content">
                        <div style="text-align:center;" id="Titulo">                            
                        </div>  
                        <!-- ---------------------------PASO 1--------------------------- -->
                        <div class="panel">                            
                            <div class="panel-heading">                
                                <div class="bs-callout bs-callout-info">                    
                                    <span class="glyphicon glyphicon-user " aria-hidden="true"></span>
                                    <label><p>DATOS DE IDENTIFICACIÓN</p></label>                         
                                    <span data-role="ver" id="seccion_uno_ver" class="glyphicon glyphicon-resize-full btn-lg btn-lg" aria-hidden="true"></span>
                                </div>
                            </div>                 
                            <ul class="list-group" id="seccion_uno" name="seccion_uno">
                               <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label" id="DeporteL" >Deporte:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select name="Deporte" id="Deporte" class="form-control" disabled="disabled">
                                                <option value="">Seleccionar</option>
                                                @foreach($Deporte as $Deporte)
                                                    <option value="{{ $Deporte['Id'] }}">{{ $Deporte['Nombre_Deporte'] }}</option>
                                                @endforeach                                                           
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label" id="DeportistaL">Deportista:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Nombre del deportista" type="text" name="Deportista" id="Deportista" readonly>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label" id="FechaIntervencionL">Fecha de intervención:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="input-group date form-control" id="FechaIntervencionDate" style="border: none;">
                                                <input id="FechaIntervencion" class="form-control " type="text" value="" name="FechaIntervencion" default="" data-date="" data-behavior="FechaIntervencion">
                                            <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            </div>    
                                        </div> 
                                    </div>
                                </li>
                            </ul>                            
                        </div>
                        <!-- ---------------------------PASO 2--------------------------- -->
                        <div class="panel">                            
                            <div class="panel-heading">                
                                <div class="bs-callout bs-callout-info">                    
                                    <span class="glyphicon glyphicon-thumbs-up " aria-hidden="true"></span>
                                    <label><p>DATOS DE QUIEN ATIENE LA VISITA</p></label>                         
                                    <span data-role="ver" id="seccion_dos_ver" class="glyphicon glyphicon-resize-full btn-lg btn-lg" aria-hidden="true"></span>
                                </div>
                            </div>                 
                            <ul class="list-group" id="seccion_dos" name="seccion_dos">
                               <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label" id="NombresAtiendeL" >Nombres:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Nombres de quien atiende la visita" type="text" name="NombresAtiende" id="NombresAtiende">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label" id="ApellidosAtiendeL">Apellidos:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Apellidos de quien atiende la visita" type="text" name="ApellidosAtiende" id="ApellidosAtiende">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label" id="DocumentoAtiendeL">Número de documento:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Número de documento de quien atiende la visita" type="text" name="DocumentoAtiende" id="DocumentoAtiende">
                                        </div> 
                                    </div>
                                </li>
                            </ul>                            
                        </div>
                         <!-- ---------------------------PASO 3--------------------------- -->
                        <div class="panel">                            
                            <div class="panel-heading">                
                                <div class="bs-callout bs-callout-info">                    
                                    <span class="glyphicon glyphicon-home " aria-hidden="true"></span>
                                    <label><p>CARACTERÍSTICAS DE LA VIVIENDA</p></label>                         
                                    <span data-role="ver" id="seccion_tres_ver" class="glyphicon glyphicon-resize-full btn-lg btn-lg" aria-hidden="true"></span>
                                </div>
                            </div>                 
                            <ul class="list-group" id="seccion_tres" name="seccion_tres">
                               <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                           <h4>Vivienda</h4>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <div class="radio">
                                                <label class="col-md-3"><input type="radio" name="op1" id="p1o1" value="Casa">Casa</label>
                                                <label class="col-md-3"><input type="radio" name="op1" id="p1o2" value="Apartamento">Apartamento</label>
                                                <label class="col-md-3"><input type="radio" name="op1" id="p1o3" value="Habitación">Habitación</label>
                                                <label class="col-md-3"><input type="radio" name="op1" id="p1o4" value="Lote">Lote</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">                  
                                    <div class="form-group col-md-2"></div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2"></div>
                                        <div class="form-group col-md-10">
                                            <div class="radio">
                                                <label class="col-md-3"><input type="radio" name="op2" id="p2o1" value="Propia">Propia</label>
                                                <label class="col-md-3"><input type="radio" name="op2" id="p2o2" value="Arriendo">Arriendo</label>
                                                <label class="col-md-3"><input type="radio" name="op2" id="p2o3" value="Familiar">Familiar</label>
                                                <label class="col-md-3"><input type="radio" name="op2" id="p2o4" value="Usufructo">Usufructo</label>
                                            </div>                                                                        
                                        </div>                                        
                                    </div>
                                    <div class="row" id="OP2o1" style="display:none;">
                                        <div class="form-group col-md-2"></div>
                                        <div class="form-group col-md-10">                                               
                                            <div class="radio"><label><input type="radio" name="op2o1" id="p2o11" value="Sin deuda">Sin deuda</label></div>
                                            <div class="radio"><label><input type="radio" name="op2o1" id="p2o12" value="Con deuda">Con deuda</label></div>
                                        </div>                                        
                                    </div>
                                 </li>
                                 <li class="list-group-item">                     
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <h4>Área de la vivienda</h4>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Área de la vivienda</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Área de la vivienda" type="text" name="pn3" id="pn3">
                                        </div>                                        
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Tiempo de permanencia en la vivienda</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Tiempo de permanencia en la vivienda" type="text" name="p3" id="p3">
                                        </div>                                        
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <h4>Material de la construcción paredes</h4>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Material de la construcción</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <div class="radio">
                                                <label class=" col-md-3"><input type="checkbox" name="op4[]" id="p4o1" value="Bloque o ladrillo">Bloque o ladrillo</label>
                                                <label class=" col-md-3"><input type="checkbox" name="op4[]" id="p4o2" value="Madera">Madera</label>
                                                <label class=" col-md-3"><input type="checkbox" name="op4[]" id="p4o3" value="Tejas de zinc">Tejas de zinc</label>
                                                <label class=" col-md-3"><input type="checkbox" name="op4[]" id="p4o4" value="Desechable">Desechable</label>
                                            </div>
                                        </div>                                        
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <h4>Material de la construcción pisos</h4>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Material de la construcción pisos</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <div class="radio">
                                                <label class="col-md-3"><input type="checkbox" name="op5[]" id="p5o1" value="Cemento">Cemento</label>
                                                <label class="col-md-3"><input type="checkbox" name="op5[]" id="p5o2" value="Cerámica">Cerámica</label class="col-md-3">
                                                <label class="col-md-3"><input type="checkbox" name="op5[]" id="p5o3" value="Tierra">Tierra</label class="col-md-3">
                                                <label class="col-md-3"><input type="checkbox" name="op5[]" id="p5o4" value="Madera">Madera</label></div></td>
                                                </tr>
                                            </table>
                                        </div>                                        
                                    </div>
                                </li>                                
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <h4>Servicios</h4>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Servicios</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <div class="radio">
                                                <label class="col-md-3"><input type="checkbox" name="op6[]" id="p6o1" value="Agua">Agua</label>
                                                <label class="col-md-3"><input type="checkbox" name="op6[]" id="p6o2" value="Energía">Energía</label>
                                                <label class="col-md-3"><input type="checkbox" name="op6[]" id="p6o3" value="Teléfono">Teléfono</label>
                                                <label class="col-md-3"><input type="checkbox" name="op6[]" id="p6o4" value="Alcantarillado">Alcantarillado</label>
                                            </div>
                                            <div class="radio">
                                                <label class="col-md-3"><input type="checkbox" name="op6[]" id="p6o5" value="Gas">Gas</label>
                                                <div class="col-md-3" id="OP6o5" style="display:none;">
                                                    <label><input type="radio" name="op6o5" id="p6o11" value="Natural">Natural</label>
                                                    <label><input type="radio" name="op6o5" id="p6o12" value="Propano">Propano</label>
                                                </div>
                                                <label class="col-md-3"><input type="checkbox" name="op6[]" id="p6o6" value="Otros">Otros</label>
                                                <div class="col-md-3" id="OP6o6" style="display:none;">
                                                    <input class="form-control" placeholder="Otro" type="text" name="otro6o6" id="otro6o6">
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <h4>Distribución (N°)</h4>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Habitación:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control" placeholder="Total habitaciones" type="text" name="Habitacion" id="Habitacion">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Baño:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control" placeholder="Total baños" type="text" name="Bano" id="Bano">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Cocina:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control" placeholder="Total cocinas" type="text" name="Cocina" id="Cocina">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Sala:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control" placeholder="Total salas" type="text" name="Sala" id="Sala">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Comedor:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control" placeholder="Total comedores" type="text" name="Comedor" id="Comedor">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Zona de ropas:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control" placeholder="Total zonas de ropas" type="text" name="ZRopas" id="ZRopas">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Otros:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control" placeholder="Otros" type="text" name="OtrosDistribucion" id="OtrosDistribucion">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <h4>Muebles y enseres (N°)</h4>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Camas:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control" placeholder="Total camas" type="text" name="Camas" id="Camas">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Closets:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control" placeholder="Total closets" type="text" name="Closets" id="Closets">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Televisor:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control" placeholder="Total televisores" type="text" name="Televisor" id="Televisor">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Nevera:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control" placeholder="Total neveras" type="text" name="Nevera" id="Nevera">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Estufa:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control" placeholder="Total estufas" type="text" name="Estufa" id="Estufa">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Otros:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control" placeholder="Otros" type="text" name="OtrosMuebles" id="OtrosMuebles">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <h4>Problematicas del sector</h4>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Problematicas</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <div class="radio">
                                                <label class="col-md-3"><input type="checkbox" name="op7[]" id="p7o1" value="Delincuencia">Delincuencia</label>
                                                <label class="col-md-3"><input type="checkbox" name="op7[]" id="p7o2" value="Pandillas">Pandillas</label>
                                                <label class="col-md-3"><input type="checkbox" name="op7[]" id="p7o3" value="Drogadicción">Drogadicción</label>
                                                <label class="col-md-3"><input type="checkbox" name="op7[]" id="p7o4" value="Prostitución">Prostitución</label>
                                            </div>
                                        </div>                                        
                                    </div>
                                </li>  
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <h4>Condiciones</h4>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Aseo:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <table class="table">
                                                <tr>
                                                    <td><div class="radio"><label><input type="radio" name="op8" id="p8o1" value="Adecuado">Adecuado</label></div></td>
                                                    <td><div class="radio"><label><input type="radio" name="op8" id="p8o2" value="Medianamente adecuado">Medianamente adecuado</label></div></td>
                                                    <td><div class="radio"><label><input type="radio" name="op8" id="p8o3" value="Inadecuado">Inadecuado</label></div></td>                                                    
                                                </tr>
                                            </table>
                                        </div> 
                                        <div class="form-group col-md-2"></div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Organización:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <table class="table">
                                                <tr>
                                                    <td><div class="radio"><label><input type="radio" name="op9" id="p9o1" value="Adecuado">Adecuado</label></div></td>
                                                    <td><div class="radio"><label><input type="radio" name="op9" id="p9o2" value="Medianamente adecuado">Medianamente adecuado</label></div></td>
                                                    <td><div class="radio"><label><input type="radio" name="op9" id="p9o3" value="Inadecuado">Inadecuado</label></div></td>                                                    
                                                </tr>
                                            </table>
                                        </div>                                                                                

                                        <div class="form-group col-md-2"></div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Iluminación:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <table class="table">
                                                <tr>
                                                    <td><div class="radio"><label><input type="radio" name="op10" id="p10o1" value="Adecuado">Adecuado</label></div></td>
                                                    <td><div class="radio"><label><input type="radio" name="op10" id="p10o2" value="Medianamente adecuado">Medianamente adecuado</label></div></td>
                                                    <td><div class="radio"><label><input type="radio" name="op10" id="p10o3" value="Inadecuado">Inadecuado</label></div></td>                                                    
                                                </tr>
                                            </table>
                                        </div> 

                                        <div class="form-group col-md-2"></div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Ventilación:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <table class="table">
                                                <tr>
                                                    <td><div class="radio"><label><input type="radio" name="op11" id="p11o1" value="Adecuado">Adecuado</label></div></td>
                                                    <td><div class="radio"><label><input type="radio" name="op11" id="p11o2" value="Medianamente adecuado">Medianamente adecuado</label></div></td>
                                                    <td><div class="radio"><label><input type="radio" name="op11" id="p11o3" value="Inadecuado">Inadecuado</label></div></td>                                                    
                                                </tr>
                                            </table>
                                        </div>                                                                               
                                    </div>
                                </li> 
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <h4>Condiciones de vivienda</h4>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Condiciones</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <table class="table">
                                                <tr>
                                                    <td><div class="radio"><label><input type="radio" name="op12" id="p12o1" value="Obra blanca">Obra blanca</label></div></td>
                                                    <td><div class="radio"><label><input type="radio" name="op12" id="p12o2" value="Obra girs">Obra gris</label></div></td>
                                                    <td><div class="radio"><label><input type="radio" name="op12" id="p12o3" value="Obra negra">Obra negra</label></div></td>                                                    
                                                </tr>
                                            </table>
                                        </div>                                        
                                    </div>
                                </li>   
                            </ul>                            
                        </div>

                        <!-- ---------------------------PASO 4--------------------------- -->
                        <div class="panel">                            
                            <div class="panel-heading">                
                                <div class="bs-callout bs-callout-info">                    
                                    <span class="glyphicon glyphicon-th " aria-hidden="true"></span>
                                    <label><p>GENOGRAMA</p></label>                         
                                    <span data-role="ver" id="seccion_cuatro_ver" class="glyphicon glyphicon-resize-full btn-lg btn-lg" aria-hidden="true"></span>
                                </div>
                            </div>                 
                            <ul class="list-group" id="seccion_cuatro" name="seccion_cuatro">
                               <li class="list-group-item">
                                     <div class="row" id="GenogramaRegistro">
                                         <div class="form-group col-md-12">
                                            <div class="form-group col-md-4"></div>
                                            <div class="col-md-4 text-center">
                                                <label for="inputEmail" class="control-label">Genograma</label>
                                                <br>
                                                <span id="SImagenGenograma">
                                                    <img id="Genograma" src="" alt="" class="img-thumbnail img-responsive"><br>         
                                                </span>
                                                <br>                                    
                                                <input type="file" id ="GenogramaDep" name="GenogramaDep">
                                                <p class="help-block">Imagen en formato jpeg,jpg,png,bmp.</p> 
                                            </div>
                                            <div class="form-group col-md-4 "></div>
                                        </div>
                                        <div clas="row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail" class="control-label">Observaciones del genograma</label>
                                            </div>
                                            <div class="form-group col-md-12">                                                
                                                <textarea class="form-control" placeholder="Agregue las observaciones necesarias para la descripción del genograma que corresponde al archivo adjunto" type="text" name="Genograma_Observacion" id="Genograma_Observacion"></textarea>                                                
                                            </div>
                                        </div>
                                    </div>
                               </li>
                           </ul>
                       </div>
                        <!-- ---------------------------PASO 5--------------------------- -->
                        <div class="panel">                            
                            <div class="panel-heading">                
                                <div class="bs-callout bs-callout-info">                    
                                    <span class="glyphicon glyphicon-heart-empty " aria-hidden="true"></span>
                                    <label><p>SALUD FAMILIAR</p></label>                         
                                    <span data-role="ver" id="seccion_cinco_ver" class="glyphicon glyphicon-resize-full btn-lg btn-lg" aria-hidden="true"></span>
                                </div>
                            </div>                 
                            <ul class="list-group" id="seccion_cinco" name="seccion_cinco">
                               <li class="list-group-item" id="MiembrosLi">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">Miembro de la familia afiliado a salud</label>
                                    </div>
                                    <div class="row" id="Li1">
                                        <div class="form-group col-md-4">
                                            <input class="form-control" placeholder="Nombre del familiar" type="text" name="NombreMiembro" id="NombreMiembro">
                                            <input class="form-control" placeholder="Parentesco" type="text" name="ParentescoMiembro" id="ParentescoMiembro">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Régimen Subsidiado</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input class="form-control" placeholder="Nombre el régimen subsidiado" type="text" name="NombreSubsidiado" id="NombreSubsidiado">
                                        </div>
                                    </div>
                                    <div class="row"  id="Li2">                                       
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Régimen contributivo</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input class="form-control" placeholder="Nombre del régimen contributivo" type="text" name="NombreContributivo" id="NombreContributivo">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">N° de afiliados a salud</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input class="form-control" placeholder="Número de afiliados" type="text" name="NumAfiliados" id="NumAfiliados">
                                        </div>                                        

                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Enfermedades</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input class="form-control" placeholder="Enfermedades" type="text" name="Enfermedades" id="Enfermedades">
                                        </div> 

                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Discapacidades</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input class="form-control" placeholder="Discapacidades" type="text" name="Discapacidades" id="Discapacidades">
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <center><button type="button" class="btn btn-info" name="Add_Salud" id="Add_Salud">Agregar salud familiar</button></center>
                                        </div>                                    
                                        <div id="MiembrosT" class="form-group col-md-12">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <div class="form-group"  id="mensaje_miembro" style="display: none;">
                                                <div id="alert_miembro"></div>
                                            </div>
                                        </div>
                                    </div>
                               </li>
                           </ul>
                       </div>
                       <!-- ---------------------------PASO  6--------------------------- -->
                        <div class="panel">                            
                            <div class="panel-heading">                
                                <div class="bs-callout bs-callout-info">                    
                                    <span class="glyphicon glyphicon-usd " aria-hidden="true"></span>
                                    <label><p>ASPECTO ECONÓMICO (Opcional)</p></label>                         
                                    <span data-role="ver" id="seccion_seis_ver" class="glyphicon glyphicon-resize-full btn-lg btn-lg" aria-hidden="true"></span>
                                </div>
                            </div>                 
                            <ul class="list-group" id="seccion_seis" name="seccion_seis">
                               <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <h4>Ingresos familiares</h4>
                                        </div>
                                        <div class="form-group col-md-7">
                                            <div class="radio">
                                                <label class="col-md-3"><input type="radio" name="op13" id="p13o1" value="Saliario(s)">Saliario(s)</label>
                                                <label class="col-md-2"><input type="radio" name="op13" id="p13o2" value="Renta(s)">Renta(s)</label>
                                                <label class="col-md-3"><input type="radio" name="op13" id="p13o3" value="Pensión(es)">Pensión(es)</label>
                                                <label class="col-md-2"><input type="radio" name="op13" id="p13o4" value="Otro">Otro</label>
                                                <div class="col-md-2" id="OP13o4" style="display:none;">
                                                    <input class="form-control" placeholder="Otro" type="text" name="otro13o4" id="otro13o4">
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="form-group col-md-3">
                                            <div class="form-group col-md-2">                                            
                                                <label for="inputEmail" class="control-label">Total: $</label>
                                            </div>
                                            <div class="form-group col-md-8">                                            
                                                <input class="form-control" placeholder="Total de ingresos" type="text" name="TotalIngreso" id="TotalIngreso">
                                            </div>
                                        </div>                                        
                                    </div>
                               </li>
                               <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <h4>Egresos</h4>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Alimentación:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                           <input class="form-control" placeholder="Valor alimentación" type="text" name="Alimentacion" id="Alimentacion">
                                        </div> 
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Arriendo:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Valor arriendo" type="text" name="Arriendo" id="Arriendo">
                                        </div>     
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2"></div>                                        
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Educación:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Valor educación" type="text" name="Educacion" id="Educacion">
                                        </div>     
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Cuota vivienda:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                           <input class="form-control" placeholder="Valor cuota vivienda" type="text" name="CuotaV" id="CuotaV">
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2"></div>                                        
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Salud:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Valor salud" type="text" name="Salud" id="Salud">
                                        </div>     
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Recreación:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                           <input class="form-control" placeholder="Valor recreación" type="text" name="Recreacion" id="Recreacion">
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2"></div>                                        
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Servicios:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Valor servicios" type="text" name="Servicios" id="Servicios">
                                        </div>     
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Transporte:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                           <input class="form-control" placeholder="Valor transporte" type="text" name="Transporte" id="Transporte">
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2"></div>                                        
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Deudas:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                                <div class="radio">
                                                    <label><input type="radio" name="op14" id="p14o1" value="Si">Si</label>
                                                    <label><input type="radio" name="op14" id="p14o2" value="No">No</label>
                                                </div>
                                        </div>     
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">A quién adeudan?:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                           <input class="form-control" placeholder="A quién adeudan?" type="text" name="Adeudan" id="Adeudan">
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2"></div>                                        
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Monto total egresos:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Monto total de los egresos" type="text" name="MontoEgresos" id="MontoEgresos">
                                        </div>     
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Monto deudas?:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                           <input class="form-control" placeholder="Monto total de las deudas" type="text" name="MontoDeudas" id="MontoDeudas">
                                        </div> 
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <h4>Situación económica</h4>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <div class="form-group col-md-4">
                                                 <div class="radio"><label><input type="radio" name="op15" id="p15o1" value="Solvente">Solvente</label></div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                 <div class="radio"><label><input type="radio" name="op15" id="p15o1" value="Equilibrio">Equilibrio</label></div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                 <div class="radio"><label><input type="radio" name="op15" id="p15o1" value="Deficit">Deficit</label></div>
                                            </div>
                                        </div>                                                                                                                    
                                    </div>
                               </li>
                           </ul>
                       </div>
                       <!-- ---------------------------PASO  7--------------------------- -->
                        <div class="panel">                            
                            <div class="panel-heading">                
                                <div class="bs-callout bs-callout-info">                    
                                    <span class="glyphicon glyphicon-picture " aria-hidden="true"></span>
                                    <label><p>TIEMPO LIBRE/RECREACIÓN</p></label>                         
                                    <span data-role="ver" id="seccion_siete_ver" class="glyphicon glyphicon-resize-full btn-lg btn-lg" aria-hidden="true"></span>
                                </div>
                            </div>                 
                            <ul class="list-group" id="seccion_siete" name="seccion_siete">
                               <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <center><label for="inputEmail" class="control-label">ACTIVIDADES FAMILIARES</label></center>
                                        </div>
                                         <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Prácticas deportivas (Quiénes):</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <textarea class="form-control" placeholder="Con quiénes" type="text" name="PracticasDeportivas" id="PracticasDeportivas"></textarea>
                                        </div>   

                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Juego con amigos o familiares (Con quién):</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <textarea class="form-control" placeholder="Con quiénes" type="text" name="JuegosFamiliares" id="JuegosFamiliares"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Salidas a espacios públicos (Cuáles):</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <textarea class="form-control" placeholder="Salidas a espacios públicos" type="text" name="SalidasPublicos" id="SalidasPublicos"></textarea>
                                        </div>   
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Quehaceres del hogar (Cuáles / Quiénes):</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <textarea class="form-control" placeholder="Quehaceres del hogar" type="text" name="Quehaceres" id="Quehaceres"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Actividades al aire libre (Cuáles):</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <textarea class="form-control" placeholder="Actividades al aire libre" type="text" name="ActividadesLibre" id="ActividadesLibre"></textarea>
                                        </div>   
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Ver televisión (Horario):</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <textarea class="form-control" placeholder="Horario de televisión" type="text" name="Television" id="Television"></textarea>
                                        </div>   
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Actividades académicas (Cuáles):</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <textarea class="form-control" placeholder="Actividades académicas" type="text" name="ActividadesAcademicas" id="ActividadesAcademicas"></textarea>
                                        </div>   
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Acceso a internet (Horario):</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <textarea class="form-control" placeholder="Horario de acceso a internet" type="text" name="Internet" id="Internet"></textarea>
                                        </div>                                         
                                    </div>
                               </li>
                           </ul>
                       </div>  
                       <!-- ---------------------------PASO  8--------------------------- -->
                        <div class="panel">                            
                            <div class="panel-heading">                
                                <div class="bs-callout bs-callout-info">                    
                                    <span class="glyphicon glyphicon-heart " aria-hidden="true"></span>
                                    <label><p>RELACIONES FAMILIARES</p></label>                         
                                    <span data-role="ver" id="seccion_ocho_ver" class="glyphicon glyphicon-resize-full btn-lg btn-lg" aria-hidden="true"></span>
                                </div>
                            </div>                 
                            <ul class="list-group" id="seccion_ocho" name="seccion_ocho">
                               <li class="list-group-item">     
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail" class="control-label">Las desiciones relacionadas con la vida familiar son tomadas por:</label>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" placeholder="Describa" type="text" name="Preg16" id="Preg16"></textarea>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail" class="control-label">¿Qué opina del deporte que practica su hijo(a)? ¿Cómo ha cambiado su vida cotidiana?</label>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" placeholder="Describa" type="text" name="Preg17" id="Preg17"></textarea>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail" class="control-label">¿Cuál es la forma en la que usted(es) apoyan a su hijo(a) a practicar su deporte?</label>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" placeholder="Describa" type="text" name="Preg18" id="Preg18"></textarea>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail" class="control-label">¿Cuál es la dificultad más grande que se le presenta al deportista para la realización de su deporte? ¿Por qué?</label>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" placeholder="Describa" type="text" name="Preg19" id="Preg19"></textarea>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail" class="control-label">¿Qué conoce sobre el programa de apoyo que el IDRD ofrece a los deportistas?¿Cuál es su opinión sobre el programa?</label>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" placeholder="Describa" type="text" name="Preg20" id="Preg20"></textarea>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail" class="control-label">¿Qué problemáticas se presentan al interior de la familia?¿Considera necesario apoyo por asesoría familiar?</label>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" placeholder="Describa" type="text" name="Preg21" id="Preg21"></textarea>
                                        </div>                                        
                                    </div>                                    
                               </li>
                           </ul>
                       </div>
                       <!-- ---------------------------PASO  9--------------------------- -->
                        <div class="panel">                            
                            <div class="panel-heading">                
                                <div class="bs-callout bs-callout-info">                    
                                    <span class="glyphicon glyphicon-eye-open " aria-hidden="true"></span>
                                    <label><p>CONCEPTO PROFESIONAL</p></label>                         
                                    <span data-role="ver" id="seccion_nueve_ver" class="glyphicon glyphicon-resize-full btn-lg btn-lg" aria-hidden="true"></span>
                                </div>
                            </div>                 
                            <ul class="list-group" id="seccion_nueve" name="seccion_nueve">
                               <li class="list-group-item">     
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail" class="control-label">Concepto profesional</label>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" placeholder="Describa" type="text" name="Preg22" id="Preg22"></textarea>
                                        </div>                                        
                                    </div>
                               </li>
                           </ul>
                       </div>
                    </div>
                     <!-- ---------------------------PASO  10--------------------------- -->
                        <div class="panel">                            
                            <div class="panel-heading">                
                                <div class="bs-callout bs-callout-info">                    
                                    <span class="glyphicon glyphicon-eye-open " aria-hidden="true"></span>
                                    <label><p>ARCHIVOS DIGITALES</p></label>                         
                                    <span data-role="ver" id="seccion_diez_ver" class="glyphicon glyphicon-resize-full btn-lg btn-lg" aria-hidden="true"></span>
                                </div>
                            </div>                 
                            <ul class="list-group" id="seccion_diez" name="seccion_diez">
                               <li class="list-group-item">     
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="row" id="Imagen1Registro">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail" class="control-label">Registro fotográfico digital 1</label>
                                                    <br>
                                                    <span id="SImagenImagen1">
                                                        <img id="Imagen1" src="" alt="" class="img-thumbnail img-responsive"><br>         
                                                    </span>
                                                    <br>                                    
                                                    <input type="file" id ="Imagen1Dep" name="Imagen1Dep">
                                                    <p class="help-block">Imagen en formato jpeg,jpg,png,bmp.</p>                                                     
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="row" id="Imagen2Registro">
                                                <div class="form-group col-md-6 text-center">
                                                    <label for="inputEmail" class="control-label">Registro fotográfico digital 2</label>
                                                    <br>
                                                    <span id="SImagenImagen2">
                                                        <img id="Imagen2" src="" alt="" class="img-thumbnail img-responsive"><br>         
                                                    </span>
                                                    <br>                                    
                                                    <input type="file" id ="Imagen2Dep" name="Imagen2Dep">
                                                    <p class="help-block">Imagen en formato jpeg,jpg,png,bmp.</p>                                                     
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="form-group col-md-6">
                                            <div class="row" id="Imagen3Registro">
                                                <div class="form-group col-md-6 text-center">
                                                    <label for="inputEmail" class="control-label">Registro fotográfico digital 3</label>
                                                    <br>
                                                    <span id="SImagenImagen3">
                                                        <img id="Imagen3" src="" alt="" class="img-thumbnail img-responsive"><br>         
                                                    </span>
                                                    <br>                                    
                                                    <input type="file" id ="Imagen3Dep" name="Imagen3Dep">
                                                    <p class="help-block">Imagen en formato jpeg,jpg,png,bmp.</p> 
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="form-group col-md-6">
                                            <div class="row" id="Imagen4Registro">
                                                <div class="form-group col-md-6 text-center">
                                                    <label for="inputEmail" class="control-label">Registro fotográfico digital 4</label>
                                                    <br>
                                                    <span id="SImagenImagen4">
                                                        <img id="Imagen4" src="" alt="" class="img-thumbnail img-responsive"><br>         
                                                    </span>
                                                    <br>                                    
                                                    <input type="file" id ="Imagen4Dep" name="Imagen4Dep">
                                                    <p class="help-block">Imagen en formato jpeg,jpg,png,bmp.</p> 
                                                </div>
                                            </div>
                                        </div>             
                                        <div class="form-group col-md-6">
                                            <div class="row" id="Imagen5Registro">
                                                <div class="form-group col-md-6 text-center">
                                                    <label for="inputEmail" class="control-label">Registro fotográfico digital 5 (Opcional)</label>
                                                    <br>
                                                    <span id="SImagenImagen5">
                                                    </span>
                                                    <br>                                    
                                                    <input type="file" id ="Imagen5Dep" name="Imagen5Dep">
                                                    <p class="help-block">Imagen en formato jpeg,jpg,png,bmp,pdf.</p> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="row" id="Imagen6Registro">
                                                <div class="form-group col-md-6 text-center">
                                                    <label for="inputEmail" class="control-label">Registro fotográfico digital 6 (Opcional)</label>
                                                    <br>
                                                    <span id="SImagenImagen6">
                                                    </span>
                                                    <br>                                    
                                                    <input type="file" id ="Imagen6Dep" name="Imagen6Dep">
                                                    <p class="help-block">Imagen en formato jpeg,jpg,png,bmp,pdf.</p> 
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                               </li>
                           </ul>
                       </div>
                       <!-- ----------------------BOTONERA------------------- -->
                        <div id="Botonera">
                            <center>
                                <button style="display:none;" class="btn btn-primary" name="Enviar" id="Registrar">Registrar vista domiciliaria</button>
                            </center>
                            <center>
                                <button style="display:none;" class="btn btn-default" name="Enviar" id="Cerrar">Cerrar</button>
                            </center>
                        </div>
                        <!-- ----------------------FIN DE BOTONERA------------------- -->
                        <br><br><br> 
                    </div>                    
                    <br><br>
                </div>
            </div>
            <div class="form-group"  id="mensaje_actividad" style="display: none;">
                <div id="alert_actividad"></div>
            </div>
        </form>
    </div>
@stop
