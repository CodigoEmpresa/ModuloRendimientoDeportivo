$(function(){

    $('#TablaTestDatos').DataTable({
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

    $('#TablaVariablesDatos').DataTable({
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

    TestFormulario();

    $("#Test").on('click', function(){
        TestFormulario();
    });

    function TestFormulario (){
        $("#TestF").show('slow');
        $("#TestLi").addClass('active');

        $("#VariablesF").hide('slow');
        $("#VariablesLi").removeClass('active');

        $("#DeportistasF").hide('slow');        
        $("#DeportistasLi").removeClass('active');

        $("#TestDatosTB").empty();
        $("#CrearTestDV").hide('slow');

        document.getElementById("TestF").reset();   
        $('#TestF .form-group').removeClass('has-error');

        $.get("getTest", function (Test) {
            var t = $('#TablaTestDatos').DataTable();
            t.row.add( ['1', '1', '1'] ).clear().draw( false );
            if(Test.length != 0){             
                $.each(Test, function(i, e){
                    t.row.add( [
                        e.tipo_test['Nombre_Tipo_Test'],
                        e['Nombre_Test'],
                        '<button type="button" class="btn btn-danger" data-function="EliminarTest" value="'+e['Id']+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar Test</button>',
                    ] ).draw( false );
                });
            }
        });
    }

    $("#Variables").on('click', function(){
        VariablesFormulario();
    });

    function VariablesFormulario (){
        $("#TestF").hide('slow');
        $("#TestLi").removeClass('active');

        $("#VariablesF").show('slow');
        $("#VariablesLi").addClass('active');

        $("#DeportistasF").hide('slow');        
        $("#DeportistasLi").removeClass('active');

        $("#CrearVariableDV").hide('slow');
        document.getElementById("VariablesF").reset();   
        $('#VariablesF .form-group').removeClass('has-error');            

        $.get("getVariables", function (Variables) {
            var t = $('#TablaVariablesDatos').DataTable();
            t.row.add( ['1', '1'] ).clear().draw( false );
            if(Test.length != 0){             
                $.each(Variables, function(i, e){
                    t.row.add( [
                        e['Nombre_Variable'],
                        '<button type="button" class="btn btn-danger" data-function="EliminarVariable" value="'+e['Id']+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar Variable</button>',
                    ] ).draw( false );
                });
            }
        });
    }

    $("#Crear_Test").on('click', function(){
        $("#CrearTestDV").show('slow');
    });

    $("#AgregarTest").on('click', function(){
        var token = $("#token").val();
        var formData = new FormData($("#TestF")[0]);            
        $.ajax({
          url: 'AddTest',  
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
              $('#MensajeTest').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#MensajeTest').show(60);
              $('#MensajeTest').delay(1500).hide(600);                           
              setTimeout(function(){ 
                TestFormulario();
              }, 300);
              
            }
          },
          error: function (xhr){
            validador_errores(xhr.responseJSON, 'TestF');
          }
        });
    });

    var validador_errores = function(data, formulario){
        $('#'+formulario+' .form-group').removeClass('has-error');
        $.each(data, function(i, e){
            $("#"+i).closest('.form-group').addClass('has-error');
        });
    }

    $('#TablaTestDatos').delegate('button[data-function="EliminarTest"]','click',function (e) {
        //alert($(this).val());
        var token = $("#token").val();
        var formData = new FormData($("#TestF")[0]);            
        formData.append("Id_Test",$(this).val());
        $.ajax({
          url: 'DeleteTest',  
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
              $('#MensajeTest').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#MensajeTest').show(60);
              $('#MensajeTest').delay(1500).hide(600);  
              document.getElementById("TestF").reset();              
              setTimeout(function(){ 
                TestFormulario();
              }, 300);
              
            }
          },
          error: function (xhr){
            validador_errores(xhr.responseJSON, 'TestF');
          }
        });
    });

    $("#Crear_Variable").on('click', function(){
        $("#CrearVariableDV").show('slow');
    });

    $("#AgregarVariable").on('click', function(){
        var token = $("#token").val();
        var formData = new FormData($("#VariablesF")[0]);            
        $.ajax({
          url: 'AddVariable',  
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
              $('#MensajeVariables').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#MensajeVariables').show(60);
              $('#MensajeVariables').delay(1500).hide(600);                
              setTimeout(function(){ 
                VariablesFormulario();
              }, 300);
              
            }
          },
          error: function (xhr){
            validador_errores(xhr.responseJSON, 'TestF');
          }
        });
    });

    $('#TablaVariablesDatos').delegate('button[data-function="EliminarVariable"]','click',function (e) {
        var token = $("#token").val();
        var formData = new FormData($("#VariablesF")[0]);            
        formData.append("Id_Variable",$(this).val());
        $.ajax({
          url: 'DeleteVariable',  
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
              $('#MensajeVariables').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
              $('#MensajeVariables').show(60);
              $('#MensajeVariables').delay(1500).hide(600);  
              document.getElementById("TestF").reset();              
              setTimeout(function(){ 
                VariablesFormulario();
              }, 300);
              
            }
          },
          error: function (xhr){
            validador_errores(xhr.responseJSON, 'TestF');
          }
        });
    });
});