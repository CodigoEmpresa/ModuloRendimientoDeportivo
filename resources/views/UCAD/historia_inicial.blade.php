@extends('master')
@section('script')
  @parent
    <script src="{{ asset('public/Js/buscar_personas.js') }}"></script>     
    <script src="{{ asset('public/Js/UCAD/historia_inicial.js') }}"></script>   
    <script src="{{ asset('public/Js/bootstrap-datepicker.js') }}"></script>   
    {{Html::style('public/Css/bootstrap-datepicker3.css')}}    
         
@stop  
@section('content')
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>REGISTRO HISTORIA CLINICA INICIAL</h3></center>
 <input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
    <div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
        <div class="content">
            <br>
            <center>
                <h4>Ingrese el número de cédula o nombres de la persona o deportista que va a registrar</h4>
            </center>
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Buscar persona/deportista</h3>
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
    <form id="registro" name="registro">   
        <input type="hidden" name="persona" id="persona" value=""/>
        <input type="hidden" name="deportista" id="deportista" value=""/>
        <div class="container" id="loading" style="display:none;">
            <center><button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button></center>
        </div>
        <div id="camposRegistro" style="display:none;">
            <div class="content" id="RHCI" style="display: none;">
                <div class="content">
                    <div style="text-align:center;">
                        <h3>Registro Inicial de Historia Clínica</h3>
                    </div>  
                    <div class="panel">
                        <!-- Default panel contents -->
                        <div class="panel-heading">                
                            <div class="bs-callout bs-callout-info">                    
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                <label><h4>SECCIÓN UNO:</h4></label>
                                <label><p>Datos Generales</p></label>                         
                                <span data-role="ver" id="seccion_uno_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                            </div>
                        </div>       
                        <ul class="list-group" id="seccion_uno" name="seccion_uno" style="display: none">
                            <li class="list-group-item" id="SImagenLi">
                            </li>

                            <li class="list-group-item">
                                <div class="panel-body">
                                    <p>DATOS BÁSICOS</p>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label" id="FechaRegistro" >Fecha:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <!--<input class="form-control" placeholder="HoraRegistro" type="text" name="Nombres" id="Nombres"> -->
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label" id="HoraRegistro">Hora:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <!--<input class="form-control" placeholder="Apellidos" type="text" name="Apellidos" id="Apellidos">-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label" id="NombresL" >Nombres:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="form-control" placeholder="Nombres" type="text" name="Nombres" id="Nombres" disabled="disabled">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label" id="ApellidosL">Apellidos:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="form-control" placeholder="Apellidos" type="text" name="Apellidos" id="Apellidos" disabled="disabled">
                                    </div>
                                </div>

                                 <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label"  id="TipoDocumentoL" >Tipo Documento:</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <input class="form-control" placeholder="Tipo Documento" type="text" name="TipoDocumento" id="TipoDocumento" disabled="disabled">
                                    </div>                            
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-1">
                                        <label for="inputEmail" class="control-label" id="NumeroDocumentoL" >Número documento:</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input class="form-control" placeholder="Número Documento" type="text" name="NumeroDocumento" id="NumeroDocumento" disabled="disabled">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="inputEmail" class="control-label" id="EdadL" >Edad:</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input class="form-control" placeholder="Edad" type="text" name="Edad" id="Edad" disabled="disabled">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="inputEmail" class="control-label" id="EstadoCivilL" >Estado civil:</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select name="EstadoCivil" id="EstadoCivil" class="form-control" disabled="disabled">
                                            <option value="">Seleccionar</option>
                                            @foreach($EstadoCivil as $EstadoCivil)
                                                    <option value="{{ $EstadoCivil['Id'] }}">{{ $EstadoCivil['Nombre_Estado_Civil'] }}</option>
                                            @endforeach                   
                                        </select>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="panel-body">
                                    <p>DATOS NACIMIENTO</p>
                                </div>
                                <div class="row">                                                    
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label" id="fechaNacL" >Fecha nacimiento:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input-group date form-control" id="fechaNacDate" style="border: none;">
                                            <input id="fechaNac" class="form-control " type="text" value="" name="fechaNacL" default="" data-date="" data-behavior="fechaNac" disabled="disabled">
                                        <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                        </div>    
                                    </div>                        
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label" id="GeneroL" >Género:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select name="Genero" id="Genero" class="form-control" disabled="disabled">
                                            <option value="">Seleccionar</option>
                                            @foreach($Genero as $Genero)
                                                    <option value="{{ $Genero['Id_Genero'] }}">{{ $Genero['Nombre_Genero'] }}</option>
                                            @endforeach                           
                                        </select>                                
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-1">
                                        <label for="inputEmail" class="control-label" id="PaisNacL" >País nacimiento:</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select name="PaisNac" id="PaisNac" class="form-control" disabled="disabled">
                                            <option value="">Seleccionar</option>
                                            @foreach($Pais as $PaisNac)
                                                    <option value="{{ $PaisNac['Id_Pais'] }}">{{ $PaisNac['Nombre_Pais'] }}</option>
                                            @endforeach                           
                                        </select>                                
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="inputEmail" class="control-label" id="DepartamentoNacL">Departamento nacimiento:</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select name="DepartamentoNac" id="DepartamentoNac" class="form-control" disabled="disabled">
                                            <option value="">Seleccionar</option>
                                            @foreach($Departamento as $DepartamentoNac)
                                                    <option value="{{ $DepartamentoNac['Id_Departamento'] }}">{{ $DepartamentoNac['Nombre_Departamento'] }}</option>
                                            @endforeach                           
                                        </select>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="inputEmail" class="control-label" id="MunicipioNacL">Municipio nacimiento:</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input class="form-control" placeholder="Municipio de nacimiento" type="text" name="MunicipioNac" id="MunicipioNac" disabled="disabled">
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="panel-body">
                                    <p>DATOS LOCALIZACIÓN</p>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-1">
                                        <label for="inputEmail" class="control-label" id="DireccionL" >Dirección :</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input class="form-control" placeholder="Dirección de donde reside" type="text" name="Direccion" id="Direccion" disabled="disabled">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="inputEmail" class="control-label" id="MunicipioLocL"> Ciudad:</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <select name="MunicipioLoc" id="MunicipioLoc" class="form-control" disabled="disabled">
                                            <option value="">Seleccionar</option>
                                            @foreach($Ciudad as $MunicipioLoc)
                                                    <option value="{{ $MunicipioLoc['Id_Ciudad'] }}">{{ $MunicipioLoc['Nombre_Ciudad'] }}</option>
                                            @endforeach                           
                                        </select>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="inputEmail" class="control-label" id="EstratoL" >Estrato:</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <select name="Estrato" id="Estrato" class="form-control" disabled="disabled">
                                            <option value="">Seleccionar</option>
                                            @foreach($Estrato as $Estrato)
                                                    <option value="{{ $Estrato['Id'] }}">{{ $Estrato['Nombre_Estrato'] }}</option>
                                            @endforeach                   
                                        </select>
                                    </div> 
                                    <div class="form-group col-md-1">
                                        <label for="inputEmail" class="control-label" id="LocalidadL" >Localidad:</label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <select name="Localidad" id="Localidad" class="form-control" disabled="disabled">
                                            <option value="">Seleccionar</option>
                                            @foreach($Localidad as $Localidad)
                                                    <option value="{{ $Localidad['Id_Localidad'] }}">{{ $Localidad['Nombre_Localidad'] }}</option>
                                            @endforeach                           
                                        </select>
                                    </div>                           
                                </div>

                                <div class="row">                            
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label" id="FijoLocL">Teléfono fijo:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="form-control" placeholder="Teléfono fijo" type="text" name="FijoLoc" id="FijoLoc" disabled="disabled">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label" id="CelularLocL">Teléfono celular:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="form-control" placeholder="Teléfono celular" type="text" name="CelularLoc" id="CelularLoc" disabled="disabled">
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="panel-body">
                                    <p>OTROS DATOS</p>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail" class="control-label"  id="OcupacionL" >Ocupación del deportista:</label>
                                    </div>
                                    <div class="form-group col-md-9">
                                        <select name="Ocupacion" id="Ocupacion" class="form-control">
                                            <option value="">Seleccionar</option>
                                            @foreach($Ocupacion as $Ocupacions)
                                                    <option value="{{ $Ocupacions['Id'] }}">{{ $Ocupacions['Nombre_Ocupacion'] }}</option>
                                            @endforeach                          
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail" class="control-label"  id="NivelEstudioL" >Nivel de estudio del deportista:</label>
                                    </div>
                                    <div class="form-group col-md-9">
                                        <select name="NivelEstudio" id="NivelEstudio" class="form-control">
                                            <option value="">Seleccionar</option>
                                            @foreach($NivelEstudio as $NivelEstudios)
                                                    <option value="{{ $NivelEstudios['Id'] }}">{{ $NivelEstudios['Nivel_Estudio'] }}</option>
                                            @endforeach                          
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail" class="control-label"  id="DominanciaL" >Dominancia del deportista:</label>
                                    </div>
                                    <div class="form-group col-md-9">
                                        <select name="Dominancia" id="Dominancia" class="form-control">
                                            <option value="">Seleccionar</option>
                                             @foreach($Dominancia as $Dominancias)
                                                    <option value="{{ $Dominancias['Id'] }}">{{ $Dominancias['Nombre_Dominancia'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="panel-body">
                                    <p>DATOS DE LOS PADRES</p>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail" class="control-label"  id="NombreMadreL" >Nombre de la madre del deportista:</label>
                                    </div>
                                    <div class="form-group col-md-9">
                                        <input class="form-control" placeholder="Nombre de la madre del deportista" type="text" name="NombreMadre" id="NombreMadre">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail" class="control-label"  id="NombrePadreL" >Nombre del padre del deportista:</label>
                                    </div>
                                    <div class="form-group col-md-9">
                                        <input class="form-control" placeholder="Nombre del padre del deportista" type="text" name="NombrePadre" id="NombrePadre">
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="panel-body">
                                    <p>DATOS ENTIDAD MEDICA</p>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label" id="MedicinaPrepagoL" >Medicina prepago :</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select name="MedicinaPrepago" id="MedicinaPrepago" class="form-control" disabled="disabled">
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
                                            <input class="form-control" placeholder="Nombre de la entidad prepago" type="text" name="NombreMedicinaPrepago" id="NombreMedicinaPrepago" disabled="disabled">
                                        </div>
                                    </div>
                                    <div id="MedicinaPrepagoE" style="display:none;">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label" id="EpsL">Eps:</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <select name="Eps" id="Eps" class="form-control" disabled="disabled">
                                                <option value="">Seleccionar</option>
                                                @foreach($Eps as $Eps)
                                                        <option value="{{ $Eps['Id_Eps'] }}">{{ $Eps['Nombre_Eps'] }}</option>
                                                @endforeach                           
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="panel-body">
                                    <p>DATOS DEPORTIVOS</p>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label"  id="ClasificacionDeportistaL" >Clasificación del deportista:</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <select name="ClasificacionDeportista" id="ClasificacionDeportista" class="form-control" disabled="disabled">
                                            <option value="">Seleccionar</option>
                                            @foreach($ClasificacionDeportista as $ClasificacionDeportista)
                                                    <option value="{{ $ClasificacionDeportista['Id'] }}">{{ $ClasificacionDeportista['Nombre_Clasificacion_Deportista'] }}</option>
                                            @endforeach                           
                                        </select>
                                    </div>
                                </div>                
                                <div class="list-group-item" id="CamposConvencional" style="display: none;">
                                    <div class="row">
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label"  id="AgrupacionL" >Agrupación:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select name="Agrupacion" id="Agrupacion" class="form-control" disabled="disabled">
                                                <option value="">Seleccionar</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label"  id="DeporteL" >Deporte:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select name="Deporte" id="Deporte" class="form-control" disabled="disabled">
                                                <option value="">Seleccionar</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="inputEmail" class="control-label"  id="ModalidadL" >Modalidad:</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select name="Modalidad" id="Modalidad" class="form-control" disabled="disabled">
                                                <option value="">Seleccionar</option>                                
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="list-group-item" id="CamposParalimpico" style="display: none;">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label"  id="AgrupacionL" >Agrupación:</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <select name="AgrupacionP" id="AgrupacionP" class="form-control" disabled="disabled">
                                                <option value="">Seleccionar</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label" id="DiscapacidadL" >Discapacidad:</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <select name="Discapacidad" id="Discapacidad" class="form-control" disabled="disabled">
                                                <option value="">Seleccionar</option>
                                                @foreach($Discapacidad as $Discapacidad)
                                                    <option value="{{ $Discapacidad['Id'] }}">{{ $Discapacidad['Nombre_Discapacidad'] }}</option>
                                                @endforeach                           
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label"  id="DeporteL" >Deporte:</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <select name="DeporteP" id="DeporteP" class="form-control" disabled="disabled">
                                                <option value="">Seleccionar</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail" class="control-label"  id="ModalidadL" >Modalidad:</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <select name="ModalidadP" id="ModalidadP" class="form-control" disabled="disabled">
                                                <option value="">Seleccionar</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="panel-body">
                                    <p>DATOS ENTRENAMIENTO</p>
                                </div>
                                <div class="row" id="TablaEntrenadores">
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label"  id="EdadDeportivaL" >Edad deportiva:</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <input class="form-control" placeholder="Edad deportiva" type="text" name="EdadDeportiva" id="EdadDeportiva">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label"  id="EntrenamientoContinuoPregL" >¿Entrenamiento continuo?:</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                         <select name="EntrenamientoContinuoPreg" id="EntrenamientoContinuoPreg" class="form-control">
                                            <option value="">Seleccionar</option>
                                            <option value="1">Si</option>
                                            <option value="2">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label"  id="PlanEntrenamientoPregL" >¿Plan de entrenamiento?:</label>
                                    </div>
                                    <div class="form-group col-md-10">
                                         <select name="PlanEntrenamientoPreg" id="PlanEntrenamientoPreg" class="form-control">
                                            <option value="">Seleccionar</option>
                                            <option value="1">Si</option>
                                            <option value="2">No</option>
                                        </select>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="panel-body">
                                    <p>DATOS ACUDIENTE</p>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label"  id="NombreAcudienteL" >Nombre del acudiente:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="form-control" placeholder="Nombres del acudiente" type="text" name="NombreAcudiente" id="NombreAcudiente">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label"  id="TelefonoAcudienteL" >Teléfono del acudiente:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="form-control" placeholder="Teléfono del acudiente" type="text" name="TelefonoAcudiente" id="TelefonoAcudienteL">
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="panel-body">
                                    <p>DATOS RESPONSABLE</p>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label"  id="NombreResponsableL" >Nombre del responsable:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="form-control" placeholder="Nombres del responsable" type="text" name="NombreResponsable" id="NombreResponsable">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label"  id="TelefonoResponsableL" >Teléfono del responsable:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="form-control" placeholder="Teléfono del responsable" type="text" name="TelefonoResponsable" id="TelefonoResponsable">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="panel">
                        <!-- Default panel contents -->
                        <div class="panel-heading">                
                            <div class="bs-callout bs-callout-info">                    
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                <label><h4>SECCIÓN DOS:</h4></label>
                                <label><h4>MOTIVO CONSULTA</h4></label>
                                <span data-role="ver" id="seccion_dos_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                            </div>
                        </div>       
                        <ul class="list-group" id="seccion_dos" name="seccion_dos" style="display: none">
                            <li class="list-group-item">                           
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label" id="MotivoConsultaL" >Describa el motivo de la consulta:</label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" placeholder="Nombres" type="text" name="MotivoConsulta" id="MotivoConsulta"></textarea>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                     <div class="panel">
                        <!-- Default panel contents -->
                        <div class="panel-heading">                
                            <div class="bs-callout bs-callout-info">                    
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                <label><h4>SECCIÓN TRES:</h4></label>
                                <label><h4>ANTECEDENTES PATOLOGICOS PERSONALES Y FAMILIARES</h4></label>
                                <span data-role="ver" id="seccion_dos_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                            </div>
                        </div>       
                        <ul class="list-group" id="seccion_tres" name="seccion_tres" style="display: none">
                            <li class="list-group-item">                           
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label" id="MotivoConsultaL" >Describa el motivo de la consulta:</label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" placeholder="Nombres" type="text" name="MotivoConsulta" id="MotivoConsulta"></textarea>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
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
        <div class="form-group"  id="mensaje_actividad" style="display: none;">
            <div id="alert_actividad"></div>
        </div> 
    </form>
</div>
@stop