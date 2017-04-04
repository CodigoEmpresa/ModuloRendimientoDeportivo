@extends('master')

@section('script')
    @parent
    <script src="{{ asset('public/Js/buscar_personas.js') }}"></script>     
    <script src="{{ asset('public/Js/Tecnico/planes.js') }}"></script> 
@stop

@section('content')
    <center><h3>GESTOR PLANES DE ENTRENAMIENTO</h3></center>
    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
    <div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
        <div class="content">
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Buscar deportista</h3>
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
                                    <input id="buscador" name="buscador" type="text" class="form-control" placeholder="Buscar" value="53775735" onkeypress="return ValidaCampo(event);">
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
                            <div class="col-xs-12"><br></div>
                            <div class="col-xs-12"  id="GestorDeportistas" style="display:none;">
                                <ul id="personas"></ul>
                                <li class="list-group-item">
                                    <div class="list-group-item">
                                        <h4>Datos del deportista</h4>
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
                                    <div class="row">
                                        <div class="form-group"  id="mensaje_evento1">
                                            <div id="alert_evento1"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6" align="left">
                                                <h4>Nuevo Plan de Entrenamiento</h4>
                                            </div>
                                            <div class="col-md-6" align="right">
                                                <button type="button" class="btn btn-success" value="" name="NuevoPlan" id="NuevoPlan" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Crear Nuevo Plan de Entrenamiento</button>
                                            </div>
                                        </div>
                                       <div class="content" id="AgregarNuevoPlanD" style="display: none;">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                  <h3 class="panel-title">Agregar Nuevo Plan de entrenamiento</h3>
                                                </div>
                                                <form id="AgregarPlanF" name="AgregarPlanF">
                                                    <input type="hidden" id="Id_Deportista" name="Id_Deportista">
                                                     <div class="row" id="Url_Word_Nuevo">
                                                         <div class="form-group col-md-6" align="center">                                                    
                                                            <label for="inputEmail" class="control-label">Archivo Word</label>
                                                            <br>
                                                            <img src="public/Img/LogoWord.png" alt="" class="img-thumbnail img-responsive"><br>        
                                                            <br>                                    
                                                            <input type="file" id ="Archivo_Word_NuevoInput" name="Archivo_Word_NuevoInput">
                                                            <p class="help-block form-group">Imagen en formato doc, docx.</p>
                                                        </div>

                                                        <div class="form-group col-md-6" align="center">                                                    
                                                            <label for="inputEmail" class="control-label">Archivo Excel</label>
                                                            <br>
                                                            <img src="public/Img/LogoExcel.png" alt="" class="img-thumbnail img-responsive"><br>
                                                            <br>                                    
                                                            <input type="file" id ="Archivo_Excel_NuevoInput" name="Archivo_Excel_NuevoInput">
                                                            <p class="help-block">Imagen en formato xls, xlsx.</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12" align="center">                                                    
                                                            <button type="button" class="btn btn-primary" value="" name="AgregarPlan" id="AgregarPlan" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Agregar Plan de Entrenamiento</button>
                                                        </div>
                                                        <div class="form-group col-md-12" align="center">                                                    
                                                            <div id="MensajeAgregarPlan"></div>
                                                        </div>
                                                    </div>   
                                                </form>                                                 
                                            </div>
                                        </div>                                           
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6" align="left">
                                                <h4>Plan Actual de entrenamiento</h4>
                                            </div>
                                            <div class="col-md-6" align="right">
                                                <button type="button" class="btn btn-info" value="" name="VerPlanActual" id="VerPlanActual" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>  Ver Plan de Entrenamiento Actual</button>
                                            </div>
                                        </div>
                                    </div>
                                </li> 
                                <li class="list-group-item">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6" align="left">
                                                <h4>Historial Planes de entrenamiento</h4>
                                            </div>
                                            <div class="col-md-6" align="right">
                                                <button type="button" class="btn btn-warning" value="" name="HistorialPlanes" id="HistorialPlanes" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Ver Historial Planes de Entrenamiento</button>
                                            </div>
                                        </div>
                                        <br>
                                       <div class="content" id="HistorialPlanD" style="display: none;">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                  <h3 class="panel-title">Historial Planes de Entrenamiento</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <form id="HistorialPlanF" name="HistorialPlanF">
                                                        <div class="row">
                                                             <div class="form-group col-md-12">
                                                                <table id="HistorialPlanT" class="display nowrap" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>N° PLAN</th>
                                                                            <th>FECHA DE CARGA</th>
                                                                            <th>ENTRENADOR</th>
                                                                            <th>OPCIONES</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>                                                                                    
                                                                    </tbody> 
                                                                </table>
                                                            </div>
                                                        </div>                                                                                                   
                                                    </form>
                                                </div>                                                                                            
                                            </div>
                                        </div> 
                                    </div>
                                </li>
                            </div>
                            <!-- ---------------------------VER PLAN ACTUAL--------------------------- -->
                            <div class="modal fade bs-example-modal-lg" id="VerPlanActualM" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Plan Actual de Entrenamiento</h4>
                                         </div>
                                         <ul class="nav nav-tabs">
                                          <li role="presentation" id="DatosPlanActualLi" class="active"><a id="DatosPlanActual">Datos Plan Actual</a></li>
                                          <li role="presentation" id="UltimaActualizacionLi" ><a id="UltimaActualizacion" >Última Actualización</a></li>
                                          <li role="presentation" id="ActualizarPlanActualLi" ><a id="ActualizarPlanActual" >Actualizar Plan Actual</a></li>
                                          <li role="presentation" id="HistorialPlanActualLi" ><a id="HistorialPlanActual" >Historial Plan Actual</a></li>                                          
                                        </ul>
                                         <div class="panel panel-primary" id="DatosPlanActualD" style="display: none;">
                                            <div class="content" id="VerPlanActualD">
                                                <form id="VerPlanF" name="VerPlanF">
                                                    <div id="Parte1VP" style="display: none;">
                                                        <input type="hidden" name="Id_PLanActual" id="Id_PLanActual">                                                   
                                                        <div class="row panel-body">
                                                            <div class="form-group col-md-12">
                                                                <h4> Datos del plan inicial de entrenamiento</h4>
                                                            </div>
                                                        </div>
                                                        <div class="row panel-body">
                                                             <div class="form-group col-md-2">
                                                                <label for="inputEmail" class="control-label">Fecha de creación:</label>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <small id="Fecha_Creacion"></small>
                                                            </div>
                                                        </div>
                                                        <div class="row panel-body">
                                                            <div class="form-group col-md-2">
                                                                <label for="exampleInputFile">Archivo Word</label>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <a id="archivoWord" href="" download>
                                                                  <img border="0" src="public/Img/downloadicon.gif" alt="W3Schools" >
                                                                </a>
                                                            </div>

                                                            <div class="form-group col-md-2">
                                                                <label for="exampleInputFile">Archivo Excel</label>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <a id="archivoExcel" href="" download>
                                                                  <img border="0" src="public/Img/downloadicon.gif" alt="W3Schools" >
                                                                </a>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label for="exampleInputFile">Observación Metodologo</label>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <textarea class="form-control" name="ObservacionMetodologo" id="ObservacionMetodologo"></textarea>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label for="exampleInputFile">Observación Entrenador</label>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <textarea class="form-control" name="ObservacionEntrenador" id="ObservacionEntrenador"></textarea>
                                                            </div>
                                                            <div class="row panel-body">
                                                                <div class="form-group col-md-12">
                                                                    <button type="button" class="btn btn-primary" value="" name="AgregarObservaciones" id="AgregarObservaciones" ><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>Agregar Observaciones</button>
                                                                </div>
                                                            </div>                                                            
                                                        </div>   
                                                    </div>                                                          
                                                    <div class="row panel-body" id="Parte2VP" style="display: none;">
                                                        <div class="form-group col-md-12" align="center">                                                    
                                                            <div id="MensajeVerPlan"></div>
                                                        </div>
                                                    </div>                                                   
                                                </form>                                                
                                            </div>                                                                                            
                                        </div>
                                        <!-- ------------------------------------------------------------------- -->
                                        <div class="panel panel-primary" id="ActualizarPlanActualD" style="display: none;">
                                            <div class="content" id="VerPlanActualD">
                                            <form id="AgregarActualizacionF" name="AgregarActualizacionF">
                                                <input type="hidden" name="Id_PLanActual_A" id="Id_PLanActual_A">                                                   
                                                <div class="row panel-body">
                                                    <div class="form-group col-md-12">
                                                        <h4>Actualizar Plan Actual de Entrenamiento</h4>
                                                    </div>
                                                </div>
                                                 <div class="row" id="Url_Word_Actualizacion">
                                                     <div class="form-group col-md-6" align="center">                                                    
                                                        <label for="inputEmail" class="control-label">Archivo Word</label>
                                                        <br>
                                                        <img src="public/Img/LogoWord.png" alt="" class="img-thumbnail img-responsive"><br>        
                                                        <br>                                    
                                                        <input type="file" id ="Archivo_Word_NuevoInput_Actualizacion" name="Archivo_Word_NuevoInput_Actualizacion">
                                                        <p class="help-block form-group">Imagen en formato doc, docx.</p>
                                                    </div>

                                                    <div class="form-group col-md-6" align="center">                                                    
                                                        <label for="inputEmail" class="control-label">Archivo Excel</label>
                                                        <br>
                                                        <img src="public/Img/LogoExcel.png" alt="" class="img-thumbnail img-responsive"><br>
                                                        <br>                                    
                                                        <input type="file" id ="Archivo_Excel_NuevoInput_Actualizacion" name="Archivo_Excel_NuevoInput_Actualizacion">
                                                        <p class="help-block">Imagen en formato xls, xlsx.</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12" align="center">                                                    
                                                        <button type="button" class="btn btn-primary" value="" name="AgregarPlanActualizacion" id="AgregarPlanActualizacion" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Agregar Actualizacion del Plan de Entrenamiento</button>
                                                    </div>
                                                    <div class="form-group col-md-12" align="center">                                                    
                                                        <div id="MensajeAgregarPlanActualizacion"></div>
                                                    </div>
                                                </div>   
                                            </form>                                                                 
                                            </div>
                                        </div>
                                        <!-- ------------------------------------------------------------------- -->
                                        <div class="panel panel-primary" id="HistorialPlanActualD" style="display: none;">
                                            <div class="content" id="VerHistorialPlanActualD">
                                                <div class="row panel-body">
                                                    <div class="form-group col-md-12">
                                                        <h4>Historial de actualizaciones del plan actual</h4>
                                                    </div>
                                                </div>
                                                <div class="row panel-body">
                                                    <div class="form-group col-md-12">
                                                        <table id="HistorialPlanActualT" class="display nowrap" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>N° ACTUALIZACIÓN</th>
                                                                    <th>FECHA DE CARGA</th>                                                                    
                                                                    <th>OPCIONES</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>                                                                                    
                                                            </tbody> 
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content" id="EspecificoD" style="display: none;">
                                                <div class="row panel-body">
                                                    <div class="form-group col-md-12">
                                                        <h4>Datos de la actualización número: <label id="NumeroActualizacionL"></label></h4>
                                                    </div>
                                                </div>
                                                <div class="row panel-body">
                                                    <div class="form-group col-md-2">
                                                        <label for="exampleInputFile">Archivo Word</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <a id="archivoWordVersion" href="" download>
                                                          <img border="0" src="public/Img/downloadicon.gif" alt="W3Schools" >
                                                        </a>
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label for="exampleInputFile">Archivo Excel</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <a id="archivoExcelVersion" href="" download>
                                                          <img border="0" src="public/Img/downloadicon.gif" alt="W3Schools" >
                                                        </a>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label for="exampleInputFile" id="ObservacionMetodologoVersionL">Observación Metodologo</label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <textarea class="form-control" name="ObservacionMetodologoVersion" id="ObservacionMetodologoVersion" readonly="readonly"></textarea>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label for="exampleInputFile" id="ObservacionEntrenadorVersionL">Observación Entrenador</label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <textarea class="form-control" name="ObservacionEntrenadorVersion" id="ObservacionEntrenadorVersion" readonly="readonly"></textarea>
                                                    </div>
                                                </div>    
                                            </div>                                          
                                        </div>
                                        <!-- ------------------------------------------------------------------- -->
                                        <div class="panel panel-primary" id="UltimaActualizacionD" style="display: none;">
                                            <div class="content" id="VerPlanActualD">
                                            <form id="VerUltimaVersionF" name="VerUltimaVersionF">
                                                <div id="Parte1UV" style="display: none;">
                                                    <input type="hidden" name="Id_UltimaVersion" id="Id_UltimaVersion">
                                                    <div class="row panel-body">
                                                        <div class="form-group col-md-12">
                                                            <h4> Datos de última actualización del plan de entrenamiento actual</h4>
                                                        </div>
                                                    </div>
                                                    <div class="row panel-body">
                                                         <div class="form-group col-md-2">
                                                            <label for="inputEmail" class="control-label">Fecha de creación:</label>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <small id="Fecha_CreacionUV"></small>
                                                        </div>
                                                    </div>
                                                    <div class="row panel-body">
                                                        <div class="form-group col-md-2">
                                                            <label for="exampleInputFile">Archivo Word</label>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <a id="archivoWordUV" href="" download>
                                                              <img border="0" src="public/Img/downloadicon.gif" alt="W3Schools" >
                                                            </a>
                                                        </div>

                                                        <div class="form-group col-md-2">
                                                            <label for="exampleInputFile">Archivo Excel</label>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <a id="archivoExcelUV" href="" download>
                                                              <img border="0" src="public/Img/downloadicon.gif" alt="W3Schools" >
                                                            </a>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="exampleInputFile">Observación Metodologo</label>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <textarea class="form-control" name="ObservacionMetodologoUV" id="ObservacionMetodologoUV"></textarea>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="exampleInputFile">Observación Entrenador</label>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <textarea class="form-control" name="ObservacionEntrenadorUV" id="ObservacionEntrenadorUV"></textarea>
                                                        </div>
                                                        <div class="row panel-body">
                                                            <div class="form-group col-md-12">
                                                                <button type="button" class="btn btn-primary" value="" name="AgregarObservacionesUV" id="AgregarObservacionesUV" ><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>Agregar Observaciones</button>
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                </div>  
                                                <div class="row panel-body" id="Parte2UV" style="display: none;">  
                                                    <div class="form-group col-md-12" align="center" >
                                                        <div id="MensajeVerUltimaVersion"></div>
                                                    </div>                      
                                                </div>                                  
                                            </form>                                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!-- ---------------------------VER HISTORIAL--------------------------- -->
                            <div class="modal fade bs-example-modal-lg" id="verHistorialPlanD" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Plan de Entrenamiento <label id="FechaCreacionLabel"></label></h4>
                                         </div>
                                         <ul class="nav nav-tabs">
                                          <li role="presentation" id="DatosPlanLi" class="active"><a id="DatosPlan">Datos Plan Número <label id="HistorialNumeroPlan"></label></a></li>
                                          <li role="presentation" id="ActualizacionesPlanLi" ><a id="ActualizacionesPlan" >Actualizaciones Plan Número <label id="HistorialNumeroPlan2"></a></li>
                                        </ul>
                                        <input type="hidden" name="Id_PlanAnterior" id="Id_PlanAnterior">
                                         <div class="panel panel-primary" id="DatosPlanD" style="display: none;">                                                  
                                            <div class="panel-body"> 
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h4> Datos del plan de entrenamiento número <label id="HistorialNumeroPlan3"></label></h4>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="form-group col-md-2">
                                                        <label for="exampleInputFile">Archivo Word</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <a id="archivoWordVH" href="" download>
                                                          <img border="0" src="public/Img/downloadicon.gif" alt="W3Schools" >
                                                        </a>
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label for="exampleInputFile">Archivo Excel</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <a id="archivoExcelVH" href="" download>
                                                          <img border="0" src="public/Img/downloadicon.gif" alt="W3Schools" >
                                                        </a>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label for="exampleInputFile">Observación Metodologo</label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <textarea class="form-control" name="ObservacionMetodologoVH" id="ObservacionMetodologoVH" readonly="readonly"></textarea>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label for="exampleInputFile">Observación Entrenador</label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <textarea class="form-control" name="ObservacionEntrenadorVH" id="ObservacionEntrenadorVH" readonly="readonly"></textarea>
                                                    </div>
                                                </div>        
                                            </div>                                                                                            
                                        </div>
                                        <div class="panel panel-primary" id="ActualizacionesPlanD" style="display: none;">                                                
                                            <div class="panel-body">          
                                                <div class="row">
                                                     <div class="form-group col-md-12">
                                                         <table id="HistorialVersionesAnterioresT" class="display nowrap" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>N°</th>
                                                                    <th>FECHA DE CARGA</th>
                                                                    <th>WORD</th>
                                                                    <th>EXCEL</th>
                                                                    <th>METODOLOGO</th>
                                                                    <th>ENTRENADOR</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>                                                                                    
                                                            </tbody> 
                                                        </table>                            
                                                    </div>              
                                                </div>
                                            </div>                                                                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div id="paginador" class="col-xs-12"></div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop