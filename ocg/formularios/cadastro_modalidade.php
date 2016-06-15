<?php
$class = new cadastro_modalidade();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>        
        <?php
        require_once 'head.php';
        ?>        
        <style>
            .tbDados{
                width: 100%;
            }
            .txtModalidade{
                width: 100%;
            }
        </style>
        <script type="text/javascript" src="../js/cadModalidade.js"></script>
    </head>
    <body class="bodyCadastroModalidade">
        <div class="container">
            <input type="hidden" name="mensagem" id="mensagem" value="<?= $class->response['mensagem'] ?>"/>
            <h1>
                Cadastro de Modalidade
                <a class="pull-right Voltar" href="consultaModalidade.php" /></a>
            </h1>
            <form id="frmCadastro" name="frmCadastro" class="frmCadastro" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" role="form" class="form-group required frmCadastro" data-toggle="validator">
                <input type="hidden" name="txtID" id="txtID" value="<?= $class->dados['IDMODALIDADE'] ?>"/>
                <input type="hidden" name="filtro" id="filtro" value="gravar"/>
                <div class="panel panel-default" style="border: none;">
                    <div class="panel-body">
                        <table class="table table-striped tbDados">
                            <tr>
                                <td>
                                    <label> Modalidade:</label><br />
                                    <input name="txtModalidade" type="text" id="txtModalidade" class="validate[required] txtModalidade" value="<?= utf8_encode($class->dados['DESCRICAO']) ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label> Quantidade m&aacute;xima participantes:</label><br />
                                    <input name="txtQtdMax" type="number" style="width:50px" id="txtQtdMax" min='0' class="validate[required] txtModalidade" value="<?= $class->dados['QTDMAX'] ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label> Quantidade m&iacute;nima participantes:</label><br />
                                    <input name="txtQtdMin" type="number" style="width:50px" id="txtQtdMin" min='0' class="validate[required] txtModalidade" value="<?= $class->dados['QTDMIN'] ?>" />
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
            <input id='cmdSalvar' class='Salvar' type='submit' value='Salvar' /> 
        </div>
    </body>
</html>
<?php

class cadastro_modalidade {

    public $request;
    public $dados;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        if ($this->request['filtro'] == "gravar") {
            $this->gravar($param);
        }
        /*
          echo "<pre>";
          print_r($this->request);
          echo "</pre>";
          exit;
         */
        $this->getDados($param);
    }

    private function getDados($param) {
        if ($this->request['txtID'] > 0) {
            $this->dados = $this->sql->lstModalidade($this->request);
            $this->dados = $this->dados[0];
        }
    }

    private function gravar($param) {
        require_once '../php/Gravar.php';
        $gravar = new Gravar();
        $this->response = $gravar->gravarModalidade($param);
        if (!($this->request['txtID'] > 0)) {
            $param = array("ID" => "IDMODALIDADE", "tabela" => "ocg_modalidade");
            $this->request['txtID'] = $gravar->getLastId($param);
        }
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
