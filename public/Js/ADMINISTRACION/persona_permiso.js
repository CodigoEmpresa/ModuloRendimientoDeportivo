$(function(e){  

    function ValidaCampo(e){
        tecla = (document.all) ? e.keyCode : e.which;
         if (tecla==8) return true;
         patron =/[A-Za-z0-9\s]/;
         te = String.fromCharCode(tecla);
         return patron.test(te);
    }
});

function Buscar(e){ 
    var t = $('#personaTipoTabla').DataTable();
    t.row.add( ['1','1', '1'] ).clear().draw( false );  

    var key = $('input[name="buscador"]').val(); 
    $.get('personaBuscarDeportista/'+key,{}, function(data){  

        if(data.length > 0){      
           
            $("#Id_Persona").val(data[0]['Id_Persona']);
            $("#Nombres").append(data[0]['Primer_Nombre']+' '+data[0]['Segundo_Nombre']+' '+data[0]['Primer_Apellido']+' '+data[0]['Segundo_Apellido']);
            $("#Identificacion").append('IDENTIFICACIÓN '+data[0]['Cedula']);           

            actividadesCheck(data[0]['Id_Persona']);
            setTimeout(function(){ 
                $("#AsignarPermisos").show('slow');
                $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
                $('#buscar span').empty();
                document.getElementById("buscar").disabled = false; 
            }, 2300);          

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

function actividadesCheck(id){        
    $.get('actividadesModulo', function(Stipo){
        console.log(Stipo);
        CBActividades = '';     
        ActividadesMod = [];
        i=0;
        $.each(Stipo, function(i, e){
            CBActividades +='<input type="checkbox" name="CB'+e.Id_Actividad+'" id="CB'+e.Id_Actividad+'" value="'+e.Id_Actividad+'"/><small style="text-transform: uppercase;">'+e.Nombre_Actividad+'</small><br>';
            ActividadesMod[i] = {'id' : e.Id_Actividad, 'Nombre': e.Nombre_Actividad};
            i=i+1;
        });     
        $('#actividadesCheck').append(CBActividades);            
                
    }).done(function(){
        $.get('getPersonaActividades/'+id, function(act_Per){
            $.each(act_Per, function(i, e){
                $("#CB"+e.Id_Actividad).prop('checked', true);
            });
            $("#Agregar"+id).prop('disabled', false);
        });  
    });
    
}

function Agregar(id){
    var id = $("#Id_Persona").val();
    var ArrayActividades = [];
    for(i=0;i<ActividadesMod.length;i++){
        nombre = '#CB'+ActividadesMod[i].id;
        if($(nombre).is(":checked") == true){                
            ArrayActividades[(ArrayActividades.length)] = {'id_actividad':ActividadesMod[i].id, 'estado': 1};
        }else{
            ArrayActividades[(ArrayActividades.length)] = {'id_actividad':ActividadesMod[i].id, 'estado': 0};
        }
    }
    var token = $("#token").val();
    var datos = {Datos: ArrayActividades, Id: id}
    $.ajax({
        type: 'POST',
        url: 'PersonasActividadesProceso',
        headers: {'X-CSRF-TOKEN': token},
        dataType: 'json',
        data: datos,
        success: function (xhr) {  
            if(xhr.Bandera == 1){//OK
                $("#Id_Tipo"+id).css({ 'border-color': '#B94A48' });    
                $('#alert_permiso').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
                $('#mensaje_permiso').show(60);
                $('#mensaje_permiso').delay(1000).hide(500);  
                             
            }else{
                $("#Id_Tipo"+id).css({ 'border-color': '#CCCCCC' });    
                $('#alert_permiso').html('<div class="alert alert-dismissible alert-danger" ><strong>Error!</strong>'+xhr.Mensaje+'</div>');
                $('#mensaje_permiso').show(60);
                $('#mensaje_permiso').delay(1000).hide(500);  
                
            }
        }
    });
}

function Reset_campos(e){   
    $("#AsignarPermisos").hide('slow'); 
    $("#Id_Persona").val('');
    $("#Nombres").empty();
    $("#Identificacion").empty();      
    $('#actividadesCheck').empty();
}