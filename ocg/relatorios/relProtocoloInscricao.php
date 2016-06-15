<?php
session_start();
$class = new relProtocoloInscricao();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <link href="../css/estilo_relatorio.css" rel="stylesheet" type="text/css" />
        <link href="../css/estilo_relatorioPrint.css" rel="stylesheet" type="text/css" media="print" />
        <link charset="utf-8" type="text/css" rel="stylesheet" href="../../../lib/css/estilo.css" />
        <style>
        	.bodyProtocoloInscricao{
    			padding-left: 20px;
				width:900px; 
			}
        	.tbDados{
        		width: 100%;
        	}
        	.margem{
        		margin-bottom:5%; 
        	}
        </style>
    </head>
    <body class="bodyProtocoloInscricao">
        <div>
            <input type='button' href='#' class='Imprimir esconde' value='Imprimir' onclick='window.print()' style='margin-left:79%;' />
            <!-- <input type="button" class="Voltar esconde" onclick="history.go(-1);" /> -->
        <h2>
            Escola: <?= utf8_encode($class->prova['NOMEESCOLA']) ?>
            <br /><br />
            Modalidade:<?= utf8_encode($class->prova['DESCMODALIDADE']) ?>  | Prova:  <?= utf8_encode($class->prova['DESCPROVA']) ?>  | Categoria: <?= utf8_encode($class->prova['DESCCATEGORIA']) ?>  | Sexo: <?= $class->prova['SEXO'] ?>
        </h2>
        </div>
        <div>
            <table>
                <tr>
                    <td>
                    	<img src='../imagem/ocg.png' width="71" />
                    </td>
                    <td>
                    	<h3>Ficha de Inscri&ccedil;&atilde;o</h3>
                    </td>
                </tr>
            </table>
            <div class="margem" align="center">
            	<i><b>Lista de inscritos em Prova</b></i>
            </div>
            <table class="tbDados margem" >                
                <tr>
                    <td>                        
                        <b> Professor respons&aacute;vel:</b><br />                         
                        <?= utf8_encode($class->prova['NOME_PROFESSOR']) ?>
                    </td>
                    <td>
                        <b>CPF:</b><br />
                        <?= $class->prova['CPF_PROFESSOR'] ?>
                    </td>
                </tr>
                <tr>
                    <td> 
                        <b>Telefone contato:</b><br />
                        <?= $class->prova['TEL_PROFESSOR'] ?>
                    </td>
                    <td>
                        <b>E-mail:</b><br />
                        <?= strtolower($class->prova['EMAIL_PROFESSOR']) ?>
                    </td>
                </tr>                
                <?php
                //PRINT_r($class->prova);
                //$varConteudo = ConsultaConteudo($varIDProva, $varIDEscola);

                $i = 0;
                $varPosicao = 0;
                $ultimoIDTurma = 0;
                ?>
                <table class="tbDados">
                    <thead>
                        <tr style="background:#3A9FBD">
                            <th class=tabela>Nome</th>
                            <th class=tabela>RG</th>
                            <th class=tabela>Data Nasc.</th>
                            <th class=tabela>Idade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($class->lst as $k => $v) {
                            if (($i + 1) % 2) {
                                $cor = "impar";
                            } else {
                                $cor = "par";
                            }
                            ?>
                            <tr>
                                <td style='text-align:center' class=<?= $cor ?>>
                                    <?= utf8_encode($v['NOMEALUNO']) ?>
                                </td>
                                <td style='text-align:center' class=<?= $cor ?>>
                                    <?= $v['RG'] ?>
                                </td>
                                <td style='text-align:center' class=<?= $cor ?>>
                                    <?= $v['DTNASC'] ?>
                                </td>
                                <td style='text-align:center' class=<?= $cor ?>>
                                    <?= 2016 - $v['DTIDADE'] ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                //foreach ($class->lst as $k => $v) {
                ?>
                <table class="tbDados margem" style='margin-top: 12%;'>
                    <tr>
                        <td>
                            <center>_____________________________________________</center>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center><?= utf8_encode($v['NOMEESCOLA']) ?></center>
                        </td>
                    </tr>
                </table>
                <?php
                //	}
                ?>
                <br />
                <div class="data">
                    Relat&oacute;rio gerado em <?= date("d/m/Y H:i:s") ?>
                </div>
            </table> 
        </div>      
    </body>
</html>

<?php

class relProtocoloInscricao {

    public $request;
    public $lst;
    public $prova;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);        
    }

    private function getDados($param) {
        $param = array("txtID" => $this->request['txtIdProvaInscricao'], "txtIdEscola" => $this->request['txtIdEscola']);
        $this->prova = $this->sql->lstProvaEscola($param);
        $this->prova = $this->prova[0];
        /*
        echo "<hr /><pre>";
        print_r($this->prova);
        echo "</pre><hr />";
        exit;
        */
        $this->lst = $this->sql->lstAlunoInscrito($this->request);
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

// FIM DA CLASSE
?>