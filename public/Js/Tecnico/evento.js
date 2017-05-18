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
        "pageLength": 8,
        "language": {
            url: 'public/DataTables/Spanish.json',
            searchPlaceholder: "Buscar"
        }
    });

    $('#deportesTabla').DataTable({
        retrieve: true,
        select: true,
        "responsive": true,
        "ordering": true,
        "info": true,
        "pageLength": 5,
        "language": {
            url: 'public/DataTables/Spanish.json',
            searchPlaceholder: "Buscar"
        }
    });
    

    $("#Crear_Nuevo").on('click', function(e){
    	$("#creaEventoF").show('slow');
    	$("#creaEventoD").modal('show');
    	Reset_campos();
    });

    $(".VerModificar").on('click', function(e){
    	$("#verEventoF").show('slow');
    	$("#deporteEventoF").hide('slow');
    	$("#verEventoD").modal('show'); 
    	$("#Id_EventoDatos").val($(this).val());
    	$("#InicioEventoLi").addClass('active');
    	$("#DeportesEventoLi").removeClass('active');

    	$.get("getEvento/"+$(this).val(), function (evento) {

        /*var t = 0;
        var html2 = '';*/
        $("#ListadoDeportes").empty();
        $("#ListadoDeportes").append('<div class="row">');
        $.each(evento.clasificacion_deportiva.agrupacion, function(i, e){          
          /*if((t%2) == 0){
            $("#ListadoDeportes").append('<div class="form-group col-md-2">111111111111111112345678');
            html2 = '</div>';
          }else{
            html2 = '';
          }*/*
          $.each(e.deporte, function(i, e){
            var html =   '';
            html +=   '<div class="radio"><label><input type="checkbox"';
            $.each(evento.deporte, function(i, f){                              
              if(e.Id == f.Id){
                html +=' checked="true" ';
              }              
            });
            html +=' name="DeportesCheck[]" id="deportes1" value="'+e.Id+'">'+e.Nombre_Deporte+'</label></div>';
            $("#ListadoDeportes").append(html);                        
          });            
          /*$("#ListadoDeportes").append(html2);
          t = t + 1; */                
        });
        $("#ListadoDeportes").append('</div>');
        $("#ListadoDeportes").append('<button type="button" class="btn btn-success" onclick="GuardarDeporte('+evento['Id']+')">Guardar</button>');

    		$("#TituloE").empty();
    		$("#TituloE").append('<strong>Evento:</strong> '+evento['Nombre_Evento']);
    		$("#Clasificacion_IdDatos").val(evento.clasificacion_deportiva['Id']).change();
    		$("#Tipo_Nivel_IdDatos").val(evento.tipo_nivel['Id']).change();
    		$("#Nombre_EventoDatos").val(evento['Nombre_Evento']);
    		$("#Id_EventoDatos").val(evento['Id']);
            $("#Id_Evento").val(evento['Id']);
            $("#Id_EventoDep").val(evento['Id']);            
    	});

      $("#GuardarDeporte").on('click', function(){
        alert($(this),val());
      });

    	/*$.get("getDeportesNoEvento/"+$("#Id_EventoDatos").val(), function (Deportes) {
    		$("#Deporte_Id").empty();
    		var html = '<option value="">Seleccionar</option>';
    		$.each(Deportes, function(i, e){
    			html += '<option value="'+e.Id+'"">'+e['Nombre_Deporte']+'</option>';
    		});
    		$("#Deporte_Id").html(html).selectpicker('refresh');
    	});

    	$.get("getDeportesEvento/"+$("#Id_EventoDatos").val(), function (Deportes) {
    		var t = $('#deportesTabla').DataTable();
    		if(Deportes['deporte'].length != 0){                
                t.row.add( ['1','1', '1'] ).clear().draw( false );
	    		$.each(Deportes['deporte'], function(i, e){
	    			t.row.add( [
			            e['Nombre_Deporte'],
			            e.agrupacion.clasificacion_deportista['Nombre_Clasificacion_Deportista'],
			            '<button type="button" class="btn btn-danger" onclick="EliminarDeporte('+e['Id']+')">Eliminar</button>',
			        ] ).draw( false );
	    		});
	    	}
    	});*/
    });



    $("#AgregarDeporte").on('click', function(){
        var token = $("#token").val();
        var formData = new FormData($("#")[0]);       
        var formData = new FormData($("#deporteEventoF")[0]);       
      
        $.ajax({
          url: 'AddDeporteEvento',  
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (xhr) {
            if(xhr.status == 'error'){
              validador_errores(xhr.errors);
            }
            else 
            {
              $('#alert_evento3').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#mensaje_evento3').show(60);
              $('#mensaje_evento3').delay(1500).hide(600);                      
              setTimeout(function(){ $("#verEventoD").modal('hide');  }, 1500);
              Reset_campos();
            }
          },
          error: function (xhr){
            validador_errores(xhr.responseJSON);
          }
        });
    });

    $("#InicioEvento").on('click', function(e){
    	$("#verEventoF").show('slow');
    	$("#deporteEventoF").hide('slow');
    	$("#InicioEventoLi").addClass('active');
    	$("#DeportesEventoLi").removeClass('active');
    });

    $("#DeportesEvento").on('click', function(e){
    	$("#verEventoF").hide('slow');
    	$("#deporteEventoF").show('slow');
    	$("#InicioEventoLi").removeClass('active');
    	$("#DeportesEventoLi").addClass('active');
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
	        if(xhr.status == 'error'){
	          validador_errores(xhr.errors);
	        }
	        else 
	        {
	          $('#alert_evento1').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
	          $('#mensaje_evento1').show(60);
	          $('#mensaje_evento1').delay(2000).hide(600);        
	          Reset_campos();
	          setTimeout(function(){ 
    			$("#creaEventoD").modal('hide');
    		}, 2600);
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
	  	var formData = new FormData($("#verEventoF")[0]);       
	  
	  	$.ajax({
	      url: 'EditEvento',  
	      type: 'POST',
	      data: formData,
	      contentType: false,
	      processData: false,
	      dataType: "json",
	      success: function (xhr) {
	        if(xhr.status == 'error'){
	          validador_errores(xhr.errors);
	        }
	        else 
	        {
	          $('#alert_evento2').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
	          $('#mensaje_evento2').show(60);
	          $('#mensaje_evento2').delay(1500).hide(600); 
            setTimeout(function(){ $("#verEventoD").modal('hide');  }, 1500);     
              
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

   /* function EliminarDeporte(id_dep){
        var token = $("#token").val();   
        $.ajax({
          url: 'DeleteDeporteEvento/'+id_dep+'/'+$("#Id_Evento").val(),  
          type: 'POST',
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (xhr) {
            if(xhr.status == 'error'){
              //validador_errores(xhr.errors);
              $('#alert_evento3').html('<div class="alert alert-dismissible alert-danger" ><strong>Error!</strong>'+xhr.Mensaje+'</div>');
              $('#mensaje_evento3').show(60);
              $('#mensaje_evento3').delay(1500).hide(600);        
            }
            else 
            {
              $('#alert_evento3').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#mensaje_evento3').show(60);
              $('#mensaje_evento3').delay(1500).hide(600);        
              setTimeout(function(){ $("#verEventoD").modal('hide');  }, 1500);
              Reset_campos();
            }
          },
          error: function (xhr){
            validador_errores(xhr.responseJSON);
          }
        });
    }*/