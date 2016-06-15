$().ready(function () {
     if ($("#msg").val() != "") {
        alert($("#msg").val());
    }    
    $("#frmLogin").validationEngine();

    $("#btn_ok").click(function () {
        if ($("#frmLogin").validationEngine("validate")) {
            $("#frmLogin").submit();
        }
    });
});

function Iniciar() {
    chamar_ajax('php/define.php', 'filtro=DestroiSessao', true, null, null);
}

function Enter(event) {
    if (event.keyCode == 13)
    {
        testar();
        return false;
    }
}

function testar() {
    if (($("#txtNome").val()=="")||($("#txtSenha").val()=="")){
        return;
    }
    $("#frmLogin").submit();   
}
