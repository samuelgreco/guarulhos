<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	require_once 'head.php';
?>
<script type="text/javascript" src="../js/selecionaProfessor.js"></script>
<style>
 	.cboProfessor{
 		width:100%;
 	}
 	.tbDados {
 		width:40%;
 	}
</style>
</head>
<body onload="iniciar(1)">
	<div class="container">
	<h1>Professor respons&aacute;vel por prova</h1>
		<form id="frmRelSelecionaProfessor" name="frmRelSelecionaProfessor" method="post" action="" target="_blank">
			  <table class="tbDados">
			    <tr>
			      <td>
				      <label>Selecione o professor:</label><br />
				      <select name="cboProfessor" id="cboProfessor" class="cboProfessor">
				      </select> 	
				      <input type="hidden" id="idEscola" value="<?= $_GET["IDEscola"] ?>" />
				      <input type="hidden" id="idProva" value="<?= $_GET["IDProva"] ?>" />
				      <input type="hidden" id="acao" value="<?= $_GET["acao"]?>" />
			      </td>
			    </tr>
			  </table>
		</form>
	 <input type="submit" name="cmdInscrever" id="cmdInscrever" value="Inscrever" class="Salvar" onclick="inscrever()"/>
	</div>
</body>
</html>
