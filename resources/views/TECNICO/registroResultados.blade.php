@extends('master')
@section('script')
  @parent
    <script src="{{ asset('public/Js/buscar_personas.js') }}"></script>     
    <script src="{{ asset('public/Js/Tecnico/registroResultados.js') }}"></script>
@stop  
@section('content')
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>MIS PRUEBAS ASIGNADAS</h3></center>
<input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
<input type="hidden" name="persona" value="{{$Usuario[0]}}" id="persona"/>
<input type="hidden" name="certamenDivisionInput" value="" id="certamenDivisionInput"/>
<div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
    <form id="RegistroResultadoF" name="RegistroResultadoF">  
    <div class="content">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">MIS PRUEBAS ASIGNADAS</h3>                
            </div>
            <div class="panel-body">    
                <br>
                <div class="row">
                    <div class="form-group col-md-12">
                        <h4>1. Seleccione clasificación, evento y certamen:</h4>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEmail" class="control-label">Clasificación</label>
                    </div>
                    <div class="form-group col-md-10">
                        <select name="Clasificacion_Id" id="Clasificacion_Id" class="form-control">                                                                                             
                            <option value=''>Seleccione</option>
                            @foreach($ClasificacionDeportista as $ClasificacionDeportistas)
                                <option value="{{ $ClasificacionDeportistas['Id'] }}">{{ $ClasificacionDeportistas['Nombre_Clasificacion_Deportista'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEmail" class="control-label">Evento</label>
                    </div>
                    <div class="form-group col-md-4">
                        <select name="Evento_Id" id="Evento_Id" class="selectpicker form-control" data-live-search="true">                                                                                             
                            <option>Seleccione</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEmail" class="control-label">Certamen</label>
                    </div>
                    <div class="form-group col-md-4">
                        <select name="Certamen_Id" id="Certamen_Id" class="selectpicker form-control" data-live-search="true">                                                                                             
                            <option>Seleccione</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group"  id="mensaje" style="display: none;">
                    <div id="alert"></div>
                </div>                         
                <br>
                <div class="row" id="Paso3" style="display:none;">
                    <div class="form-group col-md-12">
                        <h4>2. Pruebas deportivas asignadas.</h4>
                    </div>
                    <table id="resultadosTabla" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>                            
                            <th><center>DEPORTE</center></th>
                            <th><center>PRUEBA DEPORTIVA</center></th>
                            <th><center>OPCIÓN</center></th>
                        </tr>
                    </thead>
                    <tbody>                     
                    </tbody> 
                </table>    
                <br><br><br><br>
                </div>
            </div>
        </div>
    </div>
    <!-- ---------------------------EVENTO DATOS--------------------------- -->
    <div class="modal fade bs-example-modal-lg" id="RegistroResultadosD" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="TituloE">Registro de resultados</h4>
                 </div>
                 <div class="row">                                          
                    <div class="panel-body">
                        <!-- -----------------------ORO --------------------------- -->
                        <div class="form-group col-md-3 panel panel-primary">
                            <h4>ORO</h4>
                            <div id="ResultadoOroD" style="display:none;">      
                                <input type="hidden" id="CertamenDivisionResultadoIOro" name="CertamenDivisionResultadoIOro" />
                                <h5>Nombre: </h5><label style="text-transform: uppercase;"  id="NombreOro"></label>
                                <br> 
                                <h5>Ciudad: </h5><label style="text-transform: uppercase;"  id="CiudadOro"></label>                       
                                <br> 
                                <h5>Marca: </h5><label style="text-transform: uppercase;"  id="MarcaOro"></label>   
                                <br>
                                <button type="button" class="btn btn-danger" onclick="Eliminar(1)">Eliminar</button>                    
                            </div>
                            <div id="RegistroOroD" style="display:none;">                                
                                <select name="OroCiudad" id="OroCiudad" class="selectpicker form-control" data-live-search="true">                                                                                             
                                    <option value =''>Seleccione</option>
                                    <option value='33'>Bogotá D.C</option>
                                        @foreach($Ciudad as $Oro)
                                            <option value="{{ $Oro['Id_Departamento'] }}">{{ $Oro['Nombre_Departamento'] }}</option>
                                        @endforeach
                                    <option value='34'>Fuerzas militares</option>
                                    <option value='35'>Internacional</option>
                                </select>                            
                                <div id="OroD" style="display:none;">
                                    <br><br>                            
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">Deportista</label>
                                    </div>
                                    <div class="form-group col-md-12" >
                                        <select name="OroDeportista" id="OroDeportista" class="selectpicker form-control" data-live-search="true">
                                            <option value =''>Seleccione</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">Marca</label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="text" style="text-transform: uppercase;" class="form-control" style="text-transform: uppercase;" placeholder="Marca" name="OroMarca" id="OroMarca">
                                    </div>
                                    <br>
                                    <button type="button" class="btn btn-primary" id="AgregarOroD">Agregar</button>
                                </div>
                            </div>
                            <!-- -------------------------------------------------- -->
                            <div id="OroN" style="display:none;">
                                <br><br>                            
                                <div class="form-group col-md-12">
                                    <label for="inputEmail" class="control-label">Deportista</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" style="text-transform: uppercase;" class="form-control" style="text-transform: uppercase;" placeholder="Deportista" name="OroDeportistaN" id="OroDeportistaN">
                                </div>
                                <br>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail" class="control-label">Marca</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" style="text-transform: uppercase;" class="form-control" style="text-transform: uppercase;" placeholder="Marca" name="OroMarcaN" id="OroMarcaN">
                                </div>
                                <br>
                                <button type="button" class="btn btn-primary" id="AgregarOroN">Agregar</button>
                            </div>
                            <br><br>
                        </div>
                        <!-- -----------------------FIN ORO --------------------------- -->

                        <!-- -----------------------PLATA --------------------------- -->
                        <div class="form-group col-md-3 panel panel-primary">
                            <h4>PLATA</h4>
                            <div id="ResultadoPlataD" style="display:none;">               
                                <input type="hidden" id="CertamenDivisionResultadoIPlata" name="CertamenDivisionResultadoIPlata" />                 
                                <h5>Nombre: </h5><label style="text-transform: uppercase;"  id="NombrePlata"></label>
                                <br> 
                                <h5>Ciudad: </h5><label style="text-transform: uppercase;"  id="CiudadPlata"></label>                       
                                <br> 
                                <h5>Marca: </h5><label style="text-transform: uppercase;"  id="MarcaPlata"></label>      
                                <br>
                                <button type="button" class="btn btn-danger" onclick="Eliminar(2)">Eliminar</button>                                     
                            </div>
                            <div id="RegistroPlataD" style="display:none;">                                
                                <select name="PlataCiudad" id="PlataCiudad" class="selectpicker form-control" data-live-search="true">                                                                                             
                                    <option value =''>Seleccione</option>
                                    <option value='33'>Bogotá D.C</option>
                                        @foreach($Ciudad as $Plata)
                                            <option value="{{ $Plata['Id_Departamento'] }}">{{ $Plata['Nombre_Departamento'] }}</option>
                                        @endforeach
                                    <option value='34'>Fuerzas militares</option>
                                    <option value='35'>Internacional</option>
                                </select>
                            </div>
                            <div id="PlataD" style="display:none;">
                                <br><br>                            
                                <div class="form-group col-md-12">
                                    <label for="inputEmail" class="control-label">Deportista</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <select name="PlataDeportista" id="PlataDeportista" class="selectpicker form-control" data-live-search="true">
                                        <option value =''>Seleccione</option>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail" class="control-label">Marca</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" style="text-transform: uppercase;" class="form-control" style="text-transform: uppercase;" placeholder="Marca" name="PlataMarca" id="PlataMarca">
                                </div>
                                <br>
                                <button type="button" class="btn btn-primary" id="AgregarPlataD">Agregar</button>
                            </div>
                            <!-- -------------------------------------------------- -->
                            <div id="PlataN" style="display:none;">
                                <br><br>                            
                                <div class="form-group col-md-12">
                                    <label for="inputEmail" class="control-label">Deportista</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" style="text-transform: uppercase;" class="form-control" style="text-transform: uppercase;" placeholder="Deportista" name="PlataDeportistaN" id="PlataDeportistaN">
                                </div>
                                <br>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail" class="control-label">Marca</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" style="text-transform: uppercase;" class="form-control" style="text-transform: uppercase;" placeholder="Marca" name="PlataMarcaN" id="PlataMarcaN">
                                </div>
                                <br>
                                <button type="button" class="btn btn-primary" id="AgregarPlataN">Agregar</button>
                            </div>
                            <br><br>
                        </div>
                        <!-- -----------------------FIN PLATA --------------------------- -->

                        <!-- -----------------------BRONCE --------------------------- -->
                        <div class="form-group col-md-3 panel panel-primary">
                            <h4>BRONCE</h4>
                            <div id="ResultadoBronceD" style="display:none;">                                
                                <input type="hidden" id="CertamenDivisionResultadoIBronce" name="CertamenDivisionResultadoIBronce" />
                                <h5>Nombre: </h5><label style="text-transform: uppercase;"  id="NombreBronce"></label>
                                <br> 
                                <h5>Ciudad: </h5><label style="text-transform: uppercase;"  id="CiudadBronce"></label>                       
                                <br> 
                                <h5>Marca: </h5><label style="text-transform: uppercase;"  id="MarcaBronce"></label>       
                                <br>
                                <button type="button" class="btn btn-danger" onclick="Eliminar(3)">Eliminar</button>                                    
                            </div>
                            <div id="RegistroBronceD" style="display:none;">                                
                                <select name="BronceCiudad" id="BronceCiudad" class="selectpicker form-control" data-live-search="true">                                                                                             
                                    <option value =''>Seleccione</option>
                                    <option value='33'>Bogotá D.C</option>
                                        @foreach($Ciudad as $Bronce)
                                            <option value="{{ $Bronce['Id_Departamento'] }}">{{ $Bronce['Nombre_Departamento'] }}</option>
                                        @endforeach
                                    <option value='34'>Fuerzas militares</option>
                                    <option value='35'>Internacional</option>
                                </select>
                            </div>
                            <div id="BronceD" style="display:none;">
                                <br><br>                            
                                <div class="form-group col-md-12">
                                    <label for="inputEmail" class="control-label">Deportista</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <select name="BronceDeportista" id="BronceDeportista" class="selectpicker form-control" data-live-search="true">
                                        <option value =''>Seleccione</option>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail" class="control-label">Marca</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" style="text-transform: uppercase;" class="form-control" style="text-transform: uppercase;" placeholder="Marca" name="BronceMarca" id="BronceMarca">
                                </div>
                                <br>
                                <button type="button" class="btn btn-primary" id="AgregarBronceD">Agregar</button>
                            </div>
                            <!-- -------------------------------------------------- -->
                            <div id="BronceN" style="display:none;">
                                <br><br>                            
                                <div class="form-group col-md-12">
                                    <label for="inputEmail" class="control-label">Deportista</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" style="text-transform: uppercase;" class="form-control" style="text-transform: uppercase;" placeholder="Deportista" name="BronceDeportistaN" id="BronceDeportistaN">
                                </div>
                                <br>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail" class="control-label">Marca</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" style="text-transform: uppercase;" class="form-control" style="text-transform: uppercase;" placeholder="Marca" name="BronceMarcaN" id="BronceMarcaN">
                                </div>
                                <br>
                                <button type="button" class="btn btn-primary" id="AgregarBronceN">Agregar</button>
                            </div>                            
                            <br><br>
                        </div>
                        <!-- -----------------------FIN BRONCE --------------------------- -->    

                        <!-- -----------------------MAS 3 --------------------------- -->
                        <div class="form-group col-md-3 panel panel-primary">
                            <h4>MAYOR AL TERCERO</h4>
                            <div id="ResultadoTresD" style="display:none;">      
                                <input type="hidden" id="CertamenDivisionResultadoITres" name="CertamenDivisionResultadoITres" />
                                <h5>Nombre: </h5><label style="text-transform: uppercase;"  id="NombreTres"></label>
                                <br> 
                                <h5>Ciudad: </h5><label style="text-transform: uppercase;"  id="CiudadTres"></label>                       
                                <br> 
                                <h5>Marca: </h5><label style="text-transform: uppercase;"  id="MarcaTres"></label>   
                                <br>
                                <h5>Puesto: </h5><label style="text-transform: uppercase;"  id="PuestoTres"></label>   
                                <br>
                                <button type="button" class="btn btn-danger" onclick="Eliminar(4)">Eliminar</button>                    
                            </div>
                            <div id="RegistroTresD" style="display:none;">                                
                                <select name="TresCiudad" id="TresCiudad" class="selectpicker form-control" data-live-search="true">                                                                                             
                                    <option value =''>Seleccione</option>
                                    <option value='33'>Bogotá D.C</option>
                                </select>                
                                <div id="TresD" style="display:none;">
                                    <br><br>                            
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">Deportista</label>
                                    </div>
                                    <div class="form-group col-md-12" >
                                        <select name="TresDeportista" id="TresDeportista" class="selectpicker form-control" data-live-search="true">
                                            <option value =''>Seleccione</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">Marca</label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="text" style="text-transform: uppercase;" class="form-control" style="text-transform: uppercase;" placeholder="Marca" name="TresMarca" id="TresMarca">
                                    </div>
                                    <br>
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">Puesto</label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="text" style="text-transform: uppercase;" class="form-control" placeholder="Puesto" name="TresPuesto" id="TresPuesto">
                                    </div>
                                    <br>
                                    <button type="button" class="btn btn-primary" id="AgregarTresD">Agregar</button>
                                </div>
                            </div>
                            <!-- -------------------------------------------------- -->
                            <div id="TresN" style="display:none;">
                                <br><br>                            
                                <div class="form-group col-md-12">
                                    <label for="inputEmail" class="control-label">Deportista</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" style="text-transform: uppercase;" class="form-control" style="text-transform: uppercase;" placeholder="Deportista" name="TresDeportistaN" id="TresDeportistaN">
                                </div>
                                <br>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail" class="control-label">Marca</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" style="text-transform: uppercase;" class="form-control" style="text-transform: uppercase;" placeholder="Marca" name="TresMarcaN" id="TresMarcaN">
                                </div>
                                <br>
                                <div class="form-group col-md-12">
                                        <label for="inputEmail" class="control-label">Puesto</label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="text" style="text-transform: uppercase;" class="form-control" placeholder="Puesto" name="TresPuestoN" id="TresPuestoN">
                                    </div>
                                    <br>
                                <button type="button" class="btn btn-primary" id="AgregarTresN">Agregar</button>
                            </div>
                            <br><br>
                        </div>
                        <!-- -----------------------MAS 3 --------------------------- -->                    
                    </div>
                 </div>
                 <div class="row">
                    <div class="form-group panel-body"  id="mensaje_registro">
                        <div id="alert_registro"></div>
                    </div>
                </div>
            </div>             
        </div>
    </div>
</form>
</div>        
@stop
