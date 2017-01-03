@extends('master')
@section('script')
  @parent
    <script src="{{ asset('public/Js/buscar_personas.js') }}"></script>     
    <script src="{{ asset('public/Js/Tecnico/denegarPruebas.js') }}"></script>
@stop  
@section('content')
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>DENEGACIÓN DE PRUEBAS DEPORTIVAS</h3></center>
<input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
<div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
    <div class="content">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">DENEGACIÓN DE PRUEBAS DEPORTIVAS</h3>                
            </div>
            <div class="panel-body">                
                <div class="row">
                    <div class="form-group col-md-12">
                        <h4>1. Seleccione al metodologo al cual le va a denegar permisos de ingreso de resultados:</h4>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEmail" class="control-label">Metdologo</label>
                    </div>
                    <div class="form-group col-md-4">
                        <select name="Metodologo_Id" id="Metodologo_Id" class="selectpicker form-control" data-live-search="true">
                            <option value="">Seleccionar</option>     
                            @foreach($Personas as $Personasx)
                                <option value="{{ $Personasx['Id_Persona'] }}">{{ $Personasx['Primer_Nombre'] }} {{ $Personasx['Segundo_Nombre'] }} {{ $Personasx['Primer_Apellido'] }} {{ $Personasx['Segundo_Apellido'] }}</option>
                            @endforeach                                                                                                
                        </select>
                    </div>
                </div>
                <br>
                <div class="row" id="Paso2" style="display:none">
                    <div class="form-group col-md-12">
                        <h4>2. Seleccione evento y deporte para mostrar las pruebas deportivas:</h4>
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
                <div class="row" id="Paso3" style="display:none">
                    <div class="form-group col-md-12">
                        <h4>3. Selecione pruebas deportivas.</h4>
                    </div>
                    <table id="pruebasTabla" class="display nowrap" cellspacing="0" width="100%">
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
</div>        
@stop