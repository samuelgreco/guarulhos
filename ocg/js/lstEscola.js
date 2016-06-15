$().ready(function () {
    $('#tabela').dataTable({
        "bProcessing": true,
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
});

function excluir(txtID) {
    if (confirm("Clique em OK se tens certeza de remover o registro")) {
        $.getJSON("../php/Gravar.php", {
            txtID: txtID,
            filtro: "excluirEscola",
            tipoRetorno: "json"
        },
        function (retorno) {
            if ((retorno.codigo) == 1) {
                $("#linha" + txtID).hide();
            } else {
                alert(retorno.mensagem);
            }
        });
    }
}