$().ready(function() {
	if ($("#tabela").length){
		$('#tabela').dataTable({	
	        "bProcessing": true,
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers"
		});
	}
} );

function editar(id){
	var x = chamar_ajax('../php/define.php','filtro=IDPesquisa&varID=' + id, false, 'texto', null);
	window.location.href = "cadastro_prova.php";
}

function iniciar(tela){
	var varXML = chamar_ajax('../php/sql.php', 'filtro=CarregaProva', false, 'xml', null);
	
	carregaModalidade();
	carregaCategoria();
	
	if (tela==1){ //Cadastro
	
		if (varXML != null) {
			CarregaCampos(varXML);
		}
	}
}

function MostraIdade(){

	if (document.getElementById('cboCategoria').value>0){
		var varXML = chamar_ajax('../php/sql.php','filtro=mostraIdade&id=' + document.getElementById('cboCategoria').value, false, 'xml', null);
		document.getElementById('lblIdadeMin').innerHTML = valor_xml(varXML, 'idadeMin', 0);
		document.getElementById('lblIdadeMax').innerHTML = valor_xml(varXML, 'idadeMax', 0);
	}else{
		document.getElementById('lblIdadeMin').innerHTML = "";
		document.getElementById('lblIdadeMax').innerHTML = "";
	}
}

function carregaModalidade(){

	var varXML = chamar_ajax('../php/sql.php','filtro=modalidade', false, 'xml', null);
	// Parâmetros: variável XML, id do combo a ser carregado, nome do campo de exibição (texto), nome do campo de ID (valor)
	carregar_combo(varXML, 'cboModalidade', 'descModalidade', 'idModalidade' ); 
}

function carregaCategoria(){

	var varXML = chamar_ajax('../php/sql.php','filtro=categoria', false, 'xml', null);
	// Parâmetros: variável XML, id do combo a ser carregado, nome do campo de exibição (texto), nome do campo de ID (valor)
	carregar_combo(varXML, 'cboCategoria', 'descCategoria', 'idCategoria' ); 
}

function CarregaCampos(varXML) {
	document.getElementById('txtID').value = valor_xml(varXML,'idProva', 0);
	document.getElementById('cboModalidade').value = valor_xml(varXML, 'idModalidade', 0);
	document.getElementById('cboCategoria').value = valor_xml(varXML, 'idCategoria',	0);
	document.getElementById('cboSexo').value = valor_xml(varXML,'sexo', 0);
	document.getElementById('txtDesc').value = valor_xml(varXML, 'descProva', 0);

}