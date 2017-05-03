var agrupacionT = '';
var deporteT = '';
var modalidadT = '';
var clasificacionT = '';

$(function(e){ 
	$("#Diagnostico").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 1){
				 $("#OtroDiagnostico").show('slow');
			}else{
				$("#OtroDiagnostico").hide('slow')
			}
		}
	});

	$("#Silla").on('change', function(){
		if($(this).val() != ''){
				if($(this).val() == 1){
					 $("#OtroSilla").show('slow');
				}else{
					$("#OtroSilla").hide('slow')
				}
			}
	});

	$("#ClasificadoNivelInternacional").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 1){
				 $("#OtroClasificadoNivelInternacional").show('slow');
			}else{
				$("#OtroClasificadoNivelInternacional").hide('slow')
			}
		}
	});

	$("#Registrar").on('click', function(){				
		registro('AddDeportista');
	});

	$("#Modificar").on('click', function(){
		registro('EditDeportista');
	});    

	function registro (url){	
		if($("#Resolucion").is(":checked") == true){
			var Resolucion = 1;
		}
		if($("#Deberes").is(":checked") == true){
			var Deberes = 1;
		}
		
        var formData = new FormData($("#registro")[0]);
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
            	$("#camposRegistro").hide('slow');
				$("#seccion_uno").hide("slow");
				$("#seccion_dos").hide("slow");
				$("#seccion_tres").hide("slow");
				$("#seccion_cuatro").hide("slow");
				$("#seccion_cinco").hide("slow");
				$("#seccion_compromiso").hide("slow");
            	$("#loading").show('slow');
            }, 
            success: function (xhr) {              	
            	$("#loading").hide('slow');
            	$('#FotografiaDep').removeClass('imagen-error');
            	if(xhr.status == 'error')
				{
					$("#camposRegistro").show('slow');
	            	$("#loading").hide('slow');
					validador_errores(xhr.errors);
					$('#FotografiaDep').addClass('imagen-error');
					return false;
				}
				else 
				{
					$('#alert_actividad').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
					$('#mensaje_actividad').show(60);
					$('#mensaje_actividad').delay(2000).hide(600);				
					Reset_campos();
				}
            	
            },
            error: function (xhr){            	
            	$("#camposRegistro").show('slow');
            	$("#loading").hide('slow');
				validador_errores(xhr.responseJSON);
            }
        });
	}

	$.datepicker.setDefaults($.datepicker.regional["es"]);
	
	$('#FechaExpedicionDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaVigenciaPasaporteDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#fechaNacDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaAfiliacionDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaCI').datepicker({format: 'yyyy-mm-dd', autoclose: true,});

	var validador_errores = function(data){
		$('#registro .form-group').removeClass('has-error');
		$("#seccion_uno").show("slow");
		$("#seccion_dos").show("slow");
		$("#seccion_tres").show("slow");
		$("#seccion_cuatro").show("slow");
		$("#seccion_cinco").show("slow");
		$("#seccion_compromiso").show("slow");

		$.each(data, function(i, e){
			$("#"+i).closest('.form-group').addClass('has-error');
      	});
	}

	$("#seccion_compromiso_ver").on('click', function(e){
		var role = $(this).data('role');               
		if(role == 'ver'){
			$("#seccion_compromiso").show("slow");
			$(this).data('role', 'ocultar');
			$('#seccion_compromiso_ver').removeClass('glyphicon-resize-full').addClass('glyphicon-resize-small');
		}else if(role == 'ocultar'){
			$("#seccion_compromiso").hide("slow");
			$(this).data('role', 'ver');
			$('#seccion_compromiso_ver').removeClass('glyphicon-resize-small').addClass('glyphicon-resize-full');
		}				
	});

	$("#Tenis").on('change',function (e){
		if($("#Tenis").val() != ''){			
			$.get("TallaTenis/"+$("#Tenis").val(), function (tallaTenis) { 
				$("#TallaTenis").show('slow');
				$("#TUK").empty();
				$("#TUSA").empty();
				$("#TUK").append(tallaTenis['Uk']);	        
				$("#TUSA").append(tallaTenis['Usa']);	        
		    });
		}else{
			$("#TallaTenis").hide('slow');
			$("#TUK").empty();
			$("#TUSA").empty();
		}
	});

	$("#RiesgosLaborales").on('change',function (e){
		var id = $("#RiesgosLaborales").val();
		if(id==1){			
			$("#ArlD").show("slow");
		}else if(id == 2){
			$("#ArlD").hide("slow");
		}
	});

	$("#FondoPensionPreg").on('change',function (e){
		var id = $("#FondoPensionPreg").val();
		if(id==1){			
			$("#FondoPensionD").show("slow");
		}else if(id == 2){
			$("#FondoPensionD").hide("slow");
		}
	});

	$("#Regimen").on('change',function (e){
		var id = $("#Regimen").val();
		if(id==2){			
			$("#NivelRegimenD").show("slow");
		}else{
			$("#NivelRegimenD").hide("slow");
		}
	});

	$("#Medicamento").on('change',function (e){
		var id = $("#Medicamento").val();
		if(id==1){			
			$("#MedicamentoD").show("slow");
		}else if(id == 2){
			$("#MedicamentoD").hide("slow");
		}
	});
	
	$("#OtroMedicoPreg").on('change',function (e){
		var id = $("#OtroMedicoPreg").val();
		if(id==1){			
			$("#OtroMedicoD").show("slow");
		}else if(id == 2){
			$("#OtroMedicoD").hide("slow");
		}
	});

	$("#MedicinaPrepago").on('change',function (e){
		var id = $("#MedicinaPrepago").val();
		if(id==1){			
			$("#MedicinaPrepagoD").show("slow");
			$("#MedicinaPrepagoE").hide("slow");
		}else if(id == 2){
			$("#MedicinaPrepagoD").hide("slow");
			$("#MedicinaPrepagoE").show("slow");
		}
	});
	
	$("#LibretaPreg").on('change',function (e){
		var id = $("#LibretaPreg").val();
		if(id==1){			
			$("#militares").show("slow");
		}else if(id == 2){
			$("#militares").hide("slow");
		}
	});

	$("#ClasificacionDeportista").on('change',function (e){
		$("#Agrupacion").empty();
		$("#Deporte").empty();
		$("#Modalidad").empty();

		$("#Agrupacion").append("<option value=''>Seleccionar</option>");
		$("#Deporte").append("<option value=''>Seleccionar</option>");
		$("#Modalidad").append("<option value=''>Seleccionar</option>");

		var id = $("#ClasificacionDeportista").val();
		if(id != ''){
			
			$.get("getEtapas/" + id, function (etapas) {
				$("#EtapaNacional").empty();
				$("#EtapaInternacional").empty();
				$("#EtapaNacional").append("<option value=''>Seleccionar</option>");
				$("#EtapaInternacional").append("<option value=''>Seleccionar</option>");

				$.each(etapas['Nacional'], function(i, e){
					$("#EtapaNacional").append("<option value='"+e['Id']+"'>"+e['Nombre_Etapa']+"</option>");
				});

				$.each(etapas['Internacional'], function(i, e){
					$("#EtapaInternacional").append("<option value='"+e['Id']+"'>"+e['Nombre_Etapa']+"</option>");
				});
			}).done(function (){
				$("#EtapaNacional").val($("#EtapaNacionalT").val());
				$("#EtapaInternacional").val($("#EtapaInternacionalT").val());
			});
		}
		if($(this).val() == 2){
			$.get("getAgrupacion/" + id, function (agrupacion) {
				$.each(agrupacion.agrupacion, function(i, e){
					$("#AgrupacionP").append("<option value='" +e.Id + "'>" + e.Nombre_Agrupacion + "</option>");
				});				
			}).done(function(){
				$("#AgrupacionP").val(agrupacionT).change();
				agrupacionT = '';
			});

			$("#SeccionSeisD").show('slow');
			$("#CamposParalimpico").show('slow');
			$("#CamposConvencional").hide('slow');

		}else{
			$.get("getAgrupacion/" + id, function (agrupacion) {
				$.each(agrupacion.agrupacion, function(i, e){
					$("#Agrupacion").append("<option value='" +e.Id + "'>" + e.Nombre_Agrupacion + "</option>");
				});				
			}).done(function(){
				$("#Agrupacion").val(agrupacionT).change();
				agrupacionT = '';
			});

			$("#SeccionSeisD").hide('slow');
			$("#CamposParalimpico").hide('slow');
			$("#CamposConvencional").show('slow');
		}
	});

	$("#Pertenece").on('change', function(){
		id = $("#Pertenece").val();
		if(id == 1){
			$("#DeportistaEtapas").show('slow');
		}else if(id == 2){
			$("#DeportistaEtapas").hide('slow');
		}
	});

	$("#Agrupacion").on('change',function (e){
		$("#Deporte").empty();
		$("#Modalidad").empty();

		$("#Deporte").append("<option value=''>Seleccionar</option>");
		$("#Modalidad").append("<option value=''>Seleccionar</option>");

		var id = $("#Agrupacion").val();
		if(id != ''){
			$.get("getDeporte/" + id, function (deporte) {
				$.each(deporte.deporte, function(i, e){
					$("#Deporte").append("<option value='" +e.Id + "'>" + e.Nombre_Deporte + "</option>");
				});				
			}).done(function(){
				$("#Deporte").val(deporteT).change();
				deporteT = '';
			});
		}		
	});

	$("#AgrupacionP").on('change',function (e){
		$("#DeporteP").empty();
		$("#ModalidadP").empty();

		$("#DeporteP").append("<option value=''>Seleccionar</option>");
		$("#ModalidadP").append("<option value=''>Seleccionar</option>");

		var id_discapacidad = $("#Discapacidad").val();
		var id_agrupacion = $("#AgrupacionP").val();
		if(id_agrupacion != ''){
			if($("#AgrupacionP").val() != ''){
				$.get("getDeporteParalimpico/"+id_agrupacion+"/"+id_discapacidad, function (deporteParalimpico) {
					$.each(deporteParalimpico, function(i, e){
						$("#DeporteP").append("<option value='" +e.Id + "'>" + e.Nombre_Deporte + "</option>");
					});
				}).done(function(){
					$("#DeporteP").val(deporteT).change();
					deporteT = '';
				});
			}
		}		
	});

	$("#Discapacidad").on('change',function (e){
		$("#DeporteP").empty();
		$("#ModalidadP").empty();

		$("#DeporteP").append("<option value=''>Seleccionar</option>");
		$("#ModalidadP").append("<option value=''>Seleccionar</option>");

		var id_discapacidad = $("#Discapacidad").val();
		var id_agrupacion = $("#AgrupacionP").val();
		if(id_discapacidad != ''){
			if($("#AgrupacionP").val() != ''){
				$.get("getDeporteParalimpico/"+id_agrupacion+"/"+id_discapacidad, function (deporteParalimpico) {
					$.each(deporteParalimpico, function(i, e){
						$("#DeporteP").append("<option value='" +e.Id + "'>" + e.Nombre_Deporte + "</option>");
					});
				}).done(function(){
					$("#DeporteP").val(deporteT).change();
					deporteT = '';
				});
			}
		}		
	});

	$("#Deporte").on('change',function (e){
		$("#Liga").empty();
		$("#Liga").append($("#Deporte option:selected").text());
		$("#Modalidad").empty();
		$("#Modalidad").append("<option value=''>Seleccionar</option>");

		var id = $("#Deporte").val();
		if(id != ''){
			$.get("getModalidad/" + id, function (modalidad) {
				$.each(modalidad.modalidad, function(i, e){
					$("#Modalidad").append("<option value='" +e.Id + "'>" + e.Nombre_Modalidad + "</option>");
				});				
			}).done(function(){
				$("#Modalidad").val(modalidadT).change();
				modalidadT = '';
			});
		}		
	});

	$("#DeporteP").on('change',function (e){
		$("#ModalidadP").empty();
		$("#ModalidadP").append("<option value=''>Seleccionar</option>");

		var id = $("#DeporteP").val();
		if(id != ''){
			$.get("getModalidad/" + id, function (modalidad) {
				$.each(modalidad.modalidad, function(i, e){
					$("#ModalidadP").append("<option value='" +e.Id + "'>" + e.Nombre_Modalidad + "</option>");
				});				
			}).done(function(){
				$("#ModalidadP").val(modalidadT).change();
				modalidadT = '';
			});
		}		
	});

	$("#ModalidadP").on('change',function (e){
		$("#ClasificacionFuncional").empty();
		$("#ClasificacionFuncional").append("<option value=''>Seleccionar</option>");
		var id = $("#ModalidadP").val();
		if(id != ''){
			$.get("getClasificacionFuncional/" + id, function (Modalidad) {
				if(Modalidad != null){
					$.each(Modalidad, function(i, e){
						console.log(e);
						$("#ClasificacionFuncional").append("<option value='" +e['Id'] + "'>" + e['Nombre_Clasificacion_Funcional'] + "</option>");
					});
				}
			}).done(function(){
				$("#ClasificacionFuncional").val(clasificacionT).change();
				clasificacionT = '';
			});
		}
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
		    $.get('personaBuscarDeportista/'+key,{}, function(data){  

		        if(data.length > 0){       
		        	$("#persona").val(data[0]['Id_Persona']);        	
		        	$("#Nombres").val(data[0]['Primer_Nombre']+' '+data[0]['Segundo_Nombre']);        	
					$("#Apellidos").val(data[0]['Primer_Apellido']+' '+data[0]['Segundo_Apellido']);

					$("#NombresCompromiso").empty();
					$("#NombresCompromiso").append(data[0]['Primer_Nombre']+' '+data[0]['Segundo_Nombre'] +' '+data[0]['Primer_Apellido']+' '+data[0]['Segundo_Apellido']);
					$("#TipoDocumento").val(data[0].tipo_documento['Descripcion_TipoDocumento']);
					$("#NumeroDocumento").val(data[0]['Cedula']);
					$("#fechaNac").val(data[0]['Fecha_Nacimiento']);
					$("#PaisNac").val(data[0]['Id_Pais']);
					$("#MunicipioNac").val(data[0]['Nombre_Ciudad']);
					$("#Genero").val(data[0]['Id_Genero']);

					$("#Nombres").attr("disabled", "disabled");
					$("#Apellidos").attr("disabled", "disabled");
					$("#TipoDocumento").attr("disabled", "disabled");
					$("#NumeroDocumento").attr("disabled", "disabled");
					$("#fechaNac").attr("disabled", "disabled");
					$("#PaisNac").attr("disabled", "disabled");
					$("#MunicipioNac").attr("disabled", "disabled");
					$("#Genero").attr("disabled", "disabled");

					ShowRopa(data[0]['Id_Genero'], 1);
					ShowZapatos(data[0]['Id_Genero'], 2);			
		          	document.getElementById("RUD").style.display = "block";

		          	$.each(data, function(i, e){

		              	$.get("deportista/" + e['Id_Persona'] + "", function (responseDep) {       

		              		if(responseDep.deportista){  //Cuando Hay deportista    

		              			$.get("getDeportistaDeporte/" + responseDep.deportista['Id'] + "", function (DeportistaDeporte) {     
		              				agrupacionT = DeportistaDeporte['Agrupacion_Id'];
		              				deporteT = DeportistaDeporte['Deporte_Id'];
		              				modalidadT =DeportistaDeporte['Modalidad_Id'];

		              				$("#Club").val(DeportistaDeporte['Club_Id']);   
		              				$('#Club').selectpicker('refresh');           				
		              			}).done(function(){
		              				$("#ClasificacionDeportista").val(responseDep.deportista['Clasificacion_Deportista_Id']).change();              				
		              			});

		              			if(responseDep.deportista['Pertenece'] == 1){
			          				$.get("getEtapasD/" + responseDep.deportista['Id'] + "", function (DeportistaEtapa) {     		
										$("#EtapaNacionalT").val(DeportistaEtapa.Nacional.pivot['Etapa_Id']);
										$("#EtapaInternacionalT").val(DeportistaEtapa.Internacional.pivot['Etapa_Id']);
										$("#Smmlv").val(DeportistaEtapa.Internacional.pivot['Smmlv']);								
			          				});
			          			} 

		          				ShowRopa(data[0]['Id_Genero'], 1, responseDep.deportista['Sudadera_Talla_Id'], responseDep.deportista['Camiseta_Talla_Id'], responseDep.deportista['Pantaloneta_Talla_Id']);
								ShowZapatos(data[0]['Id_Genero'], 2, responseDep.deportista['Tenis_Talla_Id']);

								$("#Resolucion").prop('checked', true);
								$("#Deberes").prop('checked', true);
								
								if(responseDep.deportista['Archivo1_Url'] != ''){
									$("#SImagen").empty();
									$("#SImagen").append("<img id='Fotografia' src='' alt='' class='img-thumbnail'>");
		                			$("#Fotografia").attr('src',$("#Fotografia").attr('src')+'public/Img/Fotografias/'+responseDep.deportista['Archivo1_Url']+'?' + (new Date()).getTime());
								}else{
									$("#Fotografia").hide();
								}
								$("#Pertenece").val(responseDep.deportista['Pertenece']).change();		
		          				$("#deportista").val(responseDep.deportista['Id']);						
		          				//$("#DescargaH").val(responseDep.deportista['Id']);						
		          				//$("#DescargaH").attr("href", "Descarga/"+responseDep.deportista['Id'])
		          				//$("#DescargaH").attr("href", "rudPDF")          				
		          				//$("#DescargaH").attr("href", "Descarga/"+responseDep.deportista['Id']);
								$("#LugarExpedicion").val(responseDep.deportista['Lugar_Expedicion_Id']);
								$("#FechaExpedicion").val(responseDep.deportista['Fecha_Expedicion']);
								$("#Pasaporte").val(responseDep.deportista['Numero_Pasaporte']);
								$("#FechaVigenciaPasaporte").val(responseDep.deportista['Fecha_Pasaporte']);
								$("#EstadoCivil").val(responseDep.deportista['Estado_Civil_Id']);
								$("#Estrato").val(responseDep.deportista['Estrato_Id']);
								$("#DepartamentoNac").val(responseDep.deportista['Departamento_Id_Nac']);
								$("#LibretaPreg").val(responseDep.deportista['Libreta_Preg']).change();
								$("#Libreta").val(responseDep.deportista['Numero_Libreta_Mil']);
								$("#Distrito").val(responseDep.deportista['Distrito_Libreta_Mil']);
								$("#NombreContacto").val(responseDep.deportista['Nombre_Contacto']);
								$("#Parentesco").val(responseDep.deportista['Parentesco_Id']);
								$("#FijoContacto").val(responseDep.deportista['Fijo_Contacto']);
								$("#CelularContacto").val(responseDep.deportista['Celular_Contacto']);
								$("#TipoCuenta").val(responseDep.deportista['Tipo_Cuenta_Id']);
								$("#Banco").val(responseDep.deportista['Banco_Id']);
								$("#NumeroCuenta").val(responseDep.deportista['Numero_Cuenta']);
								$("#NumeroHijos").val(responseDep.deportista['Numero_Hijos']);
								$("#DepartamentoLoc").val(responseDep.deportista['Departamento_Id_Localiza']);
								$("#MunicipioLoc").val(responseDep.deportista['Ciudad_Id_Localiza']);
								$("#Direccion").val(responseDep.deportista['Direccion_Localiza']);
								$("#Barrio").val(responseDep.deportista['Barrio_Localiza']);
								$("#Localidad").val(responseDep.deportista['Localidad_Id_Localiza']);
								$("#FijoLoc").val(responseDep.deportista['Fijo_Localiza']);
								$("#CelularLoc").val(responseDep.deportista['Celular_Localiza']);
								$("#Correo").val(responseDep.deportista['Correo_Electronico']);
								$("#Regimen").val(responseDep.deportista['Regimen_Salud_Id']).change();
								$("#FechaAfiliacion").val(responseDep.deportista['Fecha_Afiliacion']);
								$("#TipoAfiliacion").val(responseDep.deportista['Tipo_Afiliacion_Id']);
								$("#MedicinaPrepago").val(responseDep.deportista['Medicina_Prepago']).change();
								$("#NombreMedicinaPrepago").val(responseDep.deportista['Nombre_MedicinaPrepago']);
								$("#Eps").val(responseDep.deportista['Eps_Id']);
								$("#NivelRegimen").val(responseDep.deportista['Nivel_Regimen_Sub_Id']);
								$("#RiesgosLaborales").val(responseDep.deportista['Riesgo_Laboral']);
								$("#Arl").val(responseDep.deportista['Arl_Id']);
								$("#FondoPensionPreg").val(responseDep.deportista['Fondo_PensionPreg_Id']).change();
								$("#FondoPension").val(responseDep.deportista['Fondo_Pension_Id']);
								
								$("#GrupoSanguineo").val(responseDep.deportista['Grupo_Sanguineo_Id']);
								$("#Medicamento").val(responseDep.deportista['Uso_Medicamento']).change();
								$("#CualMedicamento").val(responseDep.deportista['Medicamento']);
								$("#TiempoMedicamento").val(responseDep.deportista['Tiempo_Medicamento']);		
								$("#OtroMedicoPreg").val(responseDep.deportista['Otro_Medico_Preg']).change();
								$("#OtroMedico").val(responseDep.deportista['Otro_Medico']);


								if(responseDep.deportista.deportista_paralimpico[0] != null){
									$("#SeccionSeisD").show('slow');
									$("#Discapacidad").val(responseDep.deportista.deportista_paralimpico[0]['Discapacidad_Id']).change();
									$("#Diagnostico").val(responseDep.deportista.deportista_paralimpico[0]['Diagnostico_Id']).change();
									//$("#ClasificacionFuncional").val(responseDep.deportista.deportista_paralimpico[0]['Clasificacion_Funcional_Id']).change();
									clasificacionT =responseDep.deportista.deportista_paralimpico[0]['Clasificacion_Funcional_Id'];
									$("#Silla").val(responseDep.deportista.deportista_paralimpico[0]['Silla_Id']).change();
									$("#Cuidador").val(responseDep.deportista.deportista_paralimpico[0]['Uso_Silla_Id']).change();
									$("#Auxiliar").val(responseDep.deportista.deportista_paralimpico[0]['Auxiliar_Id']).change();
									$("#ClasificadoNivelInternacional").val(responseDep.deportista.deportista_paralimpico[0]['Clasificacion_Funcional_Internacional_Id']).change();
									$("#DiagnosticoEdad").val(responseDep.deportista.deportista_paralimpico[0]['EdadAdquirido']);
									$("#FechaCI").val(responseDep.deportista.deportista_paralimpico[0]['Fecha_Clasificacion']);
									$("#EventoCI").val(responseDep.deportista.deportista_paralimpico[0]['Evento_Clasificacion']);
									$("#EdadDeportiva").val(responseDep.deportista.deportista_paralimpico[0]['EdadDeportiva']).change();
									$("#resultadoNacional").val(responseDep.deportista.deportista_paralimpico[0]['Resultado_Nacional']).change();
									$("#resultadoInternacional").val(responseDep.deportista.deportista_paralimpico[0]['Resultado_Internacional']).change();
								}else{
									$("#SeccionSeisD").hide('slow');
								}
								
								$("#seccion_uno").show("slow");
								$("#seccion_dos").show("slow");
								$("#seccion_tres").show("slow");
								$("#seccion_cuatro").show("slow");
								$("#seccion_cinco").show("slow");
								$("#seccion_compromiso").show("slow");

								$("#Modificar").show();
		              			$("#Registrar").hide();


		              		}else{              			
		              			$("#Fotografia").hide();
		              			$("#Modificar").hide();
		              			$("#Registrar").show();
		              			
		              		}
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

function ShowRopa(id_genero, id_tipo, sudadera, camiseta,pantaloneta){
    $.get("getTallas/"+id_genero+"/"+id_tipo, function (tallasRopa) {        
        $("#Sudadera").empty();
        $("#Sudadera").append("<option value=''>Seleccionar</option>");
        $("#Camiseta").empty();
        $("#Camiseta").append("<option value=''>Seleccionar</option>");
        $("#Pantaloneta").empty();
        $("#Pantaloneta").append("<option value=''>Seleccionar</option>");
        
        $.each(tallasRopa, function(i, e){
            $('#Sudadera').append('<option value="'+ e.Id +'">'+ e.Usa +'</option>');
            $('#Camiseta').append('<option value="'+ e.Id +'">'+ e.Usa +'</option>');
            $('#Pantaloneta').append('<option value="'+ e.Id +'">'+ e.Usa +'</option>');
        });        
    }).done(function(){
    	$("#Sudadera").val(sudadera);
		$("#Camiseta").val(camiseta);
		$("#Pantaloneta").val(pantaloneta);
    });
}

function ShowZapatos(id_genero, id_tipo, tenis){
    $.get("getTallas/"+id_genero+"/"+id_tipo, function (tallasRopa) {        
        $("#Tenis").empty();
        $("#Tenis").append("<option value=''>Seleccionar</option>");
        
        $.each(tallasRopa, function(i, e){
            $('#Tenis').append('<option value="'+ e.Id +'">'+ e.Eu +'</option>');
        });        
    }).done(function(){
    	$("#Tenis").val(tenis).change();
    });
}

function Reset_campos(e){
	$('#personas').html( '');
	$("#camposRegistro").hide('slow');
	$("#seccion_uno").hide("slow");
	$("#seccion_dos").hide("slow");
	$("#seccion_tres").hide("slow");
	$("#seccion_cuatro").hide("slow");
	$("#seccion_cinco").hide("slow");
	$("#seccion_compromiso").hide("slow");

	$("#Resolucion").prop('checked', false);
	$("#Deberes").prop('checked', false);
	$("#Pertenece").val('').change();
	$("#EtapaNacionalT").val('');
	$("#EtapaInternacionalT").val('');
	$("#EtapaNacional").val('');
	$("#EtapaInternacional").val('');
	$("#Smmlv").val('');
	$("#Club").val('');
	$('#Club').selectpicker('refresh');
	$("#ClasificacionDeportista").val('').change();
	$("#LugarExpedicion").val('');
	$("#FechaExpedicion").val('');
	$("#Pasaporte").val('');
	$("#FechaVigenciaPasaporte").val('');
	$("#EstadoCivil").val('');
	$("#Estrato").val('');
	$("#DepartamentoNac").val('');
	$("#LibretaPreg").val('');
	$("#Libreta").val('');
	$("#Distrito").val('');
	$("#NombreContacto").val('');
	$("#Parentesco").val('');
	$("#FijoContacto").val('');
	$("#CelularContacto").val('');
	$("#TipoCuenta").val('');
	$("#Banco").val('');
	$("#NumeroCuenta").val('');
	$("#NumeroHijos").val('');
	$("#DepartamentoLoc").val('');
	$("#MunicipioLoc").val('');
	$("#Direccion").val('');
	$("#Barrio").val('');
	$("#Localidad").val('');
	$("#FijoLoc").val('');
	$("#CelularLoc").val('');
	$("#Correo").val('');
	$("#Regimen").val('').change();
	$("#FechaAfiliacion").val('');
	$("#TipoAfiliacion").val('');
	$("#MedicinaPrepago").val('').change();
	$("#NombreMedicinaPrepago").val('');
	$("#Eps").val('');
	$("#NivelRegimen").val('');
	$("#RiesgosLaborales").val('');
	$("#Arl").val('');
	$("#FondoPensionPreg").val('').change();
	$("#FondoPension").val('');
	$("#Sudadera").val('');
	$("#Camiseta").val('');
	$("#Pantaloneta").val('');
	$("#Tenis").val('').change();
	$("#GrupoSanguineo").val('');
	$("#Medicamento").val('').change();
	$("#CualMedicamento").val('');
	$("#TiempoMedicamento").val('');		
	$("#OtroMedicoPreg").val('').change();
	$("#OtroMedico").val('');

	$('#registro .form-group').removeClass('has-error');

	$("#persona").val('');        	
	$("#Nombres").val('');        	
	$("#Apellidos").val('');
	$("#TipoDocumento").val('');
	$("#NumeroDocumento").val('');
	$("#fechaNac").val('');
	$("#PaisNac").val('');
	$("#MunicipioNac").val('');
	$("#Genero").val('');

	$("#Agrupacion").val('');
	$("#Deporte").val('');
	$("#Modalidad").val('');

	$("#Discapacidad").val('').change();
	$("#Diagnostico").val('').change();
	$("#ClasificacionFuncional").val('').change();
	$("#Silla").val('').change();
	$("#Cuidador").val('').change();
	$("#Auxiliar").val('').change();
	$("#ClasificadoNivelInternacional").val('').change();
	$("#DiagnosticoEdad").val('');
	$("#FechaCI").val('');
	$("#EventoCI").val('');
	$("#EdadDeportiva").val('').change();
	$("#resultadoNacional").val('').change();
	$("#resultadoInternacional").val('').change();

	$("#Modificar").hide();
	$("#Registrar").hide();
	agrupacionT = '';
	deporteT = '';
	modalidadT = '';
	clasificacionT = '';
}