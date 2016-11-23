@extends('master')

@section('script')
    @parent
    <script src="{{ asset('public/Js/Tecnico/certamen.js') }}"></script> 
    <script src="{{ asset('public/Js/bootstrap-datepicker.js') }}"></script>   
    {{Html::style('public/Css/bootstrap-datepicker3.css')}}   

    @stop

@section('content')
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>GESTOR DE CERTÁMENES DEPORTIVOS</h3></center>
 <input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
    <div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
        <div class="content">
            <div align="right">
                <button type="button" class="btn btn-success" name="Enviar" id="Crear_Nuevo">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Crear certamen nuevo
                </button>
            </div>
            <br><br>            
            <div class="panel-body">
                <table id="certamenesTabla" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>CERTAMEN</th>
                            <th>FECHA INICIO</th>
                            <th>FECHA FINZALIZACIÓN</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($Certamen as $Certamen)
                        <tr>
                            <td>{{ $Certamen['Nombre_Certamen']}}</td>
                            <td>{{ $Certamen['Fecha_Inicio'] }}</td>
                            <td>{{ $Certamen['Fecha_Fin'] }}</td>
                            <td>
                                <center>
                                    <button type="button" class="btn btn-info ver VerCertamen" value="{{$Certamen['Id']}}" name="VerCertamen" id="VerCertamen" >
                                        <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>Ver Certamen
                                    </button>
                                </center>
                            </td>
                        </tr>
                    @endforeach                    
                    </tbody> 
                </table>
                <div class="container" id="loading" style="display:none;">
                    <center><button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button></center>
                </div>
                <!-- ---------------------------AGREGAR CERTAMEN--------------------------- -->
                <div class="modal fade bs-example-modal-lg" id="creaCertamenD" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Crear Nuevo Certamen</h4>
                             </div>
                            <form id="creaCertamenF" name="creaCertamenF">  
                            <input class="form-control" type="hidden" name="Id_Certamen" id="Id_Certamen">     
                                <br><br>
                                <div class="content">
                                    <!-- ---------------------------PASO 1--------------------------- -->
                                    <div class="panel">                                               
                                        <ul class="list-group" id="seccion_uno" name="seccion_uno">
                                           <li class="list-group-item">
                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label">Evento deportivo</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input class="form-control" type="hidden" name="Nombre_Certamen" id="Nombre_Certamen">     
                                                        <select name="Evento_Id" id="Evento_Id" class="form-control">
                                                            <option value="">Seleccionar</option>   
                                                            @foreach($Evento as $Eventos)
                                                                <option value="{{ $Eventos['Id'] }}">{{ $Eventos['Nombre_Evento'] }}</option>
                                                            @endforeach   
                                                                                                            
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label">Sede</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="Sede_Id" id="Sede_Id" class="form-control">
                                                            <option value="">Seleccionar</option>                                                                                                        
                                                        </select>
                                                    </div>
                                                   <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label">Fecha de inicio</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="input-group date form-control" id="FechaInicioDate" style="border: none;">
                                                            <input id="FechaInicio" class="form-control " type="text" value="" name="FechaInicio" default="" data-date="" data-behavior="FechaInicio">
                                                        <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                                        </div>    
                                                    </div> 

                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label">Fecha de finalización</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="input-group date form-control" id="FechaFinDate" style="border: none;">
                                                            <input id="FechaFin" class="form-control " type="text" value="" name="FechaFin" default="" data-date="" data-behavior="FechaFin">
                                                        <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                                        </div>    
                                                    </div> 

                                                    <div class="form-group col-md-12">
                                                        <center>
                                                            <button type="button" class="btn btn-success ver" value="" name="Agregar" id="Agregar" >Agregar certamen</button>
                                                            <!--<button type="button" class="btn btn-info ver" value="" name="Modificar" id="Modificar" style="display:none;">Modificar certamen</button>-->
                                                        </center>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>   
                                        <div class="form-group"  id="mensaje_certamen" style="display: none;">
                                            <div id="alert_certamen"></div>
                                        </div>                         
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ---------------------------EVENTO DATOS--------------------------- -->
                <div class="modal fade bs-example-modal-lg" id="verCertamenD" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="TituloE"></h4>
                             </div>
                            <ul class="nav nav-tabs">
                              <li role="presentation" id="InicioCertamenLi" class="active"><a id="InicioCertamen">Datos</a></li>
                              <li role="presentation" id="PruebasCertamenLi" ><a id="PruebasCertamen" >Pruebas</a></li>
                              <li role="presentation" id="DeportistasCertamenLi" ><a id="DeportistasCertamen" >Deportistas</a></li>
                            </ul>
                            <form id="EditCertamenF" name="EditCertamenF">  
                            <input class="form-control" type="text" value="" name="Id_CertamenE" id="Id_CertamenE">     
                                <br><br>
                                <div class="content">
                                    <div style="text-align:center;"> 
                                        <h3><span id="TituloCertamen"></span></h3>                           
                                    </div>
                                    <!-- ---------------------------PASO 2--------------------------- -->
                                    <div class="panel">                                               
                                        <ul class="list-group" id="seccion_uno" name="seccion_uno">
                                           <li class="list-group-item">
                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label">Evento deportivo</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input class="form-control" type="hidden" name="Nombre_CertamenE" id="Nombre_CertamenE"> 
                                                        <select name="Evento" id="Evento" class="form-control">
                                                            <option value="">Seleccionar</option>   
                                                            @foreach($Evento as $Eventos)
                                                                <option value="{{ $Eventos['Id'] }}">{{ $Eventos['Nombre_Evento'] }}</option>
                                                            @endforeach   
                                                                                                            
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label">Sede</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="Sede" id="Sede" class="form-control">
                                                            <option value="">Seleccionar</option>                                                                                                        
                                                        </select>
                                                    </div>
                                                   <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label">Fecha de inicio</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="input-group date form-control" id="FechaInicioDateM" style="border: none;">
                                                            <input id="FechaInicioM" class="form-control " type="text" value="" name="FechaInicioM" default="" data-date="" data-behavior="FechaInicioM">
                                                        <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                                        </div>    
                                                    </div> 

                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail" class="control-label">Fecha de finalización</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="input-group date form-control" id="FechaFinDateM" style="border: none;">
                                                            <input id="FechaFinM" class="form-control " type="text" value="" name="FechaFinM" default="" data-date="" data-behavior="FechaFinM">
                                                        <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                                        </div>    
                                                    </div> 

                                                    <div class="form-group col-md-12">
                                                        <center>
                                                            <button type="button" class="btn btn-success ver" value="" name="Agregar" id="Agregar" style="display:none;" >Agregar certamen</button>
                                                            <button type="button" class="btn btn-info ver" value="" name="Modificar" id="Modificar">Modificar certamen</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>                            
                                    </div>
                                </div>
                            </form>   
                            <div class="form-group"  id="mensaje_certamenE" style="display: none;">
                                <div id="alert_certamenE"></div>
                            </div>
                        </div>             
                    </div>
                </div>
            </div>
        </div>
    </div>    
@stop