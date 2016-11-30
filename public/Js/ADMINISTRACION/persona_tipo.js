$(function(e){  

    $("#AgregarTipo").on('click', function(){
        $("#Id_Persona").val();
        var formData = new FormData($("#registro")[0]);
        var token = $("#token").val();      

         $.ajax({
            type: 'POST',
            url: 'AddPersonaTipo',
            headers: {'X-CSRF-TOKEN': token},
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            data: formData,
            success: function (xhr) { 
                if(xhr.status == 'error')
                {
                    validador_errores(xhr.errors);
                    return false;
                }
                else 
                {
                    var t = $('#personaTipoTabla').DataTable();
                    var id_t = $("#Tipo_Persona").val();
                    var combo = document.getElementById("Tipo_Persona");
                    var selected = combo.options[combo.selectedIndex].text;
                    t.row.add( [
                        selected,
                        '<center><button type="button" class="btn btn-danger" onclick="EliminarTipo('+id_t+')">Eliminar</button></center>',
                    ] ).draw( false );
                    $('#alert_evento1').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
                    $('#mensaje_evento1').show(60);
                    $('#mensaje_evento1').delay(2000).hide(600);  
                    $("#Tipo_Persona").val('');            
                }
                
            },
            error: function (xhr){              
                validador_errores(xhr.responseJSON);
            }
        });

    });

    var validador_errores = function(data){

        $('#registro .form-group').removeClass('has-error');

        $.each(data, function(i, e){
            $("#"+i).closest('.form-group').addClass('has-error');
        });
    }

    $('#personaTipoTabla').DataTable({
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
 
});

function Buscar(e){ 
    var t = $('#personaTipoTabla').DataTable();
    t.row.add( ['1','1', '1'] ).clear().draw( false );  

    var key = $('input[name="buscador"]').val(); 
    $.get('personaBuscarDeportista/'+key,{}, function(data){  

        if(data.length > 0){      
           
            $("#Id_Persona").val(data[0]['Id_Persona']);
            $("#Nombres").append(data[0]['Primer_Nombre']+' '+data[0]['Segundo_Nombre']+' '+data[0]['Primer_Apellido']+' '+data[0]['Segundo_Apellido']);
            $("#Identificacion").append('Identificación '+data[0]['Cedula']);
            


            $.get('persona_tipoEspe/'+data[0]['Id_Persona'],{}, function(Tipos){
                $("#Tipo_Persona").empty();
                $("#Tipo_Persona").append('<option value="">Seleccionar</option>');
                $.each(Tipos, function(i, e){
                    $("#Tipo_Persona").append('<option value="'+e['Id_Tipo']+'">'+e['Nombre']+'</option>');
                });
            }).done(function(){
                $.get('persona_tipoEspe2/'+data[0]['Id_Persona'],{}, function(TipoPers){
                var t = $('#personaTipoTabla').DataTable();
                if(TipoPers.length != 0){                
                    t.row.add( ['1','1', '1'] ).clear().draw( false );
                    $.each(TipoPers, function(i, e){
                        t.row.add( [
                            e['Nombre'],                            
                            '<center><button type="button" class="btn btn-danger" onclick="EliminarTipo('+e['Id_Tipo']+')">Eliminar</button></center>',
                        ] ).draw( false );
                    });
                }

                }).done(function(){
                    $("#AsignarPersonas").show('slow');
                        $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
                        $('#buscar span').empty();
                        document.getElementById("buscar").disabled = false;    
                });
                
            });            

        }else{    
            $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
            $('#buscar span').empty();
            document.getElementById("buscar").disabled = false;
            $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">No se encuentra ninguna persona registrada con estos datos.</h4></dvi><br>');
            $('#paginador').fadeOut();
        }        
    },
    'json'
    );
}

function Reset_campos(e){    

    $("#Nombres").empty();
    $("#Identificacion").empty();
    $("#Id_Persona").val('');

    $("#AsignarPersonas").hide('slow');

    $("#Modificar").hide();
    $("#Registrar").hide();
}

function EliminarTipo(id_Tipo){
    var token = $("#token").val();  
     $.ajax({
        type: 'POST',
        url: 'DeletePersonaTipo/'+$("#Id_Persona").val()+'/'+id_Tipo,
        headers: {'X-CSRF-TOKEN': token},
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
                var t = $('#personaTipoTabla').DataTable();
                t.row.add( ['1','1', '1'] ).clear().draw( false );

                $.get('persona_tipoEspe2/'+$("#Id_Persona").val(),{}, function(TipoPers){
                    console.log(TipoPers);
                var t = $('#personaTipoTabla').DataTable();
                if(TipoPers.length != 0){                
                    $.each(TipoPers, function(i, e){
                        t.row.add( [
                            e['Nombre'],                            
                            '<center><button type="button" class="btn btn-danger" onclick="EliminarTipo('+e['Id_Tipo']+')">Eliminar</button></center>',
                        ] ).draw( false );
                    });
                }

                }).done(function(){
                    $('#alert_evento1').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
                    $('#mensaje_evento1').show(60);
                    $('#mensaje_evento1').delay(2000).hide(600);              
                });
            }            
        },
        error: function (xhr){              
        }
    });
} 