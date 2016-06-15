function iniciar(tela){
	var idEscola = document.getElementById('idEscola').value;
	carregaProfessor(idEscola);
}


function carregaProfessor(id){
	//var x = chamar_ajax('../php/define.php','filtro=IDPesquisa&varID=' + id, false, 'texto', null);
	var dados = 'filtro=carregarProfessorEscola&txtIdEscola='+document.getElementById('idEscola').value;
	var varXML = chamar_ajax('../php/sql.php',dados, false, 'xml', null);
	// Parâmetros: variável XML, id do combo a ser carregado, nome do campo de exibição (texto), nome do campo de ID (valor)
	carregar_combo(varXML, 'cboProfessor', 'NOME', 'IDPROFESSOR' ); 
}

function inscrever(){
	var idEscola = document.getElementById('idEscola').value;
	var idProva = document.getElementById('idProva').value;
	var idProfessor = document.getElementById('cboProfessor').value;
	var acao = document.getElementById('acao').value;
		
	var dados = "";
	
	dados = "IDEscola=" + idEscola;
	dados = dados + "&IDProva=" + idProva;
	dados = dados + "&IDProfessor=" + idProfessor;
	dados = dados + "&acao=inscrever";
	var varResposta = chamar_ajax('../php/cadInscricao.php', dados, false, 'txt', null);
	if (varResposta>0)
	{
		alert("Inscrito com sucesso!");
		window.parent.Shadowbox.close();
		//window.location.href = "../modulo.html";
		//document.getElementById('divEscolas').style.visibility = 'visible';
				
	}else{
		alert ("Ocorreu um erro. Verifique junto a administração!");
	}

}