<?php
$class = new sumulaFutebol();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head.php';
        ?>
        <link href="../css/estilo_sumula.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="bodySumulaFutebol">
       <input type="button" class="Voltar" style='padding-top:30px' onclick="history.go(-1);" />
        <div id="tabela_fute_campo">
            <img src="../imagem/fute_campo01.jpg" width="1000" height="1370" />
            <div id="tabela_fute_campo_disputantes">
                <table width="639" border="0">
                    <tr>
                        <td width="20px">
                            <input type="text" value="<?= $_POST['txtTime1']?>"  />
                        </td>
                        <td width="20">&nbsp;</td>
                        <td width="20px">
                            <input type="text"  value="<?= $_POST['txtTime2']?>"/>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_fute_campo_competicao">
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

            <div id="tabela_fute_campo_data">
                <table width="220" border="0">
                    <tr>
                        <td width="220">
                            <label>
                                <input type="text" value="<?= $_POST['txtDtJogo']?>" />
                            </label>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_fute_campo_jogo">
                <table width="98" border="0">
                    <tr>
                        <td>
                            <input type="text" value="<?= $_POST['txtNJogo']?>" />
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_fute_campo_categoria">
                <table width="194" border="0">
                    <tr>
                        <td>
                            <input type="text" value="<?= $_POST['txtCategoria']?>" />
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_fute_campo_equipe_A">
                <table width="428" border="0">
                    <tr>
                        <td>
                            <input type="text" value="<?= $_POST['txtTime1']?>" />
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_fute_campo_equipe_B">
                <table width="428" border="0">
                    <tr>
                        <td>
                            <input type="text" value="<?= $_POST['txtTime2']?>" />
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_fute_campo_nome_equipe_A">
                <table class=nomes width=491>
                    <thead>
                        <tr>
                            <th width=47></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($class->lstTime1 as $k => $v) {
                            ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <div style='width:438px;white-space:nowrap;overflow: hidden;'>
                                        <?= utf8_encode($v['NOMEALUNO']) ?>
                                    </div>
                                </td>

                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="tabela_fute_campo_nome_equipe_B">                
                <table class=nomes width=492>
                    <thead>
                        <tr>
                            <th width=47>                
                            </th>
                            <th>                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($class->lstTime2 as $k => $v) {
                            ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <div style='width:438px;white-space:nowrap;overflow: hidden;'>
                                        <?= utf8_encode($v['NOMEALUNO']) ?>
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
        <br />
        <div id="tabela_fute_campo">
            <img src="../imagem/fute_campo02.jpg" width="1000" height="1370" />
        </div>
    </body>
</html>
<?php

class sumulaFutebol{

    public $request;
    public $dados;
    public $lstTime1;
    public $lstTime2;
    public $sql;

    public function __construct() {
        //echo "<hr />sumula futebol<hr />";
        $this->iniciar($param);          
        $this->getDados($param);
        //echo "<hr />sumula futebol: dados get foi<hr />";exit;
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

