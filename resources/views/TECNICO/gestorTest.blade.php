@extends('master')

@section('script')
    @parent
    <script src="{{ asset('public/Js/Tecnico/gestorTest.js') }}"></script> 
    @stop

@section('content')
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>GESTOR DE TEST PEDAGÓGICOS</h3></center>
 <input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
    <div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
        <div class="content">
            <div class="panel-body">
                <div class="content" >
                    <ul class="nav nav-tabs">
                      <li role="presentation" id="TestLi" class="active"><a id="Test">Test</a></li>
                      <li role="presentation" id="VariablesLi" ><a id="Variables" >Variables</a></li>
                    </ul>
                    <!---------------------------------------------------------------------->
                    <form id="TestF" name="TestF" style="display: none;">
                        <br>
                        <div align="right">                        
                            <button type="button" class="btn btn-success" name="Crear_Test" id="Crear_Test">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Crear Nuevo Test
                            </button>
                        </div>
                        <br>                      
                        <div id="CrearTestDV" class="panel" style="display: none;">  
                            <div class="content">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                      <h3 class="panel-title">Agregar Test</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Tipo Test</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <select name="Tipo_Test" id="Tipo_Test" class="form-control">
                                                    <option value="">Seleccionar</option>
                                                    @foreach($TipoTest as $TipoTests)
                                                        <option value="{{ $TipoTests['Id'] }}">{{ $TipoTests['Nombre_Tipo_Test'] }}</option>
                                                    @endforeach 
                                                </select>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Nombre Test</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input type="text" class="form-control" name="Nombre_Test" id="Nombre_Test">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <center>
                                                    <button type="button" class="btn btn-success ver" value="" name="AgregarTest" id="AgregarTest" >Agregar Test</button>
                                                </center>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row panel-body" align="center">                                                                               
                            <div id="MensajeTest"></div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                              <h3 class="panel-title">Lista de Test</h3>                                      
                            </div>
                            <table id="TablaTestDatos" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>TIPO TEST</th>
                                        <th>NOMBRE TEST</th>
                                        <th>OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody id="TestDatosTB">                  
                                </tbody> 
                            </table>                               
                        </div>
                    </form>  
                    <!---------------------------------------------------------------------->
                    <form id="VariablesF" name="VariablesF" style="display: none;">
                        <br>
                        <div align="right">                        
                            <button type="button" class="btn btn-success" name="Crear_Variable" id="Crear_Variable">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Crear Nueva Variable
                            </button>
                        </div>
                        <br>                      
                        <div id="CrearVariableDV" class="panel" style="display: none;">  
                            <div class="content">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                      <h3 class="panel-title">Agregar Test</h3>                                      
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Unidad de medición</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input type="text" class="form-control" name="Unidad_Medicion" id="Unidad_Medicion">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputEmail" class="control-label">Nombre Variable</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input type="text" class="form-control" name="Nombre_Variable" id="Nombre_Variable">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <center>
                                                    <button type="button" class="btn btn-success ver" value="" name="AgregarVariable" id="AgregarVariable" >Agregar Variable</button>
                                                </center>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row panel-body" align="center">                                                                               
                            <div id="MensajeVariables"></div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                              <h3 class="panel-title">Lista de Variables</h3>                                      
                            </div>
                            <table id="TablaVariablesDatos" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>NOMBRE VARIABLE</th>
                                        <th>OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody id="VariablesDatosTB">                  
                                </tbody> 
                            </table>                               
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
@stop