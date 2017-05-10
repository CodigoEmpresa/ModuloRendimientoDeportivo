$(function(){
	$.get("getTotalDeportistas", function (Deportistas) {
		$("#TablaDatos").empty();
		$("#TablaDatos").append(Deportistas);
		$('#deportistasTabla').DataTable({
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
});