var Convencion = '';
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
	$('#FechaNCDate').datetimepicker({format: 'YYYY-MM-DD'});

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
	        }else {
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
    	$("#Entrenamiento_Id4").val($(this).val());
    	$("#Entrenamiento_Id5").val($(this).val());
    	$("#DescripcionPlanilla").empty();
    	$.get("getEntrenamientoOnly/"+$("#Entrenamiento_Id3").val(), function (EntrenamientoOnly) {
    		$("#DescripcionPlanilla").append('Planilla de asistencia para el entrenamiento: <br>'+EntrenamientoOnly['Lugar_Entrenamiento']+' - (FI: '+EntrenamientoOnly['Fecha_Inicio']+' - FF: '+EntrenamientoOnly['Fecha_Fin']+')');
    		$("#Fecha_Inicio3").val(EntrenamientoOnly['Fecha_Inicio']);
    		$("#Fecha_Fin3").val(EntrenamientoOnly['Fecha_Fin']);
    	}).done(function(){
    		AsistenciasFormato();
    	});
    });

    function AsistenciasFormato(){
    	$("#AsistenciaF").show('slow');
    	$("#AsistenciaLi").addClass('active');


    	$("#VerificacionRequisitosF").hide('slow');
    	$("#VerificacionRequisitos").removeClass('active');
    	$("#PlanillaVerificacion").empty();

    	$("#NoConformidadesF").hide('slow');    	
    	$("#NoConformidades").removeClass('active');


    	$('#MensajeAsistencia').hide('slow');	
    	$("#PlanillaAsistencia").empty();
    	$("#PlanillaAsistencia").hide();
    	$("#loadingPA").show();

    	$.get("getEntrenamientoDeportistas/"+$("#Entrenamiento_Id3").val(), function (DeportistasEntrenamientoOnly) {
    		if(DeportistasEntrenamientoOnly.length > 0){
		    		var CantidadDias = moment($("#Fecha_Fin3").val()).diff(moment($("#Fecha_Inicio3").val()), 'days');	
		    		var html = '<table  class="table" style="text-transform: uppercase; font-size:10px;">';
		    		html += '<thead>';
		    		html += '<th>Atleta</th>';

		    		var k = 1;
		    		for(k = 1; CantidadDias >= k; k++){						
							html +='<th>'+(k)+'</th>';
						}
		    		html += '</thead>';
		    		html += '<tbody id="BodyTabla" name="BodyTabla">';		    		
					html += '</tbody>';
					html += '</table>';

					$("#PlanillaAsistencia").append(html);

		    		$.each(DeportistasEntrenamientoOnly, function(i, e){    		
		    			html2 = ''
		    			html2 += '<tr id=DeportistaRegistro'+i+'>';
		    			html2 += '<td id="NombresAtleta'+i+'">';
						html2 += '<label style="text-transform: uppercase; font-size:10px;">'+e['deportista']['persona']['Primer_Nombre']+' '+e['deportista']['persona']['Segundo_Nombre']+' '+e['deportista']['persona']['Primer_Apellido']+' '+e['deportista']['persona']['Segundo_Apellido']+'</label>';
						html2 += '</td>';						
						html2 += '</tr>';

						$("#BodyTabla").append(html2);
	    				var j = 1;
	    				for(j = 1; CantidadDias >= j; j++){	
	    					htmlExtra = '';
	    					htmlExtra += '<td>';
							htmlExtra += '<select style="padding:0px; font-size:10px;"  data-function="Asistencias-'+e['deportista']['Id']+'-'+(j)+'" name="Asistencias-'+e['deportista']['Id']+'-'+(j)+'" id="Asistencias-'+e['deportista']['Id']+'-'+(j)+'" class="form-control">';
							htmlExtra += '<option value="">----</option>';
							htmlExtra += '<option value="1">1</option>';
							htmlExtra += '<option value="2">2</option>';
							htmlExtra += '<option value="3">F</option>';
							htmlExtra += '<option value="4">M</option>';
							htmlExtra += '<option value="5">K</option>';
							htmlExtra += '<option value="6">CM</option>'
							htmlExtra += '<option value="7">NP</option>'
							htmlExtra += '</select>';
							htmlExtra += '</td>';
							$("#DeportistaRegistro"+i).append(htmlExtra);
						}

						$.each(e.deportista_asistencia, function(it, efe){
							$("#Asistencias-"+e['deportista']['Id']+'-'+(efe['Numero_Dia'])).val(efe['Convencion_Asistencia_Id']).change();
	    				});	    
	    			});
	    			
				}else{
					$('#MensajeAsistencia').html('<div class="alert alert-dismissible alert-danger" ><strong>Error! </strong>No se encontraron deportistas vinculados a este entrenamiento!</div>');
					$('#MensajeAsistencia').show(60);
				}
    	}).done(function(){  
    		$("#PlanillaAsistencia").append('<button type="button" class="btn btn-success" data-funcion="GuardaAsistencia" name="GuardaAsistencia" id="GuardaAsistencia" >Guardar Asistencia</button>');  		
			$("#loadingPA").hide();
			$("#PlanillaAsistencia").show();
    	});
    }

    $("#Asistencia").on('click', function(e){
    	AsistenciasFormato();
    });

	$("body").delegate('button[data-funcion="GuardaAsistencia"]', 'click', function(){
    	var token = $("#token").val();
	  	var formData = new FormData($("#AsistenciaF")[0]);       	  
	  	formData.append("Asistencias",$("#Entrenamiento_Id3").val());
	  	$.ajax({
	      url: 'AddAsistencias',  
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
	          $('#MensajeAsistencia').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
	          $('#MensajeAsistencia').show(60);
	          $('#MensajeAsistencia').delay(1500).hide(600);  	          
	        }
	      },
	      error: function (xhr){
	        validador_errores(xhr.responseJSON, 'AsistenciaF');
	      }
      	});
    });

    function VerificacionRequisitosFormato(){
    	$("#AsistenciaF").hide('slow');    	
    	$("#AsistenciaLi").removeClass('active');
    	$("#PlanillaAsistencia").empty();


    	$("#VerificacionRequisitosF").show('slow');
    	$("#VerificacionRequisitosLi").addClass('active');


    	$("#NoConformidadesF").hide('slow');    	
    	$("#NoConformidadesLi").removeClass('active');


    	$('#MensajeVerificacion').hide('slow');	
    	$("#PlanillaVerificacion").empty();
    	$("#PlanillaVerificacion").hide();
    	$("#loadingPV").show();
    	$.get("getEntrenamientoVerificaciones/"+$("#Entrenamiento_Id4").val(), function (EntrenamientoVerificaciones) {
    		var CantidadDias = moment($("#Fecha_Fin3").val()).diff(moment($("#Fecha_Inicio3").val()), 'days');	
    		var html = '<table  class="table" style="text-transform: uppercase; font-size:10px;">';
    		html += '<thead>';
    		html += '<th>Atleta</th>';

    		var k = 1;
    		for(k = 1; CantidadDias >= k; k++){						
					html +='<th>'+(k)+'</th>';
				}
    		html += '</thead>';
    		html += '<tbody id="BodyTablaV" name="BodyTablaV">';
			html += '</tbody>';
			html += '</table>';

			$("#PlanillaVerificacion").append(html);

			html2 = ''
			html2 += '<tr id=VerificacionRegistroV1>';
			html2 += '<td id="P1" width="200px;">';
			html2 += '<label style="text-transform: uppercase; font-size:10px;">';
			html2 += 'El entrenamiento inició a la hora establecida?';
			html2 += '</label>';
			html2 += '</td>';						
			html2 += '</tr>';

			html2 += '<tr id=VerificacionRegistroV2>';
			html2 += '<td id="P2">';
			html2 += '<label style="text-transform: uppercase; font-size:10px;">';
			html2 += 'El escenario deportivo se encuentra en condiciones adecuadas para desarrollar el entrenamiento?';
			html2 += '</label>';
			html2 += '</td>';						
			html2 += '</tr>';

			html2 += '<tr id=VerificacionRegistroV3>';
			html2 += '<td id="P3">';
			html2 += '<label style="text-transform: uppercase; font-size:10px;">';
			html2 += 'Se cuenta con los implementos deportivos requeridos para el desarrollo del entrenamiento?';
			html2 += '</label>';
			html2 += '</td>';	
			html2 += '</tr>';

			html2 += '</tr>';
			$("#BodyTablaV").append(html2);

			var g = 0;
			for(g = 0; 3 >= g; g++){
				var j = 1;
				for(j = 1; CantidadDias >= j; j++){	
					htmlExtra = '';
					htmlExtra += '<td>';
					htmlExtra += '<select style="padding:0px; font-size:10px;"name="Verificacion-'+(g+1)+'-'+(j)+'" id="Verificacion-'+(g+1)+'-'+(j)+'" class="form-control">';
					htmlExtra += '<option value="">----</option>';
					htmlExtra += '<option value="1">SI</option>';
					htmlExtra += '<option value="2">NO</option>';
					htmlExtra += '</select>';
					htmlExtra += '</td>';

					$("#VerificacionRegistroV"+(g+1)).append(htmlExtra);

					$.each(EntrenamientoVerificaciones.entrenamiento_verificacion, function(it, efe){
						if((g+1) == 1){
							$("#Verificacion-"+(g+1)+'-'+(efe['Numero_Dia'])).val(efe['P_1']).change();
						}
						if((g+1) == 2){
							$("#Verificacion-"+(g+1)+'-'+(efe['Numero_Dia'])).val(efe['P_2']).change();
						}
						if((g+1) == 3){
							$("#Verificacion-"+(g+1)+'-'+(efe['Numero_Dia'])).val(efe['P_3']).change();
						}
					});
				}
			}
    	}).done(function(){  
    		$("#PlanillaVerificacion").append('<button type="button" class="btn btn-success" data-funcion="GuardaVerificacion" name="GuardaVerificacion" id="GuardaVerificacion" >Guardar Verificación</button>');  		    	
			$("#loadingPV").hide();
			$("#PlanillaVerificacion").show();
    	});
    }

    $("body").delegate('button[data-funcion="GuardaVerificacion"]', 'click', function(){
    	var token = $("#token").val();
	  	var formData = new FormData($("#VerificacionRequisitosF")[0]);       	  
	  	formData.append("Verificacion",$("#Entrenamiento_Id4").val());
	  	$.ajax({
	      url: 'AddVerificacionRequisitos',  
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
	          $('#MensajeVerificacion').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
	          $('#MensajeVerificacion').show(60);
	          $('#MensajeVerificacion').delay(1500).hide(600);  	          
	        }
	      },
	      error: function (xhr){
	        validador_errores(xhr.responseJSON, 'AsistenciaF');
	      }
      	});
    });

    $("#VerificacionRequisitos").on('click', function(e){
    	VerificacionRequisitosFormato();
    });

    $("#NoConformidades").on('click', function(e){
    	NoConformidadFormato();
    });

    function NoConformidadFormato(){
    	
    	$('#NoConformidadesF .form-group').removeClass('has-error');    	
    	document.getElementById("NoConformidadesF").reset();

    	$("#AsistenciaF").hide('slow');    	
    	$("#AsistenciaLi").removeClass('active');
    	$("#PlanillaAsistencia").empty();


    	$("#VerificacionRequisitosF").hide('slow');
    	$("#VerificacionRequisitosLi").removeClass('active');
    	$("#PlanillaVerificacion").empty();


    	$("#NoConformidadesF").show('slow');    	
    	$("#NoConformidadesLi").addClass('active');
    	$("#ListaNC").empty();

    	$.get("getEntrenamientoNC/"+$("#Entrenamiento_Id5").val(), function (EntrenamientoNC) {
    		var htmlTabla = '<table id="datosTabla" name="datosTabla" style="text-transform: uppercase;">';
            htmlTabla += '<thead>';
            htmlTabla += '<th>DESCRIPCIÓN</th>';
            htmlTabla += '<th>FECHA</th>';
            htmlTabla += '<th>REGISTRO</th>';
            htmlTabla += '<th>TRATAMIENTO</th>';
            htmlTabla += '<th>ACCIÓN TOMADA</th>';
            htmlTabla += '<th>INCONVENIENTE</th>';
            htmlTabla += '<th>OPCIONES</th>';
            htmlTabla += '</thead>';
    		$.each(EntrenamientoNC.entrenamiento_no_conformidad, function(i, e){

    			htmlTabla += '<tr>';
                htmlTabla += '<td>'+e.Descripcion_No_Conformidad+'</td>';
                htmlTabla += '<td>'+e.Fecha+'</td>';
                htmlTabla += '<td>'+e.Numero_Requisito+'</td>';
                htmlTabla += '<td>'+e.tratamiento_conformidad['Nombre_Tratamiento_Conformidad']+'</td>';
                htmlTabla += '<td>'+e.Descripcion_Accion+'</td>';
                if(e.Inconvenientes == 1){
                	htmlTabla += '<td>SI</td>';
                }else if(e.Inconvenientes == 2){
                	htmlTabla += '<td>NO</td>';
                }                
                htmlTabla += '<td><button type="button" class="btn-sm btn-danger"  data-funcion="eliminarNoConformidad" value="'+e.Id+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar</button></td>';
                htmlTabla += '</tr>';
    		});

    		$("#ListaNC").html(htmlTabla);
            $("#ListaNC").show('slow');
            $('#datosTabla').DataTable({
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
    	});
    }

    $("#AgregarNC").on('click', function(){
    	var token = $("#token").val();
	  	var formData = new FormData($("#NoConformidadesF")[0]);       	
	  	$.ajax({
	      url: 'AddNoConformidad',  
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
	        	NoConformidadFormato();
	          $('#MensajeNoConformidad').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
	          $('#MensajeNoConformidad').show(60);
	          $('#MensajeNoConformidad').delay(1500).hide(600);  	          
	        }
	      },
	      error: function (xhr){
	        validador_errores(xhr.responseJSON, 'NoConformidadesF');
	      }
      	});
    });

    $('body').delegate('button[data-funcion="eliminarNoConformidad"]','click',function (e) {
    	var token = $("#token").val();
	  	var formData = new FormData($("#NoConformidadesF")[0]);       	
	  	formData.append("Id_No_Conformidad",$(this).val());
	  	$.ajax({
	      url: 'DeleteNoConformidad',  
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
	        	NoConformidadFormato();
	          $('#MensajeNoConformidad').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
	          $('#MensajeNoConformidad').show(60);
	          $('#MensajeNoConformidad').delay(1500).hide(600);  	          
	        }
	      },
	      error: function (xhr){
	        validador_errores(xhr.responseJSON, 'NoConformidadesF');
	      }
      	});
    });
});