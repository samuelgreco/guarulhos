<?php
session_start();
$class = new relSelecionaEscola();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
        <?php
        require_once 'head_lst.php';
   
        ?>
	<script type="text/javascript" src="../js/selecionaEscola.js"></script>
	<style>
	.tbDados{
    	width: 50%;
    }
    .cboEscola{
    	width: 50%;
    }
    .cboTipo{
    	width: 50%;
    }
	</style>
</head>
<body onload="iniciar(1)">
<div class="container">
<h1>Provas por escola</h1>
<form id="frmRelSelecionaEscola" name="frmRelSelecionaEscola" method="post" action="../relatorios/relProvaEscola.php" target="_self">
  <table class="tbDados">
    <tr>
      <td><label>Escola:</label><br />
          <select name="cboEscola" id="cboEscola" class="cboEscola">
          	<?php foreach ($class->lst as $k => $v) {
            ?>
            <option value="<?= $v[IDESCOLA] ?>"><?= utf8_encode($v[NOME]) ?></option>
            <?php
            ;}
            ?>
            <option value='Todos'>TODAS ESCOLAS</option>
          </select>
      <input type="hidden" id="nomeEscola" name="nomeEscola" value="" /><br /><br />
      <input type="submit" name="cmdExibir" id="cmdExibir" value="Exibir" class="Salvar"/>
      </td>
    </tr>
  </table>
  <table width="700" border="0">
    <tr>
      <td width="150"><label>
        
      </label></td>
      <td width="540">&nbsp;</td>
    </tr>
  </table>
  <br />
<br />
</form> <br />
</div>
</div>
</body>
</html>
<?php

class relSelecionaEscola {

    public $request;
    public $lst;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
    }

    private function getDados($param) {
      if ($_SESSION['IDPERFIL'] == 2) {
	    	$param = array("txtID" => $_SESSION['IDESCOLA']);
      }
    	$this->lst = $this->sql->lstEscola($param);
    	
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
