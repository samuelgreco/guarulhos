$().ready(function () {
    /*
    var varXML = chamar_ajax('../php/sql.php', 'filtro=lstTabela&txtIdProva=' + $("#txtIdProva").val(), false, 'xml', null);
    if (valor_xml(varXML, 'IDTABELA', 0) > 0) {
        CarregaCampos(varXML);
    } else {
        sorteio($("#txtQtdParticipante").val(), $("#txtIdProva").val(), $("#txtPotenciaMin").val());
    }
    */
});

function CarregaCampos(varXML) {
    var nreg = valor_xml(varXML, 'n_reg', 0);
    if (nreg > 0) {
        for (var x = 0; x < nreg; x++) {
            document.getElementById('lblTimeRodada' + valor_xml(varXML, 'rodada', x) + 'TimeRodada' + valor_xml(varXML, 'posicao', x)).innerHTML = valor_xml(varXML, 'escola', x);
            document.getElementById('lblTimeRodada' + valor_xml(varXML, 'rodada', x) + 'TimeRodada' + valor_xml(varXML, 'posicao', x) + 'Tabela').innerHTML = valor_xml(varXML, 'escola', x);
            document.getElementById('txtPlacarRodada' + valor_xml(varXML, 'rodada', x) + 'TimeRodada' + valor_xml(varXML, 'posicao', x)).value = valor_xml(varXML, 'placar', x);

            if (x != nreg - 1) {
                document.getElementById('txtPlacarRodada' + valor_xml(varXML, 'rodada', x) + 'TimeRodada' + valor_xml(varXML, 'posicao', x) + 'Tabela').value = valor_xml(varXML, 'placar', x);
            }
        }
    }
}

function sorteio(participantes, idProva, potenciaMin) {
    //alert(participantes+" - "+idProva+" - "+potenciaMin);
    var playin = 0; //Total de participantes do playin
    var rodada1 = 0; //Total de participantes da primeira rodada
    var posicao = 0; //Posição de encaixe do participante na chave
    var x = 0; //Posição para capturar o nome do participante do retorno do banco de dados
    var controle = 0; //Controlador de vagas

    var varXML = chamar_ajax('../php/sql.php', 'filtro=carregarSorteio&txtIdProva=' + idProva, false, 'xml', null);

    if (varXML != null) {
        playin = (participantes - (Math.pow(2, potenciaMin))) * 2; //Calcula a quantidade de participantes no playin
        rodada1 = participantes - playin; //Calcula a quantidade de participantes na rodada 1 sem os que participaram no play-in

        if (playin == 0) {
            playin = rodada1;
            rodada1 = 0;
        }

        var aleat = aleatorio(1, participantes);

        var times = new Array(participantes);
        var mudarPosicao = 0;

        posicao = aleat; //Inicia a variavel de posicao na array


        //Com o numero aleatorio gerado, encaixa na array os times seguindo a posicao aleatoria
        //somando o numero obtido com a posicao anterior
        //Caso a posicao seja maior que o numero de participantes, pegamos a diferenca e voltamos
        //para o inicio da array
        while (true) {
            if (x >= participantes) {
                break;
            }
            if (times[posicao] == null) {
                times[posicao] = valor_xml(varXML, 'APELIDO', x);
                x++;
                posicao = posicao + aleat;
                if (posicao > participantes) {
                    posicao = posicao - participantes;
                }
            } else {
                if (mudarPosicao > 3) {
                    posicao++;
                    mudarPosicao = 0;
                    if (posicao > participantes) {
                        posicao = posicao - participantes;
                    }
                } else {
                    mudarPosicao++;
                    posicao = posicao + aleat;
                    if (posicao > participantes) {
                        posicao = posicao - participantes;
                    }
                }
            }

        }

        x = 1;
        //Preenche os participantes atE completar a rodada 1 (Play-in)
        for (var i = 1; i<= playin; i++) {
            //alert(times[x]);
            $("#lblTimeRodada1TimeRodada" + i).html(times[x]);
            $("#lblTimeRodada1TimeRodada" + i + 'Tabela').html(times[x]);
            x++;
        }
        
        //Preenche os participantes atE completar a rodada 2 (Demais participantes)
      //  alert(((Math.pow(2, potenciaMin) - rodada1) + 1));
        for (var i= ((Math.pow(2, potenciaMin) - rodada1) + 1); i< (times.length - 1); i++) {
          //  alert("aaa: "+times[x]);
            $("#lblTimeRodada2TimeRodada"+ i).html(times[x]);
            $("#lblTimeRodada2TimeRodada" + i+ "Tabela").html(times[x]);            
            x++;
        }

    }
}

