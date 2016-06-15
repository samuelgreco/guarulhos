<?php
session_start();
$class = new consultaAluno();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>
        <style>
            
        </style>
        <script type="text/javascript" src="../../../lib/js/jquery.ui.datepicker-pt-BR.js"></script>
        <script type="text/javascript" language="javascript" src="../js/lstAluno.js"></script>
    </head>
    <body class="bodyConsultaAluno">
        <div class="container" style='width:99%'>
            <form class="frmPesquisa" id="frmPesquisa" name="frmPesquisa" method="POST" action="consultaAluno.php">
                <h1>
                    Aluno
                    <?php
                    if ($class->lstTrava[0]['ALUNOINSERT'] == 1) {
                        ?>
                        <a href="cadastro_aluno.php" id="btnNovo" class="Novo">Novo</a>
                        <?php
                    }
                    ?>
                    <input type="button" class="Voltar" style='margin-left:0%' onclick="history.go(-1);" />
                </h1>
                <br />
                <table >
                    <tr>
                        <td>
                            Escola:<br />
                            <select name="cboEscola" id="cboEscola" class="cboEscola">
                                <option value=0>Selecione a escola</option>
                                <?php foreach ($class->lstEscola as $k => $v) {
                                    ?>
                                    <option value="<?= $v['IDESCOLA'] ?>"><?= utf8_encode($v['NOME']) ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            Nome:<br />
                            <input type="text" name='txtNome' id='txtNome' size="40" maxlength="100"  />
                        </td>
                        <td>
                            Data de Nascimento:<br />
                            <input type="text" name="txtDtNasc"  id="txtDtNasc" class="validate[required]"  maxlength="10" placeholder="DD/MM/AAAA"/>
                        </td>				
                        <td>
                            <input type="submit" class="Pesquisar" value="Pesquisar" style='border:none;margin-top:10%'/> 
                        </td>
                    </tr>
                </table>
            </form>
            <br />
            <table class="display" id="tabela" >
                <thead>
                    <tr>
                        <th style='text-align:center' width="30%">Nome</th>
                        <th style='text-align:center' width="10%">Idade</th>
                        <th style='text-align:center' width="10%">Categoria</th>
                        <th style='text-align:center' width="15%">RG</th>
                        <th style='text-align:center' width="25%">Escola</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($class->lst as $k => $v) {
                        ?>    
                        <tr id="linha<?= $v['IDALUNO'] ?>">
                            <td style='padding:12px'>
                              <b>  <?= strtoupper(utf8_encode($v['NOMEALUNO'])) ?> </b>
                            </td>
                            <td style='text-align:center'>
                                <?= 2016 - $v['DTNASC2'] ?>
                            </td>
                            <td style='text-align:center'>
                                <?= strtoupper(utf8_encode($v['DESCCATEGORIA'])) ?>
                            </td>
                            <td style='text-align:center'>
                              <center>  <?= utf8_encode($v['RG']) ?> </center>
                            </td>
                            <td style='text-align:center'>
                                <?= strtoupper(utf8_encode($v['NOMEESCOLA'])) ?>
                            </td>
                            <td style='text-align:center'>
                                <?php
                                if ($class->lstTrava[0]['ALUNOUPDATE'] == 1) {
                                    ?>
                                    <a href="cadastro_aluno.php?txtID=<?= $v['IDALUNO'] ?>" class='Editar'/></a>                                    
                                    <?php
                                }
                                ?>
                            </td>
                            <td style='text-align:center' class="tdBotao">
                                <?php
                                if ((!($v['QTDE_INSCRICAO'] > 0)) && ($class->lstTrava[0]['ALUNODELETE'] == 1)) {
                                    ?>
                                    <a href="#" class="Remover2" onclick="excluir(<?= $v['IDALUNO'] ?>)">&nbsp;</a>
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

class consultaAluno {

    public $request;
    public $lstEscola;
    public $lstTrava;
    public $lst;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
        /*
          echo "<pre>";
          print_r($this->lst);
          echo "</pre>";
          exit;
         */
    }

    private function getDados($param) {
        $this->lstTrava = $this->sql->lstTrava($param);
        $this->lstEscola = $this->sql->lstEscola($param);
        $this->lst = $this->sql->lstAluno($this->request);
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

    private function verificarSePodeExcluir($param) {
        foreach ($this->lst as $k => $v) {
            if ($v['IDUSUARIO'] > 0) {
                $this->lst[$k]['podeExcluir'] = 1;
            }
        }
    }

}

// FIM DA CLASSE
?>