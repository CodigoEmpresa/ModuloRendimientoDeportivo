@extends('master')

@section('script')
    @parent

    <script src="{{ asset('public/Js/Tecnico/agrupacion.js') }}"></script> 
@stop

@section('content')
    <div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}"> </div>
    <div class="content">
        <div class="row">
            <div>
              <button type="button" class="btn btn-success" onclick="window.location.href='configuracion'">Agrupaciones</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='deporte'">Deportes</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='modalidad'">Modalidades</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='rama'">Ramas</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='categoria'">Categorías</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='division'">Pruebas/Divisiones</button>
            </div>
        </div>
        <br><br>
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">AGRUPACION: Configuración de las agrupaciones</h3>
            </div>
            <div class="panel-body">                
                <div class="row">                   
                    <div class="col-xs-6 col-sm-8">
                        <div class="form-group">
                            <label class="control-label" for="Id_TipoDocumento">Agrupación</label>
                            <select class="form-control selectpicker" name="Id_Agrupacion" id="Id_Agrupacion" data-live-search="true">
                                <option value="">Seleccionar</option>
                                @foreach($agrupacion_datos as $agrupaciones)
                                    <option value="{{ $agrupaciones['Id'] }}">{{ $agrupaciones['Id']." ".$agrupaciones['Nombre_Agrupacion'] }}</option>
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
                <div class="alert alert-danger" role="alert" style="display: none"id="div_mensaje">Debe elejir una agrupación.</div>
                <!-- Editar -->
                <div class="row" id="div_editar" style="display: none">
                    <form id="form_edit">
                        <div class="col-xs-12">
                            <div class="page-header">
                                <h3>Editar</h3>
                            </div>
                        </div> 
                        <div class="col-xs-6 col-sm-4">
                            <label class="control-label" for="Id_TipoDocumento">Clasificación:</label>
                            <select name="Id_cla" id="Id_cla" class="form-control">
                                    <option value="">Seleccionar</option>
                                    @foreach($clasificacion_deportista as $clasificacion_deportistas)
                                        <option value="{{ $clasificacion_deportistas['Id'] }}">{{ $clasificacion_deportistas['Nombre_Clasificacion_Deportista'] }}</option>
                                    @endforeach
                            </select>
                        </div>                         
                        <div class="col-xs-6 col-sm-4">
                            <label class="control-label" for="Id_TipoDocumento">Agrupación:</label>
                            <input type="text" class="form-control" style="text-transform: uppercase;"  placeholder="Agrupación" id="nom_agrup" name="nom_agrup">
                            <input type="hidden" placeholder="Agrupación" id="id_agrup" name="id_agrup">
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
                    <div class="col-xs-6 col-sm-12">
                        <label class="control-label" for="label_eliminar">Advertencia:</label>
                        <br><label class="control-label" id="label_eliminar"></label>
                        <input type="hidden" id="id_agrup"></input>
                    </div> 
            
                   <!-- <div class="col-xs-6 col-sm-4">
                        <label class="control-label" for="Id_TipoDocumento">Acción:</label><br>
                        <button type="button" class="btn btn-danger" id="btn_eliminar">Eliminar</button>
                    </div>       -->              
                </div>
                <!-- Crear Neuvo -->
                <div class="row" id="div_nuevo" style="display: none">
                    <form id="form_nuevo">
                        <div class="col-xs-12">
                            <div class="page-header">
                                <h3>Crear Agrupación</h3>
                            </div>
                        </div> 
                        <div class="col-xs-6 col-sm-4">
                            <label class="control-label" for="Id_TipoDocumento">Clasificación:</label>
                            <select name="Id_Clase" id="Id_Clase" class="form-control">
                                    <option value="">Seleccionar</option>
                                    @foreach($clasificacion_deportista as $clasificacion_deportistas)
                                        <option value="{{ $clasificacion_deportistas['Id'] }}">{{ $clasificacion_deportistas['Nombre_Clasificacion_Deportista'] }}</option>
                                    @endforeach
                            </select>
                        </div>                         
                        <div class="col-xs-6 col-sm-4">
                            <label class="control-label" for="Nom_Agrupacion">Nombre:</label>
                            <input type="text" class="form-control" style="text-transform: uppercase;" placeholder="Agrupación" name="Nom_Agrupacion">
                        </div> 
                        <div class="col-xs-6 col-sm-4">
                            <label class="control-label" for="Id_TipoDocumento">Acción:</label><br>
                            <button type="button" class="btn btn-success" id="btn_crear">Crear</button>
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
              <h3 class="panel-title">Listado de agrupaciones</h3>
            </div>
            <div class="panel-body">
                    <table id="example" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Agrupación</th>
                                <th>Clase</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Agrupación</th>
                                <th>Clase</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($agrupacion_datos as $agrupaciones)
                                <tr>
                                    <td>{{ $agrupaciones['Id'] }}</td>
                                    <td>{{ $agrupaciones['Nombre_Agrupacion'] }}</td>
                                    <td>{{ $agrupaciones->ClasificacionDeportista['Nombre_Clasificacion_Deportista'] }}</td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
@stop