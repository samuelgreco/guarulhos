<?php

if ($_GET['testarServerName']=="sim") {
	echo "<pre>";
	print_r($_SERVER);
    echo "</pre>";
}
if ($_GET['testarPhpinfo']=="sim") {	
	echo phpinfo();
}
exit;

session_start();
$class = new tabelaJogos();
$participantes = $class->dados['QTD_PARTICIPANTE'];
$varPotenciaMin = 1;
$varPotenciaMax = 2;

//Calcula quais as potências máxima e mínima para cálculo da chave
for ($rodada = 1; $rodada <= 12; $rodada++) {
    if ($participantes <= (pow(2, $rodada))) {
        //Verifica se o número de participantes é uma potência de 2 exata
        if ($participantes == (pow(2, $rodada))) {
            $varPotenciaMax = $rodada;
            $varPotenciaMin = $rodada;
        } else {
            $varPotenciaMax = $rodada;
            $varPotenciaMin = $rodada - 1;
        }
        if ($varPotenciaMin < 1) {
            $varPotenciaMin = 1;
        }
        break;
    }
}

//Calcula tamanho da div para impressao
$tamDiv = 180 * ($varPotenciaMax + 1);
//Calcula a quantidade de competidores que irao para a disputa do play-in ($r0)
$playIn = $r0 = ($participantes - pow(2, $varPotenciaMin)) * 2;

/*
 * Calcula a quantidade de rodadas.
 * Ela é calculada pela maior potência encontrada + 1
 */

$qtdRodadas = $varPotenciaMax + 1;
/*
 * Inicializa as variáveis de $jogo, $mudarJogo (controle de jogo por campeonato), de $time e $jogoRodada (controle de jogo por Rodada) .
 * Se a variável $mudaJogo = true, soma-se +1 na variável $jogo
 */

$jogo = 1;
$mudarJogo = false;
$time = 1;
$posicao = 1;
$resultados = "";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head.php';
        ?>
        <link href="../css/estilo_relatorioPrint.css" rel="stylesheet" type="text/css" media="print" />
        <link href="../css/estilo_tabela.css" rel="stylesheet" type="text/css" />            
        <style type="text/css">
            .tbDados{
                width: 100%;
            }
            .tdEscola{
                background-color: #99ccff;
                padding: 1%;                                
                width: 180px;
            }
            .ponto{
                text-align:center;
            }
        </style>
        <script type="text/javascript" src="../js/z_tabelaJogos.js"></script>       
    </head>
    <body class="bodyTabelaJogos">
        <!-- Armazena valores para passar para as súmulas !-->
        <input type='hidden' id='txtIdProva' value='<?= $class->dados['IDPROVA'] ?>' />            
        <input type='hidden' id='txtIdTabela' value='<?= $class->dados['IDTABELA'] ?>' />

        <input type='hidden' id='txtModalidade' value='<?= $class->dados['DESCMODALIDADE'] ?>' />
        <input type='hidden' id='txtPotenciaMax' value='<?= $class->potencia['POTENCIA_MAX'] ?>' />
        <input type='hidden' id='txtPotenciaMin' value='<?= $class->potencia['POTENCIA_MIN'] ?>' />
        <input type='hidden' id='txtQtdParticipante' value='<?= $class->dados['QTD_PARTICIPANTE'] ?>' />
        <input type='hidden' id='txtProva' value='<?= $class->dados['DESCPROVA'] ?>' />
        <input type='hidden' id='txtCategoria' value='<?= $class->dados['DESCCATEGORIA'] ?>' />
        <input type='hidden' id='txtSexo' value='<?= $class->dados['SEXO'] ?>' />
        <input type='hidden' id='txtSigla' value='<?= $class->dados['SIGLA'] ?>' />
        <div class="container">            

