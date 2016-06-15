<?php
session_start();
$class = new cadastro_local();
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
            .txtLocal{
                width:100%;
            } 
        </style>
        <script type="text/javascript" src="../js/cadLocal.js"></script>
    </head>

    <body class="bodyCadastroLocal">
        <div class="container">        
            <input type="hidden" name="mensagem" id="mensagem" value="<?= $class->response['mensagem'] ?>"/>
            <h1>
                Local
                <a class="pull-right Voltar" href="consultaLocal.php" /></a>
            </h1>
            <form id="frmCadastro" name="frmCadastro" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                <input type="hidden" name="txtID" id="txtID" value="<?= strtoupper($class->dados['IDLOCAL']) ?>"/>
                <input type="hidden" name="filtro" id="filtro" value="gravar"/>
                <div class="panel panel-default" style="border: none;">
                    <div class="panel-body">
                        <table class="table table-striped tbDados">
                            <tr>
                                <td><label> Local:</label><br />
                                    <input name="txtLocal" type="text" id="txtLocal" class="validate[required] txtLocal" maxlength="150"  value="<?= utf8_encode($class->dados['LOCAL']) ?>"/>
                                </td>
                                <td width="324">&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br />
            </form>
            <td>  <input id='cmdSalvar' class='Salvar' type='submit' value='Salvar' /></td><br />
        </div>
    </body>
</html>
<?php

class cadastro_local {

    public $request;
    public $dados;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        if ($this->request['filtro'] == "gravar") {
            $this->gravar($param);
        }
        $this->getDados($param);
    }

    private function getDados($param) {
        if ($this->request['txtID'] > 0) {
            $this->dados = $this->sql->lstLocal($this->request);
            $this->dados = $this->dados[0];
        }
    }

    private function gravar($param) {
        require_once '../php/Gravar.php';
        $gravar = new Gravar();
        $this->response = $gravar->gravarLocal($param);
        if (!($this->request['txtID'] > 0)) {
            $param = array("ID" => "IDLOCAL", "tabela" => "ocg_locais");
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
?>