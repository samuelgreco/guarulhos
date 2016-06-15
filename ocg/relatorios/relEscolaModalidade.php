<?php
session_start();
$class = new relEscolaModalidade();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <link href="../css/style.css" rel="stylesheet" type="text/css" />
    	<link href="../css/estilo_relatorio.css" rel="stylesheet" type="text/css" />
	    <link href="../css/estilo_relatorioPrint.css" rel="stylesheet" type="text/css" media="print" />
	    <link charset="utf-8" type="text/css" rel="stylesheet" href="../../../lib/css/estilo.css" />
	    <style>
		    .bodyEscolaModalidade{
	    		padding-left: 20px;
				width:800px; 
			}
			.tbDados{
        		width: 100%;
        	}
        	.margem{
        		margin-left: 100%;
        	}
		</style>
    </head>
    <body class="bodyEscolaModalidade">
        <input type="button" href='#' class="Imprimir esconde margem" onclick='window.print();' value="Imprimir" />
        <table>
            <tr>
                <td><img src='../imagem/ocg.png' width=71></td>
                <td class="corpo">
                	<center>
                		<b><font size=6>Provas / Escola</font></b>
                		 <div align=center><i>Quantidade de Provas por Escolas</i></div>
                	</center>
                </td>
            </tr>
        </table>
        <br />
        <table class="tbDados">
            <thead>
                <tr>
                    <th class=tabela>Escola</th>
                    <th class=tabela>Total de provas</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($class->lst as $k => $v) {
                    if (($i + 1) % 2) {$cor = "impar";} else {$cor = "par";}
                    ?>
                    <tr>
                        <td class=" . $cor . "><?= utf8_encode($v['apelidoEscola']) ?>
                        </td>
                        <td class="<?= $cor ?>">
                            <center>
                                <?= $v['qtde'] ?>
                            </center>
                        </td>			
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <br />
        <div class=data align="center">
            Relat&oacute;rio gerado em <?= date("d/m/Y H:i:s") ?>
        </div>
    </body>
</html>

<?php

class relEscolaModalidade {

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