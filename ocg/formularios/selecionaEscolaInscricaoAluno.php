<?php
$class = new selecionaEscolaInscricaoAluno();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head.php';
        ?>
        <script type="text/javascript" src="../js/selecionaEscolaInscricaoAluno.js"></script>
        <style>
            .tbDados{
                width: 100%;
            }
            .txtLocal{
                width: 100%;
            }
            .Salvar{
                width: auto;
                padding-left: 15%;                
            }
        </style>
    </head>
    <body class="bodySelecionaEscolaInscricaoAluno">
        <div class="container">
            <form id="frmPesquisa" name="frmPesquisa" class="frmPesquisa" method="post" action="consultaEscola.php">
                <h1>Inscri&ccedil;&atilde;o de Alunos</h1>
                <p>&nbsp;</p>
                <table width="560" border="0">
                    <tr>
                        <td>Escola:<br />
                            <select name="cboEscola" id="cboEscola" class="cboEscola">
                                <?php foreach ($class->lstEscola as $k => $v) {
                                    ?>
                                    <option value="<?= $v['IDESCOLA'] ?>"><?= $v['NOME'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <table width="124" border="0">
                    <tr>
                        <td width="118" height="40">
                            <input class="Salvar" type="button" name="cmdSelecionar" id="cmdSelecionar" value="&nbsp;&nbsp;&nbsp;&nbsp;Selecionar" tabindex="5" onclick="inscreverAluno()"/>
                        </td>
                    </tr>
                </table>
                <br />
            </form>
        </div>        
    </body>
</html>
<?php

class selecionaEscolaInscricaoAluno {

    public $request;
    public $dados;
    public $sql;
    public $lstEscola;

    public function __construct() {
        $this->iniciar($param);
        if ($this->request['filtro'] == "gravar") {
            $this->gravar($param);
        }
        /*
          echo "<pre>";
          print_r($this->dados);
          echo "</pre>";
          exit;
         */
        $this->getDados($param);
    }

    private function getDados($param) {
        $this->lstEscola = $this->sql->lstEscola($param);
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

