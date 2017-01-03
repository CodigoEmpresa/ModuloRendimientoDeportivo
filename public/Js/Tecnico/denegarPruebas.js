$(function(){
    $('#pruebasTabla').DataTable({
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

    $("#Metodologo_Id").on('change', function(){
        $("#Paso2").hide('slow');
        $("#Paso3").hide('slow');
        $("#Clasificacion_Id").val('').change();        
        $("#Paso2").show('slow');
    });

    $("#Clasificacion_Id").on('change', function(){            
        $("#Evento_Id").empty();
        $("#Certamen_Id").empty();
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
        var t = $('#pruebasTabla').DataTable();
        t.row.add(['1','1','1'] ).clear().draw( false );
        if($(this).val != ''){  
            $.get("getDivisionCertamenMetodS/"+$(this).val()+"/"+$("#Metodologo_Id").val(), function (DivisionCertamen){                
                if(DivisionCertamen.length != 0){                                    
                    $.each(DivisionCertamen, function(i, e){
                        t.row.add( [
                            e.cetamen_division.division.deporte['Nombre_Deporte'],
                            e.cetamen_division.division.rama['Nombre_Rama']+' - '+e.cetamen_division.division.categoria['Nombre_Categoria']+' - '+e.cetamen_division.division['Nombre_Division'],                        
                            '<button type="button" class="btn btn-danger" onclick="EliminarMetodologo('+e.cetamen_division['Id']+', '+$("#Metodologo_Id").val()+')">Eliminar</button>',
                        ] ).draw( false );
                    });
                }
            });  
            $("#Paso3").show('slow');
        }
    });    
});

function EliminarMetodologo(id_certamen_division, id_persona){
    /*alert(id_certamen_division+'---'+id_persona);
    return false;*/
    var token = $("#token").val();
    $.ajax({
      url: 'deleteCertamenDivisionMetodologo/'+id_certamen_division+'/'+id_persona,  
      type: 'POST',
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (xhr) {
        if(xhr.Bandera == 1){                
            var t = $('#pruebasTabla').DataTable();
            t.row.add(['1','1','1'] ).clear().draw( false );
            $.get("getDivisionCertamenMetodS/"+$("#Certamen_Id").val()+"/"+$("#Metodologo_Id").val(), function (DivisionCertamen){                
                if(DivisionCertamen.length != 0){                                    
                    $.each(DivisionCertamen, function(i, e){
                        t.row.add( [
                            e.division.deporte['Nombre_Deporte'],
                            e.division.rama['Nombre_Rama']+' - '+e.division.categoria['Nombre_Categoria']+' - '+e.division['Nombre_Division'],                        
                            '<button type="button" class="btn btn-danger" onclick="EliminarMetodologo('+e['Id']+', '+$("#Metodologo_Id").val()+')">Eliminar</button>',
                        ] ).draw( false );
                    });
                }
            });  
            $('#alert').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
            $('#mensaje').show(60);
            $('#mensaje').delay(1500).hide(600);                     
        }
        else if(xhr.Bandera == 2){
          $('#alert').html('<div class="alert alert-dismissible alert-danger" ><strong>Error!</strong>'+xhr.Mensaje+'</div>');
          $('#mensaje').show(60);
          $('#mensaje').delay(1500).hide(600);       
        }
      },
      error: function (xhr){
        $('#alert').html('<div class="alert alert-dismissible alert-danger" ><strong>Error!</strong>'+xhr.Mensaje+'</div>');
        $('#mensaje').show(60);
        $('#mensaje').delay(1500).hide(600);  
      }
    });
}