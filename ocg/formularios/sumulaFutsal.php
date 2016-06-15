<?php
$class = new sumulaFutsal();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head.php';
       // print_r($_POST);
        ?>
        <link href="../css/estilo_sumula.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div id="tabela_futsal">
            <img src="../imagem/futsal.jpg" width="1000" height="1512" />
            <div id="tabela_futsal_jogo">
                <table width="65" border="0">
                    <tr>
                        <td>
                            <label>
                                <input type="text" value="<?= $_POST['txtNJogo'] ?>" size="3" />
                            </label>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_futsal_competicao">
                <table width="431" border="0">
                    <tr>
                        <td>
                            <label>
                                <input type="text" value="<?= $_POST['txtCompeticao'] ?>" size="3" />
                            </label>
                        </td>
                    </tr>
                </table>
            </div>

            <div id="tabela_futsal_hora">

                <table width="129" border="0">
                    <tr>
                        <td>
                            <label>
                                <input type="text" value="<?= $_POST['cboHora'] ?>" size="3" />
                            </label>
                        </td>
                    </tr>
                </table>  
            </div>
            <div id="tabela_futsal_data">  
                <table width="195" border="0">
                    <tr>
                        <td>
                            <label>
                                <input type="text" value="<?= $_POST['txtDtJogo'] ?>" size="3" />
                            </label>
                        </td>
                    </tr>
                </table>
            </div>  
            <div id="tabela_futsal_categoria">  
                <table width="450" border="0">
                    <tr>
                        <td>
                            <label>
                                <input type="text" value="<?= $_POST['txtSigla'] ?> - <?= $_POST['txtCategoria'] ?> - <?= $_POST['txtSexo'] ?>" size="3" />
                            </label>
                        </td>
                    </tr>
                </table>
            </div>  
            <div id="tabela_futsal_local">  
                <table width="450" border="0">
                    <tr>
                        <td>
                            <label>
                                <input type="text" value="<?= $_POST['cboLocal'] ?>" />
                            </label>
                        </td>
                    </tr>
                </table>
            </div>  
            <div id="tabela_futsal_vs_time_B">  
                <table width="420" border="0">
                    <tr>
                        <td width="95">
                            <input type="text" size="3" />
                        </td>
                        <td width="315">
                            <input type="text" size="3" value="<?= $_POST['txtTime2']?>" />
                        </td>
                    </tr>
                </table>
            </div>  
            <div id="tabela_futsal_vs_time_A">  
                <table width="420" border="0">
                    <tr>
                        <td width="321">
                            <input type="text" size="3" value="<?= $_POST['txtTime1'] ?>" />
                        </td>
                        <td width="91">
                            <label>
                                <input name="textfield2" type="text" id="textfield2" size="4" />
                            </label>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_futsal_equipe_A"><table width="360" border="0">
                    <tr>
                        <td>
                            <label>
                                <input type="text" size="3" value="<?= $_POST['txtTime1'] ?>" />
                            </label>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_futsal_equipe_A_jogadores">
                <table class="nomes" width="810">
                    <thead>
                        <tr>
                            <th width=380px >Nome</th>
                            <th width=60px >N&ordm;</th>
                            <th width=190px >Faltas</th>
                            <th>Amarelo</th>
                            <th>Vermelho</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($class->lstTime1 as $k => $v) {
                            ?>
                            <tr>
                                <td>
                                    <div style='width:380px'>
                                        <?= $v['NOMEALUNO'] ?>
                                    </div>
                                </td>
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
            </div>
            <div id="tabela_futsal_equipe_B">
                <table width="360" border="0">
                    <tr>
                        <td>
                            <label>
                                <input type="text" value=<?= $_POST['txtTime2'] ?> />
                            </label>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_futsal_equipe_B_jogadores">
                <table class="nomes" width="810">
                    <thead>
                        <tr>
                            <th width=380px >Nome</th>
                            <th width=60px >N&ordm;</th>
                            <th width=190px >Faltas</th>
                            <th>Amarelo</th>
                            <th>Vermelho</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($class->lstTime2 as $k => $v) {
                            ?>
                            <tr>
                                <td>
                                    <div style='width:380px;white-space:nowrap;overflow: hidden;'>
                                        <?= $v['NOMEALUNO'] ?>
                                    </div>
                                </td>
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
            </div>
        </div>
    </body>
</html>

<?php

class sumulaFutsal {

    public $request;
    public $dados;
    public $lstTime1;
    public $lstTime2;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);        
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

