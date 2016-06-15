$().ready(function () {

});

function gravarTrava(idObjeto) {
    var campo = "ESCOLAINSCRICAO";
    if (idObjeto == "escolaExclusao") {
        campo = "ESCOLAEXCLUSAO";
    }
    if (idObjeto == "alunoInscricao") {
        campo = "ALUNOINSCRICAO";
    }
    if (idObjeto == "alunoExclusao") {
        campo = "ALUNOEXCLUSAO";
    }
    if (idObjeto == "alunoInsert") {
        campo = "ALUNOINSERT";
    }
    if (idObjeto == "alunoDelete") {
        campo = "ALUNODELETE";
    }
    if (idObjeto == "alunoUpdate") {
        campo = "ALUNOUPDATE";
    }
    
    var valor = $("#" + idObjeto + "_valor").val();
    if (valor == 0) {
        valor = 1;
    } else {
        valor = 0;
    }
    $.getJSON("../php/Gravar.php", {
        filtro: "gravarTrava",
        tipoRetorno: "txt",
        campo: campo,
        valor: valor
    }, function (retorno) {
        if (retorno == "1") {
            getCadeado(idObjeto, valor);
        } else {
            alert(retorno);
        }
    });
}

function getCadeado(idObjeto, valor) {
    var td = "<input type='hidden' id='" + idObjeto + "_valor' value='" + valor + "' />";
    if (valor == 1) {
        td += "<img width='40' src='../../lib/images/icones/aberto.png'/>";
    } else {
        td += "<img width='40' src='../../lib/images/icones/fechado.png'>";
    }
    $("#" + idObjeto).html(td);
}