$(function(){
    $('#eventosTabla').DataTable({
        retrieve: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        dom: 'Bfrtip',
        select: true,
        "responsive": true,
        "ordering": true,
        "info": true,
        "pageLength": 3,
        "language": {
            url: 'public/DataTables/Spanish.json',
            searchPlaceholder: "Buscar"
        }
    });

    $("#Crear_Nuevo").on('click', function(e){
    	$("#Titulo").empty();
    	$("#Titulo").append('<h3>Crear nuevo evento</h3>');
    	$("#creaEventoF").show('slow');
    	$("#Agregar").show('slow');
    	$("#Modificar").hide('slow');
    	$("#eliminaEventoF").hide('slow');
    	var new_position = jQuery('#Agregar').offset();
 		window.scrollTo(new_position.left,new_position.top);
    	Reset_campos();
    });

    $(".VerModificar").on('click', function(e){
    	$("#Titulo").empty();
    	$("#Titulo").append('<h3>Modificar evento</h3>');
    	$("#creaEventoF").show('slow');
    	$("#Agregar").hide('slow');
    	$("#Modificar").show('slow');
    	$("#eliminaEventoF").hide('slow');
    	$.get("getEvento/"+$(this).val(), function (evento) {
    		$("#Clasificacion_Id").val(evento.clasificacion_deportiva['Id']).change();
    		$("#Tipo_Nivel_Id").val(evento.tipo_nivel['Id']).change();
    		$("#Nombre_Evento").val(evento['Nombre_Evento']);
    		$("#Id_Evento").val(evento['Id']);
    	});
    	var new_position = jQuery('#Modificar').offset();
 		window.scrollTo(new_position.left,new_position.top);
    });

    $("#Agregar").on('click', function(e){
		var token = $("#token").val();
	  	var formData = new FormData($("#")[0]);       
	  	var formData = new FormData($("#creaEventoF")[0]);       	  
	  	$.ajax({
	      url: 'AddEvento',  
	      type: 'POST',
	      data: formData,
	      contentType: false,
	      processData: false,
	      dataType: "json",
	      success: function (xhr) {
	      	console.log(xhr);
	        if(xhr.status == 'error'){
	          validador_errores(xhr.errors);
	        }
	        else 
	        {
	          $('#alert_evento').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
	          $('#mensaje_evento').show(60);
	          $('#mensaje_evento').delay(2000).hide(600);        
	          Reset_campos();
	        }
	      },
	      error: function (xhr){
	        validador_errores(xhr.responseJSON);
	      }
      	});
    });

    var validador_errores = function(data){
      $('#creaEventoF .form-group').removeClass('has-error');

      $.each(data, function(i, e){
        $("#"+i).closest('.form-group').addClass('has-error');
      });
    }

    function Reset_campos(){
    	$("#Clasificacion_Id").val('').change();
		$("#Tipo_Nivel_Id").val('').change();
		$("#Nombre_Evento").val('');
		$("#Id_Evento").val('');
		$("#Id_EventoE").val('');
    }

    $("#Modificar").on('click', function(e){
		var token = $("#token").val();
	  	var formData = new FormData($("#")[0]);       
	  	var formData = new FormData($("#creaEventoF")[0]);       
	  
	  	$.ajax({
	      url: 'EditEvento',  
	      type: 'POST',
	      data: formData,
	      contentType: false,
	      processData: false,
	      dataType: "json",
	      success: function (xhr) {
	      	console.log(xhr);
	        if(xhr.status == 'error'){
	          validador_errores(xhr.errors);
	        }
	        else 
	        {
	          $('#alert_evento').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
	          $('#mensaje_evento').show(60);
	          $('#mensaje_evento').delay(2000).hide(600);        
	          Reset_campos();
	        }
	      },
	      error: function (xhr){
	        validador_errores(xhr.responseJSON);
	      }
      	});
    });

    $(".VerEliminar").on('click', function(){
    	$("#creaEventoF").hide('slow');
    	$("#eliminaEventoF").show('slow');
    	$("#Id_EventoE").val($(this).val());
    	var new_position = jQuery('#EliminarEvento').offset();
 		window.scrollTo(new_position.left,new_position.top);
    });

    $("#EliminarEvento").on('click', function(){
    	var token = $("#token").val();   
	  	var formData = new FormData($("#eliminaEventoF")[0]);       	  
	  	$.ajax({
	      url: 'DeleteEvento',  
	      type: 'POST',
	      data: formData,
	      contentType: false,
	      processData: false,
	      dataType: "json",
	      success: function (xhr) {
	      	console.log(xhr);
	        if(xhr.status == 'error'){
	          validador_errores(xhr.errors);
	        }
	        else 
	        {
	          $('#alert_evento').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
	          $('#mensaje_evento').show(60);
	          $('#mensaje_evento').delay(2000).hide(600);        
	          $('#eliminaEventoF').delay(500).hide(200);        
	          Reset_campos();
	        }
	      },
	      error: function (xhr){
	        validador_errores(xhr.responseJSON);
	      }
      	});

    });

});