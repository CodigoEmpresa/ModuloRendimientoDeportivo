$(function()
{


	$('#a_edicar').on('click', function(e)
	{
			
			var Id_Agrupacion=$('select[name="Id_Agrupacion"]').val();
			if(Id_Agrupacion==""){
				$('#div_mensaje').fadeIn(20);
				$('#div_editar').fadeOut(20);
				$('#div_eliminar').fadeOut(20);
				$('#div_nuevo').fadeOut(20);
			}else{

				$.get(
		            'configuracion/IdAgrupacion/'+Id_Agrupacion,
		            {},
		            function(data)
		            {
		                if(data)
		                {
		                   $('#Id_cla').val(data.ClasificacionDeportista_Id);
		                   $('#id_agrup').val(data.Id);
		                   $('#nom_agrup').val(data.Nombre_Agrupacion);
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
			
			var Id_Agrupacion=$('select[name="Id_Agrupacion"]').val();
			if(Id_Agrupacion==""){
				$('#div_mensaje').fadeIn(20);
				$('#div_eliminar').fadeOut(20);
				$('#div_nuevo').fadeOut(20);
				$('#div_editar').fadeOut(20);
			}else{

				$.get(
		            'configuracion/IdAgrupacion/'+Id_Agrupacion,
		            {},
		            function(data)
		            {
		                if(data)
		                {
		                   $('#id_agrup').val(data.Id);
		                   //$('#label_eliminar').html("¿Desea eliminar la agrupación de forma permanente del sistema?. <br>Tenga en cuenta que si elimina una agrupación se eliminara por defecto todos los datos relacionados ha esta agrupación. Si no esta seguro de este cambio por favor diríjase al administrador del sistema.");
		                   $('#label_eliminar').html("Para eliminar esta agrupación por favor diríjase con el administrador del sistema.");
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

	$('#btn_crear').on('click', function(e)
	{
		
			$.ajax({
	            type: 'POST',
	            url: 'configuracion/crear',
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
						$("#div_mensaje2").html("<strong>Se ha registrado exitosamente la agrupación: </strong> "+data.Nombre_Agrupacion); 
						$('#div_mensaje2').fadeIn();
						setTimeout(function(){
							$('#div_mensaje2').fadeOut(); 
						}, 2500)  
					}

	            }
		    });
		

	});

	$('#btn_eliminar').on('click', function(e)
	{
			var id=$('#id_agrup').val();
			    $.get(
		            'configuracion/eliminarAgrupacion/'+id,
		            {},
		            function(data)
		            {
		                if(data.status == 'True')
		                {
		                	$('#div_eliminar').fadeOut();
		                    $("#div_mensaje2").removeClass("alert alert-danger");
							$("#div_mensaje2").addClass("alert alert-success");	
							$("#div_mensaje2").html("<strong>Agrupación eliminada con exíto."); 
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
							$("#div_mensaje2").html("<strong>No se elimino la agrupación, por favor averiguar con el encargado del sistema."); 
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
	            url: 'configuracion/modificar',
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
						$("#div_mensaje2").html("<strong>Se ha modificado exitosamente la agrupación: </strong> "+data.Nombre_Agrupacion); 
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



});