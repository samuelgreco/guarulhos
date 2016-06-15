$().ready(function () {
    if ($("#mensagem").val() != "") {
        alert($("#mensagem").val());
    }
    $("#frmCadastro").validationEngine();

    $("#cmdSalvar").click(function () {

        if ($("#frmCadastro").validationEngine("validate")) {
            $("#frmCadastro").submit();
        }
    });

    $("#txtApelido").change(function () {
        checarApelidoExiste();
    });

    $('#tabela').dataTable({
        "bProcessing": true,
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
});

function checarApelidoExiste() {
    if ($("#txtApelido").val() == "") {
        return;
    }

    $.getJSON("../php/sql.php", {
        txtApelido: $("#txtApelido").val(),
        filtro: "lstEscola",
        tipoRetorno: "json"
    }, function (retorno) {
        retorno = retorno[0];
        if ((retorno.IDESCOLA) > 0) {
            if ((retorno.IDESCOLA) != $("#txtID").val()) {
                alert("Já existe este apelido.");
                $("#txtApelido").val("");
            }

        }
    });


}