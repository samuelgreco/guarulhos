<?php
$class = new cadProva();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>        
        <style type="">
            .tbDados{
                width: 100%;
            }
            .txtDesc #txtDescricao{
                width:100%;
            }   
            .select{
                width:160px;
            }
        </style>
        <script type="text/javascript" src="../js/cadProva.js"></script>
    </head>
    <body class="bodyCadastroProva">
        <div class="container">
            <input type="hidden" name="mensagem" id="mensagem" value="<?= $class->response['mensagem'] ?>"/>
            <h1>
                Cadastro de Prova
                <a class="pull-right Voltar" href="consultaProva.php" /></a>
            </h1>  
            <ul class="nav nav-tabs">
                <li class="active ">
                    <a data-toggle="tab" href="#home">
                        Cadastro
                    </a>
                </li>               
                <?php
                if ($class->dados['IDPROVA'] > 0) {
                    ?>
                    <li>
                        <a data-toggle="tab" href="#menu1">
                            Escolas inscritas
                        </a>                    
                    </li>
                    <?php
                }
                ?>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <form id="frmCadastro" name="frmCadastro" class="frmCadastro" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <input name="filtro" type="hidden" id="filtro" value="gravar" />
                        <input name="txtID" type="hidden" id="txtID" value="<?= $class->dados['IDPROVA'] ?>" />
                        <div class="panel panel-default" style="border: none;">
                            <div class="panel-body">
                                <table class="table table-striped tbDados">
                                    <tr>
                                        <td>
                                            Modalidade:
                                            <br />                            
                                            <select name="cboModalidade" id="cboModalidade" class="validate[required] cboModalidade select">
                                                <option value="">&nbsp;</option>
                                                <?php
                                                foreach ($class->lstModalidade as $k => $v) {
                                                    ?>   
                                                    <option value="<?= $v['IDMODALIDADE'] ?>" <?= $v['selected'] ?>><?= utf8_encode($v['DESCRICAO']) ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>                    
                                        <td>Categoria:<br />
                                            <select name="cboCategoria" id="cboCategoria" class="validate[required] cboCategoria select">
                                                <option value="">&nbsp;</option>
                                                <?php
                                                foreach ($class->lstCategoria as $k => $v) {
                                                    ?>   
                                                    <option value="<?= $v['IDCATEGORIA'] ?>" <?= $v['selected'] ?>><?= utf8_encode($v['DESCRICAO']) ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>    
                                        </td>                            
                                    </tr>
                                    <tr>
                                        <td>Sexo:<br />
                                            <select name="cboSexo" id="cboSexo" class="validate[required] cboSexo select">
                                                <?php
                                                foreach ($class->lstSexo as $k => $v) {
                                                    ?>   
                                                    <option value="<?= $v['SIGLA'] ?>" <?= $v['selected'] ?>><?= utf8_encode($v['DESCRICAO']) ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>Tipo:<br />                                            
                                            <select name="cboTipo" id="cboTipo" class="validate[required] cboTipo select">
                                                <option value="">&nbsp;</option>
                                                <?php
                                                foreach ($class->lstTipoDisputa as $k => $v) {
                                                    ?>   
                                                    <option value="<?= $v['IDTIPODISPUTA'] ?>" <?= $v['selected'] ?>><?= utf8_encode($v['DESCRICAO']) ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>       
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Sigla:<br />
                                            <input value="<?= $class->dados['SIGLA'] ?>"  name="txtSigla" type="text" id="txtSigla" style='width:65px' class="validate[required] txtSigla" maxlength="10"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Descri&ccedil;&atilde;o:<br />
                                            <input value="<?= $class->dados['DESCRICAO'] ?>" name="txtDescricao" type="text" id="txtDescricao" class="validate[required] txtDescricao" maxlength="30" style="width:25%;"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>        
                    </form>            
                    <input id='cmdSalvar' class='Salvar' type='submit' value='Salvar' />
                </div>
                <?php
                if ($class->dados['IDPROVA'] > 0) {
                    ?>
                    <div id="menu1" class="tab-pane fade">
                        <table class="display" id="tabela" >
                            <thead>
                                <tr>
                                    <th width="40%">Nome</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($class->lstEscola as $k => $v) {
                                    ?>
                                    <tr id="linha<?= $v['IDPROFESSOR'] ?>">
                                        <td>
                                            <?= utf8_encode($v['NOME']) ?>
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

class cadProva {

    public $request;
    public $dados;
    public $lstModalidade;
    public $lstTipoDisputa;
    public $lstCategoria;
    public $lstSexo;    
    public $lstEscola;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        if ($this->request['filtro'] == "gravar") {
            $this->gravar($param);
        }
        $this->getDados($param);
    }

    private function getDados($param) {
        $this->lstModalidade = $this->sql->lstModalidade($param);
        $this->lstCategoria = $this->sql->lstCategoria($param);
        $this->lstTipoDisputa = $this->sql->lstTipoDisputa($param);        
        /*
          echo "<pre>";
          print_r($this->lstTipoDisputa);
          echo "</pre>";
          exit;
         */
        $param = array("txtIdCategoria" => $this->request['cboCategoria'], "txtIdModalidade" => $this->request['cboModalidade']);
        if ($this->request['txtID'] > 0) {
            $this->dados = $this->sql->lstProva($this->request);
            $this->dados = $this->dados[0];

            foreach ($this->lstModalidade as $k => $v) {
                if ($this->dados['IDMODALIDADE'] == $v['IDMODALIDADE']) {
                    $this->lstModalidade[$k]['selected'] = " selected";
                }
            }
            foreach ($this->lstCategoria as $k => $v) {
                if ($this->dados['IDCATEGORIA'] == $v['IDCATEGORIA']) {
                    $this->lstCategoria[$k]['selected'] = " selected";
                }
            }
            foreach ($this->lstTipoDisputa as $k => $v) {
                if ($this->dados['IDTIPODISPUTA'] == $v['IDTIPODISPUTA']) {
                    $this->lstTipoDisputa[$k]['selected'] = " selected";
                }
            }            
            $param = array("txtIdProva" => $this->request['txtID']);
            $this->lstEscola= $this->sql->lstEscola($param);
        }
        $param = array("txtIdSexo" => $this->dados['IDSEXO']);
        $this->lstSexo = $this->sql->lstSexo($param);
        /*

         */
    }
    
    private function gravar($param) {
        require_once '../php/Gravar.php';
        $gravar = new Gravar();
        $this->response = $gravar->gravarProva($param);
        if (!($this->request['txtID'] > 0)) {
            $param = array("ID" => "IDPROVA", "tabela" => "ocg_prova");
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

