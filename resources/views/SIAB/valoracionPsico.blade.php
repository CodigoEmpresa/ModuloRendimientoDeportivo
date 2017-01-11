@extends('master')
@section('script')
  @parent
    <script src="{{ asset('public/Js/buscar_personas.js') }}"></script>     
    <script src="{{ asset('public/Js/SIAB/psico.js') }}"></script>   
    <script src="{{ asset('public/Js/bootstrap-datepicker.js') }}"></script>   
    {{Html::style('public/Css/bootstrap-datepicker3.css')}}   
   
@stop  
@section('content')
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>VALORACIÓN PSICOSOCIAL</h3></center>
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
                            <div class="col-xs-12"><br></div>
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
        <form id="psico" name="psico" >
            <div id="camposRegistro" style="display:none;">
                <input type="hidden" name="persona" id="persona" value=""/>
                <input type="hidden" name="deportista" id="deportista" value=""/>
                <input type="hidden" name="valoracion" id="valoracion" value=""/>
                <div class="content">
                    <div class="content">
                        <div style="text-align:center;">
                            <h3>Valoración psicosocial</h3>
                        </div>  
                        <div class="panel">
                            <!-- Default panel contents -->
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
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label" id="fechaNacL" >Fecha nacimiento:</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="input-group date form-control" id="fechaNacDate" style="border: none;">
                                                <input id="fechaNac" class="form-control " type="text" value="" name="fechaNacL" default="" data-date="" data-behavior="fechaNac">
                                            <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            </div>    
                                        </div> 
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label" id="MunicipioNacL">Municipio nacimiento:</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input class="form-control" placeholder="Municipio de nacimiento" type="text" name="MunicipioNac" id="MunicipioNac">
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label"  id="NumeroDocumentoL" >Documento de identidad:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Documento" type="text" name="NumeroDocumento" id="NumeroDocumento">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label"  id="EtniaL" >Grupo étnico:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select name="Etnia" id="Etnia" class="form-control">
                                                <option value="">Seleccionar</option>                                                
                                                @foreach($Etnia as $Etnia)
                                                    <option value="{{ $Etnia['Id_Etnia'] }}">{{ $Etnia['Nombre_Etnia'] }}</option>
                                                @endforeach                           
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label"  id="GeneroL" >Género:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select name="Genero" id="Genero" class="form-control" readonly>
                                                <option value="">Seleccionar</option>                                                
                                                @foreach($Genero as $Genero)
                                                    <option value="{{ $Genero['Id_Genero'] }}">{{ $Genero['Nombre_Genero'] }}</option>
                                                @endforeach                           
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label" id="GrupoSanguineoL" >Tipo de sangre:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select name="GrupoSanguineo" id="GrupoSanguineo" class="form-control">
                                                <option value="">Seleccionar</option>
                                                @foreach($GrupoSanguineo as $GrupoSanguineo)
                                                    <option value="{{ $GrupoSanguineo['Id_GrupoSanguineo'] }}">{{ $GrupoSanguineo['Nombre_GrupoSanguineo'] }}</option>
                                                @endforeach                                                           
                                            </select>
                                        </div> 
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label" id="EpsL">Eps:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select name="Eps" id="Eps" class="form-control" style="display:none;">
                                                <option value="">Seleccionar</option>                        
                                                @foreach($Eps as $Eps)
                                                    <option value="{{ $Eps['Id_Eps'] }}">{{ $Eps['Nombre_Eps'] }}</option>
                                                @endforeach                           
                                            </select>
                                            <input class="form-control" placeholder="Discapacidad" type="text" name="Prepagada" id="Prepagada"  style="display:none;">
                                        </div>                      
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label" id="DiscapacidadL">Discapacidad:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Discapacidad" type="text" name="Discapacidad" id="Discapacidad">
                                        </div>                      
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label" id="MunicipioLocL">Ciudad de residencia:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select name="MunicipioLoc" id="MunicipioLoc" class="form-control">
                                                <option value="">Seleccionar</option>
                                                @foreach($Ciudad as $MunicipioLoc)
                                                        <option value="{{ $MunicipioLoc['Id_Ciudad'] }}">{{ $MunicipioLoc['Nombre_Ciudad'] }}</option>
                                                @endforeach   
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label" id="DireccionL" >Dirección :</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Dirección de donde reside" type="text" name="Direccion" id="Direccion">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label" id="EstratoL" >Estrato:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select name="Estrato" id="Estrato" class="form-control">
                                                <option value="">Seleccionar</option>
                                                @foreach($Estrato as $Estrato)
                                                        <option value="{{ $Estrato['Id'] }}">{{ $Estrato['Nombre_Estrato'] }}</option>
                                                @endforeach                   
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label" id="FijoLocL" >Teléfono Fijo:</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input class="form-control" placeholder="Télefono Fijo del contacto" type="text" name="FijoLoc" id="FijoLoc">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label" id="CelularContactoL" >Teléfono Celular:</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input class="form-control" placeholder="Télefono celular del contacto" type="text" name="CelularLoc" id="CelularLoc">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label" id="CorreoL" >Correo electrónico:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Correo electrónico" type="text" name="Correo" id="Correo">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label" id="PasaporteL" >Número de pasaporte:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" placeholder="Número de pasaporte" type="text" name="Pasaporte" id="Pasaporte">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label" id="FechaVigenciaPasaporteL">Vigencia:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="input-group date form-control" id="FechaVigenciaPasaporteDate" style="border: none;">
                                                <input id="FechaVigenciaPasaporte" class="form-control " type="text" value="" name="FechaVigenciaPasaporteL" default="" data-date="" data-behavior="FechaVigenciaPasaporte">
                                            <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label" id="LibretaPregL" >Situación militar resuelta:</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input type="hidden" value="" name="lp" id="lp" >
                                            <select name="LibretaPreg" id="LibretaPreg" class="form-control" readonly>
                                                <option value="">Seleccionar</option>                  
                                                <option value="1">Si</option>                  
                                                <option value="2">No</option>                  
                                            </select>
                                        </div>
                                        <div id="LibretaPorqueD" style="display:none;">
                                            <div class="form-group col-md-2" >
                                                <label for="inputEmail" class="control-label" id="LibretaPorqueL" >Por qué?:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <textarea class="form-control" placeholder="Por qué?" name="LibretaPorque" id="LibretaPorque"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail" class="control-label" id="DesplazamientoPregL" >Ha sufrido alguna sitación de desplazamiento:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <select name="DesplazamientoPreg" id="DesplazamientoPreg" class="form-control">
                                                <option value="">Seleccionar</option>                  
                                                <option value="1">Si</option>                  
                                                <option value="2">No</option>                  
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" id="DesplazamientoD" style="display:none;">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail" class="control-label" id="DesplazamientoDescL" >Descripción o consecuencia:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <textarea class="form-control" placeholder="Descripción o consecuencia del desplazamiento" name="DesplazamientoDesc" id="DesplazamientoDesc"></textarea>
                                        </div>
                                    </div>
                                </li>
                            </ul>                            
                        </div>
                        <!-- ------------------------------------------SECCION DOS---------------------------------------- -->
                        <div class="panel-heading">                
                            <div class="bs-callout bs-callout-info">                    
                                <span class="glyphicon glyphicon-knight" aria-hidden="true"></span>
                                <label><p>DATOS DEPORTIVOS</p></label>                         
                                <span data-role="ver" id="seccion_dos_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                            </div>
                        </div>                 
                        <ul class="list-group" id="seccion_dos" name="seccion_dos">
                           <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label"  id="DeporteL" >Deporte:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select name="Deporte" id="Deporte" class="form-control">
                                            <option value="">Seleccionar</option>
                                            @foreach($Deporte as $Deporte)
                                                    <option value="{{ $Deporte['Id'] }}">{{ $Deporte['Nombre_Deporte'] }}</option>
                                            @endforeach                   
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label"  id="ModalidadL" >Modalidad:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select name="Modalidad" id="Modalidad" class="form-control">
                                            <option value="">Seleccionar</option>      
                                            @foreach($Modalidad as $Modalidad)
                                                    <option value="{{ $Modalidad['Id'] }}">{{ $Modalidad['Nombre_Modalidad'] }}</option>
                                            @endforeach                                             
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label"  id="ClubL" >Club deportivo:</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <select name="Club" id="Club" class="selectpicker form-control" data-live-search="true">
                                            <option value="">Seleccionar</option> 
                                             @foreach($Club as $Club)
                                                <option value="{{ $Club['PK_I_ID_CLUB'] }}">{{ $Club['V_NOMBRE_CLUB'] }}</option>
                                            @endforeach                     
                                        </select>
                                    </div>                           
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail" class="control-label"  id="Fecha_AnioPL" >Año en el que empezo a practicar este deporte:</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <div class="input-group date form-control" id="Fecha_AnioPDate" style="border: none;">
                                            <input id="Fecha_AnioP" class="form-control " type="text" value="" name="Fecha_AnioP" default="" data-date="" data-behavior="Fecha_AnioP">
                                            <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail" class="control-label"  id="EdadPregL" >A que edad comenzo a practicar este deporte:</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input class="form-control" placeholder="Edad en la que inicio en el deporte" type="text" name="EdadPreg" id="EdadPreg" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label"  id="EdadPregL" >Año(s):</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail" class="control-label"  id="PracticaPregL" >Cuantos años lleva practicándolo:</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input class="form-control" placeholder="Edad en la que inicio en el deporte" type="text" name="PracticaPreg" id="PracticaPreg" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label"  id="EdadPregL" >Año(s):</label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <!-- ------------------------------------------SECCION TRES---------------------------------------- -->
                        <div class="panel-heading">                
                            <div class="bs-callout bs-callout-info">                    
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                                <label><p>1. INFORMACIÓN FAMILIAR</p></label>                         
                                <span data-role="ver" id="seccion_tres_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                            </div>
                        </div>                 
                        <ul class="list-group" id="seccion_tres" name="seccion_tres">
                           <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">1. Estado civil:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op1" id="p1o1" value="Soltero(a)">Soltero(a)</label></div>
                                        <div class="radio"><label><input type="radio" name="op1" id="p1o2" value="Casado(a)">Casado(a)</label></div>
                                        <div class="radio"><label><input type="radio" name="op1" id="p1o3" value="Divorciado(a)">Divorciado(a)</label></div>
                                        <div class="radio"><label><input type="radio" name="op1" id="p1o4" value="Viudo(a)">Viudo(a)</label></div>
                                        <div class="radio"><label><input type="radio" name="op1" id="p1o5" value="Unión libre">Unión libre</label></div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">2. Hijos:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op2" id="p2o1" value="Sin hijos">Sin hijos</label></div>
                                        <div class="radio"><label><input type="radio" name="op2" id="p2o2" value="Un hijo">Un hijo</label></div>
                                        <div class="radio"><label><input type="radio" name="op2" id="p2o3" value="Dos Hijos">Dos Hijos</label></div>
                                        <div class="radio"><label><input type="radio" name="op2" id="p2o4" value="Tres o más hijos">Tres o más hijos</label></div>
                                    </div>
                                </div>
                           </li>
                           <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">3. Estado civil de los padres:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op3" id="p3o1" value="Casado(a)">Casado(a)</label></div>
                                        <div class="radio"><label><input type="radio" name="op3" id="p3o2" value="En unión libre">En unión libre</label></div>
                                        <div class="radio"><label><input type="radio" name="op3" id="p3o3" value="Separados o divorciados">Separados o divorciados</label></div>
                                        <div class="radio"><label><input type="radio" name="op3" id="p3o4" value="Padre o madre viudo(a)">Padre o madre viudo(a)</label></div>
                                        <div class="radio"><label><input type="radio" name="op3" id="p3o5" value="Padres fallecidos">Padres fallecidos</label></div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">4. Con quién vive actualmente? <small>(Puede marcar más de una opción)</small></label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="checkbox" name="op4[]" id="p4o1" value="Madre">Madre</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op4[]" id="p4o2" value="Padre">Padre</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op4[]" id="p4o3" value="Hermano(s)">Hermano(s)</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op4[]" id="p4o4" value="Hermana(s)">Hermana(s)</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op4[]" id="p4o5" value="Abuel@s">Abuel@s</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op4[]" id="p4o6" value="Amig@s">Amig@s</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op4[]" id="p4o7" value="Pareja">Pareja</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op4[]" id="p4o8" value="Hijos">Hijos</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op4[]" id="p4o9" value="Solo">Solo</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op4[]" id="p4o10" value="Otros">Otros</label></div>
                                        <div id="porqueOP4" style="display:none;">
                                            <label for="inputEmail" class="control-label">Otros:</label>
                                            <textarea class="form-control" placeholder="Otros" type="text" name="otro4" id="otro4"></textarea>
                                        </div>                                    
                                    </div>
                                </div>
                           </li>
                           <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">5. Número de personas con las que vive:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op5" id="p5o1" value="Cuatro(4) o  menos personas">Cuatro(4) o  menos personas</label></div>
                                        <div class="radio"><label><input type="radio" name="op5" id="p5o2" value="De cuatro(4) a siete(7) personas">De cuatro(4) a siete(7) personas</label></div>
                                        <div class="radio"><label><input type="radio" name="op5" id="p5o3" value="Más de siete(7) personas">Más de siete(7) personas</label></div>
                                        <div class="radio"><label><input type="radio" name="op5" id="p5o4" value="Compañeros en alojamiento deportivo">Compañeros en alojamiento deportivo</label></div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">6. Número de personas a cargo:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="form-control" placeholder="Número de personas a cargo" type="text" name="op6" id="op6">
                                    </div>
                                </div>
                               </li>
                           <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">7. La responsabilidades familiares <small>(ej. Cuidado hermanos, limpieza hogar, etc)</small> recaen:</label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="radio"><label><input type="checkbox" name="op7[]" id="p7o1" value="Atleta">Atleta</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op7[]" id="p7o2" value="Madre">Madre</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op7[]" id="p7o3" value="Padre">Padre</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op7[]" id="p7o4" value="Pareja">Pareja</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op7[]" id="p7o5" value="Otros miembros de la familia">Otros miembros de la familia</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op7[]" id="p7o6" value="Empleada">Empleada</label></div>
                                    </div>
                                </div>
                           </li>
                       </ul>  
                        <!-- ------------------------------------------SECCION CUATRO---------------------------------------- -->
                        <div class="panel-heading">                
                            <div class="bs-callout bs-callout-info">                    
                                <span class="glyphicon glyphicon-education" aria-hidden="true"></span>
                                <label><p>2. FORMACIÓN</p></label>                         
                                <span data-role="ver" id="seccion_cuatro_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                            </div>
                        </div>                 
                        <ul class="list-group" id="seccion_cuatro" name="seccion_cuatro">
                           <li class="list-group-item">   
                               <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail" class="control-label">8. Títulos obtenidos:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <div class="radio"><label><input type="radio" name="op8" id="p8o1" value="Primaria">Primaria</label></div>
                                            <div class="radio"><label><input type="radio" name="op8" id="p8o2" value="Bachillerato">Bachillerato</label></div>
                                            <div class="radio"><label><input type="radio" name="op8" id="p8o3" value="Técnico">Técnico</label></div>
                                            <div class="radio"><label><input type="radio" name="op8" id="p8o4" value="Tecnológico">Tecnológico</label></div>
                                            <div class="radio"><label><input type="radio" name="op8" id="p8o5" value="Pregrado">Pregrado</label></div>
                                            <div class="radio"><label><input type="radio" name="op8" id="p8o6" value="Especialización">Especialización</label></div>
                                            <div class="radio"><label><input type="radio" name="op8" id="p8o7" value="Maestría">Maestría</label></div>
                                            <div class="radio"><label><input type="radio" name="op8" id="p8o8" value="Doctorado">Doctorado</label></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail" class="control-label">Último título:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <input class="form-control" placeholder="Último título" type="text" name="op81" id="op81">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail" class="control-label">Institución:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <input class="form-control" placeholder="Institución" type="text" name="op82" id="op81">
                                        </div>
                                    </div>                                
                                </div>                  
                           </li>
                           <li class="list-group-item">   
                               <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">9. Cómo ha sido su rendimiento académico hasta el nivel alcanzado?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op9" id="p9o1" value="No estudió">No estudió</label></div>
                                        <div class="radio"><label><input type="radio" name="op9" id="p9o2" value="Abandonos frecuentes">Abandonos frecuentes</label></div>
                                        <div class="radio"><label><input type="radio" name="op9" id="p9o3" value="Bajo rendimiento">Bajo rendimiento</label></div>
                                        <div class="radio"><label><input type="radio" name="op9" id="p9o4" value="Rendimiento regular">Rendimiento regular</label></div>
                                        <div class="radio"><label><input type="radio" name="op9" id="p9o5" value="Buen rendimiento">Buen rendimiento</label></div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">10. ¿Actualmente estudia?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op10" id="p10o1" value="Si">Si</label></div>
                                        <div class="radio"><label><input type="radio" name="op10" id="p10o2" value="No">No</label></div>
                                    </div>
                                </div>                  
                           </li>
                           <div id="porqueOP10" style="display:none;">
                               <li class="list-group-item">   
                                   <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail" class="control-label">11. Estudio actuales:</label>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <div class="radio"><label><input type="radio" name="op11" id="p11o1" value="Primaria">Primaria</label></div>
                                                <div class="radio"><label><input type="radio" name="op11" id="p11o2" value="Bachillerato">Bachillerato</label></div>
                                                <div class="radio"><label><input type="radio" name="op11" id="p11o3" value="Técnico">Técnico</label></div>
                                                <div class="radio"><label><input type="radio" name="op11" id="p11o4" value="Tecnológico">Tecnológico</label></div>
                                                <div class="radio"><label><input type="radio" name="op11" id="p11o5" value="Pregrado">Pregrado</label></div>
                                                <div class="radio"><label><input type="radio" name="op11" id="p11o6" value="Especialización">Especialización</label></div>
                                                <div class="radio"><label><input type="radio" name="op11" id="p11o7" value="Maestría">Maestría</label></div>
                                                <div class="radio"><label><input type="radio" name="op11" id="p11o8" value="Doctorado">Doctorado</label></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail" class="control-label">Título:</label>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <input class="form-control" placeholder="Título" type="text" name="op111" id="op111">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail" class="control-label">Institución:</label>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <input class="form-control" placeholder="Institución" type="text" name="op112" id="op112">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail" class="control-label">Curso o semestre:</label>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <input class="form-control" placeholder="Curso o semestre" type="text" name="op113" id="op113">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail" class="control-label">Horario:</label>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <input class="form-control" placeholder="Horario" type="text" name="op114" id="op114">
                                            </div>
                                        </div> 
                                    </div>                  
                               </li>                       
                               <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">12. ¿Piensa que sus estudios son compatibles con su dedicación actual al deporte?:</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="radio"><label><input type="radio" name="op12" id="p12o1" value="Si">Si</label></div>
                                            <div class="radio"><label><input type="radio" name="op12" id="p12o2" value="No">No</label></div>
                                            <div id="porqueOP12">
                                                <label for="inputEmail" class="control-label">¿POR QUE?:</label>
                                                <textarea class="form-control" placeholder="Porque" type="text" name="otro12" id="otro12"></textarea>
                                            </div>                                    
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">13. La financiación de sus estudios esta a cargo de:</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="radio"><label><input type="radio" name="op13" id="p13o1" value="Usted mismo">Usted mismo</label></div>
                                            <div class="radio"><label><input type="radio" name="op13" id="p13o2" value="Familia">Familia</label></div>
                                            <div class="radio"><label><input type="radio" name="op13" id="p13o3" value="Beca universitaria">Beca universitaria</label></div>
                                            <div class="radio"><label><input type="radio" name="op13" id="p13o4" value="Terceros">Terceros</label></div>
                                            <div class="radio"><label><input type="radio" name="op13" id="p13o5" value="Programa de rendimiento deportivo IDRD">Programa de rendimiento deportivo IDRD</label></div>
                                        </div>
                                    </div>
                               </li>                           
                               <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-">
                                            <label for="inputEmail" class="control-label">14. ¿Alguna situación académica está afectando su proceso de participación y preparación en la actividad deportiva?</label>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="radio">
                                                <label><input type="radio" name="op14" id="p14o1" value="Si">Si</label>
                                                <label><input type="radio" name="op14" id="p14o2" value="No">No</label>
                                            </div>
                                            <div id="porqueOP14" style="display:none;">
                                                <label for="inputEmail" class="control-label">¿CUAL?:</label>
                                                <textarea class="form-control" placeholder="Cúal" type="text" name="otro14" id="otro14"></textarea>
                                            </div>                                    
                                        </div>   
                                    </div>
                                </li>
                            </div>
                            <div id="porqueOP10N" style="display:none;">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail" class="control-label">15. Si NO estudia, ¿Cuáles son las causas?</label>
                                        </div>
                                        <div class="form-group col-md-12">                                        
                                            <textarea class="form-control" placeholder="¿Cuáles son las causas?" type="text" name="op15" id="op15"></textarea>
                                        </div>                                    
                                    </div>
                               </li>
                               <li class="list-group-item">
                                    <div class="row">                                                                      
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">16. Si no esta estudiando, ¿que le gustaría estudiar?</label>
                                        </div>
                                        <div class="form-group col-md-4">                                        
                                            <textarea class="form-control" placeholder="¿Que le gustaría estudiar?" type="text" name="op16" id="op16"></textarea>
                                        </div>                                    
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">17. ¿En que institución le gustaría estudiar?</label>
                                        </div>
                                        <div class="form-group col-md-4">                                        
                                            <textarea class="form-control" placeholder="¿Que le gustaría estudiar?" type="text" name="op17" id="op17"></textarea>
                                        </div>                                    
                                    </div>
                               </li>
                           </div>
                           <li class="list-group-item">
                                <div class="row">                                                                      
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">18. Especifique los idiomas diferentes al español que: habla, lee, escribe de forma Regular(R), Bien (B) o Muy Bien (MB)</label>
                                    </div>
                                    <div class="form-group col-md-14">    
                                        <table class="table">
                                            <th>IDIOMA</th>
                                            <th>HABLA</th>
                                            <th>LEE</th>
                                            <th>ESCRIBE</th>
                                            <th>ACCIÓN</th>
                                            <tr>
                                                <td>
                                                    <input class="form-control" placeholder="Idioma" type="text" name="Idioma" id="Idioma">
                                                </td>
                                                <td>
                                                    <select name="Habla" id="Habla" class="form-control">
                                                        <option value="">Seleccionar</option>
                                                        <option value="1">Muy Bien (MB)</option>
                                                        <option value="2">Bien (B)"</option>
                                                        <option value="3">Regular (R)</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="Lee" id="Lee" class="form-control">
                                                        <option value="">Seleccionar</option>
                                                        <option value="1">Muy Bien (MB)</option>
                                                        <option value="2">Bien (B)"</option>
                                                        <option value="3">Regular (R)</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="Escribe" id="Escribe" class="form-control">
                                                        <option value="">Seleccionar</option>
                                                        <option value="1">Muy Bien (MB)</option>
                                                        <option value="2">Bien (B)"</option>
                                                        <option value="3">Regular (R)</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info" name="Add_Idioma" id="Add_Idioma">Agregar Idioma</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group"  id="mensaje_idioma" style="display: none;">
                                                        <div id="alert_idioma"></div>
                                                    </div>
                                                </td>                                            
                                            </tr>
                                        </table>
                                        <center><div id="IdiomasT" class="form-group col-md-10"></div></center>
                                    </div>
                                </div>
                           </li>
                        </ul>  
                        <!-- ------------------------------------------SECCION CINCO---------------------------------------- -->
                        <div class="panel-heading">                
                            <div class="bs-callout bs-callout-info">                    
                                <span class="glyphicon glyphicon-signal" aria-hidden="true"></span>
                                    <label><p>3. SITUACIÓN LABORAL</p></label>                         
                                <span data-role="ver" id="seccion_cinco_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                            </div>
                        </div>                 
                        <ul class="list-group" id="seccion_cinco" name="seccion_cinco">
                           <li class="list-group-item">   
                               <div class="row">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail" class="control-label">19. ¿Se encuentra trabajando actualmente?:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <div class="radio">
                                                <label><input type="radio" name="op19" id="p19o1" value="Si">Si</label>
                                                <label><input type="radio" name="op19" id="p19o2" value="No">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12" id="porqueOP19" style="display:none;">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail" class="control-label">Cargo:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <input class="form-control" placeholder="Cargo" type="text" name="op191" id="op191">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail" class="control-label">Empresa:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <input class="form-control" placeholder="Empresa" type="text" name="op192" id="op192">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail" class="control-label">Horario:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <input class="form-control" placeholder="Horario" type="text" name="op193" id="op193">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail" class="control-label">Tipo de contrato:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <input class="form-control" placeholder="Tipo de contrato" type="text" name="op194" id="op194">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail" class="control-label">Antigüedad:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <input class="form-control" placeholder="Antigüedad" type="text" name="op195" id="op195">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail" class="control-label">Ingreso mensual:</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <input class="form-control" placeholder="Sueldo" type="text" name="op196" id="op196">
                                        </div>
                                    </div> 
                                </div>                  
                           </li>
                           <li class="list-group-item">   
                               <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">20. ¿Cuántos trabajos ha tenido hasta ahora?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op20" id="p20o1" value="No ha trabajado">No ha trabajado</label></div>
                                        <div class="radio"><label><input type="radio" name="op20" id="p20o2" value="De 1 a 3 trabajos en la vida">De 1 a 3 trabajos en la vida</label></div>
                                        <div class="radio"><label><input type="radio" name="op20" id="p20o3" value="4 o más trabajos en la vida">4 o más trabajos en la vida</label></div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">21. ¿En estos momentos se encuentra buscando trabajo?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio">
                                            <label><input type="radio" name="op21" id="p21o1" value="Si">Si</label>
                                            <label><input type="radio" name="op21" id="p21o2" value="No">No</label>
                                        </div>
                                    </div>
                                </div>
                           </li>
                           <li class="list-group-item">   
                               <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">22.De acuerdo a sus estudios, habilidades y características, en que ámbito le gustaría trabajar?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <textarea class="form-control" placeholder="Descripción?" type="text" name="op22" id="op22"></textarea>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">23. ¿En que institución o empresa?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <textarea class="form-control" placeholder="Descripción?" type="text" name="op23" id="op23"></textarea>
                                    </div>
                                </div>
                           </li>
                           <li class="list-group-item">   
                               <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">24. ¿Se encuentra interesado en crear su propia empresa?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio">
                                            <label><input type="radio" name="op24" id="p24o1" value="Si">Si</label>
                                            <label><input type="radio" name="op24" id="p24o2" value="No">No</label>
                                        </div>
                                    </div>
                                    <div id="porqueOP14N" style="display:none;">                                    
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">25. Si no trabaja, ¿Por qué?</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="radio"><label><input type="radio" name="op25" id="p25o1" value="No lo necesita">No lo necesita</label></div>
                                            <div class="radio"><label><input type="radio" name="op25" id="p25o2" value="No le interesa por ahora">No le interesa por ahora</label></div>
                                            <div class="radio"><label><input type="radio" name="op25" id="p25o3" value="No encuentra trabajo">No encuentra trabajo</label></div>
                                            <div class="radio"><label><input type="radio" name="op25" id="p25o4" value="No tiene tiempo">No tiene tiempo</label></div>
                                        </div>
                                    </div>
                                </div>
                           </li>
                           <li class="list-group-item">   
                               <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">26. las necesidades económicas del atleta para su práctica deportiva son asumidas por:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="checkbox" name="op26[]" id="p26o1" value="Atleta">Atleta</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op26[]" id="p26o2" value="Madre">Madre</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op26[]" id="p26o3" value="Padre">Padre</label></div>                                        
                                        <div class="radio"><label><input type="checkbox" name="op26[]" id="p26o4" value="Pareja">Pareja</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op26[]" id="p26o5" value="Otros miembros de la familia">Otros miembros de la familia</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op26[]" id="p26o6" value="Patrocinios deportivos">Patrocinios deportivos</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op26[]" id="p26o7" value="Apoyos ecónomicos dPrograma de rendimiento IDRD">Apoyos ecónomicos Programa de rendimiento IDRD</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op26[]" id="p26o8" value="Otros">Otros</label></div>

