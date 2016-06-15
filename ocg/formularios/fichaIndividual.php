<?php
session_start();
$class = new fichaIndividualForm();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>
        <script type="text/javascript" src="../js/fichaIndividual.js"></script>
        <style>
            .tbDados{
                width: 50%;
            }
            .cboProva{
                width: 50%;
            }
            .cboTipo{
                width: 50%;
            }
        </style>
    </head>
    <body class="bodyFichaIndividual" >
        <div class="container">
            <h1>Alunos por Prova<br /> </h1>
            <form id="frmCadastro" name="frmCadastro" method="post" action="../relatorios/fichaIndividual.php">
                <table class="tbDados">
                    <tr>
                        <td>
                            <label>Prova e modalidade:</label><br />
                            <select name="cboProva" id="cboProva" class="cboProva">
                                <?php
                                foreach ($class->lst as $k => $v) {
                                    ?>
                                    <option value="<?= $v['IDPROVA'] ?>"><?=utf8_encode($v['DESCRICAO'])?>&nbsp;-&nbsp;<?=utf8_encode($v['DESCMODALIDADE'])?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tipo:</label><br />
                            <select name="cboTipo" id="cboTipo" class="cboTipo">
                                <option value="4">Atletismo</option>
                                <option value="3">Nata&ccedil;&atilde;o</option>
                                <option value="5">Revezamento</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <br />
                <input type="submit" name="cmdExibir" id="cmdExibir" value="Exibir" class="Salvar"/>
            </form>
        </div>
    </body>
</html>
<?php

class fichaIndividualForm {

    public $request;
    public $lst;
    public $lstTipo;
    public $dados;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
    }

    private function getDados($param) {
        $param = array("txtIdProva" => $_SESSION['txtIdProva']);
        $this->lst = $this->sql->lstProva($param);
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