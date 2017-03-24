$(function(){
    $('#resultadosTabla').DataTable({
        retrieve: true,
        buttons: [
            
        ],
        dom: 'Bfrtip',
        select: true,
        "responsive": true,
        "ordering": true,
        "info": true,
        "pageLength": 15,
        "language": {
            url: 'public/DataTables/Spanish.json',
            searchPlaceholder: "Buscar"
        }
    });

  
    $("#Clasificacion_Id").on('change', function(){            
        $("#Evento_Id").empty();
        $("#Certamen_Id").empty();
        $("#Paso3").hide('slow');
        var html = '<option value="">Seleccionar</option>';
        if($(this).val() != ''){
            $("#Certamen_Id").html(html).selectpicker('refresh');
            $.get("getEventosClasfificacion/"+$(this).val(), function (eventos) {
                $.each(eventos, function(i, e){
                    html += "<option value='"+e['Id']+"'>"+e['Nombre_Evento']+"</option>";
                });
                $("#Evento_Id").html(html).selectpicker('refresh');                
            });            
        }
        $("#Evento_Id").html(html).selectpicker('refresh');
        $("#Certamen_Id").html(html).selectpicker('refresh');
    });

    $("#Evento_Id").on('change', function(){            
        $("#Certamen_Id").empty();
        $("#Paso3").hide('slow');
        var html = '<option value="">Seleccionar</option>';
        if($(this).val != ''){  
            $.get("getCertamenEventos/"+$(this).val(), function (certamenes) {
                $.each(certamenes, function(i, e){
                    html += "<option value='"+e['Id']+"'>"+e['Nombre_Certamen']+"</option>";
                });
                $("#Certamen_Id").html(html).selectpicker('refresh');
            });
        }
        $("#Certamen_Id").html(html).selectpicker('refresh');
    });

    $("#Certamen_Id").on('change', function(){    
        var t = $('#resultadosTabla').DataTable();
        t.row.add(['1','1','1'] ).clear().draw( false );
        if($(this).val != ''){  
            $.get("getDivisionCertamenMetodS/"+$(this).val()+"/"+$("#persona").val(), function (DivisionCertamen){                                
                if(DivisionCertamen.length != 0){                                    
                    $.each(DivisionCertamen, function(i, e){
                        t.row.add( [
                            e.cetamen_division.division.deporte['Nombre_Deporte'],
                            e.cetamen_division.division.rama['Nombre_Rama']+' - '+e.cetamen_division.division.categoria['Nombre_Categoria']+' - '+e.cetamen_division.division['Nombre_Division'],                        
                            '<button type="button" class="btn btn-primary" onclick="Resultado('+e.cetamen_division['Id']+','+$("#Certamen_Id").val()+','+e.cetamen_division.division['Id']+');">Registro de Resultados</button>',
                        ] ).draw( false );
                    });
                }
            });  
            $("#Paso3").show('slow');
        }
    });  

    var validador_errores = function(data){
      $('#RegistroResultadoF .form-group').removeClass('has-error');
      $.each(data, function(i, e){
        $("#"+i).closest('.form-group').addClass('has-error');
      });
    } 

    function AgregarRegistro(datos,puesto){
        /*console.log(datos, puesto);
        return false;*/
        var token = $("#token").val();
        $.ajax({
          url: 'AddRegistroDeportista',  
          type: 'POST',
          data: datos,
          dataType: "json",
          success: function (xhr) {
            if(xhr.status == 'error'){
              validador_errores(xhr.errors);
            }else{
              $('#alert_registro').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#mensaje_registro').show(60);
              $('#mensaje_registro').delay(1500).hide(600);     
              if(puesto == 1){
                    $("#OroD").hide('slow');
                    $("#RegistroOroD").hide('slow');
                    $("#ResultadoOroD").show('slow');
                    $("#NombreOro").empty();
                    $("#CiudadOro").empty();
                    $("#MarcaOro").empty();
                    $("#NombreOro").append(xhr.Nombres);
                    $("#CiudadOro").append(xhr.Ciudad);
                    $("#MarcaOro").append(xhr.Marca);   
                    $("#CertamenDivisionResultadoIOro").val(xhr.Id);

                    $("#OroDeportista").val('');   
                    $('#OroDeportista').selectpicker('refresh'); 
                    $("#OroMarca").val('');
                    $("#OroCiudad").val('');   
                    $('#OroCiudad').selectpicker('refresh'); 
              }

              if(puesto == 2){
                    $("#PlataD").hide('slow');
                    $("#RegistroPlataD").hide('slow');
                    $("#ResultadoPlataD").show('slow');
                    $("#NombrePlata").empty();
                    $("#CiudadPlata").empty();
                    $("#MarcaPlata").empty();      
                    $("#NombrePlata").append(xhr.Nombres);
                    $("#CiudadPlata").append(xhr.Ciudad);
                    $("#MarcaPlata").append(xhr.Marca);             
                    $("#CertamenDivisionResultadoIPlata").val(xhr.Id);       

                    $("#PlataDeportista").val('');   
                    $('#PlataDeportista').selectpicker('refresh'); 
                    $("#PlataMarca").val('');
                    $("#PlataCiudad").val('');   
                    $('#PlataCiudad').selectpicker('refresh'); 
              }

              if(puesto == 3){
                    $("#BronceD").hide('slow');
                    $("#RegistroBronceD").hide('slow');
                    $("#ResultadoBronceD").show('slow');
                    $("#NombreBronce").empty();
                    $("#CiudadBronce").empty();
                    $("#MarcaBronce").empty();  
                    $("#NombreBronce").append(xhr.Nombres);
                    $("#CiudadBronce").append(xhr.Ciudad);
                    $("#MarcaBronce").append(xhr.Marca);         
                    $("#CertamenDivisionResultadoIBronce").val(xhr.Id);   

                    $("#BronceDeportista").val('');   
                    $('#BronceDeportista').selectpicker('refresh'); 
                    $("#BronceMarca").val('');
                    $("#BronceCiudad").val('');   
                    $('#BronceCiudad').selectpicker('refresh'); 
              }

              if(puesto > 3){
                    $("#TresD").hide('slow');
                    $("#RegistroTresD").hide('slow');
                    $("#ResultadoTresD").show('slow');
                    $("#NombreTres").empty();
                    $("#CiudadTres").empty();
                    $("#MarcaTres").empty();  
                    $("#PuestoTres").empty();  
                    $("#NombreTres").append(xhr.Nombres);
                    $("#CiudadTres").append(xhr.Ciudad);
                    $("#MarcaTres").append(xhr.Marca);         
                    $("#PuestoTres").append(xhr.Puesto);         
                    $("#ObservacionPuestoTres").append(xhr.Observacion);
                    $("#CertamenDivisionResultadoITres").val(xhr.Id);   

                    $("#TresDeportista").val('');   
                    $('#TresDeportista').selectpicker('refresh'); 
                    $("#TresMarca").val('');
                    $("#TresPuesto").val('');
                    $("#TresCiudad").val('');   
                    $('#TresCiudad').selectpicker('refresh'); 
              }  
            }   
            
          },
          error: function (xhr){
            validador_errores(xhr.responseJSON);
          }
        });
    }

    function AgregarRegistroN(datos, puesto){
        /*console.log(datos, puesto);
        return false;*/
        var token = $("#token").val();
        $.ajax({
          url: 'AddRegistroDeportistaN',  
          type: 'POST',
          data: datos,
          dataType: "json",
          success: function (xhr) {
            if(xhr.status == 'error'){
              validador_errores(xhr.errors);
            }else{
              $('#alert_registro').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#mensaje_registro').show(60);
              $('#mensaje_registro').delay(1500).hide(600);  
              if(puesto == 1){
                    $("#NombreOro").empty();
                    $("#CiudadOro").empty();
                    $("#MarcaOro").empty();
                    $("#NombreOro").append(xhr.Nombres);
                    $("#CiudadOro").append(xhr.Ciudad);
                    $("#MarcaOro").append(xhr.Marca);   
                    $("#CertamenDivisionResultadoIOro").val(xhr.Id);
                    $("#RegistroOroD").hide('slow');
                    $("#OroN").hide('slow');
                    $("#ResultadoOroD").show('slow');

                    $("#OroDeportistaN").val('');   
                    $('#OroDeportistaN').selectpicker('refresh'); 
                    $("#OroMarcaN").val('');
                    $("#OroCiudad").val('');   
                    $('#OroCiudad').selectpicker('refresh'); 
              }

              if(puesto == 2){
                    $("#NombrePlata").empty();
                    $("#CiudadPlata").empty();
                    $("#MarcaPlata").empty();      
                    $("#NombrePlata").append(xhr.Nombres);
                    $("#CiudadPlata").append(xhr.Ciudad);
                    $("#MarcaPlata").append(xhr.Marca);             
                    $("#CertamenDivisionResultadoIPlata").val(xhr.Id);
                    $("#RegistroPlataD").hide('slow');
                    $("#PlataN").hide('slow');
                    $("#ResultadoPlataD").show('slow');

                    $("#PlataDeportistaN").val('');   
                    $('#PlataDeportistaN').selectpicker('refresh'); 
                    $("#PlataMarcaN").val('');
                    $("#PlataCiudad").val('');   
                    $('#PlataCiudad').selectpicker('refresh'); 
              }

              if(puesto == 3){
                    $("#NombreBronce").empty();
                    $("#CiudadBronce").empty();
                    $("#MarcaBronce").empty();  
                    $("#NombreBronce").append(xhr.Nombres);
                    $("#CiudadBronce").append(xhr.Ciudad);
                    $("#MarcaBronce").append(xhr.Marca);         
                    $("#CertamenDivisionResultadoIBronce").val(xhr.Id);                  
                    $("#RegistroBronceD").hide('slow');
                    $("#BronceN").hide('slow');
                    $("#ResultadoBronceD").show('slow');

                    $("#BronceDeportistaN").val('');   
                    $('#BronceDeportistaN').selectpicker('refresh'); 
                    $("#BronceMarcaN").val('');
                    $("#BronceCiudad").val('');   
                    $('#BronceCiudad').selectpicker('refresh'); 
              }    

              if(puesto > 3){
                    $("#NombreTres").empty();
                    $("#CiudadTres").empty();
                    $("#MarcaTres").empty();  
                    $("#PuestoTres").empty();  
                    $("#NombreTres").append(xhr.Nombres);
                    $("#CiudadTres").append(xhr.Ciudad);
                    $("#MarcaTres").append(xhr.Marca);         
                    $("#PuestoTres").append(xhr.Puesto);         
                    $("#CertamenDivisionResultadoITres").val(xhr.Id);                  
                    $("#RegistroTresD").hide('slow');
                    $("#TresN").hide('slow');
                    $("#ResultadoTresD").show('slow');

                    $("#TresDeportistaN").val('');   
                    $('#TresDeportistaN').selectpicker('refresh'); 
                    $("#TresMarcaN").val('');
                    $("#TresPuestoN").val('');
                    $("#TresCiudad").val('');   
                    $('#TresCiudad').selectpicker('refresh'); 
              }    
            }              
            
          },
          error: function (xhr){
            validador_errores(xhr.responseJSON);
          }
        });
    }

    /******************************************************/
    $("#OroCiudad").on('change', function(){        
        if($(this).val() == ''){
            $("#OroD").hide('slow');
            $("#OroN").hide('slow');
            return false;
        }
        if($(this).val() == 33){
            $("#OroD").show('slow');
            $("#OroN").hide('slow');
        }else{
            $("#OroD").hide('slow');
            $("#OroN").show('slow');
        }
    });
    $("#AgregarOroD").on('click', function(){
        var datos = {
            CertamenDivision : $("#certamenDivisionInput").val(),
            OroDeportista: $("#OroDeportista").val(),
            OroMarca: $("#OroMarca").val(),
            OroCiudad: $("#OroCiudad").val(),
            Puesto: '1',
        } 
        AgregarRegistro(datos,1);        
    });

    $("#AgregarOroN").on('click', function(){
        var datos = {
            CertamenDivision : $("#certamenDivisionInput").val(),
            OroDeportistaN: $("#OroDeportistaN").val(),
            OroMarcaN: $("#OroMarcaN").val(),
            OroCiudad: $("#OroCiudad").val(),
            Puesto: '1',
        } 
        AgregarRegistroN(datos,1); 
    });



    /******************************************************/
    $("#PlataCiudad").on('change', function(){
        if($(this).val() == ''){
            $("#PlataD").hide('slow');
            $("#PlataN").hide('slow');
            return false;
        }
        if($(this).val() == 33){
            $("#PlataD").show('slow');
            $("#PlataN").hide('slow');
        }else{
            $("#PlataD").hide('slow');
            $("#PlataN").show('slow');
        }
    });
    $("#AgregarPlataD").on('click', function(){
        var datos = {
            CertamenDivision : $("#certamenDivisionInput").val(),
            PlataDeportista: $("#PlataDeportista").val(),
            PlataMarca: $("#PlataMarca").val(),
            PlataCiudad: $("#PlataCiudad").val(),
            Puesto: '2',
        } 
        AgregarRegistro(datos,2);         
    });

    $("#AgregarPlataN").on('click', function(){
        var datos = {
            CertamenDivision : $("#certamenDivisionInput").val(),
            PlataDeportistaN: $("#PlataDeportistaN").val(),
            PlataMarcaN: $("#PlataMarcaN").val(),
            PlataCiudad: $("#PlataCiudad").val(),
            Puesto: '2',
        } 
        AgregarRegistroN(datos,2);
    });



    /******************************************************/
    $("#BronceCiudad").on('change', function(){
        if($(this).val() == ''){
            $("#BronceD").hide('slow');
            $("#BronceN").hide('slow');
            return false;
        }
        if($(this).val() == 33){
            $("#BronceD").show('slow');
            $("#BronceN").hide('slow');
        }else{
            $("#BronceD").hide('slow');
            $("#BronceN").show('slow');
        }
    });
    $("#AgregarBronceD").on('click', function(){
        var datos = {
            CertamenDivision : $("#certamenDivisionInput").val(),
            BronceDeportista: $("#BronceDeportista").val(),
            BronceMarca: $("#BronceMarca").val(),
            BronceCiudad: $("#BronceCiudad").val(),
            Puesto: '3',
        } 
        AgregarRegistro(datos,3); 
    });

    $("#AgregarBronceN").on('click', function(){
        var datos = {
            CertamenDivision : $("#certamenDivisionInput").val(),
            BronceDeportistaN: $("#BronceDeportistaN").val(),
            BronceMarcaN: $("#BronceMarcaN").val(),
            BronceCiudad: $("#BronceCiudad").val(),
            Puesto: '3',
        } 
        AgregarRegistroN(datos,3); 
    });


    /******************************************************/
    $("#TresCiudad").on('change', function(){
        if($(this).val() == ''){
            $("#TresD").hide('slow');
            $("#TresN").hide('slow');
            return false;
        }
        if($(this).val() == 33){
            $("#TresD").show('slow');
            $("#TresN").hide('slow');
        }else{
            $("#TresD").hide('slow');
            $("#TresN").show('slow');
        }
    });
    $("#AgregarTresD").on('click', function(){
        var datos = {
            CertamenDivision : $("#certamenDivisionInput").val(),
            TresDeportista: $("#TresDeportista").val(),
            TresMarca: $("#TresMarca").val(),
            TresCiudad: $("#TresCiudad").val(),
            TresPuesto: $("#TresPuesto").val(),
            ObservacionTresPuesto: $("#ObservacionTresPuesto").val(),
            Puesto: '4',
        } 
        AgregarRegistro(datos,4); 
    });

    $("#AgregarTresN").on('click', function(){
        var datos = {
            CertamenDivision : $("#certamenDivisionInput").val(),
            TresDeportistaN: $("#TresDeportistaN").val(),
            TresMarcaN: $("#TresMarcaN").val(),
            TresCiudad: $("#TresCiudad").val(),
            TresPuestoN: $("#TresPuestoN").val(),
            Puesto: '4',
        } 
        AgregarRegistroN(datos,4); 
    });

});

