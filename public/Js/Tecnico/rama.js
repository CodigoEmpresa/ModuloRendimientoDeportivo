$(function()
{


	$('#a_edicar').on('click', function(e)
	{
			
			var Id_rm=$('select[name="Id_rm"]').val();
			if(Id_rm==""){
				$('#div_mensaje').fadeIn(20);
				$('#div_editar').fadeOut(20);
				$('#div_eliminar').fadeOut(20);
				$('#div_nuevo').fadeOut(20);
			}else{

				$.get(
		            'configuracion/ver_rama/'+Id_rm,
		            {},
		            function(data)
		            {
		                if(data)
		                {
		                   $('#nom_ra').val(data.Nombre_Rama);
		                   $('#id_Rm').val(data.Id);
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
			
			var Id_rm=$('select[name="Id_rm"]').val();
			if(Id_rm==""){
				$('#div_mensaje').fadeIn(20);
				$('#div_eliminar').fadeOut(20);
				$('#div_nuevo').fadeOut(20);
				$('#div_editar').fadeOut(20);
			}else{

				$.get(
		            'configuracion/ver_rama/'+Id_rm,
		            {},
		            function(data)
		            {
		                if(data)
		                {
		                   $('#id_rama').val(data.Id);
		                   //$('#label_eliminar').html("¿Desea eliminar la rama <ins>"+data.Nombre_Rama+"</ins> de forma permanente del sistema?. <br>Tenga en cuenta que si elimina una rama se eliminara por defecto todos los datos relacionados ha esta rama. Si no esta seguro de este cambio por favor diríjase al administrador del sistema.");
		                   $('#label_eliminar').html("Para eliminar la rama <ins>"+data.Nombre_Rama+"</ins>, por favor diríjase con el administrador del sistema.");
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
			
			    $('#Id_rm').val('');
				$('#div_mensaje').fadeOut(20);
				$('#div_nuevo').show(20);
				$('#div_eliminar').fadeOut(20);
				$('#div_editar').fadeOut(20);
			
			return false;
	});

	$('#btn_crear_rm').on('click', function(e)
	{
		
			$.ajax({
	            type: 'POST',
	            url: 'configuracion/crear_rm',
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
						$("#div_mensaje2").html("<strong>Se ha registrado exitosamente la rama: </strong> "+data.Nombre_Modalidad); 
						$('#div_mensaje2').fadeIn();
						setTimeout(function(){
							$('#div_mensaje2').fadeOut(); 
						}, 2500)  

					}

	            }
		    });
		

	});

	$('#btn_eliminar_rm').on('click', function(e)
	{
			var id=$('#id_rama').val();
			    $.get(
		            'configuracion/eliminarRama/'+id,
		            {},
		            function(data)
		            {
		                if(data.status == 'True')
		                {
		                	$('#div_eliminar').fadeOut();
		                    $("#div_mensaje2").removeClass("alert alert-danger");
							$("#div_mensaje2").addClass("alert alert-success");	
							$("#div_mensaje2").html("<strong>Rama eliminada con exíto."); 
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
							$("#div_mensaje2").html("<strong>No se elimino la rama, por favor averiguar con el encargado del sistema."); 
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
	            url: 'configuracion/modificar_rm',
	            data: $('#form_edit').serialize(),
	            success: function(data)
	            {

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
						$("#div_mensaje2").html("<strong>Se ha modificado exitosamente la rama: </strong> "+data.Nombre_Rama); 
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