<!--                                        <div class="radio"><label><input type="radio" name="op26" id="p26o1" value="Atleta">Atleta</label></div>
                                        <div class="radio"><label><input type="radio" name="op26" id="p26o2" value="Madre">Madre</label></div>
                                        <div class="radio"><label><input type="radio" name="op26" id="p26o3" value="Padre">Padre</label></div>                                        
                                        <div class="radio"><label><input type="radio" name="op26" id="p26o4" value="Pareja">Pareja</label></div>
                                        <div class="radio"><label><input type="radio" name="op26" id="p26o5" value="Otros miembros de la familia">Otros miembros de la familia</label></div>
                                        <div class="radio"><label><input type="radio" name="op26" id="p26o6" value="Patrocinios deportivos">Patrocinios deportivos</label></div>
                                        <div class="radio"><label><input type="radio" name="op26" id="p26o7" value="Apoyos ecónomicos dPrograma de rendimiento IDRD">Apoyos ecónomicos dPrograma de rendimiento IDRD</label></div>
                                        <div class="radio"><label><input type="radio" name="op26" id="p26o8" value="Otros">Otros</label></div>-->
                                        <div id="porqueOP26" style="display:none;">
                                            <label for="inputEmail" class="control-label">Otros:</label>
                                            <textarea class="form-control" placeholder="Otros" type="text" name="otro26" id="otro26"></textarea>
                                        </div>                                    
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">27. Las necesidades familiares de manutención recaen:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op27" id="p27o1" value="Atleta">Atleta</label></div>
                                        <div class="radio"><label><input type="radio" name="op27" id="p27o2" value="Madre">Madre</label></div>
                                        <div class="radio"><label><input type="radio" name="op27" id="p27o3" value="Padre">Padre</label></div>                                        
                                        <div class="radio"><label><input type="radio" name="op27" id="p27o4" value="Pareja">Pareja</label></div>
                                        <div class="radio"><label><input type="radio" name="op27" id="p27o5" value="Otros miembros de la familia">Otros miembros de la familia</label></div>                                 
                                    </div>
                                </div>
                           </li>
                       </ul>
                       <!-- ------------------------------------------SECCION SEIS---------------------------------------- -->
                        <div class="panel-heading">                
                            <div class="bs-callout bs-callout-info">                    
                                <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                    <label><p>4. REDES DE APOYO</p></label>                         
                                <span data-role="ver" id="seccion_seis_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                            </div>
                        </div>                 
                        <ul class="list-group" id="seccion_seis" name="seccion_seis">
                           <li class="list-group-item">   
                               <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">28. Sus relaciones personales son:</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">MADRE</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <div class="radio">
                                            <table class="table">
                                                <tr>                                                    
                                                    <td>
                                                        <label><input type="radio" name="op281" id="p281o1" value="Buena">Buena</label>&nbsp;
                                                        <label><input type="radio" name="op281" id="p281o2" value="Regular">Regular</label>&nbsp;
                                                        <label><input type="radio" name="op281" id="p281o3" value="Mala">Mala</label>&nbsp;
                                                    </td>
                                                    <td>                                                    
                                                        <textarea class="form-control" placeholder="Causa" type="text" name="otro281" id="otro281"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>                                        
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">PADRE</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <div class="radio">
                                            <table class="table">
                                                <tr>                                                    
                                                    <td>
                                                        <label><input type="radio" name="op282" id="p282o1" value="Buena">Buena</label>&nbsp;
                                                        <label><input type="radio" name="op282" id="p282o2" value="Regular">Regular</label>&nbsp;
                                                        <label><input type="radio" name="op282" id="p282o3" value="Mala">Mala</label>&nbsp;
                                                    </td>
                                                    <td>                                                    
                                                        <textarea class="form-control" placeholder="Causa" type="text" name="otro282" id="otro282"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>                                        
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">HERMANOS(AS)</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <div class="radio">
                                            <table class="table">
                                                <tr>                                                    
                                                    <td>
                                                        <label><input type="radio" name="op283" id="p283o1" value="Buena">Buena</label>&nbsp;
                                                        <label><input type="radio" name="op283" id="p283o2" value="Regular">Regular</label>&nbsp;
                                                        <label><input type="radio" name="op283" id="p283o3" value="Mala">Mala</label>&nbsp;
                                                    </td>
                                                    <td>                                                    
                                                        <textarea class="form-control" placeholder="Causa" type="text" name="otro283" id="otro283"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>                                        
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">PAREJA/NOVIO(A)</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <div class="radio">
                                            <table class="table">
                                                <tr>                                                    
                                                    <td>
                                                        <label><input type="radio" name="op284" id="p284o1" value="Buena">Buena</label>&nbsp;
                                                        <label><input type="radio" name="op284" id="p284o2" value="Regular">Regular</label>&nbsp;
                                                        <label><input type="radio" name="op284" id="p284o3" value="Mala">Mala</label>&nbsp;
                                                    </td>
                                                    <td>                                                    
                                                        <textarea class="form-control" placeholder="Causa" type="text" name="otro284" id="otro284"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>                                        
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">ENTRENADOR(A)</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <div class="radio">
                                            <table class="table">
                                                <tr>                                                    
                                                    <td>
                                                        <label><input type="radio" name="op285" id="p285o1" value="Buena">Buena</label>&nbsp;
                                                        <label><input type="radio" name="op285" id="p285o2" value="Regular">Regular</label>&nbsp;
                                                        <label><input type="radio" name="op285" id="p285o3" value="Mala">Mala</label>&nbsp;
                                                    </td>
                                                    <td>                                                    
                                                        <textarea class="form-control" placeholder="Causa" type="text" name="otro285" id="otro285"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>                                        
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">COMPAÑEROS DE EQUIPO</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <div class="radio">
                                            <table class="table">
                                                <tr>                                                    
                                                    <td>
                                                        <label><input type="radio" name="op286" id="p286o1" value="Buena">Buena</label>&nbsp;
                                                        <label><input type="radio" name="op286" id="p286o2" value="Regular">Regular</label>&nbsp;
                                                        <label><input type="radio" name="op286" id="p286o3" value="Mala">Mala</label>&nbsp;
                                                    </td>
                                                    <td>                                                    
                                                        <textarea class="form-control" placeholder="Causa" type="text" name="otro286" id="otro286"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>                                        
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">AMIGOS</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <div class="radio">
                                            <table class="table">
                                                <tr>                                                    
                                                    <td>
                                                        <label><input type="radio" name="op287" id="p287o1" value="Buena">Buena</label>&nbsp;
                                                        <label><input type="radio" name="op287" id="p287o2" value="Regular">Regular</label>&nbsp;
                                                        <label><input type="radio" name="op287" id="p287o3" value="Mala">Mala</label>&nbsp;
                                                    </td>
                                                    <td>                                                    
                                                        <textarea class="form-control" placeholder="Causa" type="text" name="otro287" id="otro287"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>                                        
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">EQUIPO MULTIDISCIPLINARIO</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <div class="radio">
                                            <table class="table">
                                                <tr>                                                    
                                                    <td>
                                                        <label><input type="radio" name="op288" id="p288o1" value="Buena">Buena</label>&nbsp;
                                                        <label><input type="radio" name="op288" id="p288o2" value="Regular">Regular</label>&nbsp;
                                                        <label><input type="radio" name="op288" id="p288o3" value="Mala">Mala</label>&nbsp;
                                                    </td>
                                                    <td>                                                    
                                                        <textarea class="form-control" placeholder="Causa" type="text" name="otro288" id="otro288"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>                                        
                                    </div>
                                </div>
                           </li>
                           <li class="list-group-item">   
                               <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">29. ¿Cuenta con el apoyo que requiere como atleta de las personas más representativas en su vida?</label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="op29" id="p29o1" value="Si">Si</label>
                                            <label><input type="radio" name="op29" id="p29o2" value="No">No</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <table class="table form-group col-md-12">
                                            <th>DE QUIENES?</th>
                                            <th>EXPLIQUE</th>
                                            <th>ACCIÓN</th>
                                            <tr>
                                                <td>
                                                    <input class="form-control" placeholder="¿De quienes?" type="text" name="Quien29" id="Quien29">
                                                </td>
                                                <td>
                                                   <textarea class="form-control" placeholder="¿Explique?" type="text" name="Razon29" id="Razon29"></textarea>
                                                </td>                                                
                                                <td>
                                                    <button type="button" class="btn btn-info" name="Add_Idioma" id="Add_Quien">Agregar persona</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group"  id="mensaje_quien" style="display: none;">
                                                        <div id="alert_quien"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <center><div id="QuienT" class="form-group col-md-10"></div></center>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">   
                               <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">30. ¿Su familia está de acuerdo con su dedicación deportiva y con el estilo de vida que lleva como atleta de alto rendimiento?</label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="op30" id="p30o1" value="Si">Si</label>
                                            <label><input type="radio" name="op30" id="p30o2" value="No">No</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div id="porqueOP30">
                                            <label for="inputEmail" class="control-label">EXPLIQUE:</label>
                                            <textarea class="form-control" placeholder="Explique" type="text" name="otro30" id="otro30"></textarea>
                                        </div>                                    
                                    </div>
                                </div>
                            </li>
                       </ul>
                       <!-- ------------------------------------------SECCION SIETE---------------------------------------- -->
                        <div class="panel-heading">                
                            <div class="bs-callout bs-callout-info">                    
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                                <label><p>5. DEDICACIÓN</p></label>                         
                                <span data-role="ver" id="seccion_siete_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                            </div>
                        </div>                 
                        <ul class="list-group" id="seccion_siete" name="seccion_siete">
                           <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">31. Complete el cuadro valorando su dedicación actual (Intensidad horario semanal) en cada ámbito planteado.<br>
                                            Finalmente, ¿cúal es la prioridad que tiene cada ámbito en su vida?. Seleccione Baja, Mediana o Alta
                                        </label>
                                    </div>
                                    <div class="form-group col-md-2"></div>
                                    <div class="form-group col-md-10">
                                        <table class="table">
                                            <th>INTENSIDAD HORARIA SEMANAL</th>
                                            <th>PRIORIDAD</th>
                                        </table>                                        
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">Deporte</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <table class="table">
                                            <tr>                                                    
                                                <td>
                                                    <input class="form-control"  type="text" name="op311a" id="op311a">
                                                </td>
                                                <td>                                                    
                                                    <select name="op311b" id="op311b" class="form-control">
                                                        <option value="">Seleccionar</option>
                                                        <option value="1">Alta</option>
                                                        <option value="2">Mediana</option>
                                                        <option value="3">Baja</option>                                                        
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>                                        
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">Estudios</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <table class="table">
                                            <tr>                                                    
                                                <td><input class="form-control"  type="text" name="op312a" id="op312a"></td>
                                                <td>
                                                    <select name="op312b" id="op312b" class="form-control">
                                                        <option value="">Seleccionar</option>
                                                        <option value="1">Alta</option>
                                                        <option value="2">Mediana</option>
                                                        <option value="3">Baja</option>                                                        
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>                                        
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">Trabajo</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <table class="table">
                                            <tr>                                                    
                                                <td><input class="form-control"  type="text" name="op313a" id="op313a"></td>
                                                <td>
                                                    <select name="op313b" id="op313b" class="form-control">
                                                        <option value="">Seleccionar</option>
                                                        <option value="1">Alta</option>
                                                        <option value="2">Mediana</option>
                                                        <option value="3">Baja</option>                                                        
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>                                        
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">Familia</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <table class="table">
                                            <tr>                                                    
                                                <td><input class="form-control"  type="text" name="op314a" id="op314a"></td>
                                                <td>
                                                    <select name="op314b" id="op314b" class="form-control">
                                                        <option value="">Seleccionar</option>
                                                        <option value="1">Alta</option>
                                                        <option value="2">Mediana</option>
                                                        <option value="3">Baja</option>                                                        
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>                                        
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">Pareja</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <table class="table">
                                            <tr>                                                    
                                                <td><input class="form-control"  type="text" name="op315a" id="op315a"></td>
                                                <td>
                                                    <select name="op315b" id="op315b" class="form-control">
                                                        <option value="">Seleccionar</option>
                                                        <option value="1">Alta</option>
                                                        <option value="2">Mediana</option>
                                                        <option value="3">Baja</option>                                                        
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>                                        
                                    </div>
                                     <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">Amigos</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <table class="table">
                                            <tr>                                                    
                                                <td><input class="form-control"  type="text" name="op316a" id="op316a"></td>
                                                <td>
                                                    <select name="op316b" id="op316b" class="form-control">
                                                        <option value="">Seleccionar</option>
                                                        <option value="1">Alta</option>
                                                        <option value="2">Mediana</option>
                                                        <option value="3">Baja</option>                                                        
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>                                        
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">Recuperación</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <table class="table">
                                            <tr>                                                    
                                                <td><input class="form-control"  type="text" name="op317a" id="op317a"></td>
                                                <td>
                                                    <select name="op317b" id="op317b" class="form-control">
                                                        <option value="">Seleccionar</option>
                                                        <option value="1">Alta</option>
                                                        <option value="2">Mediana</option>
                                                        <option value="3">Baja</option>                                                        
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>                                        
                                    </div>
                                </div>
                            </li>
                             <li class="list-group-item">
                                <div class="row">                                    
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">32. ¿Sus responsabilidades actuales impiden concentrarse un 100% en su proceso de preparación deportiva?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio">
                                            <div class="radio"><label><input type="radio" name="op32" id="p32o1" value="Si">Si</label></div>
                                            <div class="radio"><label><input type="radio" name="op32" id="p32o2" value="No">No</label></div>
                                        </div>
                                        <div id="porqueOP32" style="display:none;">
                                            <label for="inputEmail" class="control-label">CÚAL?:</label>
                                            <textarea class="form-control" placeholder="Otros" type="text" name="otro32" id="otro32"></textarea>
                                        </div>                                    
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">33. ¿Recibe alguna ayuda o beca económica por parte de otra institución para llevar a cabo su práctica deportiva?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio">
                                            <div class="radio"><label><input type="radio" name="op33" id="p33o1" value="Si">Si</label></div>
                                            <div class="radio"><label><input type="radio" name="op33" id="p33o2" value="No">No</label></div>
                                        </div>
                                        <div id="porqueOP33" style="display:none;">
                                            <label for="inputEmail" class="control-label">CÚAL?:</label>
                                            <textarea class="form-control" placeholder="Otros" type="text" name="otro33" id="otro33"></textarea>
                                        </div> 
                                    </div>
                                </div>
                           </li>
                        </ul>
                        <!-- ------------------------------------------SECCION OCHO---------------------------------------- -->
                        <div class="panel-heading">                
                            <div class="bs-callout bs-callout-info">                    
                                <span class="glyphicon glyphicon-road" aria-hidden="true"></span>
                                <label><p>6. DESPLAZAMIENTO</p></label>                        
                                <span data-role="ver" id="seccion_ocho_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                            </div>
                        </div>                 
                        <ul class="list-group" id="seccion_ocho" name="seccion_ocho">
                           <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">34. Su medio habitual de transporte para desplazarse es:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="checkbox" name="op34[]" id="p34o1" value="Caminando">Caminando</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op34[]" id="p34o2" value="Bicicleta">Bicicleta</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op34[]" id="p34o3" value="Bus urbano">Bus urbano</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op34[]" id="p34o4" value="SITP/Transmilenio">SITP/Transmilenio</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op34[]" id="p34o5" value="Carro particular">Carro particular</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op34[]" id="p34o6" value="Moto">Moto</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op34[]" id="p34o7" value="Taxi">Taxi</label></div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">35. El tiempo que utiliza para desplazarse entre su lugar de trabajo/estudio/hogar al sitio de entrenamiento es en promedio:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op35" id="p35o1" value="Menos de 15'">Menos de 15'</label></div>
                                        <div class="radio"><label><input type="radio" name="op35" id="p35o2" value="Entre 15' a 30'">Entre 15' a 30'</label></div>
                                        <div class="radio"><label><input type="radio" name="op35" id="p35o3" value="Entre 31' a 1 hora">Entre 31' a 1 hora</label></div>
                                        <div class="radio"><label><input type="radio" name="op35" id="p35o4" value="Entre 1 hora y 1 hora 1/2">Entre 1 hora y 1 hora 1/2</label></div>
                                        <div class="radio"><label><input type="radio" name="op35" id="p35o5" value="Más de 1 hora 1/2">Más de 1 hora 1/2</label></div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <!-- ------------------------------------------SECCION NUEVE---------------------------------------- -->
                        <div class="panel-heading">                
                            <div class="bs-callout bs-callout-info">                    
                                <span class="glyphicon glyphicon-tower" aria-hidden="true"></span>
                                <label><p>7. CARRERA DEPORTIVA</p></label>                        
                                <span data-role="ver" id="seccion_nueve_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                            </div>
                        </div>                 
                        <ul class="list-group" id="seccion_nueve" name="seccion_nueve">
                           <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">36. ¿El deporte de rendimiento y la obtención de resultados son el motor diario de su proyecto de vida?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op36" id="p36o1" value="Si">Si</label></div>
                                        <div class="radio"><label><input type="radio" name="op36" id="p36o2" value="No">No</label></div>
                                        <div id="porqueOP36">
                                            <label for="inputEmail" class="control-label">¿POR QUE?:</label>
                                            <textarea class="form-control" placeholder="Porque" type="text" name="otro36" id="otro36"></textarea>
                                        </div>                                    
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">37. ¿Considera que el deporte de rendimiento le ofrecerá oportunidades de vida que no encontrará si no fuera atleta?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op37" id="p37o1" value="Si">Si</label></div>
                                        <div class="radio"><label><input type="radio" name="op37" id="p37o2" value="No">No</label></div>
                                        <div id="porqueOP37">
                                            <label for="inputEmail" class="control-label">¿POR QUE?:</label>
                                            <textarea class="form-control" placeholder="Porque" type="text" name="otro37" id="otro37"></textarea>
                                        </div>                                    
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">38. ¿Considera la práctica deportiva como un momento pasajero en su vida?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op38" id="p38o1" value="Si">Si</label></div>
                                        <div class="radio"><label><input type="radio" name="op38" id="p38o2" value="No">No</label></div>
                                        <div id="porqueOP38">
                                            <label for="inputEmail" class="control-label">¿POR QUE?:</label>
                                            <textarea class="form-control" placeholder="Porque" type="text" name="otro38" id="otro38"></textarea>
                                        </div>                                    
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">39. ¿Ha pensado alguna vez en retirarse del deporte?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op39" id="p39o1" value="Si">Si</label></div>
                                        <div class="radio"><label><input type="radio" name="op39" id="p39o2" value="No">No</label></div>
                                        <div id="porqueOP39">
                                            <label for="inputEmail" class="control-label">¿POR QUE?:</label>
                                            <textarea class="form-control" placeholder="Porque" type="text" name="otro39" id="otro39"></textarea>
                                        </div>                                    
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">40. Aunque todavía no lo haya programado, para cuando lo ha pensado?:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op40" id="p40o1" value="Inmediata">Inmediata</label></div>
                                        <div class="radio"><label><input type="radio" name="op40" id="p40o2" value="Menos de 2 años">Menos de 2 años</label></div>
                                        <div class="radio"><label><input type="radio" name="op40" id="p40o3" value="Entre 2 y 5 años">Entre 2 y 5 años</label></div>
                                        <div class="radio"><label><input type="radio" name="op40" id="p40o4" value="Mas de 5 años">Mas de 5 años</label></div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">41. ¿Cúales serían o son sus motivos de retiro? (Puede señalar más de una opción)</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="checkbox" name="op41[]" id="p41o1" value="Edad">Edad</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op41[]" id="p41o2" value="Estudios">Estudios</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op41[]" id="p41o3" value="Trabajo">Trabajo</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op41[]" id="p41o4" value="Familia">Familia</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op41[]" id="p41o5" value="Económico">Económico</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op41[]" id="p41o6" value="Lesiones">Lesiones</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op41[]" id="p41o7" value="Enfermedades">Enfermedades</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op41[]" id="p41o8" value="Rendimiento">Rendimiento</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op41[]" id="p41o9" value="Malas relaciones con el entrenador">Malas relaciones con el entrenador</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op41[]" id="p41o10" value="Malas relaciones con los compañeros">Malas relaciones con los compañeros</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op41[]" id="p41o11" value="Otros">Otros</label></div>
                                        <div id="porqueOP41" style="display:none;">
                                            <label for="inputEmail" class="control-label">Otros:</label>
                                            <textarea class="form-control" placeholder="Otros" type="text" name="otro41" id="otro41"></textarea>
                                        </div>                                    
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">42. ¿Que proyecta hacer cuando finalice su carrera deportiva?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <textarea class="form-control" placeholder="Descripción" type="text" name="op42" id="op42"></textarea>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">43. ¿Que le preocupa de su futuro?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <textarea class="form-control" placeholder="Descripción" type="text" name="op43" id="op43"></textarea>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">44. ¿Como ha pensado solucionarlo?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <textarea class="form-control" placeholder="Descripción" type="text" name="op44" id="op44"></textarea>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <!-- ------------------------------------------SECCION DIEZ---------------------------------------- -->
                        <div class="panel-heading">                
                            <div class="bs-callout bs-callout-info">                    
                                <span class="glyphicon glyphicon-link" aria-hidden="true"></span>
                                <label><p>8. SENTIDO DE PERTENENCIA</p></label>                        
                                <span data-role="ver" id="seccion_diez_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                            </div>
                        </div>                 
                        <ul class="list-group" id="seccion_diez" name="seccion_diez">
                           <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">45. ¿Se siente orgulloso de lucir la implementación deportiva de Bogotá?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op45" id="p45o1" value="Si">Si</label></div>
                                        <div class="radio"><label><input type="radio" name="op45" id="p45o2" value="No">No</label></div>
                                        <div id="porqueOP45">
                                            <label for="inputEmail" class="control-label">EXPLIQUE:</label>
                                            <textarea class="form-control" placeholder="Porque" type="text" name="otro45" id="otro45"></textarea>
                                        </div>                                    
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">46. ¿Se sabe el himno de nuestra ciudad</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op46" id="p46o1" value="Si">Si</label></div>
                                        <div class="radio"><label><input type="radio" name="op46" id="p46o2" value="No">No</label></div>                     
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">47. ¿Encuentra alguna dificultad para llevar a cabo su práctica deportiva?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op47" id="p47o1" value="Si">Si</label></div>
                                        <div class="radio"><label><input type="radio" name="op47" id="p47o2" value="No">No</label></div>
                                        <div id="porqueOP47" style="display:none;">
                                            <div class="radio"><label><input type="checkbox" name="op472[]" id="p472o1" value="Económica">Económica</label></div>
                                            <div class="radio"><label><input type="checkbox" name="op472[]" id="p472o2" value="Personal">Personal</label></div>
                                            <div class="radio"><label><input type="checkbox" name="op472[]" id="p472o3" value="Académica">Académica</label></div>
                                            <div class="radio"><label><input type="checkbox" name="op472[]" id="p472o4" value="Tiempo">Tiempo</label></div>
                                            <div class="radio"><label><input type="checkbox" name="op472[]" id="p472o5" value="Otras">Otras</label></div>
                                            <div id="porqueOP472" style="display:none;">
                                                <label for="inputEmail" class="control-label">EXPLIQUE:</label>
                                                <textarea class="form-control" placeholder="Porque" type="text" name="otro472" id="otro472"></textarea>
                                            </div>
                                        </div>                                    
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">48. ¿Siente que el programa de rendimiento deportivo del IDRD ha favorecido en la obtención de sus resultados?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op48" id="p48o1" value="Si">Si</label></div>
                                        <div class="radio"><label><input type="radio" name="op48" id="p48o2" value="No">No</label></div>
                                        <div id="porqueOP48">
                                            <label for="inputEmail" class="control-label">¿POR QUE? ¿EN QUE?:</label>
                                            <textarea class="form-control" placeholder="Porque" type="text" name="otro48" id="otro48"></textarea>
                                        </div>                                    
                                    </div>
                                </div>
                            </li>
                             <li class="list-group-item">
                                <div class="row">                                    
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">49. ¿Conoce la normativa del Programa de Rendimiento Deportivo? (Resolución vigente, Deberes y Obligaciones)</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op49" id="p49o1" value="Si">Si</label></div>
                                        <div class="radio"><label><input type="radio" name="op49" id="p49o2" value="No">No</label></div>                                        
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">50. ¿Está de acuerdo con las exigencias o compromisos que implica el Programa de Rendimiento Deportivo?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op50" id="p50o1" value="Si">Si</label></div>
                                        <div class="radio"><label><input type="radio" name="op50" id="p50o2" value="No">No</label></div>      
                                        <div id="porqueOP50">
                                            <label for="inputEmail" class="control-label">EXPLIQUE:</label>
                                            <textarea class="form-control" placeholder="Porque" type="text" name="otro50" id="otro50"></textarea>
                                        </div>                                                   
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">51. ¿Qué mejoras sugiere al Programa de Rendimiento Deportivo para el beneficio del atleta y su desempeño integral?</label>
                                    </div>
                                    <div class="form-group col-md-4">                                        
                                        <textarea class="form-control" placeholder="¿Cuáles son las causas?" type="text" name="op51" id="op51"></textarea>
                                    </div>   
                                </div>
                            </li>
                        </ul>
                        <!-- ------------------------------------------SECCION ONCE---------------------------------------- -->
                        <div class="panel-heading">                
                            <div class="bs-callout bs-callout-info">                    
                                <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
                                <label><p>8. SITUACIÓN JURÍDICA</p></label>                        
                                <span data-role="ver" id="seccion_once_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                            </div>
                        </div>                 
                        <ul class="list-group" id="seccion_once" name="seccion_once">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">52. ¿En estos momentos se encuentra en una situación que requiera sesoría jurídica?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="radio"><label><input type="radio" name="op52" id="p52o1" value="Si">Si</label></div>
                                        <div class="radio"><label><input type="radio" name="op52" id="p52o2" value="No">No</label></div>
                                        <div id="porqueOP52" style="display:none;">
                                            <div class="radio"><label><input type="checkbox" name="op522[]" id="p522o1" value="Derecho de familia">Derecho de familia</label></div>
                                            <div class="radio"><label><input type="checkbox" name="op522[]" id="p522o2" value="Derecho comercial">Derecho comercial</label></div>
                                            <div class="radio"><label><input type="checkbox" name="op522[]" id="p522o3" value="Legislación deportiva">Legislación deportiva</label></div>
                                            <div class="radio"><label><input type="checkbox" name="op522[]" id="p522o4" value="Otra">Otra</label></div>
                                            <div id="porqueOP522" style="display:none;">
                                                <label for="inputEmail" class="control-label">¿CÚAL?:</label>
                                                <textarea class="form-control" placeholder="Porque" type="text" name="otro522" id="otro522"></textarea>
                                            </div>
                                        </div>      
                                    </div>
                                </div>
                            </li>
                           <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">53. Para finalizar marque los servicios y actividades que son de su interés debtro del Programa de Rendimiento Deportivo</label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">SERVICIOS</label>
                                        <div class="radio"><label><input type="checkbox" name="op53[]" id="p53o1" value="Asesoría educativa">Asesoría educativa</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op53[]" id="p53o2" value="Asesoría laboral">Asesoría laboral</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op53[]" id="p53o3" value="Asesoría jurídica">Asesoría jurídica</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op53[]" id="p53o4" value="Asesoría para planificación de carrera">Asesoría para planificación de carrera</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op53[]" id="p53o5" value="Asesoría, apoyos y estímulos IDRD">Asesoría, apoyos y estímulos IDRD</label></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">ACTIVIDADES</label>
                                        <div class="radio"><label><input type="checkbox" name="op54[]" id="p54o1" value="Becas y ayudas académicas por ser deportista de alto rendimiento">Becas y ayudas académicas por ser deportista de alto rendimiento</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op54[]" id="p54o2" value="¿Cómo hacer mi hoja de vida?">¿Cómo hacer mi hoja de vida?</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op54[]" id="p54o3" value="Tips para desempeñarme en una entrevista de trabjo">Tips para desempeñarme en una entrevista de trabjo</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op54[]" id="p54o4" value="Información sobre el proceso de retiro de la carrera deportiva">Información sobre el proceso de retiro de la carrera deportiva</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op54[]" id="p54o5" value="¿Cómo crear mi propia empresa?">¿Cómo crear mi propia empresa?</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op54[]" id="p54o6" value="¿Cómo desempeñarme en una entrevista con los medio de comunicación?">¿Cómo desempeñarme en una entrevista con los medio de comunicación?</label></div>
                                        <div class="radio"><label><input type="checkbox" name="op54[]" id="p54o7" value="¿Cómo crear mi portafolio de patrocinios deportivos?">¿Cómo crear mi portafolio de patrocinios deportivos?</label></div>
                                </div>
                            </li>
                        </ul>
                        <!-- ------------------------------------------SECCION DOCE---------------------------------------- -->
                        <div class="panel-heading">                
                            <div class="bs-callout bs-callout-info">                    
                                <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                                <label><p>CONCEPTO PROFESIONAL</p></label>                        
                                <span data-role="ver" id="seccion_doce_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                            </div>
                        </div>                 
                        <ul class="list-group" id="seccion_doce" name="seccion_doce">
                            <li class="list-group-item">
                                <div class="row">
                                    <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">CONCEPTO PROFESIONAL</label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" placeholder="Concepto del profesional?" name="ConceptoProfesional" id="ConceptoProfesional"></textarea>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <!-- ------------------------------------------SECCION TRECE---------------------------------------- -->
                        <div class="panel-heading">                
                            <div class="bs-callout bs-callout-info">                    
                                <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                                <label><p>A. PLAN DE ACCIÓN</p></label>                        
                                <span data-role="ver" id="seccion_trece_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                            </div>
                        </div>                 
                        <ul class="list-group" id="seccion_trece" name="seccion_trece">
                            <li class="list-group-item">
                                <div class="row">
                                     <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">FACTORES DE RIESGO PSICOSOCIAL</label>
                                    </div>       
                                </div>
                                <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Factores de riesgo psicosocial</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input class="form-control" placeholder="Factor de riesgo" type="text" name="Factor" id="Factor">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Objetivo</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input class="form-control" placeholder="Objetivo" type="text" name="Objetivo" id="Objetivo">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Intervención</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input class="form-control" placeholder="Intervención" type="text" name="Intervencion" id="Intervencion">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Fecha de inicio</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="input-group date form-control" id="Fecha_InicioDate" style="border: none;">
                                                <input id="Fecha_Inicio" class="form-control " type="text" value="" name="Fecha_Inicio" default="" data-date="" data-behavior="Fecha_Inicio">
                                                <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Fecha de terminación</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="input-group date form-control" id="Fecha_FinDate" style="border: none;">
                                                <input id="Fecha_Fin" class="form-control " type="text" value="" name="Fecha_Fin" default="" data-date="" data-behavior="Fecha_Fin">
                                                <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            </div>  
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Responsable de la intervención</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input class="form-control" placeholder="Responsable" type="text" name="Responsable" id="Responsable">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Intervención autorizada por:</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input class="form-control" placeholder="Nombre de quién autoriza" type="text" name="Autorizada" id="Autorizada">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Seguimiento</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input class="form-control" placeholder="Seguimiento" type="text" name="Seguimiento" id="Seguimiento">
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label">Observaciones:</label>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <textarea class="form-control" placeholder="Observaciones" type="text" name="Observacion" id="Observacion"></textarea>
                                        </div>
                                    </div>                                   
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <center><button type="button" class="btn btn-info" name="Add_Riesgo" id="Add_Riesgo">Agregar Riesgo</button></center>
                                        </div>                                    
                                        <div id="RiesgoT" class="form-group col-md-12">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <div class="form-group"  id="mensaje_riesgo" style="display: none;">
                                                <div id="alert_riesgo"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
        
                <!-- ----------------------BOTONERA------------------- -->
                <div id="Botonera" >
                    <center>
                        <button type="button" class="btn btn-primary" name="Enviar" id="Registrar">Registrar valoración</button>
                        <button type="button" class="btn btn-primary" name="Enviar" id="Modificar">Modificar valoración</button>
                    </center>
                </div>
                <!-- ----------------------FIN DE BOTONERA------------------- -->
                <br><br><br><br><br> 
                </div>
                
                <div class="form-group"  id="mensaje_actividad" style="display: none;">
                    <div id="alert_actividad"></div>
                </div>
        </form>        
    </div>
@stop