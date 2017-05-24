$(function(e){ 

	$("#Registrar").on('click', function(){				
		registro('AddHistoriaInicial');
	});

	$("#Modificar").on('click', function(){
		registro('EditHistoriaInicial');
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
				$("#seccion_seis").hide("slow");
				$("#seccion_siete").hide("slow");
				$("#seccion_ocho").hide("slow");
				$("#seccion_nueve").hide("slow");
				$("#seccion_diez").hide("slow");
				$("#seccion_once").hide("slow");
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
					if(xhr.Estado == 'Success'){
						$("#camposRegistro").hide('slow');
						$('#alert_actividad').html('<div class="alert alert-dismissible alert-success" ><strong>Exito! </strong>'+xhr.Mensaje+'</div>');
						$('#mensaje_actividad').show(60);
						$('#mensaje_actividad').delay(2000).hide(600);	

						setTimeout(function(){ 
				          	$("#verHistoriaD").modal('hide');  
				          }, 2000);			

					}else if(xhr.Estado == 'Error'){
						$('#alert_actividad').html('<div class="alert alert-dismissible alert-danger" ><strong>Error! </strong>'+xhr.Mensaje+'</div>');
						$('#mensaje_actividad').show(60);
						$('#mensaje_actividad').delay(2000).hide(600);				
						
					}
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
	
	var validador_errores = function(data){
		$('#registro .form-group').removeClass('has-error');
		$("#seccion_uno").show("slow");
		$("#seccion_dos").show("slow");
		$("#seccion_tres").show("slow");
		$("#seccion_cuatro").show("slow");
		$("#seccion_cinco").show("slow");
		$("#seccion_seis").show("slow");
		$("#seccion_siete").show("slow");
		$("#seccion_ocho").show("slow");
		$("#seccion_nueve").show("slow");
		$("#seccion_diez").show("slow");
		$("#seccion_once").show("slow");
		$("#seccion_compromiso").show("slow");

		$.each(data, function(i, e){
			$("#"+i).closest('.form-group').addClass('has-error');
      	});
	}
	
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

	$("#ClasificacionDeportista").on('change',function (e){
		$("#Agrupacion").empty();
		$("#Deporte").empty();
		$("#Modalidad").empty();

		$("#AgrupacionP").empty();
		$("#DeporteP").empty();
		$("#ModalidadP").empty();
		$("#ClasificacionFuncional").empty();

		$("#Agrupacion").append("<option value=''>Seleccionar</option>");		
		$("#Deporte").append("<option value=''>Seleccionar</option>");
		$("#Modalidad").append("<option value=''>Seleccionar</option>");

		$("#AgrupacionP").append("<option value=''>Seleccionar</option>");		
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
		}else{
			$("#Agrupacion").val('');
			$("#AgrupacionP").val('');
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
			});
		}
	});

	$('body').delegate('button[data-function="VerPersona"]','click',function (e) {
		VerPersona($(this).val());
	});

	$('body').delegate('button[data-function="VerHistoria"]','click',function (e) {
		VerHistoria($(this).val());
	});

	$('body').delegate('button[data-function="AgregarHistoria"]','click',function (e) {	
		$("#loading").show('slow');
		document.getElementById("registro").reset();
		$.get('buscarPersona/'+$("#persona").val(),{}, function(Persona){			
			$("#Nombres").val(Persona['Primer_Nombre']+' '+Persona['Segundo_Nombre']);        	
			$("#Apellidos").val(Persona['Primer_Apellido']+' '+Persona['Segundo_Apellido']);
			$("#TipoDocumento").val(Persona.tipo_documento['Descripcion_TipoDocumento']);
			$("#NumeroDocumento").val(Persona['Cedula']);
			$("#fechaNac").val(Persona['Fecha_Nacimiento']);
			$("#PaisNac").val(Persona['Id_Pais']);
			$("#MunicipioNac").val(Persona['Nombre_Ciudad']);
			$("#Genero").val(Persona['Id_Genero']);
			$("#Edad").val(calculateAge(Persona['Fecha_Nacimiento'])+' años');

			$("#Titulo").empty();
		$("#Titulo").append('Registro Inicial de Consulta Medica');

			$.get("getDeportistaDeporte/" + Persona.deportista['Id'] + "", function (DeportistaDeporte) {     
				agrupacionT = DeportistaDeporte['Agrupacion_Id'];
				deporteT = DeportistaDeporte['Deporte_Id'];
				modalidadT =DeportistaDeporte['Modalidad_Id'];

				$("#Club").val(DeportistaDeporte['Club_Id']);   
				$('#Club').selectpicker('refresh');           				
			}).done(function(){
				$("#ClasificacionDeportista").val(Persona.deportista['Clasificacion_Deportista_Id']).change();              				
			});

			if(Persona.deportista['Archivo1_Url'] != ''){
				var HtmlFoto = '<li class="list-group-item">'+
	                                '<div class="row" id="FotografiaRegistro">'+
	                                     '<div class="form-group col-md-12">'+
	                                        '<div class="form-group col-md-4"></div>'+
	                                        '<div class="col-md-4 text-center">'+
	                                        	'<label for="inputEmail" class="control-label">Fotografía del deportista</label>'+                                        	
	                                            '<br>'+
	                                            '<span id="SImagen">'+
	                                                '<img id="Fotografia" src="" alt="" class="img-thumbnail img-responsive"><br>'+
	                                            '</span>'+
	                                        '</div>'+
	                                        '<div class="form-group col-md-4 "></div>'+
	                                    '</div>'+
	                                '</div>'+
	                            '</li>';
				$("#SImagenLi").empty();
				$("#SImagenLi").append(HtmlFoto);
				$("#Fotografia").attr('src',$("#Fotografia").attr('src')+'public/Img/Fotografias/'+Persona.deportista['Archivo1_Url']+'?' + (new Date()).getTime());
			}else{
				$("#Fotografia").hide();
			}

			$("#deportista").val(Persona.deportista['Id']);						
			$("#EstadoCivil").val(Persona.deportista['Estado_Civil_Id']);
			$("#Estrato").val(Persona.deportista['Estrato_Id']);
			$("#DepartamentoNac").val(Persona.deportista['Departamento_Id_Nac']);
			$("#DepartamentoLoc").val(Persona.deportista['Departamento_Id_Localiza']);
			$("#MunicipioLoc").val(Persona.deportista['Ciudad_Id_Localiza']);
			$("#Direccion").val(Persona.deportista['Direccion_Localiza']);
			$("#Localidad").val(Persona.deportista['Localidad_Id_Localiza']);
			$("#FijoLoc").val(Persona.deportista['Fijo_Localiza']);
			$("#CelularLoc").val(Persona.deportista['Celular_Localiza']);
			$("#MedicinaPrepago").val(Persona.deportista['Medicina_Prepago']).change();
			$("#Eps").val(Persona.deportista['Eps_Id']);


			if(Persona.deportista.deportista_paralimpico[0] != null){			
				$("#Discapacidad").val(Persona.deportista.deportista_paralimpico[0]['Discapacidad_Id']).change();
				clasificacionT =Persona.deportista.deportista_paralimpico[0]['Clasificacion_Funcional_Id'];			
				$("#EdadDeportiva").val(Persona.deportista.deportista_paralimpico[0]['EdadDeportiva']);
			}

			$("#TablaEntrenadores").empty();

			if(Persona.deportista.deportista_entrenador.length > 0){			
				var htmlEntrenadores = '';			
				htmlEntrenadores += '<table id="tablaEntrenadorDatos" class="display nowrap" cellspacing="0" width="90%" style="text-transform: uppercase;">';
				htmlEntrenadores += '<thead>';
				htmlEntrenadores += '<th>NOMBRE ENTRENADOR</th>';
				htmlEntrenadores += '</thead>';
				htmlEntrenadores += '<tbody>';
				$.each(Persona.deportista.deportista_entrenador, function(i, e){
					htmlEntrenadores += '<tr>';
					htmlEntrenadores += '<td>'+e.persona['Primer_Nombre']+' '+e.persona['Segundo_Nombre']+' '+e.persona['Primer_Apellido']+' ' +e.persona['Segundo_Apellido']+'</td>';
					htmlEntrenadores += '</tr>';
				});
				htmlEntrenadores += '</tbody>';
				htmlEntrenadores += '</table>';
				$("#TablaEntrenadores").append(htmlEntrenadores);			
				$('#tablaEntrenadorDatos').DataTable({
			        retrieve: true,
			        buttons: [],
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
			}else{
				$("#TablaEntrenadores").append('<div class="alert alert-dismissible alert-warning" ><strong>Atención!</strong>Este deportista aún no cuenta con entrenadores relacionados</div>');
			}
		}).done(function(){
			$("#Registrar").show('slow');
	    	$("#Modificar").hide('slow');

	    	$("#seccion_uno").hide("slow");
	    	$("#seccion_dos").hide("slow");
	    	$("#seccion_tres").hide("slow");
	    	$("#seccion_cuatro").hide("slow");
	    	$("#seccion_cinco").hide("slow");
	    	$("#seccion_seis").hide("slow");
	    	$("#seccion_siete").hide("slow");
	    	$("#seccion_ocho").hide("slow");
	    	$("#seccion_nueve").hide("slow");
	    	$("#seccion_diez").hide("slow");
	    	$("#seccion_once").hide("slow");

	    	$("#camposRegistro").show('slow');
			$("#verHistoriaD").modal('show');
			$("#loading").hide('slow');
			document.getElementById("RHCI").style.display = "block";  			
		});
	});

	$("#Planifica").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 1){
				$("#MetodoPreg").show('slow');
			}else{
				$("#MetodoPreg").hide('slow');
			}
		}
	});


	$("#DatoCabeza").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionCabeza").show('slow');
			}else{
				$("#ObservacionCabeza").hide('slow');
			}
		}else{
			$("#ObservacionCabeza").hide('slow');
		}
	});

	$("#DatoCuello").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionCuello").show('slow');
			}else{
				$("#ObservacionCuello").hide('slow');
			}
		}else{
			$("#ObservacionCuello").hide('slow');
		}
	});

	$("#DatoAgudezaVisual").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#AgudezaDiv").show('slow');
			}else{
				$("#AgudezaDiv").hide('slow');
			}
		}else{
			$("#AgudezaDiv").hide('slow');
		}
	});

	$("#DatoAudicion").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionAudicion").show('slow');
			}else{
				$("#ObservacionAudicion").hide('slow');
			}
		}else{
			$("#ObservacionAudicion").hide('slow');
		}
	});

	$("#DatoOrl").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionOrl").show('slow');
			}else{
				$("#ObservacionOrl").hide('slow');
			}
		}else{
			$("#ObservacionOrl").hide('slow');
		}
	});

	$("#DatoCavidadOral").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionCavidadOral").show('slow');
			}else{
				$("#ObservacionCavidadOral").hide('slow');
			}
		}else{
			$("#ObservacionCavidadOral").hide('slow');
		}
	});

	$("#DatoPulmonar").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionPulmonar").show('slow');
			}else{
				$("#ObservacionPulmonar").hide('slow');
			}
		}else{
			$("#ObservacionPulmonar").hide('slow');
		}
	});

	$("#DatoCardiaco").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionCardiaco").show('slow');
			}else{
				$("#ObservacionCardiaco").hide('slow');
			}
		}else{
			$("#ObservacionCardiaco").hide('slow');
		}
	});

	$("#DatoVascularPeriferico").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionVascularPeriferico").show('slow');
			}else{
				$("#ObservacionVascularPeriferico").hide('slow');
			}
		}else{
			$("#ObservacionVascularPeriferico").hide('slow');
		}
	});

	$("#DatoAbdomen").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionAbdomen").show('slow');
			}else{
				$("#ObservacionAbdomen").hide('slow');
			}
		}else{
			$("#ObservacionAbdomen").hide('slow');
		}
	});

	$("#DatoGenitourinario").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionGenitourinario").show('slow');
			}else{
				$("#ObservacionGenitourinario").hide('slow');
			}
		}else{
			$("#ObservacionGenitourinario").hide('slow');
		}
	});

	$("#DatoNeurologico").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionNeurologico").show('slow');
			}else{
				$("#ObservacionNeurologico").hide('slow');
			}
		}else{
			$("#ObservacionNeurologico").hide('slow');
		}
	});

	$("#DatoPielFaneras").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionPielFaneras").show('slow');
			}else{
				$("#ObservacionPielFaneras").hide('slow');
			}
		}else{
			$("#ObservacionPielFaneras").hide('slow');
		}
	});

	$("#DatoAP").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionAP").show('slow');
			}else{
				$("#ObservacionAP").hide('slow');
			}
		}else{
			$("#ObservacionAP").hide('slow');
		}
	});

	$("#DatoPA").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionPA").show('slow');
			}else{
				$("#ObservacionPA").hide('slow');
			}
		}else{
			$("#ObservacionPA").hide('slow');
		}
	});

	$("#DatoLateral").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionLateral").show('slow');
			}else{
				$("#ObservacionLateral").hide('slow');
			}
		}else{
			$("#ObservacionLateral").hide('slow');
		}
	});

	$("#DatoCuello2").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionCuello2").show('slow');
			}else{
				$("#ObservacionCuello2").hide('slow');
			}
		}else{
			$("#ObservacionCuello2").hide('slow');
		}
	});

	$("#DatoHombro").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionHombro").show('slow');
			}else{
				$("#ObservacionHombro").hide('slow');
			}
		}else{
			$("#ObservacionHombro").hide('slow');
		}
	});

	$("#DatoCodo").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionCodo").show('slow');
			}else{
				$("#ObservacionCodo").hide('slow');
			}
		}else{
			$("#ObservacionCodo").hide('slow');
		}
	});

	$("#DatoMuneca").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionMuneca").show('slow');
			}else{
				$("#ObservacionMuneca").hide('slow');
			}
		}else{
			$("#ObservacionMuneca").hide('slow');
		}
	});

	$("#DatoMano").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionMano").show('slow');
			}else{
				$("#ObservacionMano").hide('slow');
			}
		}else{
			$("#ObservacionMano").hide('slow');
		}
	});

	$("#DatoCervical").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionCervical").show('slow');
			}else{
				$("#ObservacionCervical").hide('slow');
			}
		}else{
			$("#ObservacionCervical").hide('slow');
		}
	});

	$("#DatoDorsal").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionDorsal").show('slow');
			}else{
				$("#ObservacionDorsal").hide('slow');
			}
		}else{
			$("#ObservacionDorsal").hide('slow');
		}
	});

	$("#DatoLumbosaca").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionLumbosaca").show('slow');
			}else{
				$("#ObservacionLumbosaca").hide('slow');
			}
		}else{
			$("#ObservacionLumbosaca").hide('slow');
		}
	});

	$("#DatoCadera").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionCadera").show('slow');
			}else{
				$("#ObservacionCadera").hide('slow');
			}
		}else{
			$("#ObservacionCadera").hide('slow');
		}
	});

	$("#DatoRodilla").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionRodilla").show('slow');
			}else{
				$("#ObservacionRodilla").hide('slow');
			}
		}else{
			$("#ObservacionRodilla").hide('slow');
		}
	});

	$("#DatoTobillo").on('change', function(){
		if($(this).val() != ''){
			if($(this).val() == 2){
				$("#ObservacionTobillo").show('slow');
			}else{
				$("#ObservacionTobillo").hide('slow');
			}
		}else{
			$("#ObservacionTobillo").hide('slow');
		}
	});

});

