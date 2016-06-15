<?php
session_start();
$class = new consultaModalidade();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>        
        <style type="">
            .Novo{
                padding: 0.75%;
                padding-left: 2.5%;
                margin-left: 75%;
                margin-bottom: 3%;
            }
            .display{
                width: 100%;
                margin-top: 2%;
            }
        </style>
        <script type="text/javascript" language="javascript" src="../js/lstModalidade.js"></script>
    </head>
    <body class='bodyConsultaModalidade'>
        <div class="container" style='width:99%'>
        	<h1>Modalidade 
	            <a href="cadastro_modalidade.php" id="btnNovo" class="Novo">&nbsp;&nbsp;Novo</a>
	            <input type="button" class="Voltar" style='margin-left:0%' onclick="history.go(-1);" />
            </h1>
            <table class="display" id="tabela" >
                <thead>
                    <tr>
                        <th>Modalidade</th>
                        <th style='text-align:center;width:110px'>Max particip.</th>
                        <th style='text-align:center;width:110px'>Min particip.</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($class->lst as $k => $v) {
                        ?>    
                        <tr id="linha<?= $v['IDMODALIDADE'] ?>">
                            <td style="padding: 12px;">
                             <b>   <?= utf8_encode($v['DESCRICAO']) ?> </b>
                            </td>
                            <td style="padding: 1%;text-align: center;">
                                <?= $v['QTDMIN'] ?>
                            </td>
                            <td style="padding: 1%;text-align: center;">
                                <?= $v['QTDMAX'] ?>
                            </td>
                            <td class="tdBotao">
                                <a href="cadastro_modalidade.php?txtID=<?= $v['IDMODALIDADE'] ?>" class='Editar'/>&nbsp;</a>
                            </td>
                            <td class="tdBotao">
                                <?php
                                if (!($v['QTD_PROVA'] > 0)) {
                                    ?>                            
                                    <a href="#" onclick="excluir(<?= $v['IDMODALIDADE'] ?>)" class='Remover'>&nbsp;</a>
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

class consultaModalidade {

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
        $this->lst = $this->sql->lstModalidade($param);
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