@extends('master')
@section('script')
  @parent
    
    <script src="{{ asset('public/Js/SIAB/actividad.js') }}"></script>   
    <script src="{{ asset('public/Js/bootstrap-datepicker.js') }}"></script>           
    {{Html::style('public/Css/bootstrap-datepicker3.css')}}   

@stop  
@section('content')
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>ACTIVIDADES DE INTERVENCIÓN CULTURAL Y DE COHESIÓN</h3></center>
 <input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/> 
    <div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
        <br><br>
        <div class="content">
            <div align="right">
                <button type="button" class="btn btn-info" name="Enviar" id="Crear_Nueva">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Crear actividad nueva
                </button>
            </div>
            <br><br>
            <div class="panel-body">
                <table id="TablaActividades" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><center>TIPO DE ACTIVIDAD</center></th>
                            <th><center>FECHA PROGRAMADA</center></th>
                            <th><center>OPCIÓN</center></th>
                        </tr>
                    </thead>
                    <tbody>                    
                    @foreach($ActividadIntervencion as $ActividadIntervencion)

                        <tr>
                            <td>{{ $ActividadIntervencion->tipoActividad['Nombre_TipoActividad'] }}</td>
                            <td>
                                <center>{{ $ActividadIntervencion['Fecha_Programada'] }}</center>
                            </td>
                            <td>
                                <center>
                                    <button type="button" class="btn btn-success ver" value="{{$ActividadIntervencion['Id']}}" name="Ver" id="Ver" >
                                        <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>Ver actividad
                                    </button>
                                </center>
                            </td>
                        </tr>
                    @endforeach  
                    </tbody> 
                </table>
            </div>


            <form id="actividad" name="actividad" style ="display:none;" >       
                <input type="hidden" id="ActividadId" name="ActividadId">
                <div id="camposRegistro">                
                    <div class="content">
                        <div class="content">
                            <div style="text-align:center;">
                                <h3>Actividad de intervención cultura y de cohesión</h3>
                            </div>  
                            <!-- ---------------------------PASO 1--------------------------- -->
                            <div class="panel">                            
                                <!--<div class="panel-heading">                
                                    <div class="bs-callout bs-callout-info">                    
                                        <span class="glyphicon glyphicon-user " aria-hidden="true"></span>
                                        <label><p>DATOS DE IDENTIFICACIÓN</p></label>                         
                                        <span data-role="ver" id="seccion_uno_ver" class="glyphicon glyphicon-resize-full btn-lg btn-lg" aria-hidden="true"></span>
                                    </div>
                                </div> -->                                                
                                <ul class="list-group" id="seccion_uno" name="seccion_uno">
                                   <li class="list-group-item">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail" class="control-label">Descripción de la convivencia y/o necesidad sociocultural:</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <textarea class="form-control" placeholder="Descripción de la convivencia y/o necesidad sociocultural" name="Descripcion" id="Descripcion"> </textarea>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail" class="control-label" >Actividad a realizar:</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <select name="Actividad" id="Actividad" class="form-control">
                                                    <option value="">Seleccionar</option>
                                                    @foreach($TipoActividad as $TipoActividad)
                                                        <option value="{{ $TipoActividad['Id'] }}">{{ $TipoActividad['Nombre_TipoActividad'] }}</option>
                                                    @endforeach                                                           
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input class="form-control" type="text" name="Otro_Actividad" id="Otro_Actividad">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="panel-body">
                                            <center><h4>POBLACIÓN</h4></center>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail" class="control-label">DEPORTISTAS</label>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label">PROY.</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input class="form-control" type="text" name="DeportistaP" id="DeportistaP">
                                                </div>                                                   
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label" id="DeportistaAL">ASIST.</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input class="form-control" type="text" name="DeportistaA" id="DeportistaA">
                                                </div>                                                   
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail" class="control-label">EQUIPO MULTIDISCIPLINARIO</label>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label">PROY.</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input class="form-control" type="text" name="MultiP" id="MultiP">
                                                </div>                                                   
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label" id="MultiAL">ASIST.</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input class="form-control" type="text" name="MultiA" id="MultiA">
                                                </div>                                                   
                                            </div>                                            
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail" class="control-label">ENTRENADORES</label>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label">PROY.</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input class="form-control" type="text" name="EntrenadorP" id="EntrenadorP">
                                                </div>                                                   
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label" id="EntrenadorAL">ASIST.</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input class="form-control" type="text" name="EntrenadorA" id="EntrenadorA">
                                                </div>                                                   
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail" class="control-label">COMISIONADOS</label>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label">PROY.</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input class="form-control" type="text" name="ComisionadoP" id="ComisionadoP">
                                                </div>                                                   
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label" id="ComisionadoAL">ASIST.</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input class="form-control" type="text" name="ComisionadoA" id="ComisionadoA">
                                                </div>                                                   
                                            </div> 
                                            <div class="form-group col-md-4">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail" class="control-label">OTROS? Cuales</label>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <input class="form-control" type="text" name="Otros" id="Otros">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label">PROY.</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input class="form-control" type="text" name="OtrosP" id="OtrosP">
                                                </div>                                                   
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail" class="control-label" id="OtrosAL">ASIST.</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input class="form-control" type="text" name="OtrosA" id="OtrosA">
                                                </div>                                                   
                                            </div>                                          
                                        </div>                                        
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail" class="control-label">Fecha programada</label>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="input-group date form-control" id="FechaProgramadaDate" style="border: none;">
                                                        <input id="Fecha_Programada" class="form-control " type="text" value="" name="Fecha_Programada" default="" data-date="" data-behavior="Fecha_Programada">
                                                        <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                                    </div>    
                                                </div>                                                
                                            </div>
                                            <div class="form-group col-md-3">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail" class="control-label" id="Fecha_RealizadaL">Fecha de realización</label>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="input-group date form-control" id="FechaRealizadaDate" style="border: none;">
                                                        <input id="Fecha_Realizada" class="form-control " type="text" value="" name="Fecha_Realizada" default="" data-date="" data-behavior="Fecha_Realizada">
                                                        <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                                    </div>    
                                                </div>                                                
                                            </div>                                         
                                            <div class="form-group col-md-3">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail" class="control-label" id="ReprogramacionL">Justificación a la reprogramación</label>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <textarea class="form-control" type="text" name="Reprogramacion" id="Reprogramacion"> </textarea> 
                                                </div>                                                
                                            </div>  
                                            <div class="form-group col-md-3">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail" class="control-label" id="Total_AsistentesL">Total personas asistentes</label>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <input class="form-control" type="text" name=" Total_Asistentes" id="Total_Asistentes">
                                                </div>                                                
                                            </div>                                         
                                        </div>
                                    </li>                                    
                                    </li>
                                    <li class="list-group-item">
                                        <div class="panel-body">
                                            <center><h4>EVALUACIÓN DE LA INTERVENCIÓN</h4></center>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail" class="control-label" id="ObservacionesL">Observaciones</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <textarea class="form-control" type="text" name="Observaciones" id="Observaciones"></textarea>
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail" class="control-label" id="Total_EvaluadoresL">Total de usuarios que evaluan la actividad(Mínimo el 30% de los participantes)</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input class="form-control" type="text" name=" Total_Evaluadores" id="Total_Evaluadores">
                                            </div>                                            
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Nombre gestor/a cultura y cohesión</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control" type="text" name="Nombre_Gestor" id="Nombre_Gestor">
                                            </div>       
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Nombre Coordinador/a SIAB</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control" type="text" name=" Nombre_Coordinador" id="Nombre_Coordinador">
                                            </div>                                            
                                        </div>
                                    </li>

                                    <li class="list-group-item" id="AnexosD">     
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <div class="row" id="Anexo1Registro">
                                                    <div class="form-group col-md-6 text-center">
                                                        <label for="inputEmail" class="control-label">Anexo 1</label>
                                                        <br>
                                                        <span id="SAnexo1">
                                                        </span>
                                                        <br>                                    
                                                        <input type="file" id ="Anexo1Dep" name="Anexo1Dep">
                                                        <p class="help-block">Anexo en formato jpeg,jpg,png,bmp,pdf.</p>                                                         
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="row" id="Anexo2Registro">
                                                    <div class="form-group col-md-6 text-center">
                                                        <label for="inputEmail" class="control-label">Anexo 2</label>
                                                        <br>
                                                        <span id="SAnexo2">
                                                        </span>
                                                        <br>                                    
                                                        <input type="file" id ="Anexo2Dep" name="Anexo2Dep">
                                                        <p class="help-block">Anexo en formato jpeg,jpg,png,bmp,pdf.</p> 
                                                    </div>
                                                </div>
                                            </div>   
                                            <div class="form-group col-md-12"></div>
                                            <div class="form-group col-md-6">
                                                <div class="row" id="Anexo3Registro">
                                                    <div class="form-group col-md-6 text-center">
                                                    <label for="inputEmail" class="control-label">Anexo 3</label>
                                                    <br>
                                                    <span id="SAnexo3">
                                                    </span>
                                                    <br>                                    
                                                    <input type="file" id ="Anexo3Dep" name="Anexo3Dep">
                                                    <p class="help-block">Anexo en formato jpeg,jpg,png,bmp,pdf.</p>                                                         
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="form-group col-md-6">
                                                <div class="row" id="Anexo4Registro">
                                                    <div class="form-group col-md-6 text-center">
                                                        <label for="inputEmail" class="control-label">Anexo 4</label>
                                                        <br>
                                                        <span id="SAnexo4">
                                                        </span>
                                                        <br>                                    
                                                        <input type="file" id ="Anexo4Dep" name="Anexo4Dep">
                                                        <p class="help-block">Anexo en formato jpeg,jpg,png,bmp,pdf.</p>                                                         
                                                    </div>
                                                </div>
                                            </div>                                        
                                        </div>
                                   </li>
                                    <li class="list-group-item">
                                        <!-- ----------------------BOTONERA------------------- -->
                                        <div id="Botonera" >
                                            <center>
                                                <button type="button" class="btn btn-primary" name="Enviar" id="RegistrarActividad">Registrar actividad</button>
                                                <button type="button" class="btn btn-info" name="Enviar" id="ModificarActividad">Modificar actividad</button>
                                            </center>
                                        </div>
                                        <!-- ----------------------FIN DE BOTONERA------------------- -->
                                    </li>
                                </ul>                            
                            </div>
                        </div>
                    </div>
                </div>                
            </form>
            <div class="form-group"  id="mensaje_actividad" style="display: none;">
                <div id="alert_actividad"></div>
            </div>
            <br><br><br><br><br>
        </div>        
    </div>
@stop