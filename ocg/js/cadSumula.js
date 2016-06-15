$().ready(function () {
    if (($("#msg").val() !="")) {
        alert($("#msg").val());
    }
    
    $("#cmdImprimir").click(function () {        
       $("#frmCadastro").submit();
    });
    
    $("#cboLocal").change(function () {        
       $("#txtLocal").val($("#cboLocal").text());
    });
    
    $("#txtDtJogo").datepicker({
        dateFormat: 'dd/mm/yy',
        defaultDate: "+1w",
        minDate: "0d",
        changeMonth: true,
        changeYear: true
    });
});

function exibirBtnSalvar() {
    $(".Imprimir").hide();
    if (($("#cboLocal").val() != "") && $("#txtDtJogo").val() != "" && $("#cboHora").val() != "") {
        $(".Imprimir").show();
    }
}

function ImprimirSumula() {
    var endereco = "";
    switch (document.getElementById('cboTipo').value) {
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
    var url="../formularios/" + endereco + ".php?";
    url+="cadastro_categoria=" +$("#txtCategoria").val();
    url+="&sexo=" +$("#txtJogo").val();
    url+="&jogo=" +$("#txtSexo").val();
    url+="&time1=" +$("#txtTime1").val();
    url+="&time2=" +$("#txtTime2").val();
    url+="&data=" +$("#data").val();    
    url+="&cboHora=" +$("#cboHora").val();    
    url+="&local=" +$("#cboLocal").val();    
    url+="&txtIdProva=" +$("#txtIdProva").val();    
    url+="&txtSigla=" +$("#txtSigla").val();    
    url+="&txtCompeticao=" +$("#txtCompeticao").val();    
    window.open(url);
}

$(function () {
 $("#cboLocal").change(function () {
        exibirBtnSalvar();
    });
    $("#txtDtJogo").change(function () {
        exibirBtnSalvar();
    });
    $("#cboHora").change(function () {
        exibirBtnSalvar();
    });
});