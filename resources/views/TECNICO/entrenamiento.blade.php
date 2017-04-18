@extends('master')

@section('script')
    @parent
    <script src="{{ asset('public/Js/Tecnico/entrenamiento.js') }}"></script> 	
	<script src="{{ asset('public/Js/Datatime/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{ asset('public/Js/Datatime/moment-with-locales.js') }}"></script>
	<script src="{{ asset('public/Js/Datatime/bootstrap-datetimepicker.js') }}"></script>
@stop

@section('content')
    <center><h3>GESTOR DE ENTRENAMIENTOS</h3></center>

    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
    <div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
        <div class="content">
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Datos del entrenador</h3>
                </div>
                <div class="panel-body">
                	<div class="list-group-item">
                		<div class="row">
                			<div class="col-md-12">
	                			<div class="col-md-6">
		                            <div class="col-md-5">
		                            	<h4>Nombres y apellidos:</h4>
		                            </div>

		                            <div class="col-md-6">
		                            	<h4 style="text-transform: uppercase;">
			                            	<small>{{$Persona['Primer_Nombre']}}  {{$Persona['Segundo_Nombre']}}  {{$Persona['Primer_Apellido']}}  {{$Persona['Segundo_Apellido']}}</small>
		                        		</h4>
		                            </div>
	                            </div>

	                            <div class="col-md-6">
		                            <div class="col-md-5">
		                            	<h4>Identificación:</h4>
		                            </div>

		                            <div class="col-md-6">
		                            	<h4 style="text-transform: uppercase;">
		                            		<small>{{$Persona['Cedula']}}</small>
		                        		</h4>
		                            </div>
	                            </div>
                            </div>
                            <div class="col-md-12">
	                            <div class="col-md-6">
		                            <div class="col-md-5">
		                            	<h4>Clasificación Deportiva:</h4>
		                            </div>
		                            <div class="col-md-6">
		                            	<h4 style="text-transform: uppercase;">
		                            		<small>{{$Entrenador['clasificacionDeportiva']['Nombre_Clasificacion_Deportista']}}</small>
		                            	</h4>
		                            </div>
	                            </div>
	                            <div class="col-md-6">
		                            <div class="col-md-5">
		                            	<h4>Deporte:</h4>
		                            </div>
		                            <div class="col-md-6">
		                            	<h4 style="text-transform: uppercase;">
		                            		<small>{{$Entrenador['deporte']['Nombre_Deporte']}}</small>
		                            	</h4>
		                            </div>
	                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="list-group-item">
                    	<div class="row">
                            <div class="col-md-6" align="left">
                                <h4>Nuevo Entrenamiento</h4>
                            </div>
                            <div class="col-md-6" align="right">
                                <button type="button" class="btn btn-success" value="" name="NuevoEntrenamiento" id="NuevoEntrenamiento" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Crear Nuevo Entrenamiento</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="list-group-item">
                    	<div class="row">
                            <div class="col-md-6" align="left">
                                <h4>Entrenamientos</h4>
                            </div>
                        </div>
                        <div class="row" id="DatosEntrenamiento"></div>
                    </div>
                </div>

                <!-- ---------------------------CREAR NUEVO ENTRENAMIENTO--------------------------- -->
                <div class="modal fade bs-example-modal-lg" id="AgregarEntrenamientoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Crear Nuevo Entrenamiento</h4>
                             </div>
                             <div class="panel panel-primary">
                                <div class="content" >
                                    <form id="NuevoEntrenamientoF" name="NuevoEntrenamientoF">
                                    	<input type="hidden" name="Entrenador_Id" id="Entrenador_Id" value="{{$Entrenador['Id']}}">
                                    	<div class="row panel-body">
                                             <div class="form-group col-md-12">
                                                <label for="inputEmail" class="control-label">Lugar de entrenamiento:</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input type="text" style="text-transform: uppercase;" class="form-control"  placeholder="Lugar Entrenamiento" id="Lugar_Entrenamiento" name="Lugar_Entrenamiento">
                                            </div>
                                        </div>

                                        <div class="row panel-body">
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Fecha inicio:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                            	<div class='input-group date' id='FechaInicioDate'>
													<input type="text" data-role="datepicker" name="FechaInicio"  id="FechaInicio" class="form-control">
                                            	<span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i></span>
												</div>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Fecha fin:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                               <div class='input-group date' id='FechaFinDate'>
													<input type="text" data-role="datepicker" name="FechaFin"  id="FechaFin" class="form-control">
                                            	<span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i></span>
												</div>  
                                            </div>
                                        </div>

                                        <div class="row panel-body">
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Hora inicio:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class='input-group date' id='HoraInicioDate'>
													<input type='text' id="HoraInicio" class="form-control" name="HoraInicio" />
													<span class="input-group-addon btn"><span class="glyphicon glyphicon-time"></span>
													</span>
												</div>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Hora fin:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class='input-group date' id='HoraFinDate'>
													<input type='text' id="HoraFin" class="form-control" name="HoraFin" />
													<span class="input-group-addon btn"><span class="glyphicon glyphicon-time"></span>
													</span>
												</div>
                                            </div>
                                        </div>

                                        <div class="row panel-body">
                                            <div class="form-group col-md-12" align="center">
                                                <button type="button" class="btn btn-info ver" value="" name="AgregarEntrenamiento" id="AgregarEntrenamiento" >Agregar entrenamiento</button>
                                            </div>
                                        </div>
                                        <div class="row panel-body">
                                            <div class="form-group col-md-12" align="center">                                                    
                                                <div id="MensajeNuevoEntrenamiento"></div>
                                            </div>
                                        </div>                                                   
                                    </form>                                                
                                </div>                                                                                            
                            </div>    
	                    </div>
	                </div>
	            </div>

	            <!-- ---------------------------VER ENTRENAMIENTO--------------------------- -->
                <div class="modal fade bs-example-modal-lg" id="VerEntrenamientoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Datos del Entrenamiento</h4>
                             </div>
                             <div class="panel panel-primary">
                                <div class="content" >
                                    <form id="ModificarEntrenamientoF" name="ModificarEntrenamientoF">
                                    	<input type="hidden" name="Entrenamiento_Id" id="Entrenamiento_Id">
                                    	<div class="row panel-body">
                                             <div class="form-group col-md-12">
                                                <label for="inputEmail" class="control-label">Lugar de entrenamiento:</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input type="text" style="text-transform: uppercase;" class="form-control"  placeholder="Lugar Entrenamiento" id="Lugar_EntrenamientoM" name="Lugar_EntrenamientoM">
                                            </div>
                                        </div>

                                        <div class="row panel-body">
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Fecha inicio:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                            	<div class='input-group date' id='FechaInicioDateM'>
													<input type="text" data-role="datepicker" name="FechaInicioM"  id="FechaInicioM" class="form-control">
                                            	<span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i></span>
												</div>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Fecha fin:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                               <div class='input-group date' id='FechaFinDateM'>
													<input type="text" data-role="datepicker" name="FechaFinM"  id="FechaFinM" class="form-control">
                                            	<span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i></span>
												</div>  
                                            </div>
                                        </div>

                                        <div class="row panel-body">
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Hora inicio:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class='input-group date' id='HoraInicioDateM'>
													<input type='text' id="HoraInicioM" class="form-control" name="HoraInicioM" />
													<span class="input-group-addon btn"><span class="glyphicon glyphicon-time"></span>
													</span>
												</div>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Hora fin:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class='input-group date' id='HoraFinDateM'>
													<input type='text' id="HoraFinM" class="form-control" name="HoraFinM" />
													<span class="input-group-addon btn"><span class="glyphicon glyphicon-time"></span>
													</span>
												</div>
                                            </div>
                                        </div>

                                        <div class="row panel-body">
                                            <div class="form-group col-md-12" align="center">
                                                <button type="button" class="btn btn-primary ver" value="" name="ModificarEntrenamiento" id="ModificarEntrenamiento" >Modificar entrenamiento</button>
                                            </div>
                                        </div>
                                        <div class="row panel-body">
                                            <div class="form-group col-md-12" align="center">                                                    
                                                <div id="MensajeModificarEntrenamiento"></div>
                                            </div>
                                        </div>                                                   
                                    </form>                                                
                                </div>                                                                                            
                            </div>    
	                    </div>
	                </div>
	            </div>

	            <!-- ---------------------------ENTRENAMIENTO - DEPORTISTAS--------------------------- -->
                <div class="modal fade bs-example-modal-lg" id="EntrenamientoDeportistaModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" style="text-transform: uppercase;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4><label id="DescripcionEntrenamiento"></label></h4>
                                <h5 class="modal-title" id="myModalLabel">Entrenamiento - Deportistas </h5>                                
                             </div>
                             <div class="panel panel-primary">
                                <div class="content" >
                                    <form id="EntrenamientoDeportistasF" name="EntrenamientoDeportistasF">
                                    	<input type="hidden" name="Entrenamiento_Id2" id="Entrenamiento_Id2">
                                    	<div class="row panel-body">
                                    		<h4 align="center">Marque los deportistas que desea incluir dentro de este entrenamiento.</h4>
                                            <div class="form-group col-md-12" id="ListadoDeportistas"></div>
                                        </div>
                                        <div class="row panel-body" align="center">                                                   
                                            <div id="MensajeEntrenamientoDeportistas" style="display:none;"></div>
                                            <div id="loading" style="display:none;">
							                    <center><button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button></center>
							                </div>
                                        </div>                                                   
                                    </form>                                                
                                </div>                                                                                            
                            </div>    
	                    </div>
	                </div>
	            </div>

	            <!-- ---------------------------PLANILLA DE ASISTENCIA--------------------------- -->
                <div class="modal fade bs-example-modal-lg" id="PlanillaModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg" style="width: 100%">
                        <div class="modal-content">
                            <div class="modal-header" style="text-transform: uppercase;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4><label id="DescripcionPlanilla"></label></h4>
                                <!--<h5 class="modal-title" id="myModalLabel">Planilla de entrenamiernto ()</h5>                                -->
                             </div>
                             <div class="panel panel-primary">
                                <div class="content" >
	                                <ul class="nav nav-tabs">
		                              <li role="presentation" id="AsistenciaLi" class="active"><a id="Asistencia">Asistencia</a></li>
		                              <li role="presentation" id="VerificacionRequisitosLi" ><a id="VerificacionRequisitos" >Verificacion de requisitos</a></li>
		                              <li role="presentation" id="NoConformidadesLi" ><a id="NoConformidades" >No conformidades</a></li>
		                            </ul>
		                            <input type="hidden" name="Entrenamiento_Id3" id="Entrenamiento_Id3">
                                    <input type="hidden" name="Fecha_Inicio3" id="Fecha_Inicio3">
                                    <input type="hidden" name="Fecha_Fin3" id="Fecha_Fin3">
		                            <!---------------------------------------------------------------------->
                                    <form id="AsistenciaF" name="AsistenciaF" style="display: none;">
                                    	<div id="PlanillaAsistencia"></div>
                                        <div id="loadingPA" style="display:none;">
                                            <br>
                                            <center><button class="btn btn-lg btn-default">
                                            <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button>
                                            </center>
                                            </div>
                                    	<div class="row panel-body" align="center">                                                   
                                            <div id="MensajeAsistencia"></div>
                                        </div>                                                
                                    </form>  
                                    <!---------------------------------------------------------------------->
                                    <form id="VerificacionRequisitosF" name="VerificacionRequisitosF" style="display: none;">
                                        <input type="hidden" name="Entrenamiento_Id4" id="Entrenamiento_Id4">
                                        <input type="hidden" name="Fecha_Inicio4" id="Fecha_Inicio4">
                                        <input type="hidden" name="Fecha_Fin4" id="Fecha_Fin4">
                                        <div id="PlanillaVerificacion"></div>
                                        <div id="loadingPV" style="display:none;">
                                            <br>
                                            <center><button class="btn btn-lg btn-default">
                                            <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button>
                                            </center>
                                            </div>
                                        <div class="row panel-body" align="center">                                                   
                                            <div id="MensajeVerificacion"></div>
                                        </div>  
                                    
                                    	<!--<div class="row panel-body">
                                    		<h4 align="center">Marque los deportistas que desea incluir dentro de este entrenamiento.</h4>
                                            <div class="form-group col-md-12" id="ListadoDeportistas"></div>
                                        </div>
                                        <div class="row panel-body" align="center">                                                   
                                            <div id="MensajeEntrenamientoDeportistas" style="display:none;"></div>
                                            <div id="loading" style="display:none;">
							                    <center><button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button></center>
							                </div>
                                        </div>-->                                                   
                                    </form>  
                                    <!---------------------------------------------------------------------->
                                    <form id="NoConformidadesF" name="NoConformidadesF" style="display: none;">
                                    nop cof
                                    	<!--<div class="row panel-body">
                                    		<h4 align="center">Marque los deportistas que desea incluir dentro de este entrenamiento.</h4>
                                            <div class="form-group col-md-12" id="ListadoDeportistas"></div>
                                        </div>
                                        <div class="row panel-body" align="center">                                                   
                                            <div id="MensajeEntrenamientoDeportistas" style="display:none;"></div>
                                            <div id="loading" style="display:none;">
							                    <center><button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button></center>
							                </div>
                                        </div>-->                                                   
                                    </form>                                                                                    
                                </div>                                                                                            
                            </div>    
	                    </div>
	                </div>
	            </div>

            </div>
        </div>
    </div>   
@stop