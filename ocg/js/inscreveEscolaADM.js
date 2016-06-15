$(function(){
	Shadowbox.init({
		skipSetup: true,
		onClose:function(){location.reload();}
	});
});


function inscrever(idEscola, idProva){
	var dados = "";
	
	dados = "IDEscola=" + idEscola;
	dados = dados + "&IDProva=" + idProva;
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

function excluir(idEscola, idProva){
	var dados = "";
	
	dados = "IDEscola=" + idEscola;
	dados = dados + "&IDProva=" + idProva;
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

function iniciar(){
	
	carregaEscolas();
	
}

function carregaEscolas(){

	var idEscola = chamar_ajax('../php/define.php','filtro=GetLogin', false, 'texto', null);
		
	var varXML = chamar_ajax('../php/sql.php','filtro=CarregaEscolasProfessor&txtID='+ idEscola, false, 'xml', null);
	// Parâmetros: variável XML, id do combo a ser carregado, nome do campo de exibição (texto), nome do campo de ID (valor)
	carregar_combo(varXML, 'cboEscola', 'nomeEscola', 'idEscola' ); 
}

function abrirEscola(){

	var idEscola = document.getElementById("cboEscola").value;
	var nomeEscola = document.getElementById("cboEscola")[document.getElementById("cboEscola").selectedIndex].innerHTML;
	
	window.location="inscreveEscolaADM.php?idEscola=" + idEscola + "&nome=" + nomeEscola;
	 
}

function shadow(idEscola, idProva){
//alert("aqui");
	var dados = "";
	
	dados = "IDEscola=" + idEscola;
	dados = dados + "&IDProva=" + idProva;
	dados = dados + "&acao=inscrever";
	
    Shadowbox.open({
		content:    "../formularios/selecionaProfessor.php?"+dados,
        player:     "iframe",
        height:     300,
        width:      800
    });

}