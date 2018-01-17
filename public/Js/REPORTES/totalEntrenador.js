$(function(){
    $("#loading").show('slow');
	$.get("getTotalEntrenadores", function (Entrenadores) {
        
		$("#TablaDatos").empty();
		$("#TablaDatos").append(Entrenadores);
		$('#entrenadoresTabla').DataTable({
            retrieve: true,
            buttons: [
                'copy', 'csv', 'excel', 'print'
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
	}).done(function(){
       $("#loading").hide('slow');
    });
});