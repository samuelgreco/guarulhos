<?php
session_start();
$class = new fichaIndividualAtletismoPista();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <style type=text/css>
            .par{
                background-color: #CCCCCC;
                font: 12px verdana, arial, helvetica, sans-serif;
                color: #666666;
                border:1px solid  #CCCCCC;
                border-bottom-style: outset;
                margin-top:7px;
                margin-right: 15px;
                height:18px;
                width: auto;
            }
            .impar{
                background-color: white;
                font: 12px verdana, arial, helvetica, sans-serif;
                color: #666666;
                border:1px solid  #CCCCCC;
                border-bottom-style: outset;
                margin-top:7px;
                margin-right: 15px;
                height:18px;
                width: auto;
            }		
            .tabela{
                background-color: #AAAAAA;
                font: 20px verdana, arial, helvetica, sans-serif;
                color: black;
                border:1px solid  #CCCCCC;
                border-bottom-style: outset;
                margin-top:7px;
                margin-right: 15px;
                width: auto;	
            }
            .corpo{
                font: 12px verdana, arial, helvetica, sans-serif;
                width: 100%;	
            }	
        </style>

        <style type=text/css media='print'>
            #landscape { 
                writing-mode: tb-rl;
                height: 80%;
                margin: 10% 0%;
            }

            .esconde{
                visibility: hidden;
            }
            .par{
                background-color: #CCCCCC;
                font: 12px verdana, arial, helvetica, sans-serif;
                color: #666666;
                border:1px solid  #CCCCCC;
                border-bottom-style: outset;
                margin-top:7px;
                margin-right: 15px;
                height:18px;
                width: auto;
            }
            .impar{
                background-color: white;
                font: 12px verdana, arial, helvetica, sans-serif;
                color: #666666;
                border:1px solid  #CCCCCC;
                border-bottom-style: outset;
                margin-top:7px;
                margin-right: 15px;
                height:18px;
                width: auto;
            }		
            .tabela{
                background-color: #AAAAAA;
                font: 20px verdana, arial, helvetica, sans-serif;
                color: black;
                border:1px solid  #000000;
                border-bottom-style: outset;
                margin-top:7px;
                margin-right: 15px;
                width: auto;	
            }
            .corpo{
                font: 12px verdana, arial, helvetica, sans-serif;
                width: 100%;	
            }	
        </style>	
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    </head>
    <body>
        <a href='#' class=esconde onclick='window.print();'>[Imprimir Lista]</a>
        <br />
        <?php
        foreach ($class->lst as $k => $v) {
            ?>
            <table border=5 bordercolor=black width=600>
                <tr height=50 ><td width=150>
                        <center><img src='../imagem/OCG.png' width=80>
                        </center>
                    </td>
                    <td colspan=3>
                        <center>
                            <h2>
                                Olimp&iacute;ada Colegial Guarulhense
                            </h2>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td width=150>S&eacute;rie:
                    </td>
                    <td colspan=3 >Raia:
                    </td>
                </tr>
                <tr height=50>
                    <td width=150>&nbsp;
                    </td>
                    <td width=150>&nbsp;
                    </td>
                    <td width=150>&nbsp;
                    </td>
                    <td width=150>&nbsp;
                    </td>
                </tr>
                <tr>
                    <td>N. Prova: <br>.
                    </td>
                    <td colspan=3 >Prova: <br> <?= utf8_encode($v['DESC_PROVA']) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan=3 >Nome: <?= utf8_encode($v['NOME_ALUNO']) ?> 
                    </td>
                    <td><?= utf8_encode($v['DESC_CATEGORIA']) ?> / " . <?= utf8_encode($v['SEXO']) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan=4 >Escola: <?= utf8_encode($v['NOME_ESCOLA']) ?> 
                    </td>
                </tr>
                <tr height=50 ><td colspan=2 >Tempo:<br>.
                    </td>
                    <td colspan=2 >Resultado:<br>.
                    </td>
                </tr>
            </table>
            ----------------------------------------------------------------------------------------------------
            <?php
            $i++;
            if ($i % 3 == 0) {
                $useragent = $_SERVER['HTTP_USER_AGENT'];

                if (preg_match('|MSIE ([0-9].[0-9]{1,2})|', $useragent, $matched)) {
                    echo "<br /><br /><br /><br /><br />";
                } elseif (preg_match('|Firefox/([0-9\.]+)|', $useragent, $matched)) {
                    echo "<br><br>";
                } elseif (preg_match('|Chrome/([0-9\.]+)|', $useragent, $matched)) {
                    echo "<br><br>";
                } else {
                    echo "<br><br>";
                }
            }
        }
        ?>

    </body>
</html>
<?php

class fichaIndividualAtletismoPista {

    public $request;
    public $lst;
    public $dados;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        //$varConteudo = ConsultaConteudo($_POST['cboProva']);
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