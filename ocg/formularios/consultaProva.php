<?php
$class = new consultaProva();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>        
        <style>
            .tdBotao{text-align: center;}
            .Novo{
                padding: 0.75%;padding-left: 2.5%;position: relative;margin-left: 75%;margin-bottom: 1%;
            }
            .frmPesquisa{
                margin-bottom: 0.5%;width: 100%;
            }
            .tbPesquisa{
                width: 100%;
            }
        </style>
    <script type="text/javascript" language="javascript" src="../js/lstProva.js"></script>
    </head>
    <body class="bodyConsultaProva">        
        <div class="container" style='width:99%'>
            <form id="frmPesquisa" name="frmPesquisa" class="frmPesquisa" method="get" action="<?= $_SERVER['PHP_SELF'] ?>"> 
                <h1>Prova
                    <a href="cadastro_prova.php" class="Novo">&nbsp;Novo</a>      
                    <input type="button" class="Voltar" style='margin-left:0%' onclick="history.go(-1);" />   
                </h1>
                <br />          
                <table class="tbPesquisa">
                    <tr>
                        <td style="width: 10%;">
                            Modalidade:<br />
                            <select name="cboModalidade" id="cboModalidade">
                                <option value="">&nbsp;</option>
                                <?php
                                foreach ($class->lstModalidade as $k => $v) {
                                    ?>   
                                    <option value="<?= $v['IDMODALIDADE'] ?>"><?= utf8_encode($v['DESCRICAO']) ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td style="width: 15%;">
                            Categoria:<br />
                            <select name="cboCategoria" id="cboCategoria">
                                <option value="">&nbsp;</option>
                                <?php
                                foreach ($class->lstCategoria as $k => $v) {
                                    ?>   
                                    <option value="<?= $v['IDCATEGORIA'] ?>"><?= utf8_encode($v['DESCRICAO']) ?></option>
                                    <?php
                                }
                                ?>
                            </select>                            
                        </td>
                        <td style="width: 20%;">
                            Descri&ccedil;&atilde;o:<br />
                            <input name="txtDesc" type="text" id="txtDesc" size="60" />
                        </td>
                        <td class="tdBotao">
                            <input type="submit" class="Pesquisar" value="Pesquisar" style='border:none;margin-top:5%;padding-left:10%;margin-left:-60%'/></td>
                        </td>
                    </tr>
                </table>
            </form>
            <br />
            <table class="display" id="tabela" >
                <thead>
                    <tr  style='height:21px'>
                        <th  width="30%">Descri&ccedil;&atilde;o:</th>
                        <th style='text-align:center' width="10%">Modalidade</th>
                        <th style='text-align:center' width="10%">Categoria</th>
                        <th style='text-align:center' width="5%">Sexo</th>
                        <th style='text-align:center' width="8%">Qtd. Esc. Inscr.</th>
                        <th style="text-align:center;width:10%;">Editar</th>
                        <th style="text-align:center;width:10%;">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($class->lst as $k => $v) {
                        ?>
                        <tr id="linha<?= $v['IDPROVA'] ?>"  style='height:41px'>
                            <td>
                              <b>  <?= utf8_encode($v['DESCRICAO']) ?> </b>
                            </td>
                            <td style='text-align:center'>
                                <?= utf8_encode($v['DESCMODALIDADE']) ?>
                            </td>
                            <td style='text-align:center'>
                                <?= utf8_encode($v['DESCCATEGORIA']) ?>                                    
                            </td>
                            <td style='text-align:center'>
                                <?= $v['DESCSEXO'] ?>
                            </td>
                            <td class="tdBotao">
                                <?= $v['QTDE_INSC_ESC'] ?>
                            </td>
                            <td class="tdBotao">
                                <a href="cadastro_prova.php?txtID=<?= $v['IDPROVA'] ?>" class='Editar'>&nbsp;</a>                    
                            </td>
                            <td class="tdBotao">
                                <?php
                                if (!($v['QTDE_INSC_ESC'] > 0)) {
                                    ?>                            
                                    <a href="#" onclick="excluir(<?= $v['IDPROVA'] ?>)" class='Remover'>&nbsp;</a>
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

class consultaProva {

    public $request;
    public $lst;
    public $lstModalidade;
    public $lstCategoria;
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
        $this->lstModalidade = $this->sql->lstModalidade($param);
        $this->lstCategoria = $this->sql->lstCategoria($param);
        $param = array("txtIdCategoria" => $this->request['cboCategoria'], "txtDescricao" => $this->request['txtDescricao'], "txtIdModalidade" => $this->request['cboModalidade']);
        $this->lst = $this->sql->lstProva($param);
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
