$(function(e){ 
	/*$("#Diagnostico").on('change', function(){
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
	});*/

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
	
	/*$('#FechaExpedicionDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaVigenciaPasaporteDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#fechaNacDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaAfiliacionDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaCI').datepicker({format: 'yyyy-mm-dd', autoclose: true,});*/

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

	/*$("#seccion_compromiso_ver").on('click', function(e){
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
	});*/

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
	
	/*$("#LibretaPreg").on('change',function (e){
		var id = $("#LibretaPreg").val();
		if(id==1){			
			$("#militares").show("slow");
		}else if(id == 2){
			$("#militares").hide("slow");
		}
	});*/

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

	/*$("#Pertenece").on('change', function(){
		id = $("#Pertenece").val();
		if(id == 1){
			$("#DeportistaEtapas").show('slow');
			$("#seccion_seis_global").show('slow');			
		}else if(id == 2){
			$("#DeportistaEtapas").hide('slow');
			$("#seccion_seis_global").hide('slow');			
		}
	});*/

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

	$('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
	$('#buscar span').empty();
	document.getElementById("buscar").disabled = false;
	$("#loading").show('slow');
	$("#tablaPersonas").hide('slow');   
	$("#camposRegistro").hide("slow");
	$("#loading").show('slow');

	$.get('buscarPersona/'+id_persona,{}, function(Persona){  
		console.log(Persona);
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
	    	$("#persona").val(Persona['Id_Persona']);        	
	    	$("#Nombres").val(Persona['Primer_Nombre']+' '+Persona['Segundo_Nombre']);        	
			$("#Apellidos").val(Persona['Primer_Apellido']+' '+Persona['Segundo_Apellido']);
			$("#TipoDocumento").val(Persona.tipo_documento['Descripcion_TipoDocumento']);
			$("#NumeroDocumento").val(Persona['Cedula']);
			$("#fechaNac").val(Persona['Fecha_Nacimiento']);
			$("#PaisNac").val(Persona['Id_Pais']);
			$("#MunicipioNac").val(Persona['Nombre_Ciudad']);
			$("#Genero").val(Persona['Id_Genero']);

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
				htmlEntrenadores += '<table id="tablaEntrenadorDatos" class="display nowrap" cellspacing="0" width="100%" style="text-transform: uppercase;">';
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

			if(Persona.deportista.deportista_historia_inicial.length > 0){
				$("#Ocupacion").val(Persona.deportista.deportista_historia_inicial[0].Ocupacion_Id).change();
				$("#NivelEstudio").val(Persona.deportista.deportista_historia_inicial[0].NivelEstudio_Id).change();
				$("#Dominancia").val(Persona.deportista.deportista_historia_inicial[0].Dominancia_Id).change();
				$("#NombreMadre").val(Persona.deportista.deportista_historia_inicial[0].Nombre_Madre);
				$("#NombrePadre").val(Persona.deportista.deportista_historia_inicial[0].Nombre_Padre);
				$("#EntrenamientoContinuoPreg").val(Persona.deportista.deportista_historia_inicial[0].Entrenamiento_Continuo_Preg).change();
				//$("#PlanEntrenamientoPreg").val(Persona.deportista.deportista_historia_inicial[0].);
				/*$("#NombreAcudiente").val(Persona.deportista.deportista_historia_inicial[0].Nombre_Acudiente);
				$("#TelefonoAcudiente").val(Persona.deportista.deportista_historia_inicial[0].Telefono_Acudiente);
				$("#NombreResponsable").val(Persona.deportista.deportista_historia_inicial[0].Nombre_Responsable);
				$("#TelefonoResponsable").val(Persona.deportista.deportista_historia_inicial[0].Telefono_Responsable);*/				
	        	$("#Registrar").hide('slow');
	        	$("#Modificar").show('slow');
			}else{
				//alert('NO hay historia');
				$("#Registrar").show('slow');
	        	$("#Modificar").hide('slow');
			}
	        $("#seccion_uno").show("slow");
	        $("#camposRegistro").show('slow');
	      	
	    }else{          
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

function Reset_campos(e){

	$("#EdadDeportiva").val('');
	$("#TablaEntrenadores").empty();

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

	
	$("#ClasificacionDeportista").val('').change();	
	$("#EstadoCivil").val('');
	$("#Estrato").val('');
	$("#DepartamentoNac").val('');
	$("#DepartamentoLoc").val('');
	$("#MunicipioLoc").val('');
	$("#Direccion").val('');
	$("#Localidad").val('');
	$("#FijoLoc").val('');
	$("#CelularLoc").val('');
	$("#MedicinaPrepago").val('').change();
	$("#NombreMedicinaPrepago").val('');
	$("#Eps").val('');
	$("#GrupoSanguineo").val('');

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
	
	$("#Modificar").hide();
	$("#Registrar").hide();

	agrupacionT = '';
	deporteT = '';
	modalidadT = '';
	clasificacionT = '';

	$("#CamposConvencional").hide('slow');
	$("#CamposParalimpico").hide('slow');
}