var agrupacionT = '';
var deporteT = '';
var modalidadT = '';
$(function(e){
	$.datepicker.setDefaults($.datepicker.regional["es"]);	
	$('#FechaExpedicionDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaVigenciaPasaporteDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#fechaNacDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaAfiliacionDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});

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
			$.get("getAgrupacion/" + id, function (agrupacion) {
				$.each(agrupacion.agrupacion, function(i, e){
					$("#Agrupacion").append("<option value='" +e.Id + "'>" + e.Nombre_Agrupacion + "</option>");
				});				
			}).done(function(){
				$("#Agrupacion").val(agrupacionT).change();
				agrupacionT = '';
			});
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

	$("#Deporte").on('change',function (e){
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

	$("#Profesional").on('change', function(){
		var id = $(this).val();
		if(id==1){			
			$("#perfil_profesional").show("slow");
		}else if(id == 2){
			$("#perfil_profesional").hide("slow");
		}
	});

	$("#Registrar").on('click', function(){				
		registro('AddEntrenador');
	});

	$("#Modificar").on('click', function(){
		registro('EditEntrenador');

	});  

	function registro (url){		
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

	var validador_errores = function(data){
		$('#registro .form-group').removeClass('has-error');
		$("#seccion_uno").show("slow");
		$("#seccion_dos").show("slow");
		$("#seccion_tres").show("slow");
		$("#seccion_cuatro").show("slow");
		$("#seccion_cinco").show("slow");
		$("#seccion_seis").show("slow");

		$.each(data, function(i, e){
			$("#"+i).closest('.form-group').addClass('has-error');
      	});
	}
});

function Buscar(e){	
	var key = $('input[name="buscador"]').val(); 
	$.get('buscarTipoPersona/'+key,{}, function(TipoPersona){  
		if(TipoPersona.Respuesta == 1){
			$('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
            $('#buscar span').empty();
            document.getElementById("buscar").disabled = false;
            $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">'+TipoPersona.Mensaje+'</h4></dvi><br>');
            $('#paginador').fadeOut();
		}else if(TipoPersona.Respuesta== 2){
			$.get('personaBuscarDeportista/'+key,{}, function(PersonaData){  				
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

				ShowRopa(PersonaData[0]['Id_Genero'], 1);
				ShowZapatos(PersonaData[0]['Id_Genero'], 2);			
	          	document.getElementById("RUD").style.display = "block";

	          	$.get("entrenador/" + PersonaData[0]['Id_Persona'] + "", function (EntrenadorData) {

	          		if(EntrenadorData.entrenador){  //Cuando Hay entrenador  	          			
	          			if(EntrenadorData.entrenador['Archivo1_Url'] != ''){
							$("#SImagen").empty();
							$("#SImagen").append("<img id='Fotografia' src='' alt='' class='img-thumbnail'>");
                			$("#Fotografia").attr('src',$("#Fotografia").attr('src')+'public/Img/EntrenadorFotografias/'+EntrenadorData.entrenador['Archivo1_Url']+'?' + (new Date()).getTime());
						}else{
							$("#Fotografia").hide();
						}

          				$("#entrenador").val(EntrenadorData.entrenador['Id']);						
						$("#LugarExpedicion").val(EntrenadorData.entrenador['Lugar_Expedicion_Id']);
						$("#FechaExpedicion").val(EntrenadorData.entrenador['Fecha_Expedicion']);
						$("#Pasaporte").val(EntrenadorData.entrenador['Numero_Pasaporte']);
						$("#FechaVigenciaPasaporte").val(EntrenadorData.entrenador['Fecha_Pasaporte']);
						$("#EstadoCivil").val(EntrenadorData.entrenador['Estado_Civil_Id']);
						$("#Estrato").val(EntrenadorData.entrenador['Estrato_Id']);
						$("#DepartamentoNac").val(EntrenadorData.entrenador['Departamento_Id_Nac']);
						$("#LibretaPreg").val(EntrenadorData.entrenador['Libreta_Preg']).change();
						$("#Libreta").val(EntrenadorData.entrenador['Numero_Libreta_Mil']);
						$("#Distrito").val(EntrenadorData.entrenador['Distrito_Libreta_Mil']);
						$("#NombreContacto").val(EntrenadorData.entrenador['Nombre_Contacto']);
						$("#Parentesco").val(EntrenadorData.entrenador['Parentesco_Id']);
						$("#FijoContacto").val(EntrenadorData.entrenador['Fijo_Contacto']);
						$("#CelularContacto").val(EntrenadorData.entrenador['Celular_Contacto']);
						$("#TipoCuenta").val(EntrenadorData.entrenador['Tipo_Cuenta_Id']);
						$("#Banco").val(EntrenadorData.entrenador['Banco_Id']);
						$("#NumeroCuenta").val(EntrenadorData.entrenador['Numero_Cuenta']);
						$("#NumeroHijos").val(EntrenadorData.entrenador['Numero_Hijos']);
						$("#DepartamentoLoc").val(EntrenadorData.entrenador['Departamento_Id_Localiza']);
						$("#MunicipioLoc").val(EntrenadorData.entrenador['Ciudad_Id_Localiza']);
						$("#Direccion").val(EntrenadorData.entrenador['Direccion_Localiza']);
						$("#Barrio").val(EntrenadorData.entrenador['Barrio_Localiza']);
						$("#Localidad").val(EntrenadorData.entrenador['Localidad_Id_Localiza']);
						$("#FijoLoc").val(EntrenadorData.entrenador['Fijo_Localiza']);
						$("#CelularLoc").val(EntrenadorData.entrenador['Celular_Localiza']);
						$("#Correo").val(EntrenadorData.entrenador['Correo_Electronico']);
						$("#Regimen").val(EntrenadorData.entrenador['Regimen_Salud_Id']).change();
						$("#FechaAfiliacion").val(EntrenadorData.entrenador['Fecha_Afiliacion']);
						$("#TipoAfiliacion").val(EntrenadorData.entrenador['Tipo_Afiliacion_Id']);
						$("#MedicinaPrepago").val(EntrenadorData.entrenador['Medicina_Prepago']).change();
						$("#NombreMedicinaPrepago").val(EntrenadorData.entrenador['Nombre_MedicinaPrepago']);
						$("#Eps").val(EntrenadorData.entrenador['Eps_Id']);
						$("#NivelRegimen").val(EntrenadorData.entrenador['Nivel_Regimen_Sub_Id']);
						$("#RiesgosLaborales").val(EntrenadorData.entrenador['Riesgo_Laboral']);
						$("#Arl").val(EntrenadorData.entrenador['Arl_Id']);
						$("#FondoPensionPreg").val(EntrenadorData.entrenador['Fondo_PensionPreg_Id']).change();
						$("#FondoPension").val(EntrenadorData.entrenador['Fondo_Pension_Id']);
						
						$("#GrupoSanguineo").val(EntrenadorData.entrenador['Grupo_Sanguineo_Id']);
						$("#Medicamento").val(EntrenadorData.entrenador['Uso_Medicamento']).change();
						$("#CualMedicamento").val(EntrenadorData.entrenador['Medicamento']);
						$("#TiempoMedicamento").val(EntrenadorData.entrenador['Tiempo_Medicamento']);		
						$("#OtroMedicoPreg").val(EntrenadorData.entrenador['Otro_Medico_Preg']).change();
						$("#OtroMedico").val(EntrenadorData.entrenador['Otro_Medico']);  

						$("#Profesional").val(EntrenadorData.entrenador['Profesional_Preg']).change();
			            $("#TituloPregrado").val(EntrenadorData.entrenador['Titulo_Pregrado']);
			            $("#TituloEspecializacion").val(EntrenadorData.entrenador['Titulo_Especializacion']);
			            $("#TituloMaestria").val(EntrenadorData.entrenador['Titulo_Maestria']);
			            $("#TituloDoctorado").val(EntrenadorData.entrenador['Titulo_Doctorado']);
			            $("#EscalafonEntrenadores").val(EntrenadorData.entrenador['Curso_Entrenadores']);

						agrupacionT = EntrenadorData.entrenador['Agrupacion_Id'];
          				deporteT = EntrenadorData.entrenador['Deporte_Id'];
          				modalidadT = EntrenadorData.entrenador['Modalidad_Id'];

						$("#ClasificacionDeportista").val(EntrenadorData.entrenador['Clasificacion_Deportista_Id']).change(); 

						ShowRopa(PersonaData[0]['Id_Genero'], 1, EntrenadorData.entrenador['Sudadera_Talla_Id'], EntrenadorData.entrenador['Camiseta_Talla_Id'], EntrenadorData.entrenador['Pantaloneta_Talla_Id']);
						ShowZapatos(PersonaData[0]['Id_Genero'], 2, EntrenadorData.entrenador['Tenis_Talla_Id']);    
						
						$("#seccion_uno").show("slow");
						$("#seccion_dos").show("slow");
						$("#seccion_tres").show("slow");
						$("#seccion_cuatro").show("slow");
						$("#seccion_cinco").show("slow");
						$("#seccion_seis").show("slow");

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

	          	/*$.get("deportista/" + e['Id_Persona'] + "", function (responseDep) {       

              		
             	}).done(function (){             		
                    $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
                    $('#buscar span').empty();
                 	document.getElementById("buscar").disabled = false;     
                 	$("#camposRegistro").show('slow');            	
      			});
          	});*/
			});
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
	$('#personas').html('');
	$("#camposRegistro").hide('slow');
	$("#seccion_uno").hide("slow");
	$("#seccion_dos").hide("slow");
	$("#seccion_tres").hide("slow");
	$("#seccion_cuatro").hide("slow");
	$("#seccion_cinco").hide("slow");
	$("#seccion_seis").hide("slow");

	$("#LugarExpedicion").val('');
	$("#FechaExpedicion").val('');
	$("#Pasaporte").val('');
	$("#FechaVigenciaPasaporte").val('');
	$("#EstadoCivil").val('');
	$("#Estrato").val('');
	$("#DepartamentoNac").val('');
	$("#LibretaPreg").val('').change();
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
	
	$("#GrupoSanguineo").val('');
	$("#Medicamento").val('').change();
	$("#CualMedicamento").val('');
	$("#TiempoMedicamento").val('');		
	$("#OtroMedicoPreg").val('').change();
	$("#OtroMedico").val('');  

	$("#Profesional").val('').change();
    $("#TituloPregrado").val('');
    $("#TituloEspecializacion").val('');
    $("#TituloMaestria").val('');
    $("#TituloDoctorado").val('');
    $("#EscalafonEntrenadores").val('');

	$("#Modificar").hide();
	$("#Registrar").hide();
}