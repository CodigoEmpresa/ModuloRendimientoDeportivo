@extends('master')

@section('script')
    @parent

    <script src="{{ asset('public/Js/Tecnico/modalidad.js') }}"></script> 
@stop

@section('content')
    <div class="content">
        <div class="row">
            <div>
              <button type="button" class="btn btn-info" onclick="window.location.href='configuracion'">Agrupaciones</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='deporte'">Deportes</button>
              <button type="button" class="btn btn-success" onclick="window.location.href='modalidad'">Modalidades</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='rama'">Ramas</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='categoria'">Categorías</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='division'">Pruebas/Divisiones</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='clasificacion_funcional'">Clasificación Funcional</button>
            </div>
        </div>
        <br><br>
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">MODALIDAD: Configuración de modalidad.</h3>
            </div>
            <div class="panel-body">                
                <div class="row">                   
                    <div class="col-xs-6 col-sm-8">
                        <div class="form-group">
                            <label class="control-label" for="Id_TipoDocumento">Búsqueda de Modalidad</label>
                            <select class="form-control selectpicker" name="Id_mdl" id="Id_mdl" data-live-search="true">
                                <option value="">Seleccionar</option>
                                @foreach($modalidad as $modalidades)
                                    <option style="text-transform: uppercase;" value="{{ $modalidades['Id'] }}">{{ $modalidades['Id'].". ".$modalidades->deporte->agrupacion->ClasificacionDeportista['Nombre_Clasificacion_Deportista']." - ".$modalidades->deporte['Nombre_Deporte']." - ".$modalidades['Nombre_Modalidad'] }}</option>
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
                <div class="alert alert-danger" role="alert" style="display: none"id="div_mensaje">Debe elejir una modalidad.</div>
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
                        <div class="form-group col-md-2">
                            <label class="control-label" for="Id_TipoDocumento">Deporte:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Id_Dept" id="Id_Dept" class="form-control">
                                <option value="">Seleccionar</option>
                            </select>
                        </div>                        
                        <div class="form-group col-md-2">
                            <label class="control-label" for="Id_TipoDocumento">Modalidad:</label>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="text" style="text-transform: uppercase;" class="form-control"  placeholder="Modalidad" id="nom_modl" name="nom_modl">
                            <input type="hidden" placeholder="Deporte" id="id_Mdl" name="id_Mdl">
                        </div> 

                         <div id="ClasificacionFuncionalDE" class="list-group-item form-group col-md-12" style="display: none;">
                            <div class="form-group col-md-2">
                                <label class="control-label" for="Id_TipoDocumento">Clasificación Funcional:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="Id_Clasificacion_FuncionalE" id="Id_Clasificacion_FuncionalE" class="form-control">
                                    <option value="">Seleccionar</option>
                                    @foreach($clasificacion_funcional as $clasificacion_funcionales)
                                        <option value="{{ $clasificacion_funcionales['Id'] }}">{{ $clasificacion_funcionales['Nombre_Clasificacion_Funcional'] }}</option>
                                    @endforeach
                                </select>
                            </div>   
                            <div class="form-group col-md-6">
                                 <button type="button" class="btn btn-primary" name="AddClasificacionFuncionalE" id="AddClasificacionFuncionalE">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Clasificación
                                </button>
                            </div> 
                           
                            <table class="form-group col-md-8 table table-bordered" id="TablaClasificacionFuncionalE" style="display:none;">                                
                            </table>
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
                        <input type="hidden" id="id_moalidad"></input>
                    </div> 
            
                    <!--<div class="col-xs-6 col-sm-4">
                        <label class="control-label" for="Id_TipoDocumento">Acción:</label><br>
                        <button type="button" class="btn btn-danger" id="btn_eliminar_mdl">Eliminar</button>
                    </div>                     -->
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
                        <div class="form-group col-md-2">                            
                            <label class="control-label" for="Id_TipoDocumento">Deporte:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Id_Deporte" id="Id_Deporte" class="form-control">
                                     <option value="">Seleccionar</option>
                            </select>
                        </div>                        
                        <div class="form-group col-md-2">
                            <label class="control-label" for="Nom_Deporte">Nombre modalidad:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" style="text-transform: uppercase;" class="form-control"  placeholder="Modalidad" name="Nom_Modalidad">
                        </div> 
                        
                        
                        <div id="ClasificacionFuncionalD" class="list-group-item form-group col-md-12" style="display: none;">
                            <div class="form-group col-md-2">
                                <label class="control-label" for="Id_TipoDocumento">Clasificación Funcional:</label>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="Id_Clasificacion_Funcional" id="Id_Clasificacion_Funcional" class="form-control">
                                    <option value="">Seleccionar</option>
                                    @foreach($clasificacion_funcional as $clasificacion_funcionales)
                                        <option value="{{ $clasificacion_funcionales['Id'] }}">{{ $clasificacion_funcionales['Nombre_Clasificacion_Funcional'] }}</option>
                                    @endforeach
                                </select>
                            </div>   
                            <div class="form-group col-md-6">
                                 <button type="button" class="btn btn-primary" name="AddClasificacionFuncional" id="AddClasificacionFuncional">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Clasificación
                                </button>
                            </div> 
                           
                            <table class="form-group col-md-8 table table-bordered" id="TablaClasificacionFuncional" style="display:none;">                                
                            </table>
                        </div>

                        <div class="form-group col-md-12">
                            <center><button type="button" class="btn btn-success" id="btn_crear_mdl">Crear</button></center>
                        </div> 
                    </form>  
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
              <h3 class="panel-title">Listado de modalidades</h3>
            </div>
            <div class="panel-body">
                    <table id="example" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Modalidad</th>
                                <th>Deporte</th>
                                <th>Agrupación</th>
                                <th>Clase</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Modalidad</th>
                                <th>Deporte</th>
                                <th>Agrupación</th>
                                <th>Clase</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($modalidad as $modalidades)
                                <tr style="text-transform: uppercase;">
                                    <td>{{ $modalidades['Id'] }}</td>
                                    <td>{{ $modalidades['Nombre_Modalidad'] }}</td>
                                    <td>{{ $modalidades->deporte['Nombre_Deporte'] }}</td>
                                    <td>{{ $modalidades->deporte->agrupacion['Nombre_Agrupacion'] }}</td>
                                    <td>{{ $modalidades->deporte->agrupacion->ClasificacionDeportista['Nombre_Clasificacion_Deportista'] }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
            </div>
        </div>
    </div>
@stop