function VerPersona(id_persona){

	$('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
	$('#buscar span').empty();
	document.getElementById("buscar").disabled = false;
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
	    	$('#personas').html('<div><h4>Datos del deportista</h4><h5 class="list-group-item-heading" style="text-transform: uppercase;" >'+Persona['Primer_Nombre']+' '+Persona['Segundo_Nombre']+' '+Persona['Primer_Apellido']+' '+Persona['Segundo_Apellido']+'</h5><div class="row"><div class="col-xs-12 col-md-12"><div class="row"><div class="col-xs-12 col-sm-6 col-md-3"><small>IDENTIFICACIÓN '+Persona['Cedula']+'</small></div></div></div></div>');
	    	$("#persona").val(Persona['Id_Persona']);        
	    	$("#tablaHistorias").empty();
				var html = '';
				html += "<div class='list-group-item'>";
				html += "<div align='right'>";
				html += "<button type='button' class='btn btn-primary' data-function='AgregarHistoria' id='AgregarHistoria' value='"+Persona.deportista.Id+"'>"+
                         "<span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Agregar Nueva Consulta"+
                      	"</button>";
              	html += '</div>';
				html += '<h4>Tabla de Consultas </h4>';
				html += '<table id="tablaHistoriasDatos" class="display nowrap" cellspacing="0" width="90%" style="text-transform: uppercase;">';
				html += '<thead>';
				html += '<th>Fecha</th>';
				html += '<th>Medico</th>';
				html += '<th>Opciones</th>';
				html += '</thead>';
				html += '<tbody>';
	    	if(Persona.deportista.deportista_historia_inicial.length > 0){	    		
	    		$.each(Persona.deportista.deportista_historia_inicial, function(i, e){
	    			html += '<tr>';
	    			html += '<td>'+e.created_at+'</td>';
	    			html += '<td>Nombre del Medico</td>';
	    			html += "<td><button type='button' class='btn btn-success' data-function='VerHistoria' value='"+e.Id+"'>"+
	                             "<span class='glyphicon glyphicon-zoom-in' aria-hidden='true'></span> Ver"+
	                          	"</button></td>";
	    			html += '</tr>';
	    		});	    		
	    	}
	    	html += '</tbody>';
    		html += '</table></div>';
    		$("#tablaHistorias").append(html);
    		$('#tablaHistoriasDatos').DataTable({
		        retrieve: true,
		        buttons: [
		        ],
		        dom: 'Bfrtip',
		        select: true,
		        "responsive": true,
		        "ordering": true,
		        "info": true,
		        "pageLength": 4,
		        "language": {
		            url: 'public/DataTables/Spanish.json',
		            searchPlaceholder: "Buscar"
		        }
		    });
	    }else{   
	    	$("#persona").val();
	        $('#buscar span').empty();
	        document.getElementById("buscar").disabled = false;
	        $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">Esta persona aún no se encuentra registrada como un deportista, por favor verifique la información!</h4></dvi><br>');
	        $('#paginador').fadeOut();
	        $("#camposRegistro").hide("slow");
	        $("#loading").hide('slow');           
	        return false;
	    }   
	}).done(function (){
    	$("#loading").hide('slow');
  	});
}

