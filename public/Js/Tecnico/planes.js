$(function(){
});


function Buscar(e){	
	var key = $('input[name="buscador"]').val(); 
	//console.log(key);
	$.get('buscarTipoPersonaRUD/'+key,{}, function(TipoPersona){  
	//	console.log(TipoPersona);
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

					/*ShowRopa(PersonaData[0]['Id_Genero'], 1);
					ShowZapatos(PersonaData[0]['Id_Genero'], 2);			*/
		          	//document.getElementById("RUD").style.display = "block";

		          	$.each(PersonaData, function(i, e){

		              	$.get("deportista/" + e['Id_Persona'] + "", function (deportistaData) {   

		              		$("#Id_Persona").val(PersonaData[0]['Id_Persona']);
				            $("#Nombres").append(PersonaData[0]['Primer_Nombre']+' '+PersonaData[0]['Segundo_Nombre']+' '+PersonaData[0]['Primer_Apellido']+' '+PersonaData[0]['Segundo_Apellido']);
				            $("#Identificacion").append('IDENTIFICACIÓN '+PersonaData[0]['Cedula']);
				            $("#GestorDeportistas").show('slow'); 
		              //	console.log(deportistaData);

		              		if(deportistaData.deportista){  //Cuando Hay deportista    

		              		/*	$.get("getDeportistaDeporte/" + deportistaData.deportista['Id'] + "", function (DeportistaDeporte) {     
		              				agrupacionT = DeportistaDeporte['Agrupacion_Id'];
		              				deporteT = DeportistaDeporte['Deporte_Id'];
		              				modalidadT =DeportistaDeporte['Modalidad_Id'];

		              				$("#Club").val(DeportistaDeporte['Club_Id']);   
		              				$('#Club').selectpicker('refresh');           				
		              			}).done(function(){
		              				$("#ClasificacionDeportista").val(deportistaData.deportista['Clasificacion_Deportista_Id']).change();              				
		              			});

		              			if(deportistaData.deportista['Pertenece'] == 1){
			          				$.get("getEtapasD/" + deportistaData.deportista['Id'] + "", function (DeportistaEtapa) {     		
										$("#EtapaNacionalT").val(DeportistaEtapa.Nacional.pivot['Etapa_Id']);
										$("#EtapaInternacionalT").val(DeportistaEtapa.Internacional.pivot['Etapa_Id']);
										$("#Smmlv").val(DeportistaEtapa.Internacional.pivot['Smmlv']);								
			          				});
			          			} 

		          				ShowRopa(data[0]['Id_Genero'], 1, deportistaData.deportista['Sudadera_Talla_Id'], deportistaData.deportista['Camiseta_Talla_Id'], deportistaData.deportista['Pantaloneta_Talla_Id']);
								ShowZapatos(data[0]['Id_Genero'], 2, deportistaData.deportista['Tenis_Talla_Id']);

								$("#Resolucion").prop('checked', true);
								$("#Deberes").prop('checked', true);
								
								if(deportistaData.deportista['Archivo1_Url'] != ''){
									$("#SImagen").empty();
									$("#SImagen").append("<img id='Fotografia' src='' alt='' class='img-thumbnail'>");
		                			$("#Fotografia").attr('src',$("#Fotografia").attr('src')+'public/Img/Fotografias/'+deportistaData.deportista['Archivo1_Url']+'?' + (new Date()).getTime());
								}else{
									$("#Fotografia").hide();
								}
								$("#Pertenece").val(deportistaData.deportista['Pertenece']).change();		
		          				$("#deportista").val(deportistaData.deportista['Id']);						
		          				//$("#DescargaH").val(deportistaData.deportista['Id']);						
		          				//$("#DescargaH").attr("href", "Descarga/"+deportistaData.deportista['Id'])
		          				//$("#DescargaH").attr("href", "rudPDF")          				
		          				//$("#DescargaH").attr("href", "Descarga/"+deportistaData.deportista['Id']);
								$("#LugarExpedicion").val(deportistaData.deportista['Lugar_Expedicion_Id']);
								$("#FechaExpedicion").val(deportistaData.deportista['Fecha_Expedicion']);
								$("#Pasaporte").val(deportistaData.deportista['Numero_Pasaporte']);
								$("#FechaVigenciaPasaporte").val(deportistaData.deportista['Fecha_Pasaporte']);
								$("#EstadoCivil").val(deportistaData.deportista['Estado_Civil_Id']);
								$("#Estrato").val(deportistaData.deportista['Estrato_Id']);
								$("#DepartamentoNac").val(deportistaData.deportista['Departamento_Id_Nac']);
								$("#LibretaPreg").val(deportistaData.deportista['Libreta_Preg']).change();
								$("#Libreta").val(deportistaData.deportista['Numero_Libreta_Mil']);
								$("#Distrito").val(deportistaData.deportista['Distrito_Libreta_Mil']);
								$("#NombreContacto").val(deportistaData.deportista['Nombre_Contacto']);
								$("#Parentesco").val(deportistaData.deportista['Parentesco_Id']);
								$("#FijoContacto").val(deportistaData.deportista['Fijo_Contacto']);
								$("#CelularContacto").val(deportistaData.deportista['Celular_Contacto']);
								$("#TipoCuenta").val(deportistaData.deportista['Tipo_Cuenta_Id']);
								$("#Banco").val(deportistaData.deportista['Banco_Id']);
								$("#NumeroCuenta").val(deportistaData.deportista['Numero_Cuenta']);
								$("#NumeroHijos").val(deportistaData.deportista['Numero_Hijos']);
								$("#DepartamentoLoc").val(deportistaData.deportista['Departamento_Id_Localiza']);
								$("#MunicipioLoc").val(deportistaData.deportista['Ciudad_Id_Localiza']);
								$("#Direccion").val(deportistaData.deportista['Direccion_Localiza']);
								$("#Barrio").val(deportistaData.deportista['Barrio_Localiza']);
								$("#Localidad").val(deportistaData.deportista['Localidad_Id_Localiza']);
								$("#FijoLoc").val(deportistaData.deportista['Fijo_Localiza']);
								$("#CelularLoc").val(deportistaData.deportista['Celular_Localiza']);
								$("#Correo").val(deportistaData.deportista['Correo_Electronico']);
								$("#Regimen").val(deportistaData.deportista['Regimen_Salud_Id']).change();
								$("#FechaAfiliacion").val(deportistaData.deportista['Fecha_Afiliacion']);
								$("#TipoAfiliacion").val(deportistaData.deportista['Tipo_Afiliacion_Id']);
								$("#MedicinaPrepago").val(deportistaData.deportista['Medicina_Prepago']).change();
								$("#NombreMedicinaPrepago").val(deportistaData.deportista['Nombre_MedicinaPrepago']);
								$("#Eps").val(deportistaData.deportista['Eps_Id']);
								$("#NivelRegimen").val(deportistaData.deportista['Nivel_Regimen_Sub_Id']);
								$("#RiesgosLaborales").val(deportistaData.deportista['Riesgo_Laboral']);
								$("#Arl").val(deportistaData.deportista['Arl_Id']);
								$("#FondoPensionPreg").val(deportistaData.deportista['Fondo_PensionPreg_Id']).change();
								$("#FondoPension").val(deportistaData.deportista['Fondo_Pension_Id']);
								
								$("#GrupoSanguineo").val(deportistaData.deportista['Grupo_Sanguineo_Id']);
								$("#Medicamento").val(deportistaData.deportista['Uso_Medicamento']).change();
								$("#CualMedicamento").val(deportistaData.deportista['Medicamento']);
								$("#TiempoMedicamento").val(deportistaData.deportista['Tiempo_Medicamento']);		
								$("#OtroMedicoPreg").val(deportistaData.deportista['Otro_Medico_Preg']).change();
								$("#OtroMedico").val(deportistaData.deportista['Otro_Medico']);


								if(deportistaData.deportista.deportista_paralimpico[0] != null){
									$("#SeccionSeisD").show('slow');
									$("#Discapacidad").val(deportistaData.deportista.deportista_paralimpico[0]['Discapacidad_Id']).change();
									$("#Diagnostico").val(deportistaData.deportista.deportista_paralimpico[0]['Diagnostico_Id']).change();
									//$("#ClasificacionFuncional").val(deportistaData.deportista.deportista_paralimpico[0]['Clasificacion_Funcional_Id']).change();
									clasificacionT =deportistaData.deportista.deportista_paralimpico[0]['Clasificacion_Funcional_Id'];
									$("#Silla").val(deportistaData.deportista.deportista_paralimpico[0]['Silla_Id']).change();
									$("#Cuidador").val(deportistaData.deportista.deportista_paralimpico[0]['Uso_Silla_Id']).change();
									$("#Auxiliar").val(deportistaData.deportista.deportista_paralimpico[0]['Auxiliar_Id']).change();
									$("#ClasificadoNivelInternacional").val(deportistaData.deportista.deportista_paralimpico[0]['Clasificacion_Funcional_Internacional_Id']).change();
									$("#DiagnosticoEdad").val(deportistaData.deportista.deportista_paralimpico[0]['EdadAdquirido']);
									$("#FechaCI").val(deportistaData.deportista.deportista_paralimpico[0]['Fecha_Clasificacion']);
									$("#EventoCI").val(deportistaData.deportista.deportista_paralimpico[0]['Evento_Clasificacion']);
									$("#EdadDeportiva").val(deportistaData.deportista.deportista_paralimpico[0]['EdadDeportiva']).change();
									$("#resultadoNacional").val(deportistaData.deportista.deportista_paralimpico[0]['Resultado_Nacional']).change();
									$("#resultadoInternacional").val(deportistaData.deportista.deportista_paralimpico[0]['Resultado_Internacional']).change();
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

*/
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

function Reset_campos(e){
	$('#personas').html( '');
	//$("#camposRegistro").hide('slow');
	$("#GestorDeportistas").hide('slow'); 
	$("#Nombres").empty();
	$("#Identificacion").empty();
/*$("#seccion_uno").hide("slow");
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
	clasificacionT = '';*/
}