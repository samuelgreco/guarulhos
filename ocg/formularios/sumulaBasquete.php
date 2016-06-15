<?php
$class = new sumulaBasquete();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head.php';
        ?>
        <link href="../css/estilo_sumula.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <input type="button" class="Voltar" style='padding-top:30px' onclick="history.go(-1);" />
        <form>
            <div id="tabela_basquete"><img src="../imagem/basquete.jpg" width="1000" height="1339" />
                <div id="tabela_basquete_local">
                    <table width="180" border="0">
                        <tr>
                            <td>
                                <input type="text"  style='font-size:12px' value="<?= $_POST['cboLocal'] ?>" />
                            </td>
                        </tr>
                    </table>
                    <div id="tabela_basquete_competicao">
                        <table width="431" border="0">
                            <tr>
                                <td>
                                    <label>
                                        <input type="text" value="<?= $_POST['txtCompeticao'] ?>" />
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="tabela_basquete_numero">
                    <table width="50" border="0">
                        <tr>
                            <td>
                                <label>
                                    <input name="textfield" type="text" id="textfield" value="<?= $_POST['txtNJogo'] ?>" />                                    
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="tabela_basquete_sex">
                    <table width="80" border="0">
                        <tr>
                            <td>
                                <label>
                                    <input name="textfield2" id="textfield2" type="text" style='font-size:10px' value="<?= $_POST['txtSexo'] ?>"  />                                    
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="tabela_basquete_data">
                    <table width="120" border="0">
                        <tr>
                            <td>
                                <label>
                                    <input name="textfield3" type="text" id="textfield3" value="<?= $_POST['txtDtJogo'] ?>" />
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="tabela_basquete_hora">
                    <table width="80" border="0">
                        <tr>
                            <td>
                                <label>
                                    <input name="textfield3" type="text" id="textfield3" value="<?= $_POST['cboHora'] ?>" />
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="tabela_basquete_equipe_A">
                    <table width="180" border="0">
                        <tr>
                            <td>
                                <label>
                                    <input name="textfield4" type="text" id="textfield4" value="<?= $_POST['txtTime1'] ?>" />
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="tabela_basquete_equipe_B">
                    <table width="180" border="0">
                        <tr>
                            <td>
                                <input name="input" type="text" value="<?= $_POST['txtTime2'] ?>" />
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="tabela_basquete_nome_jogador_A" style='margin-bottom:40%'>
                    <label>
                        <table class=nomes width=462>
                            <thead>
                                <tr>
                                    <th>N&ordm; Reg</th>
                                    <th>Nome</th>
                                    <th width=20px>E</th>
                                    <th>N&ordm; Jogador</th>
                                    <th colspan=5 >Faltas Cometidas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($class->lstTime1 as $k => $v) {
                                    ?>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>
                                            <div style='width:242px;white-space:nowrap;overflow: hidden;'>
                                                <?= $v['NOMEALUNO'] ?>
                                            </div>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </label>
                </div>
                <div id="tabela_basquete_nome_jogador_B" style='margin-bottom:40%'>
                    <label>
                        <table class=nomes width=462>
                            <thead>
                                <tr>
                                    <th>N&ordm; Reg</th>
                                    <th>Nome</th>
                                    <th width=20px>E</th>
                                    <th>N&ordm; Jogador</th>
                                    <th colspan=5 >Faltas Cometidas</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($class->lstTime2 as $k => $v) {
                                    ?>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>
                                            <div style='width:242px;white-space:nowrap;overflow: hidden;'>
                                                <?= $v['NOMEALUNO'] ?>
                                            </div>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </label>
                </div>
            </div>
        </form>
    </body>
</html>

<?php

class sumulaBasquete {

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