function Resultado(id_certamenDivision, id_certamen, id_division){    
    $("#RegistroOroD").show();
    $("#ResultadoOroD").hide();
    $("#RegistroPlataD").show();
    $("#ResultadoPlataD").hide();
    $("#RegistroBronceD").show();
    $("#ResultadoBronceD").hide();
    $("#RegistroTresD").show();
    $("#ResultadoTresD").hide();
    $("#certamenDivisionInput").val(id_certamenDivision);

    $.get("getCertamenDivisionResultados/"+id_certamenDivision, function (CertamenDivisionResultados) {        
        if(CertamenDivisionResultados.length > 0){
            $.each(CertamenDivisionResultados, function(i, e){                
                if(e.Puesto == 1){                    
                    $("#RegistroOroD").hide('slow');
                    $("#ResultadoOroD").show('slow');
                    $("#NombreOro").empty();
                    $("#CiudadOro").empty();
                    $("#MarcaOro").empty();
                    if(e.deportista != null){                        
                        $("#NombreOro").append(e.deportista.persona['Primer_Nombre']+' '+e.deportista.persona['Segundo_Nombre']+' '+e.deportista.persona['Primer_Apellido']+' '+e.deportista.persona['Segundo_Apellido']);
                    }else{
                        $("#NombreOro").append(e.resultado_externo[0]['Nombres']);
                    }
                    if(e.departamento == null){                        
                        if(e['Departamento_Id'] == 33)
                            $("#CiudadOro").append('Bogotá D.C');
                        if(e['Departamento_Id'] == 34)
                            $("#CiudadOro").append('Fuerzas Armadas');
                        if(e['Departamento_Id'] == 35)
                            $("#CiudadOro").append('Internacional');
                    }else{
                        $("#CiudadOro").append(e.departamento['Nombre_Departamento']);
                    }
                    $("#MarcaOro").append(e['Marca']);
                    $("#CertamenDivisionResultadoIOro").val(e['Id']);
                }
                if(e.Puesto == 2){
                    $("#RegistroPlataD").hide('slow');
                    $("#ResultadoPlataD").show('slow');
                    $("#NombrePlata").empty();
                    $("#CiudadPlata").empty();
                    $("#MarcaPlata").empty();
                    if(e.deportista != null){                        
                        $("#NombrePlata").append(e.deportista.persona['Primer_Nombre']+' '+e.deportista.persona['Segundo_Nombre']+' '+e.deportista.persona['Primer_Apellido']+' '+e.deportista.persona['Segundo_Apellido']);
                    }else{
                        $("#NombrePlata").append(e.resultado_externo[0]['Nombres']);
                    }
                    if(e.departamento == null){                        
                        if(e['Departamento_Id'] == 33)
                            $("#CiudadPlata").append('Bogotá D.C');
                        if(e['Departamento_Id'] == 34)
                            $("#CiudadPlata").append('Fuerzas Armadas');
                        if(e['Departamento_Id'] == 35)
                            $("#CiudadPlata").append('Internacional');
                    }else{
                        $("#CiudadPlata").append(e.departamento['Nombre_Departamento']);
                    }
                    $("#MarcaPlata").append(e['Marca']);
                    $("#CertamenDivisionResultadoIPlata").val(e['Id']);
                }
                if(e.Puesto == 3){
                    $("#RegistroBronceD").hide('slow');
                    $("#ResultadoBronceD").show('slow');
                    $("#NombreBronce").empty();
                    $("#CiudadBronce").empty();
                    $("#MarcaBronce").empty();
                    if(e.deportista != null){                        
                        $("#NombreBronce").append(e.deportista.persona['Primer_Nombre']+' '+e.deportista.persona['Segundo_Nombre']+' '+e.deportista.persona['Primer_Apellido']+' '+e.deportista.persona['Segundo_Apellido']);
                    }else{
                        $("#NombreBronce").append(e.resultado_externo[0]['Nombres']);
                    }
                    if(e.departamento == null){                        
                        if(e['Departamento_Id'] == 33)
                            $("#CiudadBronce").append('Bogotá D.C');
                        if(e['Departamento_Id'] == 34)
                            $("#CiudadBronce").append('Fuerzas Armadas');
                        if(e['Departamento_Id'] == 35)
                            $("#CiudadBronce").append('Internacional');
                    }else{
                        $("#CiudadBronce").append(e.departamento['Nombre_Departamento']);
                    }
                    $("#MarcaBronce").append(e['Marca']);
                    $("#CertamenDivisionResultadoIBronce").val(e['Id']);
                }

                if(e.Puesto > 3){
                    $("#RegistroTresD").hide('slow');
                    $("#ResultadoTresD").show('slow');
                    $("#NombreTres").empty();
                    $("#CiudadTres").empty();
                    $("#MarcaTres").empty();
                    $("#PuestoTres").empty();
                    $("#ObservacionPuestoTres").empty();
                    if(e.deportista != null){                        
                        $("#NombreTres").append(e.deportista.persona['Primer_Nombre']+' '+e.deportista.persona['Segundo_Nombre']+' '+e.deportista.persona['Primer_Apellido']+' '+e.deportista.persona['Segundo_Apellido']);
                    }else{
                        $("#NombreTres").append(e.resultado_externo[0]['Nombres']);
                    }
                    if(e.departamento == null){                        
                        if(e['Departamento_Id'] == 33)
                            $("#CiudadTres").append('Bogotá D.C');
                        if(e['Departamento_Id'] == 34)
                            $("#CiudadTres").append('Fuerzas Armadas');
                        if(e['Departamento_Id'] == 35)
                            $("#CiudadTres").append('Internacional');
                    }else{
                        $("#CiudadTres").append(e.departamento['Nombre_Departamento']);
                    }
                    $("#MarcaTres").append(e['Marca']);
                    $("#PuestoTres").append(e['Puesto']);
                    $("#ObservacionPuestoTres").append(e['Observacion']);                    
                    $("#CertamenDivisionResultadoITres").val(e['Id']);
                }
            });
        }
    });

    $.get("getDivisionDeportista/"+id_division, function (Division) {
        $("#TituloE").empty();
        $("#TituloE").append('Registro de resultados: '+Division['Nombre_Division']+' ('+Division.deporte['Nombre_Deporte']+'-'+Division.rama['Nombre_Rama']+'-'+Division.categoria['Nombre_Categoria']+')');
        $("#OroDeportista").empty();
        $("#PlataDeportista").empty();
        $("#BronceDeportista").empty();
        $("#TresDeportista").empty();
        var html = '<option value="">Seleccionar</option>';
        $.get("getDeportistaDivision/"+Division['Deporte_Id'], function (Deportistas) {
            $.each(Deportistas['deportista'], function(i, e){
                html += '<option value="'+e.Id+'">'+e.persona['Primer_Nombre']+' '+e.persona['Segundo_Nombre']+' '+e.persona['Primer_Apellido']+' '+e.persona['Segundo_Apellido']+'</option>';
            });
            $("#OroDeportista").html(html).selectpicker('refresh');
            $("#PlataDeportista").html(html).selectpicker('refresh');
            $("#BronceDeportista").html(html).selectpicker('refresh');
            $("#TresDeportista").html(html).selectpicker('refresh');
        });
    });

    setTimeout(function(){ $("#RegistroResultadosD").modal('show');  }, 1000);
}

