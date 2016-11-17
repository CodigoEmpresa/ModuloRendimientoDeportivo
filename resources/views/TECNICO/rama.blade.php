@extends('master')

@section('script')
    @parent

    <script src="{{ asset('public/Js/Tecnico/rama.js') }}"></script> 
@stop

@section('content')
    <div class="content">
        <div class="row">
            <div>
              <button type="button" class="btn btn-info" onclick="window.location.href='configuracion'">Agrupaciones</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='deporte'">Deportes</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='modalidad'">Modalidades</button>
              <!--<button type="button" class="btn btn-success" onclick="window.location.href='rama'">Ramas</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='categoria'">Categorias</button>
              <button type="button" class="btn btn-info" onclick="window.location.href='division'">Divisiones</button>-->
            </div>
        </div>
        <br><br>
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">RAMA: Configuración de la rama.</h3>
            </div>
            <div class="panel-body">                
                <div class="row">                   
                    <div class="col-xs-6 col-sm-8">
                        <div class="form-group">
                            <label class="control-label" for="Id_TipoDocumento">Rama</label>
                            <select name="Id_rm" id="Id_rm" class="form-control">
                                <option value="">Seleccionar</option>
                                @foreach($Rama as $rama)
                                    <option value="{{ $rama['Id'] }}">{{ $rama['Nombre_Rama'] }}</option>
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
                <div class="alert alert-danger" role="alert" style="display: none"id="div_mensaje">Debe elejir una rama.</div>
                <!-- Editar -->
                <div class="row" id="div_editar" style="display: none">
                    <form id="form_edit">
                        <div class="col-xs-12">
                            <div class="page-header">
                                <h3>Editar</h3>
                            </div>
                        </div>                         
                        <div class="col-xs-6 col-sm-8">
                            <label class="control-label" for="Id_TipoDocumento">Rama:</label>
                            <input type="text" class="form-control"  placeholder="Rama" id="nom_ra" name="nom_ra">
                            <input type="hidden" placeholder="Deporte" id="id_Rm" name="id_Rm">
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
                        <input type="hidden" id="id_rama"></input>
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
                                <h3>Crear Rama</h3>
                            </div>
                        </div> 
                        
                        <div class="col-xs-6 col-sm-8">
                            <label class="control-label" for="Nom_Deporte">Nombre rama:</label>
                            <input type="text" class="form-control"  placeholder="Rama" name="Nom_Rama">
                        </div> 
                        <div class="col-xs-6 col-sm-4">
                            <label class="control-label" for="Id_TipoDocumento">Acción:</label><br>
                            <button type="button" class="btn btn-success" id="btn_crear_rm">Crear</button>
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
              <h3 class="panel-title">Listado rama</h3>
            </div>
            <div class="panel-body">
                    <table id="example" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Rama</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Rama</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($Rama as $Rama)
                                <tr>
                                    <td>{{ $Rama['Id'] }}</td>
                                    <td>{{ $Rama['Nombre_Rama'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
@stop