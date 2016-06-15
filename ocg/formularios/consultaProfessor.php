<?php
session_start();
$class = new consultaProfessor();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>
        <style>
            .Pesquisar{
                border: none;
            }
        </style>
        <script type="text/javascript" language="javascript" src="../js/lstProfessor.js"></script>

    </head>
    <body class="bodyConsultaProfessor">
        <div class="container" style='width:99%'>
            <form id="frmPesquisa" name="frmPesquisa" class="frmPesquisa" method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
                <h1>
                    Professores
                    <a href="cadastro_professor.php" id="btnNovo" class="Novo">Novo</a>
                    <input type="button" class="Voltar" style='margin-left:0%' onclick="history.go(-1);" />
                </h1>
                <br />
                <table style="width: 100%;">
                    <tr>
                        <td>
                            Escola:<br />		                            
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
                        <td>
                            Nome:
                            <input type="text" name='txtNome' id='txtNome' style="width:95%;" maxlength="100"  />
                        </td>
                        <td width="20%">CPF:<br />
                            <input type="text" name='txtCpf' id='txtCpf' style="width:95%;" maxlength="13"  />
                        </td>
                        <td width="20%">CREF:<br />
                            <input type="text" name='txtCREF' id='txtCREF' style="width:95%;" maxlength="11"  />
                        </td>
                        <td>
                            <input type="submit" class="Pesquisar" value="Pesquisar" style='border:none;margin-top:10%;'/> 
                        </td>
                    </tr>
                </table>
            </form>
            <br />
            <table class="display" id="tabela" >
                <thead>
                    <tr>
                        <th width="40%">Nome</th>
                        <th style='text-align:center;width:15%'>CPF</th>
                        <th style='text-align:center;width:15%'>CREF</th>
                        <th style='text-align:center;width:15%'>Qtd. Esc.</th>                        
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($class->lst as $k => $v) {
                        ?>
                        <tr id="linha<?= $v['IDPROFESSOR'] ?>">
                            <td style='padding:12px;'>
                                <?= utf8_encode($v['NOME']) ?>
                            </td>
                            <td style='text-align:center'>
                                <?= $v['CPF'] ?>
                            </td>
                            <td style='text-align:center'>
                                <?= utf8_encode($v['CREF']) ?>									
                            </td>
                            <td class='tdBotao'>
                                <?= $v['QTDE_ESCOLA'] ?>
                            </td>
                            <td class='tdBotao'>
                                <a href="cadastro_professor.php?txtID=<?= $v['IDPROFESSOR'] ?> " class='Editar'/></a>
                            </td>
                            <td class="tdBotao">
                                <?php
                                if (!($v['QTDE_ESCOLA'] > 0)) {
                                    ?>
                                    <a href="#" class="Remover" onclick="excluir(<?= $v['IDPROFESSOR'] ?>)">&nbsp;</a>                    
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
<?php

class consultaProfessor {

    public $request;
    public $lst;
    public $sql;
    public $lstEscola;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
        //print_r($this->lst);
    }

    private function getDados($param) {
        $this->lstEscola = $this->sql->lstEscola($param);
        $this->request['txtIdEscola']=$this->request['cboEscola'];
        $this->lst = $this->sql->lstProfessor($this->request);
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