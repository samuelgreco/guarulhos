<?php
session_start();
$class = new gerarTabela();
//$varEscola = $_GET[nome];
//$varIDEscola = $_GET[idEscola];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>        
        <?php
        require_once 'head_lst.php';
        ?>
        <script type="text/javascript" src="../js/gerarTabela.js"></script>
        <style type="">
            .tbDados{
                width: 100%
            }
            .imgTabela{
            	width: 30px;
            }
        </style>
    </head>
    <body class="bodyGerarTabela">
        <div class="container">
            <?php
            //echo "<h1>Escola: " . $varEscola . "</h1>";
            ?>          
 		  <h1>
	        Escolha a prova desejada para gerar a tabela:
	        <input type="button" class="Voltar" style='margin-left:39%' onclick="history.go(-1);" />
          </h1>
          <br>	        
          <table class="display" id="tabela"  > 
                    <thead>
                    <tr>
                        <th width="20%">Prova</th>
                        <th style='text-align:center' width="15%">Modalidade</th>
                        <th style='text-align:center' width="15%">Categoria</th>
                        <th style='text-align:center' width="12%">Sexo</th>
                        <th style='text-align:center' width="12%">Qtde particip.</th>
                        <th width="6%">Tabela</th>
                        <th width="6%">Excluir</th>
                    </tr>
                    </thead>
               <tbody>
                    <?php
                    $varUltimaMod = "";
                    $anterior = 0;
                    foreach ($class->lst as $k => $v) {


                        if ($v['IDMODALIDADE'] != $varUltimaMod) {
                            ?>
                            <tr>
                                <td colspan=5>
                                    <h2><?= utf8_encode($v['DESCMODALIDADE']) ?></h2>
                                </td>
                            </tr>

                            <?php
                            $varUltimaMod = $v['IDMODALIDADE'];
                        }
                        ?>
                        <!-- ================================= DADOS DA TABELA ======================== -->
                        <?php
                        if ($anterior != $v['IDPROVA']) {
                            ?>
                            <?php
                            if ($v['QTDE'] != 0 || $v['QTDE'] != null){
                            	?>
                            	
                        	<tr id="linha<?= $v['IDTABELA'] ?>">
                                <td style='vertical-align: middle; padding:12px;'>
                                  <b>  <?= strtoupper(utf8_encode($v['DESCPROVA'])) ?>  </b>
                                </td>
                                <td style='vertical-align: middle; padding:12px;text-align:center'>
                                    <?= strtoupper(utf8_encode($v['DESCMODALIDADE'])) ?>
                                </td>
                                <td style='vertical-align: middle;text-align:center'> 
                                    <?= strtoupper(utf8_encode($v['DESCCATEGORIA'])) ?>
                                </td>
                                <td style='vertical-align: middle;text-align:center'>
                                    <?= $v['DESCSEXO'] ?>
                                </td>
                                <td style='text-align:center;text-align:center'>
                                    <?= $v['QTDE'] ?>
                                </td>
                                <?php
                                $urlGerarTabela = "../formularios/tabelaJogos.php?txtIdProva=" . $v['IDPROVA'];
                                if ($v['IDTABELA'] > 0) {
                                    $urlGerarTabela .= "&txtIdTabela=" . $v['IDTABELA'];
                                }
                                ?>
                                <td style='text-align:center'>
                                    <a href="<?= $urlGerarTabela ?>"> 
                                        <img class="imgTabela" alt='Gerar Tabela' src='../imagem/chaves.png' />
                                    </a>
                                </td>
                                <td style='text-align:center'>
                                    <?php
                                    if ($v['IDTABELA'] > 0) {
                                        ?>
                                        <a href= '#' id="btnExcluir<?= $v['IDTABELA'] ?>" class='Remover' onclick="excluir(<?= $v['IDTABELA'] ?>);">&nbsp;</a>
                                        <?php
                                    }
                            }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            $anterior = $v['IDPROVA'];
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
<?php

class gerarTabela {

    public $request;
    public $lst;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
    }

    private function getDados($param) {
        $this->lst = $this->sql->lstTabela($param);
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

}
?>