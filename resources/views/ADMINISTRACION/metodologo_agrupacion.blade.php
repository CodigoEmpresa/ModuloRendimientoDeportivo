@extends('master')
@section('script')
  @parent
    <!--<script src="{{ asset('public/Js/buscar_personas.js') }}"></script>     -->
    <script src="{{ asset('public/Js/ADMINISTRACION/metodologo_agrupacion.js') }}"></script>
    <script src="{{ asset('public/Js/bootstrap-datepicker.js') }}"></script>   
    {{Html::style('public/Css/bootstrap-datepicker3.css')}}      
@stop  
@section('content')
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>ADMINISTRACIÓN DE METODÓLOGOS</h3></center>
 <input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
    <div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
        <form id="MetodologoAgrupacionF" name="MetodologoAgrupacionF">  
            <div class="content">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title">Metodólogo - Agrupación</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-md-2">
                            <label for="inputEmail" class="control-label">Metodólogos</label>
                        </div>
                        <div class="form-group col-md-12">
                            <select name="Metodologo_Id" id="Metodologo_Id" class="selectpicker form-control" data-live-search="true">
                                <option value="">Seleccionar</option>                               
                                @foreach($Metodologos as $Metodologo)
                                    <option value="{{ $Metodologo['Id_Persona'] }}">{{ strtoupper($Metodologo['Primer_Nombre']." ".$Metodologo['Segundo_Nombre']." ".$Metodologo['Primer_Apellido']." ".$Metodologo['Segundo_Apellido']) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="container" id="loading" style="display:none;">
                        <center><button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button></center>
                    </div>
                    <div class="form-group"  id="mensaje" style="display: none;">
                        <div id="alert"></div>
                    </div>
                    <div class="panel-body" id="AgrupacionesSeleccion" style="display:none;">
                        <div class="form-group col-md-12">
                            <label for="inputEmail" class="control-label">Agrupación</label>
                        </div>
                        <div class="form-group col-md-8">
                            <select name="Agrupacion_Id" id="Agrupacion_Id" class="selectpicker form-control" data-live-search="true">
                                <option value="">Seleccionar</option>                                                           
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <button type="button" class="btn btn-primary" id="AgregarAgrupacion">Agregar Agrupación</button>
                        </div>
                    </div>
                    <div class="panel-body" id="AgrupacionesAsignadas" style="display:none;">
                        <div class="form-group col-md-12">
                            <h4>Agrupaciones asignadas</h4>
                        </div>
                        <div class="form-group col-md-12">
                            <table id="metodologoAgrupacionTabla" name="metodologoAgrupacionTabla" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><center>CLASIFICACIÓN DEPORTIVA</center></th>
                                        <th><center>AGRUPACIÓN</center></th>
                                        <th><center>OPCIÓN</center></th>
                                    </tr>
                                </thead>
                                <tbody>                                         
                                </tbody> 
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<!-- ------------------------------------------------------------------------------------ -->
@stop