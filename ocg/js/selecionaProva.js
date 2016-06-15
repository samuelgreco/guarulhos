
function inscrever(idEscola, idProva, idProfessor){
	var dados = "";
	
	dados = "IDEscola=" + idEscola;
	dados = dados + "&IDProva=" + idProva;
	dados = dados + "&IDProfessor=" + idProfessor;
	dados = dados + "&acao=inscrever";
	
	var varResposta = chamar_ajax('../php/cadInscricao.php', dados, false, 'txt', null);
	if (varResposta)
	{
		window.location.reload();
		//document.getElementById('divEscolas').style.visibility = 'visible';
				
	}else{
		alert ("Ocorreu um erro. Verifique junto a administração!");
	}

}

function excluir(idEscola, idProva, idProfessor){
	var dados = "";
	
	dados = "IDEscola=" + idEscola;
	dados = dados + "&IDProva=" + idProva;
	dados = dados + "&IDProfessor=" + idProfessor;
	dados = dados + "&acao=excluir";
	
	var varResposta = chamar_ajax('../php/cadInscricao.php', dados, false, 'txt', null);
	if (varResposta)
	{
		window.location.reload();
		//document.getElementById('divEscolas').style.visibility = 'visible';
				
	}else{
		alert ("Ocorreu um erro. Verifique junto a administração!");
	}
}

