$().ready(function () {
    $("#txtData").datepicker({
        dateFormat: 'dd/mm/y',
        changeMonth: true,
        changeYear: true,
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });
});

function ImprimirSumula() {
    var competicao = document.getElementById('txtCompeticao').value
    var jogo = document.getElementById('txtJogo').value
    var time1 = document.getElementById('txtTime1').value
    var time2 = document.getElementById('txtTime2').value
    var sexo = document.getElementById('txtSexo').value
    var categoria = document.getElementById('txtCategoria').value
    var local = document.getElementById('cboLocal').value
    var data = document.getElementById('txtDtJogo').value
    var hora = document.getElementById('cboHora').value
    var idProva = document.getElementById('txtIdProva').value
    var sigla = document.getElementById('txtSigla').value

    var endereco = "";

    switch (document.getElementById('txtModeloSumula').value) {

        case 'Basquete':
            endereco = "sumulaBasquete"
            break;

        case 'Voleibol':
            endereco = "sumulaVoleibol"
            break;

        case 'Futsal':
            endereco = "sumulaFutsal"
            break;

        case 'Futebol':
            endereco = "sumulaFutebol"
            break;

        case 'Handebol':
            endereco = "sumulaHandebol"
            break;

        default:
            break;
    }

    window.open("../formularios/" + endereco + ".php?cadastro_categoria=" + categoria + "&sexo=" + sexo + "&jogo=" + jogo + "&time1=" + time1 + "&time2=" + time2 + "&local=" + local.replace(" ", "_") + "&data=" + data + "&hora=" + hora + "&idProva=" + idProva + "&competicao=" + competicao.replace(" ", "_") + "&sigla=" + sigla);

}

function CarregaLocais() {
    var varXML = chamar_ajax('../php/sql.php', 'filtro=CarregaLocais', false, 'xml', null);
    // Parâmetros: variável XML, id do combo a ser carregado, nome do campo de exibição (texto), nome do campo de ID (valor)
    carregar_combo(varXML, 'cboLocal', 'local', 'local');
}