var idiomas = new Array();
  var quien = new Array();
  var riesgo = new Array();
$(function(e){ 	
  $('#Fecha_InicioDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
  $('#Fecha_FinDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
  $('#Fecha_AnioPDate').datepicker({ minViewMode: 2, format: 'yyyy', autoclose: true, });

  $('#Fecha_AnioPDate').on('change', function(){
    var fecha = ($("#fechaNac").val()).split("-");
    var InicioPractica = $('#Fecha_AnioP').val() - fecha[0]
    //año que inicio la practicaconsole.log($('#Fecha_AnioP').val() - fecha[0]);

    var f = new Date();
    var anioActual = f.getFullYear();
    var EdadActual = parseInt(fecha[0] - anioActual);//- $('#Fecha_AnioP').val();
    var AniosPracticando = ((-1)*EdadActual) - InicioPractica;
    $("#EdadPreg").val(InicioPractica);
    $("#PracticaPreg").val(AniosPracticando);

    console.log('InicioPractica->' +InicioPractica);
    console.log('EdadActual->'+EdadActual);
    console.log('AniosPracticando->'+AniosPracticando);
  });


	$("#Registrar").on('click', function(){		
		registro('AddValoracion');
	});   

  $("#Modificar").on('click', function(){   
    registro('EditValoracion');
  });   

	function registro (url){	
        var token = $("#token").val();
        var formData = new FormData($("#psico")[0]);
        var json_idiomas = JSON.stringify(idiomas);        
        formData.append("vector_idiomas",json_idiomas);
        var json_quien = JSON.stringify(quien);
        formData.append("vector_quien",json_quien);
        var json_riesgo = JSON.stringify(riesgo);
        formData.append("vector_riesgo",json_riesgo);
        $.ajax({
            url: url,  
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (xhr) {  
            	$('#alert_actividad').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
      				$('#mensaje_actividad').show(60);
      				$('#mensaje_actividad').delay(2000).hide(600);				
      				Reset_campos();
            },
            error: function (xhr){
              validador_errores(xhr.responseJSON);
            }
        });
	}

  var validador_errores = function(data){
    $('#psico .form-group').removeClass('has-error');
    VerCampos();

    $.each(data, function(i, e){
      $("#"+i).closest('.form-group').addClass('has-error');
        $("input[name="+i+"]").closest('.form-group').addClass('has-error');        

        if(i == 'op4'){ $("#p4o1").closest('.form-group').addClass('has-error'); }
        if(i == 'op26'){ $("#p26o1").closest('.form-group').addClass('has-error'); }
        if(i == 'op34'){ $("#p34o1").closest('.form-group').addClass('has-error'); }
        if(i == 'op7'){ $("#p7o1").closest('.form-group').addClass('has-error'); }
        if(i == 'op41'){ $("#p41o1").closest('.form-group').addClass('has-error'); }
        if(i == 'op472'){ $("#p472o1").closest('.form-group').addClass('has-error'); }
        if(i == 'op522'){ $("#p522o1").closest('.form-group').addClass('has-error'); }
        if(i == 'op53'){ $("#p53o1").closest('.form-group').addClass('has-error'); }
        if(i == 'op54'){ $("#p54o1").closest('.form-group').addClass('has-error'); }

      });

       if(/*idiomas.length == 0 || */quien.length == 0 || riesgo.length == 0){
      /*  if(idiomas.length == 0){
            $("input[name=Idioma]").closest('.form-group').addClass('has-error');
            $("input[name=Habla]").closest('.form-group').addClass('has-error');
            $("input[name=Lee]").closest('.form-group').addClass('has-error');
            $("input[name=Escribe]").closest('.form-group').addClass('has-error');
          }*/
        if(quien.length == 0){
          $("input[name=Quien29]").closest('.form-group').addClass('has-error');
          $("input[name=Razon29]").closest('.form-group').addClass('has-error');          
        }
        if(riesgo.length == 0){
          $("input[name=Factor]").closest('.form-group').addClass('has-error');
          $("input[name=Objetivo]").closest('.form-group').addClass('has-error');
          $("input[name=Intervencion]").closest('.form-group').addClass('has-error');
          $("input[name=Fecha_Inicio]").closest('.form-group').addClass('has-error');
          $("input[name=Fecha_Fin]").closest('.form-group').addClass('has-error');
          $("input[name=Responsable]").closest('.form-group').addClass('has-error');
          $("input[name=Autorizada]").closest('.form-group').addClass('has-error');
          $("input[name=Seguimiento]").closest('.form-group').addClass('has-error');
        }
        return false;
      }
  }

	function Checkeds(nombre, otro){
		var valor = $("#"+nombre).is(":checked");
		if(valor == true){ $("#"+otro).show('slow'); }else{ $("#"+otro).hide('slow');}
	}

	function CheckedSi(nombre, otro){
		var valor = $('input[name="'+nombre+'"]:checked').val();
		if(valor == 'Si'){$("#"+otro).show('slow'); }else if(valor == 'No'){ $("#"+otro).hide('slow'); }
	}

	function CheckedNo(nombre, otro){
		var valor = $('input[name="'+nombre+'"]:checked').val();
		if(valor == 'No'){$("#"+otro).show('slow'); }else if(valor == 'Si'){ $("#"+otro).hide('slow'); }
	}

	$( "#p4o10" ).on( "click",function(){Checkeds('p4o10', 'porqueOP4');});
  $( "#p26o8" ).on( "click",function(){Checkeds('p26o8', 'porqueOP26');});
  $( "#p34o7" ).on( "click",function(){Checkeds('p34o7', 'porqueOP34');});
	//$('input[name="op26"]').change(function(){  Checkeds('p26o8','porqueOP26' ); });
	$( "#p41o11" ).on( "click",function(){Checkeds('p41o11', 'porqueOP41');});
	$( "#p472o5" ).on( "click",function(){Checkeds('p472o5', 'porqueOP472');});
	$( "#p522o4" ).on( "click",function(){Checkeds('p522o4', 'porqueOP522');});

	$('input[name="op14"]').change(function(){ CheckedSi('op14', 'porqueOP14');});
	$('input[name="op32"]').change(function(){ CheckedSi('op32', 'porqueOP32');});
	$('input[name="op33"]').change(function(){ CheckedSi('op33', 'porqueOP33');});
	$('input[name="op47"]').change(function(){ CheckedSi('op47', 'porqueOP47');});
	$('input[name="op52"]').change(function(){ CheckedSi('op52', 'porqueOP52');});

	$('input[name="op19"]').change(function(){  CheckedSi('op19', 'porqueOP19');  CheckedNo('op19', 'porqueOP14N'); });
	$('input[name="op10"]').change(function(){  CheckedSi('op10', 'porqueOP10');  CheckedNo('op10', 'porqueOP10N');	});

	$('#DesplazamientoPreg').change(function(){ 
		if($("#DesplazamientoPreg").val() == 1){
			$("#DesplazamientoD").show('slow');
		}else{
			$("#DesplazamientoD").hide('slow');
		}
	});

  $("#Add_Idioma").on('click', function(){
    $("#Idioma").css({ 'border-color': '#CCCCCC' });    
    $("#Habla").css({ 'border-color': '#CCCCCC' });    
    $("#Lee").css({ 'border-color': '#CCCCCC' });    
    $("#Escribe").css({ 'border-color': '#CCCCCC' });    

    Idioma = $("#Idioma").val();
    Habla = $("#Habla").val();
    Lee = $("#Lee").val();
    Escribe = $("#Escribe").val();

    if(Idioma == '' || Habla == '' || Lee == '' || Escribe == ''){
      if(Idioma == ''){ $("#Idioma").css({ 'border-color': '#B94A48' });}
      if(Habla == ''){ $("#Habla").css({ 'border-color': '#B94A48' });}
      if(Lee == ''){ $("#Lee").css({ 'border-color': '#B94A48' });}
      if(Escribe == ''){ $("#Escribe").css({ 'border-color': '#B94A48' });}
      return false;
    }
    idiomas.push({ "Idioma": Idioma, "Habla": Habla, "Lee": Lee, "Escribe": Escribe, });
    $('#alert_idioma').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>Idioma agregado con éxito!</div>');
    $('#mensaje_idioma').show(60);
    $('#mensaje_idioma').delay(1000).hide(400);     
    $("#Idioma").val('');
    $("#Habla").val('');
    $("#Lee").val('');
    $("#Escribe").val('');   

    $("#IdiomasT").empty();
    tabla = '<table class="table table-bordered" style="background-color:#E8F8FC; border-color:#CEECF5;">'+
                '<th>Idioma</th>'+
                '<th>Habla</th>'+
                '<th>Lee</th>'+
                '<th>Escribe</th>';

    $.each(idiomas, function(i, e){
      var habla, lee, escribe;
      if(e.Habla == 1){habla = 'Muy Bien(MB)'};if(e.Habla == 2){habla = 'Bien(B)'};if(e.Habla == 3){habla = 'Regular(R)'};
      if(e.Lee == 1){lee = 'Muy Bien(MB)'};if(e.Lee == 2){lee = 'Bien(B)'};if(e.Lee == 3){lee = 'Regular(R)'};
      if(e.Escribe == 1){escribe = 'Muy Bien(MB)'};if(e.Escribe == 2){escribe = 'Bien(B)'};if(e.Escribe == 3){escribe = 'Regular(R)'};
      tabla += '<tr>'+
                  '<td>'+e.Idioma+'</td>'+
                  '<td>'+habla+'</td>'+
                  '<td>'+lee+'</td>'+
                  '<td>'+escribe+'</td>'+
                '</tr>';                

    });
    tabla += '</table>';
    $("#IdiomasT").append(tabla);
  });

 $("#Add_Quien").on('click', function(){
    $("#Quien29").css({ 'border-color': '#CCCCCC' });    
    $("#Razon29").css({ 'border-color': '#CCCCCC' });    

    Quien29 = $("#Quien29").val();
    Razon29 = $("#Razon29").val();

    if(Quien29 == '' || Razon29 == ''){
      if(Quien29 == ''){ $("#Quien29").css({ 'border-color': '#B94A48' });}
      if(Razon29 == ''){ $("#Razon29").css({ 'border-color': '#B94A48' });}
      return false;
    }
    quien.push({ "Quien29": Quien29, "Razon29": Razon29, });
    $('#alert_quien').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>Apoyo de persona agregado con éxito!</div>');
    $('#mensaje_quien').show(60);
    $('#mensaje_quien').delay(1000).hide(400);     
    $("#Quien29").val('');
    $("#Razon29").val('');   

    $("#QuienT").empty();
    tabla = '<table class="table table-bordered" style="background-color:#E8F8FC; border-color:#CEECF5;">'+
                '<th>DE QUIENES?</th>'+
                '<th>EXPLICACIÓN</th>';

    $.each(quien, function(i, e){
      tabla += '<tr>'+
                  '<td>'+e.Quien29+'</td>'+
                  '<td>'+e.Razon29+'</td>'+
                '</tr>';                

    });
    tabla += '</table>';
    $("#QuienT").append(tabla);
  });

/******************************************/
 $("#Add_Riesgo").on('click', function(){
    $("input[name=Factor]").css({ 'border-color': '#CCCCCC' });
    $("input[name=Objetivo]").css({ 'border-color': '#CCCCCC' });
    $("input[name=Intervencion]").css({ 'border-color': '#CCCCCC' });
    $("input[name=Fecha_Inicio]").css({ 'border-color': '#CCCCCC' });
    $("input[name=Fecha_Fin]").css({ 'border-color': '#CCCCCC' });
    $("input[name=Responsable]").css({ 'border-color': '#CCCCCC' });
    $("input[name=Autorizada]").css({ 'border-color': '#CCCCCC' });
    $("input[name=Seguimiento]").css({ 'border-color': '#CCCCCC' });
    $("textarea[name=Observacion]").css({ 'border-color': '#CCCCCC' });

    Factor = $("input[name=Factor]").val();
    Objetivo = $("input[name=Objetivo]").val();
    Intervencion = $("input[name=Intervencion]").val();
    Fecha_Inicio = $("input[name=Fecha_Inicio]").val();
    Fecha_Fin = $("input[name=Fecha_Fin]").val();
    Responsable = $("input[name=Responsable]").val();
    Autorizada = $("input[name=Autorizada]").val();
    Seguimiento = $("input[name=Seguimiento]").val();
    Observacion = $("textarea[name=Observacion]").val();

    if(Factor == '' || Objetivo == '' || Intervencion == '' || Fecha_Inicio == '' || Fecha_Fin == '' || Responsable == '' || Autorizada == '' || Seguimiento == '' || Observacion == ''){
      if(Factor == ''){ $("#Factor").css({ 'border-color': '#B94A48' });}
      if(Objetivo == ''){ $("#Objetivo").css({ 'border-color': '#B94A48' });}
      if(Intervencion == ''){ $("#Intervencion").css({ 'border-color': '#B94A48' });}
      if(Fecha_Inicio == ''){ $("#Fecha_Inicio").css({ 'border-color': '#B94A48' });}
      if(Fecha_Fin == ''){ $("#Fecha_Fin").css({ 'border-color': '#B94A48' });}
      if(Responsable == ''){ $("#Responsable").css({ 'border-color': '#B94A48' });}
      if(Autorizada == ''){ $("#Autorizada").css({ 'border-color': '#B94A48' });}
      if(Seguimiento == ''){ $("#Seguimiento").css({ 'border-color': '#B94A48' });}
      if(Observacion == ''){ $("textarea[name=Observacion]").css({ 'border-color': '#B94A48' });}
      return false;
    }
    riesgo.push({ "Factor": Factor, "Objetivo": Objetivo, "Intervencion": Intervencion, "Fecha_Inicio": Fecha_Inicio, 
                 "Fecha_Fin": Fecha_Fin, "Responsable": Responsable,  "Autorizada": Autorizada,  "Seguimiento": Seguimiento, "Observacion": Observacion});

    $('#alert_riesgo').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>Riesgo agregado con éxito!</div>');
    $('#mensaje_riesgo').show(60);
    $('#mensaje_riesgo').delay(1000).hide(400);     
    $("input[name=Factor]").val('');
    $("input[name=Objetivo]").val('');
    $("input[name=Intervencion]").val('');
    $("input[name=Fecha_Inicio]").val('');
    $("input[name=Fecha_Fin]").val('');
    $("input[name=Responsable]").val('');
    $("input[name=Autorizada]").val('');
    $("input[name=Seguimiento]").val('');
    $("textarea[name=Observacion]").val('');

    $("#RiesgoT").empty();
    tabla = '<table class="table table-bordered" style="background-color:#E8F8FC; border-color:#CEECF5;">'+
                '<th>Factor de riesgo <br>psicosocial</th>'+
                '<th>Objetivo</th>'+
                '<th>Intervención</th>'+
                '<th>Fecha <br>inicio</th>'+
                '<th>Fecha<br>terminación</th>'+
                '<th>Responsable <br>intervención</th>'+
                '<th>Autorizada por</th>'+
                '<th>Seguimiento</th>'+
                '<th>Observaciones</th>';

    $.each(riesgo, function(i, e){      
      tabla += '<tr>'+
                  '<td>'+e.Factor+'</td>'+
                  '<td>'+e.Objetivo+'</td>'+                  
                  '<td>'+e.Intervencion+'</td>'+
                  '<td>'+e.Fecha_Inicio+'</td>'+
                  '<td>'+e.Fecha_Fin+'</td>'+
                  '<td>'+e.Responsable+'</td>'+                  
                  '<td>'+e.Autorizada+'</td>'+
                  '<td>'+e.Seguimiento+'</td>'+
                  '<td>'+e.Observacion+'</td>'+
                '</tr>';                

    });
    tabla += '</table>';
    $("#RiesgoT").append(tabla);
  });

/*****************************************/

 $("#LibretaPreg").on('change', function(){
    if($("#LibretaPreg").val() == 2){
      if($("#Genero").val() == 2){
        $("#LibretaPorqueD").hide();
      }else{
        $("#LibretaPorqueD").show();  
      }
      
    }else{
      $("#LibretaPorqueD").hide();
    }
 });

	
});

function VerPersona(id_persona){

  $("#loading").show('slow');
  $("#tablaPersonas").hide('slow');   
  $("#camposRegistro").hide("slow");

  $.get('buscarPersona/'+id_persona,{}, function(Persona){  
    $.each(Persona.tipo, function(i, e){
      if(e.Id_Tipo == 59){
        $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
              $('#buscar span').empty();
              document.getElementById("buscar").disabled = false;
              $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">Esta persona ya se encuentra registrada como un entrenador, por favor verifique la información!</h4></dvi><br>');
              $('#paginador').fadeOut();
              $("#camposRegistro").hide("slow");
              $("#loading").hide('slow');           
              return false;
      }else{
        if(Persona.deportista){  //Cuando Hay deportista    
          console.log('Hay deportistas');
          Deportista(Persona.deportista, Persona);
          if(((Persona.deportista.deportista_valoracion).length) != 0 ){//Existe valoración
            Valoracion(Persona.deportista.deportista_valoracion[0]);
            $("#camposRegistro").show('slow');
            $("#Registrar").hide('slow');
            $("#Modificar").show('slow');
            VerCampos();
          }else{
            $("#camposRegistro").show('slow');
            $("#Registrar").show('slow'); 
            $("#Modificar").hide('slow');    
            OcultarCampos(); 
          }
        }
        $("#camposRegistro").show("slow");
        $("#loading").hide('slow');           
      }
    });
    /*$.each(data, function(i, e){
          $.get("deportista/" + e['Id_Persona'] + "", function (responseDep) { 

            if(responseDep.deportista){//Existe Deportista
              Deportista(responseDep.deportista, data[0])

              if(((responseDep.deportista.deportista_valoracion).length) != 0 ){//Existe valoración

                Valoracion(responseDep.deportista.deportista_valoracion[0]);
                $("#camposRegistro").show('slow');
                $("#Registrar").hide('slow');
                $("#Modificar").show('slow');
                VerCampos();
                
              }else{        
                $("#camposRegistro").show('slow');
                $("#Registrar").show('slow'); 
                $("#Modificar").hide('slow');    
                OcultarCampos();                  
              }
            }else{
              $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
              $('#buscar span').empty();
              document.getElementById("buscar").disabled = false;
              $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">Esta persona aún no se encuentra registrada como deportista, registrela en el RUD, para continuar con el procedimiento.</h4></dvi><br>');
              $('#paginador').fadeOut();
            }
          });
        });*/
/*    $("#persona").val(Persona['Id_Persona']);         
      $("#Nombres").val(Persona['Primer_Nombre']+' '+Persona['Segundo_Nombre']);          
    $("#Apellidos").val(Persona['Primer_Apellido']+' '+Persona['Segundo_Apellido']);

    $("#NombresCompromiso").empty();
    $("#NombresCompromiso").append(Persona['Primer_Nombre']+' '+Persona['Segundo_Nombre'] +' '+Persona['Primer_Apellido']+' '+Persona['Segundo_Apellido']);
    $("#TipoDocumento").val(Persona.tipo_documento['Descripcion_TipoDocumento']);
    $("#NumeroDocumento").val(Persona['Cedula']);
    $("#fechaNac").val(Persona['Fecha_Nacimiento']);
    $("#PaisNac").val(Persona['Id_Pais']);
    $("#MunicipioNac").val(Persona['Nombre_Ciudad']);
    $("#Genero").val(Persona['Id_Genero']);

    $("#Nombres").attr("disabled", "disabled");
    $("#Apellidos").attr("disabled", "disabled");
    $("#TipoDocumento").attr("disabled", "disabled");
    $("#NumeroDocumento").attr("disabled", "disabled");
    $("#fechaNac").attr("disabled", "disabled");
    $("#PaisNac").attr("disabled", "disabled");
    $("#MunicipioNac").attr("disabled", "disabled");
    $("#Genero").attr("disabled", "disabled");

    ShowRopa(Persona['Id_Genero'], 1);
    ShowZapatos(Persona['Id_Genero'], 2);

    document.getElementById("RUD").style.display = "block";

    if(Persona.deportista){  //Cuando Hay deportista    
      $.get("getDeportistaDeporte/" + Persona.deportista['Id'] + "", function (DeportistaDeporte) {     
          agrupacionT = DeportistaDeporte['Agrupacion_Id'];
          deporteT = DeportistaDeporte['Deporte_Id'];
          modalidadT =DeportistaDeporte['Modalidad_Id'];

          $("#Club").val(DeportistaDeporte['Club_Id']);   
          $('#Club').selectpicker('refresh');                   
        }).done(function(){
          $("#ClasificacionDeportista").val(Persona.deportista['Clasificacion_Deportista_Id']).change();                      
        });

        if(Persona.deportista['Pertenece'] == 1){
          $.get("getEtapasD/" + Persona.deportista['Id'] + "", function (DeportistaEtapa) {         
          $("#EtapaNacionalT").val(DeportistaEtapa.Nacional.pivot['Etapa_Id']);
          $("#EtapaInternacionalT").val(DeportistaEtapa.Internacional.pivot['Etapa_Id']);
          $("#Smmlv").val(DeportistaEtapa.Internacional.pivot['Smmlv']);                
          });
        } 

      ShowRopa(Persona['Id_Genero'], 1, Persona.deportista['Sudadera_Talla_Id'], Persona.deportista['Camiseta_Talla_Id'], Persona.deportista['Pantaloneta_Talla_Id']);
      ShowZapatos(Persona['Id_Genero'], 2, Persona.deportista['Tenis_Talla_Id']);

      $("#Resolucion").prop('checked', true);
      $("#Deberes").prop('checked', true);
      
      if(Persona.deportista['Archivo1_Url'] != ''){
        $("#SImagen").empty();
        $("#SImagen").append("<img id='Fotografia' src='' alt='' class='img-thumbnail'>");
          $("#Fotografia").attr('src',$("#Fotografia").attr('src')+'public/Img/Fotografias/'+Persona.deportista['Archivo1_Url']+'?' + (new Date()).getTime());
      }else{
        $("#Fotografia").hide();
      }
      $("#Pertenece").val(Persona.deportista['Pertenece']).change();    
      $("#deportista").val(Persona.deportista['Id']);           
  
      $("#LugarExpedicion").val(Persona.deportista['Lugar_Expedicion_Id']);
      $("#FechaExpedicion").val(Persona.deportista['Fecha_Expedicion']);
      $("#Pasaporte").val(Persona.deportista['Numero_Pasaporte']);
      $("#FechaVigenciaPasaporte").val(Persona.deportista['Fecha_Pasaporte']);
      $("#EstadoCivil").val(Persona.deportista['Estado_Civil_Id']);
      $("#Estrato").val(Persona.deportista['Estrato_Id']);
      $("#DepartamentoNac").val(Persona.deportista['Departamento_Id_Nac']);
      $("#LibretaPreg").val(Persona.deportista['Libreta_Preg']).change();
      $("#Libreta").val(Persona.deportista['Numero_Libreta_Mil']);
      $("#Distrito").val(Persona.deportista['Distrito_Libreta_Mil']);
      $("#NombreContacto").val(Persona.deportista['Nombre_Contacto']);
      $("#Parentesco").val(Persona.deportista['Parentesco_Id']);
      $("#FijoContacto").val(Persona.deportista['Fijo_Contacto']);
      $("#CelularContacto").val(Persona.deportista['Celular_Contacto']);
      $("#TipoCuenta").val(Persona.deportista['Tipo_Cuenta_Id']);
      $("#Banco").val(Persona.deportista['Banco_Id']);
      $("#NumeroCuenta").val(Persona.deportista['Numero_Cuenta']);
      $("#NumeroHijos").val(Persona.deportista['Numero_Hijos']);
      $("#DepartamentoLoc").val(Persona.deportista['Departamento_Id_Localiza']);
      $("#MunicipioLoc").val(Persona.deportista['Ciudad_Id_Localiza']);
      $("#Direccion").val(Persona.deportista['Direccion_Localiza']);
      $("#Barrio").val(Persona.deportista['Barrio_Localiza']);
      $("#Localidad").val(Persona.deportista['Localidad_Id_Localiza']);
      $("#FijoLoc").val(Persona.deportista['Fijo_Localiza']);
      $("#CelularLoc").val(Persona.deportista['Celular_Localiza']);
      $("#Correo").val(Persona.deportista['Correo_Electronico']);
      $("#Regimen").val(Persona.deportista['Regimen_Salud_Id']).change();
      $("#FechaAfiliacion").val(Persona.deportista['Fecha_Afiliacion']);
      $("#TipoAfiliacion").val(Persona.deportista['Tipo_Afiliacion_Id']);
      $("#MedicinaPrepago").val(Persona.deportista['Medicina_Prepago']).change();
      $("#NombreMedicinaPrepago").val(Persona.deportista['Nombre_MedicinaPrepago']);
      $("#Eps").val(Persona.deportista['Eps_Id']);
      $("#NivelRegimen").val(Persona.deportista['Nivel_Regimen_Sub_Id']);
      $("#RiesgosLaborales").val(Persona.deportista['Riesgo_Laboral']);
      $("#Arl").val(Persona.deportista['Arl_Id']);
      $("#FondoPensionPreg").val(Persona.deportista['Fondo_PensionPreg_Id']).change();
      $("#FondoPension").val(Persona.deportista['Fondo_Pension_Id']);
      
      $("#GrupoSanguineo").val(Persona.deportista['Grupo_Sanguineo_Id']);
      $("#Medicamento").val(Persona.deportista['Uso_Medicamento']).change();
      $("#CualMedicamento").val(Persona.deportista['Medicamento']);
      $("#TiempoMedicamento").val(Persona.deportista['Tiempo_Medicamento']);    
      $("#OtroMedicoPreg").val(Persona.deportista['Otro_Medico_Preg']).change();
      $("#OtroMedico").val(Persona.deportista['Otro_Medico']);


      if(Persona.deportista.deportista_paralimpico[0] != null){
        $("#SeccionSeisD").show('slow');
        $("#Discapacidad").val(Persona.deportista.deportista_paralimpico[0]['Discapacidad_Id']).change();
        $("#Diagnostico").val(Persona.deportista.deportista_paralimpico[0]['Diagnostico_Id']).change();
        //$("#ClasificacionFuncional").val(Persona.deportista.deportista_paralimpico[0]['Clasificacion_Funcional_Id']).change();
        clasificacionT =Persona.deportista.deportista_paralimpico[0]['Clasificacion_Funcional_Id'];
        $("#Silla").val(Persona.deportista.deportista_paralimpico[0]['Silla_Id']).change();
        $("#Cuidador").val(Persona.deportista.deportista_paralimpico[0]['Uso_Silla_Id']).change();
        $("#Auxiliar").val(Persona.deportista.deportista_paralimpico[0]['Auxiliar_Id']).change();
        $("#ClasificadoNivelInternacional").val(Persona.deportista.deportista_paralimpico[0]['Clasificacion_Funcional_Internacional_Id']).change();
        $("#DiagnosticoEdad").val(Persona.deportista.deportista_paralimpico[0]['EdadAdquirido']);
        $("#FechaCI").val(Persona.deportista.deportista_paralimpico[0]['Fecha_Clasificacion']);
        $("#EventoCI").val(Persona.deportista.deportista_paralimpico[0]['Evento_Clasificacion']);
        $("#EdadDeportiva").val(Persona.deportista.deportista_paralimpico[0]['EdadDeportiva']).change();
        $("#resultadoNacional").val(Persona.deportista.deportista_paralimpico[0]['Resultado_Nacional']).change();
        $("#resultadoInternacional").val(Persona.deportista.deportista_paralimpico[0]['Resultado_Internacional']).change();
      }else{
        $("#SeccionSeisD").hide('slow');
      }
      
      $("#seccion_uno").show("slow");
      $("#seccion_dos").show("slow");
      $("#seccion_tres").show("slow");
      $("#seccion_cuatro").show("slow");
      $("#seccion_cinco").show("slow");
      $("#seccion_compromiso").show("slow");

      $("#Modificar").show();
        $("#Registrar").hide();

    }else{                    
        $("#Fotografia").hide();
        $("#Modificar").hide();
        $("#Registrar").show();
        agrupacionT = '';
        deporteT = '';
        modalidadT = '';        
      }*/
  });
}

function Buscar(e){	
  var key = $('input[name="buscador"]').val(); 
    $.get('personaBuscarDeportista/'+key,{}, function(data){
      if(data.length == 0){
        $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
            $('#buscar span').empty();
            document.getElementById("buscar").disabled = false;
            $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">No se encuentra ninguna persona registrada con estos datos.</h4></dvi><br>');
            $('#paginador').fadeOut();

      }else if(data.length == 1){
        VerPersona(data[0].Id_Persona);
      }else if(data.length > 1){
        $("#tablaPersonas").empty();
        var html = '';
        html += '<table id="tablaPersonasDatos" class="display nowrap" cellspacing="0" width="100%" style="text-transform: uppercase;">';
        html += '<thead>';
        html += '<th>Nombres</th>';
        html += '<th>Opciones</th>';
        html += '</thead>';
        html += '<tbody>';
        $.each(data, function(i, e){
          html += '<tr>';
          html += '<td>'+e.Primer_Nombre+' '+e.Segundo_Nombre+' '+e.Primer_Apellido+' '+e.Segundo_Apellido+'</td>';
          html += "<td><button type='button' class='btn btn-info' data-function='VerPersona' value='"+e.Id_Persona+"'>"+
                             "<span class='glyphicon glyphicon-zoom-in' aria-hidden='true'></span> Ver"+
                            "</button></td>";
          html += '</tr>';
        });
        html += '</tbody>';
        html += '</table>';
        $("#tablaPersonas").append(html);
        $('#tablaPersonasDatos').DataTable({
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
    }
  }).done(function(){
    $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
        $('#buscar span').empty();
      document.getElementById("buscar").disabled = false;     
  });
	/*var key = $('input[name="buscador"]').val(); 
  $.get('personaBuscarDeportista/'+key,{}, function(data){  
      if(data.length > 0){ //Existe la persona       	        
      	$.each(data, function(i, e){
        	$.get("deportista/" + e['Id_Persona'] + "", function (responseDep) { 

            if(responseDep.deportista){//Existe Deportista
              Deportista(responseDep.deportista, data[0])

              if(((responseDep.deportista.deportista_valoracion).length) != 0 ){//Existe valoración

                Valoracion(responseDep.deportista.deportista_valoracion[0]);
                $("#camposRegistro").show('slow');
                $("#Registrar").hide('slow');
                $("#Modificar").show('slow');
                VerCampos();
                
              }else{        
                $("#camposRegistro").show('slow');
                $("#Registrar").show('slow'); 
                $("#Modificar").hide('slow');    
                OcultarCampos();                  
              }
            }else{
              $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
              $('#buscar span').empty();
              document.getElementById("buscar").disabled = false;
              $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">Esta persona aún no se encuentra registrada como deportista, registrela en el RUD, para continuar con el procedimiento.</h4></dvi><br>');
              $('#paginador').fadeOut();
            }
          });
        });
      }else{
        $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
        $('#buscar span').empty();
        document.getElementById("buscar").disabled = false;
        $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">No se encuentra ninguna persona registrada con estos datos</h4></dvi><br>');
        $('#paginador').fadeOut();
      }
    }).done(function(){
      setTimeout(function(){ 
        $('#buscar span').removeClass('glyphicon-refresh glyphicon-refresh-animate').addClass('glyphicon-remove');
        $('#buscar span').empty();
        document.getElementById("buscar").disabled = false;   
      }, 1500);      
    });  */         	
}

function Reset_campos(e){
  $("#RiesgoT").empty();
  $("#IdiomasT").empty();
  $("#QuienT").empty();
  idiomas = new Array();
  quien = new Array();
  riesgo = new Array();
	$('#personas').html( '');
	$("#camposRegistro").hide('slow');
	$('#registro .form-group').removeClass('has-error');

	/************************/
	$("#persona").val('');        	
  $("#deportista").val('');          
  $("#valoracion").val('');          
	$("#Nombres").val('');        	
	$("#Apellidos").val('');
	$("#TipoDocumento").val('');
	$("#NumeroDocumento").val('');
	$("#fechaNac").val('');
	$("#Etnia").val('');
	$("#MunicipioNac").val('');
	$("#Genero").val('');
	$("#GrupoSanguineo").val('');
	$("#Prepagada").val('');
	$("#Eps").val();
	$("#MunicipioLoc").val('');
	$("#Direccion").val('');
	$("#Estrato").val('');
	$("#FijoLoc").val('');
	$("#CelularLoc").val('');
	$("#Correo").val('');
	$("#Pasaporte").val('');						
	$("#FechaVigenciaPasaporte").val('');
	$("#LibretaPreg").val('');
  $("#lp").val('');
  $("#Club").val('');
  $('#Club').selectpicker('refresh');
  $("#Deporte").val('');
  $("#Modalidad").val('');


	   $("#deportista").val(''); 
    $('#Discapacidad').val('');
    $("#EdadPreg").val()
    $("#PracticaPreg").val('');
    $("#DesplazamientoPreg").val('');
    $("#EdadPreg").val('');
    $('input[name="op1"]').prop('checked', false);
    $('input[name="op2"]').prop('checked', false);
    $('input[name="op3"]').prop('checked', false);
    $('#psico').find(':checkbox[name^="op4"]').prop("checked", false).change();
    $('input[name="op5"]').prop('checked', false);
    $('input[name="op6"]').prop('checked', false);
    $('#psico').find(':checkbox[name^="op7"]').prop("checked", false).change();
    $('input[name="op8"]').prop('checked', false);
    $('input[name="op81"]').val('');
    $('input[name="op82"]').val('');
    $('input[name="op9"]').prop('checked', false);
    $('input[name="op10"]').prop('checked', false);
    $('input[name="op11"]').prop('checked', false);
    $('input[name="op111"]').val('');
    $('input[name="op112"]').val('');
    $('input[name="op113"]').val('');
    $('input[name="op114"]').val('');
    $('input[name="op12"]').prop('checked', false);
    $('input[name="otro12"]').val('');
    $('input[name="op14"]').prop('checked', false);
    $('input[name="otro14"]').val('');
    $('input[name="op13"]').prop('checked', false);
    $('textarea[name="op15"]').val('');
    $('textarea[name="op16"]').val('');
    $('textarea[name="op17"]').val('');
    $('input[name="op19"]').prop('checked', false);
    $('input[name="op191"]').prop('checked', false);
    $('input[name="op192"]').prop('checked', false);
    $('input[name="op193"]').prop('checked', false);
    $('input[name="op194"]').prop('checked', false);
    $('input[name="op195"]').prop('checked', false);
    $('input[name="op196"]').prop('checked', false);
    $('input[name="op20"]').prop('checked', false);
    $('input[name="op21"]').prop('checked', false);
    $('textarea[name="op22"]').val('');
    $('textarea[name="op23"]').val('');
    $('input[name="op24"]').prop('checked', false);
    $('input[name="op25"]').prop('checked', false);
    /*$('input[name="op26"]').prop('checked', false);
    $('input[name="otro26"]').val('');*/
    $('#psico').find(':checkbox[name^="op26"]').prop("checked", false).change();
    $('#psico').find(':checkbox[name^="op34"]').prop("checked", false).change();
    $('input[name="op27"]').prop('checked', false);

    $('input[name="op281"]').prop('checked', false);
    $('input[name="op282"]').prop('checked', false);
    $('input[name="op283"]').prop('checked', false);
    $('input[name="op284"]').prop('checked', false);
    $('input[name="op285"]').prop('checked', false);
    $('input[name="op286"]').prop('checked', false);
    $('input[name="op287"]').prop('checked', false);
    $('input[name="op288"]').prop('checked', false);

    $('textarea[name="otro281"]').val('');
    $('textarea[name="otro282"]').val('');
    $('textarea[name="otro283"]').val('');
    $('textarea[name="otro284"]').val('');
    $('textarea[name="otro285"]').val('');
    $('textarea[name="otro286"]').val('');
    $('textarea[name="otro287"]').val('');
    $('textarea[name="otro288"]').val('');


    $('input[name="op29"]').prop('checked', false);
    $('input[name="op30"]').prop('checked', false);
    $('textarea[name="otro30"]').val('');

    $('input[name="op311a"]').val('');
    $('input[name="op312a"]').val('');
    $('input[name="op313a"]').val('');
    $('input[name="op314a"]').val('');
    $('input[name="op315a"]').val('');
    $('input[name="op316a"]').val('');
    $('input[name="op317a"]').val('');
    $('input[name="op311b"]').val('');
    $('input[name="op312b"]').val('');
    $('input[name="op313b"]').val('');
    $('input[name="op314b"]').val('');
    $('input[name="op315b"]').val('');
    $('input[name="op316b"]').val('');
    $('input[name="op317b"]').val('');


    $('input[name="op32"]').prop('checked', false);
    $('input[name="otro32"]').val('');
    $('input[name="op33"]').prop('checked', false);
    $('input[name="otro33"]').val('');
    $('input[name="op34"]').prop('checked', false);
    $('input[name="op35"]').prop('checked', false);
    $('input[name="op36"]').prop('checked', false);
    $('textarea[name="otro36"]').val('');
    $('input[name="op37"]').prop('checked', false);
    $('textarea[name="otro37"]').val('');
    $('input[name="op38"]').prop('checked', false);
    $('textarea[name="otro38"]').val('');
    $('input[name="op39"]').prop('checked', false);
    $('textarea[name="otro39"]').val('');
    $('input[name="op40"]').prop('checked', false);
    $('#psico').find(':checkbox[name^="op41"]').prop("checked", false).change();
    $('textarea[name="op42"]').val('');
    $('textarea[name="op43"]').val('');
    $('textarea[name="op44"]').val('');
    $('input[name="op45"]').prop('checked', false);
    $('textarea[name="otro45"]').val('');
    $('input[name="op46"]').prop('checked', false);
    $('input[name="op47"]').prop('checked', false);
    $('#psico').find(':checkbox[name^="op472"]').prop("checked", false).change();
    $('input[name="op48"]').prop('checked', false);
    $('textarea[name="otro48"]').val('');
    $('input[name="op49"]').prop('checked', false);
    $('input[name="op50"]').prop('checked', false);
    $('textarea[name="otro50"]').val('');
    $('textarea[name="op51"]').val('');
    $('input[name="op52"]').prop('checked', false);
    $('textarea[name="ConceptoProfesional"]').val('');    
    $('#psico').find(':checkbox[name^="op522"]').prop("checked", false).change();

    $("#porqueOP4").hide(); 
    $("#porqueOP26").hide(); 
    $("#porqueOP34").hide(); 
    $("#porqueOP41").hide(); 
    $("#porqueOP472").hide(); 
    $("#porqueOP522").hide(); 
    $("#porqueOP14").hide(); 
    $("#porqueOP32").hide(); 
    $("#porqueOP33").hide(); 
    $("#porqueOP47").hide(); 
    $("#porqueOP52").hide(); 
    $("#porqueOP19").hide(); 
    $("#porqueOP14N").hide(); 
    $("#porqueOP10").hide(); 

    $("input[name=Factor]").val('');
    $("input[name=Objetivo]").val('');
    $("input[name=Intervencion]").val('');
    $("input[name=Fecha_Inicio]").val('');
    $("input[name=Fecha_Fin]").val('');
    $("input[name=Responsable]").val('');
    $("input[name=Autorizada]").val('');
    $("input[name=Seguimiento]").val('');
    $("textarea[name=Observacion]").val('');
    
	/************************/
}

function Deportista (Deportista, Persona){
  $("#persona").val(Persona['Id_Persona']);         
  $("#deportista").val(Deportista['Id']);         
  $("#Nombres").val(Persona['Primer_Nombre']+' '+Persona['Segundo_Nombre']);          
  $("#Apellidos").val(Persona['Primer_Apellido']+' '+Persona['Segundo_Apellido']);
  $("#TipoDocumento").val(Persona.tipo_documento['Descripcion_TipoDocumento']);
  $("#NumeroDocumento").val(Persona['Cedula']);
  $("#fechaNac").val(Persona['Fecha_Nacimiento']);
  $("#Etnia").val(Persona['Id_Etnia']);
  $("#MunicipioNac").val(Persona['Nombre_Ciudad']);
  $("#Genero").val(Persona['Id_Genero']);

  $("#Nombres").attr("disabled", "disabled");
  $("#Apellidos").attr("disabled", "disabled");
  $("#TipoDocumento").attr("disabled", "disabled");
  $("#NumeroDocumento").attr("disabled", "disabled");
  $("#fechaNac").attr("disabled", "disabled");
  $("#Etnia").attr("disabled", "disabled");
  $("#MunicipioNac").attr("disabled", "disabled");
  //$("#Genero").attr("disabled", "disabled");
  $("#GrupoSanguineo").val(Deportista['Grupo_Sanguineo_Id']);

  if(Deportista['Medicina_Prepago'] == 1){
    $("#Prepagada").val(Deportista['Nombre_MedicinaPrepago']);
    $("#Prepagada").show();
    $("#Eps").hide();
  }else{
    $("#Eps").val(Deportista['Eps_Id']);
    $("#Eps").show();
    $("#Prepagada").hide();
  }

  $("#MunicipioLoc").val(Deportista['Ciudad_Id_Localiza']);
  $("#Direccion").val(Deportista['Direccion_Localiza']);
  $("#Estrato").val(Deportista['Estrato_Id']);
  $("#FijoLoc").val(Deportista['Fijo_Localiza']);
  $("#CelularLoc").val(Deportista['Celular_Localiza']);
  $("#Correo").val(Deportista['Correo_Electronico']);
  $("#Pasaporte").val(Deportista['Numero_Pasaporte']);            
  $("#FechaVigenciaPasaporte").val(Deportista['Fecha_Pasaporte']);
  $("#LibretaPreg").val(Deportista['Libreta_Preg']).change();
  $("#lp").val(Deportista['Libreta_Preg']).change();

  $("#GrupoSanguineo").attr("disabled", "disabled");
  $("#Prepagada").attr("disabled", "disabled");
  $("#Eps").attr("disabled", "disabled");
  $("#MunicipioLoc").attr("disabled", "disabled");
  $("#Direccion").attr("disabled", "disabled");
  $("#Estrato").attr("disabled", "disabled");
  $("#FijoLoc").attr("disabled", "disabled");
  $("#CelularLoc").attr("disabled", "disabled");
  $("#Correo").attr("disabled", "disabled");
  $("#Pasaporte").attr("disabled", "disabled");
  $("#FechaVigenciaPasaporte").attr("disabled", "disabled");
 // $("#LibretaPreg").attr("disabled", "disabled");
  $("#Deporte").attr("disabled", "disabled");
  $("#Modalidad").attr("disabled", "disabled");
  //$("#Club").attr("disabled", "disabled");

  $.get("getDeportistaDeporte/" + Deportista['Id'] + "", function (DeportistaDeporte) {  
    $("#Deporte").val(DeportistaDeporte['Deporte_Id']);
    $("#Modalidad").val(DeportistaDeporte['Modalidad_Id']);
    $("#Club").val(DeportistaDeporte['Club_Id']);
    $('#Club').selectpicker('refresh');
  });
}

function Valoracion(Valoracion){  
  var initOP4 = new Array;
  var initOP26 = new Array;
  var initOP34 = new Array;
  var initOP7 = new Array;
  var initOP26 = new Array;
  var initOP41 = new Array;
  var initOP53 = new Array;
  var initOP54 = new Array;
  var initOP472 = new Array;
  var initOP522 = new Array;
  var valoInfo = Valoracion;
  $("#valoracion").val(valoInfo['Id']);          
  $('#Discapacidad').val(valoInfo['Discapacidad']); 
  $('#DesplazamientoPreg').val(valoInfo['DesplazamientoPreg']).change(); 
  $('#DesplazamientoDesc').val(valoInfo['Desplazamiento']); 
  $("#EdadPreg").val(valoInfo['EdadInicio']);
  $("#PracticaPreg").val(valoInfo['AniosPractica']);                       
  $('[name=op1][value="'+valoInfo['P1']+'"]').prop('checked',true).change();
  $('[name=op2][value="'+valoInfo['P2']+'"]').prop('checked',true).change();
  $('[name=op3][value="'+valoInfo['P3']+'"]').prop('checked',true).change();
  $('[name=op5][value="'+valoInfo['P5']+'"]').prop('checked',true).change();
  $("#op6").val(valoInfo['P6']);
  $('input[name="op8"][value="'+valoInfo['P8']+'"]').prop('checked',true).change();
  $('input[name="op81"]').val(valoInfo['P81']);
  $('input[name="op82"]').val(valoInfo['P82']);
  $('input[name="op9"][value="'+valoInfo['P9']+'"]').prop('checked',true).change();
  $('input[name="op10"][value="'+valoInfo['P10']+'"]').prop('checked',true).change();
  $('input[name="op11"][value="'+valoInfo['P11']+'"]').prop('checked',true).change();
  $('input[name="op111"]').val(valoInfo['P111']); 
  $('input[name="op112"]').val(valoInfo['P112']); 
  $('input[name="op113"]').val(valoInfo['P113']); 
  $('input[name="op114"]').val(valoInfo['P114']); 

  $('input[name="op13"][value="'+valoInfo['P13']+'"]').prop('checked',true).change();
  $('textarea[name="op15"]').val(valoInfo['P15']);
  $('textarea[name="op16"]').val(valoInfo['P16']);
  $('textarea[name="op17"]').val(valoInfo['P17']);

  $('input[name="op19"][value="'+valoInfo['P19']+'"]').prop('checked',true).change();
  $('input[name="op191"]').val(valoInfo['P191']); 
  $('input[name="op192"]').val(valoInfo['P192']); 
  $('input[name="op193"]').val(valoInfo['P193']); 
  $('input[name="op194"]').val(valoInfo['P194']); 
  $('input[name="op195"]').val(valoInfo['P195']); 
  $('input[name="op196"]').val(valoInfo['P196']); 

  $('input[name="op20"][value="'+valoInfo['P20']+'"]').prop('checked',true).change(); 
  $('input[name="op21"][value="'+valoInfo['P21']+'"]').prop('checked',true).change(); 
  $('textarea[name="op22"]').val(valoInfo['P22']); 
  $('textarea[name="op23"]').val(valoInfo['P23']); 
  $('input[name="op24"][value="'+valoInfo['P24']+'"]').prop('checked',true).change(); 
  $('input[name="op25"][value="'+valoInfo['P25']+'"]').prop('checked',true).change(); 
  $('input[name="op27"][value="'+valoInfo['P27']+'"]').prop('checked',true).change(); 
  $('input[name="op29"][value="'+valoInfo['P29']+'"]').prop('checked',true).change(); 
  $('input[name="op34"][value="'+valoInfo['P34']+'"]').prop('checked',true).change(); 
  $('input[name="op35"][value="'+valoInfo['P35']+'"]').prop('checked',true).change(); 
  $('input[name="op40"][value="'+valoInfo['P40']+'"]').prop('checked',true).change(); 
  $('textarea[name="op42"]').val(valoInfo['P42']); 
  $('textarea[name="op43"]').val(valoInfo['P43']); 
  $('textarea[name="op44"]').val(valoInfo['P44']); 
  $('input[name="op46"][value="'+valoInfo['P46']+'"]').prop('checked',true).change(); 
  $('input[name="op49"][value="'+valoInfo['P49']+'"]').prop('checked',true).change(); 
  $('textarea[name="op51"]').val(valoInfo['P51']); 
  $('textarea[name="ConceptoProfesional"]').val(valoInfo['ConceptoProfesional']); 

  /***********************PREGUNTA 4 ************************/  
  $.each(valoInfo.pregunta_a, function(i, e){
    if(e['PreguntaA_Id'] == 'P4'){
      initOP4.push(e['Respuesta']);
      if(e['Respuesta'] == 'Otros'){
        $('textarea[name="otro4"]').val(e['Descripcion']); 
        $("#porqueOP4").show('slow'); 
      }
    }
    if(e['PreguntaA_Id'] == 'P26'){
      initOP26.push(e['Respuesta']);
      if(e['Respuesta'] == 'Otros'){
        $('textarea[name="otro26"]').val(e['Descripcion']); 
        $("#porqueOP26").show('slow'); 
      }
    }

    if(e['PreguntaA_Id'] == 'P34'){
      initOP34.push(e['Respuesta']);
      if(e['Respuesta'] == 'Otros'){
        $('textarea[name="otro34"]').val(e['Descripcion']); 
        $("#porqueOP34").show('slow'); 
      }
    }

    if(e['PreguntaA_Id'] == 'P7'){
      initOP7.push(e['Respuesta']);                          
    }
   /* if(e['PreguntaA_Id'] == 'P26'){
      initOP26.push(e['Respuesta']);
      if(e['Respuesta'] == 'Otros'){
        $('textarea[name="otro26"]').val(e['Descripcion']); 
        $("#porqueOP26").show('slow'); 
      }
    }*/
    if(e['PreguntaA_Id'] == 'P41'){
      initOP41.push(e['Respuesta']);
      if(e['Respuesta'] == 'Otros'){
        $('textarea[name="otro41"]').val(e['Descripcion']); 
        $("#porqueOP41").show('slow'); 
      }
    }
    if(e['PreguntaA_Id'] == 'P53'){
      initOP53.push(e['Respuesta']);                          
    }
    if(e['PreguntaA_Id'] == 'P54'){
      initOP54.push(e['Respuesta']);                          
    }
    if(e['PreguntaA_Id'] == 'P12'){ $('input[name="op12"][value="'+e['Respuesta']+'"]').prop('checked',true).change();  $('textarea[name="otro12"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P14'){ $('input[name="op14"][value="'+e['Respuesta']+'"]').prop('checked',true).change();  $('textarea[name="otro14"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P30'){ $('input[name="op30"][value="'+e['Respuesta']+'"]').prop('checked',true).change();  $('textarea[name="otro30"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P32'){ $('input[name="op32"][value="'+e['Respuesta']+'"]').prop('checked',true).change();  $('textarea[name="otro32"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P33'){ $('input[name="op33"][value="'+e['Respuesta']+'"]').prop('checked',true).change();  $('textarea[name="otro33"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P36'){ $('input[name="op36"][value="'+e['Respuesta']+'"]').prop('checked',true).change();  $('textarea[name="otro36"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P37'){ $('input[name="op37"][value="'+e['Respuesta']+'"]').prop('checked',true).change();  $('textarea[name="otro37"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P38'){ $('input[name="op38"][value="'+e['Respuesta']+'"]').prop('checked',true).change();  $('textarea[name="otro38"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P39'){ $('input[name="op39"][value="'+e['Respuesta']+'"]').prop('checked',true).change();  $('textarea[name="otro39"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P45'){ $('input[name="op45"][value="'+e['Respuesta']+'"]').prop('checked',true).change();  $('textarea[name="otro45"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P48'){ $('input[name="op48"][value="'+e['Respuesta']+'"]').prop('checked',true).change();  $('textarea[name="otro48"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P50'){ $('input[name="op50"][value="'+e['Respuesta']+'"]').prop('checked',true).change();  $('textarea[name="otro50"]').val(e['Descripcion']); }

    if(e['PreguntaA_Id'] == 'P281'){ $('input[name="op281"][value="'+e['Respuesta']+'"]').prop('checked',true).change(); $('textarea[name="otro281"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P282'){ $('input[name="op282"][value="'+e['Respuesta']+'"]').prop('checked',true).change(); $('textarea[name="otro282"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P283'){ $('input[name="op283"][value="'+e['Respuesta']+'"]').prop('checked',true).change(); $('textarea[name="otro283"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P284'){ $('input[name="op284"][value="'+e['Respuesta']+'"]').prop('checked',true).change(); $('textarea[name="otro284"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P285'){ $('input[name="op285"][value="'+e['Respuesta']+'"]').prop('checked',true).change(); $('textarea[name="otro285"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P286'){ $('input[name="op286"][value="'+e['Respuesta']+'"]').prop('checked',true).change(); $('textarea[name="otro286"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P287'){ $('input[name="op287"][value="'+e['Respuesta']+'"]').prop('checked',true).change(); $('textarea[name="otro287"]').val(e['Descripcion']); }
    if(e['PreguntaA_Id'] == 'P288'){ $('input[name="op288"][value="'+e['Respuesta']+'"]').prop('checked',true).change(); $('textarea[name="otro288"]').val(e['Descripcion']); }

    if(e['PreguntaA_Id'] == 'P311'){ $('input[name="op311a"]').val(e['Descripcion']); $('#op311b').val(e['Respuesta']); }
    if(e['PreguntaA_Id'] == 'P312'){ $('input[name="op312a"]').val(e['Descripcion']); $('#op312b').val(e['Respuesta']); }
    if(e['PreguntaA_Id'] == 'P313'){ $('input[name="op313a"]').val(e['Descripcion']); $('#op313b').val(e['Respuesta']); }
    if(e['PreguntaA_Id'] == 'P314'){ $('input[name="op314a"]').val(e['Descripcion']); $('#op314b').val(e['Respuesta']); }
    if(e['PreguntaA_Id'] == 'P315'){ $('input[name="op315a"]').val(e['Descripcion']); $('#op315b').val(e['Respuesta']); }
    if(e['PreguntaA_Id'] == 'P316'){ $('input[name="op316a"]').val(e['Descripcion']); $('#op316b').val(e['Respuesta']); }
    if(e['PreguntaA_Id'] == 'P317'){ $('input[name="op317a"]').val(e['Descripcion']); $('#op317b').val(e['Respuesta']); }

    if(e['PreguntaA_Id'] == 'P47'){ $('input[name="op47"][value="'+e['Respuesta']+'"]').prop('checked',true).change();}

    if(e['PreguntaA_Id'] == 'P472'){ 
      initOP472.push(e['Respuesta']); 
      if(e['Respuesta'] == 'Otras'){
        $('textarea[name="otro472"]').val(e['Descripcion']); 
        $("#porqueOP472").show('slow'); 
      }
    }

    if(e['PreguntaA_Id'] == 'P52'){ $('input[name="op52"][value="'+e['Respuesta']+'"]').prop('checked',true).change();}
    if(e['PreguntaA_Id'] == 'P522'){ 
      initOP522.push(e['Respuesta']); 
      if(e['Respuesta'] == 'Otra'){
        $('textarea[name="otro522"]').val(e['Descripcion']); 
        $("#porqueOP522").show('slow'); 
      }
    }
  });

  $.each(initOP4, function (i, val) {
    $('#psico').find(':checkbox[name^="op4"][value="' + val + '"]').prop("checked", true).change();
  });
  $.each(initOP7, function (i, val) {
    $('#psico').find(':checkbox[name^="op7"][value="' + val + '"]').prop("checked", true).change();
  });
  $.each(initOP26, function (i, val) {
    $('#psico').find(':checkbox[name^="op26"][value="' + val + '"]').prop("checked", true).change();
  });

  $.each(initOP34, function (i, val) {
    $('#psico').find(':checkbox[name^="op34"][value="' + val + '"]').prop("checked", true).change();
  });

  $.each(initOP41, function (i, val) {
    $('#psico').find(':checkbox[name^="op41"][value="' + val + '"]').prop("checked", true).change();
  });
  $.each(initOP53, function (i, val) {
    $('#psico').find(':checkbox[name^="op53"][value="' + val + '"]').prop("checked", true).change();
  });
  $.each(initOP54, function (i, val) {
    $('#psico').find(':checkbox[name^="op54"][value="' + val + '"]').prop("checked", true).change();
  });                    
  $.each(initOP472, function (i, val) {
    $('#psico').find(':checkbox[name^="op472"][value="' + val + '"]').prop("checked", true).change();
  });   
  $.each(initOP522, function (i, val) {
    $('#psico').find(':checkbox[name^="op522"][value="' + val + '"]').prop("checked", true).change();
  });                    
  /**********************************************************/
  $("#IdiomasT").empty();
    var tabla = '<table class="table table-bordered" style="background-color:#E8F8FC; border-color:#CEECF5;">'+
                '<th>Idioma</th>'+
                '<th>Habla</th>'+
                '<th>Lee</th>'+
                '<th>Escribe</th>';
  $.each(valoInfo.idioma, function(i, e){
    if(e.Habla == 1){habla = 'Muy Bien(MB)'};if(e.Habla == 2){habla = 'Bien(B)'};if(e.Habla == 3){habla = 'Regular(R)'};
    if(e.Lee == 1){lee = 'Muy Bien(MB)'};if(e.Lee == 2){lee = 'Bien(B)'};if(e.Lee == 3){lee = 'Regular(R)'};
    if(e.Escribe == 1){escribe = 'Muy Bien(MB)'};if(e.Escribe == 2){escribe = 'Bien(B)'};if(e.Escribe == 3){escribe = 'Regular(R)'};
    tabla += '<tr>'+
                  '<td>'+e.Idioma+'</td>'+
                  '<td>'+habla+'</td>'+
                  '<td>'+lee+'</td>'+
                  '<td>'+escribe+'</td>'+
                '</tr>';
    idiomas.push({ "Idioma": e.Idioma, "Habla": e.Habla, "Lee": e.Lee, "Escribe": e.Escribe, });
  });
  tabla += '</table>';
  $("#IdiomasT").append(tabla);

  $("#QuienT").empty();
  tablaQ = '<table class="table table-bordered" style="background-color:#E8F8FC; border-color:#CEECF5;">'+
              '<th>DE QUIENES?</th>'+
              '<th>EXPLICACIÓN</th>';

  $.each(valoInfo.quien, function(i, e){
    tablaQ += '<tr>'+
                '<td>'+e.Quien+'</td>'+
                '<td>'+e.Razon+'</td>'+
              '</tr>';                
    quien.push({ "Quien29": e.Quien, "Razon29": e.Razon, });

  });
  tablaQ += '</table>';
  $("#QuienT").append(tablaQ);

   $("#RiesgoT").empty();
      tablaR = '<table class="table table-bordered" style="background-color:#E8F8FC; border-color:#CEECF5;">'+
              '<th>Factor de riesgo <br>psicosocial</th>'+
              '<th>Objetivo</th>'+
              '<th>Intervención</th>'+
              '<th>Fecha <br>inicio</th>'+
              '<th>Fecha<br>terminación</th>'+
              '<th>Responsable <br>intervención</th>'+
              '<th>Autorizada por</th>'+
              '<th>Seguimiento</th>'+
              '<th>Observaciones</th>';     

  $.each(valoInfo.valoracion_riesgo, function(i, e){      
    tablaR += '<tr>'+
                '<td>'+e.Factor+'</td>'+
                '<td>'+e.Objetivo+'</td>'+                  
                '<td>'+e.Intervencion+'</td>'+
                '<td>'+e.Fecha_Inicio+'</td>'+
                '<td>'+e.Fecha_Fin+'</td>'+
                '<td>'+e.Responsable+'</td>'+                  
                '<td>'+e.Autorizado+'</td>'+
                '<td>'+e.Seguimiento+'</td>'+
                '<td>'+e.Observacion+'</td>'+
              '</tr>';                
    riesgo.push({ "Factor": e.Factor, "Objetivo": e.Objetivo, "Intervencion": e.Intervencion, "Fecha_Inicio": e.Fecha_Inicio, 
       "Fecha_Fin": e.Fecha_Fin, "Responsable": e.Responsable,  "Autorizada": e.Autorizado,  "Seguimiento": e.Seguimiento, "Observacion": e.Observacion});

  });
  tablaR += '</table>';
  $("#RiesgoT").append(tablaR);

}

function VerCampos(){
  $("#seccion_uno").show("slow");
  $("#seccion_dos").show("slow");
  $("#seccion_tres").show("slow");
  $("#seccion_cuatro").show("slow");
  $("#seccion_cinco").show("slow");
  $("#seccion_seis").show("slow");
  $("#seccion_siete").show("slow");
  $("#seccion_ocho").show("slow");
  $("#seccion_nueve").show("slow");
  $("#seccion_diez").show("slow");
  $("#seccion_once").show("slow");
  $("#seccion_doce").show("slow");
  $("#seccion_trece").show("slow");
}

function OcultarCampos(){
  $("#seccion_uno").hide("slow");
  $("#seccion_dos").hide("slow");
  $("#seccion_tres").hide("slow");
  $("#seccion_cuatro").hide("slow");
  $("#seccion_cinco").hide("slow");
  $("#seccion_seis").hide("slow");
  $("#seccion_siete").hide("slow");
  $("#seccion_ocho").hide("slow");
  $("#seccion_nueve").hide("slow");
  $("#seccion_diez").hide("slow");
  $("#seccion_once").hide("slow");
  $("#seccion_doce").hide("slow");
  $("#seccion_trece").hide("slow");
}