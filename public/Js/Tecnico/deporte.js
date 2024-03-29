$(function()
{


	$('#a_edicar').on('click', function(e)
	{
			
			var Id_Deporte=$('select[name="Id_Deporte"]').val();
			if(Id_Deporte==""){
				$('#div_mensaje').fadeIn(20);
				$('#div_editar').fadeOut(20);
				$('#div_eliminar').fadeOut(20);
				$('#div_nuevo').fadeOut(20);
			}else{

				$.get(
		            '/ModuloRendimientoDeportivo/configuracion/ver_deporte/'+Id_Deporte,
		            {},
		            function(data)
		            {
		                if(data)
		                {
		                   $('#Id_Agrupa').val(data.Agrupacion_Id);
		                   $('#nom_depot').val(data.Nombre_Deporte);
		                   $('#id_Dpt').val(data.Id);
		                }
		            },
		            'json'
		        );

				$('#div_mensaje').fadeOut(20);
				$('#div_editar').show(20);
				$('#div_eliminar').fadeOut(20);
				$('#div_nuevo').fadeOut(20);
			}
			return false;
	});

	$('#a_eliminar').on('click', function(e)
	{
			
			var Id_Deporte=$('select[name="Id_Deporte"]').val();
			if(Id_Deporte==""){
				$('#div_mensaje').fadeIn(20);
				$('#div_eliminar').fadeOut(20);
				$('#div_nuevo').fadeOut(20);
				$('#div_editar').fadeOut(20);
			}else{

				$.get(
		            '/ModuloRendimientoDeportivo/configuracion/ver_deporte/'+Id_Deporte,
		            {},
		            function(data)
		            {
		                if(data)
		                {
		                   $('#id_deport').val(data.Id);
		                   $('#label_eliminar').html("¿Desea eliminar el deporte <ins>"+data.Nombre_Deporte+"</ins> de forma permanente del sistema?. <br>Tenga en cuenta que si elimina un deporte se eliminara por defecto todos los datos relacionados ha este deporte. Si no esta seguro de este cambio por favor diríjase al administrador del sistema.");
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

	$('#a_nuevo').on('click', function(e)
	{
			
			    $('#Id_Agrupacion').val('');
				$('#div_mensaje').fadeOut(20);
				$('#div_nuevo').show(20);
				$('#div_eliminar').fadeOut(20);
				$('#div_editar').fadeOut(20);
			
			return false;
	});

	$('#btn_crear_dpt').on('click', function(e)
	{
		
			$.ajax({
	            type: 'POST',
	            url: '/ModuloRendimientoDeportivo/configuracion/crear_dpt',
	            data: $('#form_nuevo').serialize(),
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
						
					    $("#div_mensaje2").removeClass("alert alert-danger");		
						$("#div_mensaje2").addClass("alert alert-success");			
						$("#div_mensaje2").html("<strong>Se ha registrado exitosamente el deporte: </strong> "+data.Nombre_Deporte); 
						$('#div_mensaje2').fadeIn();
						setTimeout(function(){
							$('#div_mensaje2').fadeOut(); 
						}, 2500)  

					}

	            }
		    });
		

	});

	$('#btn_eliminar_dpt').on('click', function(e)
	{
			var id=$('#id_deport').val();
			    $.get(
		            '/ModuloRendimientoDeportivo/configuracion/eliminarDeporte/'+id,
		            {},
		            function(data)
		            {
		                if(data.status == 'True')
		                {
		                	$('#div_eliminar').fadeOut();
		                    $("#div_mensaje2").removeClass("alert alert-danger");
							$("#div_mensaje2").addClass("alert alert-success");	
							$("#div_mensaje2").html("<strong>Deporte eliminado con exíto."); 
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
							$("#div_mensaje2").html("<strong>No se elimino el deporte, por favor averiguar con el encargado del sistema."); 
							setTimeout(function(){
								$('#div_mensaje2').fadeOut(); 
							}, 2500) 
		                }
		            },
		            'json'
		        );
	});


	$('#btn_editar').on('click', function(e)
	{
		
			$.ajax({
	            type: 'POST',
	            url: '/ModuloRendimientoDeportivo/configuracion/modificar_dpt',
	            data: $('#form_edit').serialize(),
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
						
					    $("#div_mensaje2").removeClass("alert alert-danger");		
						$("#div_mensaje2").addClass("alert alert-success");			
						$("#div_mensaje2").html("<strong>Se ha modificado exitosamente el deporte: </strong> "+data.Nombre_Deporte); 
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


});