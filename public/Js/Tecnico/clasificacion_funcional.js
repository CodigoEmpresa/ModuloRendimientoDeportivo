$(function(){
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

	$("#a_nuevo").on('click', function(){
		$("#div_nuevo").show('slow');
		$("#div_editar").hide('slow');
	});

	$("#Agregar_Clasificacion").on('click', function(){
		$('#form_nuevo .form-group').removeClass('has-error');
		$.ajax({
	        type: 'POST',
	        url: 'configuracion/crear_clasificacion_funcional',
	        data: $('#form_nuevo').serialize(),
	        success: function(data){

	        	if(data.status == 'errorC')
				{			

					$("#div_mensaje5").removeClass("alert alert-warning");
					$("#div_mensaje5").addClass("alert alert-danger");	
					$("#div_mensaje5").html("<strong>"+data.Mensaje); 
					$('#div_mensaje5').fadeIn();
					setTimeout(function(){
						$('#div_mensaje5').fadeOut(); 
					}, 2500)  

				}else if(data.status == 'success'){	
					
				    $("#div_mensaje5").removeClass("alert alert-danger");		
					$("#div_mensaje5").addClass("alert alert-success");			
					$("#div_mensaje5").html("<strong>"+data.Mensaje); 
					$('#div_mensaje5').fadeIn();
					setTimeout(function(){
						$('#div_mensaje5').fadeOut(); 
					}, 2500);
					document.getElementById("form_nuevo").reset();

				}else{
					$("#Nom_Clasificacion_Funcional").closest('.form-group').addClass('has-error');
				}

	        },
	        error: function(data){
	        	
	        }
	    });
	});
	

	$("#a_editar").on('click', function(){
		$("#div_nuevo").hide('slow');
		if($("#Id_Claificacion_Funcional").val() != ''){
			$("#div_editar").show('slow');
			$.get('configuracion/ver_clasificacion_funcional/'+$("#Id_Claificacion_Funcional").val(),{},function(data){
                if(data)
                {
                   $('#Nombre_Clasificacion_FuncionalE').val(data.Nombre_Clasificacion_Funcional);
                   $('#Id_Clasificacion_FuncionalE').val(data.Id);
                }
            },'json');
            $('#div_mensaje').fadeOut(20);
			$('#div_editar').show(20);
			$('#div_eliminar').fadeOut(20);
			$('#div_nuevo').fadeOut(20);
		}else{
			$('#div_mensaje').fadeIn(20);
			$('#div_editar').fadeOut(20);
			$('#div_eliminar').fadeOut(20);
			$('#div_nuevo').fadeOut(20);
		}
	});

	$("#btn_editar").on('click', function(){
		$('#form_edit .form-group').removeClass('has-error');
		$.ajax({
	        type: 'POST',
	        url: 'configuracion/modificar_clasificacion_funcional',
	        data: $('#form_edit').serialize(),
	        success: function(data){
	        	if(data.status == 'errorC')
				{			
					$("#div_mensaje6").removeClass("alert alert-warning");
					$("#div_mensaje6").addClass("alert alert-danger");	
					$("#div_mensaje6").html("<strong>"+data.Mensaje); 
					$('#div_mensaje6').fadeIn();
					setTimeout(function(){
						$('#div_mensaje6').fadeOut(); 
					}, 2500)  

				 }else if(data.status == 'success'){	
					
				    $("#div_mensaje6").removeClass("alert alert-danger");		
					$("#div_mensaje6").addClass("alert alert-success");			
					$("#div_mensaje6").html("<strong>"+data.Mensaje); 
					$('#div_mensaje6').fadeIn();
					setTimeout(function(){
						$('#div_mensaje6').fadeOut(); 
					}, 2500);
					document.getElementById("form_edit").reset();

				}else{
					$("#Nombre_Clasificacion_FuncionalE").closest('.form-group').addClass('has-error');
				}
	        },
	        error: function(data){
	        	
	        }
	    });
	});

	$("#a_eliminar").on('click', function(){var Id_division=$('select[name="Id_Division"]').val();
		if($("#Id_Claificacion_Funcional").val() ==""){
			$('#div_mensaje').fadeIn(20);
			$('#div_eliminar').fadeOut(20);
			$('#div_nuevo').fadeOut(20);
			$('#div_editar').fadeOut(20);
		}else{
			$.get('configuracion/ver_clasificacion_funcional/'+$("#Id_Claificacion_Funcional").val(),{},function(data){
                if(data)
                {
                   $('#label_eliminar').html("Para eliminar la clasificación funcional <ins>"+data.Nombre_Clasificacion_Funcional+"</ins>, por favor diríjase con el administrador del sistema.");
                }
            },'json');

			$('#div_mensaje').fadeOut(20);
			$('#div_eliminar').show(20);
			$('#div_nuevo').fadeOut(20);
			$('#div_editar').fadeOut(20);
		}
		return false;
	});
});