var agrupacionT = '';
var deporteT ='';
var clasificaciones_funcionales = new Array();
$(function(){
	$('#a_edicar').on('click', function(e){	
	clasificaciones_funcionales = new Array();		
		var Id_mdl=$('select[name="Id_mdl"]').val();
		if(Id_mdl==""){
			$('#div_mensaje').fadeIn(20);
			$('#div_editar').fadeOut(20);
			$('#div_eliminar').fadeOut(20);
			$('#div_nuevo').fadeOut(20);
		}else{

			$.get('configuracion/ver_modalidad/'+Id_mdl,{},function(data){
                if(data){	                	
                   $('#Id_Dept').val(data.Deporte_Id);
                   $('#nom_modl').val(data.Nombre_Modalidad);
                   $('#id_Mdl').val(data.Id);
                   $('#Id_Clasificacion').val(data.deporte.agrupacion.clasificacion_deportista['Id']).change();
                   agrupacionT = data.deporte.agrupacion['Id'];
				   deporteT = data.deporte['Id'];
				   if((data.modalidad_clasificacion_funcional).length > 0 ){
					   	$.each(data.modalidad_clasificacion_funcional, function(i, e){
					   		clasificaciones_funcionales.push({ "Id_Clasificacion_Funciona": e['Id'],
	                                 		   "Nombre_Clasificacion_Funcional": e['Nombre_Clasificacion_Funcional']
	                                 		});
					   	});
				   }
				   var html = '';

				   $.each(clasificaciones_funcionales, function(i, e){
				 		html += '<tr><td>'+e['Nombre_Clasificacion_Funcional']+'</td><td><button type="button" data-funcion="EliminarClasificacionFE" class="btn btn-danger" value="'+i+'">Eliminar</button></td></tr>';
				 	});
				 	html += '</tbody>';
				 	$("#TablaClasificacionFuncionalE").show('slow');
				 	$("#TablaClasificacionFuncionalE").html(html);				
                }
            },'json');

			$('#div_mensaje').fadeOut(20);
			$('#div_editar').show(20);
			$('#div_eliminar').fadeOut(20);
			$('#div_nuevo').fadeOut(20);
		}
		return false;
	});

	$('#a_eliminar').on('click', function(e){			
		var Id_mdl=$('select[name="Id_mdl"]').val();
		if(Id_mdl==""){
			$('#div_mensaje').fadeIn(20);
			$('#div_eliminar').fadeOut(20);
			$('#div_nuevo').fadeOut(20);
			$('#div_editar').fadeOut(20);
		}else{

			$.get(
	            'configuracion/ver_modalidad/'+Id_mdl,
	            {},
	            function(data)
	            {
	                if(data)
	                {
	                   $('#id_moalidad').val(data.Id);
	                   //$('#label_eliminar').html("¿Desea eliminar la modalidad <ins>"+data.Nombre_Modalidad+"</ins> de forma permanente del sistema?. <br>Tenga en cuenta que si elimina una modalidad se eliminara por defecto todos los datos relacionados ha este deporte. Si no esta seguro de este cambio por favor diríjase al administrador del sistema.");

	                   $('#label_eliminar').html("Para eliminar la modalidad <ins>"+data.Nombre_Modalidad+"</ins>, por favor diríjase con el administrador del sistema.");
	                }
	            },
	            'json'
	        );

			$('#div_mensaje').fadeOut(20);
			$('#div_eliminar').show(20);
			$('#div_nuevo').fadeOut(20);
			$('#div_editar').fadeOut(20);
		}
		return false;
	});

	$('#a_nuevo').on('click', function(e){			
	    $('#Id_mdl').val('');
		$('#div_mensaje').fadeOut(20);
		$('#div_nuevo').show(20);
		$('#div_eliminar').fadeOut(20);
		$('#div_editar').fadeOut(20);
		return false;
	});

	$('#btn_crear_mdl').on('click', function(e){	
		var formData = new FormData($("#form_nuevo")[0]);
		var json_vector_clasificaciones_funcionales = JSON.stringify(clasificaciones_funcionales);
        formData.append("Clasificaciones_Funcionales",json_vector_clasificaciones_funcionales);	

		$.ajax({
            type: 'POST',
            url: 'configuracion/crear_mdl',
            data: formData,
            contentType: false,
            processData: false,
           dataType: "json",
            success: function(data){

            	if(data.status == 'error')
				{			

					$("#div_mensaje2").removeClass("alert alert-warning");
					$("#div_mensaje2").addClass("alert alert-danger");	
					$("#div_mensaje2").html("<strong>Falta seleccionar campos para el registro."); 
					$('#div_mensaje2').fadeIn();
					setTimeout(function(){
						$('#div_mensaje2').fadeOut(); 
					}, 2500)  

				}else{	
					document.getElementById("form_nuevo").reset();
					
				    $("#div_mensaje2").removeClass("alert alert-danger");		
					$("#div_mensaje2").addClass("alert alert-success");			
					$("#div_mensaje2").html("<strong>Se ha registrado exitosamente la modalidad: </strong> "+data.Nombre_Modalidad); 
					$('#div_mensaje2').fadeIn();
					setTimeout(function(){
						$('#div_mensaje2').fadeOut(); 
					}, 2500)  
					$("#TablaClasificacionFuncional").empty();
					clasificaciones_funcionales = new Array();
				}

            }
	    });
	});


	$('#btn_eliminar_mdl').on('click', function(e){
		var id=$('#id_moalidad').val();
		    $.get(
	            'configuracion/eliminarModalidad/'+id,
	            {},
	            function(data){
	                if(data.status == 'True'){
	                	$('#div_eliminar').fadeOut();
	                    $("#div_mensaje2").removeClass("alert alert-danger");
						$("#div_mensaje2").addClass("alert alert-success");	
						$("#div_mensaje2").html("<strong>Modalidad eliminada con exíto."); 
						$('#div_mensaje2').fadeIn();
						setTimeout(function(){
							$('#div_mensaje2').fadeOut(); 
						}, 2500) 
	                }
	                else{
	                	$('#div_eliminar').fadeOut();
	                    $("#div_mensaje2").removeClass("alert alert-success");
						$("#div_mensaje2").addClass("alert alert-danger");	
						$("#div_mensaje2").html("<strong>No se elimino la modalidad, por favor averiguar con el encargado del sistema."); 
						setTimeout(function(){
							$('#div_mensaje2').fadeOut(); 
						}, 2500) 
	                }
	            },
	            'json'
	        );
	});


	$('#btn_editar').on('click', function(e){
		var formData = new FormData($("#form_edit")[0]);
		var json_vector_clasificaciones_funcionales = JSON.stringify(clasificaciones_funcionales);
        formData.append("Clasificaciones_Funcionales",json_vector_clasificaciones_funcionales);	
		$.ajax({
            type: 'POST',
            url: 'configuracion/modificar_mdl',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
            	if(data.status == 'error'){								
					$("#div_mensaje2").removeClass("alert alert-warning");
					$("#div_mensaje2").addClass("alert alert-danger");	
					$("#div_mensaje2").html("<strong>Falta seleccionar campos para el registro."); 
					$('#div_mensaje2').fadeIn();
					setTimeout(function(){
						$('#div_mensaje2').fadeOut(); 
					}, 2500)  
				}else{	
					
				    $("#div_mensaje2").removeClass("alert alert-danger");		
					$("#div_mensaje2").addClass("alert alert-success");			
					$("#div_mensaje2").html("<strong>Se ha modificado exitosamente la modalidad: </strong> "+data.Nombre_Modalidad); 
					$('#div_mensaje2').fadeIn();
					setTimeout(function(){
						$('#div_mensaje2').fadeOut(); 
					}, 2500)  
				}
            }
	    });
	});


	$('#cerrar_actividad').delegate('button[data-funcion="cerrar"]','click',function (e) {   
        $(".form-control").val('');
        vector_datos_actividades.length=0;
		vector_acompañantes.length=0;
    }); 


    $('#example').DataTable({
        retrieve: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        dom: 'Bfrtip',
        select: true,
        "responsive": true,
        "ordering": true,
        "info": true,
        "language": {
            url: 'public/DataTables/Spanish.json',
            searchPlaceholder: "Buscar"
        }
    });  

    $('#Id_Clase').on('change', function(){
    	$('#Id_Agrupa').empty();
    	$('#Id_Agrupa').append("<option value=''>Seleccionar</option>");
    	var id = $("#Id_Clase").val();
		if(id != ''){
			$.get("getAgrupacion/" + id, function (agrupacion) {
				$.each(agrupacion, function(i, e){
					$("#Id_Agrupa").append("<option value='" +e.Id + "'>" + e.Nombre_Agrupacion + "</option>");
				});				
			}).done(function(){
				$("#Id_Agrupa").val(agrupacionT).change();
				agrupacionT = '';
			});

			if($(this).val() == 2){
				$("#ClasificacionFuncionalD").show('slow');
			}else{
				$("#ClasificacionFuncionalD").hide('slow');
			}
		}	
    }); 

    $("#Id_Agrupa").on('change',function (e){
		$("#Id_Deporte").empty();
		$("#Id_Deporte").append("<option value=''>Seleccionar</option>");

		var id = $("#Id_Agrupa").val();
		if(id != ''){
			$.get("getDeporte/" + id, function (deporte) {
				$.each(deporte.deporte, function(i, e){
					$("#Id_Deporte").append("<option value='" +e.Id + "'> " + e.Id+"- "+ e.Nombre_Deporte + "</option>");
				});				
			}).done(function(){
				$("#Id_Deporte").val(deporteT).change();
				deporteT = '';
			});
		}		
	});

	 $('#Id_Clasificacion').on('change', function(){
    	$('#Id_Agrupacion').empty();
    	$('#Id_Agrupacion').append("<option value=''>Seleccionar</option>");
    	var id = $("#Id_Clasificacion").val();
		if(id != ''){
			$.get("getAgrupacion/" + id, function (agrupacion) {
				$.each(agrupacion, function(i, e){
					$("#Id_Agrupacion").append("<option value='" +e.Id + "'>" + e.Nombre_Agrupacion + "</option>");
				});				
			}).done(function(){
				$("#Id_Agrupacion").val(agrupacionT).change();
				agrupacionT = '';
			});

			if($(this).val() == 2){
				$("#ClasificacionFuncionalDE").show('slow');
			}else{
				$("#ClasificacionFuncionalDE").hide('slow');
			}
		}	
    });

	 $("#Id_Agrupacion").on('change',function (e){
		$("#Id_Dept").empty();
		$("#Id_Dept").append("<option value=''>Seleccionar</option>");

		var id = $("#Id_Agrupacion").val();
		if(id != ''){
			$.get("getDeporte/" + id, function (deporte) {
				$.each(deporte.deporte, function(i, e){
					$("#Id_Dept").append("<option value='" +e.Id + "'>" + e.Nombre_Deporte + "</option>");
				});				
			}).done(function(){
				$("#Id_Dept").val(deporteT).change();
				deporteT = '';
			});
		}		
	});

	 /******************************CORRECCIONES LÍNEA DEPORTIVA PARALIMPICO***********************************************/

	 $("#AddClasificacionFuncional").on('click', function(){
	 	if($("#Id_Clasificacion_Funcional").val() != ''){
		 	$("#TablaClasificacionFuncional").hide('slow');
		 	$("#TablaClasificacionFuncional").empty();
		 	var html = '<thead><th>CLASIFICACIÓN FUNCIONAL</th><th>OPCIONES</th></thead><tbody>';
		 	clasificaciones_funcionales.push({ "Id_Clasificacion_Funciona": $("#Id_Clasificacion_Funcional").val(),
	                                 		   "Nombre_Clasificacion_Funcional": $("#Id_Clasificacion_Funcional option:selected").text()
	                                 		});

		 	clasificaciones_funcionales = removeDuplicates(clasificaciones_funcionales, "Id_Clasificacion_Funciona");
		 	$.each(clasificaciones_funcionales, function(i, e){
		 		html += '<tr><td>'+e['Nombre_Clasificacion_Funcional']+'</td><td><button type="button" data-funcion="EliminarClasificacionF" class="btn btn-danger" value="'+i+'">Eliminar</button></td></tr>';
		 	});
		 	html += '</tbody>';
		 	$("#TablaClasificacionFuncional").show('slow');
		 	$("#TablaClasificacionFuncional").html(html);

		 	$("#Id_Clasificacion_Funcional").val('').change();
		 }
	 });


	$('#TablaClasificacionFuncional').delegate('button[data-funcion="EliminarClasificacionF"]','click',function (e) {  
		clasificaciones_funcionales.splice(($(this).val()), 1);
		$("#TablaClasificacionFuncional").hide('slow');
		 	$("#TablaClasificacionFuncional").empty();
		 	var html = '<thead><th>CLASIFICACIÓN FUNCIONAL</th><th>OPCIONES</th></thead><tbody>';
		 	clasificaciones_funcionales.push({ "Id_Clasificacion_Funciona": $("#Id_Clasificacion_Funcional").val(),
	                                 		   "Nombre_Clasificacion_Funcional": $("#Id_Clasificacion_Funcional option:selected").text()
	                                 		});

		 	clasificaciones_funcionales = removeDuplicates(clasificaciones_funcionales, "Id_Clasificacion_Funciona");
		 	$.each(clasificaciones_funcionales, function(i, e){
		 		html += '<tr><td>'+e['Nombre_Clasificacion_Funcional']+'</td><td><button type="button" data-funcion="EliminarClasificacionF" class="btn btn-danger" value="'+e['Id_Clasificacion_Funciona']+'">Eliminar</button></td></tr>';
		 	});
		 	html += '</tbody>';
		 	$("#TablaClasificacionFuncional").show('slow');
		 	$("#TablaClasificacionFuncional").html(html);
	});

	 function removeDuplicates(originalArray, prop) {
	    var newArray = [];
	    var lookupObject  = {};

	    for(var i in originalArray) {
	       lookupObject[originalArray[i][prop]] = originalArray[i];
	    }

	    for(i in lookupObject) {
	        newArray.push(lookupObject[i]);
	    }
	    return newArray;
	 }


	 $("#AddClasificacionFuncionalE").on('click', function(){
	 	if($("#Id_Clasificacion_FuncionalE").val() != ''){
		 	$("#TablaClasificacionFuncionalE").hide('slow');
		 	$("#TablaClasificacionFuncionalE").empty();
		 	var html = '<thead><th>CLASIFICACIÓN FUNCIONAL</th><th>OPCIONES</th></thead><tbody>';
		 	clasificaciones_funcionales.push({ "Id_Clasificacion_Funciona": $("#Id_Clasificacion_Funcional").val(),
	                                 		   "Nombre_Clasificacion_Funcional": $("#Id_Clasificacion_Funcional option:selected").text()
	                                 		});

		 	clasificaciones_funcionales = removeDuplicates(clasificaciones_funcionales, "Id_Clasificacion_Funciona");
		 	$.each(clasificaciones_funcionales, function(i, e){
		 		html += '<tr><td>'+e['Nombre_Clasificacion_Funcional']+'</td><td><button type="button" data-funcion="EliminarClasificacionFE" class="btn btn-danger" value="'+i+'">Eliminar</button></td></tr>';
		 	});
		 	html += '</tbody>';
		 	$("#TablaClasificacionFuncionalE").show('slow');
		 	$("#TablaClasificacionFuncionalE").html(html);

		 	$("#Id_Clasificacion_FuncionalE").val('').change();
		 }
	 });

	 $('#TablaClasificacionFuncionalE').delegate('button[data-funcion="EliminarClasificacionFE"]','click',function (e) { 
		clasificaciones_funcionales.splice(($(this).val()), 1);
		$("#TablaClasificacionFuncionalE").hide('slow');
	 	$("#TablaClasificacionFuncionalE").empty();
	 	var html = '<thead><th>CLASIFICACIÓN FUNCIONAL</th><th>OPCIONES</th></thead><tbody>';

	 	clasificaciones_funcionales = removeDuplicates(clasificaciones_funcionales, "Id_Clasificacion_Funciona");
	 	$.each(clasificaciones_funcionales, function(i, e){
	 		html += '<tr><td>'+e['Nombre_Clasificacion_Funcional']+'</td><td><button type="button" data-funcion="EliminarClasificacionFE" class="btn btn-danger" value="'+e['Id_Clasificacion_Funciona']+'">Eliminar</button></td></tr>';
	 	});
	 	html += '</tbody>';
	 	$("#TablaClasificacionFuncionalE").show('slow');
	 	$("#TablaClasificacionFuncionalE").html(html);
	});
});