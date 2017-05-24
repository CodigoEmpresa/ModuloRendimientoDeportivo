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
                            <br><br>
                            <div class="col-xs-12"><ul id="personas"></ul></div>
                            <div class="col-xs-12" id="tablaPersonas"></div>
                            <div class="col-xs-12" id="tablaHistorias"></div>
                            <div id="paginador" class="col-xs-12"></div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" id="loading" style="display:none;">
            <center><button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button></center>
        </div>
<!-- ------------------------------------------------------------------------------------ -->
        <div class="modal fade bs-example-modal-lg" id="verHistoriaD" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" style="width: 70%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Consultas Medicas</h4>
                    </div>
                    <ul class="nav nav-tabs">
                        <li role="presentation" id="InicioConsultaLi" class="active"><a id="InicioCertamen">Datos</a></li>
                        <li role="presentation" id="PruebasCertamenLi" ><a id="PruebasCertamen" >Pruebas</a></li>
                        <li role="presentation" id="DeportistasCertamenLi" ><a id="DeportistasCertamen" >Deportistas</a></li>
                    </ul>
                    <form id="registro" name="registro">   
                        <input type="hidden" name="persona" id="persona" value=""/>
                        <input type="hidden" name="deportista" id="deportista" value=""/>
                        <input type="hidden" name="historia" id="historia" value=""/>
                        <div id="camposRegistro" style="display:none;">
                            <div class="content" id="RHCI" style="display: none;">
                                <div class="content">
                                    <div style="text-align:center;">
                                        <h3 id="Titulo"></h3>
                                    </div>  
                                    <div class="panel">
                                        <!-- Default panel contents -->
                                        <div class="panel-heading">                
                                            <div class="bs-callout bs-callout-info">                    
                                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                                <label><h4>SECCIÓN UNO:</h4></label>
                                                <label><h4>DATOS GENERALES</h4></label>                      
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
                                                        <input class="form-control" placeholder="Teléfono del acudiente" type="text" name="TelefonoAcudiente" id="TelefonoAcudiente">
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
                                                        <textarea class="form-control" placeholder="Motivo de la consulta" type="text" name="MotivoConsulta" id="MotivoConsulta"></textarea>
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
                                                <span data-role="ver" id="seccion_tres_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                                            </div>
                                        </div>       
                                        <ul class="list-group" id="seccion_tres" name="seccion_tres" style="display: none">
                                            <li class="list-group-item">                           
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail" class="control-label" id="MotivoConsultaL" >Describa los antecedentes personales y familiares:</label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <textarea class="form-control" placeholder="Antecedentes personales y familiares" type="text" name="AntecedentePatologico" id="AntecedentePatologico"></textarea>
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
                                                <label><h4>SECCIÓN CUATRO:</h4></label>
                                                <label><h4>ANTECEDENTES OSTEOMUSCULARES</h4></label>
                                                <span data-role="ver" id="seccion_cuatro_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                                            </div>
                                        </div>       
                                        <ul class="list-group" id="seccion_cuatro" name="seccion_cuatro" style="display: none">
                                            <li class="list-group-item">                           
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail" class="control-label" id="MotivoConsultaL" >Describa los antecedentes osteomusculares:</label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <textarea class="form-control" placeholder="Antecedentes osteomusculares" type="text" name="AntecedenteOsteomusculares" id="AntecedenteOsteomusculares"></textarea>
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
                                                <label><h4>SECCIÓN CINCO:</h4></label>
                                                <label><h4>ANTECEDENTES GINECO-OBTETRICOS</h4></label>
                                                <span data-role="ver" id="seccion_cinco_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                                            </div>
                                        </div>       
                                        <ul class="list-group" id="seccion_cinco" name="seccion_cinco" style="display: none">
                                            <li class="list-group-item">                           
                                                <div class="row">
                                                    <div class="form-group col-md-1">
                                                        <label for="inputEmail" class="control-label" id="MenarquiaL"> Menarquia:</label>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <input class="form-control" placeholder="Menarquia" type="text" name="Menarquia" id="Menarquia">
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <label for="inputEmail" class="control-label" id="CicloL"> Ciclo:</label>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <input class="form-control" placeholder="Ciclo" type="text" name="Ciclo" id="Ciclo">
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <label for="inputEmail" class="control-label" id="RegularL"> Regular:</label>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <input class="form-control" placeholder="Regular" type="text" name="Regular" id="Regular">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-1">
                                                        <label for="inputEmail" class="control-label" id="DismenorreaL"> Dismenorrea:</label>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <input class="form-control" placeholder="Dismenorrea" type="text" name="Dismenorrea" id="Dismenorrea">
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <label for="inputEmail" class="control-label" id="FumL"> FUM:</label>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <input class="form-control" placeholder="FUM" type="text" name="Fum" id="Fum">
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <label for="inputEmail" class="control-label" id="FupL"> FUP:</label>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <input class="form-control" placeholder="FUP" type="text" name="Fup" id="Fup">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-1">
                                                        <label for="inputEmail" class="control-label" id="GL"> G:</label>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <input class="form-control" placeholder="G" type="text" name="G" id="G">
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <label for="inputEmail" class="control-label" id="PL"> P:</label>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <input class="form-control" placeholder="P" type="text" name="P" id="P">
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <label for="inputEmail" class="control-label" id="VL"> V:</label>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <input class="form-control" placeholder="V" type="text" name="V" id="V">
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <label for="inputEmail" class="control-label" id="AL"> A:</label>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <input class="form-control" placeholder="A" type="text" name="A" id="A">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-1">
                                                        <label for="inputEmail" class="control-label" id="AmenorreaL"> Amenorrea:</label>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <input class="form-control" placeholder="Amenorrea" type="text" name="Amenorrea" id="Amenorrea">
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <label for="inputEmail" class="control-label" id="PlanificaL"> Planifica?:</label>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <select name="Planifica" id="Planifica" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1">Si</option>
                                                            <option value=2>No</option>
                                                        </select>
                                                    </div>
                                                    <div name="MetodoPreg" id="MetodoPreg" style="display: none;">
                                                        <div class="form-group col-md-1">
                                                            <label for="inputEmail" class="control-label" id="FupL"> Metodo de planificación:</label>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <input class="form-control" placeholder="Metodo de planificación" type="text" name="Metodo" id="Metodo">
                                                        </div>
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
                                                <label><h4>SECCIÓN SEIS:</h4></label>
                                                <label><h4>EXAMEN FISICO GENERAL</h4></label>
                                                <span data-role="ver" id="seccion_seis_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                                            </div>
                                        </div>       
                                        <ul class="list-group" id="seccion_seis" name="seccion_seis" style="display: none">
                                            <li class="list-group-item">    
                                                <div class="panel-body">
                                                    <p>SIGNOS VITALES</p>
                                                </div>                       
                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="PaPieL" >PA de Pie:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input class="form-control" placeholder="Datos de la presión arterial de pie" type="text" name="DatoPaPie" id="DatoPaPie">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación de la presión arterial de pie" type="text" name="ObservacionPaPie" style="display:none;" id="ObservacionPaPie"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="PaSupinoL" >PA Supino:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input class="form-control" placeholder="Datos de la presión arterial supino" type="text" name="DatoPaSupino" id="DatoPaSupino">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación de la presión arterial supino" type="text" name="ObservacionPaSupino" style="display:none;" id="ObservacionPaSupino"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="FCReposoL" >FC Reposo:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input class="form-control" placeholder="Datos de la frecuencia cardiaca en reposo" type="text" name="DatoFCReposo" id="DatoFCReposo">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación de la frecuencia cardiaca en reposo" type="text" name="ObservacionFCReposo" style="display:none;" id="ObservacionFCReposo"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="FRL" >FR:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input class="form-control" placeholder="Datos FR" type="text" name="DatoFR" id="DatoFR">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación FR" type="text" name="ObservacionFR" style="display:none;" id="ObservacionFR"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="TemperaturaL" >Temperatura:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input class="form-control" placeholder="Datos Temperatura" type="text" name="DatoTemperatura" id="DatoTemperatura">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación Temperatura" type="text" name="ObservacionTemperatura" style="display:none;" id="ObservacionTemperatura"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="PesoL" >Peso:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input class="form-control" placeholder="Datos Peso" type="text" name="DatoPeso" id="DatoPeso">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación Peso" type="text" name="ObservacionPeso" style="display:none;" id="ObservacionPeso"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="EstaturaL" >Estatura:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input class="form-control" placeholder="Datos Estatura" type="text" name="DatoEstatura" id="DatoEstatura">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación Estatura" type="text" name="ObservacionEstatura" style="display:none;" id="ObservacionEstatura"></textarea>
                                                    </div>
                                                </div>

                                                <div class="panel-body">
                                                    <p>ORGANOS/SISTEMAS</p>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="CabezaL" >Cabeza:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="DatoCabeza" id="DatoCabeza" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1">N</option>
                                                            <option value="2">A</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación Cabeza" type="text" name="ObservacionCabeza" style="display:none;" id="ObservacionCabeza"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="CuelloL" >Cuello:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="DatoCuello" id="DatoCuello" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1">N</option>
                                                            <option value="2">A</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación Cuello" type="text" name="ObservacionCuello" style="display:none;" id="ObservacionCuello"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="CuelloL" >Agudeza Visual:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="DatoAgudezaVisual" id="DatoAgudezaVisual" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1">N</option>
                                                            <option value="2">A</option>
                                                        </select>
                                                    </div>
                                                    <div id="AgudezaDiv" style="display: none;">
                                                        <div class="form-group col-md-1">
                                                            <label for="inputEmail" class="control-label" id="OIL" >OI:</label>
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <input class="form-control" placeholder="OI" type="text" name="OI" id="OI">
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <label for="inputEmail" class="control-label" id="ODL" >OD:</label>
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <input class="form-control" placeholder="OD" type="text" name="OD" id="OD">
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <label for="inputEmail" class="control-label" id="FDEOL" >F. de O:</label>
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <input class="form-control" placeholder="FDEO" type="text" name="FDEO" id="FDEO">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="AudicionL" >Audición:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="DatoAudicion" id="DatoAudicion" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1">N</option>
                                                            <option value="2">A</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación Audición" type="text" name="ObservacionAudicion" style="display:none;" id="ObservacionAudicion"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="OrlL" >ORL:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="DatoOrl" id="DatoOrl" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1">N</option>
                                                            <option value="2">A</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación ORL" type="text" name="ObservacionOrl" style="display:none;" id="ObservacionOrl"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="CavidadOralL" >Cavidad Oral:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="DatoCavidadOral" id="DatoCavidadOral" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1">N</option>
                                                            <option value="2">A</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación Cavidad Oral" type="text" name="ObservacionCavidadOral" style="display:none;" id="ObservacionCavidadOral"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="PulmonarL" >Pulmonar:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="DatoPulmonar" id="DatoPulmonar" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1">N</option>
                                                            <option value="2">A</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación Pulmonar" type="text" name="ObservacionPulmonar" style="display:none;" id="ObservacionPulmonar"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="CardiacoL" >Cardiaco:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="DatoCardiaco" id="DatoCardiaco" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1">N</option>
                                                            <option value="2">A</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación Cardiaco" type="text" name="ObservacionCardiaco" style="display:none;" id="ObservacionCardiaco"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="VascularPerifericoL" >Vascular Periferico:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="DatoVascularPeriferico" id="DatoVascularPeriferico" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1">N</option>
                                                            <option value="2">A</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación Vascular Periferico" type="text" name="ObservacionVascularPeriferico" style="display:none;" id="ObservacionVascularPeriferico"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="AbdomenL" >Abdomen:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="DatoAbdomen" id="DatoAbdomen" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1">N</option>
                                                            <option value="2">A</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación Abdomen" type="text" name="ObservacionAbdomen" style="display:none;" id="ObservacionAbdomen"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="GenitourinarioL" >Genitourinario:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="DatoGenitourinario" id="DatoGenitourinario" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1">N</option>
                                                            <option value="2">A</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación Genitourinario" type="text" name="ObservacionGenitourinario" style="display:none;" id="ObservacionGenitourinario"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="NeurologicoL" >Neurologico:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="DatoNeurologico" id="DatoNeurologico" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1">N</option>
                                                            <option value="2">A</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación Neurologico" type="text" name="ObservacionNeurologico" style="display:none;" id="ObservacionNeurologico"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="PielFanerasL" >Piel y Faneras:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="DatoPielFaneras" id="DatoPielFaneras" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1">N</option>
                                                            <option value="2">A</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <textarea class="form-control" placeholder="Observación Piel y Faneras" type="text" name="ObservacionPielFaneras" style="display:none;" id="ObservacionPielFaneras"></textarea>
                                                    </div>
                                                </div>


                                                <div class="panel-body">
                                                    <p>EXAMEN FISICO</p>
                                                </div>                       
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <table class="table" cellspacing="0" width="100%" style="text-transform: uppercase;">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="form-group col-md-2">
                                                                        <label for="inputEmail" class="control-label" >Postura:</label>
                                                                    </td>
                                                                    <td class="form-group col-md-10">
                                                                        <table class="table" cellspacing="0" width="100%" style="text-transform: uppercase;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="form-group col-md-2">
                                                                                        <label for="inputEmail" class="control-label" id="APL" >A-P:</label>
                                                                                    </td>
                                                                                    <td class="form-group col-md-4">
                                                                                        <select name="DatoAP" id="DatoAP" class="form-control">
                                                                                            <option value="">Seleccionar</option>
                                                                                            <option value="1">N</option>
                                                                                            <option value="2">A</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td class="form-group col-md-8">
                                                                                        <textarea class="form-control" placeholder="Observación A-P" type="text" name="ObservacionAP" style="display:none;" id="ObservacionAP"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="form-group col-md-2">
                                                                                        <label for="inputEmail" class="control-label" id="PAL" >P-A:</label>
                                                                                    </td>
                                                                                    <td class="form-group col-md-4">
                                                                                        <select name="DatoPA" id="DatoPA" class="form-control">
                                                                                            <option value="">Seleccionar</option>
                                                                                            <option value="1">N</option>
                                                                                            <option value="2">A</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td class="form-group col-md-8">
                                                                                        <textarea class="form-control" placeholder="Observación P-A" type="text" name="ObservacionPA" style="display:none;" id="ObservacionPA"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="form-group col-md-2">
                                                                                        <label for="inputEmail" class="control-label" id="LateralL" >Lateral:</label>
                                                                                    </td>
                                                                                    <td class="form-group col-md-4">
                                                                                        <select name="DatoLateral" id="DatoLateral" class="form-control">
                                                                                            <option value="">Seleccionar</option>
                                                                                            <option value="1">N</option>
                                                                                            <option value="2">A</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td class="form-group col-md-8">
                                                                                        <textarea class="form-control" placeholder="Observación Lateral" type="text" name="ObservacionLateral" style="display:none;" id="ObservacionLateral"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="form-group col-md-2">
                                                                        <label for="inputEmail" class="control-label" id="Cuello2L" >Cuello:</label>
                                                                    </td>
                                                                    <td class="form-group col-md-10">
                                                                        <div class="form-group col-md-6">
                                                                            <select name="DatoCuello2" id="DatoCuello2" class="form-control">
                                                                                <option value="">Seleccionar</option>
                                                                                <option value="1">N</option>
                                                                                <option value="2">A</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <textarea class="form-control" placeholder="Observación Cuello" type="text" name="ObservacionCuello2" style="display:none;" id="ObservacionCuello2"></textarea>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="form-group col-md-2">
                                                                        <label for="inputEmail" class="control-label" >Miembro Superior:</label>
                                                                    </td>
                                                                    <td class="form-group col-md-10">
                                                                        <table class="table" cellspacing="0" width="100%" style="text-transform: uppercase;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="form-group col-md-2">
                                                                                        <label for="inputEmail" class="control-label" id="HombroL" >Hombro:</label>
                                                                                    </td>
                                                                                    <td class="form-group col-md-4">
                                                                                        <select name="DatoHombro" id="DatoHombro" class="form-control">
                                                                                            <option value="">Seleccionar</option>
                                                                                            <option value="1">N</option>
                                                                                            <option value="2">A</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td class="form-group col-md-8">
                                                                                        <textarea class="form-control" placeholder="Observación Hombro" type="text" name="ObservacionHombro" style="display:none;" id="ObservacionHombro"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="form-group col-md-2">
                                                                                        <label for="inputEmail" class="control-label" id="CodoL" >Codo:</label>
                                                                                    </td>
                                                                                    <td class="form-group col-md-4">
                                                                                        <select name="DatoCodo" id="DatoCodo" class="form-control">
                                                                                            <option value="">Seleccionar</option>
                                                                                            <option value="1">N</option>
                                                                                            <option value="2">A</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td class="form-group col-md-8">
                                                                                        <textarea class="form-control" placeholder="Observación Codo" type="text" name="ObservacionCodo" style="display:none;" id="ObservacionCodo"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="form-group col-md-2">
                                                                                        <label for="inputEmail" class="control-label" id="MunecaL" >Muñeca:</label>
                                                                                    </td>
                                                                                    <td class="form-group col-md-4">
                                                                                        <select name="DatoMuneca" id="DatoMuneca" class="form-control">
                                                                                            <option value="">Seleccionar</option>
                                                                                            <option value="1">N</option>
                                                                                            <option value="2">A</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td class="form-group col-md-8">
                                                                                        <textarea class="form-control" placeholder="Observación Muñeca" type="text" name="ObservacionMuneca" style="display:none;" id="ObservacionMuneca"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="form-group col-md-2">
                                                                                        <label for="inputEmail" class="control-label" id="ManoL" >Mano:</label>
                                                                                    </td>
                                                                                    <td class="form-group col-md-4">
                                                                                        <select name="DatoMano" id="DatoMano" class="form-control">
                                                                                            <option value="">Seleccionar</option>
                                                                                            <option value="1">N</option>
                                                                                            <option value="2">A</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td class="form-group col-md-8">
                                                                                        <textarea class="form-control" placeholder="Observación Mano" type="text" name="ObservacionMano" style="display:none;" id="ObservacionMano"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="form-group col-md-2">
                                                                        <label for="inputEmail" class="control-label" >Columna:</label>
                                                                    </td>
                                                                    <td class="form-group col-md-10">
                                                                        <table class="table" cellspacing="0" width="100%" style="text-transform: uppercase;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="form-group col-md-2">
                                                                                        <label for="inputEmail" class="control-label" id="CervicalL" >Cervical:</label>
                                                                                    </td>
                                                                                    <td class="form-group col-md-4">
                                                                                        <select name="DatoCervical" id="DatoCervical" class="form-control">
                                                                                            <option value="">Seleccionar</option>
                                                                                            <option value="1">N</option>
                                                                                            <option value="2">A</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td class="form-group col-md-8">
                                                                                        <textarea class="form-control" placeholder="Observación Cervical" type="text" name="ObservacionCervical" style="display:none;" id="ObservacionCervical"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="form-group col-md-2">
                                                                                        <label for="inputEmail" class="control-label" id="DorsalL" >Dorsal:</label>
                                                                                    </td>
                                                                                    <td class="form-group col-md-4">
                                                                                        <select name="DatoDorsal" id="DatoDorsal" class="form-control">
                                                                                            <option value="">Seleccionar</option>
                                                                                            <option value="1">N</option>
                                                                                            <option value="2">A</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td class="form-group col-md-8">
                                                                                        <textarea class="form-control" placeholder="Observación Dorsal" type="text" name="ObservacionDorsal" style="display:none;" id="ObservacionDorsal"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="form-group col-md-2">
                                                                                        <label for="inputEmail" class="control-label" id="LumbosacaL" >Lumbosaca:</label>
                                                                                    </td>
                                                                                    <td class="form-group col-md-4">
                                                                                        <select name="DatoLumbosaca" id="DatoLumbosaca" class="form-control">
                                                                                            <option value="">Seleccionar</option>
                                                                                            <option value="1">N</option>
                                                                                            <option value="2">A</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td class="form-group col-md-8">
                                                                                        <textarea class="form-control" placeholder="Observación Lumbosaca" type="text" name="ObservacionLumbosaca" style="display:none;" id="ObservacionLumbosaca"></textarea>
                                                                                    </td>
                                                                                </tr>    
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="form-group col-md-2">
                                                                        <label for="inputEmail" class="control-label" >Miembro Inferior:</label>
                                                                    </td>
                                                                    <td class="form-group col-md-10">
                                                                        <table class="table" cellspacing="0" width="100%" style="text-transform: uppercase;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="form-group col-md-2">
                                                                                        <label for="inputEmail" class="control-label" id="CaderaL" >Cadera:</label>
                                                                                    </td>
                                                                                    <td class="form-group col-md-4">
                                                                                        <select name="DatoCadera" id="DatoCadera" class="form-control">
                                                                                            <option value="">Seleccionar</option>
                                                                                            <option value="1">N</option>
                                                                                            <option value="2">A</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td class="form-group col-md-8">
                                                                                        <textarea class="form-control" placeholder="Observación Cadera" type="text" name="ObservacionCadera" style="display:none;" id="ObservacionCadera"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="form-group col-md-2">
                                                                                        <label for="inputEmail" class="control-label" id="RodillaL" >Rodilla:</label>
                                                                                    </td>
                                                                                    <td class="form-group col-md-4">
                                                                                        <select name="DatoRodilla" id="DatoRodilla" class="form-control">
                                                                                            <option value="">Seleccionar</option>
                                                                                            <option value="1">N</option>
                                                                                            <option value="2">A</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td class="form-group col-md-8">
                                                                                        <textarea class="form-control" placeholder="Observación Rodilla" type="text" name="ObservacionRodilla" style="display:none;" id="ObservacionRodilla"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="form-group col-md-2">
                                                                                        <label for="inputEmail" class="control-label" id="TobilloL" >Tobillo Pie:</label>
                                                                                    </td>
                                                                                    <td class="form-group col-md-4">
                                                                                        <select name="DatoTobillo" id="DatoTobillo" class="form-control">
                                                                                            <option value="">Seleccionar</option>
                                                                                            <option value="1">N</option>
                                                                                            <option value="2">A</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td class="form-group col-md-8">
                                                                                        <textarea class="form-control" placeholder="Observación Tobillo Pie" type="text" name="ObservacionTobillo" style="display:none;" id="ObservacionTobillo"></textarea>
                                                                                    </td>
                                                                                </tr>    
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
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
                                                <label><h4>SECCIÓN SIETE:</h4></label>
                                                <label><h4>DIAGNOSTICO</h4></label>
                                                <span data-role="ver" id="seccion_siete_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                                            </div>
                                        </div>       
                                        <ul class="list-group" id="seccion_siete" name="seccion_siete" style="display: none">
                                            <li class="list-group-item">                           
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail" class="control-label" id="DiagnosticoL">Describa el Diagnostico:</label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <textarea class="form-control" placeholder="descripción del Diagnostico" type="text" name="Diagnostico" id="Diagnostico"></textarea>
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
                                                <label><h4>SECCIÓN OCHO:</h4></label>
                                                <label><h4>INCAPACIDAD PROVISIONAL</h4></label>
                                                <span data-role="ver" id="seccion_ocho_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                                            </div>
                                        </div>       
                                        <ul class="list-group" id="seccion_ocho" name="seccion_ocho" style="display: none">
                                            <li class="list-group-item">                           
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail" class="control-label" id="IncapacidadProvisionalL"> Describa la Incapacidad Provisional:</label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <textarea class="form-control" placeholder="Descripción de la Incapacidad Provisional" type="text" name="IncapacidadProvisional" id="IncapacidadProvisional"></textarea>
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
                                                <label><h4>SECCIÓN NUEVE:</h4></label>
                                                <label><h4>APTITUD</h4></label>
                                                <span data-role="ver" id="seccion_nueve_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                                            </div>
                                        </div>       
                                        <ul class="list-group" id="seccion_nueve" name="seccion_nueve" style="display: none">
                                            <li class="list-group-item">                           
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail" class="control-label" id="AptitudL">Seleccione la Aptitud:</label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <select name="Aptitud" id="Aptitud" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            @foreach($Aptitud as $Aptitudes)
                                                                    <option value="{{ $Aptitudes['Id'] }}">{{ $Aptitudes['Nombre_Aptitud'] }}</option>
                                                            @endforeach                   
                                                        </select>
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
                                                <label><h4>SECCIÓN DIEZ:</h4></label>
                                                <label><h4>RECOMENDACIONES Y TRATAMIENTO</h4></label>
                                                <span data-role="ver" id="seccion_diez_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                                            </div>
                                        </div>       
                                        <ul class="list-group" id="seccion_diez" name="seccion_diez" style="display: none">
                                            <li class="list-group-item">                           
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail" class="control-label" id="RecomendacionesL">Describa las Recomendaciones y Tratamiento:</label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <textarea class="form-control" placeholder="Descripción de las Recomendaciones y Tratamiento" type="text" name="Recomendaciones" id="Recomendaciones"></textarea>
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
                                                <label><h4>SECCIÓN ONCE:</h4></label>
                                                <label><h4>DATOS MEDICO</h4></label>
                                                <span data-role="ver" id="seccion_once_ver" class="glyphicon glyphicon-resize-full btn-lg" aria-hidden="true"></span>
                                            </div>
                                        </div>       
                                        <ul class="list-group" id="seccion_once" name="seccion_once" style="display: none">
                                            <li class="list-group-item">                           
                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="NombreMedicoL">Nombres Medico:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input class="form-control" placeholder="Nombre del medico" type="text" name="NombreMedico" id="NombreMedico" disabled="disabled">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label" id="RML">R.M:</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input class="form-control" placeholder="R.M" type="text" name="RM" id="RM" disabled="disabled">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail" class="control-label" id="FirmaMedicoL">Firma y sello del medico:</label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <input class="form-control" placeholder="Firma y sello del medico" type="text" name="FirmaMedico" id="FirmaMedico" disabled="disabled">
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
            </div>
        </div>
</div>
@stop