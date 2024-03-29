$(function(e){ 	
  var idiomas = new Array();
  var quien = new Array();

	$("#Registrar").on('click', function(){		
		registro('AddValoracion');
	});   

	function registro (url){	
        var token = $("#token").val();
        var formData = new FormData($("#psico")[0]);
        var json_idiomas = JSON.stringify(idiomas);
        formData.append("vector_idiomas",json_idiomas);
        var json_quien = JSON.stringify(quien);
        formData.append("vector_quien",json_quien);
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
        if(i == 'op7'){ $("#p7o1").closest('.form-group').addClass('has-error'); }
        if(i == 'op41'){ $("#p41o1").closest('.form-group').addClass('has-error'); }
        if(i == 'op472'){ $("#p472o1").closest('.form-group').addClass('has-error'); }
        if(i == 'op522'){ $("#p522o1").closest('.form-group').addClass('has-error'); }
        if(i == 'op53'){ $("#p53o1").closest('.form-group').addClass('has-error'); }
        if(i == 'op54'){ $("#p54o1").closest('.form-group').addClass('has-error'); }

      });

       if(idiomas.length == 0 || quien.length == 0){
        if(idiomas.length == 0){
            $("input[name=Idioma]").closest('.form-group').addClass('has-error');
            $("input[name=Habla]").closest('.form-group').addClass('has-error');
            $("input[name=Lee]").closest('.form-group').addClass('has-error');
            $("input[name=Escribe]").closest('.form-group').addClass('has-error');
          }
        if(quien.length == 0){
          $("input[name=Quien29]").closest('.form-group').addClass('has-error');
          $("input[name=Razon29]").closest('.form-group').addClass('has-error');          
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
	$('input[name="op26"]').change(function(){  Checkeds('p26o8','porqueOP26' ); });
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
    tabla = '<table class="table table-bordered" style="background-color:#CEECF5; border-color:#FFF;">'+
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
    tabla = '<table class="table table-bordered" style="background-color:#CEECF5; border-color:#FFF;">'+
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

 $("#LibretaPreg").on('change', function(){
    if($("#LibretaPreg").val() == 2){
      $("#LibretaPorqueD").show();
    }else{
      $("#LibretaPorqueD").hide();
    }
 });

	
});

function Buscar(e){	
	var key = $('input[name="buscador"]').val(); 
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
                VerCampos();
                
              }else{        
                $("#camposRegistro").show('slow');
                $("#Registrar").show('slow');     
                OcultarCampos();                  
              }
            }else{
              $('#buscar span').removeClass('glyphicon-refresh').addClass('glyphicon-remove');
              $('#buscar span').empty();
              document.getElementById("buscar").disabled = false;
              $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">Esta persona aún no se encuentra registrada como deportista, registrela en el RUD, para continuar con el procedimiento.</h4></dvi><br>');
              $('#paginador').fadeOut();
            }
          });
        });
      }else{
        $('#buscar span').removeClass('glyphicon-refresh').addClass('glyphicon-remove');
        $('#buscar span').empty();
        document.getElementById("buscar").disabled = false;
        $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">No se encuentra ninguna persona registrada con estos datos</h4></dvi><br>');
        $('#paginador').fadeOut();
      }
    }).done(function(){
      setTimeout(function(){ 
        $('#buscar span').removeClass('glyphicon-refresh').addClass('glyphicon-remove');
        $('#buscar span').empty();
        document.getElementById("buscar").disabled = false;   
      }, 1500);      
    });           	
}

