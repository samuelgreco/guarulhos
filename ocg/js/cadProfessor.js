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
    $("#txtCpf").change(function () {
        verificarPreExistente();
    });
    $("#txtEmail").change(function () {
        sugerirLogin();
    });
});

function verificarPreExistente() {
    if ($("#txtCpf").val() == "") {
        return;
    }
    $.getJSON("../php/sql.php", {
        filtro: "lstProfessor",
        tipoRetorno: "json",
        txtCpf: $("#txtCpf").val()
    }, function (retorno) {
        retorno = retorno[0];
        if (retorno) {
            if (retorno.IDPROFESSOR > 0) {
                alert("Já consta um registro com este CPF ("+retorno.CPF+") de nome " +retorno.NOME );
                document.location.href = "consultaProfessor.php";
            }
        }
    });
}

function sugerirLogin() {
    if ($("#txtEmail").val() == "") {
        return;
    }
    if ($("#txtLogin").val() != "") {
        return;
    }

    var login = $("#txtEmail").val();
    login = login.split("@");
    $("#txtLogin").val(login[0]);
}

function addEscola() {
    if (!($("#cboEscolaExclusa").val() > 0)) {
        alert("Selecione escola");
        $("#cboEscolaExclusa").focus();
        return;
    }
    $.getJSON("../php/Gravar.php", {
        filtro: "gravarEscolaProfessor",
        tipoRetorno: "txt",
        txtIdEscola: $("#cboEscolaExclusa").val(),
        txtIdProfessor: $("#txtID").val()
    }, function (retorno) {
        if (retorno == "1") {
            lstEscolaInclusa();
            lstEscolaExclusa();
        } else {
            alert(retorno);
        }
    });
}

function excluiEscola() {
    if (!($("#cboEscolaInclusa").val() > 0)) {
        alert("Selecione a escola");
        $("#cboEscolaInclusa").focus();
        return;
    }
    $.getJSON("../php/Gravar.php", {
        filtro: "excluirEscolaProfessor",
        tipoRetorno: "txt",
        txtIdEscola: $("#cboEscolaInclusa").val(),
        txtIdProfessor: $("#txtID").val()
    }, function (retorno) {
        if (retorno == "1") {
            lstEscolaInclusa();
            lstEscolaExclusa();
        } else {
            alert(retorno);
        }
    });
}

function lstEscolaInclusa() {
    $("#cboEscolaInclusa").children().remove().end().append("<option selected value=''></option>");
    $.getJSON("../php/sql.php", {
        filtro: "lstEscola",
        tipoRetorno: "json",
        txtIdProfessorIn: $("#txtID").val()
    }, function (retorno) {
        $.each(retorno, function (index, d) {
            $("#cboEscolaInclusa").children().end().append("<option value='" + d.IDESCOLA + "'>" + d.NOME + "</option>");
        });
    });
}

function lstEscolaExclusa() {
    $("#cboEscolaExclusa").children().remove().end().append("<option selected value=''></option>");
    $.getJSON("../php/sql.php", {
        filtro: "lstEscola",
        tipoRetorno: "json",
        txtIdProfessorNotIn: $("#txtID").val()
    }, function (retorno) {
        $.each(retorno, function (index, d) {
            $("#cboEscolaExclusa").children().end().append("<option value='" + d.IDESCOLA + "'>" + d.NOME + "</option>");
        });
    });
}
