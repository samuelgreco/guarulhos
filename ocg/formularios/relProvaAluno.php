<?php
session_start();
$class = new relProvaAluno();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>
   	<style>
	.tbDados{
    	width: 50%;
    }
    .cboEscola{
    	width: 50%;
    }
	</style>
  
    </head>
<body>
	<div class="container">
	<h1>Total de inscri&ccedil;&otilde;es por escola e total de alunos</h1>
		<form id="frmRelProvaAluno" name="frmRelProvaAluno" method="post" action="../relatorios/relProvaAluno.php" target="_self">
		  <table class="tbDados">
		    <tr>
		      <td>
		      	<label>Escola:</label><br />
		          <select name="cboEscola" value='<?= $v['NOME'] ?>' id="cboEscola" class="cboEscola">
		            <?php foreach ($class->lstEscola as $k => $v) {
		                                    ?>
		                                    <option value="<?= $v[IDESCOLA] ?>"><?= utf8_encode($v[NOME]) ?></option>
		                                    <?php
		                                    ;
		                                }
		                                ?>
		                                <option value='Todos'>TODAS ESCOLAS</option>
		          </select>
		      <input type="hidden" id="nomeEscola" name="nomeEscola" value="<?= $v[NOME] ?>" /><br /><br />
			  <input type="submit" name="cmdExibir" id="cmdExibir" value="Exibir" class="Salvar"/>
		      </td>
		    </tr>
		  </table>
		</form>
		<br />
	</div>
</body>
</html>
<?php

class relProvaAluno {

    public $request;
    public $lstEscola;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
    }

    private function getDados($param) {
      if ($_SESSION['IDPERFIL'] == 2) {
	    	$param = array("txtID" => $_SESSION['IDESCOLA']);
      }
    	$this->lstEscola = $this->sql->lstEscola($param);
    	
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