function Reset_campos(e){
	$('#personas').html( '');
	$("#camposRegistro").hide('slow');
	$('#registro .form-group').removeClass('has-error');

	/************************/
	$("#persona").val('');        	
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

	////////////////////

	$("#deportista").val(''); 
    $('#Discapacidad').val('');
    $("#EdadPreg").val()
    $("#PracticaPreg").val('');
    $('input[name="op1"]').val('');
    $('input[name="op2"]').val('');
    $('input[name="op3"]').val('');
    $('input[name="op5"]').val('');
    $('input[name="op6"]').val('');
    $('input[name="op8"]').val('');
    $('input[name="op81"]').val('');
    $('input[name="op82"]').val('');
    $('input[name="op9"]').val('');
    $('input[name="op10"]').val('');
    $('input[name="op11"]').val('');
    $('input[name="op111"]').val('');
    $('input[name="op112"]').val('');
    $('input[name="op113"]').val('');
    $('input[name="op114"]').val('');
    $('input[name="op12"]').val('');
    $('input[name="otro12"]').val('');
    $('input[name="op14"]').val('');
    $('input[name="otro14"]').val('');
    $('input[name="op13"]').val('');
    $('textarea[name="op15"]').val('');
    $('textarea[name="op16"]').val('');
    $('textarea[name="op17"]').val('');
    $('input[name="op19"]').val('');
    $('input[name="op191"]').val('');
    $('input[name="op192"]').val('');
    $('input[name="op193"]').val('');
    $('input[name="op194"]').val('');
    $('input[name="op195"]').val('');
    $('input[name="op196"]').val('');
    $('input[name="op20"]').val('');
    $('input[name="op21"]').val('');
    $('textarea[name="op22"]').val('');
    $('textarea[name="op23"]').val('');
    $('input[name="op24"]').val('');
    $('input[name="op25"]').val('');
    $('input[name="op26"]').val('');
    $('input[name="otro26"]').val('');
    $('input[name="op27"]').val('');
    $('input[name="op29"]').val('');
    $('input[name="op30"]').val('');
    $('input[name="otro30"]').val('');
    $('input[name="op32"]').val('');
    $('input[name="otro32"]').val('');
    $('input[name="op33"]').val('');
    $('input[name="otro33"]').val('');
    $('input[name="op34"]').val('');
    $('input[name="op35"]').val('');
    $('input[name="op36"]').val('');
    $('input[name="otro36"]').val('');
    $('input[name="op37"]').val('');
    $('input[name="otro37"]').val('');
    $('input[name="op38"]').val('');
    $('input[name="otro38"]').val('');
    $('input[name="op39"]').val('');
    $('input[name="otro39"]').val('');
    $('input[name="op40"]').val('');
    $('textarea[name="op42"]').val('');
    $('textarea[name="op43"]').val('');
    $('input[name="op44"]').val('');
    $('input[name="op45"]').val('');
    $('input[name="otro45"]').val('');
    $('input[name="op46"]').val('');
    $('input[name="op48"]').val('');
    $('input[name="otro48"]').val('');
    $('input[name="op49"]').val('');
    $('input[name="op50"]').val('');
    $('input[name="otro50"]').val('');

    $("#porqueOP4").hide(); 
    $("#porqueOP26").hide(); 
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
  $("#Genero").attr("disabled", "disabled");
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
  $("#LibretaPreg").attr("disabled", "disabled");
  $("#Deporte").attr("disabled", "disabled");
  $("#Modalidad").attr("disabled", "disabled");
  $("#Club").attr("disabled", "disabled");

  $.get("getDeportistaDeporte/" + Deportista['Id'] + "", function (DeportistaDeporte) {  
    $("#Deporte").val(DeportistaDeporte['Deporte_Id']);
    $("#Modalidad").val(DeportistaDeporte['Modalidad_Id']);
    $("#Club").val(DeportistaDeporte['Club_Id']);
  });
}

function Valoracion(Valoracion){
  var initOP4 = new Array;
  var initOP7 = new Array;
  var initOP26 = new Array;
  var initOP41 = new Array;
  var initOP53 = new Array;
  var initOP54 = new Array;
  var initOP472 = new Array;
  var initOP522 = new Array;
  var valoInfo = Valoracion;
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
    if(e['PreguntaA_Id'] == 'P7'){
      initOP7.push(e['Respuesta']);                          
    }
    if(e['PreguntaA_Id'] == 'P26'){
      initOP26.push(e['Respuesta']);
      if(e['Respuesta'] == 'Otros'){
        $('textarea[name="otro26"]').val(e['Descripcion']); 
        $("#porqueOP26").show('slow'); 
      }
    }
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
    $('#psico').find(':radio[name^="op26"][value="' + val + '"]').prop("checked", true).change();
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
    var tabla = '<table class="table table-bordered" style="background-color:#CEECF5; border-color:#FFF;">'+
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
                '</tr>'                      
  });
  tabla += '</table>';
  $("#IdiomasT").append(tabla);

  $("#QuienT").empty();
  tablaQ = '<table class="table table-bordered" style="background-color:#CEECF5; border-color:#FFF;">'+
              '<th>DE QUIENES?</th>'+
              '<th>EXPLICACIÓN</th>';

  $.each(valoInfo.quien, function(i, e){
    tablaQ += '<tr>'+
                '<td>'+e.Quien+'</td>'+
                '<td>'+e.Razon+'</td>'+
              '</tr>';                

  });
  tablaQ += '</table>';
  $("#QuienT").append(tablaQ);
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
}

//     $('#psico').find(':checkbox[name^="op4"]').prop('checked', false);