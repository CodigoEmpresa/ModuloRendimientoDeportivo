@extends('master')

@section('script')
    @parent

    <script src="{{ asset('public/Js/Tecnico/deporte.js') }}"></script> 
@stop

@section('content')
    <div class="content">
        <div class="row">
            <div>
              <button type="button" class="btn btn-info" onclick="window.location.href='configuracion'">Agrupaciones</button>
              <button type="button" class="btn btn-success" onclick="window.location.href='deporte'">Deportes</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='modalidad'">Modalidades</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='rama'">Ramas</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='categoria'">Categorías</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='division'">Pruebas/Divisiones</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='clasificacion_funcional'">Clasificación Funcional</button>
            </div>
        </div>
        <br><br>
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">DEPORTE: Configuración de los deportes.</h3>
            </div>
            
            <div class="panel-body">                
                <div class="row">                   
                    <div class="col-xs-6 col-sm-8">
                        <div class="form-group">
                            <label class="control-label" for="Id_TipoDocumento">Búsqueda de Deporte</label>
                             <select class="form-control selectpicker" name="Id_Deporte" id="Id_Deporte" data-live-search="true">
                                <option value="">Seleccionar</option>
                                @foreach($deporte as $deportes)
                                    @if($deportes->agrupacion['ClasificacionDeportista_Id'] == 1)
                                         <option style="text-transform: uppercase;" value="{{ $deportes['Id'] }}">{{ $deportes['Id'].". ".
                                        $deportes->agrupacion->ClasificacionDeportista['Nombre_Clasificacion_Deportista']." - ".$deportes['Nombre_Deporte']}}
                                        </option>
                                    @endif
                                    @if($deportes->agrupacion['ClasificacionDeportista_Id'] == 2)
                                        @if(count($deportes->deporteDiscapacidad) == 0)
                                            <option style="text-transform: uppercase;" value="{{ $deportes['Id'] }}">{{ $deportes['Id'].". ".
                                            $deportes->agrupacion->ClasificacionDeportista['Nombre_Clasificacion_Deportista']." - ".$deportes['Nombre_Deporte']." - No Asignada"}}
                                            </option>
                                        @endif
                                         @foreach($deportes->deporteDiscapacidad as $discapacidades)
                                             <option style="text-transform: uppercase;" value="{{ $deportes['Id'] }}">{{ $deportes['Id'].". ".
                                            $deportes->agrupacion->ClasificacionDeportista['Nombre_Clasificacion_Deportista']." - ".$deportes['Nombre_Deporte']." - ".$discapacidades['Nombre_Discapacidad']}}
                                            </option>
                                        @endforeach
                                    @endif
                                    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4">
                        <label class="control-label" for="Id_TipoDocumento">Gestionar:</label>
                        <div class="form-group">
                            <div class="btn-group" role="group" aria-label="...">
                              <button type="button" class="btn btn-default" id="a_edicar">Editar</button>
                              <button type="button" class="btn btn-default" id="a_eliminar">Eliminar</button>
                              <button type="button" class="btn btn-success" id="a_nuevo">Nuevo</button>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="alert alert-danger" role="alert" style="display: none"id="div_mensaje">Debe elejir un deporte.</div>
                <!-- Editar -->
                <div class="row" id="div_editar" style="display: none">
                    <form id="form_edit">
                        <div class="col-xs-12">
                            <div class="page-header">
                                <h3>Editar</h3>
                            </div>
                        </div> 
                        <div class="form-group col-md-2">
                            <label class="control-label" for="Id_TipoDocumento">Clasificación:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Id_Clase" id="Id_Clase" class="form-control">
                                    <option value="">Seleccionar</option>
                                    @foreach($clasificacion_deportista as $clasificacion_deportistas)
                                        <option value="{{ $clasificacion_deportistas['Id'] }}">{{ $clasificacion_deportistas['Nombre_Clasificacion_Deportista'] }}</option>
                                    @endforeach
                            </select>
                        </div>     
                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Id_TipoDocumento">Agrupación:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Id_Agrupa" id="Id_Agrupa" class="form-control">
                                <option value="">Seleccionar</option>
                            </select>
                        </div>                    

                        <div id="DiscapacidadDE" style="display: none;">
                            <div class="form-group col-md-2">
                                <label class="control-label" for="Id_TipoDocumento">Discapacidad:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="Id_DiscapacidadE" id="Id_DiscapacidadE" class="form-control">
                                    <option value="">Seleccionar</option>
                                     @foreach($discapacidad as $discapacidades)
                                        <option value="{{ $discapacidades['Id'] }}">{{ $discapacidades['Nombre_Discapacidad'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label" for="Id_TipoDocumento">Deporte:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" style="text-transform: uppercase;" class="form-control"  placeholder="Deporte" id="nom_depot" name="nom_depot">
                            <input type="hidden" placeholder="Deporte" id="id_Dpt" name="id_Dpt">
                        </div>                    
                        <div class="form-group col-md-12">
                            <center><button type="button" class="btn btn-primary" id="btn_editar">Modificar</button></center>
                        </div>
                    </form>                    
                </div>
                <!-- Eliminar -->
                <div class="row" id="div_eliminar" style="display: none">
                
                    <div class="col-xs-12">
                        <div class="page-header">
                            <h3>Eliminar</h3>
                        </div>
                    </div> 
                    <div class="col-xs-6 col-sm-8">
                        <label class="control-label" for="label_eliminar">Advertencia:</label>
                        <br><label class="control-label" id="label_eliminar"></label>
                        <input type="hidden" id="id_deport"></input>
                    </div> 
            
                    <!--<div class="col-xs-6 col-sm-4">
                        <label class="control-label" for="Id_TipoDocumento">Acción:</label><br>
                        <button type="button" class="btn btn-danger" id="btn_eliminar_dpt">Eliminar</button>
                    </div>        -->             
                </div>
                <!-- Crear Neuvo -->
                <div class="row" id="div_nuevo" style="display: none">
                    <form id="form_nuevo">
                        <div class="col-xs-12">
                            <div class="page-header">
                                <h3>Crear Deporte</h3>
                            </div>
                        </div> 
                        <div class="form-group col-md-2">
                            <label class="control-label" for="Id_TipoDocumento">Clasificación:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Id_Clasificacion" id="Id_Clasificacion" class="form-control">
                                <option value="">Seleccionar</option>
                                 @foreach($clasificacion_deportista as $clasificacion_deportistas)
                                    <option value="{{ $clasificacion_deportistas['Id'] }}">{{ $clasificacion_deportistas['Nombre_Clasificacion_Deportista'] }}</option>
                                @endforeach
                            </select>
                        </div>                      
                        <div class="form-group col-md-2">                        
                            <label class="control-label" for="Id_TipoDocumento">Agrupación:</label>
                        </div>
                        <div class="form-group col-md-4">                        
                            <select name="Id_Agrupacion" id="Id_Agrupacion" class="form-control">
                                <option value="">Seleccionar</option>
                            </select>
                        </div> 

                        <div id="DiscapacidadD" style="display: none;">
                            <div class="form-group col-md-2">
                                <label class="control-label" for="Id_TipoDocumento">Discapacidad:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="Id_Discapacidad" id="Id_Discapacidad" class="form-control">
                                    <option value="">Seleccionar</option>
                                     @foreach($discapacidad as $discapacidades)
                                        <option value="{{ $discapacidades['Id'] }}">{{ $discapacidades['Nombre_Discapacidad'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label" for="Nom_Deporte">Nombre deporte:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" style="text-transform: uppercase;" class="form-control"  placeholder="Deporte" name="Nom_Deporte">
                        </div> 
                        <div class="form-group col-md-12">
                            <center><button type="button" class="btn btn-success" id="btn_crear_dpt">Crear</button></center>
                        </div> 
                    </form>  
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-12">
                        </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div  role="alert" style="display: none"id="div_mensaje2"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>          
    </div>
    <div class="content">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Listado de deportes</h3>
            </div>
            <div class="panel-body">
                    <table id="example" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Clasificación</th>
                                <th>Deporte</th>
                                <th>Discapacidad</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Clasificación</th>
                                <th>Deporte</th>
                                <th>Discapacidad</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($deporte as $deportesTabla)
                                @if($deportesTabla->agrupacion['ClasificacionDeportista_Id'] == 1)
                                    <tr style="text-transform: uppercase;">
                                            <td>{{ $deportesTabla['Id'] }}</td>
                                            <td>{{ $deportesTabla->agrupacion->ClasificacionDeportista['Nombre_Clasificacion_Deportista'] }}</td>
                                            <td>{{ $deportesTabla['Nombre_Deporte'] }}</td>
                                            <td>No Aplica</td>
                                        </tr>
                                @endif
                                @if($deportesTabla->agrupacion['ClasificacionDeportista_Id'] == 2)
                                    @if(count($deportesTabla->deporteDiscapacidad) == 0)
                                        <tr style="text-transform: uppercase;">
                                            <td>{{ $deportesTabla['Id'] }}</td>
                                            <td>{{ $deportesTabla->agrupacion->ClasificacionDeportista['Nombre_Clasificacion_Deportista'] }}</td>
                                            <td>{{ $deportesTabla['Nombre_Deporte'] }}</td>
                                            <td>No asignada</td>
                                        </tr>
                                     @endif
                                     @foreach($deportesTabla->deporteDiscapacidad as $discapacidadesTabla)
                                        <tr style="text-transform: uppercase;">
                                            <td>{{ $deportesTabla['Id'] }}</td>
                                            <td>{{ $deportesTabla->agrupacion->ClasificacionDeportista['Nombre_Clasificacion_Deportista'] }}</td>
                                            <td>{{ $deportesTabla['Nombre_Deporte'] }}</td>
                                            <td>{{ $discapacidadesTabla['Nombre_Discapacidad'] }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach

                        </tbody>
                    </table>
            </div>
        </div>
    </div>
@stop