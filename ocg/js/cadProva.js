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
     $('#tabela').dataTable({
        "bProcessing": true,
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
});

function MostraIdade() {
    if (document.getElementById('cboCategoria').value > 0) {
        var varXML = chamar_ajax('../php/sql.php', 'filtro=mostraIdade&id=' + document.getElementById('cboCategoria').value, false, 'xml', null);
        document.getElementById('lblIdadeMin').innerHTML = valor_xml(varXML, 'idadeMin', 0);
        document.getElementById('lblIdadeMax').innerHTML = valor_xml(varXML, 'idadeMax', 0);
    } else {
        document.getElementById('lblIdadeMin').innerHTML = "";
        document.getElementById('lblIdadeMax').innerHTML = "";
    }
}
