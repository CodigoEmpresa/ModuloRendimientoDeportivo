$(function(){

	$.datepicker.setDefaults($.datepicker.regional["es"]);
	$('#FechaInicioDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaFinDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#HoraInicioDate').datepicker({viewMode:'hour', autoclose: true,});

	$("#NuevoEntrenamiento").on('click', function(){
		$("#AgregarEntrenamientoModal").modal('show');
	});

	$("#AgregarEntrenamiento").on('click', function(){

	});
});