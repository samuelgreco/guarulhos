<?php
$class = new sumulaVoleibol();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head.php';
        ?>
        <link href="../css/estilo_sumula.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="bodySumulaVoleibol">
        <form>
            <div id="tabela_volei">
                <img src="../imagem/voleibol.jpg" width="1015" height="609" />
                <div id="tabela_volei_data">
                    <table width="165" border="0">
                        <tr>
                            <td>
                                <label>
                                    <input type="text" value="<?= $_POST['txtDtJogo'] . "&nbsp;-&nbsp;" . $_POST['cboHora'] ?>" />
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="tabela_volei_competicao">
                    <table width="206" border="0">
                        <tr>

                            <td>
                                <label>
                                    <input type="text"  size="3" style='font-size:8px' value="<?= $_POST['txtCompeticao']?>"/>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="tabela_volei_ginasio">
                    <table width="88" border="0">
                        <tr>
                            <input type="text" size="3" style='font-size:8px' value="<?= $_POST['cboLocal'] ?>"/>
                        </tr>
                    </table>
                </div>
                <div id="tabela_volei_sex">
                    <table width="152" border="0">
                        <tr>
                            <td>
                                <label>
                                    <input type="text"  size="3" value="<?= $_POST['txtSexo'] ?>" />
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="tabela_volei_categoria">
                    <table width="110" border="0">
                        <tr>
                            <td>
                                <input type="text" size="3" value="<?= $_POST['txtCategoria'] ?>" />
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="tabela_volei_jogo">
                    <table width="48" border="0">
                        <tr>
                            <td>
                                <label>
                                    <input type="text"  size="3"  value="<?= $_POST['txtNJogo'] ?>"/>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="tabela_volei_A_vs">
                    <table width="151" border="0">
                        <tr>
                            <td>
                                <label>
                                    <input type="text" size="3" value="<?= $_POST['txtTime1'] ?>" />
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="tabela_volei_B_vs">
                    <table width="152" border="0">
                        <tr>
                            <td>
                                <label>
                                    <input type="text" size="3" value="<?= $_POST['txtTime2'] ?>" />
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="tabela_volei_equipe_A">
                    <table class=nomes width=139>
                        <thead>
                            <tr>
                                <th width=24>
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($class->lstTime1 as $k => $v) {
                                ?>
                                <tr style='height:11px;'>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td style='height:12px'>
                                        <div style='width:115px;white-space:nowrap;overflow: hidden;height:10px'>
                                            <?= $v['NOMEALUNO'] ?>
                                        </div>
                                    </td>
                                </tr>     
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div id="tabela_volei_equipe_B">
                    <table class=nomes width=152>
                        <thead>
                            <tr>
                                <th width=24>
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($class->lstTime2 as $k => $v) {
                                ?>
                                <tr style='height:10px'>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td style='height:10px'>
                                        <div style='width:115px;white-space:nowrap;overflow: hidden;height:10px'>
                                            <?= $v['NOMEALUNO'] ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>                    
                </div>
            </div>
        </form>
    </body>
</html>
<?php

class sumulaVoleibol {

    public $request;
    public $dados;
    public $lstTime1;
    public $lstTime2;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
        /*
          echo "<pre>";
          print_r($this->dados);
          echo "</pre>";
          exit;
         */
    }
 
    private function getDados($param) {
        require_once 'sumula_dados.php';
        $dados = new sumula_dados();
        $dados->getDados($this->request);                
        $this->dados=$dados->dados;
        $this->lstTime1 = $dados->lstTime1;
        $this->lstTime2 = $dados->lstTime2;
    }

    private function iniciar($param) {
        $this->request = $_POST;
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->request = $_GET;
        }        
    }

}

// FIM DA CLASSE
?>

