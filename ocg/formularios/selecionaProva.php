<?php
session_start();
$class = new selecionaProva();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>        
        <?php
        require_once 'head_lst.php';
       // PRINT_R($_GET);
        ?>
        <link href="../css/estilo_relatorioPrint.css" rel="stylesheet" type="text/css" media="print" />
        <style>
            .container{
                width: 100%;
            }
            .Voltar{
                margin-right:20%;
                padding-bottom:2%;
                margin-top:5%;
            }
        </style>
        <script type="text/javascript" src="../js/selecionaProva.js"></script>         
    </head>
    <body>

        <div class="container">
            <h1 style='display:inline'>
                Escola: <?= utf8_encode($class->dados['NOMEESCOLA']) ?>
            </h1>            
            <input type='button' style='margin-left:20%;margin-top:5%' class='Imprimir esconde' value='Imprimir' onclick='window.print()' />            
            <a class="pull-right Voltar" href="acessoEscola.php" >&nbsp;</a>
            <!--            
            -->
            <br />
            <table style="width:100%;">
                <tr>
                    <td>
                        <h2 style='margin-left:-1%'>
                            Escolha a prova desejada para inscrever os alunos:
                        </h2>
                        <br /><br /><br />
                    </td>
                </tr>
            </table>
            <table style="width:80%;" id="tabela">
                <tbody>
                    <?php
                    $i = 0;
                    $varUltimaMod = "";
                    foreach ($class->lst as $k => $v) {
                        /*
                          echo "<pre>";
                          print_r($v);
                          echo "</pre>";
                          exit;
                         */
                        $linhas = "";
                        if (($v['DESCMODALIDADE']) != $varUltimaMod) {
                            ?>
                            <tr>
                                <td colspan=4  >
                                    <h2>
                                        <?= utf8_encode($v['DESCMODALIDADE']) ?> 
                                    </h2>
                                </td>
                            </tr>
                            <tr style="background:#3A9FBD">
                                <td style='text-align:center;border:solid 1px;' >
                                    <b>
                                        <font style='text-align:center;'	>
                                            Prova
                                        </font>
                                    </b>
                                </td>
                                <td style='text-align:center;border:solid 1px;'>
                                    <b>
                                        Categoria
                                    </b>
                                </td>
                                <td style='text-align:center;border:solid 1px;'>
                                    <b>
                                        Sexo
                                    </b>
                                </td>
                                <td style='text-align:center;border:solid 1px;' class='esconde'>           
                               <b>  Inscrever     </b>                                 
                                </td>
                            </tr>
                            <?php
                            $varUltimaMod = ($v['DESCMODALIDADE']);
                        }
                        ?>
                        <tr>
                            <td style='vertical-align: middle;text-align:center;border:solid 1px;'>
                                <?= strtoupper(utf8_encode($v['DESCPROVA'])) ?>
                            </td>
                            <td style='vertical-align: middle;text-align:center;border:solid 1px;'>
                                <?= strtoupper(utf8_encode($v['DESCCATEGORIA'])) ?>
                            </td>
                            <td style='vertical-align: middle;text-align:center;border:solid 1px;'>
                                <?= strtoupper(($v['SEXO'])) ?>
                            </td>
                            <td style='width:25%;border:solid 1px;' class ="tbDadosImg">
                                <a href="inscreveAluno.php?txtIdEscola=<?= $class->dados['IDESCOLA'] ?>&txtIdProva=<?= $v['IDPROVA'] ?>" >
                                    <img style='margin-left:20%; width: 150px;'alt='Inscrever Aluno' src='../imagem/Silhueta.png'/>
                                </a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
            <p></p>
            <br />
            <br />            
        </div>
    </body>
</html>

<?php

class selecionaProva {

    public $request;
    public $lst;
    public $dados;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
        // print_r($this->lst);
    }

    private function getDados($param) {
        $this->dados['NOMEESCOLA'] = $this->request['nome'];
        $this->dados['IDESCOLA'] = $this->request['txtIdEscola'];
        //$varIDEscola = $_GET['idEscola'];
        $param = array("txtIdEscola" => $this->request['txtIdEscola']);
        if (!($this->request['txtIdEscola']>0)) {
            $param = array("txtIdEscola" => $_SESSION['varIDEscola']);
        }        
        
        $this->lst = $this->sql->lstSelecionaProva($param);
        $this->dados['NOMEESCOLA'] = $this->lst[0]['NOMEESCOLA'];
        /*
        echo "<pre>";
                              print_r($this->lst);
                              echo "</pre>"; */
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