<!-- <input type="button" class="pull-right Voltar" style='margin-left:0%' onclick="history.go(-1);" href="gerarTabela.php" /> -->
            <div id='titulo'>
                <h2>
                    Modalidade: <?= $class->dados['DESCMODALIDADE'] ?>
                    &nbsp;|
                    Prova:<?= $class->dados['DESCPROVA'] ?>
                    &nbsp;|
                    Categoria: <?= $class->dados['DESCCATEGORIA'] ?>
                    &nbsp;|
                    Sexo:<?= $class->dados['DESCSEXO'] ?>
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    <a class="Voltar" href="gerarTabela.php"></a>
                </h2>
                <br /><br />
                <span style='font-size:26px' title="Qtde Participante: <?= $class->dados['QTD_PARTICIPANTE'] ?>">Chave:</span>
                <input type="button" class='Imprimir esconde' style='margin-left:15%' onclick='window.print();' value='Imprimir' />
            </div>

            <div id="chave" style="width:auto;margin-bottom: 3%;">
                <?php
                /*
                 * Armazena calculos em input hidden para passar parÃ¢metos para o javascript poder gravar
                 * $playIn = Quantidade de participantes do playin
                 * $rodadas = Quantidade de rodadas
                 * pow(2,$varPotenciaMin) = Quantidade de jogos na Rodada1
                 */
                ?>
                <input type="hidden" id="txtPlayIn" value="<?= $playIn ?>">
                <input type="hidden" id="txtRodadas" value="<?= $qtdRodadas ?>">                
                <input type="hidden" id="txtRodada1" value="<?= pow(2, $varPotenciaMin) ?> ">
                <!-- Monta a chave e a tabela com os valores achados -->
                <table cellspading="0" cellspacing="0" class="tbChave">
                    <tr>
                        <?php
                        for ($rodada = 1; $rodada <= $qtdRodadas; $rodada++) {
                            /* echo "<script language='javascript'>alert($x)</script>"; */
                            $posicao = 1;
                            ?>
                            <td>
                                <table cellspading="0" cellspacing="0"  class="tbChaveRodada">
                                    <thead>
                                        <tr>
                                            <?php
                                            //Exibe Cabeçalho das rodadas
                                            $resultados .= "<tr>";
                                            $thPlacar = $class->getThPlacar($rodada, $qtdRodadas);
                                            echo $thPlacar['th'];
                                            $resultados .= $thPlacar['resultados'];
                                            $resultados .= "</tr>";
                                            ?>
                                        </tr>
                                    </thead>
                                    <!-- Monta cada rodada sozinha, numa tabela individual -->                                
                                    <tr>
                                        <td>
                                            <?php
                                            $contador = 0;
                                            $primeiralinha = true;
                                            $pintalinha = false;
                                            ?>
                                            <table>
                                                <?php
                                                if ($r0 <= 0) {//Caso nao haja necessidade de play-in, faça o seguinte
                                                    for ($y = 1; $y <= (pow(2, $varPotenciaMax) * 2); $y++) {                                                        
                                                        ?>
                                                        <tr>
                                                            <?php
                                                            if ($primeiralinha == true) {
                                                                $pularlinhas = pow(2, $rodada - 1); //Calcula a quantidade de linhas para pular de acordo com a rodada
                                                            } else {
                                                                $pularlinhas = pow(2, $rodada - 1) + (pow(2, $rodada - 1) - 1); //Calcula a quantidade de linhas para pular de acordo com a rodada
                                                            }
                                                            //Verifica qual célula será pintada
                                                            if ($contador == $pularlinhas) {
                                                                $cor = '#99ccff';
                                                                $contador = 0;
                                                                $primeiralinha = false;
                                                                $param = array("rodada" => $rodada, "posicao" => $posicao, "qtdRodadas" => $qtdRodadas);                                                                
                                                                $placar = $class->getPlacar($param);                                                                
                                                                if (!$mudarJogo) {
                                                                    $mudarJogo = true;
                                                                    if ($rodada == $qtdRodadas) {
                                                                        $resultados .= "<tr><td colspan=4 align='center'>";                                                                        
                                                                        $resultados .= $class->getLblChaveEscola($param);
                                                                        $resultados .= "</td>";
                                                                    } else {
                                                                        $resultados .= "<tr><td align='right'>";                                                                        
                                                                        $resultados .= $class->getLblChaveEscola($param);
                                                                        $resultados .= "</td><td align='center'>";
                                                                        $resultados .= $class->getCampoValorResultado($param) . " X ";
                                                                    }
                                                                } else {                                                                    
                                                                    $resultados .= $class->getCampoValorResultado($param) . " </td><td>";                                                                    
                                                                    $resultados .= $class->getLblChaveEscola($param);
                                                                    //$resultados .= "<label align='left' id='lblRodada" . $x . "Time" . $timeRodada . "Tabela'>Indefinido</label>";
                                                                    $resultados .= "</td><td align='center'>&nbsp;&nbsp;";
                                                                    $resultados .= "<a href='#' onclick='Sumula(" . $class->dados['IDTABELA'] . "," . $jogo . "," . $rodada . "," . $posicao . ") '>Jogo " . $jogo . "</a></td></tr>";
                                                                    $mudarJogo = false;
                                                                    $jogo++;
                                                                }

                                                                $time++;
                                                                if ($time > 2) {
                                                                    $time = 1;
                                                                }
                                                                $posicao++;
                                                                if ($rodada != $qtdRodadas) {
                                                                    $ligacoes = "--";
                                                                } else {
                                                                    $ligacoes = "&nbsp;";
                                                                }
                                                            } else {
                                                                $cor = '#ffffff';
                                                                $contador = $contador + 1;
                                                                $ligacoes = "&nbsp;";
                                                                $placar = "";
                                                                $conector = $class->conectores($contador, $pularlinhas, $primeiralinha, $rodada, $y, $playIn);
                                                            }
                                                            ?>
                                                            <td bgcolor="<?= $cor ?>">
                                                                <?= $conector . $placar ?>
                                                            </td>
                                                            <td align="right" width="33">
                                                                <?= $ligacoes . $ligacoes ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else { //Com play-in
                                                    for ($y = 1; $y <= (pow(2, $varPotenciaMax) * 2); $y++) {
                                                        ?>
                                                        <tr>
                                                            <?php
                                                            //Verifica qual célula será pintada
                                                            if ($pintalinha == true) {
                                                                $cor = '#6699ff';
                                                                $pintalinha = false;
                                                                $ligacoes = "----";
                                                                //RODADA 1
                                                                $param = array("rodada" => $rodada, "posicao" => $posicao, "qtdRodadas" => $qtdRodadas);
                                                                $placar = $class->getPlacar($param);
                                                                if ($mudarJogo == false) {
                                                                    $mudarJogo = true;
                                                                    $resultados .= "<tr>";
                                                                    if ($rodada == $qtdRodadas) {
                                                                        $resultados .= "<td colspan=4 align='center'>";
                                                                        $resultados .= $class->getLblChaveEscola($param);
                                                                        //$resultados .= "<label id='lblRodada" . $rodada . "Time" . $posicao . "Tabela'>Indefinido</label>";
                                                                        $resultados .= "</td>";
                                                                    } else {
                                                                        $resultados .= "<td align='right'>";
                                                                        $resultados .= $class->getLblChaveEscola($param);
                                                                        //$resultados .= "<label id='lblRodada" . $rodada . "Time" . $posicao . "Tabela'>Indefinido</label>";
                                                                        $resultados .= "</td>";
                                                                        $resultados .= "<td align='center'>";
                                                                        $resultados .= $class->getCampoValorResultado($param);
                                                                        //$resultados .= "<input type='text' class='textoTabela' id='txtPlacarRodada" . $rodada . "Time" . $posicao . "Tabela' size='2'   onchange='vencedor($rodada,$posicao)'/>";
                                                                        $resultados .= " X ";
                                                                    }
                                                                    //$resultados .= "</tr>";
                                                                } else {
                                                                    $resultados .= $class->getCampoValorResultado($param);
                                                                    //$resultados .= "<input type='text' class='textoTabela' id='txtPlacarRodada" . $rodada . "Time" . $posicao . "Tabela' size='2' onchange='vencedor($rodada,$posicao)'/>";
                                                                    $resultados .= "</td><td>";
                                                                    $resultados .= $class->getLblChaveEscola($param);
                                                                    //$resultados .= "<label align='left' id='lblRodada" . $rodada . "Time" . $posicao . "Tabela'>Indefinido</label>";
                                                                    $resultados .= "</td> <td align='center'>&nbsp;&nbsp;";
                                                                    $resultados .= "<a href='cadastro_sumula.php?txtIdTabela=" . $class->dados['IDTABELA'] . "&txtNumJogo=" . $jogo . "&txtPosicao=" . $rodada . "') '>Jogo " . $jogo . "</a>";
                                                                    $resultados .= "</td></tr>";
                                                                    $mudarJogo = false;
                                                                    $jogo++;
                                                                }
                                                                $time++;
                                                                $posicao++;
                                                                if ($time > 2) {
                                                                    $time = 1;
                                                                }
                                                                if ($rodada != $qtdRodadas) {
                                                                    $ligacoes = "----";
                                                                } else {
                                                                    $ligacoes = "&nbsp;";
                                                                }
                                                            } else {
                                                                $cor = '#ffffff';
                                                                $pintalinha = true;
                                                                $r0--;
                                                                $ligacoes = "&nbsp;";
                                                                $placar = "";
                                                                if ($r0 < 0) {
                                                                    $pintalinha = false;
                                                                }
                                                            }
                                                            ?>
                                                            <td bgcolor="<?= $cor ?>">
                                                                <b>   <?= $placar ?> </b>
                                                            </td>
                                                            <td align="right" width="33">
                                                                <b> <?= $ligacoes ?> </b>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        //  $x++;
                                                    }
                                                }
                                                ?>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                </table>
                <br />                
                <input type='button' style='margin-right:5%'class='Salvar' id='cmdSalvarTabela' value='Gravar' onClick='Gravar(<?= $class->dados['IDPROVA'] ?>)'/>
            </div>
            <hr />
            <?php
//Exibe tabelas de jogos =================================================================================
            ?>  
            <div id='resultados' style='width:500px'>
                <table width='600'>
                    <br>	
                    <span style='font-size:24px'>Resultados: 
                        <input type="button" class='Imprimir' style='margin-left:26.32%'onclick='window.print();' value='Imprimir' />
                        <br />
                        <?php
                        echo $resultados;
                        ?>
                </table>
            </div>
        </div>
    </body>
</html>
<?php

//=======================================================================================================

class tabelaJogos {

    public $request;
    public $lst;
    public $lstEscola;
    public $lstTabela;
    public $dados;
    public $potencia;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        if (!($this->request['txtIdProva'])) {
            header("Location: consultaTabela.php");
        }
        $this->getDados($param);
    }

    private function getDados($param) {
        $param['txtID'] = $this->request['txtIdProva'];
        $this->dados = $this->sql->lstProva($param);
        $this->dados = $this->dados[0];
        $this->dados['QTD_PARTICIPANTE'] = $this->dados['QTDE_INSC_ESC'];
        $this->potencia['QTD_PARTICIPANTE']=$this->dados['QTD_PARTICIPANTE'];
        
        $this->calcularPotencias($param);

        $param = array("txtIdTabela" => $this->request['txtIdTabela'], "txtIdProva" => $this->request['txtIdProva']);
        $this->lstEscola = $this->sql->lstEscola($param); 
        $this->lstTabela = $this->sql->lstTabela($param);
        if ($this->lstTabela[0]['IDTABELA'] > 0) {
            $this->dados['IDTABELA'] = $this->lstTabela[0]['IDTABELA'];
        }else{
           $param['txtIdProva'] = $this->request['txtIdProva'];
           $this->sorteio($param);
        }
        
        /*
          echo "<pre>";
          print_r($this->lstTabela);
          echo "</pre>";
          exit;
         */        
    }
    
    private function sorteio($param) {        
        $param = $this->definirQtdTimesRodada($param);               
        // =====================================
        $this->lstTabela=array();   
        for ($index1 = 0; $index1 < $param['qtdTimesRodada1']; $index1++) {
            $v['ESCOLA']="Indefinido";
            $v['RODADA']="1";
            $v['POSICAO']=($index1+1);
            array_push($this->lstTabela, $v);
        }
          
        $param['qtdTimesRodada2'] = ($param['qtdTimesRodada1']/2)+$param['restoQtdImpar'];
          
        for ($index1 = 0; $index1 < $param['qtdTimesRodada2']; $index1++) {
            $v['ESCOLA']="Indefinido";
            $v['RODADA']="2";
            $v['POSICAO']=($param['qtdTimesRodada2']-($index1));
            array_push($this->lstTabela, $v);
        }          
        
        foreach ($this->lstEscola as $k=> $v) {
            $this->lstTabela[$k]['ESCOLA']=$v['APELIDO'];
            $this->lstTabela[$k]['IDESCOLA']=$v['IDESCOLA'];
        }
        
        
        //echo "<hr />".$this->dados['QTD_PARTICIPANTE']."<hr />";
        /*
        echo "<pre>";
          print_r($this->lstTabela);
          echo "</pre>";
          exit;
        */       
    }
    
    private function definirQtdTimesRodada($param) {
        //$this->dados['QTD_PARTICIPANTE']=19;
        $param['qtdTimesRodada1']=$this->dados['QTD_PARTICIPANTE'];        
        
        $param['qtdTimesRodada1'] = floor(sqrt($param['qtdTimesRodada1']));
        
        $param['restoQtdImpar']=0;
        if (($param['qtdTimesRodada1']%2)>0) {
            $param['qtdTimesRodada1']-=1;
            $param['restoQtdImpar']=1;
        } 
        $param['qtdTimesRodada2']=($param['qtdTimesRodada1']/2);
        $param['qtdTimesRodada2']+=($this->dados['QTD_PARTICIPANTE']-$param['qtdTimesRodada1']);
        
        //$param['qtdTimesRodada2']=(($this->dados['QTD_PARTICIPANTE']-$param['qtdTimesRodada1'])-($param['qtdTimesRodada1']/2))+$param['restoQtdImpar'];
        if (($param['qtdTimesRodada2']%2)>0) {
            $param['qtdTimesRodada2']+=1;
        }
        
        echo $this->dados['QTD_PARTICIPANTE']."<hr /><pre>";
          print_r($param);
          echo "</pre><hr />";
          exit;
        return $param;
    }    

    private function calcularPotencias($param) {
        $this->potencia['POTENCIA_MIN'] = 1;
        $this->potencia['POTENCIA_MAX'] = 2;

//Calcula quais as potencias maxima e minima para calculo da chave
        for ($x = 1; $x <= 12; $x++) {
            if ($this->potencia['QTD_PARTICIPANTE'] <= (pow(2, $x))) {

                //Verifica se o numero de participantes ï¿½ uma potencia de 2 exata
                if ($this->potencia['QTD_PARTICIPANTE'] == (pow(2, $x))) {
                    $this->potencia['POTENCIA_MAX'] = $x;
                    $this->potencia['POTENCIA_MIN'] = $x;
                } else {
                    $this->potencia['POTENCIA_MAX'] = $x;
                    $this->potencia['POTENCIA_MIN'] = $x - 1;
                }
                //NUNCA PODE SER MENOR QUE 1
                if (!($this->potencia['POTENCIA_MIN'] > 0)) {
                    $this->potencia['POTENCIA_MIN'] = 1;
                }
                break;
            }
        }
    }

    public function definirThRodada($param) {
        $retorno = "";
        switch ($param['x']) {
            case ($param['x'] == $param['qtdeRodada']):
                $retorno.="Campe&atilde;o";
                break;
            case ($param['x'] + 1 == $param['qtdeRodada']):
                $retorno.="Final";
                break;
            case ($param['x'] + 2 == $param['qtdeRodada']):
                $retorno.="Semi-Final";
                break;
            case ($param['x'] + 3 == $param['qtdeRodada']):
                $retorno.="Quartas de Final";
                break;
            case ($param['x'] + 4 == $param['qtdeRodada']):
                $retorno.="Oitavas de Final";
                break;
            default:
                $retorno.="Rodada &nbsp;" . $param['x'];
                break;
        }
        return $retorno;
    }

    private function iniciar($param) {
        require_once '../php/sql.php';
        $this->sql = new sql();
        $this->sql->setTipoRetorno("php");
        $this->request = $_POST;
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->request = $_GET;
        }
    }

    public function getPlacar($param) {
        $escola['PLACAR'] = "";
        $escola['ESCOLA'] = "Indefinido";
        foreach ($this->lstTabela as $k => $v) {
            if (($v['RODADA'] == $param['rodada']) && ($v['POSICAO'] == $param['posicao'])) {
                $escola = $v;
            }
        }
        //$retorno = "<label id='lblRodada" . $param['rodada'] . "Time" . $param['posicao'] . "' class='label'>" . $escola['ESCOLA']."_".$param['rodada']."_".$param['posicao']. "</label>";
        /*
        if(($param['posicao']==4)&&($param['rodada']==2)) {
             echo "<hr /><pre>";
          print_r($escola);
          echo "</pre><hr />";
          exit;
        }
        */
        $retorno = "<label id='lblRodada" . $param['rodada'] . "Time" . $param['posicao'] . "' class='label'>" . $escola['ESCOLA']."</label>";
        $display = "";
        if ($param['rodada'] == $param['qtdRodadas']) {
            $display = "display:none;";
        }
        $retorno.="<input value='" . $escola['PLACAR'] . "' onchange='vencedor(" . $param['rodada'] . "," . $param['posicao'] . ")'  size='2' id='txtPlacarRodada" . $param['rodada'] . "Time" . $param['posicao'] . "' class='texto ponto' type='text' maxlength='2' style='" . $display . "'/>";

        return $retorno;
    }

    public function getEscolaRodada($rodada, $posicao) {
        $escola['APELIDO'] = "Indefinido";
        foreach ($this->lstTabela as $k => $v) {
            if (($v['POSICAO'] == $posicao) && ($v['RODADA'] == $rodada)) {
                $escola = $this->lstTabela[$k];
                $escola['APELIDO'] = $escola['ESCOLA'];
            }
        }
        return $escola;
    }

    public function getCampoValor($param) {
        //, "idObj" => "txtPlacarRodada" . $x . "Time" . $posicao . "Tabela"
        $escola['PLACAR'] = "0";
        foreach ($this->lstTabela as $k => $v) {
            if (($v['POSICAO'] == $param['rodada']) && ($v['RODADA'] == $param['posicao'])) {
                $escola = $this->lstTabela[$k];
            }
        }
        $retorno = "<input value='" . $escola['PLACAR'] . "' id='txtPlacarRodada" . $param['rodada'] . "Time" . $param['posicao'] . "Tabela' onchange='vencedor(" . $param['rodada'] . "," . $param['posicao'] . ")' type='text' class='textoTabela' size='2' />";
        return $retorno;
    }

    public function getCampoValorResultado($param) {
        $escola = $param;
        $escola['PLACAR'] = "0";
        //"<input type='text' class='textoTabela' id='txtPlacarRodada" . $x . "Time" . $posicao . "Tabela' size='2'   onchange='vencedor($x,$posicao)'/> X "        
        foreach ($this->lstTabela as $k => $v) {
            if (($v['POSICAO'] == $param['posicao']) && ($v['RODADA'] == $param['rodada'])) {
                $escola = $this->lstTabela[$k];
            }
        }        
        $retorno = "<input value='" . $escola['PLACAR'] . "' id='txtPlacarRodada" . $param['rodada'] . "Time" . $param['posicao'] . "Tabela' style='text-align:center;' readonly=='readonly' type='text' class='textoTabela' size='2'/>";
        $retorno .= "<input value='" . $escola['IDESCOLA'] . "' id='txtPlacarRodada" . $param['rodada'] . "Time" . $param['posicao'] . "_hdd' type='hidden'/>";
        return $retorno;
    }

    public function getLblChaveEscola($param) {
        /*
          echo "<pre>";
          print_r($param);
          echo "</pre>";
          exit;
         */
        $escola['ESCOLA'] = "Indefinido";
        foreach ($this->lstTabela as $k => $v) {
            if (($v['POSICAO'] == $param['posicao']) && ($v['RODADA'] == $param['rodada'])) {
                $escola = $this->lstTabela[$k];
            }
        }

        return "<label id='lblRodada" . $param['rodada'] . "Time" . $param['posicao'] . "Tabela' class='' />" . $escola['ESCOLA'] . "</label>";
    }

    public function getThPlacar($x, $rodadas) {
        $retorno['th'] = "<th bgcolor='#99ccff' style='text-align:center;'>";
        switch ($x) {
            case $x == $rodadas:
                $retorno['th'].="Campe&atilde;o</th>";
                $retorno['resultados'] = "<td  style='border-top:solid;' bgcolor='#99ccff' colspan=4><center><b>Campe&atilde;o</b></center></td>";
                break;
            case $x + 1 == $rodadas:
                $retorno['th'].="Final</th>";
                $retorno['resultados'] = "<td  style='border-top:solid;' bgcolor='#99ccff' colspan=4><center><b>Final</b></center></td>";
                break;
            case $x + 2 == $rodadas:
                $retorno['th'].="Semi-Final</th>";
                $retorno['resultados'] = "<td  style='border-top:solid;' bgcolor='#99ccff' colspan=4><center><b>Semi-Final</b></center></td>";
                break;
            case $x + 3 == $rodadas:
                $retorno['th'].="Quartas de Final</th>";
                $retorno['resultados'] = "<td  style='border-top:solid;' bgcolor='#99ccff' colspan=4><center><b>Quartas de Final</b></center></td>";
                break;
            default:
                $retorno['th'].="Rodada&nbsp;<?= $x ?></th>";
                $retorno['resultados'] = "<td  style='border-top:solid;' bgcolor='#99ccff' colspan=4><center><b>Rodada&nbsp;<?= $x ?></b></center></td>";
                break;
        }
        return $retorno;
    }

    public function conectores($contador, $pularlinhas, $primeiralinha, $x, $y, $playIn) {
        /* Exibe conexoes dos jogos
         * Utiliza para cálculo as variáveis:
         * $contador => Contagem das linhas
         * $pularlinhas => Quantidade de linhas que serao puladas até que a próxima célula seja pintada
         * $primeiralinha => Verificador de início de tabela
         * $x => Número da rodada atualmente sendo desenhada
         * $y => Número da linha atualmente sendo desenhada
         * $playIn => Quantidade de participantes da prérodada (Rodada inicial) 
         */

        if ($x > 1) {
            if (($x == 2 && $playIn * 2 >= $y) || ($x > 2) || $playIn == 0) {
                if ($contador == $pularlinhas) {
                    $conector = "<label>|</label>";
                } else {
                    if (($contador == 1) && ($primeiralinha == false)) {
                        $conector = "|";
                    } else {
                        if ($contador > ($pularlinhas / 2) && $primeiralinha == true) {
                            $conector = "|";
                        } else {
                            if (($contador > (($pularlinhas / 4) * 3) && $primeiralinha == false)) {
                                $conector = "|";
                            } else {
                                if (($contador < ($pularlinhas / 4) + 1 && $primeiralinha == false)) {
                                    $conector = "|";
                                } else {
                                    $conector = "&nbsp;";
                                }
                            }
                        }
                    }
                }
            }
        } else {
            $conector = "&nbsp;";
        }
        return $conector;
    }

}
?>
