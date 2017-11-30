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
		//$("#Agrupacion").empty();
		$("#Deporte").empty();
		$("#Modalidad").empty();

		//$("#AgrupacionP").empty();
		$("#DeporteP").empty();
		$("#ModalidadP").empty();
		$("#ClasificacionFuncional").empty();

		//$("#Agrupacion").append("<option value=''>Seleccionar</option>");		
		$("#Deporte").append("<option value=''>Seleccionar</option>");
		$("#Modalidad").append("<option value=''>Seleccionar</option>");

		//$("#AgrupacionP").append("<option value=''>Seleccionar</option>");		
		$("#DeporteP").append("<option value=''>Seleccionar</option>");
		$("#ModalidadP").append("<option value=''>Seleccionar</option>");

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

			if($(this).val() == 2){
				$.get("getDeporteAll/" + id, function (deportes) {
					//console.log(deportes);
					$.each(deportes, function(i, e){
						$.each(e, function(j, f){
							$("#DeporteP").append("<option value='" +f.Id + "'>" + f.Nombre_Deporte + "</option>");
						});
					});				
				}).done(function(){
					$("#DeporteP").val(deporteT).change();
					deporteT = '';
				});

				$("#SeccionSeisD").show('slow');
				$("#CamposParalimpico").show('slow');
				$("#CamposConvencional").hide('slow');

			}else{
				$.get("getDeporteAll/" + id, function (deportes) {
					//console.log("conv"+deportes);
					$.each(deportes, function(i, e){
						$.each(e, function(j, f){
							$("#Deporte").append("<option value='" +f.Id + "'>" + f.Nombre_Deporte + "</option>");
						});
					});				
				}).done(function(){
					$("#Deporte").val(deporteT).change();
					deporteT = '';
				});

				$("#SeccionSeisD").hide('slow');
				$("#CamposParalimpico").hide('slow');
				$("#CamposConvencional").show('slow');
			}
		}else{
			 //$("#Agrupacion").val('');
			//$("#AgrupacionP").val('');
		}
		
	});

	$("#Pertenece").on('change', function(){
		id = $("#Pertenece").val();
		if(id == 1){
			$("#DeportistaEtapas").show('slow');
			$("#seccion_seis_global").show('slow');			
		}else if(id == 2){
			$("#DeportistaEtapas").hide('slow');
			$("#seccion_seis_global").hide('slow');			
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
		if(id == null){id=modalidadT;}
		if(id != ''){
			$.get("getClasificacionFuncional/" + id, function (Modalidad) {
				if(Modalidad != null){
					$.each(Modalidad, function(i, e){
						$("#ClasificacionFuncional").append("<option value='" +e['Id'] + "'>" + e['Nombre_Clasificacion_Funcional'] + "</option>");
					});
				}
			}).done(function(){
				$("#ClasificacionFuncional").val(clasificacionT).change();
				//clasificacionT = '';
			});
		}
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
		if(Persona.tipo.length > 0){
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
				}else{
					$("#camposRegistro").show("slow");
		            $("#loading").hide('slow');
				}
			});
		}else{
			$("#camposRegistro").show("slow");
            $("#loading").hide('slow');
		}
		$("#persona").val(Persona['Id_Persona']);        	
    	$("#Nombres").val(Persona['Primer_Nombre']+' '+Persona['Segundo_Nombre']);        	
		$("#Apellidos").val(Persona['Primer_Apellido']+' '+Persona['Segundo_Apellido']);

		$("#NombresCompromiso").empty();
		$("#NombresCompromiso").append(Persona['Primer_Nombre']+' '+Persona['Segundo_Nombre'] +' '+Persona['Primer_Apellido']+' '+Persona['Segundo_Apellido']);
		$("#TipoDocumento").val(Persona.tipo_documento['Descripcion_TipoDocumento']);
		$("#NumeroDocumento").val(Persona['Cedula']);
		$("#fechaNac").val(Persona['Fecha_Nacimiento']);
		$("#PaisNac").val(Persona['Id_Pais']);
		$("#MunicipioNac").val(Persona['Nombre_Ciudad']);
		$("#Genero").val(Persona['Id_Genero']);

		$("#Nombres").attr("disabled", "disabled");
		$("#Apellidos").attr("disabled", "disabled");
		$("#TipoDocumento").attr("disabled", "disabled");
		$("#NumeroDocumento").attr("disabled", "disabled");
		$("#fechaNac").attr("disabled", "disabled");
		$("#PaisNac").attr("disabled", "disabled");
		$("#MunicipioNac").attr("disabled", "disabled");
		$("#Genero").attr("disabled", "disabled");

		ShowRopa(Persona['Id_Genero'], 1);
		ShowZapatos(Persona['Id_Genero'], 2);

		document.getElementById("RUD").style.display = "block";

		if(Persona.deportista){  //Cuando Hay deportista    
			$.get("getDeportistaDeporte/" + Persona.deportista['Id'] + "", function (DeportistaDeporte) {     
  				agrupacionT = DeportistaDeporte['Agrupacion_Id'];
  				deporteT = DeportistaDeporte['Deporte_Id'];
  				modalidadT =DeportistaDeporte['Modalidad_Id'];

  				$("#Club").val(DeportistaDeporte['Club_Id']);   
  				$('#Club').selectpicker('refresh');           				
  			}).done(function(){
  				$("#ClasificacionDeportista").val(Persona.deportista['Clasificacion_Deportista_Id']).change();              				
  			});

  			if(Persona.deportista['Pertenece'] == 1){
  				$.get("getEtapasD/" + Persona.deportista['Id'] + "", function (DeportistaEtapa) {     		
					$("#EtapaNacionalT").val(DeportistaEtapa.Nacional.pivot['Etapa_Id']);
					$("#EtapaInternacionalT").val(DeportistaEtapa.Internacional.pivot['Etapa_Id']);
					$("#Smmlv").val(DeportistaEtapa.Internacional.pivot['Smmlv']);								
  				});
  			} 

			ShowRopa(Persona['Id_Genero'], 1, Persona.deportista['Sudadera_Talla_Id'], Persona.deportista['Camiseta_Talla_Id'], Persona.deportista['Pantaloneta_Talla_Id']);
			ShowZapatos(Persona['Id_Genero'], 2, Persona.deportista['Tenis_Talla_Id']);

			$("#Resolucion").prop('checked', true);
			$("#Deberes").prop('checked', true);
			
			if(Persona.deportista['Archivo1_Url'] != ''){
				$("#SImagen").empty();
				$("#SImagen").append("<img id='Fotografia' src='' alt='' class='img-thumbnail'>");
    			$("#Fotografia").attr('src',$("#Fotografia").attr('src')+'public/Img/Fotografias/'+Persona.deportista['Archivo1_Url']+'?' + (new Date()).getTime());
			}else{
				$("#Fotografia").hide();
			}
			$("#Pertenece").val(Persona.deportista['Pertenece']).change();		
			$("#deportista").val(Persona.deportista['Id']);						
	
			$("#LugarExpedicion").val(Persona.deportista['Lugar_Expedicion_Id']);
			$("#FechaExpedicion").val(Persona.deportista['Fecha_Expedicion']);
			$("#Pasaporte").val(Persona.deportista['Numero_Pasaporte']);
			$("#FechaVigenciaPasaporte").val(Persona.deportista['Fecha_Pasaporte']);
			$("#EstadoCivil").val(Persona.deportista['Estado_Civil_Id']);
			$("#Estrato").val(Persona.deportista['Estrato_Id']);
			$("#DepartamentoNac").val(Persona.deportista['Departamento_Id_Nac']);
			$("#LibretaPreg").val(Persona.deportista['Libreta_Preg']).change();
			$("#Libreta").val(Persona.deportista['Numero_Libreta_Mil']);
			$("#Distrito").val(Persona.deportista['Distrito_Libreta_Mil']);
			$("#NombreContacto").val(Persona.deportista['Nombre_Contacto']);
			$("#Parentesco").val(Persona.deportista['Parentesco_Id']);
			$("#FijoContacto").val(Persona.deportista['Fijo_Contacto']);
			$("#CelularContacto").val(Persona.deportista['Celular_Contacto']);
			$("#TipoCuenta").val(Persona.deportista['Tipo_Cuenta_Id']);
			$("#Banco").val(Persona.deportista['Banco_Id']);
			$("#NumeroCuenta").val(Persona.deportista['Numero_Cuenta']);
			$("#NumeroHijos").val(Persona.deportista['Numero_Hijos']);
			$("#DepartamentoLoc").val(Persona.deportista['Departamento_Id_Localiza']);
			$("#MunicipioLoc").val(Persona.deportista['Ciudad_Id_Localiza']);
			$("#Direccion").val(Persona.deportista['Direccion_Localiza']);
			$("#Barrio").val(Persona.deportista['Barrio_Localiza']);
			$("#Localidad").val(Persona.deportista['Localidad_Id_Localiza']);
			$("#FijoLoc").val(Persona.deportista['Fijo_Localiza']);
			$("#CelularLoc").val(Persona.deportista['Celular_Localiza']);
			$("#Correo").val(Persona.deportista['Correo_Electronico']);
			$("#Regimen").val(Persona.deportista['Regimen_Salud_Id']).change();
			$("#FechaAfiliacion").val(Persona.deportista['Fecha_Afiliacion']);
			$("#TipoAfiliacion").val(Persona.deportista['Tipo_Afiliacion_Id']);
			$("#MedicinaPrepago").val(Persona.deportista['Medicina_Prepago']).change();
			$("#NombreMedicinaPrepago").val(Persona.deportista['Nombre_MedicinaPrepago']);
			$("#Eps").val(Persona.deportista['Eps_Id']);
			$("#NivelRegimen").val(Persona.deportista['Nivel_Regimen_Sub_Id']);
			$("#RiesgosLaborales").val(Persona.deportista['Riesgo_Laboral']);
			$("#Arl").val(Persona.deportista['Arl_Id']);
			$("#FondoPensionPreg").val(Persona.deportista['Fondo_PensionPreg_Id']).change();
			$("#FondoPension").val(Persona.deportista['Fondo_Pension_Id']);
			
			$("#GrupoSanguineo").val(Persona.deportista['Grupo_Sanguineo_Id']);
			$("#Medicamento").val(Persona.deportista['Uso_Medicamento']).change();
			$("#CualMedicamento").val(Persona.deportista['Medicamento']);
			$("#TiempoMedicamento").val(Persona.deportista['Tiempo_Medicamento']);		
			$("#OtroMedicoPreg").val(Persona.deportista['Otro_Medico_Preg']).change();
			$("#OtroMedico").val(Persona.deportista['Otro_Medico']);


			if(Persona.deportista.deportista_paralimpico[0] != null){
				$("#SeccionSeisD").show('slow');
				$("#Discapacidad").val(Persona.deportista.deportista_paralimpico[0]['Discapacidad_Id']).change();
				$("#Diagnostico").val(Persona.deportista.deportista_paralimpico[0]['Diagnostico_Id']).change();
				//$("#ClasificacionFuncional").val(Persona.deportista.deportista_paralimpico[0]['Clasificacion_Funcional_Id']).change();
				clasificacionT =Persona.deportista.deportista_paralimpico[0]['Clasificacion_Funcional_Id'];
				$("#Silla").val(Persona.deportista.deportista_paralimpico[0]['Silla_Id']).change();
				$("#Cuidador").val(Persona.deportista.deportista_paralimpico[0]['Uso_Silla_Id']).change();
				$("#Auxiliar").val(Persona.deportista.deportista_paralimpico[0]['Auxiliar_Id']).change();
				$("#ClasificadoNivelInternacional").val(Persona.deportista.deportista_paralimpico[0]['Clasificacion_Funcional_Internacional_Id']).change();
				$("#DiagnosticoEdad").val(Persona.deportista.deportista_paralimpico[0]['EdadAdquirido']);
				$("#FechaCI").val(Persona.deportista.deportista_paralimpico[0]['Fecha_Clasificacion']);
				$("#EventoCI").val(Persona.deportista.deportista_paralimpico[0]['Evento_Clasificacion']);
				$("#EdadDeportiva").val(Persona.deportista.deportista_paralimpico[0]['EdadDeportiva']).change();
				$("#resultadoNacional").val(Persona.deportista.deportista_paralimpico[0]['Resultado_Nacional']).change();
				$("#resultadoInternacional").val(Persona.deportista.deportista_paralimpico[0]['Resultado_Internacional']).change();
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
  			agrupacionT = '';
  			deporteT = '';
  			modalidadT = '';  			
  		}

		/*if(responseDep.deportista){  //Cuando Hay deportista    

		              			$.get("getDeportistaDeporte/" + responseDep.deportista['Id'] + "", function (DeportistaDeporte) {     
		              				agrupacionT = DeportistaDeporte['Agrupacion_Id'];
		              				deporteT = DeportistaDeporte['Deporte_Id'];
		              				modalidadT =DeportistaDeporte['Modalidad_Id'];*/

	}).done(function (){                     
     	//$("#camposRegistro").show('slow');            	     	
     	//$("#loading").hide('slow');   
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
            $("#loading").hide('slow');

    	}else if(data.length == 1){
    		VerPersona(data[0].Id_Persona);
    	}else if(data.length > 1){
    		$("#tablaPersonas").empty();
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
		}
	}).done(function(){
		/*$('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
        $('#buscar span').empty();
     	document.getElementById("buscar").disabled = false;     */
     	$('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
        $('#buscar span').empty();
        document.getElementById("buscar").disabled = false;    
        $("#tablaPersonas").show('slow');
        $("#loading").hide('slow');
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
	var t = $('#TablaVisitas').DataTable();   
	t.row.add( ['1','1','1'] ).clear().draw( false );
	$("#tablaPersonas").empty();

	$("#seccion_seis_global").show('slow');				
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

	$("#CamposConvencional").hide('slow');
	$("#CamposParalimpico").hide('slow');

}