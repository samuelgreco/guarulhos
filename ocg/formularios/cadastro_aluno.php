<?php
session_start();
$class = new cadastroAluno();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head.php';
        ?> 
        <script type="text/javascript" src="../../../lib/js/jquery.ui.datepicker-pt-BR.js"></script>               
        <style>
            .tbDados{
                width: 100%;
            }
            .tdDados{
                width: 30%;
            }
            .txtNome{
                width: 100%;
            }
            .txtNomeMae{
                width: 100%;
            }
            .txtEmail{
                width: 100%;
            }
            .cboEscola{
                width: 50%;
            }
            .cboSexo{
                width: 50%;
            }
            .cboCategoria{
                width: 20%;
            }

        </style>
     <script type="text/javascript" src="../js/cadAluno.js"></script>
    </head>
    <body class="bodyCadastroAluno">
        <div class="container">
            <input type="hidden" name="mensagem" id="mensagem" value="<?=$class->response['mensagem']?>"/>
            <h1>
                Cadastro de Aluno
                <a class="pull-right Voltar" href="consultaAluno.php" /></a>
            </h1>
            <form id="frmCadastro" name="frmCadastro" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" role="form" class="form-group required frmCadastro" data-toggle="validator">
                <input type="hidden" name="txtID" id="txtID" value="<?= $class->dados['IDALUNO'] ?>"/>
                <input type="hidden" name="filtro" id="filtro" value="gravar"/>

                <div class="panel panel-default" style="border: none;">
                    <div class="panel-body">
                        <table class="table table-striped tbDados">
                            <tr>
                                <td colspan="3">Escola:<br />		                            
                                    <select name="cboEscola" id="cboEscola" class="required validate[required] cboEscola">
                                        <option value=""></option>
                                        <?php
                                        foreach ($class->lstEscola as $k => $v) {
                                            ?>
                                            <option value="<?= $v['IDESCOLA'] ?>" <?= $v['selected'] ?>><?= utf8_encode($v['NOME']) ?></option>								                            		
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td  class="tdDados">RA:<br />
                                    <input name="txtRA" type="text" id="txtRA" class="txtRA" maxlength="9" value="<?= $class->dados['RA'] ?>" />
                                </td>
                                <td  class="tdDados">RG:<br />
                                    <input name="txtRG" type="text" id="txtRG" class="txtRG" maxlength="9" value="<?= $class->dados['RG'] ?>" />
                                </td>                                
                            </tr>
                            <tr>
                                <td colspan="2" class="tdDados">Data de Nascimento:<br />
                                    <input type="text" name="txtDtNasc" id="txtDtNasc" class="validate[required] txtDtNasc"  maxlength="12" placeholder="DD/MM/AAAA" value="<?= $class->dados['DTNASC'] ?> "/>
                                </td>
                                <td>                                    
                                    <br />
                                    <a class="Pesquisar" onclick="pesquisar()" style="display: none;"></a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">Nome:<br />
                                    <input name="txtNome" type="text" id="txtNome" class="validate[required] txtNome" maxlength="150" value="<?= utf8_encode($class->dados['NOME']) ?>"  />
                                </td>
                            </tr>                            
                            <tr>
                                <td colspan="3">Nome M&atilde;e:<br />
                                    <input name="txtNomeMae" type="text" id="txtNomeMae" class="validate[required] txtNomeMae" maxlength="60" value="<?= utf8_encode($class->dados['NOME_MAE']) ?>" />
                                </td>
                            </tr>
                            <td>Sexo:<br />
                                <input type="hidden" name="txtSexo" id="txtSexo" value="<?= $class->dados['SEXO'] ?>"/> 
                                <select name="cboSexo" id="cboSexo" class="validate[required] cboSexo" style="width: 163px;" >
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                </select>
                            </td>
                            <td style="width: 163px;">Categoria: <br />
                                <input type="hidden" name="txtSexo" id="txtSexo" value="<?= $class->dados['IDCATEGORIA'] ?>"/>    
                                <select name="cboCategoria" id="cboCategoria" class="validate[required] cboCategoria" style="width: 163px;">
                                    <option value=""></option>
                                    <?php
                                    foreach ($class->lstCategoria as $k => $v) {
                                        ?>
                                        <option value="<?= $v['IDCATEGORIA'] ?>" <?= $v['selected'] ?>><?= $v['DESCRICAO'] ?></option>								                            		
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>  
                        </table>
                    </div>
                </div>        
            </form>
            <input id="cmdSalvar" class="Salvar" type="submit" value="Salvar" />
                <label id="label_horario"></label>
        </div>
    </body>
</html>

<?php

class cadastroAluno {

    public $request;
    public $response;
    public $lstEscola;
    public $lstCategoria;
    public $lstProfessor;
    public $dados;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        if ($this->request['filtro'] == "gravar") {
            $this->gravar($param);
        }        
        $this->getDados($param);       
        /*echo "<pre>";
              print_r($this->dados);
              echo "</pre>";
              exit;*/
    }

    private function getDados($param) {
        $this->lstEscola = $this->sql->lstEscola($param);
        $this->lstCategoria = $this->sql->lstCategoria($param);
        if ($this->request['txtID'] > 0) {
            $param=array("txtID"=>$this->request['txtID']);
            $this->dados = $this->sql->lstAluno($param);
            $this->dados = $this->dados[0];            
            foreach ($this->lstEscola as $k => $v) {
                if ($this->dados['IDESCOLA'] == $v['IDESCOLA']) {
                    $this->lstEscola[$k]['selected'] = " selected";
                }
            }
            foreach ($this->lstCategoria as $k => $v) {
                if ($this->dados['IDCATEGORIA'] == $v['IDCATEGORIA']) {
                    $this->lstCategoria[$k]['selected'] = " selected";
                }
            }
            
        }
    }
    
     private function gravar($param) {
        require_once '../php/Gravar.php';
        $gravar = new Gravar();
        $this->response = $gravar->gravarAluno($param);
        if (!($this->request['txtID']>0)) {             
            $param=array("ID"=>"IDALUNO","tabela"=>"OCG_ALUNO");
            $this->request['txtID']=$gravar->getLastId($param);
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