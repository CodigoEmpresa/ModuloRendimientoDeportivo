$(function(){

	$.datepicker.setDefaults($.datepicker.regional["es"]);
	$('#FechaInicioDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaFinDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaInicioDateM').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaFinDateM').datepicker({format: 'yyyy-mm-dd', autoclose: true,});

	$('#certamenesTabla').DataTable({
        retrieve: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        dom: 'Bfrtip',
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
    	$("#creaCertamenF").show('slow');
    	$("#Agregar").show('slow');
    	$("#Modificar").hide('slow');
    	$("#verCertamenF").hide('slow');
    	//$("#eliminaEventoF").hide('slow');
    	var new_position = jQuery('#Agregar').offset();
 		window.scrollTo(new_position.left,new_position.top);
    	Reset_campos();
    }); 

    $("#Evento_Id").on('change', function(){
    	if($(this).val() != ''){
    		$("#Nombre_Certamen").val($("#Evento_Id option:selected").text());
	    	$.get("getEvento/"+$(this).val(), function (evento) {
	    		if(evento['Tipo_Nivel_Id'] == 1){
	    			$.get("getCiudades", function (ciudades) {
	    				$("#Sede_Id").empty();
	    				$("#Sede_Id").append("<option value=''>Seleccionar</option>");
	    				$.each(ciudades, function(i, e){
	    					$("#Sede_Id").append("<option value='"+e['Id_Ciudad']+"'>"+e['Nombre_Ciudad']+"</option>");
	    				});
	    			});
	    			
	    		}else if(evento['Tipo_Nivel_Id'] == 2){
	    			$.get("getPaises", function (paises) {
	    				$("#Sede_Id").empty();
	    				$("#Sede_Id").append("<option value=''>Seleccionar</option>");
	    				$.each(paises, function(i, e){
	    					$("#Sede_Id").append("<option value='"+e['Id_Pais']+"'>"+e['Nombre_Pais']+"</option>");
	    				});
	    			});
	    			
	    		}
	    	});
	    }
    });

    $("#Agregar").on('click', function(){
    	var token = $("#token").val();
	  	var formData = new FormData($("#")[0]);       
	  	var formData = new FormData($("#creaCertamenF")[0]);       	  
	  	$.ajax({
	      url: 'AddCertamen',  
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
	          $('#alert_certamen').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
	          $('#mensaje_certamen').show(60);
	          $('#mensaje_certamen').delay(2000).hide(600);        
	          Reset_campos();
	        }
	      },
	      error: function (xhr){
	        validador_errores(xhr.responseJSON);
	      }
      	});
    });

    function Reset_campos(){
    	$("#Titulo").empty();
    	$("#Evento_Id").val('').change();
    	$("#Sede_Id").val('').change();
    	$("#FechaInicio").val('');
    	$("#FechaFin").val('');
    }

    var validador_errores = function(data){
      $('#creaCertamenF .form-group').removeClass('has-error');
      $.each(data, function(i, e){
        $("#"+i).closest('.form-group').addClass('has-error');
      });
    }

    $(".VerCertamen").on('click', function(e){
    	$("#creaCertamenF").hide('slow');    	
    	$("#loading").show('slow');
    	$.get("getCertamen/"+$(this).val(), function (certamen){
    		//console.log(certamen);
    		$("#TituloCertamen").empty();
    		$("#TituloCertamen").append(certamen['Nombre_Certamen']);
    		$("#Evento").val(certamen['Evento_Id']).change();
    		$("#FechaInicioM").val(certamen['Fecha_Inicio']).change();
    		$("#FechaFinM").val(certamen['Fecha_Fin']).change();
    		setTimeout(function(){ 
    			$("#Sede").val(certamen['Sede_Id']).change(); 
    			$("#loading").hide('slow');
    			$("#verCertamenF").show('slow');
    		}, 3000);    		
    	});
    });

    $("#Evento").on('change', function(){
    	if($(this).val() != ''){
    		$("#Nombre_Certamen").val($("#Evento_Id option:selected").text());
	    	$.get("getEvento/"+$(this).val(), function (evento) {
	    		if(evento['Tipo_Nivel_Id'] == 1){
	    			$.get("getCiudades", function (ciudades) {
	    				$("#Sede").empty();
	    				$("#Sede").append("<option value=''>Seleccionar</option>");
	    				$.each(ciudades, function(i, e){
	    					$("#Sede").append("<option value='"+e['Id_Ciudad']+"'>"+e['Nombre_Ciudad']+"</option>");
	    				});
	    			});	    			
	    		}else if(evento['Tipo_Nivel_Id'] == 2){
	    			$.get("getPaises", function (paises) {
	    				$("#Sede").empty();
	    				$("#Sede").append("<option value=''>Seleccionar</option>");
	    				$.each(paises, function(i, e){
	    					$("#Sede").append("<option value='"+e['Id_Pais']+"'>"+e['Nombre_Pais']+"</option>");
	    				});
	    			});
	    			
	    		}
	    	});
	    }
    });

    
});