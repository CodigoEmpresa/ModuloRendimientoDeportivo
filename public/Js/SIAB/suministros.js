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

});


function Buscar(e){	
	var key = $('input[name="buscador"]').val(); 
  $.get('personaBuscarDeportista/'+key,{}, function(data){  
      if(data.length > 0){ //Existe la persona       	        

        $("#Nombres").append(data[0]['Primer_Nombre']+' '+data[0]['Segundo_Nombre']+' '+data[0]['Primer_Apellido']+' '+data[0]['Segundo_Apellido']);
        $("#Identificacion").append('IDENTIFICACIÓN '+data[0]['Cedula']);           

      	$.each(data, function(i, e){
        	$.get("deportista/" + e['Id_Persona'] + "", function (responseDep) { 

            if(responseDep.deportista){//Existe Deportista

              $("#deportista1").val(responseDep.deportista['Id']);
              $("#deportista2").val(responseDep.deportista['Id']);
              $("#deportista3").val(responseDep.deportista['Id']);

              $("#BotoneraAcciones").show('slow');
            }else{
              $("#BotoneraAcciones").hide('slow');
              $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
              $('#buscar span').empty();
              document.getElementById("buscar").disabled = false;
              $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">Esta persona aún no se encuentra registrada como deportista, registrela en el RUD, para continuar con el procedimiento.</h4></dvi><br>');
              $('#paginador').fadeOut();
            }
          });
        });
      }else{
        $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
        $('#buscar span').empty();
        document.getElementById("buscar").disabled = false;
        $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">No se encuentra ninguna persona registrada con estos datos</h4></dvi><br>');
        $('#paginador').fadeOut();
      }
    }).done(function(){
      setTimeout(function(){ 
        $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
        $('#buscar span').empty();
        document.getElementById("buscar").disabled = false;   
      }, 1500);   
    });           	
}

function Reset_campos(e){   
    $("#BotoneraAcciones").hide('slow');
    $("#SuministrosComplementosF").hide('slow');
    $("#SuministrosAlimentacionF").hide('slow');
    $("#ApoyoServiciosF").hide('slow');
    $("#Nombres").empty();
    $("#Identificacion").empty();      
}