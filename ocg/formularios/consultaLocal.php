<?php
session_start();
$class = new consultaLocal();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>
        <script type="text/javascript" language="javascript" src="../js/lstLocal.js"></script>
        <style type="">
            .tbDados{
                margin-bottom: 2%;
                width: 70%;
            }
            .tdPesquisa{
                width: 60%;
            }
            .txtLocal{
                width: 100%;
            }
            .Pesquisar{
                padding-left:300px;
                padding-bottom:2%;
            }
        </style>
    </head>
    <body class="bodyConsultaLocal">
        <div class="container" style='width:99%'>
            <h1>
                Local
                <a href="cadastro_local.php" id="btnNovo" class="Novo">&nbsp;&nbsp;Novo</a>
				<input type="button" class="Voltar" style='margin-left:0%' onclick="history.go(-1);" />
            </h1>
            <br />
            <form id="frmPesquisa" name="frmPesquisa" class="frmPesquisa" method="get" action="<?= $_SERVER['PHP_SELF'] ?>">                
                <table class="tbDados" >
                    <tr>
                        <td class="tdPesquisa">
                            <input type="text" name="txtLocal" id="txtLocal" class="txtLocal" placeholder='Digite aqui o local desejado para realizar a filtragem' style='width:370px' />
                        </td>
                        <td>
                      	    <input type="submit" class="Pesquisar" value="Pesquisar" style='border:none;margin-top:1%;padding-left:15%;margin-left:0%'/>
                        </td>
                    </tr>
                </table>
            </form>
            <table class="display" id="tabela" >
                <thead>
                    <tr>
                        <th style="width: 80%;">Local</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($class->lst as $k => $v) {
                        ?>    
                        <tr id="linha<?= $v['IDLOCAL'] ?>">
                            <td style="padding: 12px;">
                             <B>   <?= strtoupper(utf8_encode($v['LOCAL'])) ?> </B>
                            </td>
                            <td>
                                <a href="cadastro_local.php?txtID=<?= $v['IDLOCAL'] ?>" class='Editar'/></a>
                            </td>
                            <td>
                                <?php
                                if (!($v['QTD_SUMULA'] > 0)) {
                                    ?>                            
                                    <a href="#" onclick="excluir(<?= $v['IDLOCAL'] ?>)" class='Remover'>&nbsp;</a>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
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

class consultaLocal {

    public $request;
    public $lst;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        /*
          echo "<pre>";
          print_r($this->request);
          echo "</pre>";
          exit;
         */
        $this->getDados($param);
    }

    private function getDados($param) {
        $this->lst = $this->sql->lstLocal($this->request);
        /* require_once '../php/sql.php';
          $this->sql = new sql();
          $this->sql->setTipoRetorno("php");
          $this->lst = $this->sql->lstAluno($param); */
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