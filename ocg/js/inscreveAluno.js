$().ready(function () {

    if ($("#tabela").length) {
        $('#tabela').dataTable({
            "bProcessing": true,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    }
});

function inscrever(txtIdProva, txtIdEscola, txtIdAluno) {
    var dados = "";
    var qtdeMaxProva = $("#txtQtdeProva").val();
    var qtdVagasLivres = $("#txtVagas").val();
    
    if ((qtdVagasLivres) > 0) {
        dados = "txtIdAluno=" + txtIdAluno;
        dados += "&txtIdEscola=" + txtIdEscola;
        dados += "&txtIdProva=" + txtIdProva;
        dados += "&acao=inscrever";
        var varResposta = chamar_ajax('../php/cadInscricaoAluno.php', dados, false, 'txt', null);
        var td="_" + txtIdProva + "_" + txtIdEscola + "_" + txtIdAluno;
        if (varResposta == 1) {
        
        	document.location.href = "inscreveAluno.php?txtIdProva="+txtIdProva+"&txtIdEscola="+txtIdEscola;
        	
        } 
        else {
            alert("Ocorreu um erro. Verifique junto a administração!\n  "+varResposta);
        }
    } else {
        alert("A quantidade limite de (" + qtdeMaxProva + ") inscrições para essa prova foi excedida!");
    }

}

//function excluir(idAluno, idProva, linha){
function excluir(txtIdProva, txtIdEscola, txtIdAluno) {
    var dados = "txtIdAluno=" + txtIdAluno;
    dados += "&txtIdEscola=" + txtIdEscola;
    dados += "&txtIdProva=" + txtIdProva;
    dados += "&acao=excluir";
    var varResposta = chamar_ajax('../php/cadInscricaoAluno.php', dados, false, 'txt', null);
    var td="_" + txtIdProva + "_" + txtIdEscola + "_" + txtIdAluno;
    if (varResposta == 1) {
    	location.reload();
        
    } else {
        alert("Ocorreu um erro. Verifique junto a administração!");
    }
}

