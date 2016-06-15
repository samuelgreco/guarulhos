<?php
session_start();
$class = new cadastro_escola();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>        
        <?php
        require_once 'head_lst.php';
        ?>
        <script type="text/javascript" src="../js/cadEscola.js"></script>
        <style type="">
            .tbDados{
                width: 100%;
            }
            .tdNomes{
                width: 100%;
            }
            .tdNomesMedio{
                width: 70%;
            }
        </style>
    </head>
    <body class="bodyCadEscola">
        <div class="container">
            <input type="hidden" name="mensagem" id="mensagem" value="<?=$class->response['mensagem']?>"/>
            <h1>
                Cadastro de Escola
                <a class="pull-right Voltar" onclick="history.go(-1);" href="consultaEscola.php"/></a>
            </h1>
            <ul class="nav nav-tabs">
                <li class="active ">
                    <a data-toggle="tab" href="#home">
                        Cadastro
                    </a>
                </li>               
                <?php
                if ($class->dados['QTD_PROFESSOR'] > 0) {
                    ?>
                    <li>
                        <a data-toggle="tab" href="#menu1">
                            Professores da escola
                        </a>                    
                    </li>
                    <?php
                }
                ?>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <form id="frmCadastro" name="frmCadastro" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" role="form" class="form-group required frmCadastro" data-toggle="validator">
                        <input type="hidden" name="txtID" id="txtID" value="<?= $class->dados['IDESCOLA'] ?>"/>
                        <input type="hidden" name="filtro" id="filtro" value="gravar"/>
                        <div class="panel panel-default" style="border: none;">
                            <div class="panel-body">
                                <table class="table table-striped tbDados">
                                    <tr>
                                        <td colspan="4">Escola:<br />
                                            <input name="txtNome" type="text" id="txtNome" class="validate[required] txtNome tdNomes" maxlength="150" value="<?= utf8_encode($class->dados['NOME']) ?>" />
                                        </td>
                                    </tr>                
                                    <tr>
                                        <td colspan="3">Apelido:<br />
                                            <input name="txtApelido" onclick="verificarExiste()" type="text" id="txtApelido" class="validate[required] txtApelido tdNomesMedio" maxlength="75" value="<?= utf8_encode($class->dados['APELIDO']) ?>"/>
                                        </td>
                                    </tr>                
                                    <tr>
                                        <td colspan="4">Email:<br />
                                            <input name="txtEmail" type="email" id="txtEmail" class="validate[required] txtEmail tdNomes" maxlength="150" value="<?= $class->dados['EMAIL'] ?>" required/>
                                        </td>
                                    </tr>                
                                    <tr>
                                        <td colspan="4">Endereço:<br />
                                            <input name="txtEndereco" type="text" id="txtEndereco" class="validate[required] txtEndereco tdNomes" maxlength="150"  value="<?= utf8_encode($class->dados['ENDERECO']) ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">N&uacute;mero/Complemento:<br />
                                            <input name="txtNumeroComplemento" type="text" id="txtNumeroComplemento" class="validate[required] txtNumeroComplemento tdNomesMedio" maxlength="60"  value="<?= $class->dados['NUM_COMPL'] ?>"/>
                                        </td>
                                        <td>CEP:<br />
                                            <input name="txtCEP" type="text" id="txtCEP" maxlength="9" value="<?= $class->dados['CEP'] ?>" maxlength="8"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Bairro:<br />
                                            <input name="txtBairro" type="text" id="txtBairro" class="validate[required] txtBairro tdNomesMedio" maxlength="45" value="<?= utf8_encode($class->dados['BAIRRO']) ?>" /></td>
                                        <td>Tipo da Escola:
                                            <br />
                                            <select name="cboTipoEscola" id="cboTipoEscola" class="validate[required] cboTipoEscola">
                                                <option></option>
                                                <?php
                                                foreach ($class->lstTipoEscola as $k => $v) {
                                                    ?>
                                                    <option value="<?= $v['IDTIPOESCOLA'] ?>" <?= $v['selected'] ?>><?= $v['DESCRICAO'] ?></option>								                            		
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            Nome do Diretor:<br />
                                            <input type="text" name="txtDiretorNome" id="txtDiretorNome" class="validate[required] txtDiretorNome tdNomes" clmaxlength="150" value="<?= utf8_encode($class->dados['DIRETOR_NOME']) ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            RG do diretor:<br />
                                            <input type="text" name="txtDiretorRg" id="txtDiretorRg" class="validate[required] txtDiretorRg" maxlength="9" value="<?= $class->dados['DIRETOR_RG'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>   
                                        <td>
                                            Telefone diretor:<br />
                                            <input type="text" name="txtDiretorFone" id="txtDiretorFone" class="validate[required] txtDiretorFone" maxlength="11" value="<?= $class->dados['DIRETOR_FONE'] ?>" />
                                        </td>
                                        <td>
                                            Telefone 1:<br />
                                            <input name="txtTelefone1" type="text" id="txtTelefone1" maxlength="11" value="<?= $class->dados['TELEFONE1'] ?>" />
                                        </td>
                                        <td>
                                            Telefone 2:<br />
                                            <input name="txtTelefone2" type="text" id="txtTelefone2" maxlength="11" value="<?= $class->dados['TELEFONE2'] ?>" />
                                        </td>
                                        <td>
                                            Fax:<br />
                                            <input name="txtFax" type="text" id="txtFax" maxlength="11" value="<?= $class->dados['FAXESCOLA'] ?>" />
                                        </td>                        
                                    </tr>
                                </table>
                            </div>
                        </div>            
                        <input id='cmdSalvar' class='Salvar' type='submit' value='Salvar' />
                    </form>                    

                </div>                
                <?php
                if ($class->dados['QTD_PROFESSOR'] > 0) {
                    ?>
                    <div id="menu1" class="tab-pane fade">

                        <table class="display" id="tabela" >
                            <thead>
                                <tr>
                                    <th width="40%">Nome</th>
                                    <th style='text-align:center;width:15%'>CPF</th>
                                    <th style='text-align:center;width:15%'>CREF</th>                       
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($class->lstProfessor as $k => $v) {
                                    ?>
                                    <tr id="linha<?= $v['IDPROFESSOR'] ?>">
                                        <td style='padding:12px'>
                                            <?= utf8_encode($v['NOME']) ?>
                                        </td>
                                        <td style='text-align:center'>
                                            <?= $v['CPF'] ?>
                                        </td>
                                        <td style='text-align:center'>
                                            <?= utf8_encode($v['CREF']) ?>									
                                        </td>                                        
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </body>
</html>
<?php

class cadastro_escola {

    public $request;
    public $response;
    public $lstEscola;
    public $lstCategoria;
    public $lstProfessor;
    public $lstTipoEscola;
    public $lstApelido;
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
        $this->lstTipoEscola = $this->sql->lstTipoEscola($param);

        if ($this->request['txtID'] > 0) {
            $this->dados = $this->sql->lstEscola($this->request);
            $this->dados = $this->dados[0];
            foreach ($this->lstTipoEscola as $k => $v) {
                if ($this->dados['IDTIPOESCOLA'] == $v['IDTIPOESCOLA']) {
                    $this->lstTipoEscola[$k]['selected'] = " selected";
                }
            }

            $param['txtIdEscola'] = $this->request['txtID'];
            $this->lstProfessor = $this->sql->lstProfessor($param);
        }
    }

    private function gravar($param) {
        require_once '../php/Gravar.php';
        $gravar = new Gravar();
        $this->response = $gravar->gravarEscola($param);
        if (!($this->request['txtID']>0)) {             
            $param=array("ID"=>"IDESCOLA","tabela"=>"OCG_ESCOLA");
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