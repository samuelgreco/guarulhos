<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Súmula de Jogo</title>
<link href="*" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script src="../js/jquery.click-calendario-1.0.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/validacao.js"></script>
<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/objeto.js"></script>
<script type="text/javascript" src="../js/select.js"></script>
<script type="text/javascript" src="../js/sumula.js"></script>
<link href="../css/estilo.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/jquery.click-calendario-1.0.css"/>
    
<script type="text/javascript">
    	              
    $(document).ready(function(){    	              
        $('#data').focus(function(){
        	$(this).calendario({
        		target:'#data'
        	});
        });                       
    });                     
            
</script> 

</head>

<body onload="CarregaLocais()">
<div id="container">
<div id="content">
<form action="" method="get">

<table width="700" border="0">
  <tr>
    <td>Competi&ccedil;&atilde;o:<br />
      <input name="txtCompeticao" type="text" id="txtCompeticao" value="Olimpiada Colegial" size="50" />
    </td>
    <td>Sigla:<br />
      <?php echo '<input name="txtSigla" type="text" id="txtSigla" value="'.$_GET[sigla].'" size="10" />';?>
    </td>
  </tr>
</table>

<table width="700" border="0">
  <tr>
    <td><font size=4>Jogo Nº:</font><label>
      <?php 
      	echo '<input class="input_nome_escolas" name="txtJogo" type="text" id="txtJogo"  value=' . $_GET[jogo] . ' size="3" disabled="disabled"/>';
      	echo '<input name="txtIDProva" type="hidden" id="txtIDProva"  value=' . $_GET[idProva] . ' />';
      ?>
      </label></td>
  </tr>
</table>

<table width="630" border="0">
  <tr>
    <td width="300">
      <?php echo '<input class="input_nome_escolas" name="txtTime1" type="text" id="txtTime1" value=' . str_replace("-","_",$_GET[time1]) . ' disabled="disabled"/></td>'?>
    <td width="20">
    	<font size=6>X</font></td>
    <td width="300">
      <?php echo '<input class="input_nome_escolas" name="txtTime2" type="text" id="txtTime2" value=' . str_replace("-","_",$_GET[time2]) . ' disabled="disabled"/></td>'?>
  </tr>
</table>

<br />

<table width="700" border="0">
  <tr>
    <td width="319"><label>Modelo da súmula:<br />
      <select name="cboTipo" id="cboTipo" style="margin-bottom:0px">
        <option value="Basquete">Basquete</option>
        <option value="Voleibol">Voleibol</option>
        <option value="Futsal">Futsal</option>
        <option value="Futebol">Futebol</option>
        <option value="Handebol">Handebol</option>
      </select>
    </label></td>
    <td width="77"><label>Sexo:<br />
        <?php echo '<input name="txtSexo" type="text" id="txtSexo" value=' . $_GET[sexo] . ' size="10" disabled="disabled"/>' ?>
    </label></td>
    <td width="290">Categoria:<br />
      <?php echo '<input name="txtCategoria" type="text" id="txtCategoria" value=' . $_GET[categoria] . ' size="25" disabled="disabled"/>'?></td>
  </tr>
</table>

<br />

<table width="700" border="0">
  <tr>
  
  <td width="450">Local:      <br />
      <select name="cboLocal" id="cboLocal" style="margin-bottom:0px">
        <option></option>
      </select></td>
  
    <td width="100" height="61" style="padding:0px">
    <label for="data">Data:</label>
       <input name="data" type="text" class="data" id="data" size="15" maxlength="10" readonly="readonly"/>
    </td>
    <td width="200">Horário:<br />
      <select name="cboHora" id="cboHora" style="margin-bottom:0px">
        <option value="07:00">07:00</option>
        <option value="07:30">07:30</option>
        <option value="08:00">08:00</option>
        <option value="08:30">08:30</option>
        <option value="09:00">09:00</option>
        <option value="09:30">09:30</option>
        <option value="09:40">09:40</option>
        <option value="10:00">10:00</option>
        <option value="10:20">10:20</option>
        <option value="10:30">10:30</option>
        <option value="11:00">11:00</option>
        <option value="11:30">11:30</option>
        <option value="11:40">11:40</option>
        <option value="12:00">12:00</option>
        <option value="12:20">12:20</option>
        <option value="12:30">12:30</option>
        <option value="13:00">13:00</option>
        <option value="13:30">13:30</option>
        <option value="13:40">13:40</option>
        <option value="14:00">14:00</option>
        <option value="14:20">14:20</option>
        <option value="14:30">14:30</option>
        <option value="15:00">15:00</option>
        <option value="15:30">15:30</option>
        <option value="15:40">15:40</option>
        <option value="16:00">16:00</option>
        <option value="16:30">16:30</option>
        <option value="17:00">17:00</option>
        <option value="17:30">17:30</option>
        <option value="18:00">18:00</option>
        <option value="18:30">18:30</option>
        <option value="19:00">19:00</option>
        <option value="19:30">19:30</option>
        <option value="20:00">20:00</option>
        <option value="20:30">20:30</option>
        <option value="21:00">21:00</option>
        <option value="21:30">21:30</option>
      </select></td>
    <td width="507">&nbsp;</td>
  </tr>
</table>
<br />
<table width="700" border="0">
  <tr>
    <td width="519"><label></label></td>
    <td width="84"><input type="button" name="cmdImprimirSumula" id="cmdImprimirSumula" value="Imprimir" class="botao" onclick='ImprimirSumula()'/></td>
  </tr>
</table>
</form>

</div>
</div>
</body>
</html>
