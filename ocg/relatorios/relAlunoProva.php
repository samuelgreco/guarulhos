<?php
session_start();
$class = new relAlunoProva();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <link href="../css/style.css" rel="stylesheet" type="text/css" />
   		<link href="../css/estilo_relatorio.css" rel="stylesheet" type="text/css" />
	    <link href="../css/estilo_relatorioPrint.css" rel="stylesheet" type="text/css" media="print" />
	    <link charset="utf-8" type="text/css" rel="stylesheet" href="../../../lib/css/estilo.css" />
    </head>
    <body>			 
        <input type="button" class="Imprimir esconde" onclick="window.print();" value="Imprimir" />
        <table width=700>
            <tr>
                <td width=130><div align=center><img src='../imagem/ocg.png' width=71></div></td>
                <td class=corpo width=440 height=38><center><b><font size=6>Alunos por Prova</font></b></center>
                    <div align=center><i>Lista de participantes por prova</i></div></td>
                <td width=130 height=38></td>
            </tr>
        </table>
        <br />
        <div style="margin-left: 30%;">
            Relat&oacute;rio gerado em <?= date("d/m/Y H:i:s") ?>
        </div>
        <table width=700>
            <thead>
                <tr>
                    <th colspan=3><h2><?= utf8_encode($varCabecalho[0]['prova']) ?></h2></th>
                </tr>
                <tr>
                    <th width=50px class=tabela>N&deg;</th>
                    <th width=349px class=tabela>Aluno</th>
                    <th width=349px class=tabela>Escola</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($class->lst as $k => $v) {
                    if (($i + 1) % 2 == 0) {
                        $cor = "impar";
                    } else {
                        $cor = "par";
                    }
                    ?>
                    <tr>
                        <td class='<?= $cor ?>' style="text-align:center;">                                 
                            <?= ($k + 1) ?>
                        </td>
                        <td class="<?= $cor ?>">
                            <?= utf8_encode($v['NOME_ALUNO']) ?>
                        </td>
                        <td class="<?= $cor ?>">
                            <?= utf8_encode($v['NOME_ESCOLA']) ?>
                        </td>
                    </tr>

                    <?php
                }
                ?>
            </tbody>
        </table>
        <table style="border: solid #CCCCCC;">
        	<tbody >
        	<tr>
        		<td colspan="2" style="width: 380px; text-align: center;">
        			Total de Alunos: <?= ($k + 1) ?>
        		</td>
        	</tr>
        	</tbody>
        </table>
        <br />
        <div style="margin-left: 30%;">
            Relat&oacute;rio gerado em <?= date("d/m/Y H:i:s") ?>
        </div>
    </body>
</html>
<?php

class relAlunoProva {

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
        //$varConteudo = ConsultaConteudo($_POST["cboProva"]);
        //$varCabecalho = ConsultaCabecaclho($_POST["cboProva"]);
        $param = array("txtIdEscola" => $_SESSION['varIDEscola']);
        $this->lst = $this->sql->consultaConteudoRelProvaEscola($param);
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