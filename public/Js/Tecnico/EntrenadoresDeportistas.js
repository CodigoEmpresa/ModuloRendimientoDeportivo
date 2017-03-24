$(function(e){  

    $("#AgregarDeportista").on('click', function(){
        $("#loading").modal('show');
        var html = '<option value="">Seleccionar</option>';
        $.get('getEntrenadorDeportistasNO/'+$("#Id_Persona").val(), function(DeportostasNO){  
            $.each(DeportostasNO, function(i, e){
                html += "<option style='text-transform: uppercase;' value='"+e['Id']+"'>"+e.persona['Primer_Nombre']+" "+e.persona['Segundo_Nombre']+ " "+e.persona['Primer_Apellido']+ " "+e.persona['Segundo_Apellido']+"</option>";
            });
            $("#Deportistas").html(html).selectpicker('refresh');
        }).done(function(){
            $("#loading").modal('hide');
            $("#VincularDeportistaD").modal('show');
        });       
    });


    $("#AgregarVinculo").on('click', function(){   
        $("#Deportistas").closest('.form-group').removeClass('has-error');        
        if($("#Deportistas").val() != ''){
            var formData = new FormData($("#VincularDeportistaF")[0]);          
            $.ajax({
                type: 'POST',
                url: 'addVinculoDeportitaEntrenador',
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (xhr) { 
                    if(xhr.status == 'error')
                    {
                        return false;
                    }
                    else 
                    {
                        $('#mensaje_vinculacion').html('<div class="alert alert-dismissible alert-success" ><strong>Éxito!  </strong>El deportista ha sido vinculado con éxito!</div>');
                        $('#mensaje_vinculacion').show(60);                        
                        setTimeout(function(){
                          $('#mensaje_vinculacion').hide(600);  
                        $("#VincularDeportistaD").modal('hide');  
                        }, 1500);
                        var t = $('#datosTabla').DataTable();
                        t.row.add( [
                                xhr.Datos.persona['Primer_Nombre']+' '+xhr.Datos.persona['Segundo_Nombre']+' '+xhr.Datos.persona['Primer_Apellido']+' '+xhr.Datos.persona['Segundo_Apellido'],
                                xhr.Datos.deportista_deporte[0].agrupacion['Nombre_Agrupacion'],
                                xhr.Datos.deportista_deporte[0].deporte['Nombre_Deporte'],
                                xhr.Datos.deportista_deporte[0].modalidad['Nombre_Modalidad'],
                                '<button type="button" class="btn-sm btn-danger"  data-funcion="eliminarVinculo" value="'+xhr.Datos['Id']+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar</button>',

                            ] ).draw( false );
                    }
                },
                error: function (xhr){              
                }
            });

        }else{
            $('#mensaje_vinculacion').html('<div class="alert alert-dismissible alert-danger" ><strong>Error!  </strong>Seleccione un deportista!</div>');
            $('#mensaje_vinculacion').show(60);
            $('#mensaje_vinculacion').delay(1500).hide(600);    
            $("#Deportistas").closest('.form-group').addClass('has-error');   
        }
    });


    $('body').delegate('button[data-funcion="eliminarVinculo"]','click',function (e) {   
        var formData = {Id_Deportista: $(this).val(), Id_Entrenador : $("#Id_Entrenador").val()};
        $("#loading").modal('show');
        $.ajax({
            type: 'POST',
            url: 'deleteVinculoDeportitaEntrenador',
            data: formData,
            dataType: "json",
            success: function (xhr) { 
                $("#deportistasEntrenadorD").empty();
                $.get("entrenador/" + $("#Id_Persona").val() + "", function (EntrenadorData) {               
                    $("#GestorDeportistas").show('slow');                                          
                    if(EntrenadorData.entrenador != null){
                        $("#deportistasEntrenadorD").empty();
                        $("#Id_Entrenador").val(EntrenadorData.entrenador['Id']);                            
                        var htmlTabla = '<table id="datosTabla" name="datosTabla" style="text-transform: uppercase;">';
                        htmlTabla += '<thead><th>NOMBRES</th><th>AGRUPACIÓN</th><th>DEPORTE</th><th>MODALIDAD</th><th>OPCIONES</th></thead>';
                        $.each(EntrenadorData.entrenador.entrenador_deportista, function(i, e){   

                            contador = ((e.deportista_deporte).length)-1;
                            htmlTabla += '<tr>';
                            htmlTabla += '<td>'+e.persona['Primer_Nombre']+' '+e.persona['Segundo_Nombre']+' '+e.persona['Primer_Apellido']+' '+e.persona['Segundo_Apellido']+'</td>';
                            htmlTabla += '<td>'+e.deportista_deporte[contador]['agrupacion']['Nombre_Agrupacion']+'</td>';
                            htmlTabla += '<td>'+e.deportista_deporte[contador]['deporte']['Nombre_Deporte']+'</td>';
                            htmlTabla += '<td>'+e.deportista_deporte[contador]['modalidad']['Nombre_Modalidad']+'</td>';
                            htmlTabla += '<td><button type="button" class="btn-sm btn-danger"  data-funcion="eliminarVinculo" value="'+e.Id+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar</button></td>';
                            htmlTabla += '</tr>';
                        });
                        htmlTabla += '</table>';
                        $("#deportistasEntrenadorD").html(htmlTabla);
                        $("#deportistasEntrenadorD").show('slow');
                        $('#datosTabla').DataTable({
                          retrieve: true,
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ],
                            dom: 'Bfrtip',
                            select: true,
                            "responsive": true,
                            "ordering": true,
                            "info": true,
                            "pageLength": 10,
                            "language": {
                                url: 'public/DataTables/Spanish.json',
                                searchPlaceholder: "Buscar"
                            }
                        });
                    }else{
                        $("#deportistasEntrenadorD").hide('slow');
                    }   
                }).done(function(){                    
                    $("#loading").modal('hide'); 
                });
            },
            error: function (xhr){              
            }
        });
    });
});