function vencedor(rodada, jogoRodada) {
    var t1;
    var t2;
    if (jogoRodada % 2 > 0) {
        classificado = (jogoRodada + 1) / 2;
        t1 = jogoRodada;
        t2 = jogoRodada + 1;
    } else {
        classificado = (jogoRodada) / 2;
        t1 = jogoRodada - 1;
        t2 = jogoRodada;
    }
    var time1 = document.getElementById("txtPlacarRodada" + rodada + "TimeRodada" + t1).value;
    var time2 = document.getElementById("txtPlacarRodada" + rodada + "TimeRodada" + t2).value;
    var classificado;

    if (jogoRodada % 2 > 0) {
        classificado = (jogoRodada + 1) / 2;
    } else {
        classificado = (jogoRodada) / 2;
    }

    if (time1 > time2) {
        document.getElementById('lblTimeRodada' + (rodada + 1) + 'TimeRodada' + classificado).innerHTML = document.getElementById('lblTimeRodada' + rodada + 'TimeRodada' + t1).innerHTML;
        document.getElementById('lblTimeRodada' + (rodada + 1) + 'TimeRodada' + classificado + 'Tabela').innerHTML = document.getElementById('lblTimeRodada' + rodada + 'TimeRodada' + t1).innerHTML;
    }
    if (time2 > time1) {
        document.getElementById('lblTimeRodada' + (rodada + 1) + 'TimeRodada' + classificado).innerHTML = document.getElementById('lblTimeRodada' + rodada + 'TimeRodada' + t2).innerHTML;
        document.getElementById('lblTimeRodada' + (rodada + 1) + 'TimeRodada' + classificado + 'Tabela').innerHTML = document.getElementById('lblTimeRodada' + rodada + 'TimeRodada' + t2).innerHTML;
    }

    document.getElementById("txtPlacarRodada" + rodada + "TimeRodada" + t1 + 'Tabela').value = time1;
    document.getElementById("txtPlacarRodada" + rodada + "TimeRodada" + t2 + 'Tabela').value = time2;
}

function aleatorio(inferior, superior) { //Gera um número aleatório para referência do sorteio
    numPossibilidades = superior - inferior
    aleat = Math.random() * numPossibilidades
    aleat = Math.floor(aleat)
    return parseInt(inferior) + aleat
}

function PrintDiv(id, pg) {//Esconde as divs especificadas para impressão
    switch (id) {
        case 'tabelaJogos':
            document.getElementById('chave').style.display = 'none';
            break;

        case 'chave':
            document.getElementById('tabelaJogos').style.display = 'none';
            break;

        default:
            break;
    }

    document.getElementById('cmdSalvarTabela').style.display = 'none';

    window.print();
    alert("Imprimindo...");
    document.getElementById('chave').style.display = 'block';
    document.getElementById('tabelaJogos').style.display = 'block';
    document.getElementById('cmdSalvarTabela').style.display = 'block';
}

function Gravar(idProva) {//Grava a chave no banco de dados

    Excluir(idProva); //Exclui a tabela anterior para salvar a próxima

    var playIn = document.getElementById('txtPlayIn').value;
    var rodadas = document.getElementById('txtRodadas').value;
    var rodada = document.getElementById('txtRodada1').value;

    var dados = "";

    /*
     * Contador por rodada
     * Percorre as rodadas e armazena o Código da prova, nome do participante, placar, número da rodada e a posição na chave
     */

    for (var x = 1; x <= rodadas; x++) {//Contador da rodada
        if (playIn > 0) {//Caso haja participantes no PlayIn, faça o seguinte
            for (var y = 1; y <= playIn; y++) {
                dados = dados + idProva + '|' + document.getElementById('lblTimeRodada' + x + 'TimeRodada' + y).innerHTML + '|' + document.getElementById('txtPlacarRodada' + x + 'TimeRodada' + y).value + '|' + x + '|' + y + '|';
            }
            playIn = 0;
        } else {//Caso não tenha playIn, faça o seguinte
            for (var y = 1; y <= rodada; y++) {//Armazena participantes das outras rodadas 
                dados = dados + idProva + '|' + document.getElementById('lblTimeRodada' + x + 'TimeRodada' + y).innerHTML + '|' + document.getElementById('txtPlacarRodada' + x + 'TimeRodada' + y).value + '|' + x + '|' + y + '|';
            }
            rodada = rodada / 2;
        }
    }

    //Grava dados no banco
    //alert(dados);
    var varResposta = chamar_ajax('../php/cadTabela.php', 'acao=salvar&idProva=' + idProva + '&tabela=' + dados, false, 'txt', null);

    if (varResposta==1)
    {
        alert("Salvo com sucesso!");
    } else {
        alert("Ocorreu um erro. Verifique junto a administração!\n"+varResposta);
    }

}

function Excluir(idProva) {//Exclui tabela da prova
    var varResposta = chamar_ajax('../php/cadTabela.php', 'acao=excluir&idProva=' + idProva, false, 'txt', null);

}

