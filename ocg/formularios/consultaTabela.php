<?php
session_start();
$class = new consultaTabela();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>
        <script type="text/javascript" language="javascript" src="../js/lstTabela.js"></script>
    </head>
    <body class="bodyConsultaTabela">
        <div class="container" style='width:99%'>
            <form id="frmPesquisa" name="frmPesquisa" method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
                <h1>
                    Tabela
                    <input type="button" class="Voltar" style='margin-left:8%' onclick="history.go(-1);" />                   
                </h1>                
                <table width="680" border="0">
                    <tr>
                        <td width="250">
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
                        <td width="210">
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
                        <td>
                            Descri&ccedil;&atilde;o:<br />
                            <input name="txtDesc" type="text" id="txtDesc" size="60" />
                        </td>
                        <td>
                            <input type="submit" class="Pesquisar" value="Pesquisar" style='border:none;margin-top:13%;padding-left:50%;margin-left:20%'/>
                        </td>
                    </tr>
                </table>
                </br>
            </form>
            <br />
            <table class="display" id="tabela" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Descri&ccedil;&atilde;o</th>
                        <th>Modalidade</th>
                        <th>Categoria</th>
                        <th>Sexo</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					$anterior = 0;	
                    foreach ($class->lst as $k => $v) {
                    	if ($anterior != $v['IDPROVA'])
                    	{
                        ?>    
                        <tr id="linha<?= $v['IDPROVA'] ?>">
                            <td>
                                <?= utf8_encode($v['DESCPROVA']) ?>
                            </td>
                            <td>
                                <?= utf8_encode($v['DESCMODALIDADE']) ?>
                            </td>
                            <td>
                                <?= utf8_encode($v['DESCCATEGORIA']) ?>
                            </td>
                            <td>
                                <?= $v['SEXO'] ?>
                            </td>
                            <td>
                                <a href="tabelaJogos.php?txtIdProva=<?= $v['IDPROVA'] ?>" class='Editar'/></a>
                            </td>
                            <td class="tdBotao">
                                <a href="#" class="Remover" onclick="excluir(<?= $v['IDPROVA'] ?>)">&nbsp;</a>                    
                            </td>
                        </tr>
                        
                        <?php
                        $anterior = $v['IDPROVA'];
             			}
                    }
                    ?> 
                </tbody>
            </table>
        </div>
    </body>
</html>
<?php

class consultaTabela {

    public $request;
    public $lst;
    public $sql;
    public $lstModalidade;
    public $lstCategoria;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
        /*
          echo "<hr /><pre>";
          print_r($this->lst);
          echo "</pre><hr />";
          exit;
          */
    }

    private function getDados($param) {
        $this->lstModalidade = $this->sql->lstModalidade($this->request);
        $this->lstCategoria = $this->sql->lstCategoria($this->request);        
        $this->request['constaTabela']="sim";
        $this->lst = $this->sql->lstTabela($this->request);
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