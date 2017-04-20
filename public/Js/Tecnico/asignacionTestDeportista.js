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
            $("#NombresDeportista").empty();
            $("#NombresDeportista").append(Deportista.persona['Primer_Nombre']+' '+Deportista.persona['Segundo_Nombre']+' '+Deportista.persona['Primer_Apellido']+' '+Deportista.persona['Segundo_Apellido']);
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
               // TestFormulario();
              }, 300);
              
            }
          },
          error: function (xhr){
            validador_errores(xhr.responseJSON, 'AsignacionTestDeportistaF');
          }
        });
    });
});