function Sumula(categoria, sexo, jogo, timeRodada, rodada, idProva, sigla) {

    var time1 = document.getElementById('lblTimeRodada' + rodada + 'TimeRodada' + (timeRodada - 1) + 'Tabela').innerHTML;
    var time2 = document.getElementById('lblTimeRodada' + rodada + 'TimeRodada' + timeRodada + 'Tabela').innerHTML;

    categoria = categoria.replace(/\W/gi, "-");

    //window.open("../formularios/sumula.php?categoria=" + categoria + "&sexo=" + sexo + "&jogo=" + jogo + "&time1=" + time1.replace(/\W/gi, "-") + "&time2=" + time2.replace(/\W/gi, "-") + "&idProva=" + idProva);
    window.open("../formularios/cadastro_sumula.php?categoria=" + categoria + "&sexo=" + sexo + "&jogo=" + jogo + "&time1=" + retiraAcentos(time1.replace(/\s/gi, "-")) + "&time2=" + retiraAcentos(time2.replace(/\W/gi, "-")) + "&idProva=" + idProva + "&sigla=" + sigla);
}

function retiraAcentos(palavra) { //Retira acentos das palavas e substitue por caractere normal

    var sec = ['193', '225', '192', '224', '194', '226', '461', '462', '258', '259', '195', '227', '7842', '7843', '7840', '7841', '196', '228', '197', '229', '256', '257', '260', '261', '7844', '7845', '7846', '7847', '7850', '7851', '7848', '7849', '7852', '7853', '7854', '7855', '7856', '7857', '7860', '7861', '7858', '7859', '7862', '7863', '506', '507', '262', '263', '264', '265', '268', '269', '266', '267', '199', '231', '270', '271', '272', '273', '201', '233', '200', '232', '202', '234', '282', '283', '276', '277', '7868', '7869', '7866', '7867', '278', '279', '203', '235', '274', '275', '280', '281', '7870', '7871', '7872', '7873', '7876', '7877', '7874', '7875', '7864', '7865', '7878', '7879', '286', '287', '284', '285', '288', '289', '290', '291', '292', '293', '294', '295', '205', '237', '204', '236', '300', '301', '206', '238', '463', '464', '207', '239', '296', '297', '302', '303', '298', '299', '7880', '7881', '7882', '7883', '308', '309', '310', '311', '313', '314', '317', '318', '315', '316', '321', '322', '319', '320', '323', '324', '327', '328', '209', '241', '325', '326', '211', '243', '210', '242', '334', '335', '212', '244', '7888', '7889', '7890', '7891', '7894', '7895', '7892', '7893', '465', '466', '214', '246', '336', '337', '213', '245', '216', '248', '510', '511', '332', '333', '7886', '7887', '416', '417', '7898', '7899', '7900', '7901', '7904', '7905', '7902', '7903', '7906', '7907', '7884', '7885', '7896', '7897', '7764', '7765', '7766', '7767', '340', '341', '344', '345', '342', '343', '346', '347', '348', '349', '352', '353', '350', '351', '356', '357', '354', '355', '358', '359', '218', '250', '217', '249', '364', '365', '219', '251', '467', '468', '366', '367', '220', '252', '471', '472', '475', '476', '473', '474', '469', '470', '368', '369', '360', '361', '370', '371', '362', '363', '7910', '7911', '431', '432', '7912', '7913', '7914', '7915', '7918', '7919', '7916', '7917', '7920', '7921', '7908', '7909', '7810', '7811', '7808', '7809', '372', '373', '7812', '7813', '221', '253', '7922', '7923', '374', '375', '376', '255', '7928', '7929', '7926', '7927', '7924', '7925', '377', '378', '381', '382', '379', '380', '208'];
    var rep = ['A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'N', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'P', 'p', 'P', 'p', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'W', 'w', 'W', 'w', 'W', 'w', 'Y', 'y', 'Y', 'y', 'Y', 'y', 'Y', 'y', 'Y', 'y', 'Y', 'y', 'Y', 'y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 'D'];

    var seclen = sec.length;
    var repwith = -1;
    var remcnt = 0;
    var text = palavra;

    text = text.replace(/\r/g, '').split('\n');

    var textout = new Array();
    var linecnt = text.length;
    var toremout = '';
    var chcoat = '';

    for (var x = 0; x < linecnt; x++) {
        torem = text[x].split('');
        toremout = new Array();
        toremlen = torem.length;

        for (var y = 0; y < toremlen; y++) {
            chcoat = torem[y].charCodeAt(0);
            if (chcoat > 124) {
                for (var z = 0; z < seclen; z++) {
                    if (chcoat == sec[z]) {
                        repwith = rep[z];
                        remcnt++;
                        z = seclen;
                    }
                }
            }
            if (repwith != -1) {
                toremout[y] = repwith;
                repwith = -1;
            } else {
                toremout[y] = torem[y];
            }
        }
        textout[x] = toremout.join('');
    }

    textout = textout.join('\n');
    return textout;
}

