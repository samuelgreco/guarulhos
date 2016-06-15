<?php
session_start();
$class = new acessoEscola();
//print_r($class->lst);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-BR">
    <head>        
        <?php
        require_once 'head_lst.php';
        ?>
        <style>
            .container{
                width: 100%;
            }
        </style>
        <script type="text/javascript" language="javascript" src="../js/acessoEscola.js"></script>
    </head>
    <body>
        <div class="container">
            <h1>Escolha a escola desejada:</h1>
            <br /><br /><br />
            <table class="display" id="tabela" >
                <thead>
                    <tr>
                        <th>Escola</th>
                        <th style='text-align:center'>Inscrever Escola</th>
                        <th style='text-align:center'>Inscrever Aluno</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($class->lst as $$k => $v) {
                        ?>
                        <tr>
                            <td>
                            <b>    <?= utf8_encode($v['NOME']) ?> </b>
                            </td>
                            <td style='text-align:center'>
                                <a href="inscreveEscola.php?txtIdEscola=<?= $v['IDESCOLA'] ?>">
                                    <img style='width:60px' src="../imagem/escola.png" />
                                </a>
                            </td>
                            <td style="text-align:center">
                                <?php
                                if ($v['QTD_INSCRICAO'] > 0) {
                                    ?>                            
                                    <a href="selecionaProva.php?txtIdEscola=<?= $v['IDESCOLA']?>&txtEscola=<?=$v['NOME']?>">
                                        <img style='width:60px' src="../imagem/aluno.png" />
                                    </a>
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
        </div>
    </body>
</html>

<?php

class acessoEscola {

    public $request;
    public $lst;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
    }

    private function getDados($param) {
    	/*
      echo "<pre>";
          print_r($_SESSION);
          echo "</pre>";
          exit;
          */
        if ($_SESSION['IDPERFIL'] == 2) {        	
        	$param['txtIdProfessorIn'] = $_SESSION['IDPROFESSOR'];            
        }
        //$param['constaProfessorInscrito'] = "sim";        
        $this->lst = $this->sql->lstEscola($param);
    }

    private function iniciar($param) {
        require_once "../php/sql.php";
        // echo "<hr/>1";
        $this->sql = new sql();
        $this->sql->setTipoRetorno("php");

        $this->request = $_POST;
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->request = $_GET;
        }
    }

}
?>