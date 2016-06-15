
function editar(id) {
    var x = chamar_ajax('../php/define.php', 'filtro=IDPesquisa&varID=' + id, false, 'texto', null);
    window.location.href = "cadastro_aluno.php";
}

function iniciar() {
    carregaEscolas();
}

function inscreverAluno() {
    window.location.href = "selecionaProva.php?txtIdEscola=" + $("#cboEscola").val();
}