@extends('master')
@section('script')
    @parent
    <script>
        function Buscar(e){
            $("#loading").show('slow');
            var key = $('input[name="buscador"]').val();
            var url = $('#main').data('url');

            $.get(url+'/buscarDeportista/'+key,{}, function(data){
                if(data.length == 0){
                    $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
                    $('#buscar span').empty();
                    document.getElementById("buscar").disabled = false;
                    $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">No se encuentra ninguna persona registrada con estos datos.</h4></dvi><br>');
                    $('#paginador').fadeOut();
                    $("#loading").hide('slow');

                } else if(data.length == 1) {
                    VerPersona(data[0].Id_Persona);
                } else if(data.length > 1) {
                    $("#tablaPersonas").empty();
                    var html = '';
                    html += '<table id="tablaPersonasDatos" class="display nowrap" cellspacing="0" width="100%" style="text-transform: uppercase;">' +
                        '<thead>'+
                            '<th>Nombre</th>'+
                        '</thead>'+
                        '<tbody>';
                        $.each(data, function(i, e){
                            html += '<tr>'+
                                        '<td><a href="'+url+'/irrd/'+e.deportista['Id']+'">'+e.Primer_Nombre+' '+e.Segundo_Nombre+' '+e.Primer_Apellido+' '+e.Segundo_Apellido+'</a></td>' +
                                    '</tr>';
                    });
                    html += '</tbody>'+
                        '</table>';

                    $("#tablaPersonas").append(html);
                    $('#tablaPersonasDatos').DataTable({
                        retrieve: true,
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        dom: 'Bfrtip',
                        select: true,
                        "responsive": true,
                        "ordering": true,
                        "info": true,
                        "pageLength": 8,
                        "language": {
                            url: 'public/DataTables/Spanish.json',
                            searchPlaceholder: "Buscar"
                        }
                    });
                }
            }).done(function()
                {
                $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
                $('#buscar span').empty();
                document.getElementById("buscar").disabled = false;
                $("#tablaPersonas").show('slow');
                $("#loading").hide('slow');
            });
        }
    </script>
    <script src="{{ asset('public/Js/buscar_personas.js') }}"></script>
@stop
@section('content')
    <div id="main" class="row" data-url="{{ url('/') }}">
        <div class="col-md-12">
            <h3>INGRESO, RETIRO Y REINGRESO DE DEPORTISTAS</h3>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token"/>
        </div>
        <div class="col-md-12">
            <h4>Ingrese el número de cédula o nombres de la persona o deportista que va a registrar</h4>
            <div class="row">
                <div id="alerta" class="col-xs-12" style="display:none;">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Datos actualizados satisfactoriamente.
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="input-group">
                        <input id="buscador" name="buscador" type="text" class="form-control" placeholder="Buscar" value="" onkeypress="return ValidaCampo(event);">
                        <span class="input-group-btn">
                        <button id="buscar" data-role="buscar" data-buscador="buscar-rud" class="btn btn-default" type="button">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </button>
                    </span>
                    </div>
                    <div tabindex="-1" id="mensaje-incorrectoB" class=" text-left alert alert-success alert-danger" role="alert" style="display: none; margin-top: 10px;">
                        <strong>Error </strong> <span id="mensajeIncorrectoB"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <br>
        </div>
        <div id="tablaPersonas" class="col-md-12">
        </div>
        @if ($deportista)
            <div class="col-md-12">
                <hr>
            </div>
            <form action="{{ url('/irrd/guardar') }}" method="post">
                <div class="col-md-12 form-grup {{$errors->has('id_deportista') ? 'has-error' : '' }}">
                    <label for="">Deportista</label>
                    <p class="form-control-static">{{ $deportista->toString() }}</p>
                </div>
                <div class="col-md-4 form-group {{$errors->has('tipo') ? 'has-error' : '' }}">
                    <label for="">Generar</label>
                    <select class="form-control" name="tipo" id="tipo" title="Seleccionar">
                        <option value="">Seleccionar</option>
                        <option value="Ingreso">Ingreso</option>
                        <option value="Re ingreso">Re ingreso</option>
                        <option value="Retiro">Retiro</option>
                    </select>
                </div>
                <div class="col-md-4 form-group {{$errors->has('fecha') ? 'has-error' : '' }}">
                    <label for="">Fecha</label>
                    <input type="text" class="form-control" name="fecha" data-role="datepicker">
                </div>
                <div class="col-md-4">
                    <label for="">&nbsp;</label><br>
                    <button class="btn btn-primary">Guardar</button>
                    <input type="hidden" name="id_deportista" value="{{ $deportista['Id'] }}">
                    <input type="hidden" name="_method" value="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token"/>
                </div>
            </form>
            <div class="col-md-12">
                <br>
            </div>
            <div class="col-md-12">
                <table class="table default">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th width="100px">Fecha</th>
                            <th width="30px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deportista->ingresos as $ingreso)
                            <tr>
                                <td>
                                    {{ $ingreso->Tipo }}
                                </td>
                                <td>
                                    {{ $ingreso->Fecha }}
                                </td>
                                <td>
                                    <a href="{{ url('irrd/'.$ingreso->Id.'/borrar') }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@stop