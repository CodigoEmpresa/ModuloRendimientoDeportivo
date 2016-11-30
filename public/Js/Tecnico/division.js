$(function()
{
	$('#a_editar').on('click', function(e){			
		$("#loadingE").show('slow');	                   
		var Id_division=$('select[name="Id_Division"]').val();
		if(Id_division == ""){
			$('#div_mensaje').fadeIn(20);
			$('#div_editar').fadeOut(20);
			$('#div_eliminar').fadeOut(20);
			$('#div_nuevo').fadeOut(20);
		}else{
			$.get(
	            'configuracion/ver_division/'+Id_division,
	            {},
	            function(data)
	            {
	                if(data)
	                {	                   
	                   $("#Clasificacion_IdE").val(data['Clasificacion_Deportista_Id']).change();
	                   setTimeout(function(){ $("#Agrupacion_IdE").val(data['Agrupacion_Id']).change();  }, 500);
	                   setTimeout(function(){ $("#Deporte_IdE").val(data['Deporte_Id']).change();   }, 1000);
	                   setTimeout(function(){ $("#Modalidad_IdE").val(data['Modalidad_Id']).change();  }, 1500);
	                   $("#Rama_IdE").val(data['Rama_Id']).change();
	                   $("#Categoria_IdE").val(data['Categoria_Id']).change();
	                   $('#Tipo_Evaluacion_E').val(data.tipo_evaluacion['Id']).change();
	                   $('#nom_division').val(data.Nombre_Division);
	                   $('#Id_division').val(data.Id);	                   
	                   
	                }
	            },
	            'json'
	        );
			setTimeout(function(){  
				$("#loadingE").hide('slow');  
				$('#div_mensaje').fadeOut(20);
				$('#div_editar').show(20);
				$('#div_eliminar').fadeOut(20);
				$('#div_nuevo').fadeOut(20);
			}, 1510);
			
		}
		return false;
	});

	$('#btn_editar').on('click', function(e){
		$.ajax({
            type: 'POST',
            url: 'configuracion/modificar_div',
            data: $('#form_edit').serialize(),
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
					$("#div_mensaje2").html("<strong>Se ha modificado exitosamente la prueba/división: </strong> "); 
					$('#div_mensaje2').fadeIn();
					setTimeout(function(){
						$('#div_mensaje2').fadeOut(); 
					}, 2500)  
				}
            }
	    });
	});

	$('#a_eliminar').on('click', function(e){			
		var Id_division=$('select[name="Id_Division"]').val();
		if(Id_division==""){
			$('#div_mensaje').fadeIn(20);
			$('#div_eliminar').fadeOut(20);
			$('#div_nuevo').fadeOut(20);
			$('#div_editar').fadeOut(20);
		}else{

			$.get(
	            'configuracion/ver_division/'+Id_division,
	            {},
	            function(data)
	            {
	                if(data)
	                {
	                   $('#id_division_e').val(data.Id);
	                   //$('#label_eliminar').html("¿Desea eliminar la división <ins>"+data.Nombre_Division+"</ins> de forma permanente del sistema?. <br>Tenga en cuenta que si elimina una división se eliminara por defecto todos los datos relacionados ha esta. Si no esta seguro de este cambio por favor diríjase al administrador del sistema.");
	                   $('#label_eliminar').html("Para eliminar la prueba/división <ins>"+data.Nombre_Division+"</ins>, por favor diríjase con el administrador del sistema.");
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

	$('#btn_eliminar_rm').on('click', function(e){
		var id=$('#id_division_e').val();
		    $.get(
	            'configuracion/eliminarDivision/'+id,
	            {},
	            function(data)
	            {
	                if(data.status == 'True')
	                {
	                	$('#div_eliminar').fadeOut();
	                    $("#div_mensaje2").removeClass("alert alert-danger");
						$("#div_mensaje2").addClass("alert alert-success");	
						$("#div_mensaje2").html("<strong>División eliminada con exíto."); 
						$('#div_mensaje2').fadeIn();
						setTimeout(function(){
							$('#div_mensaje2').fadeOut(); 
						}, 2500) 
	                }
	                else
	                {
	                	$('#div_eliminar').fadeOut();
	                    $("#div_mensaje2").removeClass("alert alert-success");
						$("#div_mensaje2").addClass("alert alert-danger");	
						$("#div_mensaje2").html("<strong>No se elimino la división, por favor averiguar con el encargado del sistema."); 
						setTimeout(function(){
							$('#div_mensaje2').fadeOut(); 
						}, 2500) 
	                }
	            },
	            'json'
	        );
	});


	$('#a_nuevo').on('click', function(e){			
	    $('#Id_division').val('');
		$('#div_mensaje').fadeOut(20);
		$('#div_nuevo').show(20);
		$('#div_eliminar').fadeOut(20);
		$('#div_editar').fadeOut(20);			
		return false;
	});

	$('#btn_crear_ct').on('click', function(e){		
		$.ajax({
            type: 'POST',
            url: 'configuracion/crear_division',
            data: $('#form_nuevo').serialize(),
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
					$("#div_mensaje2").html("<strong>Se ha registrado exitosamente la división: </strong> "+data.Nombre_Division); 
					$('#div_mensaje2').fadeIn();
					setTimeout(function(){
						$('#div_mensaje2').fadeOut(); 
					}, 2500)  
				}
            }
	    });
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

    $("#Clasificacion_Id").on('change', function(){
    	$("#Agrupacion_Id").empty();
    	$("#Deporte_Id").empty();
		$("#Modalidad_Id").empty();

    	$("#Agrupacion_Id").append("<option value=''>Seleccionar</option>");
    	$("#Deporte_Id").append("<option value=''>Seleccionar</option>");
		$("#Modalidad_Id").append("<option value=''>Seleccionar</option>");

    	$.get("getAgrupacion/" + $(this).val(), function (agrupacion) {
    		$.each(agrupacion.agrupacion, function(i, e){
				$("#Agrupacion_Id").append("<option value='" +e.Id + "'>" + e.Nombre_Agrupacion + "</option>");
			});				
    	});
    });

    $("#Clasificacion_IdE").on('change', function(){
    	$("#Agrupacion_IdE").empty();
    	$("#Deporte_IdE").empty();
		$("#Modalidad_IdE").empty();

    	$("#Agrupacion_IdE").append("<option value=''>Seleccionar</option>");
    	$("#Deporte_IdE").append("<option value=''>Seleccionar</option>");
		$("#Modalidad_IdE").append("<option value=''>Seleccionar</option>");

    	$.get("getAgrupacion/" + $(this).val(), function (agrupacion) {
    		$.each(agrupacion.agrupacion, function(i, e){
				$("#Agrupacion_IdE").append("<option value='" +e.Id + "'>" + e.Nombre_Agrupacion + "</option>");
			});				
    	});
    });

    $("#Agrupacion_Id").on('change',function (e){
		$("#Deporte_Id").empty();
		$("#Modalidad_Id").empty();

		$("#Deporte_Id").append("<option value=''>Seleccionar</option>");
		$("#Modalidad_Id").append("<option value=''>Seleccionar</option>");

		var id = $("#Agrupacion_Id").val();
		if(id != ''){
			$.get("getDeporte/" + id, function (deporte) {
				$.each(deporte.deporte, function(i, e){
					$("#Deporte_Id").append("<option value='" +e.Id + "'>" + e.Nombre_Deporte + "</option>");
				});				
			});
		}		
	});

	 $("#Agrupacion_IdE").on('change',function (e){
		$("#Deporte_IdE").empty();
		$("#Modalidad_IdE").empty();

		$("#Deporte_IdE").append("<option value=''>Seleccionar</option>");
		$("#Modalidad_IdE").append("<option value=''>Seleccionar</option>");

		var id = $("#Agrupacion_IdE").val();
		if(id != ''){
			$.get("getDeporte/" + id, function (deporte) {
				$.each(deporte.deporte, function(i, e){
					$("#Deporte_IdE").append("<option value='" +e.Id + "'>" + e.Nombre_Deporte + "</option>");
				});				
			});
		}		
	});

	$("#Deporte_Id").on('change',function (e){
		$("#Modalidad_Id").empty();
		$("#Modalidad_Id").append("<option value=''>Seleccionar</option>");

		var id = $("#Deporte_Id").val();
		if(id != ''){
			$.get("getModalidad/" + id, function (modalidad) {
				$.each(modalidad.modalidad, function(i, e){
					$("#Modalidad_Id").append("<option value='" +e.Id + "'>" + e.Nombre_Modalidad + "</option>");
				});				
			});
		}		
	});

	$("#Deporte_IdE").on('change',function (e){
		$("#Modalidad_IdE").empty();
		$("#Modalidad_IdE").append("<option value=''>Seleccionar</option>");

		var id = $("#Deporte_IdE").val();
		if(id != ''){
			$.get("getModalidad/" + id, function (modalidad) {
				$.each(modalidad.modalidad, function(i, e){
					$("#Modalidad_IdE").append("<option value='" +e.Id + "'>" + e.Nombre_Modalidad + "</option>");
				});				
			});
		}		
	});

});