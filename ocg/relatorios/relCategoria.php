<?php
session_start();
$class = new relCategoria();
//print_r($class->request);exit;
//print_r($_POST);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <?php
        require_once '../formularios/head.php';
        ?>
           <link href="../css/style.css" rel="stylesheet" type="text/css" />
    	<link href="../css/estilo_relatorio.css" rel="stylesheet" type="text/css" />
	    <link href="../css/estilo_relatorioPrint.css" rel="stylesheet" type="text/css" media="print" />
        <link charset="utf-8" type="text/css" rel="stylesheet" href="../../../lib/css/estilo.css" />
        <style>
        	.bodyRelCategoria{
    			padding-left: 20px;
    			width: 955px;
			}
        </style>
  	</head>      
        <body class="bodyRelCategoria">
         <table>
	                <tr>
	                    <td>
	                    	<div style='margin-top:-5%'>
	                    		<img src=../imagem/ocg.png width=91 />
	                    	</div>
	                    	
	                    </td>
	                    <td class="corpo" align="center"  style='display:inline;margin-left:30%'>
		                    <font size=6><b >Categorias</b></font>
		                    <div>
		                		<i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Escolas por Categoria</i>
		                		
		                	</div>
		                	
	 					<td>
	 					<div style='display:inline'>
	 		<input style="margin-left:50%;display:inline" type="button" class="Imprimir esconde" value="Imprimir" onclick="window.print()" />
	                 <input type="button" class="Voltar" style='margin-top:-24%;margin-left:155%' onclick="history.go(-1);" />
	           </div> 
	                    </td>
	                </tr>
	            </table>
	        	<h2>Modalidade: <?=  utf8_encode($class->prova['DESCMODALIDADE']) ?> - Sexo: <?= $class->prova['DESCSEXO'] ?></h2>
		        <table border="1">
		            <thead>
		                <tr>
		                    <?php
		                    foreach ($class->lstCabecalho as $k => $v) {
		                        ?>
		                        <th class="tabela">
		                            <center style='font-size:14px'>
		                                <?= utf8_encode(strtoupper($v['DESCPROVA'])) ?><br /><?= utf8_encode (strtoupper($v['DESCCATEGORIA'])) ?><br /><?= $v['DESCSEXO'] ?> 
		                            </center>    
		                        </th>                                
		                        <?php
		                    }
		                    ?>
		                </tr>
		            </thead>
		            <tbody>
		                <tr>
		                    <?php
		                    foreach ($class->lstCabecalho as $k => $v) {
		                    	
		                        ?>
		                        <td valign='top'>
		                            <table class="corpo" border="1px" rules="rows" frame="none" cellspacing="0" bordercolor="#555555">
		                            	<tbody>
		                                <!--Exibe todas as escolas que se inscreveram em determinada categoria-->
		                                <?php
		                                if (!($totais[$k])) {
		                                        $totais[$k] = 0;
		                                    }
		                                foreach ($v['lstConteudo'] as $k1 => $v1) {                                    
		                                    ?>
		                                    <tr>
		                                        <td>
		                                            <center>
		                                               <b> <?= utf8_encode(($v1['NOME'])) ?> </b>
		                                            </center>
		                                        </td>
		                                    </tr>
		                                    <?php
		                                    $totais[$k]++;
		                                }                                
		                                ?>
		                                </tbody>
		                            </table>
		                        </td>
		                        <?php
		                    }
		                    ?>
		                </tr>
		            </tbody>
		            <tfoot>
		                <tr>
		                    <?php
		                    foreach ($totais as $k => $v) {
		                        ?>
		                        <td>
		                            <center>
		                                <h3>
		                                    Total: <?= $v ?>
		                                </h3>
		                            </center>
		                        </td>
		                        <?php
		                    }
		                    ?>
		                </tr>
		            </tfoot>
		        </table>
	        <br />
	        <div align="center">
	            Relat&oacute;rio gerado em <?= date("d/m/Y H:i:s") ?>
	        </div>
    </body>
</html>

<?php

class relCategoria {

    public $request;
    public $prova;
    public $lstConteudo;
    public $lstCabecalho;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
    }

    private function getDados($param) {
        //function MontaRelatorio($_POST['cboModalidade'], $_POST['cboSexo']){
            $param = array("txtID" => $v['IDPROVA'],"txtIdModalidade" => $_POST['cboModalidade'],"txtSexo" => $_POST['cboSexo']);
        $this->lstCabecalho = $this->sql->lstProva($param);
        foreach ($this->lstCabecalho as $k => $v) {
            $param = array("txtIdProva" => $v['IDPROVA']);
           // print_r($param);
            $this->lstCabecalho[$k]['lstConteudo'] = $this->sql->lstEscola($param);
        }
        $this->prova=$this->lstCabecalho[0];
        /*
          echo "<hr /><pre>";
          print_r($this->lstCabecalho);
          echo "</pre><hr />";
          exit;
         */
    }

    public function lstConteudo($param) {

     //   return $this->sql->lstCategoria_relConteudo($param);
    }

    private function iniciar($param, $idProva) {
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