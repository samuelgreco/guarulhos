<?php
session_start();
$class = new inscreveAluno();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>
        <link href="../css/estilo_relatorioPrint.css" rel="stylesheet" type="text/css" media="print" />
        <script type="text/javascript" src="../js/inscreveAluno.js"></script>
        <style>
            .bodyInscreveAluno{
                margin: 1%;
            }

            .bodyInscreveAluno .tbInformacaoProva{
                width: 100%;
                font-size: large;
            }
            .bodyInscreveAluno .tbInformacaoProva th{
                font-weight: bolder;
                width: 15%;
                text-align: left;
            }
            .Imprimir{
                width: auto;
            }
            .tdInscrever,.tdInscrito{
                text-align: center;
                width: 8%;
            }
            .txtQtdeProva,.txtQtdeEscola{
                width: 80px;
            }
            .Voltar{
                margin-right:25%;
                padding-bottom:2%;
            }
        </style>
    </head>
    <body class="bodyInscreveAluno">
        <div class="container">
            <h1 style='display:inline'>
                Escola:<?= utf8_encode($class->prova['NOMEESCOLA']);
        ?>
            </h1>            
            <a class="pull-right Voltar esconde" href="selecionaProva.php?txtIdEscola=<?=$class->request['txtIdEscola']?>" />
            
            <td width=100 align='right'>
                <?php
                $urlPrint = "../relatorios/relProtocoloInscricao.php?";
                $urlPrint.="txtIdEscola=" . $_GET['txtIdEscola'];
                $urlPrint.="&txtIdProvaInscricao=" . $class->prova['IDPROVA'];
                ?>
       
                <a target='_blank' href="<?php echo $urlPrint; ?>">
                    <img style='margin-left:20%'src='../imagem/protocolo.png'/>
                </a>
                <b>Imprimir Ficha</b>
       
           </td>
            <table class="tbInformacaoProva">
                <tbody>
                    <tr>
                        <th>Modalidade:</th>
                        <td><?= utf8_encode($class->prova['DESCMODALIDADE']) ?> </td>
                    </tr>
                    <tr>
                        <th>Categoria:</th>
                        <td><?= utf8_encode($class->prova['DESCCATEGORIA']) ?></td>
                    </tr>                  
                    <tr>
                        <th>Prova:</th>
                        <td><?= utf8_encode($class->prova['DESCPROVA']) ?></td>
                    </tr>
                    <tr>
                        <th>Sexo:</th>
                        <td><?= utf8_encode($class->prova['SEXO']) ?></td>
                    </tr>
                    <tr>
                        <th>Tipo:</th>
                        <td><?= utf8_encode($class->prova['DESCRICAO']) ?></td>
                    </tr>
                    <tr>
                        <th>Vagas:</th>
                        <td>
                            <input type='number' style='width:50px; text-align:center;' id='txtQtdeProva' class="txtQtdeProva" value="<?= $class->prova['QTDMAXPARTICIPANTE'] ?>" readonly="readonly"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Inscritos:</th>
                        <td>
                            <input type='number' style='width:50px;text-align:center;' id='txtQtdeEscola' class="txtQtdeEscola" value="<?= $class->prova['QTD_INSCRITO'] ?>"  readonly="readonly"/>
                        </td>
                    </tr>                
                    <tr>
                        <th>Vagas Livres:</th>
                        <td>
                            <input type='number' style='width:50px;text-align:center;' id='txtVagas'  value="<?= ($class->prova['QTDMAXPARTICIPANTE']) - $class->prova['QTD_INSCRITO'] ?>"  readonly="readonly"/>
                        </td>
                    </tr>                
                </tbody>


            </table>

            <h1>
                Inscri&ccedil;&atilde;o de aluno
            </h1>
            <div style='width:70%'>
                <table style="width:100%" border="0" class="display" id="tabela" >
                    <caption>                                        
                        <?php
                        if ($varQuantidades['escola'] > $varQuantidades['prova']) {
                            ?>
                            <h3 title="escola: <?php echo ($varQuantidades['escola'] - 1); ?>; prova: <?php echo $varQuantidades['prova']; ?>.">
                                Quantidade de inscritos atingida
                            </h3>
                            <?php
                        }
                        ?>
                    </caption>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Idade</th>
                            <th>Inscri&ccedil;&atilde;o</th>
                            <th align="center">A&ccedil;&atilde;o</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($class->lst as $k => $v) {
                            //$v['quantidades'] = $varQuantidades;
                            /* echo "<pre>";
                              print_r($v);
                              echo "</pre>"; */
                            ?>
                            <tr>
                                <td>
                                    <?= utf8_encode($v['NOMEALUNO']) ?>
                                </td>
                                <td>
                                    <?= $v['IDADE'] ?>&nbsp;(<?= $v['DTNASC'] ?>)
                                </td>
                                <td class="tdInscrito"  id="tdInscrito_<?= $class->prova['IDPROVA'] ?>_<?= $v['IDESCOLA'] ?>_<?= $v['IDALUNO'] ?>">
                                    <?= $class->colunaInscrito($v) ?>
                                </td>
                                <td class="tdInscrever" id="tdInscrever_<?= $class->prova['IDPROVA'] ?>_<?= $v['IDESCOLA'] ?>_<?= $v['IDALUNO'] ?>" class="tdInscrito">
                                    <?= $class->colunaInscrever($v) ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<?php

class inscreveAluno {

    public $request;
    public $lst;
    public $lstQuantidade;
    public $prova;
    public $trava;
    public $sql;
    public $dados;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
    }

    private function getDados($param) {
        $param = array("txtID" => $this->request['txtIdProva'], "txtIdEscola" => $this->request['txtIdEscola']);
        $this->prova = $this->sql->lstProvaEscola($param);
        /*
        echo "<pre>";
          print_r($this->prova);
          echo "</pre>";
          exit;
          */
        $this->prova = $this->prova[0];
          
        if (!($this->prova['QTD_INSCRITO'] > 0)) {
            $this->prova['QTD_INSCRITO'] = 0;
        }

        $param = array();
        $this->trava = $this->sql->lstTrava($param);
        $this->trava = $this->trava[0];

        $param = array("txtIdProvaInscricao" => $this->request['txtIdProva']);
        $param['txtIdCategoria'] = $this->prova['IDCATEGORIA'];
        $param['txtIdEscola'] = $this->request['txtIdEscola'];
        $param['txtIdadeMax'] = ($this->prova['IDADE_MAX']+2);
        $param['txtIdadeMin'] = $this->prova['IDADE_MIN'];
        
        $this->lst = $this->sql->lstAlunoInscrito($param);
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

    public function colunaInscrito($v) {
        /*
          echo "<pre>";
          print_r($v);
          echo "</pre>";
         */
        if ($v['IDINSCRICAO'] > 0) {
            return "<img alt='Inscrito' src='../imagem/check.png' />";
        } else {
            return ".";
        }
    }

    public function colunaInscrever($v) {
/*
          echo "<pre>";
          print_r($v);
          echo "</pre>";
          
          echo "<hr /><hr /><pre>";
          print_r($this->prova);
          echo "</pre>";
          
          echo "<hr /><hr /><pre>";
          print_r($this->trava);
          echo "</pre>";

          exit;           
           */

        if (($this->trava['ALUNOEXCLUSAO'] == 1) && ($v['IDINSCRICAO'] > 0)) {
            return "<img onclick='excluir(" . $this->prova['IDPROVA'] . "," . $v['IDESCOLA'] . "," . $v['IDALUNO'] . ")' width='40' src='../imagem/Excluir.png' alt='Excluir Incrição'>";
        }

        if (($this->trava['ALUNOEXCLUSAO'] == 0) && ($v['IDINSCRICAO'] > 0)) {
            return "<img alt='Inscrito' src='../imagem/check.png' />";
        }

        if (($this->trava['ALUNOINSCRICAO'] == 1) && (!($v['IDINSCRICAO'] > 0))) {
            //return ".;.<img alt='Inscrito' src='../imagem/check.png' />".$this->prova['QTD_INSCRITO']."===>".$this->prova['QTDMAXPARTICIPANTE'];
            if ($this->prova['QTD_INSCRITO'] < $this->prova['QTDMAXPARTICIPANTE']) {
                $td = "<a href='javascript:inscrever(" . $this->prova['IDPROVA'] . "," . $v['IDESCOLA'] . "," . $v['IDALUNO'] . ");'>";
                $td.="<img width=40 alt='Inscrever' src='../imagem/Inscrever.png'></a>";
                return $td;
            }
        }

        if ($this->trava['ALUNOINSCRICAO'] == 1) {
            //return "<pre>".print_r($this->trava)."</pre>";
        }

        return "Encerrado";
    }

    public function urlImprimir($param) {
        $urlPrint = "../relatorios/relProtocoloInscricao.php?&txtIdEscola=" . $this->request['txtIdEscola'];
        $urlPrint.="&txtIdProva=" . $this->request['txtIdProva'];
        return $urlPrint;
    }

}

// FIM DA CLASSE
?>