$().ready(function () {
    $('#tabela').dataTable({
        "bProcessing": true,
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 50
    });
});

function excluir(txtID) {//Exclui tabela da prova
    if (confirm("Deseja realmente excluir a tabela selecionada?")) {
        var resposta = chamar_ajax('../php/cadTabela.php', 'acao=excluir&txtID=' + txtID, false, 'txt', null);
        if (resposta == 1) {            
            $("#btnExcluir" + txtID).hide();            
        } else {
            alert("Operação não executada no servidor do sistema!");
        }
    }
}