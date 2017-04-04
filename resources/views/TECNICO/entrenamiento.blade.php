@extends('master')

@section('script')
    @parent
    <script src="{{ asset('public/Js/Tecnico/entrenamiento.js') }}"></script> 
    <script src="{{ asset('public/Js/bootstrap-datepicker.js') }}"></script>   
    {{Html::style('public/Css/bootstrap-datepicker3.css')}}
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

                <!-- ---------------------------VER PLAN ACTUAL--------------------------- -->
                <div class="modal fade bs-example-modal-lg" id="AgregarEntrenamientoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Crear Nuevo Entrenamiento</h4>
                             </div>
                             <!--<ul class="nav nav-tabs">
                              <li role="presentation" id="DatosPlanActualLi" class="active"><a id="DatosPlanActual">Cre</a></li>
                              <li role="presentation" id="UltimaActualizacionLi" ><a id="UltimaActualizacion" >Última Actualización</a></li>
                              <li role="presentation" id="ActualizarPlanActualLi" ><a id="ActualizarPlanActual" >Actualizar Plan Actual</a></li>
                              <li role="presentation" id="HistorialPlanActualLi" ><a id="HistorialPlanActual" >Historial Plan Actual</a></li>                                  
                            </ul>-->

                            <!--<div class="form-group">
        				<label class="control-label" for="Id_TipoDocumento">* Hora implementación</label>
        				<div class="input-group date" id="datetimepicker3">
							<input type="text" name="Hora_Implementacion" class="form-control" value="">
							<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
							</span>
						</div>
        			</div>

        			<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker3'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
            });
        </script>
    </div>
</div>-->
                             <div class="panel panel-primary" id="DatosPlanActualD">
                                <div class="content" id="VerPlanActualD">
                                    <form id="NuevoEntrenamientoF" name="NuevoEntrenamientoF">
                                    	<input type="hidden" name="Entrenador_Id" id="Entrenador_Id" value="{{$Entrenador['Id']}}">
                                    	<div class="row panel-body">
                                             <div class="form-group col-md-12">
                                                <label for="inputEmail" class="control-label">Lugar de entrenamiento:</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input type="text" style="text-transform: uppercase;" class="form-control"  placeholder="Lugar_Entrenamiento" id="nom_ra" name="Lugar_Entrenamiento">
                                            </div>
                                        </div>

                                        <div class="row panel-body">
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Fecha inicio:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class="input-group date form-control" id="FechaInicioDate" style="border: none;">
                                                    <input id="FechaInicio" class="form-control " type="text" style="text-transform: uppercase;" value="" name="FechaInicio" default="" data-date="" data-behavior="FechaInicio">
                                                	<span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>    
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Fecha fin:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class="input-group date form-control" id="FechaFinDate" style="border: none;">
                                                    <input id="FechaFin" class="form-control " type="text" style="text-transform: uppercase;" value="" name="FechaFin" default="" data-date="" data-behavior="FechaFin">
                                                	<span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row panel-body">
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Hora inicio:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class="input-group date form-control" id="HoraInicioDate" style="border: none;">
                                                    <input id="HoraInicio" class="form-control " type="text" style="text-transform: uppercase;" value="" name="HoraInicio" default="" data-date="" data-behavior="FechaFin">
                                                	<span class="input-group-addon btn"><i class="glyphicon glyphicon-time"></i></span>
                                                </div>    
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Hora fin:</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class="input-group date form-control" id="HoraFinDate" style="border: none;">
                                                    <input id="HoraFin" class="form-control " type="text" style="text-transform: uppercase;" value="" name="HoraFin" default="" data-date="" data-behavior="HoraFin">
                                                	<span class="input-group-addon btn"><i class="glyphicon glyphicon-time"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row panel-body">
                                            <div class="form-group col-md-12" align="center">
                                                <button type="button" class="btn btn-info ver" value="" name="AgregarEntrenamiento" id="AgregarEntrenamiento" >Agregar entrenamiento</button>
                                            </div>
                                        </div>
                                        <div class="row panel-body" id="Parte2VP" style="display: none;">
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
            </div>
        </div>
    </div>   
@stop