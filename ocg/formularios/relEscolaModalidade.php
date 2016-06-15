<?php
session_start();
$class = new relEscolaModalidadeForm();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>
        <script type="text/javascript" src="../js/escolaModalidade.js"></script>
        <style type="">
            .tbDados{
                width: 50%;
            }
            .cboModalidade{
                width: 100%;
            }
        </style>
    </head>
    <body class="relEscolaModalidadeForm">
        <div class="container">
            <h1>Escolas por Modalidade</h1>
            <form id="frmPesquisa" name="frmPesquisa" class="frmPesquisa" method="post" action="../relatorios/relCategoria.php">
                <table class="tbDados">
                    <tr>
                        <td>
                            <label>Modalidade:</label>
                            <br />                                
                            <select name="cboModalidade" id="cboModalidade" class="cboModalidade">
                                <?php foreach ($class->lstModalidade as $k => $v) {
                                    ?>
                                    <option value="<?= $v['IDMODALIDADE'] ?>"><?= strtoupper(utf8_encode($v['DESCRICAO'])) ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <label>Sexo:</label><br />
                            <select name="cboSexo" id="cboSexo">
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
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

class relEscolaModalidadeForm {

    public $request;
    public $lstModalidade;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
    }

    private function getDados($param) {
        $param = array("constaInscrEscola" => "sim");           
        if ($_SESSION['IDPERFIL'] == 2) {
            $param["txtIdEscola"] = $_SESSION['IDESCOLA'];
        }
        $this->lstModalidade = $this->sql->lstModalidade($param);
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
