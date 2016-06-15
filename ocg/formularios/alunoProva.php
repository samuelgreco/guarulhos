<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	require_once 'head.php';
?>
<script type="text/javascript" src="../js/alunoProva.js"></script>
</head>

<body class="alunoProva">
	<div class="container">
		<h1>
			Alunos por Prova<br />
		</h1>
		<form id="frmCadProva" name="frmCadProva" method="post" action="../relatorios/relAlunoProva.php">
		  <table class="tb">
		    <tr>
		      <td >
		      	<label>Prova:</label><br />
		      	  <select name="cboProva" id="cboProva">
		          </select>
		      </td>
		      <td width="324">&nbsp;</td>
		    </tr>
		  </table>
		  <table class="tb">
		    <tr>
		      <td width="150"><label>
		        <input type="submit" name="cmdImprimir" id="cmdImprimir" value="Imprimir" class="Imprimir"/>
		      </label></td>
		      <td width="540">&nbsp;</td>
		    </tr>
		  </table>
		  <br />
		<br />
		</form> 
		<br />
	</div>
</body>
</html>