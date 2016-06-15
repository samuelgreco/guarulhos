$().ready(function () {
    $('#tabela').dataTable({
        "bProcessing": true,
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 50
    });
    
    $("#txtDtNasc").datepicker({
        dateFormat: 'dd/mm/yy',
        defaultDate: "+1w",
        maxDate: "-1d",
        changeMonth: true,
        changeYear: true
    });
});

function excluir(txtID) {
    if (confirm("Clique em OK se tens certeza de remover o registro")) {
        $.getJSON("../php/Gravar.php", {
            txtID: txtID,
            filtro: "excluirAluno",
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
