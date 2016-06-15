<?php
$class = new cadastro_professor();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Sistema DPIE</title>
        <?php
        require_once '../formularios/head.php';
        ?>        
        <style>
            .bodyCadastroProfesor th{
                width: 15%;
            }
            .txtDados{
                width: 90%;
            }
            .tbDados{
                width: 100%;
            }
            .btnExcluir{
                color:white;
                background-color: #BB4545;
                width: 100px;
                padding-right:1px;
            }
            .btnAdicionar{
                color:white;
                background-color: #5A8862;
                width: 100px;
                padding-right:1px;
            }
            .cboEscolaExclusa{
                width: 555px;
            }

            .cboEscolaInclusa{
                width: 555px;
            }

        </style>
    <script type="text/javascript" src="../js/cadProfessor.js"></script>
    </head>
    <body class="bodyCadastroProfesor">
        <div class="container"> 
            <input type="hidden" name="mensagem" id="mensagem" value="<?= $class->response['mensagem'] ?>"/>
            <h1>
                Cadastro de Usu&aacute;rio / Professor
                <a class="pull-right Voltar" href="consultaProfessor.php" /></a>
            </h1>
            <ul class="nav nav-tabs">
                <li class="active ">
                    <a data-toggle="tab" href="#home">
                        Cadastro
                    </a>
                </li>               
                <?php
                if ($class->dados['IDPROFESSOR'] > 0) {
                    ?>
                    <li>
                        <a data-toggle="tab" href="#menu1">
                            Escolas do Professor
                        </a>                    
                    </li>
                    <?php
                }
                ?>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <form id="frmCadastro" name="frmCadastro" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" role="form" class="form-group required frmCadastro" data-toggle="validator">
                        <input type="hidden" name="filtro" id="filtro" value="gravar"/>
                        <input type="hidden" name="txtID" id="txtID" value="<?= $class->dados['IDPROFESSOR'] ?>"/>
                        <input type="hidden" name="acao" id="acao" value="salvar"/>
                        <div class="panel panel-default" style="border: none;">
                            <div class="panel-body">
                                <table class="table table-striped tbDados">
                                    <tbody>
                                        <tr>
                                            <th>CPF:</th>
                                            <td>
                                                <input type="text" name="txtCpf" id="txtCpf" class="validate[required] txtCpf"  maxlength="11" value="<?= $class->dados['CPF'] ?>"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Nome:</th>
                                            <td>
                                                <input type="text" name="txtNome" id="txtNome" class="validate[required] txtDados" maxlength="150" value="<?= utf8_encode($class->dados['NOME']) ?>" />
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <th>CREF:</th>
                                            <td>
                                                <input type="text" name="txtCREF" id="txtCREF" class="validate[required] txtCREF" maxlength="12" value="<?= $class->dados['CREF'] ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Telefone:</th>
                                            <td>
                                                <input type="text" name="txtFone" id="txtFone" class="validate[required] txtFone" maxlength="10" value="<?= $class->dados['TEL'] ?>"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Celular:</th>
                                            <td>
                                                <input type="text" name="txtCelular" id="txtCelular" class="txtCelular" maxlength="11" value="<?= $class->dados['CEL'] ?>"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td>
                                                <input type="email" name="txtEmail" id="txtEmail" class="validate[required] txtDados" maxlength="150" value="<?= $class->dados['EMAIL'] ?>"/>
                                            </td>
                                        </tr>
                                        <tr class="trDadosEditar">
                                            <th for="txtLogin">
                                                Login: 
                                            </th>
                                            <td>
                                                <input value="<?= $class->dados['LOGIN'] ?>" type="text" name="txtLogin" id="txtLogin" class="validate[required] txtLogin" maxlength="20"/>
                                            </td>
                                        </tr>
                                        <tr class="trDadosEditar">
                                            <th for="txtSenha">
                                                Senha: 
                                            </th>
                                            <td>
                                                <input type="password" name="txtSenha" id="txtSenha" class=" txtSenha" maxlength="20"/>
                                            </td>
                                        </tr>
                                        <tr class="trDadosEditar">
                                            <th for="txtSenhaRepetir">
                                                Repita a Senha: 
                                            </th>
                                            <td>
                                                <input type="password" name="txtSenhaRepetir" id="txtSenhaRepetir" class=" txtSenhaRepetir" maxlength="20"/>
                                            </td>
                                        </tr>
                                        <tr class="trDadosEditar">
                                            <th for="cboPerfil">
                                                Perfil de Usuario: 
                                            </th>
                                            <td>
                                                <select id="cboPerfil" name="cboPerfil" class="validate[required] cboPerfil">
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($class->lstPerfil as $k => $v) {
                                                        ?>
                                                        <option value="<?= $v['IDPERFIL'] ?>" <?= $v['selected'] ?>><?= $v['NOME'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>                                
                                            </td>
                                        </tr>                                       
                                        <tr class="trDadosEditar">
                                            <th for="txtStatus">
                                                Status:*
                                            </th>
                                            <td>
                                                <select id="cboStatus" name="cboStatus" class="required validate[required] cboStatus">
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($class->lstStatus as $k => $v) {
                                                        ?>
                                                        <option value="<?= $v['IDSTATUS'] ?>" <?= $v['selected'] ?>><?= $v['NOME'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>                                
                                            </td>
                                        </tr>
                                    </tbody>     
                                </table>                        
                            </div>
                        </div>
                        <input id='cmdSalvar' class='Salvar' style='margin-left:2%' type='submit' value='Salvar' />
                    </form>
                </div>
                <?php
                if ($class->dados['IDPROFESSOR'] > 0) {
                    ?>
                    <div id="menu1" class="tab-pane fade">
                        <table>
                            <tr>
                                <td >Escola:<br />
                                    <select name="cboEscolaExclusa" id="cboEscolaExclusa" class="validate[required] cboEscolaExclusa">
                                        <option value="">&nbsp;</option>
                                        <?php
                                        foreach ($class->lstEscolaExclusa as $k => $v) {
                                            ?>
                                            <option value="<?= $v['IDESCOLA'] ?>"><?= utf8_encode($v['NOME']) ?></option>								                            		
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <br />
                                    <input type="button" name="cmdAddEscola" id="cmdAddEscola" value="Adicionar" class="botao btnAdicionar" onclick="addEscola()"/>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>                  

                                    <select name="cboEscolaInclusa" size="6" id="cboEscolaInclusa" class="list validate[required] cboEscolaInclusa">                                        
                                        <?php
                                        foreach ($class->lstEscolaInclusa as $k => $v) {
                                            ?>
                                            <option value="<?= $v['IDESCOLA'] ?>"><?= utf8_encode($v['NOME']) ?></option>								                            		
                                            <?php
                                        }
                                        ?>
                                    </select>                                        
                                </td>
                                <td>
                                    <input type="button" name="cmdExcluir" id="cmdExcluir" value="Excluir" class="botao btnExcluir" onclick="excluiEscola()"/>
                                </td>
                            </tr>                            
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

class cadastro_professor {

    public $request;
    public $dados;
    public $lstEscolaInclusa;
    public $lstEscolaExclusa;
    public $lstEscola;
    public $lstSexo;
    public $lstStatus;
    public $lstPerfil;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        if ($this->request['filtro'] == "gravar") {
            $this->gravar($param);
        }
        $this->getDados($param);
    }

    private function getDados($param) {
        //$this->lstModalidade = $this->sql->lstModalidade($param);
        //$this->lstCategoria = $this->sql->lstCategoria($param);

        
        if ($this->request['txtID'] > 0) {
            $param = array("txtID" => $this->request['txtID']);
            $this->dados = $this->sql->lstProfessor($param);
            $this->dados = $this->dados[0];
            
            $param = array("txtIdProfessorNotIn" => $this->request['txtID']);
            $this->lstEscolaExclusa = $this->sql->lstEscola($param);
            $param = array("txtIdProfessorIn" => $this->request['txtID']);
            $this->lstEscolaInclusa = $this->sql->lstEscola($param);
        }
        /*  $this->lstEscola = $this->sql->lstEscola($param);
          foreach ($this->lstEscola as $k => $v) {
          if ($this->dados['IDESCOLA'] == $v['IDESCOLA']) {
          $this->lstEscola[$k]['selected'] = " selected";
          }
          } */

        $param = array("txtIdSexo" => $this->dados['IDSEXO']);
        $this->lstSexo = $this->sql->lstSexo($param);
        $this->lstPerfil = $this->sql->lstPerfilUsuario($param);
        foreach ($this->lstPerfil as $k => $v) {
            if ($this->dados['IDPERFIL'] == $v['IDPERFIL']) {
                $this->lstPerfil[$k]['selected'] = " selected";
            }
        }

        $this->lstStatus = $this->sql->lstStatusUsuario($param);
        foreach ($this->lstStatus as $k => $v) {
            if ($this->dados['IDSTATUS'] == $v['IDSTATUS']) {
                $this->lstStatus[$k]['selected'] = " selected";
            }
        }
        /*
          echo "<pre>";
          print_r($this->dados);
          echo "</pre>";
          exit;
          */
    }

    private function gravar($param) {
        require_once '../php/Gravar.php';
        $gravar = new Gravar();
        $this->response = $gravar->gravarProfessor($param);
        if (!($this->request['txtID'] > 0)) {
            $param = array("ID" => "IDPROFESSOR", "tabela" => "ocg_usuario");
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