function Buscar(e){ 
    var t = $('#personaTipoTabla').DataTable();
    t.row.add( ['1','1', '1'] ).clear().draw( false );  

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
			 	$.get("entrenador/" + PersonaData[0]['Id_Persona'] + "", function (EntrenadorData) {
			 		if(EntrenadorData.entrenador != null){
			 			$("#Id_Persona").val(PersonaData[0]['Id_Persona']);
			            $("#Nombres").append(PersonaData[0]['Primer_Nombre']+' '+PersonaData[0]['Segundo_Nombre']+' '+PersonaData[0]['Primer_Apellido']+' '+PersonaData[0]['Segundo_Apellido']);
			            $("#Identificacion").append('IDENTIFICACIÓN '+PersonaData[0]['Cedula']);
			            $("#GestorDeportistas").show('slow');                                          
                        if(EntrenadorData.entrenador != null){
                            $("#deportistasEntrenadorD").empty();
                            $("#Id_Entrenador").val(EntrenadorData.entrenador['Id']);                            
                            var htmlTabla = '<table id="datosTabla" name="datosTabla" style="text-transform: uppercase;">';
                            htmlTabla += '<thead><th>NOMBRES</th><th>AGRUPACIÓN</th><th>DEPORTE</th><th>MODALIDAD</th><th>OPCIONES</th></thead>';
                            $.each(EntrenadorData.entrenador.entrenador_deportista, function(i, e){   

                                contador = ((e.deportista_deporte).length)-1;
                                htmlTabla += '<tr>';
                                htmlTabla += '<td>'+e.persona['Primer_Nombre']+' '+e.persona['Segundo_Nombre']+' '+e.persona['Primer_Apellido']+' '+e.persona['Segundo_Apellido']+'</td>';
                                htmlTabla += '<td>'+e.deportista_deporte[contador]['agrupacion']['Nombre_Agrupacion']+'</td>';
                                htmlTabla += '<td>'+e.deportista_deporte[contador]['deporte']['Nombre_Deporte']+'</td>';
                                htmlTabla += '<td>'+e.deportista_deporte[contador]['modalidad']['Nombre_Modalidad']+'</td>';
                                htmlTabla += '<td><button type="button" class="btn-sm btn-danger"  data-funcion="eliminarVinculo" value="'+e.Id+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar</button></td>';
                                htmlTabla += '</tr>';
                            });
                            htmlTabla += '</table>';
                            $("#deportistasEntrenadorD").html(htmlTabla);
                            $("#deportistasEntrenadorD").show('slow');
                            $('#datosTabla').DataTable({
                              retrieve: true,
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ],
                                dom: 'Bfrtip',
                                select: true,
                                "responsive": true,
                                "ordering": true,
                                "info": true,
                                "pageLength": 10,
                                "language": {
                                    url: 'public/DataTables/Spanish.json',
                                    searchPlaceholder: "Buscar"
                                }
                            });
                        }else{
                            $("#deportistasEntrenadorD").hide('slow');
                        }	
			 		}else{
			 			$('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
			            $('#buscar span').empty();
			            document.getElementById("buscar").disabled = false;
			            $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">No se encuentra ningun entrenador registrado con estos datos!.</h4></dvi><br>');
			            $('#paginador').fadeOut();				
			 		}
			 	}).done(function(){                    
                    $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
                    $('#buscar span').empty();
                    document.getElementById("buscar").disabled = false;    
                });
			 });

		}
	});   
}

function Reset_campos(e){    

    $("#Nombres").empty();
    $("#Identificacion").empty();
    $("#Id_Persona").val('');

    $("#GestorDeportistas").hide('slow');

    $("#Modificar").hide();
    $("#Registrar").hide();
}