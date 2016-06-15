<?php
session_start();
$class = new relContatoEscola();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	    <link href="../css/estilo_relatorio.css" rel="stylesheet" type="text/css" />
	    <link href="../css/style.css" rel="stylesheet" type="text/css" />
	    <link href="../css/estilo_relatorioPrint.css" rel="stylesheet" type="text/css" media="print" />
	    <link charset="utf-8" type="text/css" rel="stylesheet" href="../../../lib/css/estilo.css" />
	    <style type="">
	    .bodyRelContantoEscola {
    		padding-left: 20px;
    		width:880px;
		}
		.tdTabela{
			width:25%;
			}
	    </style>
    </head>
    <body class="bodyRelContantoEscola">
        <input type="button"  class="Imprimir esconde" onclick="window.print();" value="Imprimir" style="margin-left:73%;" />
          <input type="button" class="Voltar" style='margin-left:5%' onclick="history.go(-1);" />
        <table>
            <tr>
                <td><div><img src='../imagem/ocg.png' width=71></div></td>
                <td class=corpo align="center" >
               		<b><font size=6>Contato das Escolas</font></b>
                    <div align=center>
                    	<i>Lista de contatos de professores responsáveis por Escolas</i>
                    </div>
                 </td>
            </tr>
        </table>
        <br />
        <table>
            <thead>
                <tr>
                    <th class=tabela>Escola</th>
                    <th class=tabela>Diretor</th>
                    <th class=tabela>Contato Prof.</th>
                    <th class=tabela>Tel. Escola</th>

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
                    <tr align="center" style='background-color:#cccccc'>
                        <td style='background-color:#cccccc' class=" <?= $cor ?> tdTabela" >
                          <b>  <?= utf8_encode($v['NOME']) ?> </b>
                        </td>
                        <td style='background-color:#cccccc'class=" <?= $cor ?> tdTabela">
                            <?= utf8_encode($v['DIRETOR_NOME']) ?>
                        </td>                                                
                        <td style='background-color:#cccccc' class=" <?= $cor ?> tdTabela">
                           	<?= utf8_encode($v['TELEFONE2']) ?>
                           	<br />
                           	<?= utf8_encode($v['EMAIL']) ?>
                        </td>
                        <td style='background-color:#cccccc' class=" <?= $cor ?> tdTabela">
                           	<?= utf8_encode($v['TELEFONE1']) ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <br />
        <div align="center">
            Relat&oacute;rio gerado em <?= date("d/m/Y H:i:s") ?>
        </div>
    </body>
</html>
<?php

class relContatoEscola {

    public $request;
    public $lst;
    public $dados;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
        /*
          echo "<hr /><pre>";
          print_r($this->lst);
          echo "</pre><hr />";
          exit;
         */
    }

    private function getDados($param) {
       // $param = array("txtIdEscola" => $_SESSION['varIDEscola']);
        $this->lst = $this->sql->lstEscola($param);
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