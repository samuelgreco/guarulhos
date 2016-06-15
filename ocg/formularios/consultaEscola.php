<?php
session_start();
$class = new consultaEscola();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>
        <style>
            .tdBotao{
                width: 7.5%;
            }
        </style>
        <script type="text/javascript" language="javascript" src="../js/lstEscola.js"></script>
    </head>
    <body class="bodyConsultaEscola">
        <div class="container" style='width:99%'>
            <form class="frmPesquisa" id="frmPesquisa" name="frmPesquisa" method="get" action="consultaEscola.php">
                <h1>
                    Escola
                    <a href="cadastro_escola.php" id="btnNovo" class="Novo">Novo</a>
                    <input type="button" class="Voltar" style='margin-left:0%; display: none;' onclick="history.go(-1);" />
                </h1>
                <br />
                <table>
                    <tr>
                        <td>Nome:<br />
                            <input type="text" name="txtNome" id="txtNome" class="txtNome"  maxlength="100"  />
                        </td>
                        <td >Apelido:<br />
                            <input type="text" name="txtApelido" id="txtApelido" class="txtApelido" maxlength="13"  />
                        </td>
                        <td>Diretor:<br />
                            <input type="text" name="txtDiretor" id="txtDiretor" class="txtDiretor" maxlength="11"  />
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
                        <th width="35%">Nome</th>
                        <th style='text-align:center;width:100px'>Apelido</th>
                        <th style='text-align:center;width:100px'>Diretor</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($class->lst as $k => $v) {
                        ?>
                        <tr id="linha<?= $v['IDESCOLA'] ?>">
                            <td style='padding:12px'>
                               <b> <?= strtoupper(utf8_encode($v['NOME'])) ?> </b>
                            </td>
                            <td style='text-align:center'>
                                <?= strtoupper(utf8_encode($v['APELIDO'])) ?>
                            </td>
                            <td style='text-align:center'>
                                <?= strtoupper(utf8_encode($v['DIRETOR_NOME'])) ?>
                            </td>
                            <td class="tdBotao">
                                <a href="cadastro_escola.php?txtID=<?= $v['IDESCOLA'] ?>" class='Editar'/></a>
                            </td>
                            <td class="tdBotao">
                                <?php
                                    if (!($v['QTD_PROFESSOR'] > 0)) {
                                        ?>                            
                                        <a href="#" class="Remover" onclick="excluir(<?= $v['IDESCOLA'] ?>)">&nbsp;</a>
                                        <?php
                                    }
                                    ?>
                            </td>
                            <?php
                        }
                        ?>                                
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
<?php

class consultaEscola {

    public $request;
    public $lst;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        /*
          echo "<pre>";
          print_r($this->request);
          echo "</pre>";
          exit;
         */
        $this->getDados($param);
    }

    private function getDados($param) {        
        $this->lst = $this->sql->lstEscola($this->request);
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