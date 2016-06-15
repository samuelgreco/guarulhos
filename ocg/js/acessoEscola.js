$().ready(function() {
	if ($("#tabela").length){
		$('#tabela').dataTable({
		    "bProcessing": true,
		    "bJQueryUI": true,
		    "sPaginationType": "full_numbers"
		});
	}
} );

