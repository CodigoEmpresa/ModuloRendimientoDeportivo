$(function(){

	$('#HistorialPlanT').DataTable({
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

    $('#HistorialPlanActualT').DataTable({
        retrieve: true,
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

    $('#HistorialVersionesAnterioresT').DataTable({
        retrieve: true,
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


	$("#NuevoPlan").on('click', function(){
		$("#AgregarNuevoPlanD").show('slow');
		$("#VerPlanActualM").modal('hide');
		$("#HistorialPlanD").hide('slow');
	});

	$("#VerPlanActual").on('click', function(){
		$("#DatosPlanActualD").show('slow');
		$("#DatosPlanActualLi").addClass('active');
		$("#ActualizarPlanActualD").hide('slow');
		$("#ActualizarPlanActualLi").removeClass('active');
		$("#HistorialPlanActualD").hide('slow');
		$("#HistorialPlanActualLi").removeClass('active');
		$("#UltimaActualizacionD").hide('slow');
		$("#UltimaActualizacionLi").removeClass('active');

		$("#AgregarNuevoPlanD").hide('slow');
		$("#HistorialPlanD").hide('slow');
		$("#ObservacionMetodologo").val('');
		$("#ObservacionEntrenador").val('');
		$("#Id_PLanActual").val('');
		$("#Id_PLanActual_A").val('');		
		$("#AgregarObservaciones").show('slow');
		$("#DatosPlanActualD").show('slow');
		$("#Parte1VP").hide('slow');
		$("#Parte2VP").hide('slow');
		$.get("getPlanActual/"+$("#Id_Deportista").val(), function (PlanActual) {
			$("#Fecha_Creacion").empty();
			$("#Id_PLanActual").val(PlanActual['Id']);
			$("#Id_PLanActual_A").val(PlanActual['Id']);
			$("#VerPlanActualM").modal('show');
			$("#Fecha_Creacion").append(PlanActual['created_at']);
			if(PlanActual){
				$("#UltimaActualizacionLi").show('slow');
				$("#HistorialPlanActualLi").show('slow');				
				$("#Parte1VP").show('slow');
				$("#Parte2VP").hide('slow');				
				$('#archivoWord').attr('href','public/'+PlanActual['Url_Word']);
				$('#archivoExcel').attr('href','public/'+PlanActual['Url_Excel']);
				if(PlanActual['Observacion_Metodologo'] != null){
					$("#ObservacionMetodologo").val(PlanActual['Observacion_Metodologo']);
					$('#ObservacionMetodologo').attr('readonly', true);
				}else{
					$('#ObservacionMetodologo').attr('readonly',false);
				}
				if(PlanActual['Observacion_Entrenador'] != null){
					$("#ObservacionEntrenador").val(PlanActual['Observacion_Entrenador']);
					$('#ObservacionEntrenador').attr('readonly',true);
				}else{
					$('#ObservacionEntrenador').attr('readonly', false);
				}

				if($("#ObservacionMetodologo").val() != '' && $("#ObservacionEntrenador").val() != ''){
					$("#AgregarObservaciones").hide('slow');
				}

			}else{
				$("#UltimaActualizacionLi").hide('slow');
				$("#HistorialPlanActualLi").hide('slow');
				$("#Parte1VP").hide('slow');
				$("#Parte2VP").show('slow');
				$('#MensajeVerPlan').html('<div class="alert alert-dismissible alert-danger" ><strong>Error! </strong>Este deportista aún no cuenta con un Plan de Entrenamiento</div>');				
			}			
	    });
	});

	$("#HistorialPlanes").on('click', function(){
		$("#HistorialPlanD").show('slow');
		$("#AgregarNuevoPlanD").hide('slow');
		$("#VerPlanActualM").modal('hide');

		$.get("getHistorialPlan/"+$("#Id_Deportista").val(), function (HistorialPlan) {
			var t = $('#HistorialPlanT').DataTable();
            t.row.add( ['1', '1', '1', '1'] ).clear().draw( false );
            $.each(HistorialPlan, function(i, e){
    			t.row.add( [
    				e['Numero_Plan'],
    				e['created_at'],
    				e.entrenador.persona['Primer_Nombre']+' '+e.entrenador.persona['Primer_Apellido']+' '+e.entrenador.persona['Segundo_Nombre']+' '+e.entrenador.persona['Segundo_Apellido'],
		            '<button type="button" class="btn btn-primary" data-funcion="VerPlanHistorial" id="VerPlanHistorial" value="'+e['Id']+'">Ver Plan</button>',
		        ] ).draw( false );
    		});
		});
	});

	$('#HistorialPlanT').delegate('button[data-funcion="VerPlanHistorial"]','click',function (e) {
		$("#verHistorialPlanD").modal('show');
		$("#DatosPlanD").show('slow');
		$("#ActualizacionesPlanD").hide('slow');
		$("#FechaCreacionLabel").empty();
		$("#HistorialNumeroPlan").empty();
		$("#HistorialNumeroPlan2").empty();
		$("#HistorialNumeroPlan3").empty();
		$('#archivoWordVH').attr('href','');
		$('#archivoExcelVH').attr('href','');
		$("#ObservacionMetodologoVH").val('');
		$("#ObservacionEntrenadorVH").val('');
		$("#Id_PlanAnterior").val();
		$.get("getPlanUnico/"+ $(this).val(), function (PlanUnico) {			
			$("#Id_PlanAnterior").val(PlanUnico['Id']);
			$("#HistorialNumeroPlan").append(PlanUnico['Numero_Plan']);
			$("#HistorialNumeroPlan2").append(PlanUnico['Numero_Plan']);
			$("#HistorialNumeroPlan3").append(PlanUnico['Numero_Plan']);
			$("#FechaCreacionLabel").append(' Número '+PlanUnico['Numero_Plan']+' del: '+PlanUnico['created_at']);
			$('#archivoWordVH').attr('href','public/'+PlanUnico['Url_Word']);
			$('#archivoExcelVH').attr('href','public/'+PlanUnico['Url_Excel']);
			$("#ObservacionMetodologoVH").val(PlanUnico['Observacion_Metodologo']);
			$("#ObservacionEntrenadorVH").val(PlanUnico['Observacion_Entrenador']);
		});		
	});

	$("#DatosPlan").on('click', function(){
		$("#DatosPlanD").show('slow');
		$("#DatosPlanLi").addClass('active');
		$("#ActualizacionesPlanD").hide('slow');
		$("#ActualizacionesPlanLi").removeClass('active');
	});

	$("#ActualizacionesPlan").on('click', function(){
		$("#DatosPlanD").hide('slow');
		$("#DatosPlanLi").removeClass('active');
		$("#ActualizacionesPlanD").show('slow');
		$("#ActualizacionesPlanLi").addClass('active');
		$.get("getHistorialPlanActual/"+ $("#Id_PlanAnterior").val(), function (HistorialVersionesPlanAnterior) {			
			var t = $('#HistorialVersionesAnterioresT').DataTable();
	            t.row.add( ['1', '1', '1', '1', '1', '1'] ).clear().draw( false );
	            $.each(HistorialVersionesPlanAnterior, function(i, e){
	            	$OM = '';
	            	$OE = '';
	            	var Fecha = e['created_at'];
	            	Fechas = Fecha.split(" ");

	            	if(e['Observacion_Metodologo'] != null){
	            		$OM = e['Observacion_Metodologo'];
	            	}else{
	            		$OM = 'No existe';
	            	}
	            	if(e['ObservacionEntrenador'] != null){
	            		$OE = e['ObservacionEntrenador'];
	            	}else{
	            		$OE = 'No existe';
	            	}
	    			t.row.add( [
	    				e['Numero_Version'],
	    				Fechas[0],
	    				'<a id="archivoExcelVH" href="public'+e['Url_Word']+'" download><img border="0" src="public/Img/downloadicon.gif" alt="W3Schools" ></a>',
	    				'<a id="archivoExcelVH" href="public'+e['Url_Excel']+'" download><img border="0" src="public/Img/downloadicon.gif" alt="W3Schools" ></a>',
	    				$OM,
	    				$OE,
			        ] ).draw( false );
	    		});
		});
	});

	$("#AgregarObservaciones").on('click', function(){
		var formData = new FormData($("#VerPlanF")[0]);
        var token = $("#token").val();	

		$.ajax({
            type: 'POST',
            url: 'addObservaciones',
            headers: {'X-CSRF-TOKEN': token},
            data: formData,
            contentType: false,
            processData: false,
            ataType: "json",
            success: function (xhr) { 
            	$("#Parte2VP").show('slow');
            	if(xhr.status == 'error'){
					validador_erroresV(xhr.errors);
				}
            	if(xhr.Estado == 'Error'){
					$('#MensajeVerPlan').html('<div class="alert alert-dismissible alert-danger" ><strong>Error! </strong>'+xhr.Mensaje+'</div>');
					$('#MensajeVerPlan').show(60);
					setTimeout(function(){ 
				        $('#MensajeVerPlan').hide('slow');	
				        $("#Parte2VP").hide('slow');
				      }, 2000); 
				}
				else if(xhr.Estado == 'Success')
				{
					$('#MensajeVerPlan').html('<div class="alert alert-dismissible alert-success" ><strong>Exito! </strong>'+xhr.Mensaje+'</div>');
					$('#MensajeVerPlan').show(60);

					setTimeout(function(){ 
				        $('#MensajeVerPlan').hide('slow');	
				        $("#Parte2VP").hide('slow');
				      }, 2000);   

					$('#VerPlanF .form-group').removeClass('has-error');
				}           	
            }
        });
	});

	$("#AgregarPlan").on('click', function(){
		var formData = new FormData($("#AgregarPlanF")[0]);
        var token = $("#token").val();	

		$.ajax({
            type: 'POST',
            url: 'addPlanEntrenamiento',
            headers: {'X-CSRF-TOKEN': token},
            data: formData,
            contentType: false,
            processData: false,
            ataType: "json",
            success: function (xhr) {              	            	
            	if(xhr.status == 'error'){
					validador_errores(xhr.errors);
				}
            	if(xhr.Estado == 'Error'){
					$('#MensajeAgregarPlan').html('<div class="alert alert-dismissible alert-danger" ><strong>Error! </strong>'+xhr.Mensaje+'</div>');
					$('#MensajeAgregarPlan').show(60);
					$('#MensajeAgregarPlan').delay(2000).hide(600);	
				}
				else if(xhr.Estado == 'Success')
				{
					$('#MensajeAgregarPlan').html('<div class="alert alert-dismissible alert-success" ><strong>Exito! </strong>'+xhr.Mensaje+'</div>');
					$('#MensajeAgregarPlan').show(60);
					$('#MensajeAgregarPlan').delay(2000).hide(600);	

					$('#AgregarPlanF .form-group').removeClass('has-error');					
					document.getElementById("AgregarPlanF").reset();
				}            	
            }
        });
	});

	var validador_errores = function(data){
		$('#AgregarPlanF .form-group').removeClass('has-error');		
		$.each(data, function(i, e){
			$("#"+i).closest('.form-group').addClass('has-error');
      	});
	}

	var validador_erroresV = function(data){
		$('#VerPlanF .form-group').removeClass('has-error');		
		$.each(data, function(i, e){
			$("#"+i).closest('.form-group').addClass('has-error');
      	});
	}

	var validador_erroresVersion = function(data){
		$('#VerUltimaVersionF .form-group').removeClass('has-error');		
		$.each(data, function(i, e){
			$("#"+i).closest('.form-group').addClass('has-error');
      	});
	}

	var validador_erroresActualizacion = function(data){
		$('#AgregarActualizacionF .form-group').removeClass('has-error');		
		$.each(data, function(i, e){
			$("#"+i).closest('.form-group').addClass('has-error');
      	});
	}		

	$("#DatosPlanActual").on('click', function(){
		$("#DatosPlanActualD").show('slow');
		$("#DatosPlanActualLi").addClass('active');
		$("#ActualizarPlanActualD").hide('slow');
		$("#ActualizarPlanActualLi").removeClass('active');
		$("#HistorialPlanActualD").hide('slow');
		$("#HistorialPlanActualLi").removeClass('active');
		$("#UltimaActualizacionD").hide('slow');
		$("#UltimaActualizacionLi").removeClass('active');
	});

	$("#ActualizarPlanActual").on('click', function(){
		$("#DatosPlanActualD").hide('slow');
		$("#DatosPlanActualLi").removeClass('active');
		$("#ActualizarPlanActualD").show('slow');
		$("#ActualizarPlanActualLi").addClass('active');
		$("#HistorialPlanActualD").hide('slow');
		$("#HistorialPlanActualLi").removeClass('active');
		$("#UltimaActualizacionD").hide('slow');
		$("#UltimaActualizacionLi").removeClass('active');
	});

	$("#HistorialPlanActual").on('click', function(){
		$("#DatosPlanActualD").hide('slow');
		$("#DatosPlanActualLi").removeClass('active');
		$("#ActualizarPlanActualD").hide('slow');
		$("#ActualizarPlanActualLi").removeClass('active');
		$("#HistorialPlanActualD").show('slow');
		$("#HistorialPlanActualLi").addClass('active');
		$("#UltimaActualizacionD").hide('slow');
		$("#UltimaActualizacionLi").removeClass('active');
		$.get("getHistorialPlanActual/"+$("#Id_PLanActual").val(), function (HistorialPlanActual) {
			if(HistorialPlanActual != null){				
				var t = $('#HistorialPlanActualT').DataTable();
	            t.row.add( ['1', '1', '1'] ).clear().draw( false );
	            $.each(HistorialPlanActual, function(i, e){
	    			t.row.add( [
	    				e['Numero_Version'],
	    				e['created_at'],
			            '<button type="button" class="btn btn-primary" data-funcion="VerPlanActualHistorial" id="VerPlanActualHistorial" value="'+e['Id']+'">Ver Actualización</button>',
			        ] ).draw( false );
	    		});
	        }else{

	        }
		});
	});

	$("#UltimaActualizacion").on('click', function(){
		$("#DatosPlanActualD").hide('slow');
		$("#DatosPlanActualLi").removeClass('active');
		$("#ActualizarPlanActualD").hide('slow');
		$("#ActualizarPlanActualLi").removeClass('active');
		$("#HistorialPlanActualD").hide('slow');
		$("#HistorialPlanActualLi").removeClass('active');
		$("#UltimaActualizacionD").show('slow');
		$("#UltimaActualizacionLi").addClass('active');
		$("#Parte1UV").hide('slow');
		$("#Parte2UV").hide('slow');
		$.get("getVersionActual/"+$("#Id_PLanActual").val(), function (UltimaVersion) {
			if(UltimaVersion){
				$("#Parte1UV").show('slow');
				$("#Parte2UV").hide('slow');
				$("#Fecha_CreacionUV").empty();
				$("#Id_UltimaVersion").val(UltimaVersion['Id']);
				$("#Fecha_CreacionUV").append(UltimaVersion['created_at']);
				$('#archivoWordUV').attr('href','public/'+UltimaVersion['Url_Word']);
				$('#archivoExcelUV').attr('href','public/'+UltimaVersion['Url_Excel']);
				if(UltimaVersion['Observacion_Metodologo'] != null){
					$("#ObservacionMetodologoUV").val(UltimaVersion['Observacion_Metodologo']);
					$('#ObservacionMetodologoUV').attr('readonly', true);
				}else{
					$('#ObservacionMetodologoUV').attr('readonly',false);
				}
				if(UltimaVersion['Observacion_Entrenador'] != null){
					$("#ObservacionEntrenadorUV").val(UltimaVersion['Observacion_Entrenador']);
					$('#ObservacionEntrenadorUV').attr('readonly',true);
				}else{
					$('#ObservacionEntrenadorUV').attr('readonly', false);
				}

				if($("#ObservacionMetodologoUV").val() != '' && $("#ObservacionEntrenadorUV").val() != ''){
					$("#AgregarObservacionesUV").hide('slow');
				}
			}else{
				$("#Parte1UV").hide('slow');
				$("#Parte2UV").show('slow');
				$('#MensajeVerUltimaVersion').html('<div class="alert alert-dismissible alert-danger" ><strong>Error! </strong>Este plan de entrenamiento aún no cuenta con una actualización!</div>');				
			}
		});
	});

	$("#AgregarObservacionesUV").on('click', function(){
		var formData = new FormData($("#VerUltimaVersionF")[0]);
        var token = $("#token").val();	

		$.ajax({
            type: 'POST',
            url: 'addObservacionesVersion',
            headers: {'X-CSRF-TOKEN': token},
            data: formData,
            contentType: false,
            processData: false,
            ataType: "json",
            success: function (xhr) { 
            	$("#Parte2UV").show('slow');
            	if(xhr.status == 'error'){
					validador_erroresVersion(xhr.errors);
				}
            	if(xhr.Estado == 'Error'){            		
					$('#MensajeVerUltimaVersion').html('<div class="alert alert-dismissible alert-danger" ><strong>Error! </strong>'+xhr.Mensaje+'</div>');
					$('#MensajeVerUltimaVersion').show(60);

					setTimeout(function(){ 
				        $('#MensajeVerUltimaVersion').hide('slow');	
				        $("#Parte2UV").hide('slow');
				    }, 2000);   
				}
				else if(xhr.Estado == 'Success'){
					$('#MensajeVerUltimaVersion').html('<div class="alert alert-dismissible alert-success" ><strong>Exito! </strong>'+xhr.Mensaje+'</div>');
					$('#MensajeVerUltimaVersion').show(60);

					setTimeout(function(){ 
				        $('#MensajeVerUltimaVersion').hide('slow');	
				        $("#Parte2UV").hide('slow');
				    }, 2000);   

					$('#VerUltimaVersionF .form-group').removeClass('has-error');
				}           	
            }
        });
	});

	$('#HistorialPlanActualT').delegate('button[data-funcion="VerPlanActualHistorial"]','click',function (e) {
		$("#EspecificoD").hide('slow');
		$("#EspecificoD").show('slow');

		$("#NumeroActualizacionL").empty();
		$('#archivoWordVersion').attr('href','');
		$('#archivoExcelVersion').attr('');
		$("#ObservacionMetodologoVersion").val('');
		$("#ObservacionEntrenadorVersion").val('');

		$.get("getVersionUnica/"+$(this).val(), function (VersionUnica) {

			$("#NumeroActualizacionL").append(VersionUnica['Numero_Version']);
			$('#archivoWordVersion').attr('href','public/'+VersionUnica['Url_Word']);
			$('#archivoExcelVersion').attr('href','public/'+VersionUnica['Url_Excel']);

			if(VersionUnica['Observacion_Metodologo'] != null){				
				$("#ObservacionMetodologoVersion").val(VersionUnica['Observacion_Metodologo']);
				$('#ObservacionMetodologoVersion').show('slow');
				$('#ObservacionMetodologoVersionL').show('slow');
			}else{
				$('#ObservacionMetodologoVersion').hide('slow');
				$('#ObservacionMetodologoVersionL').hide('slow');
			}
			if(VersionUnica['Observacion_Entrenador'] != null){
				$("#ObservacionEntrenadorVersion").val(VersionUnica['Observacion_Entrenador']);
				$('#ObservacionEntrenadorVersion').show('slow');
				$('#ObservacionEntrenadorVersionL').show('slow');
			}else{
				$('#ObservacionEntrenadorVersion').hide('slow');
				$('#ObservacionEntrenadorVersionL').hide('slow');
			}
		});		
	});

	$("#AgregarPlanActualizacion").on('click', function(){
		var formData = new FormData($("#AgregarActualizacionF")[0]);
        var token = $("#token").val();	

		$.ajax({
            type: 'POST',
            url: 'addPlanEntrenamientoActualizacion',
            headers: {'X-CSRF-TOKEN': token},
            data: formData,
            contentType: false,
            processData: false,
            ataType: "json",
            success: function (xhr) {       
            	if(xhr.status == 'error'){
					validador_erroresActualizacion(xhr.errors);
				}
            	if(xhr.Estado == 'Error'){
					$('#MensajeAgregarPlanActualizacion').html('<div class="alert alert-dismissible alert-danger" ><strong>Error! </strong>'+xhr.Mensaje+'</div>');
					$('#MensajeAgregarPlanActualizacion').show(60);
					$('#MensajeAgregarPlanActualizacion').delay(2000).hide(600);	
				}
				else if(xhr.Estado == 'Success'){
					$('#MensajeAgregarPlanActualizacion').html('<div class="alert alert-dismissible alert-success" ><strong>Exito! </strong>'+xhr.Mensaje+'</div>');
					$('#MensajeAgregarPlanActualizacion').show(60);
					$('#MensajeAgregarPlanActualizacion').delay(2000).hide(600);	

					$('#AgregarActualizacionF .form-group').removeClass('has-error');					
					document.getElementById("AgregarActualizacionF").reset();
            	}
            }
        });
	});
});

function Buscar(e){	
	var key = $('input[name="buscador"]').val(); 
	$.get('buscarTipoPersonaRUD/'+key,{}, function(TipoPersona){  
		if(TipoPersona.Respuesta == 2){
			$('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
            $('#buscar span').empty();
            document.getElementById("buscar").disabled = false;
            $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">'+TipoPersona.Mensaje+'</h4></dvi><br>');
            $('#paginador').fadeOut();
		}else{
		    $.get('personaBuscarDeportista/'+key,{}, function(PersonaData){  

		        if(PersonaData.length > 0){       
		        	$("#persona").val(PersonaData[0]['Id_Persona']);        	
		        	$("#Nombres").val(PersonaData[0]['Primer_Nombre']+' '+PersonaData[0]['Segundo_Nombre']);        	
					$("#Apellidos").val(PersonaData[0]['Primer_Apellido']+' '+PersonaData[0]['Segundo_Apellido']);

					$("#NombresCompromiso").empty();
					$("#NombresCompromiso").append(PersonaData[0]['Primer_Nombre']+' '+PersonaData[0]['Segundo_Nombre'] +' '+PersonaData[0]['Primer_Apellido']+' '+PersonaData[0]['Segundo_Apellido']);
					$("#TipoDocumento").val(PersonaData[0].tipo_documento['Descripcion_TipoDocumento']);
					$("#NumeroDocumento").val(PersonaData[0]['Cedula']);
					$("#fechaNac").val(PersonaData[0]['Fecha_Nacimiento']);
					$("#PaisNac").val(PersonaData[0]['Id_Pais']);
					$("#MunicipioNac").val(PersonaData[0]['Nombre_Ciudad']);
					$("#Genero").val(PersonaData[0]['Id_Genero']);

					$("#Nombres").attr("disabled", "disabled");
					$("#Apellidos").attr("disabled", "disabled");
					$("#TipoDocumento").attr("disabled", "disabled");
					$("#NumeroDocumento").attr("disabled", "disabled");
					$("#fechaNac").attr("disabled", "disabled");
					$("#PaisNac").attr("disabled", "disabled");
					$("#MunicipioNac").attr("disabled", "disabled");
					$("#Genero").attr("disabled", "disabled");

		          	$.each(PersonaData, function(i, e){

		              	$.get("deportista/" + e['Id_Persona'] + "", function (deportistaData) {   
		              		if(deportistaData.deportista != null){
		              			$("#Id_Deportista").val(deportistaData.deportista['Id']);
		              		}

		              		$("#Id_Persona").val(PersonaData[0]['Id_Persona']);
				            $("#Nombres").append(PersonaData[0]['Primer_Nombre']+' '+PersonaData[0]['Segundo_Nombre']+' '+PersonaData[0]['Primer_Apellido']+' '+PersonaData[0]['Segundo_Apellido']);
				            $("#Identificacion").append('IDENTIFICACIÓN '+PersonaData[0]['Cedula']);
				            $("#GestorDeportistas").show('slow'); 

		             	}).done(function (){             		
		                    $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
		                    $('#buscar span').empty();
		                 	document.getElementById("buscar").disabled = false;     
		                 	$("#camposRegistro").show('slow');            	
		      			});
		          	});
		        }else{    
		            $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
		            $('#buscar span').empty();
		            document.getElementById("buscar").disabled = false;
		            $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">No se encuentra ninguna persona registrada con estos datos.</h4></dvi><br>');
		            $('#paginador').fadeOut();
		        }        
		    },
			'json'
		    );
		}
	});
}

function Reset_campos(e){
	$('#personas').html( '');
	$("#GestorDeportistas").hide('slow'); 
	$("#Nombres").empty();
	$("#Identificacion").empty();
	$("#AgregarNuevoPlanD").hide('slow');
}