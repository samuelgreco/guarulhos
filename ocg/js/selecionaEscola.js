
function iniciar(tela){	
//	carregaEscolas();
}

$(function(){
	$('#cboEscola').change(function(){
		var selected = $(this).find('option:selected');
		$('#nomeEscola').val(selected.text());
	});
});