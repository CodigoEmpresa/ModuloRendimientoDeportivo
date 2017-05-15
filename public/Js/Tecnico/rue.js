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

  	$.each(Persona.tipo, function(i, e){
      if(e.Id_Tipo == 49){
        $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
        $('#buscar span').empty();
        document.getElementById("buscar").disabled = false;
        $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">Esta persona ya se encuentra registrada como un deportista, por favor verifique la información!</h4></dvi><br>');
        $('#paginador').fadeOut();
        $("#camposRegistro").hide("slow");
        $("#loading").hide('slow');           
        return false;
      }else{
		$("#camposRegistro").show("slow");
		$("#loading").hide('slow');          	
	  }
  	});

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

	if(Persona.entrenador){  //Cuando Hay entrenador  	          			
		if(Persona.entrenador['Archivo1_Url'] != ''){
		$("#SImagen").empty();
		$("#SImagen").append("<img id='Fotografia' src='' alt='' class='img-thumbnail'>");
		$("#Fotografia").attr('src',$("#Fotografia").attr('src')+'public/Img/EntrenadorFotografias/'+Persona.entrenador['Archivo1_Url']+'?' + (new Date()).getTime());
	}else{
		$("#Fotografia").hide();
	}
		$("#entrenador").val(Persona.entrenador['Id']);						
		$("#LugarExpedicion").val(Persona.entrenador['Lugar_Expedicion_Id']);
		$("#FechaExpedicion").val(Persona.entrenador['Fecha_Expedicion']);
		$("#Pasaporte").val(Persona.entrenador['Numero_Pasaporte']);
		$("#FechaVigenciaPasaporte").val(Persona.entrenador['Fecha_Pasaporte']);
		$("#EstadoCivil").val(Persona.entrenador['Estado_Civil_Id']);
		$("#Estrato").val(Persona.entrenador['Estrato_Id']);
		$("#DepartamentoNac").val(Persona.entrenador['Departamento_Id_Nac']);
		$("#LibretaPreg").val(Persona.entrenador['Libreta_Preg']).change();
		$("#Libreta").val(Persona.entrenador['Numero_Libreta_Mil']);
		$("#Distrito").val(Persona.entrenador['Distrito_Libreta_Mil']);
		$("#NombreContacto").val(Persona.entrenador['Nombre_Contacto']);
		$("#Parentesco").val(Persona.entrenador['Parentesco_Id']);
		$("#FijoContacto").val(Persona.entrenador['Fijo_Contacto']);
		$("#CelularContacto").val(Persona.entrenador['Celular_Contacto']);
		$("#TipoCuenta").val(Persona.entrenador['Tipo_Cuenta_Id']);
		$("#Banco").val(Persona.entrenador['Banco_Id']);
		$("#NumeroCuenta").val(Persona.entrenador['Numero_Cuenta']);
		$("#NumeroHijos").val(Persona.entrenador['Numero_Hijos']);
		$("#DepartamentoLoc").val(Persona.entrenador['Departamento_Id_Localiza']);
		$("#MunicipioLoc").val(Persona.entrenador['Ciudad_Id_Localiza']);
		$("#Direccion").val(Persona.entrenador['Direccion_Localiza']);
		$("#Barrio").val(Persona.entrenador['Barrio_Localiza']);
		$("#Localidad").val(Persona.entrenador['Localidad_Id_Localiza']);
		$("#FijoLoc").val(Persona.entrenador['Fijo_Localiza']);
		$("#CelularLoc").val(Persona.entrenador['Celular_Localiza']);
		$("#Correo").val(Persona.entrenador['Correo_Electronico']);
		$("#Regimen").val(Persona.entrenador['Regimen_Salud_Id']).change();
		$("#FechaAfiliacion").val(Persona.entrenador['Fecha_Afiliacion']);
		$("#TipoAfiliacion").val(Persona.entrenador['Tipo_Afiliacion_Id']);
		$("#MedicinaPrepago").val(Persona.entrenador['Medicina_Prepago']).change();
		$("#NombreMedicinaPrepago").val(Persona.entrenador['Nombre_MedicinaPrepago']);
		$("#Eps").val(Persona.entrenador['Eps_Id']);
		$("#NivelRegimen").val(Persona.entrenador['Nivel_Regimen_Sub_Id']);
		$("#RiesgosLaborales").val(Persona.entrenador['Riesgo_Laboral']);
		$("#Arl").val(Persona.entrenador['Arl_Id']);
		$("#FondoPensionPreg").val(Persona.entrenador['Fondo_PensionPreg_Id']).change();
		$("#FondoPension").val(Persona.entrenador['Fondo_Pension_Id']);
		
		$("#GrupoSanguineo").val(Persona.entrenador['Grupo_Sanguineo_Id']);
		$("#Medicamento").val(Persona.entrenador['Uso_Medicamento']).change();
		$("#CualMedicamento").val(Persona.entrenador['Medicamento']);
		$("#TiempoMedicamento").val(Persona.entrenador['Tiempo_Medicamento']);		
		$("#OtroMedicoPreg").val(Persona.entrenador['Otro_Medico_Preg']).change();
		$("#OtroMedico").val(Persona.entrenador['Otro_Medico']);  

		$("#Profesional").val(Persona.entrenador['Profesional_Preg']).change();
	    $("#TituloPregrado").val(Persona.entrenador['Titulo_Pregrado']);
	    $("#TituloEspecializacion").val(Persona.entrenador['Titulo_Especializacion']);
	    $("#TituloMaestria").val(Persona.entrenador['Titulo_Maestria']);
	    $("#TituloDoctorado").val(Persona.entrenador['Titulo_Doctorado']);
	    $("#EscalafonEntrenadores").val(Persona.entrenador['Curso_Entrenadores']);

		agrupacionT = Persona.entrenador['Agrupacion_Id'];
		deporteT = Persona.entrenador['Deporte_Id'];
		modalidadT = Persona.entrenador['Modalidad_Id'];

		$("#ClasificacionDeportista").val(Persona.entrenador['Clasificacion_Deportista_Id']).change(); 

		ShowRopa(Persona['Id_Genero'], 1, Persona.entrenador['Sudadera_Talla_Id'], Persona.entrenador['Camiseta_Talla_Id'], Persona.entrenador['Pantaloneta_Talla_Id']);
		ShowZapatos(Persona['Id_Genero'], 2, Persona.entrenador['Tenis_Talla_Id']);    
		
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
          html += "<td><button type='button' class='btn btn-primary' data-function='VerPersona' value='"+e.Id_Persona+"'>"+
                             "<span class='glyphicon glyphicon-zoom-in' aria-hidden='true'></span> Ver Entrenador"+
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