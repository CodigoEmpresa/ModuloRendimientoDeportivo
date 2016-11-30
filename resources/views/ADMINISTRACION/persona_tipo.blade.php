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
                                    <input id="buscador" name="buscador" type="text" class="form-control" placeholder="Buscar" value="1073155693" onkeypress="return ValidaCampo(event);">
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
                                                <h5 class="list-group-item-heading" id="Nombres">
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
<!--<form id="registro" name="registro">
    
    <input type="hidden" name="persona" id="persona" value=""/>
    <input type="hidden" name="deportista" id="deportista" value=""/>
    <div class="container" id="loading" style="display:none;">
        <center><button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button></center>
    </div>
    <div id="camposRegistro" style="display:none;">
     <div class="content" id="RUD" style="display: none;">
        <div class="content">
            <div style="text-align:center;">
                <h3>Asignar tipo persona</h3>
            </div>  
            <div class="panel">
                <div class="panel-heading">                
                    <div class="bs-callout bs-callout-info">                    
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        <label><h4>SECCIÓN UNO:</h4></label>
                        <label><p>Identificación del deportista</p></label>                         
                        <span data-role="ver" id="seccion_uno_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                    </div>
                </div>                 
                <ul class="list-group" id="seccion_uno" name="seccion_uno" style="display: none">
                   <!-- <li class="list-group-item">
                        <div class="row" id="FotografiaRegistro">
                             <div class="form-group col-md-12">
                                <div class="form-group col-md-4"></div>
                                <div class="col-md-4 text-center">
                                    <label for="inputEmail" class="control-label">Fotografía del deportista</label>
                                    <br>
                                    <span id="SImagen">
                                        <img id="Fotografia" src="" alt="" class="img-thumbnail img-responsive"><br>         
                                    </span>
                                    <br>                                    
                                    <input type="file" id ="FotografiaDep" name="FotografiaDep">
                                    <p class="help-block">Imagen en formato jpeg,jpg,png,bmp.</p> 
                                </div>
                                <div class="form-group col-md-4 "></div>
                            </div>
                        </div>
                    </li>     -->               
                    <!--<li class="list-group-item">
                        <div class="panel-body">
                            <p>DATOS DEPORTIVOS</p>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label"  id="PerteneceL" >El deportista pertence al programa de rendimiento deportivo?</label>
                            </div>
                            <div class="form-group col-md-10">
                                <select name="Pertenece" id="Pertenece" class="form-control">
                                    <option value="">Seleccionar</option>
                                    <option value="1">Si</option>
                                    <option value="2">No</option>           
                                </select>
                            </div>
                        </div>
                        <br>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label"  id="ClasificacionDeportistaL" >Clasificación del deportista:</label>
                            </div>
                            <div class="form-group col-md-10">
                                <select name="ClasificacionDeportista" id="ClasificacionDeportista" class="form-control">
                                    <option value="">Seleccionar</option>                       
                                </select>
                            </div>
                        </div>
                        <br>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label"  id="AgrupacionL" >Agrupación:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="Agrupacion" id="Agrupacion" class="form-control">
                                    <option value="">Seleccionar</option>
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label"  id="DeporteL" >Deporte:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="Deporte" id="Deporte" class="form-control">
                                    <option value="">Seleccionar</option>
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label"  id="ModalidadL" >Modalidad:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="Modalidad" id="Modalidad" class="form-control">
                                    <option value="">Seleccionar</option>                                
                                </select>
                            </div>
                        </div>
                        <br>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label"  id="ClubL" >Club deportivo:</label>
                            </div>
                            <div class="form-group col-md-10">
                                <select name="Club" id="Club" class="selectpicker form-control" data-live-search="true">
                                    <option value="">Seleccionar</option>                       
                                </select>
                            </div>                           
                        </div>
                        <br>
                    </li>
                    <li class="list-group-item" id="DeportistaEtapas" style="display:none;">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label"  id="EtapaNacionalL" >Etapa nacional:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <input name="EtapaNacionalT" id="EtapaNacionalT"type="hidden">
                                <select name="EtapaNacional" id="EtapaNacional" class="form-control">
                                    <option value="">Seleccionar</option>                                                           
                                </select>
                            </div> 
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label"  id="EtapaInternacionalL" >Etapa internacional:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <input name="EtapaInternacionalT" id="EtapaInternacionalT"type="hidden">
                                <select name="EtapaInternacional" id="EtapaInternacional" class="form-control">
                                    <option value="">Seleccionar</option>                                                           
                                </select>
                            </div>                           
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label"  id="SmmlvL" >Salario mínimo actual:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <input class="form-control" placeholder="Salario mínimo mensual legal vigente" type="text" name="Smmlv" id="Smmlv">
                            </div>                           
                        </div>
                        <br>
                    </li>
                    <div class="panel-body">
                        <p>DATOS PERSONALES</p>
                    </div>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="NombresL" >Nombres:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <input class="form-control" placeholder="Nombres" type="text" name="Nombres" id="Nombres">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="ApellidosL">Apellidos:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <input class="form-control" placeholder="Apellidos" type="text" name="Apellidos" id="Apellidos">
                            </div>
                        </div>
                        <br>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label"  id="TipoDocumentoL" >Tipo Documento:</label>
                            </div>
                            <div class="form-group col-md-10">
                                <input class="form-control" placeholder="Tipo Documento" type="text" name="TipoDocumento" id="TipoDocumento">
                            </div>
                        </div>
                        <br>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label" id="NumeroDocumentoL" >Número documento:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <input class="form-control" placeholder="Número Documento" type="text" name="NumeroDocumento" id="NumeroDocumento">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label" id="LugarExpedicionL">Lugar Expedición:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="LugarExpedicion" id="LugarExpedicion" class="form-control">
                                    <option value="">Seleccionar</option>                    
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label" id="FechaExpedicionL">Fecha Expedición:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group date form-control" id="FechaExpedicionDate" style="border: none;">
                                    <input id="FechaExpedicion" class="form-control " type="text" value="" name="FechaExpedicion" default="" data-date="" data-behavior="FechaExpedicion">
                                <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                </div>    
                            </div>    
                        </div>
                        <br>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="PasaporteL" >Número de pasaporte:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <input class="form-control" placeholder="Número de pasaporte" type="text" name="Pasaporte" id="Pasaporte">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="FechaVigenciaPasaporteL">Fecha vigencia pasaporte:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group date form-control" id="FechaVigenciaPasaporteDate" style="border: none;">
                                    <input id="FechaVigenciaPasaporte" class="form-control " type="text" value="" name="FechaVigenciaPasaporte" default="" data-date="" data-behavior="FechaVigenciaPasaporte">
                                <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                </div>    
                            </div>
                        </div>
                        <br>
                    </li>
                    <div class="panel-body">
                        <p>DATOS DE NACIMIENTO</p>
                    </div> 
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="GeneroL" >Género:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="Genero" id="Genero" class="form-control">
                                    <option value="">Seleccionar</option>                   
                                </select>                                
                            </div>                        
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="fechaNacL" >Fecha nacimiento:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group date form-control" id="fechaNacDate" style="border: none;">
                                    <input id="fechaNac" class="form-control " type="text" value="" name="fechaNacL" default="" data-date="" data-behavior="fechaNac">
                                <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                </div>    
                            </div>                        
                        </div>
                        <br>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label" id="PaisNacL" >País nacimiento:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="PaisNac" id="PaisNac" class="form-control">
                                    <option value="">Seleccionar</option>                        
                                </select>                                
                            </div>
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label" id="DepartamentoNacL">Departamento nacimiento:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="DepartamentoNac" id="DepartamentoNac" class="form-control">
                                    <option value="">Seleccionar</option>                  
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label" id="MunicipioNacL">Municipio nacimiento:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <input class="form-control" placeholder="Municipio de nacimiento" type="text" name="MunicipioNac" id="MunicipioNac">
                            </div>
                        </div>
                        <br>
                    </li>       
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="EstadoCivilL" >Estado civil:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="EstadoCivil" id="EstadoCivil" class="form-control">
                                    <option value="">Seleccionar</option>           
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="EstratoL" >Estrato:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="Estrato" id="Estrato" class="form-control">
                                    <option value="">Seleccionar</option>                
                                </select>
                            </div>
                        </div>
                        <br>
                    </li>
                    <div class="panel-body">
                        <p>DATOS MILITARES</p>
                    </div>         
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label" id="LibretaPregL" >Tiene libreta militar?:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="LibretaPreg" id="LibretaPreg" class="form-control">
                                    <option value="">Seleccionar</option>                  
                                    <option value="1">Si</option>                  
                                    <option value="2">No</option>                  
                                </select>
                            </div>
                            <div id="militares" style="display:none;">
                                <div class="form-group col-md-1">
                                    <label for="inputEmail" class="control-label" id="LibretaL" >Número de libreta militar:</label>
                                </div>
                                <div class="form-group col-md-3">
                                    <input class="form-control" placeholder="Número de libreta militar" type="text" name="Libreta" id="Libreta">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="inputEmail" class="control-label" id="DistritoL">Número de distrito:</label>
                                </div>
                                <div class="form-group col-md-3">
                                    <input class="form-control" placeholder="Número de distrito" type="text" name="Distrito" id="Distrito">
                                </div>
                            </div>
                        </div>
                        <br>
                    </li>
                    <div class="panel-body">
                        <p>DATOS DE CONTACTO</p>
                    </div>         
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="NombreContactoL" >En caso de emergencia contactar a:</label>
                            </div>
                            <div class="form-group col-md-10">
                                <input class="form-control" placeholder="Nombre de contacto" type="text" name="NombreContacto" id="NombreContacto">
                            </div>
                        </div>
                        <br>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="ParentescoL" >Parentesco:</label>
                            </div>
                            <div class="form-group col-md-10">
                                <select name="Parentesco" id="Parentesco" class="form-control">
                                    <option value="">Seleccionar</option>                
                                </select>
                            </div>
                        <br>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="FijoContactoL" >Teléfono Fijo:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <input class="form-control" placeholder="Télefono Fijo del contacto" type="text" name="FijoContacto" id="FijoContacto">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="CelularContactoL" >Teléfono Celular:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <input class="form-control" placeholder="Télefono celular del contacto" type="text" name="CelularContacto" id="CelularContacto">
                            </div>
                        </div>
                        <br>
                    </li>
                    <div class="panel-body">
                        <p>DATOS BANCARIOS</p>
                    </div> 
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label" id="TipoCuentaL" >Tipo cuenta:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="TipoCuenta" id="TipoCuenta" class="form-control">
                                    <option value="">Seleccionar</option>                 
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label" id="BancoL">Banco:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="Banco" id="Banco" class="form-control">
                                    <option value="">Seleccionar</option>                           
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label" id="NumeroCuentaL">Número de cuenta:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <input class="form-control" placeholder="Número de cuenta" type="text" name="NumeroCuenta" id="NumeroCuenta">
                            </div>
                        </div>
                        <br>
                    </li>
                    <div class="panel-body">
                        <p>DATOS FAMILIARES</p>
                    </div>       
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="NumeroHijosL" >Número de hijos:</label>
                            </div>
                            <div class="form-group col-md-10">
                                <input class="form-control" placeholder="Número de hijos" type="text" name="NumeroHijos" id="NumeroHijos">
                            </div>
                        <br>
                    </li> 
                </ul>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <div class="bs-callout bs-callout-info">
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                        <label><h4>SECCIÓN DOS:</h4></label>
                        <label><p>Localización</p></label> 
                        <span data-role="ver" id="seccion_dos_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                    </div>
                </div>                
                <ul class="list-group" id="seccion_dos" name="seccion_dos" style="display: none">
                    <div class="panel-body">
                        <p>DATOS DE LOCALIZACIÓN</p>
                    </div> 
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="DepartamentoLocL" >Departamento :</label>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="DepartamentoLoc" id="DepartamentoLoc" class="form-control">
                                    <option value="">Seleccionar</option>                 
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="MunicipioLocL">Municipio:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="MunicipioLoc" id="MunicipioLoc" class="form-control">
                                    <option value="">Seleccionar</option>                          
                                </select>
                            </div>
                        </div>
                        <br>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="DireccionL" >Dirección :</label>
                            </div>
                            <div class="form-group col-md-4">
                                <input class="form-control" placeholder="Dirección de donde reside" type="text" name="Direccion" id="Direccion">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="BarrioL">Barrio:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <input class="form-control" placeholder="Barrio donde reside" type="text" name="Barrio" id="Barrio">
                            </div>
                        </div>
                        <br>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label" id="LocalidadL" >Localidad:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="Localidad" id="Localidad" class="form-control">
                                    <option value="">Seleccionar</option>                         
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label" id="FijoLocL">Teléfono fijo:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <input class="form-control" placeholder="Teléfono fijo" type="text" name="FijoLoc" id="FijoLoc">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label" id="CelularLocL">Teléfono celular:</label>
                            </div>
                            <div class="form-group col-md-3">
                                <input class="form-control" placeholder="Teléfono celular" type="text" name="CelularLoc" id="CelularLoc">
                            </div>
                        </div>
                        <br>
                    </li>  
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="CorreoL" >Correo electrónico:</label>
                            </div>
                            <div class="form-group col-md-10">
                                <input class="form-control" placeholder="Correo electrónico" type="text" name="Correo" id="Correo">
                            </div>
                        <br>
                    </li>  
                </ul>
        </div>
        <div class="panel">
            <div class="panel-heading">
                <div class="bs-callout bs-callout-info">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    <label><h4>SECCIÓN TRES:</h4></label>
                    <label><p>Seguridad Social</p></label> 
                    <span data-role="ver" id="seccion_tres_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                </div>
            </div>                
            <ul class="list-group" id="seccion_tres" name="seccion_tres" style="display: none">
                <div class="panel-body">
                    <p>DATOS DE SEGURIDAD SOCIAL</p>
                </div> 
                <li class="list-group-item">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="inputEmail" class="control-label" id="RegimenL" >Regimen de salud:</label>
                        </div>
                        <div class="form-group col-md-10">
                            <select name="Regimen" id="Regimen" class="form-control">
                                <option value="">Seleccionar</option>                         
                            </select>
                        </div>
                    <br>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="inputEmail" class="control-label" id="FechaAfiliacionL" >FechaA filiación :</label>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input-group date form-control" id="FechaAfiliacionDate" style="border: none;">
                                <input id="FechaAfiliacion" class="form-control " type="text" value="" name="FechaAfiliacion" default="" data-date="" data-behavior="FechaAfiliacion">
                            <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                            </div>    
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEmail" class="control-label" id="TipoAfiliacionL">Tipo Afiliación:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="TipoAfiliacion" id="TipoAfiliacion" class="form-control">
                                <option value="">Seleccionar</option>                   
                            </select>
                        </div>
                    </div>
                    <br>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="inputEmail" class="control-label" id="MedicinaPrepagoL" >Medicina prepago :</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="MedicinaPrepago" id="MedicinaPrepago" class="form-control">
                                <option value="">Seleccionar</option> 
                                <option value="1">Si</option> 
                                <option value="2">No</option> 
                            </select>
                        </div>
                        <div id="MedicinaPrepagoD" style="display:none;">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="NombreMedicinaPrepagoL" >Nombre de la entidad :</label>
                            </div>
                            <div class="form-group col-md-4">
                                <input class="form-control" placeholder="Nombre de la entidad prepago" type="text" name="NombreMedicinaPrepago" id="NombreMedicinaPrepago">
                            </div>
                        </div>
                        <div id="MedicinaPrepagoE" style="display:none;">
                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="EpsL">Eps:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="Eps" id="Eps" class="form-control">
                                    <option value="">Seleccionar</option>                        
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                </li>
                <li class="list-group-item" id="NivelRegimenD" style="display:none;">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="inputEmail" class="control-label" id="NivelRegimenL" >Nivel de regimen subsidiado:</label>
                        </div>
                        <div class="form-group col-md-10">
                            <select name="NivelRegimen" id="NivelRegimen" class="form-control">
                                <option value="">Seleccionar</option>                                                 
                            </select>
                        </div>
                    <br>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="form-group col-md-1">
                            <label for="inputEmail" class="control-label" id="RiesgosLaboralesL" >Riesgos laborales :</label>
                        </div>
                        <div class="form-group col-md-3">
                            <select name="RiesgosLaborales" id="RiesgosLaborales" class="form-control">
                                <option value="">Seleccionar</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select>
                        </div>
                        <div id="ArlD" style="display:none;">
                            <div class="form-group col-md-1">
                                <label for="inputEmail" class="control-label" id="ArlL" >Nombre Arl (LEY 1562/12):</label>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="Arl" id="Arl" class="form-control">
                                    <option value="">Seleccionar</option>                                                       
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-1">
                            <label for="inputEmail" class="control-label" id="FondoPensionPregL">Fondo pensiones:</label>
                        </div>
                        <div class="form-group col-md-3">
                            <select name="FondoPensionPreg" id="FondoPensionPreg" class="form-control">
                                <option value="">Seleccionar</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select>
                        </div>
                    </div>
                    <br>
                </li>
                <li class="list-group-item">
                    <div class="row" id="FondoPensionD" style="display:none;">
                        <div class="form-group col-md-2" >
                            <label for="inputEmail" class="control-label" id="FondoPensionL" >Nombre del fondo de pensiones:</label>
                        </div>
                        <div class="form-group col-md-10">
                            <select name="FondoPension" id="FondoPension" class="form-control">
                                <option value="">Seleccionar</option>                                                        
                            </select>
                        </div>
                    <br>
                </li>-->
            <!--</ul>
        </div>      
        <div id="Botonera" >
            <center>
                <button type="button" class="btn btn-primary" name="Enviar" id="Registrar">Registrar</button>
                <button type="button" class="btn btn-info" name="Reenviar" id="Modificar">Modificar</button>
            </center>
        </div>
        <br><br><br><br><br>               
            </div>
        </div>
    </div>
  </div>   
  <div class="form-group"  id="mensaje_actividad" style="display: none;">
    <div id="alert_actividad"></div>
  </div> 
</form>-->
@stop