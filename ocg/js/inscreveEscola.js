$(function () {
    Shadowbox.init({
        skipSetup: true,
        onClose: function () {
            location.reload();
        }
    });
});

function inscrever(txtIdEscola, txtIdProva) {
    if (!($("#cboProfessor_" + txtIdProva).val() > 0)) {
        alert("Selecione o professor");
        $("#cboProfessor_" + txtIdProva).focus();
        return;
    }
    $.getJSON("../php/Gravar.php", {
        filtro: "gravarInscricaoEscola",
        tipoRetorno: "texto",
        txtIdEscola: txtIdEscola,
        txtIdProva: txtIdProva,
        txtIdProfessor: $("#cboProfessor_" + txtIdProva).val(),
    }, function (retorno) {
        if (retorno == "1") {
            getConteudoTd(txtIdEscola, txtIdProva, "gravou");
        } else {
            alert(retorno);
        }
    });
}

function excluir(txtIdEscola, txtIdProva) {
    $.getJSON("../php/Gravar.php", {
        filtro: "excluirInscricaoEscola",
        tipoRetorno: "texto",
        txtIdEscola: txtIdEscola,
        txtIdProva: txtIdProva
    }, function (retorno) {
        if (retorno == "1") {
            getConteudoTd(txtIdEscola, txtIdProva, "excluiu");
        } else {
            alert(retorno);
        }
    });
}

function getConteudoTd(txtIdEscola, txtIdProva, acao) {
    document.location.href="inscreveEscola.php?txtIdEscola="+txtIdEscola;    
    return;
    var td = "";
    if (acao == "gravou") {
    	td = "<center>"
        td += "<a href='javascript:excluir(" + txtIdEscola + "," + txtIdProva + ");' >";
    	td += "<img width='40' alt='Excluir Incrição' src='../imagem/Excluir.png'>";
        td += "</a></center>";
    } else {
    	td = "<center>"
        td += "<a href='javascript:inscrever(" + txtIdEscola + "," + txtIdProva + ");' >";
    	td += "<img width='40' alt='Inscrever' src='../imagem/Inscrever.png'>";
        td += "</a></center>";
    }

    $("#td_" + txtIdEscola + "_" + txtIdProva).html(td);
}