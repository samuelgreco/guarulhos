$().ready(function () {
    if ($("#mensagem").val() != "") {
        alert($("#mensagem").val());
    }
    
    $("#txtDtNasc").datepicker({
        dateFormat: 'dd/mm/yy',
        defaultDate: "-7y",
        maxDate: "-1d",
        changeMonth: true,
        changeYear: true
    });


    $("#cmdSalvar").click(function () {

        if ($("#txtRG").val() == '' && $("#txtRA").val() == '') {
            alert("Pelo menos um dos campos RA e RG devem ser preenchidos");
            $("#txtRA").focus(); // foco no campo
        } else {
            $("#frmCadastro").submit();
        }

    });



    $("#frmCadastro").validationEngine();
    $("#cmdSalvar").click(function () {
        if ($("#frmCadastro").validationEngine("validate") && ($("#txtRG").val() != '' || $("#txtRA").val() != '')) {
            $("#frmCadastro").submit();
        }
        else {
            alert("Pelo menos um dos campos RA e RG devem ser preenchidos");
            $("#txtRA").focus(); // foco no campo

        }
    });
    $("#txtDtNasc").change(function () {
        lstCategoria();
    });
    $("#txtRA").change(function () {
        verificarRaPreExistente();
    });
    $("#txtRG").change(function () {
        verificarRgPreExistente();
    });
});

function verificarRgPreExistente() {
    if (!($("#cboEscola").val()>0)) {
        alert("Selecione a escola");
        $("#txtRG").val("");
        $("#cboEscola").focus();
        return;
    }
    if ($("#txtRG").val() == "") {
        return;
    }        
    $.getJSON("../php/sql.php", {
        filtro: "lstAluno",
        tipoRetorno: "json",
        txtRG: $("#txtRG").val(),
        cboEscola: $("#cboEscola").val()
    }, function (retorno) {
        retorno = retorno[0];
        if (retorno) {
            if (retorno.IDALUNO> 0) {
                alert("Já consta um registro com este RG ("+retorno.RG+") de nome " +retorno.NOME );
                document.location.href = "consultaAluno.php";
            }
        }
    });
}

function verificarRaPreExistente() {
    if (!($("#cboEscola").val()>0)) {
        alert("Selecione a escola");
        $("#txtRA").val("");
        $("#cboEscola").focus();
        return;
    }
    if ($("#txtRA").val() == "") {
        return;
    }        
    $.getJSON("../php/sql.php", {
        filtro: "lstAluno",
        tipoRetorno: "json",
        txtRA: $("#txtRA").val(),
        cboEscola: $("#cboEscola").val()
    }, function (retorno) {
        retorno = retorno[0];
        if (retorno) {
            if (retorno.IDALUNO> 0) {
                alert("Já consta um registro com este RA ("+retorno.RA+") de nome " +retorno.NOME );
                document.location.href = "consultaAluno.php";
            }
        }
    });
}

function lstCategoria() {
    $("#cboCategoria").children().remove().end().append("<option selected value=''></option>");
    if ($("#txtDtNasc").val() != "") {
        $.getJSON("../php/sql.php", {
            txtDtNasc: $("#txtDtNasc").val(),
            filtro: "lstCategoria",
            formatarIdadeDtNasc: "sim",
            tipoRetorno: "json"
        }, function (retorno) {
            $.each(retorno, function (index, linha) {
                var opt = "<option value='" + linha.IDCATEGORIA + "'>" + linha.DESCRICAO + "</option>";
                $("#cboCategoria").children().end().append(opt);
            });
        });
    }
}







