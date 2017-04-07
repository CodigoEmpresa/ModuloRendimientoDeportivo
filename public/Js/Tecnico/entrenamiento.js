$(function(){
	GetEntrenamientos();	
	
	$('#FechaInicioDate').datetimepicker({format: 'YYYY-MM-DD'});
	$('#FechaFinDate').datetimepicker({format: 'YYYY-MM-DD'});
	$('#HoraInicioDate').datetimepicker({format: 'HH:mm'});
	$('#HoraFinDate').datetimepicker({format: 'HH:mm'});

	$('#FechaInicioDateM').datetimepicker({format: 'YYYY-MM-DD'});
	$('#FechaFinDateM').datetimepicker({format: 'YYYY-MM-DD'});
	$('#HoraInicioDateM').datetimepicker({format: 'HH:mm'});
	$('#HoraFinDateM').datetimepicker({format: 'HH:mm'});

	function GetEntrenamientos(){
		$.get("getEntrenamientos/"+$("#Entrenador_Id").val(), function (Entrenamientos) {
			$("#DatosEntrenamiento").empty();
			$("#DatosEntrenamiento").append(Entrenamientos);
			$('#datosEntrenamientos').DataTable({
	            retrieve: true,
	              buttons: [
	                  'copy', 'csv', 'excel', 'pdf', 'print'
	              ],
	              dom: 'Bfrtip',
	              select: true,
	              "responsive": true,
	              "ordering": true,
	              "info": true,
	              "pageLength": 10,
	              "language": {
	                  url: 'public/DataTables/Spanish.json',
	                  searchPlaceholder: "Buscar"
	              }
	          });
	    });
	}

	$("#NuevoEntrenamiento").on('click', function(){
		$("#AgregarEntrenamientoModal").modal('show');
	});

	$("#AgregarEntrenamiento").on('click', function(){
		var token = $("#token").val();
	  	var formData = new FormData($("#NuevoEntrenamientoF")[0]);       	  
	  	$.ajax({
	      url: 'AddEntrenamiento',  
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
	          $('#MensajeNuevoEntrenamiento').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
	          $('#MensajeNuevoEntrenamiento').show(60);
	          $('#MensajeNuevoEntrenamiento').delay(1500).hide(600);  
	          document.getElementById("NuevoEntrenamientoF").reset(); 
	          GetEntrenamientos();
	          setTimeout(function(){ 
	          	$("#AgregarEntrenamientoModal").modal('hide');  
	          }, 1500);
	          
	        }
	      },
	      error: function (xhr){
	        validador_errores(xhr.responseJSON, 'NuevoEntrenamientoF');
	      }
      	});
	});

	var validador_errores = function(data, formulario){
      $('#'+formulario+' .form-group').removeClass('has-error');
      $.each(data, function(i, e){
        $("#"+i).closest('.form-group').addClass('has-error');
      });
    }

    $('body').delegate('button[data-funcion="verEntrenamiento"]','click',function (e) {
    	$("#VerEntrenamientoModal").modal('show');
    	$("#Entrenamiento_Id").val($(this).val());
    	$.get("getEntrenamientoOnly/"+$("#Entrenamiento_Id").val(), function (EntrenamientoOnly) {
    		$("#Lugar_EntrenamientoM").val(EntrenamientoOnly['Lugar_Entrenamiento']);
    		$("#FechaInicioM").val(EntrenamientoOnly['Fecha_Inicio']);
    		$("#FechaFinM").val(EntrenamientoOnly['Fecha_Fin']);
    		$("#HoraInicioM").val(EntrenamientoOnly['Hora_Inicio']);
    		$("#HoraFinM").val(EntrenamientoOnly['Hora_Fin']);
    	});
    });

    $("#ModificarEntrenamiento").on('click', function(){
    	var token = $("#token").val();
	  	var formData = new FormData($("#ModificarEntrenamientoF")[0]);       	  
	  	$.ajax({
	      url: 'EditEntrenamiento',  
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
	          $('#MensajeModificarEntrenamiento').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
	          $('#MensajeModificarEntrenamiento').show(60);
	          $('#MensajeModificarEntrenamiento').delay(1500).hide(600);  
	          document.getElementById("ModificarEntrenamientoF").reset(); 
	          GetEntrenamientos();
	          setTimeout(function(){ 
	          	$("#VerEntrenamientoModal").modal('hide');  
	          }, 1500);
	          
	        }
	      },
	      error: function (xhr){
	        validador_errores(xhr.responseJSON, 'ModificarEntrenamientoF');
	      }
      	});
    });

    $("body").delegate('button[data-funcion="entrenamientoDeportista"]', 'click', function(e){
    	$("#ListadoDeportistas").empty();
    	$("#EntrenamientoDeportistaModal").modal('show');
    	$("#Entrenamiento_Id2").val($(this).val());
    	$("#DescripcionEntrenamiento").empty();
    	$.get("getEntrenamientoOnly/"+$("#Entrenamiento_Id2").val(), function (EntrenamientoOnly) {
    		$("#DescripcionEntrenamiento").append('Entrenamiento: '+EntrenamientoOnly['Lugar_Entrenamiento']+' - (FI: '+EntrenamientoOnly['Fecha_Inicio']+' - FF: '+EntrenamientoOnly['Fecha_Fin']+')');
    	});

    	$.get("getEntrenadorDeportistasSINO/"+$("#Entrenador_Id").val()+'/'+$("#Entrenamiento_Id2").val(), function (EntrenadorDeportistas) {
    		$("#ListadoDeportistas").empty();
    		$("#ListadoDeportistas").append(EntrenadorDeportistas);
    	});
    });

    $("body").delegate('button[data-funcion="AgregarDeportistasEntrenamiento"]', 'click', function(){
    	var token = $("#token").val();
	  	var formData = new FormData($("#EntrenamientoDeportistasF")[0]);       	  
	  	$.ajax({
	      url: 'AddDeportistaEntrenamiento',  
	      type: 'POST',
	      data: formData,
	      contentType: false,
	      processData: false,
	      dataType: "json",
	      before: function(){
	      	$("#loading").show('slow');
	      },
	      success: function (xhr) {
	      		$("#MensajeEntrenamientoDeportistas").show('slow');
	      		if(xhr.status == 'error'){
	      			$('#MensajeEntrenamientoDeportistas').html('<div class="alert alert-dismissible alert-danger" ><strong>Error! </strong>Ocurrio un error, por favor revise la información.</div>');
					$('#MensajeEntrenamientoDeportistas').show(60);
					setTimeout(function(){ 
				        $('#MensajeEntrenamientoDeportistas').hide('slow');	
				      }, 2000); 
					
				}
            	if(xhr.Estado == 'Error'){
					$('#MensajeEntrenamientoDeportistas').html('<div class="alert alert-dismissible alert-danger" ><strong>Error! </strong>'+xhr.Mensaje+'</div>');
					$('#MensajeEntrenamientoDeportistas').show(60);
					setTimeout(function(){ 
				        $('#MensajeEntrenamientoDeportistas').hide('slow');	
				      }, 2000); 
				}
				else if(xhr.Estado == 'Success')
				{
					$('#MensajeEntrenamientoDeportistas').html('<div class="alert alert-dismissible alert-success" ><strong>Exito! </strong>'+xhr.Mensaje+'</div>');
					$('#MensajeEntrenamientoDeportistas').show(60);

					setTimeout(function(){ 
				        $('#MensajeEntrenamientoDeportistas').hide('slow');
				      }, 2000);   

					$('#EntrenamientoDeportistasF .form-group').removeClass('has-error');
				}  
	      },
	      error: function (xhr){
	        validador_errores(xhr.responseJSON, 'EntrenamientoDeportistasF');
	      }
      	});
    });

    $("body").delegate('button[data-funcion="planillaAsistencia"]', 'click', function(){
    	$("#AsistenciaF").show('slow');
    	$("#VerificacionRequisitosF").hide('slow');
    	$("#NoConformidadesF").hide('slow');
    	$("#AsistenciaLi").addClass('active');
    	$("#VerificacionRequisitos").removeClass('active');
    	$("#NoConformidades").removeClass('active');
    	$("#PlanillaModal").modal('show');
    	$("#Entrenamiento_Id3").val($(this).val());
    	$("#DescripcionPlanilla").empty();
    	$.get("getEntrenamientoOnly/"+$("#Entrenamiento_Id3").val(), function (EntrenamientoOnly) {
    		$("#DescripcionPlanilla").append('Planilla de asistencia para el entrenamiento: <br>'+EntrenamientoOnly['Lugar_Entrenamiento']+' - (FI: '+EntrenamientoOnly['Fecha_Inicio']+' - FF: '+EntrenamientoOnly['Fecha_Fin']+')');
    	});
    });

    $("#Asistencia").on('click', function(e){
    	$("#AsistenciaF").show('slow');
    	$("#VerificacionRequisitosF").hide('slow');
    	$("#NoConformidadesF").hide('slow');
    	$("#AsistenciaLi").addClass('active');
    	$("#VerificacionRequisitos").removeClass('active');
    	$("#NoConformidades").removeClass('active');
    	$('#MensajeAsistencia').hide('slow');	

    	$("#PlanillaAsistencia").empty();
    	console.log('sjasnhjahsjahs');

    	$.get("getEntrenamientoOnly/"+$("#Entrenamiento_Id3").val(), function (EntrenamientoOnly) {
    		$.get("getEntrenamientoDeportistas/"+$("#Entrenamiento_Id3").val(), function (DeportistasEntrenamientoOnly) {
    			if(DeportistasEntrenamientoOnly.length > 0){
		    		var CantidadDias = moment(EntrenamientoOnly['Fecha_Fin']).diff(moment(EntrenamientoOnly['Fecha_Inicio']), 'days');
		    		var k = 0;
		    		var html = '<table  class="table" style="text-transform: uppercase; font-size:10px;">';
		    		html += '<thead>';	    		
		    		html += '<th>Atleta</th>';
		    		/*html += '<th>Documento de identidad</th>';
		    		html += '<th>Dirección residencia</th>';
		    		html += '<th>Teléfono</th>';*/
		    		for(k = 0; CantidadDias > k; k++){						
							html += '<th>'+(k+1)+'</th>';
						}
		    		html += '</thead>';
		    		$.each(DeportistasEntrenamientoOnly, function(i, e){
		    			var j = 0;
		    			html += '<tr>';			
		    			html += '<td>';
						html += '<label style="text-transform: uppercase; font-size:10px;">'+e['deportista']['persona']['Primer_Nombre']+' '+e['deportista']['persona']['Segundo_Nombre']+' '+e['deportista']['persona']['Primer_Apellido']+' '+e['deportista']['persona']['Segundo_Apellido']+'</label>';
						html += '</td>';
						/*html += '<td>';
						html += '<label style="text-transform: uppercase; font-size:10px;">'+e['deportista']['persona']['Cedula']+'</label>';
						html += '</td>';
						html += '<td>';
						html += '<label style="text-transform: uppercase; font-size:10px;">'+e['deportista']['Direccion_Localiza']+'</label>';
						html += '</td>';
						html += '<td>';
						html += '<label style="text-transform: uppercase; font-size:10px;">'+e['deportista']['Celular_Localiza']+'</label>';
						html += '</td>';*/
						for(j = 0; CantidadDias > j; j++){						
							html += '<td>';
							html += '<select style="padding:0px; font-size:10px;" name="AsistenciaS'+e['deportista']['Id']+'-'+(j+1)+'" id="AsistenciaS'+e['deportista']['Id']+'-'+(j+1)+'" class="form-control">';
								html += '<option value="">----</option>';
								html += '<option value="1">1</option>';
								html += '<option value="2">2</option>';
								html += '<option value="3">F</option>';
								html += '<option value="4">M</option>';
								html += '<option value="5">K</option>';
								html += '<option value="6">cm</option>';
								html += '<option value="7">NP</option>';
							html += '</select>';
							html += '</td>';
						}			
						html += '</tr>';			    	
				    });
					html += '</table>';					
					$("#PlanillaAsistencia").append(html);
				}else{
					$('#MensajeAsistencia').html('<div class="alert alert-dismissible alert-danger" ><strong>Error! </strong>No se encontraron deportistas vinculados a este entrenamiento!</div>');
					$('#MensajeAsistencia').show(60);
					/*setTimeout(function(){ 
				        $('#MensajeAsistencia').hide('slow');	
				      }, 2000); */
				}
	    	});			
    	});    	
    });

    $("#VerificacionRequisitos").on('click', function(e){
    	$("#AsistenciaF").hide('slow');
    	$("#VerificacionRequisitosF").show('slow');
    	$("#NoConformidadesF").hide('slow');
    	$("#AsistenciaLi").removeClass('active');
    	$("#VerificacionRequisitos").addClass('active');
    	$("#NoConformidades").removeClass('active');
    });

    $("#NoConformidades").on('click', function(e){
    	$("#AsistenciaF").hide('slow');
    	$("#VerificacionRequisitosF").hide('slow');
    	$("#NoConformidadesF").show('slow');
    	$("#AsistenciaLi").removeClass('active');
    	$("#VerificacionRequisitos").removeClass('active');
    	$("#NoConformidades").addClass('active');
    });
});
