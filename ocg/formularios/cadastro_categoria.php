<?php
session_start();
$class = new cadastro_categoria();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head.php';
        ?>        
        <style>
            .txtDescricao{
                width: 545px;
            }

            .tdIdadeMin{
                width: 100px;
            }
            .tdIdadeMax{
                width: 300px;
            }
        </style>
        <script type="text/javascript" src="../js/cadCategoria.js"></script>
    </head>
    <body class="bodyCadastroCategoria">
        <div class="container">
            <input type="hidden" name="mensagem" id="mensagem" value="<?= $class->response['mensagem'] ?>"/>
            <h1>
                Cadastro de Categoria
                <a class="pull-right Voltar" href="consultaCategoria.php" /></a>
            </h1>
            <form id="frmCadastro" name="frmCadastro" class="frmCadastro" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                <input type="hidden" name="filtro" id="filtro" value="gravar"/>
                <input name="txtID" type="hidden" id="txtID" value="<?= $class->dados['IDCATEGORIA'] ?>"/>
                <div class="panel panel-default" style="border: none;">
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tr>
                                <td colspan="2">
                                    <label> Categoria:</label><br />
                                    <input name="txtDescricao" id="txtDescricao" class="validate[required] txtDescricao" value="<?= $class->dados['DESCRICAO']?>" type="text" />
                                </td>
                            </tr>
                            <tr>
                                <td class="tdIdadeMin"><label> Idade M&iacute;nima:</label><br />
                                    <input name="txtIdadeMin" type="number" id="txtIdadeMin" min="1" class="validate[required] txtIdadeMin" value="<?= $class->dados['IDADE_MIN'] ?>" />
                                </td>
                                <td class="tdIdadeMax" >
                                    <label> Idade M&aacute;xima:</label><br />
                                    <input name="txtIdadeMax" type="number" id="txtIdadeMax"  class="validate[required] txtIdadeMax" value="<?= $class->dados['IDADE_MAX'] ?>"/>
                                </td>
                            </tr>
                            <td class="tdIdadeMin"><label> Qtd max provas individuais:</label><br />                                
                                <input name="txtProvasIndividuais" type="number" id="txtProvasIndividuais" min="1" class="validate[required] txtIdadeMin" value="<?= $class->dados['INDIVIDUAL_MAX'] ?>" />
                            </td>
                            <td class="tdIdadeMin"><label> Qtd max provas coletivas:</label><br />
                                <input name="txtProvasColetivas" type="number" id="txtProvasColetivas" min="1" class="validate[required] txtIdadeMin" value="<?= $class->dados['COLETIVA_MAX'] ?>" />
                            </td>
                        </table>
                    </div>
                </div>        
            </form>
            <input id='cmdSalvar' class='Salvar' type='submit' value='Salvar'>
                <br />
                <label id="label_horario"></label>
                <br />
                <br />
                <label id="label_horario"></label>
                <br />
        </div>
    </body>
</html>
<?php

class cadastro_categoria {

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
            $this->dados = $this->sql->lstCategoria($this->request);
            $this->dados = $this->dados[0];
        }
    }    
    
    private function gravar($param) {
        require_once '../php/Gravar.php';
        $gravar = new Gravar();
        $this->response = $gravar->gravarCategoria($param);
        if (!($this->request['txtID'] > 0)) {
            $param = array("ID" => "IDCATEGORIA", "tabela" => "ocg_categoria");
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
