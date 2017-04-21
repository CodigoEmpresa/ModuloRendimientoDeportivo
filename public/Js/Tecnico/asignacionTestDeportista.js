$(function(){    
    $('#TablaDeportistasDatos').DataTable({
        retrieve: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        dom: 'Bfrtip',
        select: true,
        "responsive": true,
        "ordering": true,
        "info": true,
        "pageLength": 20,
        "language": {
            url: 'public/DataTables/Spanish.json',
            searchPlaceholder: "Buscar"
        }
    });

    $('#TablaListaAsignadosDatos').DataTable({
        retrieve: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        dom: 'Bfrtip',
        select: true,
        "responsive": true,
        "ordering": true,
        "info": true,
        "pageLength": 5,
        "language": {
            url: 'public/DataTables/Spanish.json',
            searchPlaceholder: "Buscar"
        }
    });

    var validador_errores = function(data, formulario){
        $('#'+formulario+' .form-group').removeClass('has-error');
        $.each(data, function(i, e){
            $("#"+i).closest('.form-group').addClass('has-error');
        });
    }

    $('#TablaDeportistasDatos').delegate('button[data-function="AsignarTest"]','click',function (e) {               
        $.get("getDeportista/"+$(this).val(), function (Deportista) {
            $("#Deportista_Id").val(Deportista['Id']);
            $("#NombresDeportista").empty();
            $("#NombresDeportista").append(Deportista.persona['Primer_Nombre']+' '+Deportista.persona['Segundo_Nombre']+' '+Deportista.persona['Primer_Apellido']+' '+Deportista.persona['Segundo_Apellido']);
            TestAsignadosFormulario(Deportista['Id']);
        }).done(function(){
            $("#AsignacionTestDeportistaModal").modal('show');
        });
    });

    $("#Tipo_Test_Id").on('change', function(){
        $("#Test_Id").empty();
        if($(this).val() != ''){
            $.get("getTestTipos/"+$(this).val(), function (Test) {
                var html = '';
                html += '<option value="">Seleccionar</option>';
                $.each(Test, function(i, e){
                    html += '<option value="'+e.Id+'">'+e.Nombre_Test+'</option>';
                });
                $("#Test_Id").html(html).selectpicker('refresh');
            });
        }else{
            $("#Test_Id").append('<option value="">Seleccionar</option>');
            $("#Test_Id").html(html).selectpicker('refresh');
        }
        $('#Test_Id').selectpicker('refresh'); 
    });

    $("#VerAsignar").on('click', function(){
        $("#ADF").show('slow');        
    });

    $("#AgregarAsignacionDeportista").on('click', function(){
        var token = $("#token").val();
        var formData = new FormData($("#AsignacionTestDeportistaF")[0]);            
        $.ajax({
          url: 'AddAsignacionTestDeportista',  
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (xhr) {
            if(xhr.status == 'error'){
              validador_errores(xhr.errors);
            }
            else{
              $('#MensajeAsignacionDeportista').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#MensajeAsignacionDeportista').show(60);
              $('#MensajeAsignacionDeportista').delay(1500).hide(600);                           
              setTimeout(function(){ 
               TestAsignadosFormulario($("#Deportista_Id").val());
              }, 300);
              
            }
          },
          error: function (xhr){
            validador_errores(xhr.responseJSON, 'AsignacionTestDeportistaF');
          }
        });
    });

    function TestAsignadosFormulario(id_deportista){
        $("#ADF").hide('slow');
         document.getElementById("AsignacionTestDeportistaF").reset();   
        $('#AsignacionTestDeportistaF .form-group').removeClass('has-error');

        $.get("getTestDeportista/"+id_deportista, function (DeportistaTest) {
            var t = $('#TablaListaAsignadosDatos').DataTable();
            t.row.add( ['1', '1', '1', '1', '1'] ).clear().draw( false );
            if((DeportistaTest.deportista_test).length != 0){             
                $.each(DeportistaTest.deportista_test, function(i, e){
                    t.row.add( [
                        e['test']['tipo_test']['Nombre_Tipo_Test'],
                        e.test['Nombre_Test'],     
                        e['Resultado'],
                        e['Descripcion_Resultado'],                        
                        '<button type="button" class="btn btn-danger" data-function="EliminarAsignacionTest" value="'+e['Id']+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar</button>',
                    ] ).draw( false );
                });
            }
        });
    }

    $('#TablaListaAsignadosDatos').delegate('button[data-function="EliminarAsignacionTest"]','click',function (e) {
        var token = $("#token").val();
        var formData = new FormData($("#AsignacionTestDeportistaF")[0]);            
        formData.append("Id_DeportistaTes_Delete",$(this).val());
        $.ajax({
          url: 'DeleteAsignacionTestDeportista',  
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (xhr) {
            if(xhr.status == 'error'){
              validador_errores(xhr.errors);
            }
            else{
              $('#MensajeAsignacionDeportista').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#MensajeAsignacionDeportista').show(60);
              $('#MensajeAsignacionDeportista').delay(1500).hide(600);                           
              setTimeout(function(){ 
               TestAsignadosFormulario($("#Deportista_Id").val());
              }, 300);
              
            }
          },
          error: function (xhr){
            validador_errores(xhr.responseJSON, 'AsignacionTestDeportistaF');
          }
        });
    });
});