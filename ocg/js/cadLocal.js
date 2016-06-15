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
});
