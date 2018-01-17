@extends('master')

@section('script')
    @parent
    <script src="{{ asset('public/Js/REPORTES/totalEntrenador.js') }}"></script> 
    <!--<script src="{{ asset('public/Js/bootstrap-datepicker.js') }}"></script>   
    {{Html::style('public/Css/bootstrap-datepicker3.css')}}   -->

    @stop

@section('content')
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>REPORTE DEL TOTAL DE LOS ENTRENADORES</h3></center>
<br>
<div class="container" id="loading" style="display:none;">
    <center><button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button></center>
</div>
<input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
<div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
    <div class="content">   
        <div class="panel-body">
            <div id="TablaDatos"></div>
        </div>
    </div>
</div>    
@stop