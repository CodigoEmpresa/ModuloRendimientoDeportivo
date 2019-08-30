$(function(e){  
    $('#metodologoAgrupacionTabla').DataTable({
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

    $("#Metodologo_Id").on('change', function(){   
        $("#AgrupacionesSeleccion").hide('slow');
        $("#AgrupacionesAsignadas").hide('slow');
        var t = $('#metodologoAgrupacionTabla').DataTable();
        if($(this).val() != ''){
            $("#loading").show('slow');
            $.get('getMetodologoAgrupacion/'+$(this).val(), function(AgrupacionesAsignadas){
                t.row.add( ['1','1','1'] ).clear().draw( false );
                $.each(AgrupacionesAsignadas, function(i, e){                    
                    t.row.add( [
                        '<div style="text-transform: uppercase;">'+e.clasificacion_deportista['Nombre_Clasificacion_Deportista']+'</div>',
                        '<div style="text-transform: uppercase;">'+e.Nombre_Agrupacion+'</div>',
                        '<button type="button" class="btn btn-danger" onclick="EliminarAsignada('+e['Id']+');">Eliminar</button>',
                    ] ).draw( false );
                });
            });               
            $.get('getMetodologoAgrupacionNO/'+$(this).val(), function(AgrupacionesNuevas){
                 var html = '<option value="" style="text-transform: uppercase;">Seleccionar</option>';
                $.each(AgrupacionesNuevas, function(i, e){
                    html += "<option style='text-transform: uppercase;' value='" +e.Id + "'>" +e.clasificacion_deportista['Nombre_Clasificacion_Deportista']+' - '+e.Nombre_Agrupacion + "</option>";
                });
                $("#Agrupacion_Id").html(html).selectpicker('refresh');
            }).done(function(){                
                $("#loading").hide('slow');
                $("#AgrupacionesSeleccion").show('slow');
                $("#AgrupacionesAsignadas").show('slow');
                
            });
        }else{
            var html = '<option value="" style="text-transform: uppercase;">Seleccionar</option>';
            $("#Agrupacion_Id").html(html).selectpicker('refresh');
            $("#loading").hide('slow');
            $("#AgrupacionesAsignadas").hide('slow');
            $("#AgrupacionesSeleccion").hide('slow');
        } 
    });

    $("#AgregarAgrupacion").on('click', function(){
        var token = $("#token").val();
        var formData = new FormData($("#")[0]);       
        var formData = new FormData($("#MetodologoAgrupacionF")[0]);          
        $.ajax({
          url: 'AddMetodologoAgrupacion',  
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
              $('#alert').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#mensaje').show(60);
              $('#mensaje').delay(1500).hide(600);       
              setTimeout(function(){ $("#creaCertamenD").modal('hide');  }, 1500);

            var t = $('#metodologoAgrupacionTabla').DataTable();
            $("#loading").show('slow');
            $("#AgrupacionesSeleccion").hide('slow');
            $("#AgrupacionesAsignadas").hide('slow');
            $.get('getMetodologoAgrupacion/'+$("#Metodologo_Id").val(), function(AgrupacionesAsignadas){
                t.row.add( ['1','1','1'] ).clear().draw( false );
                $.each(AgrupacionesAsignadas, function(i, e){                    
                    t.row.add( [
                        '<div style="text-transform: uppercase;">'+e.clasificacion_deportista['Nombre_Clasificacion_Deportista']+'</div>',
                        '<div style="text-transform: uppercase;">'+e.Nombre_Agrupacion+'</div>',
                        '<button type="button" class="btn btn-danger" onclick="EliminarAsignada('+e['Id']+')">Eliminar</button>',
                    ] ).draw( false );
                });
            });               
            $.get('getMetodologoAgrupacionNO/'+$("#Metodologo_Id").val(), function(AgrupacionesNuevas){
                 var html = '<option value="" style="text-transform: uppercase;">Seleccionar</option>';
                $.each(AgrupacionesNuevas, function(i, e){
                    html += "<option style='text-transform: uppercase;' value='" +e.Id + "'>" +e.clasificacion_deportista['Nombre_Clasificacion_Deportista']+' - '+e.Nombre_Agrupacion + "</option>";
                });
                $("#Agrupacion_Id").html(html).selectpicker('refresh');
            }).done(function(){                
                $("#loading").hide('slow');
                $("#AgrupacionesSeleccion").show('slow');
                $("#AgrupacionesAsignadas").show('slow');
                
            });            
            }
          },
          error: function (xhr){
            validador_errores(xhr.responseJSON);
          }
        });
    });

    var validador_errores = function(data){
      $('#MetodologoAgrupacionF .form-group').removeClass('has-error');

      $.each(data, function(i, e){
        $("#"+i).closest('.form-group').addClass('has-error');
      });
    }

    
});

function EliminarAsignada(Id_Agrupacion){        
        var datos = {
            Metodologo_Id : $("#Metodologo_Id").val(),
            Agrupacion_Id : Id_Agrupacion,
        }
        $.ajax({
          url: 'DeleteMetodologoAgrupacion',  
          type: 'POST',
          data: datos,
          dataType: "json",
          success: function (xhr) {
            if(xhr.status == 'error'){
              validador_errores(xhr.errors);
            }
            else 
            {
              $('#alert').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#mensaje').show(60);
              $('#mensaje').delay(1500).hide(600);       
              setTimeout(function(){ $("#creaCertamenD").modal('hide');  }, 1500);

            var t = $('#metodologoAgrupacionTabla').DataTable();
            $("#loading").show('slow');
            $("#AgrupacionesSeleccion").hide('slow');
            $("#AgrupacionesAsignadas").hide('slow');
            $.get('getMetodologoAgrupacion/'+$("#Metodologo_Id").val(), function(AgrupacionesAsignadas){
                t.row.add( ['1','1','1'] ).clear().draw( false );
                $.each(AgrupacionesAsignadas, function(i, e){                    
                    t.row.add( [
                        '<div style="text-transform: uppercase;">'+e.clasificacion_deportista['Nombre_Clasificacion_Deportista']+'</div>',
                        '<div style="text-transform: uppercase;">'+e.Nombre_Agrupacion+'</div>',
                        '<button type="button" class="btn btn-danger" onclick="EliminarAsignada('+e['Id']+')">Eliminar</button>',
                    ] ).draw( false );
                });
            });               
            $.get('getMetodologoAgrupacionNO/'+$("#Metodologo_Id").val(), function(AgrupacionesNuevas){
                 var html = '<option value="" style="text-transform: uppercase;">Seleccionar</option>';
                $.each(AgrupacionesNuevas, function(i, e){
                    html += "<option style='text-transform: uppercase;' value='" +e.Id + "'>" +e.clasificacion_deportista['Nombre_Clasificacion_Deportista']+' - '+e.Nombre_Agrupacion + "</option>";
                });
                $("#Agrupacion_Id").html(html).selectpicker('refresh');
            }).done(function(){                
                $("#loading").hide('slow');
                $("#AgrupacionesSeleccion").show('slow');
                $("#AgrupacionesAsignadas").show('slow');
                
            });            
            }
          },
          error: function (xhr){
            validador_errores(xhr.responseJSON);
          }
        });
    }

    function validador_errores(data){
      $('#MetodologoAgrupacionF .form-group').removeClass('has-error');

      $.each(data, function(i, e){
        $("#"+i).closest('.form-group').addClass('has-error');
      });
    }