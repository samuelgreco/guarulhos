<?php
session_start();
$class = new fichaIndividual();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once '../formularios/head.php';
        ?>
        <link href="../css/estilo_relatorioPrint.css" rel="stylesheet" type="text/css" media="print" />                
           
        <style>
            body{                
                padding-left:10%;
            }
            .divDados{
                margin-bottom:5%;                
            }
            .tbRegistro{       
                border: 1px solid black;                
                border-collapse: collapse;
                width:600px;
                padding:0.5%; 
                page-break-inside: avoid;
             	size: portrait;
             }
            .tbRegistro td{       
                border: 1px solid black;  
             }
        </style>
    </head>
    <body>
        <input style="margin-left:35%;display:inline" type="button" class="Imprimir esconde" value="Imprimir" onclick="window.print()" />
        <input type="button" class="Voltar" style='margin-top:4%;margin-left:2%' onclick="history.go(-1);" />
        <br /><br /><br />
                    <div class="divDados">
                        <?php
                        //	echo (($class->request['cboTipo']));exit;
                        switch ($class->request['cboTipo']) {
                            case 1: // ??                                
                                    foreach ($class->lst as $k => $v) {
                                        $linhas = "<table class='tbRegistro'>";
                                        $linhas .= "<tr height=50 ><td width=150><center><img src='../imagem/OCG.png' width=80></center></td><td colspan=3><center><h2>Olimp&iacute;ada Colegial Guarulhense</h2></center></td></tr>";
                                        $linhas .= "<tr><td colspan=3 >Nome: " . utf8_encode($v['NOMEALUNO']) . "</td><td>" . ($v['DTNASC']) . "</td></tr>";
                                        $linhas .= "<tr><td colspan=4 >Escola: " . utf8_encode($v['NOMEESCOLA']) . " </td></tr>";
                                        $linhas .= "<tr><td><center>" . utf8_encode($v['DESCCATEGORIA']) . " <br /> " . ($v['SEXO']) . "</center></td><td colspan=3 >Prova: <br /> " . utf8_encode($v['DESCPROVA']) . "</td></tr>";
                                        $linhas .= "<tr><td colspan=4 width=150>Resultados:</td>";
                                        $linhas .= "<tr height=50><td width=150>&nbsp;</td><td width=150>&nbsp;</td><td width=150>&nbsp;</td><td width=150>&nbsp;</td></tr>";
                                        $linhas .= "<tr height=50 ><td colspan=2 >Final:<br />.</td><td colspan=2 >Classifica&ccedil;&atilde;o:<br />.</td></tr>";
                                        $linhas .= "</table>";
                                        echo $linhas . "-------------------------------------------------------------------------------------------------------------------";
                                    }
                                break;
                            case 2: // ??
                                foreach ($class->lst as $k => $v) {
                                    $linhas = "<table class='tbRegistro'>";
                                    $linhas .= "<tr height=50 ><td width=150><center><img src='../imagem/OCG.png' width=80></center></td><td colspan=3><center><h2>Olimp&iacute;ada Colegial Guarulhense</h2></center></td></tr>";
                                    $linhas .= "<tr><td width=150>S&eacute;rie:</td><td colspan=3 >Raia:</td>";
                                    $linhas .= "<tr height=50><td width=150>&nbsp;</td><td width=150>&nbsp;</td><td width=150>&nbsp;</td><td width=150>&nbsp;</td></tr>";
                                    $linhas .= "<tr><td>N. Prova: <br />.</td><td colspan=3 >Prova: <br /> " . utf8_encode($v['DESCPROVA']) . "</td></tr>";
                                    $linhas .= "<tr><td colspan=3 >Nome: " . utf8_encode($v['NOMEALUNO']) . " </td><td>Categoria:" . utf8_encode($v['DESCCATEGORIA']) . " / " . ($v['SEXO']) . "</td></tr>";
                                    $linhas .= "<tr><td colspan=4 >Escola: " . utf8_encode($v['NOMEESCOLA']) . " </td></tr>";
                                    $linhas .= "<tr height=50 ><td colspan=2 >Tempo:<br />.</td><td colspan=2 >Resultado:<br />.</td></tr>";
                                    $linhas .= "</table>";
                                    echo $linhas . "-----------------------------------------------------------------------------------------------------------------------";
                                }
                                break;
                            case 3: //Natacao
                            	$contNatacao = 0;
                                    foreach ($class->lst as $k => $v) {          
                                    	$contNatacao++;
                                        $linhas = "<table class='tbRegistro'>";
                                        $linhas .= "<tr height=50 ><td width=150><center><img src='../imagem/OCG.png' width=80></center></td><td colspan=3><center><h2>Olimp&iacute;ada Colegial Guarulhense</h2></center></td></tr>";
                                        $linhas .= "<tr><td width=150 style='font-size:14px'>S&eacute;rie:</td><td colspan=3 >Baliza:</td>";
                                        $linhas .= "<tr height=50><td width=150 style='font-size:14px'>&nbsp;</td><td width=150 style='font-size:14px'>&nbsp;</td><td width=150>&nbsp;</td><td width=150>&nbsp;</td></tr>";
                                        $linhas .= "<tr><td style='font-size:14px'>N&ordm; Prova: " . $v['IDPROVA'] . "</td><td colspan=3 style='font-size:14px'>Prova: " . utf8_encode($v['DESCPROVA']) . "</td></tr>";
                                        $linhas .= "<tr><td colspan=2 style='font-size:14px' >Nome: " . utf8_encode($v['NOMEALUNO']) . " </td><td colspan=2 style='font-size:14px'>Categoria:" . utf8_encode($v['DESCCATEGORIA']) . " / " . ($v['SEXO']) . "</td></tr>";
                                        $linhas .= "<tr><td colspan=4 style='font-size:14px' >Escola: " . utf8_encode($v['NOMEESCOLA']) . " </td></tr>";
                                        $linhas .= "<tr height=50 ><td colspan=2 style='font-size:14px' >Tempo:<br />.</td><td colspan=2 style='font-size:14px' >Resultado:<br />.</td></tr>";
                                        $linhas .= "</table>";
                                        echo $linhas . "-----------------------------------------------------------------------------------------------------------------------";                                        
                                    }
                                    
                                    
                                    ?> <br>
                                                                                                            
                                    	                                  <?php if($contNatacao > 0){ ?>
                                    	                                    <h2> Quantidade de fichas: <?=  $contNatacao   ?></h2>
                                    	                                     <?php }
                                    	                     			        else{
                                    	                      				         ?>  <h2 style='margin-left:-10%;margin-top:-9%'>N&atilde;o Existe Fichas Para Esse Contexto!</h2>
                                    	                                     <?php
                                    	                                             }
                                                                        
                                break;
                            case 4: //Atletismo
                            	$contAtletismo = 0;
                                    foreach ($class->lst as $k => $v) {
                                    	$contAtletismo++;
                                        $linhas = "<table class='tbRegistro'>";
                                        $linhas .= "<tr height=45 ><td width=150 colspan=10><center><img src='../imagem/OCG.png' width=80></center></td><td colspan=20><center><h2>Olimp&iacute;ada Colegial Guarulhense</h2></center></td></tr>";
                                        $linhas .= "<tr style='font-size:14px;'><td colspan=15 >Nome: " . utf8_encode($v['NOMEALUNO']) . " </td><td colspan=15>Categoria: " . utf8_encode($v['DESCCATEGORIA']) . " / " . ($v['SEXO']) . "</td></tr>";
                                        $linhas .= "<tr style='font-size:14px;'><td colspan=30 >Escola: " . utf8_encode($v['NOMEESCOLA']) . " </td></tr>";
                                        $linhas .= "<tr style='font-size:14px;'><td colspan=8>N. Prova:&nbsp;" . $v['IDPROVA'] . "&nbsp;</td><td colspan=22 >Prova: " . utf8_encode($v['DESCPROVA']) . "</td></tr>";
                                        $linhas .= "<tr style='font-size:14px;'><td colspan=30>Resultados:</td>";
                                        $linhas .= "<tr height=25 style='font-size:14px;'><td colspan=8>&nbsp;</td><td colspan=7>&nbsp;</td><td colspan=8>&nbsp;</td><td colspan=7>&nbsp;</td></tr>";
                                        $linhas .= "<tr height=25 style='font-size:14px;'><td colspan=15 >Final:</td><td colspan=15 >Classifica&ccedil;&atilde;o:</td></tr>";
                                        $linhas .= "<tr style='font-size:14px;'><td colspan=30 ><center>ALTURA</center></td>";
                                        $linhas .= "<tr height=20 style='font-size:14px;'><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td></tr>";
                                        $linhas .= "<tr height=20 style='font-size:14px;'><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td></tr>";
                                        //$linhas .= "<tr height=20><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td><td width=45 colspan=3>&nbsp;</td></tr>";
                                        //$linhas .= "<tr height=20><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td><td width=15>&nbsp;</td></tr>";
                                        //$linhas .= "<tr height=25 ><td colspan=15 >Resultado:</td><td colspan=15 >Classifica&ccedil;&atilde;o:</td></tr>";
                                        $linhas .= "</table>";
                                        echo $linhas . "-----------------------------------------------------------------------------------------------------------------------";                                        
                                    }
                                    ?> <br>
                                                                        
	                                  <?php if($contAtletismo > 0){ ?>
	                                    <h2> Quantidade de fichas: <?=  $contAtletismo   ?></h2>
	                                     <?php }
	                     			        else{
	                      				         ?>  <h2 style='margin-left:-10%;margin-top:-9%'>N&atilde;o Existe Fichas Para Esse Contexto!</h2>
	                                     <?php
	                                             }
                                    
                                    
                                    
                                break;
                            case 5: // Revezamento                                
                                $nparticipantes = 0;
                                $contRevezamento = 0;
                                $nomesParticipante = "";
                                    foreach ($class->lst as $k => $v) {
                                        $nomesParticipante = $nomesParticipante . utf8_encode($v['NOMEALUNO']);
                                        $nparticipantes++;
                                        if ($nparticipantes == 4) {
                                        $contRevezamento++;
                                            $nparticipantes = 0;
                                            $linhas = "<table class='tbRegistro'>";
                                            $linhas .= "<tr height=50 ><td><center><img src='../imagem/OCG.png' width=80></center></td><td colspan=3><center><h2>Olimp&iacute;ada Colegial Guarulhense</h2></center></td></tr>";
                                            $linhas .= "<tr><td style='font-size:14px;'>N&ordm; Prova: " . ($v['IDPROVA']) . "</td><td colspan=3 style='font-size:14px;'>Prova: " . utf8_encode($v['DESCPROVA']) . "</td></tr>";
                                            $linhas .= "<tr><td colspan=4 style='font-size:14px;'>Escola: " . utf8_encode($v['NOMEESCOLA']) . " </td></tr>";
                                            $linhas .= "<tr><td colspan=2 style='font-size:14px;'>Nome: <br />" . $nomesParticipante . "</td><td colspan=2 style='font-size:14px;'>Categoria: " . utf8_encode($v['DESCCATEGORIA']) . " / " . ($v['SEXO']) . "</td></tr>";
                                            $linhas .= "<tr><td width=150 style='font-size:14px;'>S&eacute;rie:</td><td width=150 style='font-size:14px;'>Raia:</td><td  width=150>.</td><td width=150 style='font-size:14px;'>.</td></tr>";
                                            $linhas .= "<tr height=45 style='font-size:14px;'><td colspan=2 style='font-size:14px;'>Tempo:</td><td colspan=2 >Resultado:</td></tr>";
                                            $linhas .= "</table>";
                                            $nomesParticipante = "";
                                            echo $linhas . "-----------------------------------------------------------------------------------------------------------------------";                                            
  																		                                      
                                        } else {
                                            $nomesParticipante = $nomesParticipante . "<br />";
                                        }
                                    }
                                    ?> <br>
                                    
                                    <?php if($contRevezamento > 0){ ?>
                                    <h2> Quantidade de fichas: <?=  $contRevezamento   ?></h2>
                                    <?php }
                                    else{
                                   ?>  <h2 style='margin-left:-10%;margin-top:-9%'>N&atilde;o Existe Fichas Para Esse Contexto!</h2>
                                     <?php
                                    }
                                break;
                            default:
                                break;
                        }
                        ?>
                    </div>
                    </body>
                    </html>
<?php

class fichaIndividual {

    public $request;
    public $lst;
    public $dados;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
    }

    private function getDados($param) {
        $param = array("txtIdProva" => $this->request['cboProva']);
        $this->lst = $this->sql->lstAlunoInscrito($param);         
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
?>