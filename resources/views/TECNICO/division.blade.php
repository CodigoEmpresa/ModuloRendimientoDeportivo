@extends('master')

@section('script')
    @parent

    <script src="{{ asset('public/Js/Tecnico/division.js') }}"></script> 
@stop

@section('content')
    <div class="content">
        <div class="row">
            <div>
              <button type="button" class="btn btn-info" onclick="window.location.href='configuracion'">Agrupaciones</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='deporte'">Deportes</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='modalidad'">Modalidades</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='rama'">Ramas</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='categoria'">Categorías</button>
              <button type="button" class="btn btn-success" onclick="window.location.href='division'">Pruebas/Divisiones</button>
            </div>
        </div>
        <br><br>
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">DIVISIÓN: Configuración de la división.</h3>
            </div>
            <div class="panel-body">                
                <div class="row">                   
                    <div class="col-xs-6 col-sm-8">
                        <div class="form-group">
                            <label class="control-label" for="Id_TipoDocumento">División</label>
                            <select class="form-control selectpicker" name="Id_Division" id="Id_Division" data-live-search="true">
                                <option value="">Seleccionar</option>
                                @foreach($Division as $Divisiones)
                                    <option value="{{ $Divisiones['Id'] }}">{{ $Divisiones['Id']." ".$Divisiones['Nombre_Division'] }}</option>
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
                <div class="alert alert-danger" role="alert" style="display: none"id="div_mensaje">Debe elejir una división.</div>
                <!-- Editar -->
                <div class="container" id="loadingE" style="display:none;">
                    <center><button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button></center>
                </div>      
                <div class="row" id="div_editar" style="display: none">
                    <form id="form_edit">
                        <div class="col-xs-12">
                            <div class="page-header">
                                <h3>Editar</h3>
                            </div>
                        </div>                                           
                        <input type="hidden" id="Id_division" name="Id_division">
                        <!--<div class="col-xs-4">
                            <label class="control-label" for="Id_TipoDocumento">División:</label>
                            <input type="text" class="form-control"  placeholder="División" id="nom_division" name="nom_division">
                            
                        </div> 
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="control-label" for="Id_TipoDocumento">Tipo de evaluación</label>
                                <select class="form-control" name="Tipo_Evaluacion_E" id="Tipo_Evaluacion_E">
                                    <option value="">Seleccionar</option>
                                    @foreach($TipoEvaluacion as $Tipo_Evaluaciones)
                                        <option value="{{ $Tipo_Evaluaciones['Id'] }}">{{ $Tipo_Evaluaciones['Nombre_Tipo_Evaluacion'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>-->
                        <!------------------- ------------------------------- -->
                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Clasificacion">Clasificación:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Clasificacion_IdE" id="Clasificacion_IdE" class="form-control">
                                <option value="">Seleccionar</option>
                                @foreach($ClasificacionDeportista as $ClasificacionDeportista)
                                    <option value="{{ $ClasificacionDeportista['Id'] }}">{{ $ClasificacionDeportista['Nombre_Clasificacion_Deportista'] }}</option>
                                @endforeach
                            </select>
                        </div> 

                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Agrupacion">Agrupación:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Agrupacion_IdE" id="Agrupacion_IdE" class="form-control">
                                <option value="">Seleccionar</option>
                            </select>
                        </div> 

                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Deporte">Deporte:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Deporte_IdE" id="Deporte_IdE" class="form-control">
                                <option value="">Seleccionar</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Modalidad">Modalidad:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Modalidad_IdE" id="Modalidad_IdE" class="form-control">
                                <option value="">Seleccionar</option>
                            </select>
                        </div> 

                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Rama">Rama:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Rama_IdE" id="Rama_IdE" class="form-control">
                                <option value="">Seleccionar</option>
                                @foreach($Rama as $Rama)
                                    <option value="{{ $Rama['Id'] }}">{{ $Rama['Nombre_Rama'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Categoria">Categoría:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Categoria_IdE" id="Categoria_IdE" class="form-control">
                                <option value="">Seleccionar</option>
                                 @foreach($Categoria as $Categoria)
                                    <option value="{{ $Categoria['Id'] }}">{{ $Categoria['Nombre_Categoria'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Evaluacion">Tipo de Evaluación:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Tipo_Evaluacion_E" id="Tipo_Evaluacion_E" class="form-control">
                                <option value="">Seleccionar</option>
                                 @foreach($TipoEvaluacion as $Tipo_Evaluaciones)
                                    <option value="{{ $Tipo_Evaluaciones['Id'] }}">{{ $Tipo_Evaluaciones['Nombre_Tipo_Evaluacion'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Nom_Deporte">Nombre de la división:</label>
                        </div>
                        <div class="form-group col-md-4">                    
                            <input type="text" class="form-control"  placeholder="División" id ="nom_division" name="nom_division">
                        </div>
                        <!------------------- ------------------------------- -->
                        <div class="col-xs-4">
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
                        <label class="control-label" for="label_eliminar">Confirmación:</label>
                        <br><label class="control-label" id="label_eliminar"></label>
                        <input type="hidden" id="id_division_e"></input>
                    </div> 
            
                    <!--<div class="col-xs-6 col-sm-4">
                        <label class="control-label" for="Id_TipoDocumento">Acción:</label><br>
                        <button type="button" class="btn btn-danger" id="btn_eliminar_rm">Eliminar</button>
                    </div>      -->               
                </div>
                <!-- Crear Nuevo -->
                <div class="row" id="div_nuevo" style="display: none">
                    <form id="form_nuevo">
                        <div class="col-xs-12">
                            <div class="page-header">
                                <h3>Crear División</h3>
                            </div>
                        </div>           

                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Clasificacion">Clasificación:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Clasificacion_Id" id="Clasificacion_Id" class="form-control">
                                <option value="">Seleccionar</option>
                                @foreach($ClasificacionDeportista as $ClasificacionDeportista)
                                    <option value="{{ $ClasificacionDeportista['Id'] }}">{{ $ClasificacionDeportista['Nombre_Clasificacion_Deportista'] }}</option>
                                @endforeach
                            </select>
                        </div> 

                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Agrupacion">Agrupación:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Agrupacion_Id" id="Agrupacion_Id" class="form-control">
                                <option value="">Seleccionar</option>
                            </select>
                        </div> 

                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Deporte">Deporte:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Deporte_Id" id="Deporte_Id" class="form-control">
                                <option value="">Seleccionar</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Modalidad">Modalidad:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Modalidad_Id" id="Modalidad_Id" class="form-control">
                                <option value="">Seleccionar</option>
                            </select>
                        </div> 

                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Rama">Rama:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Rama_Id" id="Rama_Id" class="form-control">
                                <option value="">Seleccionar</option>
                                @foreach($Rama as $Rama)
                                    <option value="{{ $Rama['Id'] }}">{{ $Rama['Nombre_Rama'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Categoria">Categoría:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Categoria_Id" id="Categoria_Id" class="form-control">
                                <option value="">Seleccionar</option>
                                 @foreach($Categoria as $Categoria)
                                    <option value="{{ $Categoria['Id'] }}">{{ $Categoria['Nombre_Categoria'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Evaluacion">Tipo de Evaluación:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="Evaluacion_Id" id="Evaluacion_Id" class="form-control">
                                <option value="">Seleccionar</option>
                                 @foreach($TipoEvaluacion as $Tipo_Evaluaciones)
                                    <option value="{{ $Tipo_Evaluaciones['Id'] }}">{{ $Tipo_Evaluaciones['Nombre_Tipo_Evaluacion'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2">                    
                            <label class="control-label" for="Nom_Deporte">Nombre de la división:</label>
                        </div>
                        <div class="form-group col-md-4">                    
                            <input type="text" class="form-control"  placeholder="División" name="Nom_Division">
                        </div>

                      <!--  <div class="col-xs-4">
                            <label class="control-label" for="Nom_Deporte">Nombre de la división:</label>
                            <input type="text" class="form-control"  placeholder="División" name="Nom_Division">
                        </div> 
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="control-label" for="Id_TipoDocumento">Tipo de evaluación</label>
                                <select class="form-control selectpicker" name="Tipo_Evaluacion" id="Tipo_Evaluacion" data-live-search="true">
                                    <option value="">Seleccionar</option>
                                    @foreach($TipoEvaluacion as $Tipo_Evaluaciones)
                                        <option value="{{ $Tipo_Evaluaciones['Id'] }}">{{ $Tipo_Evaluaciones['Id']." ".$Tipo_Evaluaciones['Nombre_Tipo_Evaluacion'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>-->
                        <div class="col-xs-4">
                            <label class="control-label" for="Id_TipoDocumento">Acción:</label><br>
                            <button type="button" class="btn btn-success" id="btn_crear_ct">Crear</button>
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
              <h3 class="panel-title">Listado categorías</h3>
            </div>
            <div class="panel-body">
                    <table id="example" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>División</th>
                                <th>Forma de evaluación</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>División</th>
                                <th>Forma de evaluación</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($Division as $Divisiones)
                                <tr>
                                    <td>{{ $Divisiones['Id'] }}</td>                                    
                                    <td>{{ $Divisiones['Nombre_Division'] }}</td>
                                    <td>{{ $Divisiones->tipoEvaluacion['Nombre_Tipo_Evaluacion'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
   
@stop