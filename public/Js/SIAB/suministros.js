$(function(e){
  TablaComplementos();
  TablaAlimentacion();
  TablaApoyos();

  $("#SuministrosComplementos").on('click', function(){
    $("#SuministrosComplementosF").show('slow');
    $("#SuministrosAlimentacionF").hide('slow');
    $("#ApoyoServiciosF").hide('slow');
    LLenarTablaComplemento($("#deportista1").val());
    $("#Agregar_ComplementoD").hide('slow');
    
  });

  $("#SuministrosAlimentos").on('click', function(){
    $("#SuministrosComplementosF").hide('slow');
    $("#SuministrosAlimentacionF").show('slow');
    $("#ApoyoServiciosF").hide('slow');
    LLenarTablaAlimentacion($("#deportista2").val());
  });

  $("#ApoyoServicios").on('click', function(){
    $("#SuministrosComplementosF").hide('slow');
    $("#SuministrosAlimentacionF").hide('slow');
    $("#ApoyoServiciosF").show('slow');
    LLenarTablaApoyos($("#deportista3").val());
    $("#Agregar_ApoyoD").hide('slow');
  });

  function LLenarTablaComplemento(id){
    $.get("ListaComplemento/" + id+ "", function (respListaComplemento){
      $("#ListaComplemento").empty();      
      $.each(respListaComplemento.deportista_complemento, function(i, e){
        $("#ListaComplemento").append('<tr><td>'+e['Nombre_Complemento']+'</td><td><center>'+e.pivot['Cantidad']+'</center></td><td><center>'+e.pivot['Valor']+'</center></td><td><center>'+(e.pivot['Cantidad'])*(e.pivot['Valor'])+'</center></td><td><center>'+e.pivot['Fecha']+'</center></td></tr>');
      });
    });
  }

  function LLenarTablaApoyos(id){
    $.get("ListaApoyos/" + id+ "", function (respListaApoyos){
      $("#ListaApoyos").empty();      
      $.each(respListaApoyos.deportista_apoyo, function(i, e){
        $("#ListaApoyos").append('<tr><td>'+e['Nombre_Apoyo']+'</td><td><center>'+e.pivot['Valor']+'</center></td><td><center>'+e.pivot['Fecha']+'</center></td></tr>');
      });
    });
  }

  function LLenarTablaAlimentacion(id){
    $.get("ListaAlimentacion/" + id+ "", function (respListaAlimentacion){
      $("#ListaAlimentacion").empty();      
      $.each(respListaAlimentacion.deportista_alimentacion, function(i, e){
        $("#ListaAlimentacion").append('<tr><td>'+e.tipo_alimentacion['Nombre_Tipo_Alimentacion']+'</td><td>'+e['Nombre_Alimentacion']+'</td><td><center>'+(e.pivot['Cantidad'])+'</center></td><td><center>$ '+(e.pivot['Valor'])+'</center></td><td><center>$ '+(e.pivot['Cantidad'])*(e.pivot['Valor'])+'</center></td><td><center>'+e.pivot['Fecha']+'</center></td></tr>');
      });
    });
  }

  function TablaComplementos() {
    $('#TablaComplementos').DataTable({
        retrieve: true, 
        select: true,
        "responsive": true,
        "ordering": true,
        "info": true,
        "language": {
            url: 'public/DataTables/Spanish.json',
            searchPlaceholder: "Buscar"
        }
    });
  }

  function TablaAlimentacion() {
    $('#TablaAlimentacion').DataTable({
        retrieve: true,
        select: true,
        "responsive": true,
        "ordering": true,
        "info": true,
        "language": {
            url: 'public/DataTables/Spanish.json',
            searchPlaceholder: "Buscar"
        }
    });
  }  

  function TablaApoyos() {
    $('#TablaApoyos').DataTable({
        retrieve: true,
        select: true,
        "responsive": true,
        "ordering": true,
        "info": true,
        "language": {
            url: 'public/DataTables/Spanish.json',
            searchPlaceholder: "Buscar"
        }
    });
  }  

  $("#RegistrarComplemento").on('click', function(){
    var formData = new FormData($("#SuministrosComplementosF")[0]);
    registro('AddComplemento', formData, 'SuministrosComplementosF');
  });

  $("#RegistrarApoyo").on('click', function(){
    var formData = new FormData($("#ApoyoServiciosF")[0]);
    registro('AddApoyo', formData, 'ApoyoServiciosF');
  });

  $("#RegistrarAlimentacion").on('click', function(){
    var formData = new FormData($("#SuministrosAlimentacionF")[0]);
    registro('AddAlimentacion', formData, 'SuministrosAlimentacionF');
  });


  function registro (url, datos, formulario){     
    var formData = datos;
    var token = $("#token").val();    
     $.ajax({
        type: 'POST',
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        data: formData,
        beforeSend: function(){
        }, 
        success: function (xhr) {    
          if(xhr.status == 'error'){
            validador_errores(xhr.errors, formulario);
            return false;
          }
          else 
          {            
            if(url == 'AddComplemento'){
              $('#alert_complemento').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#mensaje_complemento').show(60);
              $('#mensaje_complemento').delay(2000).hide(600);    
              LLenarTablaComplemento($("#deportista1").val());  
              $("#Agregar_ComplementoD").hide('slow');
              $("#TipoComplemento").val('').change();
              $("#Complemento").val('');
              $("#Cantidad").val('');
              $("#FechaComplemento").val('');
            }
            if(url == 'AddApoyo'){
              $('#alert_apoyo').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#mensaje_apoyo').show(60);
              $('#mensaje_apoyo').delay(2000).hide(600);    
              LLenarTablaApoyos($("#deportista3").val());  
              $("#Agregar_ApoyoD").hide('slow');
              $("#TipoApoyo").val('').change();
              $("#ValorApoyo").val('');
              $("#FechaApoyo").val('');
            }

            if(url == 'AddAlimentacion'){
              $('#alert_alimentacion').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#mensaje_alimentacion').show(60);
              $('#mensaje_alimentacion').delay(2000).hide(600);    
              LLenarTablaAlimentacion($("#deportista2").val());  
              $("#Agregar_AlimentacionD").hide('slow');
              $("#TipoAlimentacion").val('').change();
              $("#Alimentacion").val('');
              $("#ValorAlimentacion").val('');
              $("#CantidadAlimentacion").val('');
              $("#FechaAlimentacion").val('');
            }
          }              
        },
        error: function (xhr){
          validador_errores(xhr.responseJSON, formulario);
        }
    });
  }

  var validador_errores = function(data, formulario){
    $('#'+formulario+' .form-group').removeClass('has-error');

    $.each(data, function(i, e){
      $("#"+i).closest('.form-group').addClass('has-error');
    });
  }

  $("#TipoComplemento").on('change', function(){
    $("#Complemento").empty();
    $("#Complemento").append("<option value=''>Seleccionar</option>");
    if($("#TipoComplemento").val() != ''){
      $.get("complemento/" + $("#TipoComplemento").val() + "", function (respComplemento){
        $.each(respComplemento.complemento, function(i, e){
            $("#Complemento").append("<option value='" +e.Id + "'>" + e.Nombre_Complemento + "</option>");
          }); 
      });
    }
  });

   $("#Complemento").on('change', function(e){
    $.get("ValorComplemento/" + $("#Complemento").val() + "", function (respValorComplemento){
          $("#ValorComplemento").val(respValorComplemento['Valor_Complemento']);
          if($("#Complemento").val() == 25){
            $("#PrecioOtroD").show('slow');
          }else{
            $("#PrecioOtroD").hide('slow');
          }
    });
  });

  $("#TipoAlimentacion").on('change', function(){
    $("#Alimentacion").empty();
    $("#Alimentacion").append("<option value=''>Seleccionar</option>");
    if($("#TipoAlimentacion").val() != ''){
      $.get("alimentacion/" + $("#TipoAlimentacion").val() + "", function (respAlimentacion){
        $.each(respAlimentacion.alimentacion, function(i, e){
            $("#Alimentacion").append("<option value='" +e.Id + "'>" + e.Nombre_Alimentacion + "</option>");
          }); 
      });
    }
  });
  $("#Alimentacion").on('change', function(){
    $.get("ValorAlimentacion/" + $("#Alimentacion").val() + "", function (respValorAlimentacion){
          $("#ValorAlimentacion").val(respValorAlimentacion['Valor_Alimentacion']);
    });
  });

  $('#FechaComplementoDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
  $('#FechaApoyoDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
  $('#FechaAlimentacionDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});  

  $("#Agregar_Complemento").on('click', function(){
    $("#Agregar_ComplementoD").show('slow');
  });

  $("#Agregar_Apoyo").on('click', function(){
    $("#Agregar_ApoyoD").show('slow');
  });

  $("#Agregar_Alimentacion").on('click', function(){
    $("#Agregar_AlimentacionD").show('slow');
  });

  $('body').delegate('button[data-function="VerPersona"]','click',function (e) {
    VerPersona($(this).val());
  });

});

function VerPersona(id_persona){
  $("#loading").show('slow');
  $("#tablaPersonas").hide('slow');   
  $("#camposRegistro").hide("slow");
  $("#loading").show('slow');

  $.get('buscarPersona/'+id_persona,{}, function(Persona){
        $.each(Persona.tipo, function(i, e){
          if(e.Id_Tipo == 59){
            $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
            $('#buscar span').empty();
            document.getElementById("buscar").disabled = false;
            $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">Esta persona ya se encuentra registrada como un entrenador, por favor verifique la información!</h4></dvi><br>');
            $('#paginador').fadeOut();
            $("#camposRegistro").hide("slow");
            $("#loading").hide('slow');           
            return false;
          }
        });
        if(Persona.deportista){  //Cuando Hay deportista   
          $("#Nombres").append(Persona['Primer_Nombre']+' '+Persona['Segundo_Nombre']+' '+Persona['Primer_Apellido']+' '+Persona['Segundo_Apellido']);
          $("#Identificacion").append('IDENTIFICACIÓN '+Persona['Cedula']);    
          $("#deportista1").val(Persona.deportista['Id']);
          $("#deportista2").val(Persona.deportista['Id']);
          $("#deportista3").val(Persona.deportista['Id']);
          $("#BotoneraAcciones").show('slow');
          $("#camposRegistro").show('slow');
        }else{        
           $('#buscar span').empty();
          document.getElementById("buscar").disabled = false;
          $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">Esta persona aún no se encuentra registrada como un deportista, por favor verifique la información!</h4></dvi><br>');
          $('#paginador').fadeOut();
          $("#camposRegistro").hide("slow");
          $("#loading").hide('slow');           
          return false;
        }
    }).done(function(){
      $("#loading").hide('slow');
    });
}

function Buscar(e){	
  $("#loading").show('slow');  
  var key = $('input[name="buscador"]').val(); 
    $.get('personaBuscarDeportista/'+key,{}, function(data){
      if(data.length == 0){
        $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
            $('#buscar span').empty();
            document.getElementById("buscar").disabled = false;
            $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">No se encuentra ninguna persona registrada con estos datos.</h4></dvi><br>');
            $('#paginador').fadeOut();

      }else if(data.length == 1){
        VerPersona(data[0].Id_Persona);
      }else if(data.length > 1){
        var html = '';
        html += '<table id="tablaPersonasDatos" class="display nowrap" cellspacing="0" width="100%" style="text-transform: uppercase;">';
        html += '<thead>';
        html += '<th>Nombres</th>';
        html += '<th>Opciones</th>';
        html += '</thead>';
        html += '<tbody>';
        $.each(data, function(i, e){
          html += '<tr>';
          html += '<td>'+e.Primer_Nombre+' '+e.Segundo_Nombre+' '+e.Primer_Apellido+' '+e.Segundo_Apellido+'</td>';
          html += "<td><button type='button' class='btn btn-info' data-function='VerPersona' value='"+e.Id_Persona+"'>"+
                             "<span class='glyphicon glyphicon-zoom-in' aria-hidden='true'></span> Ver"+
                            "</button></td>";
          html += '</tr>';
        });
        html += '</tbody>';
        html += '</table>';
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
        $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
        $('#buscar span').empty();
        document.getElementById("buscar").disabled = false;    
        $("#tablaPersonas").show('slow');   
    }
  }).done(function(){
      $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
        $('#buscar span').empty();
        document.getElementById("buscar").disabled = false;    
        $("#tablaPersonas").show('slow');
        $("#loading").hide('slow');
  });       	
}

function Reset_campos(e){   
  var t = $('#TablaVisitas').DataTable();   
  t.row.add( ['1','1','1'] ).clear().draw( false );
  $("#tablaPersonas").empty();
  $("#personas").empty();

  $("#BotoneraAcciones").hide('slow');
  $("#SuministrosComplementosF").hide('slow');
  $("#SuministrosAlimentacionF").hide('slow');
  $("#ApoyoServiciosF").hide('slow');
  $("#Nombres").empty();
  $("#Identificacion").empty();      
}