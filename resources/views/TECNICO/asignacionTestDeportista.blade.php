@extends('master')

@section('script')
    @parent
    <script src="{{ asset('public/Js/Tecnico/asignacionTestDeportista.js') }}"></script> 
    @stop

@section('content')
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>ASIGNACIÓN DE TEST A UN DEPORTISTA</h3></center>
 <input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
    <div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
        <div class="content">
            <br><br>  
            @if($Persona['entrenador'] != null)
            <div class="panel-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title">Datos del entrenador</h3>
                    </div>                
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
                                            <small>{{$Persona['entrenador']['clasificacionDeportiva']['Nombre_Clasificacion_Deportista']}}</small>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-5">
                                        <h4>Deporte:</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 style="text-transform: uppercase;">
                                            <small>{{$Persona['entrenador']['deporte']['Nombre_Deporte']}}</small>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <table id="TablaDeportistasDatos" class="display nowrap" cellspacing="0" width="100%" style="text-transform: uppercase;">
                <thead>
                    <tr>
                        <th>NOMBRE DEPORTISTA</th>
                        <th>DOCUMENTO</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody id="TestDatosTB">   
                    @foreach($Persona['entrenador']['entrenadorDeportista'] as $Deportistas)
                        <tr>
                            <td>{{ $Deportistas['persona']['Primer_Nombre']}} {{ $Deportistas['persona']['Segundo_Nombre']}} {{ $Deportistas['persona']['Primer_Apellido']}} {{ $Deportistas['persona']['Segundo_Apellido']}}</td>
                            <td>{{ $Deportistas['persona']['Cedula'] }}</td>
                            <td>
                                <center>
                                    <button type="button" class="btn btn-primary" value="{{$Deportistas['Id']}}" data-function="AsignarTest" name="AsignarTest" id="AsignarTest" >
                                        <span class="glyphicon glyphicon-import" aria-hidden="true"></span>Asignar Test
                                    </button>
                                </center>
                            </td>
                        </tr>
                    @endforeach                  
                </tbody> 
            </table>   

            <div class="modal fade bs-example-modal-lg" id="AsignacionTestDeportistaModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Asignación Test-Deportista</h4><label style="text-transform: uppercase;" id="NombresDeportista"></label>
                         </div>
                         <div class="panel panel-primary">                         
                            <div class="panel-heading">
                                <h3 class="panel-title">Datos del entrenador</h3>
                            </div>
                            <form id="AsignacionTestDeportistaF" name="AsignacionTestDeportistaF">
                                <input type="hidden" name="Deportista_Id" id="Deportista_Id">
                                <div align="right">
                                    <br>
                                    <button type="button" class="btn btn-success" name="VerAsignar" id="VerAsignar">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Asignar Test
                                    </button>
                                    <br>
                                </div>
                                <div class="row panel-body" id="ADF" style="display: none;">
                                     <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">Tipo Test:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select name="Tipo_Test_Id" id="Tipo_Test_Id" class="form-control">
                                            <option value="">Seleccionar</option>                                            
                                            @foreach($TipoTest as $TipoTests)
                                                <option value="{{ $TipoTests['Id'] }}">{{ $TipoTests['Nombre_Tipo_Test'] }}</option>
                                            @endforeach
                                        </select>                                        
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">Test:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select name="Test_Id" id="Test_Id" class="form-control selectpicker" data-live-search="true">
                                            <option value="">Seleccionar</option>
                                        </select>                                        
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="inputEmail" class="control-label">Variable:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select name="Variable_Id" id="Variable_Id" class="form-control">
                                            <option value="">Seleccionar</option>   
                                            @foreach($VariableTest as $VariableTests)
                                                <option value="{{ $VariableTests['Id'] }}">{{ $VariableTests['Nombre_Variable'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">Resultado:</label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="text" style="text-transform: uppercase;" class="form-control"  placeholder="Resultado" id="Resultado" name="Resultado">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">Descripción del resultado:</label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea style="text-transform: uppercase;" class="form-control"  placeholder="Descripción del resultado" id="Descripcion" name="Descripcion"></textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <center>
                                            <button type="button" class="btn btn-info" value="" name="AgregarAsignacionDeportista" id="AgregarAsignacionDeportista" >Agregar Asignación Deportista</button>
                                        </center>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row panel-body" align="center">                                                                               
                            <div id="MensajeAsignacionDeportista"></div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                              <h3 class="panel-title">Lista de Test asignados</h3>                                      
                            </div>
                            <br>
                            <table id="TablaListaAsignadosDatos" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>TIPO TEST</th>
                                        <th>NOMBRE TEST</th>
                                        <th>RESULTADO</th>
                                        <th>DESCRIPCIÓN DEL RESULTADO</th>
                                        <th>OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody id="ListaAsignadosDatosTB">                  
                                </tbody> 
                            </table>                               
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="content" >
                    <ul class="nav nav-tabs">
                      <!--<li role="presentation" id="TestLi" class="active"><a id="Test">Test</a></li>
                      <li role="presentation" id="VariablesLi" ><a id="Variables" >Variables</a></li>-->
                    </ul>
                    <!---------------------------------------------------------------------->
                    <form id="AsignacionTestDeportistaF" name="AsignacionTestDeportistaF">
                       <!-- <br>
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
                        </div>-->
                    </form>
                </div>
            </div>
            @else
                <div class="panel-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                          <h3 class="panel-title">Datos del entrenador</h3>
                        </div>
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>No se encuentra registrado como un entrenador!, revise el usuario de Inicio de Sesión</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif            
        </div>
    </div>    
@stop