function Eliminar(puesto){
    var CertamenDivisionResultado = '';
    if(puesto == 1){
        CertamenDivisionResultado = $("#CertamenDivisionResultadoIOro").val();
    }

    if(puesto == 2){
        CertamenDivisionResultado = $("#CertamenDivisionResultadoIPlata").val();
    }

    if(puesto == 3){
        CertamenDivisionResultado = $("#CertamenDivisionResultadoIBronce").val();
    }

    if(puesto == 4){
        CertamenDivisionResultado = $("#CertamenDivisionResultadoITres").val();
    }

    var token = $("#token").val();
    var datos = '';
    $.ajax({            
      url: 'deleteCertamenDivisionRegistro/'+CertamenDivisionResultado,  
      type: 'POST',
      data: '1',
      dataType: "json",
      success: function (xhr) {       
          $('#alert_registro').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
          $('#mensaje_registro').show(60);
          $('#mensaje_registro').delay(1500).hide(600);     
          if(puesto == 1){
                $("#NombreOro").empty();
                $("#CiudadOro").empty();
                $("#MarcaOro").empty();                
                $("#RegistroOroD").show('slow');
                $("#ResultadoOroD").hide('slow');
            }

            if(puesto == 2){
                $("#NombrePlata").empty();
                $("#CiudadPlata").empty();
                $("#MarcaPlata").empty();                
                $("#RegistroPlataD").show('slow');
                $("#ResultadoPlataD").hide('slow');
            }

            if(puesto == 3){
                $("#NombreBronce").empty();
                $("#CiudadBronce").empty();
                $("#MarcaBronce").empty();                
                $("#RegistroBronceD").show('slow');
                $("#ResultadoBronceD").hide('slow');
            }  

            if(puesto > 3){
                $("#NombreTres").empty();
                $("#CiudadTres").empty();
                $("#MarcaTres").empty();                
                $("#PuestoTres").empty();                
                $("#RegistroTresD").show('slow');
                $("#ResultadoTresD").hide('slow');
            }  
      },
      error: function (xhr){
        console.log('err'+xhr);
      }
    });
}