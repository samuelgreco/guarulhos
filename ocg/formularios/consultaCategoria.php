<?php
session_start();
$class = new consultaCategoria();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>
        <script type="text/javascript" language="javascript" src="../js/lstCategoria.js"></script>
        <style>
            .tbDados{
                margin-bottom: 1%;
                width: 70%;
            }
            .tdPesquisa{
                width: 60%;
            }
            .txtCategoria{
                width: 100%;
            }
            .Pesquisar{
                padding-left:300px;
                padding-bottom:7%;
            }
        </style>
    </head>
    <body class="bodyConsultaCategoria">
        <div class="container" style='width:99%'>
            <h1>
                Categoria
                <a href="cadastro_categoria.php" id="btnNovo" class="Novo">&nbsp;&nbsp;Novo</a> 	
               	<input type="button" class="Voltar" style='margin-left:0%' onclick="history.go(-1);" />
            </h1>
            <form id="frmPesquisa" name="frmPesquisa" class="frmPesquisa" method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
                <table class="tbDados" >
                    <tr>
                        <td class="tdPesquisa">
                            Categoria:<br />
                            <input type="text" name="txtCategoria" id="txtCategoria" tabindex="1" maxlength="100"  />
                        </td><td>
                    <input type="submit" class="Pesquisar" value="Pesquisar" style='border:none;margin-top:7%;padding-left:15%;margin-left:-30%'/></td>
                    </tr>
                </table>
                <table class="display" id="tabela" >
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Idade M&iacute;nima</th>
                            <th>Idade M&aacute;xima</th>
                            <th>Individ. M&aacute;xima</th>
                            <th>Coletiv. M&aacute;xima</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($class->lst as $k => $v) {
                            ?>    
                            <tr id="linha<?= $v['IDCATEGORIA'] ?>">
                                <td style='padding:1%;'>
                                  <b>  <?= strtoupper(utf8_encode($v['DESCRICAO']))?> </b>
                                </td>
                                <td class="tdBotao">
                                    <?= utf8_encode($v['IDADE_MIN']) ?>
                                </td>
                                <td class="tdBotao">
                                    <?= utf8_encode($v['IDADE_MAX']) ?>
                                </td>
                                <td class="tdBotao">
                                    <?= utf8_encode($v['INDIVIDUAL_MAX']) ?>
                                </td>
                                <td class="tdBotao">
                                    <?= utf8_encode($v['COLETIVA_MAX']) ?>
                                </td>                  
                                <td class="tdBotao">
                                    <a href="cadastro_categoria.php?txtID=<?= $v['IDCATEGORIA'] ?>" class="Editar"></a>
                                </td>
                                <td class="tdBotao">
                                    <?php
                                    if (!($v['QTD_PROVA'] > 0)) {
                                        ?>                            
                                        <a href="#" onclick="excluir(<?= $v['IDCATEGORIA'] ?>)" class='Remover'>&nbsp;</a>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <?php
                            }
                            ?>                                                            
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </body>
</html>

<?php

class consultaCategoria {

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
        $this->lst = $this->sql->lstCategoria($this->request);
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