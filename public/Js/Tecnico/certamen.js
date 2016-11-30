$(function(){

	$.datepicker.setDefaults($.datepicker.regional["es"]);
	$('#FechaInicioDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaFinDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaInicioDateM').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaFinDateM').datepicker({format: 'yyyy-mm-dd', autoclose: true,});

	$('#certamenesTabla').DataTable({
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
    $('#pruebasTabla').DataTable({
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

    $('#deportistasTabla').DataTable({
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

    $("#Crear_Nuevo").on('click', function(e){
    	$("#creaCertamenD").modal('show');
    	$("#TituloE").empty();
    	$("#TituloE").append('Crear nuevo certamen');
    	Reset_campos();
    }); 

    $("#Evento_Id").on('change', function(){
        $("#Sede_Id").empty();
        var html = '<option value="">Seleccionar</option>';
    	if($(this).val() != ''){            
    		$("#Nombre_Certamen").val($("#Evento_Id option:selected").text());
	    	$.get("getEvento/"+$(this).val(), function (evento) {
	    		if(evento['Tipo_Nivel_Id'] == 1){//Nacional
	    			$.get("getCiudades", function (ciudades) {
	    				$.each(ciudades, function(i, e){
                            html += "<option value='"+e['Id_Ciudad']+"'>"+e['Nombre_Ciudad']+"</option>";
	    				});
                        $("#Sede_Id").html(html).selectpicker('refresh');
	    			});
	    			
	    		}else if(evento['Tipo_Nivel_Id'] == 2){//Internacional
	    			$.get("getPaises", function (paises) {
	    				$.each(paises, function(i, e){
                            html += "<option value='"+e['Id_Pais']+"'>"+e['Nombre_Pais']+"</option>";
	    				});
                        $("#Sede_Id").html(html).selectpicker('refresh');
	    			});
	    		}else if(evento['Tipo_Nivel_Id'] == 3){//Distrital
                    html += "<option value='111'>Bogotá</option>";
                    $("#Sede_Id").html(html).selectpicker('refresh');
                }
                else if(evento['Tipo_Nivel_Id'] == 4){//Regional
                    $.get("getDepartamento", function (Departamento) {
                        $.each(Departamento, function(i, e){
                            html += "<option value='"+e['Id_Departamento']+"'>"+e['Nombre_Departamento']+"</option>";
                        });
                        $("#Sede_Id").html(html).selectpicker('refresh');
                    });
                }
	    	});
	    }
    });

    $("#Agregar").on('click', function(){
    	var token = $("#token").val();
	  	var formData = new FormData($("#")[0]);       
	  	var formData = new FormData($("#creaCertamenF")[0]);       	  
	  	$.ajax({
	      url: 'AddCertamen',  
	      type: 'POST',
	      data: formData,
	      contentType: false,
	      processData: false,
	      dataType: "json",
	      success: function (xhr) {
	        if(xhr.status == 'error'){
	          validador_errores(xhr.errors);
	        }
	        else 
	        {
	          $('#alert_certamen').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
	          $('#mensaje_certamen').show(60);
	          $('#mensaje_certamen').delay(1500).hide(600);       
              setTimeout(function(){ $("#creaCertamenD").modal('hide');  }, 1500);

	          Reset_campos();
	        }
	      },
	      error: function (xhr){
	        validador_errores(xhr.responseJSON);
	      }
      	});
    });

    function Reset_campos(){
    	$("#Titulo").empty();
    	$("#Evento_Id").val('').change();
    	$("#Sede_Id").val('').change();
    	$("#FechaInicio").val('');
    	$("#FechaFin").val('');
    }

    var validador_errores = function(data){
      $('#creaCertamenF .form-group').removeClass('has-error');
      $.each(data, function(i, e){
        $("#"+i).closest('.form-group').addClass('has-error');
      });
    }

    $(".VerCertamen").on('click', function(e){
    	$("#EditCertamenF").show('slow');
    	$("#PruebaCertamenF").hide('slow');
    	$("#DeportistaCertamenF").hide('slow');
    	$("#InicioCertamenLi").addClass('active');
    	$("#PruebasCertamenLi").removeClass('active');
    	$("#DeportistasCertamenLi").removeClass('active');
    	$("#loading").show('slow');
    	$.get("getCertamen/"+$(this).val(), function (certamen){
    		$("#TituloCertamen").empty();
    		$("#TituloCertamen").append(certamen['Nombre_Certamen']);

    		$("#TituloE").empty();
    		$("#TituloE").append(certamen['Nombre_Certamen']);
    		
    		//$("#Evento").val(certamen['Evento_Id']).change();
    		$("#FechaInicioM").val(certamen['Fecha_Inicio']).change();
    		$("#FechaFinM").val(certamen['Fecha_Fin']).change();
    		$("#Id_Certamen").val(certamen['Id']);
    		$("#Nombre_Certamen").val(certamen['Nombre_Certamen']);    		
    		$("#Evento").val(certamen['Evento_Id']).change();  
            //setTimeout(function(){  $("#Sede").val(certamen['Sede_Id']);}, 2000);    		
    		  
    		$("#Id_CertamenE").val(certamen['Id']);
    		$("#Id_CertamenP").val(certamen['Id']);    		
    		$("#Id_CertamenD").val(certamen['Id']);    		
    		
    		$.get("getDeportesEvento/"+certamen['Evento_Id'], function (Deportes) {
    			$("#Deporte_Id").empty();
	    		var html = '<option value="">Seleccionar</option>';
	    		$.each(Deportes['deporte'], function(i, e){
	    			html += '<option value="'+e.Id+'"">'+e['Nombre_Deporte']+'</option>';
	    		});
	    		$("#Deporte_Id").html(html).selectpicker('refresh');
    		});		
    		$.get("getDivisionCertamen/"+certamen['Id'], function (DivisionCertamen){
    			var t = $('#pruebasTabla').DataTable();
    			$("#Prueba_IdD").empty();
    			var htmlP = '<option value="">Seleccionar</option>';
    			if(DivisionCertamen['division'].length != 0){                
	                t.row.add( ['1','1', '1'] ).clear().draw( false );
		    		$.each(DivisionCertamen['division'], function(i, e){
		    			htmlP += '<option value="'+e.Id+'"">'+e.deporte['Nombre_Deporte']+' - '+e.rama['Nombre_Rama']+' - '+e.categoria['Nombre_Categoria']+' - '+e['Nombre_Division']+'</option>';
		    			t.row.add( [
		    				e.deporte['Nombre_Deporte']+' - '+e.rama['Nombre_Rama']+' - '+e.categoria['Nombre_Categoria']+' - '+e['Nombre_Division'],
				            '<button type="button" class="btn btn-danger" onclick="EliminarDivision('+e['Id']+')">Eliminar</button>',
				        ] ).draw( false );
		    		});
		    		$("#Prueba_IdD").html(htmlP).selectpicker('refresh');
		    	}
    		});
            $.get("getDeportistaCertamenDivision/"+certamen['Id'], function (Deportistas){
                var t = $('#deportistasTabla').DataTable();    
                t.row.add( ['1','1', '1'] ).clear().draw( false );
                $.each(Deportistas, function(i, e){
                    var Nombres = '';
                    if(e.certamen_division.length > 0){
                        $.each(e.certamen_division, function(m, f){
                            Nombres = e.persona['Primer_Nombre']+' '+e.persona['Segundo_Nombre']+' '+e.persona['Primer_Apellido']+' '+e.persona['Segundo_Apellido'];
                            $.get("getDivisionUnica/"+f['Division_Id'], function (DivisionUnica){
                                t.row.add( [
                                    Nombres,
                                    DivisionUnica.deporte['Nombre_Deporte']+' '+DivisionUnica.rama['Nombre_Rama']+' '+DivisionUnica.categoria['Nombre_Categoria']+' '+DivisionUnica['Nombre_Division'],
                                    '<button type="button" class="btn btn-danger" onclick="EliminarDeportista('+e['Id']+', '+f['Division_Id']+')">Eliminar</button>',
                                ] ).draw( false );
                            });
                        });                             
                    }
                });
            });
            
    		setTimeout(function(){ 
    			$("#Sede").val(certamen['Sede_Id']).change(); 
    			$("#loading").hide('slow');
    			$("#verCertamenD").modal('show');
    		}, 4000);     
    	});
    });

    $("#Evento").on('change', function(){
        $("#Sede").empty();
        var html = '<option value="">Seleccionar</option>';
    	if($(this).val() != ''){
    		$("#Nombre_CertamenE").val($("#Evento option:selected").text());
	    	$.get("getEvento/"+$(this).val(), function (evento) {	    		
                if(evento['Tipo_Nivel_Id'] == 1){//Nacional
                    $.get("getCiudades", function (ciudades) {
                        $.each(ciudades, function(i, e){
                            html += "<option value='"+e['Id_Ciudad']+"'>"+e['Nombre_Ciudad']+"</option>";
                        });
                        $("#Sede").html(html).selectpicker('refresh');
                    });
                    
                }else if(evento['Tipo_Nivel_Id'] == 2){//Internacional
                    $.get("getPaises", function (paises) {
                        $.each(paises, function(i, e){
                            html += "<option value='"+e['Id_Pais']+"'>"+e['Nombre_Pais']+"</option>";
                        });
                        $("#Sede").html(html).selectpicker('refresh');
                    });
                }else if(evento['Tipo_Nivel_Id'] == 3){//Distrital
                    html += "<option value='111'>Bogotá</option>";
                    $("#Sede").html(html).selectpicker('refresh');
                }
                else if(evento['Tipo_Nivel_Id'] == 4){//Regional
                    $.get("getDepartamento", function (Departamento) {
                        $.each(Departamento, function(i, e){
                            html += "<option value='"+e['Id_Departamento']+"'>"+e['Nombre_Departamento']+"</option>";
                        });
                        $("#Sede").html(html).selectpicker('refresh');
                    });
                }
	    	});
	    }
    });

    $("#Modificar").on('click', function(){
    	var token = $("#token").val();
	  	var formData = new FormData($("#")[0]);       
	  	var formData = new FormData($("#EditCertamenF")[0]);       	  
	  	$.ajax({
	      url: 'EditCertamen',  
	      type: 'POST',
	      data: formData,
	      contentType: false,
	      processData: false,
	      dataType: "json",
	      success: function (xhr) {
	        if(xhr.status == 'error'){
	          validador_errores(xhr.errors);
	        }
	        else 
	        {
	          $('#alert_certamenE').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
	          $('#mensaje_certamenE').show(60);
	          $('#mensaje_certamenE').delay(1500).hide(600);       
              setTimeout(function(){ $("#creaCertamenD").modal('hide');  }, 1500);

	          Reset_campos();
	        }
	      },
	      error: function (xhr){
	        validador_errores(xhr.responseJSON);
	      }
      	});
    });

    $("#InicioCertamen").on('click', function(e){
    	$("#EditCertamenF").show('slow');
    	$("#PruebaCertamenF").hide('slow');
    	$("#DeportistaCertamenF").hide('slow');
    	$("#InicioCertamenLi").addClass('active');
    	$("#PruebasCertamenLi").removeClass('active');
    	$("#DeportistasCertamenLi").removeClass('active');
    });

    $("#PruebasCertamen").on('click', function(){
    	$("#PruebaCertamenF").show('slow');
    	$("#EditCertamenF").hide('slow');
    	$("#DeportistaCertamenF").hide('slow');
    	$("#PruebasCertamenLi").addClass('active');
    	$("#InicioCertamenLi").removeClass('active');
    	$("#DeportistasCertamenLi").removeClass('active');
    });

     $("#DeportistasCertamen").on('click', function(){
    	$("#PruebaCertamenF").hide('slow');
    	$("#EditCertamenF").hide('slow');
    	$("#DeportistaCertamenF").show('slow');
    	$("#PruebasCertamenLi").removeClass('active');
    	$("#InicioCertamenLi").removeClass('active');
    	$("#DeportistasCertamenLi").addClass('active');
    });

    $("#Deporte_Id").on('change', function(){
    	if($(this).val() != ''){
    		$("#Prueba_Id").empty();
    		var html = '<option value="">Seleccionar</option>';
    		$.get("getDivision/"+$(this).val()+'/'+$("#Id_CertamenP").val(), function (Division) {
	    		$.each(Division, function(i, e){
	    			html += '<option value="'+e.Id+'"">'+e.rama['Nombre_Rama']+' - '+e.categoria['Nombre_Categoria']+' - '+e['Nombre_Division']+'</option>';
	    		});
	    		$("#Prueba_Id").html(html).selectpicker('refresh');
    		});
    	}else{
    		$("#Prueba_Id").empty();
    		var html = '<option value="">Seleccionar</option>';
    		$("#Prueba_Id").html(html).selectpicker('refresh');
    	}
    });

    $("#AgregarPrueba").on('click', function(){

    	var token = $("#token").val();
	  	var formData = new FormData($("#")[0]);       
	  	var formData = new FormData($("#PruebaCertamenF")[0]);       	  
	  	$.ajax({
	      url: 'AddPruebaCertamen',  
	      type: 'POST',
	      data: formData,
	      contentType: false,
	      processData: false,
	      dataType: "json",
	      success: function (xhr) {
	        if(xhr.status == 'error'){
	          validador_erroresP(xhr.errors);
	        }
	        else 
	        {
	          $('#alert_certamenP').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
	          $('#mensaje_certamenP').show(60);
	          $('#mensaje_certamenP').delay(1500).hide(600);       
	          setTimeout(function(){ $("#verCertamenD").modal('hide');  }, 1500);

	          Reset_camposP();
	        }
	      },
	      error: function (xhr){
	        validador_erroresP(xhr.responseJSON);
	      }
      	});
    });

	var validador_erroresP = function(data){
      $('#PruebaCertamenF .form-group').removeClass('has-error');
      $.each(data, function(i, e){
        $("#"+i).closest('.form-group').addClass('has-error');
      });
    }
    function Reset_camposP(){
    	$('#PruebaCertamenF .form-group').removeClass('has-error');
    }

    $("#Prueba_IdD").on('change', function(){
    	$.get("getDivisionDeportista/"+$(this).val(), function (Division) {
            $("#Deportista_IdD").empty();
            var html = '<option value="">Seleccionar</option>';
    		$.get("getDeportistaDivision/"+Division['Deporte_Id'], function (Deportistas) {
                $.each(Deportistas['deportista'], function(i, e){
                    html += '<option value="'+e.Id+'">'+e.persona['Primer_Nombre']+' '+e.persona['Segundo_Nombre']+' '+e.persona['Primer_Apellido']+' '+e.persona['Segundo_Apellido']+'</option>';
                });
                $("#Deportista_IdD").html(html).selectpicker('refresh');
    		});
    	});
    });

    $("#AgregarDeportista").on('click', function(){        
        var token = $("#token").val();
        var formData = new FormData($("#")[0]);       
        var formData = new FormData($("#DeportistaCertamenF")[0]);            
        $.ajax({
          url: 'AddPruebaCertamenDeportista',  
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (xhr) {
            if(xhr.status == 'error'){
              validador_erroresP(xhr.errors);
            }
            else if(xhr.status == 'ErrorAdicion'){
                $('#alert_certamenD').html('<div class="alert alert-dismissible alert-danger" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
                $('#mensaje_certamenD').show(60);
                $('#mensaje_certamenD').delay(1500).hide(600);       
            }else
            {
              $('#alert_certamenD').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#mensaje_certamenD').show(60);
              $('#mensaje_certamenD').delay(1500).hide(600);       
              setTimeout(function(){ $("#verCertamenD").modal('hide');  }, 1500);

              Reset_camposP();
            }           
            
          },
          error: function (xhr){
            validador_erroresP(xhr.responseJSON);
          }
        });
    });
    
});

function EliminarDivision(id_prueba){
	var token = $("#token").val();   
    $.ajax({
      url: 'DeletePruebaCertamen/'+id_prueba+'/'+$("#Id_CertamenP").val(),  
      type: 'POST',
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (xhr) {
        if(xhr.status == 'error'){
          $('#alert_certamenP').html('<div class="alert alert-dismissible alert-danger" ><strong>Error!</strong>'+xhr.Mensaje+'</div>');
          $('#mensaje_certamenP').show(60);
          $('#mensaje_certamenP').delay(1500).hide(600);        
        }
        else 
        {
          $('#alert_certamenP').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
          $('#mensaje_certamenP').show(60);
          $('#mensaje_certamenP').delay(1500).hide(600);        
          setTimeout(function(){ $("#verCertamenD").modal('hide');  }, 1500);
        }
      }
    });
}

function EliminarDeportista(id_deportista, id_division){
    var token = $("#token").val();   
    $.ajax({
      url: 'DeletePruebaCertamenDeportista/'+id_deportista+'/'+id_division+'/'+$("#Id_CertamenD").val(),  
      type: 'POST',
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (xhr) {
        if(xhr.status == 'error'){
          $('#alert_certamenD').html('<div class="alert alert-dismissible alert-danger" ><strong>Error!</strong>'+xhr.Mensaje+'</div>');
          $('#mensaje_certamenD').show(60);
          $('#mensaje_certamenD').delay(1500).hide(600);        
        }
        else 
        {
          $('#alert_certamenD').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
          $('#mensaje_certamenD').show(60);
          $('#mensaje_certamenD').delay(1500).hide(600);        
          setTimeout(function(){ $("#verCertamenD").modal('hide');  }, 1500);
        }
      }
    });
}