function VerHistoria(id_historia){
	$("#loading").show('slow');
	$.get('buscarPersona/'+$("#persona").val(),{}, function(Persona){
		$("#Nombres").val(Persona['Primer_Nombre']+' '+Persona['Segundo_Nombre']);        	
		$("#Apellidos").val(Persona['Primer_Apellido']+' '+Persona['Segundo_Apellido']);
		$("#TipoDocumento").val(Persona.tipo_documento['Descripcion_TipoDocumento']);
		$("#NumeroDocumento").val(Persona['Cedula']);
		$("#fechaNac").val(Persona['Fecha_Nacimiento']);
		$("#PaisNac").val(Persona['Id_Pais']);
		$("#MunicipioNac").val(Persona['Nombre_Ciudad']);
		$("#Genero").val(Persona['Id_Genero']);
		$("#Edad").val(calculateAge(Persona['Fecha_Nacimiento'])+' años');		

		document.getElementById("RHCI").style.display = "block";  

		$.get("getDeportistaDeporte/" + Persona.deportista['Id'] + "", function (DeportistaDeporte) {     
			agrupacionT = DeportistaDeporte['Agrupacion_Id'];
			deporteT = DeportistaDeporte['Deporte_Id'];
			modalidadT =DeportistaDeporte['Modalidad_Id'];

			$("#Club").val(DeportistaDeporte['Club_Id']);   
			$('#Club').selectpicker('refresh');           				
		}).done(function(){
			$("#ClasificacionDeportista").val(Persona.deportista['Clasificacion_Deportista_Id']).change();              				
		});

		if(Persona.deportista['Archivo1_Url'] != ''){
			var HtmlFoto = '<li class="list-group-item">'+
                                '<div class="row" id="FotografiaRegistro">'+
                                     '<div class="form-group col-md-12">'+
                                        '<div class="form-group col-md-4"></div>'+
                                        '<div class="col-md-4 text-center">'+
                                        	'<label for="inputEmail" class="control-label">Fotografía del deportista</label>'+                                        	
                                            '<br>'+
                                            '<span id="SImagen">'+
                                                '<img id="Fotografia" src="" alt="" class="img-thumbnail img-responsive"><br>'+
                                            '</span>'+
                                        '</div>'+
                                        '<div class="form-group col-md-4 "></div>'+
                                    '</div>'+
                                '</div>'+
                            '</li>';
			$("#SImagenLi").empty();
			$("#SImagenLi").append(HtmlFoto);
			$("#Fotografia").attr('src',$("#Fotografia").attr('src')+'public/Img/Fotografias/'+Persona.deportista['Archivo1_Url']+'?' + (new Date()).getTime());
		}else{
			$("#Fotografia").hide();
		}

		$("#deportista").val(Persona.deportista['Id']);						
		$("#EstadoCivil").val(Persona.deportista['Estado_Civil_Id']);
		$("#Estrato").val(Persona.deportista['Estrato_Id']);
		$("#DepartamentoNac").val(Persona.deportista['Departamento_Id_Nac']);
		$("#DepartamentoLoc").val(Persona.deportista['Departamento_Id_Localiza']);
		$("#MunicipioLoc").val(Persona.deportista['Ciudad_Id_Localiza']);
		$("#Direccion").val(Persona.deportista['Direccion_Localiza']);
		$("#Localidad").val(Persona.deportista['Localidad_Id_Localiza']);
		$("#FijoLoc").val(Persona.deportista['Fijo_Localiza']);
		$("#CelularLoc").val(Persona.deportista['Celular_Localiza']);
		$("#MedicinaPrepago").val(Persona.deportista['Medicina_Prepago']).change();
		$("#Eps").val(Persona.deportista['Eps_Id']);


		if(Persona.deportista.deportista_paralimpico[0] != null){			
			$("#Discapacidad").val(Persona.deportista.deportista_paralimpico[0]['Discapacidad_Id']).change();
			clasificacionT =Persona.deportista.deportista_paralimpico[0]['Clasificacion_Funcional_Id'];			
			$("#EdadDeportiva").val(Persona.deportista.deportista_paralimpico[0]['EdadDeportiva']);
		}

		$("#TablaEntrenadores").empty();

		if(Persona.deportista.deportista_entrenador.length > 0){			
			var htmlEntrenadores = '';			
			htmlEntrenadores += '<table id="tablaEntrenadorDatos" class="display nowrap" cellspacing="0" width="90%" style="text-transform: uppercase;">';
			htmlEntrenadores += '<thead>';
			htmlEntrenadores += '<th>NOMBRE ENTRENADOR</th>';
			htmlEntrenadores += '</thead>';
			htmlEntrenadores += '<tbody>';
			$.each(Persona.deportista.deportista_entrenador, function(i, e){
				htmlEntrenadores += '<tr>';
				htmlEntrenadores += '<td>'+e.persona['Primer_Nombre']+' '+e.persona['Segundo_Nombre']+' '+e.persona['Primer_Apellido']+' ' +e.persona['Segundo_Apellido']+'</td>';
				htmlEntrenadores += '</tr>';
			});
			htmlEntrenadores += '</tbody>';
			htmlEntrenadores += '</table>';
			$("#TablaEntrenadores").append(htmlEntrenadores);			
			$('#tablaEntrenadorDatos').DataTable({
		        retrieve: true,
		        buttons: [],
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
		}else{
			$("#TablaEntrenadores").append('<div class="alert alert-dismissible alert-warning" ><strong>Atención!</strong>Este deportista aún no cuenta con entrenadores relacionados</div>');
		}
		
		$.get("getHistoriaUnica/" + id_historia, function (HistoriaUnica) {  
			$("#Titulo").empty();
			$("#Titulo").append('Consulta Medica ('+HistoriaUnica.created_at+')');  
			$("#historia").val(HistoriaUnica.Id);
			$("#Ocupacion").val(HistoriaUnica.Ocupacion_Id).change();
			$("#NivelEstudio").val(HistoriaUnica.NivelEstudio_Id).change();
			$("#Dominancia").val(HistoriaUnica.Dominancia_Id).change();
			$("#NombreMadre").val(HistoriaUnica.Nombre_Madre);
			$("#NombrePadre").val(HistoriaUnica.Nombre_Padre);
			$("#EntrenamientoContinuoPreg").val(HistoriaUnica.Entrenamiento_Continuo_Preg).change();
			$("#EdadDeportiva").val(HistoriaUnica.Edad_Deportiva).change();
			$("#PlanEntrenamientoPreg").val(HistoriaUnica.Plan_Entrenamiento_Preg).change();
			$("#NombreAcudiente").val(HistoriaUnica.Nombre_Acudiente);
			$("#TelefonoAcudiente").val(HistoriaUnica.Telefono_Acudiente);
			$("#NombreResponsable").val(HistoriaUnica.Nombre_Responsable);
			$("#TelefonoResponsable").val(HistoriaUnica.Telefono_Responsable);
			$("#MotivoConsulta").val(HistoriaUnica.historia_inicial_consulta[0].Descripcion);
			$("#AntecedentePatologico").val(HistoriaUnica.historia_inicial_patologico[0].Descripcion);
			$("#AntecedenteOsteomusculares").val(HistoriaUnica.historia_inicial_osteomuscular[0].Descripcion);
			$("#Menarquia").val(HistoriaUnica.historia_inicial_ginecologico[0].Menarquia);
			$("#Ciclo").val(HistoriaUnica.historia_inicial_ginecologico[0].Ciclo);
			$("#Regular").val(HistoriaUnica.historia_inicial_ginecologico[0].Regular);
			$("#Dismenorrea").val(HistoriaUnica.historia_inicial_ginecologico[0].Dismenorrea);
			$("#Fum").val(HistoriaUnica.historia_inicial_ginecologico[0].Fum);
			$("#Fup").val(HistoriaUnica.historia_inicial_ginecologico[0].Fup);
			$("#G").val(HistoriaUnica.historia_inicial_ginecologico[0].G);
			$("#P").val(HistoriaUnica.historia_inicial_ginecologico[0].P);
			$("#V").val(HistoriaUnica.historia_inicial_ginecologico[0].V);
			$("#A").val(HistoriaUnica.historia_inicial_ginecologico[0].A);
			$("#Amenorrea").val(HistoriaUnica.historia_inicial_ginecologico[0].Amenorrea);
			$("#Planifica").val(HistoriaUnica.historia_inicial_ginecologico[0].Planifica_Preg).change();
			$("#Metodo").val(HistoriaUnica.historia_inicial_ginecologico[0].Metodo_Planificacion);

			$("#DatoPaPie").val(HistoriaUnica.historia_inicial_examen_fisico[0].Pa_Pie_Dato);
			$("#ObservacionPaPie").val(HistoriaUnica.historia_inicial_examen_fisico[0].Pa_Pie_Observacion);
			$("#DatoPaSupino").val(HistoriaUnica.historia_inicial_examen_fisico[0].Pa_Supino_Dato);
			$("#ObservacionPaSupino").val(HistoriaUnica.historia_inicial_examen_fisico[0].Pa_Supino_Observacion);
			$("#DatoFCReposo").val(HistoriaUnica.historia_inicial_examen_fisico[0].Fc_Reposo_Dato);
			$("#ObservacionFCReposo").val(HistoriaUnica.historia_inicial_examen_fisico[0].Fc_Reposo_Observacion);
			$("#DatoFR").val(HistoriaUnica.historia_inicial_examen_fisico[0].Fr_Dato);
			$("#ObservacionFR").val(HistoriaUnica.historia_inicial_examen_fisico[0].Fr_Observacion);
			$("#DatoTemperatura").val(HistoriaUnica.historia_inicial_examen_fisico[0].Temperatura_Dato);
			$("#ObservacionTemperatura").val(HistoriaUnica.historia_inicial_examen_fisico[0].Temperatura_Observacion);
			$("#DatoPeso").val(HistoriaUnica.historia_inicial_examen_fisico[0].Peso_Dato);
			$("#ObservacionPeso").val(HistoriaUnica.historia_inicial_examen_fisico[0].Peso_Observacion);
			$("#DatoEstatura").val(HistoriaUnica.historia_inicial_examen_fisico[0].Estatura_Dato);
			$("#ObservacionEstatura").val(HistoriaUnica.historia_inicial_examen_fisico[0].Estatura_Observacion);
			$("#DatoCabeza").val(HistoriaUnica.historia_inicial_examen_fisico[0].Cabeza_Dato).change();
			$("#ObservacionCabeza").val(HistoriaUnica.historia_inicial_examen_fisico[0].Cabeza_Observacion);
			$("#DatoCuello").val(HistoriaUnica.historia_inicial_examen_fisico[0].Cuello_Dato).change();
			$("#ObservacionCuello").val(HistoriaUnica.historia_inicial_examen_fisico[0].Cuello_Observacion);
			$("#DatoAgudezaVisual").val(HistoriaUnica.historia_inicial_examen_fisico[0].Agudeza_Visual_Dato).change();
			$("#OI").val(HistoriaUnica.historia_inicial_examen_fisico[0].Oi);
			$("#OD").val(HistoriaUnica.historia_inicial_examen_fisico[0].Oi);
			$("#FDEO").val(HistoriaUnica.historia_inicial_examen_fisico[0].F_De_O);
			$("#DatoAudicion").val(HistoriaUnica.historia_inicial_examen_fisico[0].Audicion_Dato).change();
			$("#ObservacionAudicion").val(HistoriaUnica.historia_inicial_examen_fisico[0].Audicion_Observacion);
			$("#DatoOrl").val(HistoriaUnica.historia_inicial_examen_fisico[0].Orl_Dato).change();
			$("#ObservacionOrl").val(HistoriaUnica.historia_inicial_examen_fisico[0].Orl_Observacion);
			$("#DatoCavidadOral").val(HistoriaUnica.historia_inicial_examen_fisico[0].Cavidad_Oral_Dato).change();
			$("#ObservacionCavidadOral").val(HistoriaUnica.historia_inicial_examen_fisico[0].Cavidad_Oral_Observacion);
			$("#DatoPulmonar").val(HistoriaUnica.historia_inicial_examen_fisico[0].Pulmonar_Dato).change();
			$("#ObservacionPulmonar").val(HistoriaUnica.historia_inicial_examen_fisico[0].Pulmonar_Observacion);
			$("#DatoCardiaco").val(HistoriaUnica.historia_inicial_examen_fisico[0].Cardiaco_Dato).change();
			$("#ObservacionCardiaco").val(HistoriaUnica.historia_inicial_examen_fisico[0].Cardiaco_Observacion);
			$("#DatoVascularPeriferico").val(HistoriaUnica.historia_inicial_examen_fisico[0].Vascular_Periferico_Dato).change();
			$("#ObservacionVascularPeriferico").val(HistoriaUnica.historia_inicial_examen_fisico[0].Vascular_Periferico_Observacion);
			$("#DatoAbdomen").val(HistoriaUnica.historia_inicial_examen_fisico[0].Abdomen_Dato).change();
			$("#ObservacionAbdomen").val(HistoriaUnica.historia_inicial_examen_fisico[0].Abdomen_Observacion);
			$("#DatoGenitourinario").val(HistoriaUnica.historia_inicial_examen_fisico[0].Genitourinario_Dato).change();
			$("#ObservacionGenitourinario").val(HistoriaUnica.historia_inicial_examen_fisico[0].Genitourinario_Observacion);
			$("#DatoNeurologico").val(HistoriaUnica.historia_inicial_examen_fisico[0].Neurologico_Dato).change();
			$("#ObservacionNeurologico").val(HistoriaUnica.historia_inicial_examen_fisico[0].Neurologico_Observacion);
			$("#DatoPielFaneras").val(HistoriaUnica.historia_inicial_examen_fisico[0].Piel_Faneras_Dato).change();
			$("#ObservacionPielFaneras").val(HistoriaUnica.historia_inicial_examen_fisico[0].Piel_Faneras_Observacion);
			$("#DatoAP").val(HistoriaUnica.historia_inicial_examen_fisico[0].Postura_Ap_Dato).change();
			$("#ObservacionAP").val(HistoriaUnica.historia_inicial_examen_fisico[0].Postura_Ap_Observacion);
			$("#DatoPA").val(HistoriaUnica.historia_inicial_examen_fisico[0].Postura_Pa_Dato).change();
			$("#ObservacionPA").val(HistoriaUnica.historia_inicial_examen_fisico[0].Postura_Pa_Observacion);
			$("#DatoLateral").val(HistoriaUnica.historia_inicial_examen_fisico[0].Postura_Lateral_Dato).change();
			$("#ObservacionLateral").val(HistoriaUnica.historia_inicial_examen_fisico[0].Postura_Lateral_Observacion);
			$("#DatoCuello2").val(HistoriaUnica.historia_inicial_examen_fisico[0].Postura_Cuello_Dato).change();
			$("#ObservacionCuello2").val(HistoriaUnica.historia_inicial_examen_fisico[0].Postura_Cuello_Observacion);
			$("#DatoHombro").val(HistoriaUnica.historia_inicial_examen_fisico[0].Ms_Hombro_Dato).change();
			$("#ObservacionHombro").val(HistoriaUnica.historia_inicial_examen_fisico[0].Ms_Hombro_Observacion);
			$("#DatoCodo").val(HistoriaUnica.historia_inicial_examen_fisico[0].Ms_Codo_Dato).change();
			$("#ObservacionCodo").val(HistoriaUnica.historia_inicial_examen_fisico[0].Ms_Codo_Observacion);
			$("#DatoMuneca").val(HistoriaUnica.historia_inicial_examen_fisico[0].Ms_Muneca_Dato).change();
			$("#ObservacionMuneca").val(HistoriaUnica.historia_inicial_examen_fisico[0].Ms_Muneca_Observacion);
			$("#DatoMano").val(HistoriaUnica.historia_inicial_examen_fisico[0].Ms_Mano_Dato).change();
			$("#ObservacionMano").val(HistoriaUnica.historia_inicial_examen_fisico[0].Ms_Mano_Observacion);
			$("#DatoCervical").val(HistoriaUnica.historia_inicial_examen_fisico[0].Columna_Cervical_Dato).change();
			$("#ObservacionCervical").val(HistoriaUnica.historia_inicial_examen_fisico[0].Columna_Cervical_Observacion);
			$("#DatoDorsal").val(HistoriaUnica.historia_inicial_examen_fisico[0].Columna_Dorsal_Dato).change();
			$("#ObservacionDorsal").val(HistoriaUnica.historia_inicial_examen_fisico[0].Columna_Dorsal_Observacion);
			$("#DatoLumbosaca").val(HistoriaUnica.historia_inicial_examen_fisico[0].Columna_Lumbosaca_Dato).change();
			$("#ObservacionLumbosaca").val(HistoriaUnica.historia_inicial_examen_fisico[0].Columna_Lumbosaca_Observacion);
			$("#DatoCadera").val(HistoriaUnica.historia_inicial_examen_fisico[0].Mi_Cadera_Dato).change();
			$("#ObservacionCadera").val(HistoriaUnica.historia_inicial_examen_fisico[0].Mi_Cadera_Observacion);
			$("#DatoRodilla").val(HistoriaUnica.historia_inicial_examen_fisico[0].Mi_Rodilla_Dato).change();
			$("#ObservacionRodilla").val(HistoriaUnica.historia_inicial_examen_fisico[0].Mi_Rodilla_Observacion);
			$("#DatoTobillo").val(HistoriaUnica.historia_inicial_examen_fisico[0].Mi_Tobillo_Dato).change();
			$("#ObservacionTobillo").val(HistoriaUnica.historia_inicial_examen_fisico[0].Mi_Tobillo_Observacion);

			$("#Diagnostico").val(HistoriaUnica.historia_inicial_resultado[0].Diagnostico);
			$("#IncapacidadProvisional").val(HistoriaUnica.historia_inicial_resultado[0].Incapacacidad_Provisional);
			$("#Aptitud").val(HistoriaUnica.historia_inicial_resultado[0].Aptitud_Id).change();
			$("#Recomendaciones").val(HistoriaUnica.historia_inicial_resultado[0].Recomendacion_Tratamiento);

        }).done(function(){
			$("#Registrar").hide('slow');
	    	$("#Modificar").show('slow');

	    	$("#seccion_uno").show("slow");
	    	$("#seccion_dos").show("slow");
	    	$("#seccion_tres").show("slow");
	    	$("#seccion_cuatro").show("slow");
	    	$("#seccion_cinco").show("slow");
	    	$("#seccion_seis").show("slow");
	    	$("#seccion_siete").show("slow");
	    	$("#seccion_ocho").show("slow");
	    	$("#seccion_nueve").show("slow");
	    	$("#seccion_diez").show("slow");
	    	$("#seccion_once").show("slow");

	    	$("#camposRegistro").show('slow');
			$("#verHistoriaD").modal('show');
			$("#loading").hide('slow');

		});
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
    		html += '<table id="tablaPersonasDatos" class="display nowrap" cellspacing="0" width="90%" style="text-transform: uppercase;">';
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
     	$('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
        $('#buscar span').empty();
        document.getElementById("buscar").disabled = false;    
        $("#tablaPersonas").show('slow');
        $("#loading").hide('slow');
	});
}

function Reset_campos(e){

	$("#EdadDeportiva").val('');
	$("#TablaEntrenadores").empty();

	var t = $('#TablaVisitas').DataTable();   
	t.row.add( ['1','1','1'] ).clear().draw( false );
	$("#tablaPersonas").empty();
	$("#tablaHistorias").empty();	

	$("#seccion_seis_global").show('slow');				
	$('#personas').html( '');
	$("#camposRegistro").hide('slow');
	$("#seccion_uno").hide("slow");
	$("#seccion_dos").hide("slow");
	$("#seccion_tres").hide("slow");
	$("#seccion_cuatro").hide("slow");
	$("#seccion_cinco").hide("slow");

	$("#seccion_seis").hide("slow");
	$("#seccion_siete").hide("slow");
	$("#seccion_ocho").hide("slow");
	$("#seccion_nueve").hide("slow");
	$("#seccion_diez").hide("slow");
	$("#seccion_once").hide("slow");

	$("#Metodo").hide("slow");
	$("#ObservacionCabeza").hide('slow');
	$("#ObservacionCuello").hide('slow');
	$("#ObservacionAudicion").hide('slow');
	$("#ObservacionOrl").hide('slow');
	$("#ObservacionCavidadOral").hide('slow');
	$("#ObservacionPulmonar").hide('slow');
	$("#ObservacionCardiaco").hide('slow');
	$("#ObservacionVascularPeriferico").hide('slow');
	$("#ObservacionAbdomen").hide('slow');
	$("#ObservacionGenitourinario").hide('slow');
	$("#ObservacionNeurologico").hide('slow');
	$("#ObservacionPielFaneras").hide('slow');
	$("#ObservacionAP").hide('slow');
	$("#ObservacionPA").hide('slow');
	$("#ObservacionLateral").hide('slow');
	$("#ObservacionCuello2").hide('slow');
	$("#ObservacionHombro").hide('slow');
	$("#ObservacionCodo").hide('slow');
	$("#ObservacionMuneca").hide('slow');
	$("#ObservacionMano").hide('slow');
	$("#ObservacionCervical").hide('slow');
	$("#ObservacionDorsal").hide('slow');
	$("#ObservacionLumbosaca").hide('slow');
	$("#ObservacionCadera").hide('slow');
	$("#ObservacionRodilla").hide('slow');
	$("#ObservacionTobillo").hide('slow');
	$("#Titulo").empty();

	document.getElementById("registro").reset(); 

	$("#Agrupacion").val('');
	$("#Deporte").val('');
	$("#Modalidad").val('');
	
	$("#Modificar").hide();
	$("#Registrar").hide();

	agrupacionT = '';
	deporteT = '';
	modalidadT = '';
	clasificacionT = '';

	$("#CamposConvencional").hide('slow');
	$("#CamposParalimpico").hide('slow');
}

function calculateAge(birthday) {	
    var birthday_arr = birthday.split("-");
    var birthday_date = new Date(birthday_arr[0], birthday_arr[1] - 1, birthday_arr[2]);
    var ageDifMs = Date.now() - birthday_date.getTime();
    var ageDate = new Date(ageDifMs);
    return Math.abs(ageDate.getUTCFullYear() - 1970);    
}