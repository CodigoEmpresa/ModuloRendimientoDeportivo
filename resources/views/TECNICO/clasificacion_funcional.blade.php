@extends('master')

@section('script')
    @parent

    <script src="{{ asset('public/Js/Tecnico/clasificacion_funcional.js') }}"></script> 
@stop

@section('content')
    <div class="content">
        <div class="row">
            <div>
              <button type="button" class="btn btn-info" onclick="window.location.href='configuracion'">Agrupaciones</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='deporte'">Deportes</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='modalidad'">Modalidades</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='rama'">Ramas</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='categoria'">Categorias</button>              
              <button type="button" class="btn btn-info" onclick="window.location.href='division'">Pruebas/Divisiones</button>
              <button type="button" class="btn btn-success" onclick="window.location.href='clasificacion_funcional'">Clasificación Funcional</button>
            </div>
        </div>
        <br><br>
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">CLASIFICACIÓN FUNCIONAL: Configuración de la clasificación funcional.</h3>
            </div>
            <div class="panel-body">                
                <div class="row">                   
                    <div class="col-xs-6 col-sm-8">
                        <div class="form-group">
                            <label class="control-label" for="Id_TipoDocumento">Búsqueda de Clasificación Funcional</label>
                            <select class="form-control selectpicker" name="Id_Claificacion_Funcional" id="Id_Claificacion_Funcional" data-live-search="true">
                                <option value="">Seleccionar</option>
                                @foreach($ClasificacionFuncional as $ClasificacionFuncionales)
                                    <option value="{{ $ClasificacionFuncionales['Id'] }}">{{ $ClasificacionFuncionales['Nombre_Clasificacion_Funcional'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4">
                        <label class="control-label" for="Id_TipoDocumento">Gestionar:</label>
                        <div class="form-group">
                            <div class="btn-group" role="group" aria-label="...">
                              <button type="button" class="btn btn-default" id="a_editar">Editar</button>
                              <button type="button" class="btn btn-default" id="a_eliminar">Eliminar</button>
                              <button type="button" class="btn btn-success" id="a_nuevo">Nuevo</button>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="alert alert-danger" role="alert" style="display: none" id="div_mensaje">Debe elejir una Clasificación Funcional.</div>
                <!-- Editar -->
                <div class="row" id="div_editar" style="display: none">
                    <form id="form_edit">
                        <div class="col-xs-12">
                            <div class="page-header">
                                <h3>Editar</h3>
                            </div>
                        </div>                         
                        <div class="form-group col-md-12">                        
                            <label class="control-label" for="Id_TipoDocumento">Clasificación Funcional:</label>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" style="text-transform: uppercase;" class="form-control"  placeholder="Clasificación Funcional" id="Nombre_Clasificacion_FuncionalE" name="Nombre_Clasificacion_FuncionalE">
                            <input type="hidden" id="Id_Clasificacion_FuncionalE" name="Id_Clasificacion_FuncionalE">
                        </div> 
                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div  role="alert" style="display: none"id="div_mensaje6"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <label class="control-label" for="Id_TipoDocumento">Acción:</label><br>
                            <button type="button" class="btn btn-primary" id="btn_editar">Modificar</button>
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
                        <input type="hidden" id="id_Clasificación Funcional"></input>
                    </div>             
                    <!--<div class="col-xs-6 col-sm-4">
                        <label class="control-label" for="Id_TipoDocumento">Acción:</label><br>
                        <button type="button" class="btn btn-danger" id="btn_eliminar_rm">Eliminar</button>
                    </div> -->                    
                </div>
                <!-- Crear Nuevo -->
                <div class="row" id="div_nuevo" style="display: none">
                    <form id="form_nuevo">
                        <div class="col-xs-12">
                            <div class="page-header">
                                <h3>Crear Clasificación Funcional</h3>
                            </div>
                        </div> 
                        
                        <div class="form-group col-md-12">
                            <label class="control-label" for="Nom_Deporte">Nombre Clasificación Funcional:</label>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" style="text-transform: uppercase;" class="form-control"  placeholder="Clasificación Funcional" name="Nom_Clasificacion_Funcional" id="Nom_Clasificacion_Funcional">
                        </div> 
                        <div class="form-group col-md-12">
                            <button type="button" class="btn btn-success" id="Agregar_Clasificacion">Crear Clasificación Funcional</button>
                        </div> 
                    </form>  
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div  role="alert" style="display: none"id="div_mensaje5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>		    
    </div>
    <div class="content">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Listado Clasificación Funcional</h3>
            </div>
            <div class="panel-body">
                    <table id="example" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Clasificación Funcional</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Clasificación Funcional</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($ClasificacionFuncional as $ClasificacionFuncionales)
                                <tr style="text-transform: uppercase;">
                                    <td>{{ $ClasificacionFuncionales['Id'] }}</td>
                                    <td>{{ $ClasificacionFuncionales['Nombre_Clasificacion_Funcional'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
@stop