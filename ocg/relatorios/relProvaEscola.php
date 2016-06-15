<?php
session_start();
$class = new relProvaEscola();
//print_r($_POST);
$qtdinscritos = 0;
?>
<html>
    <head>
       <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <link href="../css/estilo_relatorio.css" rel="stylesheet" type="text/css" />
        <link href="../css/estilo_relatorioPrint.css" rel="stylesheet" type="text/css" media="print" />
        <link charset="utf-8" type="text/css" rel="stylesheet" href="../../../lib/css/estilo.css" />
        <style>
        	.bodyRelProvaEscola	{
    			padding-left: 20px;
				width:970px; 
			}
			.tbDados{
				width: 100%;
			}
	
            .cor {
                background-color: #CCCCCC;
                font-weight: bold;
                border: 1px solid #CCCCCC;
            }
            .tdAluno{
                text-align:center;
                font-size:14px;
                width: 25%;
            }
            .tdAluno b{
                font-size:12px
            }         
		</style>
    </head>
  <body class="bodyRelProvaEscola">
        <div style='margin-left:40%;margin-bottom:-5.5%'>
	        <input type='button' style='margin-left:60.5%;display:inline' class='Imprimir esconde' value='Imprimir' onclick='window.print()' />
	        <input type="button" style='' class="Voltar esconde" onclick="history.go(-1);" />   
        </div>
        <table class="tbTitulo" style='margin-left:25%'>            
            <tr>
                <td>
                    <div align=center>
                        <img src='../imagem/ocg.png' width=71 />
                    </div>                  
                </td>            
                <td class="corpo" align="center" style='display:inline'>            
                    <b><font size=6>Prova / Escola</b></font>
                    <div align=center>
                        <i>Prova por Escola</i>
                    </div>
                </td>
            </tr>
        </table>		
        <br />
        <table class="tbDados">
            <thead>
                <tr>
                    <th class="tabela">Provas</th>
                    <th class="tabela">Respons&aacute;vel</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if (count($class->lst) > 0) {
                	$idEscolaAtual = null;
                    foreach ($class->lst as $k => $v) {
                    	if ($v['IDESCOLA'] != $idEscolaAtual) {
                    		?>
                    		                        <tr>
                    		                            <th class='tabela' colspan='2'>
                    			                            <span style='text-align:center'>Escola:</span>
                    			                            <b style='font-size:17px'> <?= utf8_encode($v['ESCOLA']) ?></b>
                    		                        	</th>
                    		                        </tr>
                    								<?php 
                    								 $qtdinscritosEscola++; 
                    	}
                		$idEscolaAtual = $v['IDESCOLA'];
                    	?>
                    	<!-- 
                        <tr>
                            <th class='tabela' colspan='2'>
	                            <span style='text-align:center'>Escola:</span>
	                            <b style='font-size:17px'> <?= utf8_encode($v['ESCOLA']) ?></b>
                        	</th>
                        </tr>
                        -->
						<?php 
                        if (($i + 1) % 2 == 0) {
                            $cor = "impar";
                        } else {
                            $cor = "par";
                        }
                        $i++;
                        ?>

                        <tr>
	                        <td class='<?= $cor ?>'>
		                    	<center>
			                        <b>
			                            <span style='font-size:12px;text-align:center'>
			                                Modalidade:
			                            </span>
			                        </b>
			                        <?= utf8_encode($v['DESCMODALIDADE']) ?> 
			                        <span>  |  </span>
			                        <b>
			                            <span style='font-size:12px'>
			                                Prova:
			                            </span>
			                        </b>
			                        <?= utf8_encode($v['DESCPROVA']) ?>
			                        <br />
			                        <b>
			                            <span style='font-size:12px'>
			                                Categoria:
			                            </span>
			                        </b>
			                        <?= utf8_encode($v['DESCCATEGORIA']) ?>
			                        <span> | </span>	
			                        <b>
			                            <span style='font-size:12px'>Sexo:</span>
			                        </b>
			                        <?= strtoupper(utf8_encode($v['SEXO'])) ?> 
			                        <?php $qtdinscritos += 1; ?>
			                        <br/>
		                    	</center>
	                		</td>                    
	                		<td align="center" class="<?= $cor ?>">
	                    		<b><?= strtoupper(utf8_encode($v['RESPONSAVEL'])) ?></b>
	            			</td>
        			</tr>
        		<?php
				}
				?>    
			<?php
			} else {
			?>
	    <tr>
	        <td colspan=2 style='text-align:center;font-style:italic;'>
	            <br />
	            Escola n&atilde;o est&aacute; inscrita em nenhuma prova.
	        </td>
	    </tr>
    		<?php
			}
			?>
			</tbody>
		</table>
		<?php
		if ($rel) {
		    ?>
		    <table width=500>
			    <tr>
				    <td colspan=3>
					    <center>
					    <i>
						    Por seu representante legal, oficializa sua inscri&ccedil;&atilde;o na OLIMP&iacute;ADA COLEGIAL GUARULHENSE,  nas modalidades indicadas.
						    Neste ato DECLARO estar ciente das normas estabelecidas no REGULAMENTO GERAL, e de que cada aluno inscrito apresenta-se em perfeito
						    estado de sa&uacute;de e condi&ccedil;&atilde;o f&iacute;sica. Ciente tamb&eacute;m, de que durante a realiza&ccedil;&atilde;o da Olimp&iacute;ada Colegial Guarulhense, a Comiss&atilde;o Central 
						    Organizadora prestar&aacute; servi&ccedil;os de assist&ecirc;ncia m&eacute;dica classificada como &ldquo;Primeiros Socorros&rdquo;, inclu&iacute;ndo, se for o caso, o transporte 
						    ao servi&ccedil;o hospitalar de urg&ecirc;ncia &ndash; H.M.U (Hospital Municipal de Urg&ecirc;ncias), localizado &agrave; pra&ccedil;a Dr. Lauro de Souza Lima, s/n - Bom Clima - 
						    Guarulhos/SP,  e em hip&oacute;tese alguma poder&aacute; ser responsabilizada e/ou arcar&aacute; com o pagamento de servi&ccedil;os m&eacute;dicos ou entidades classificadas 
						    como particulares e n&atilde;o pertencentes &agrave;s unidades m&eacute;dicas da Prefeitura Municipal de Guarulhos.
					    </i>
					    </center>
				    </td>
			    </tr>
		    <br /><br />
			    <tr>
				    <td>
					    <center>_____________________________________________<br />
					    <?= $varEscola ?>
					    </center>
				    </td>
				    <td>
					    <center>_____________________________________________<br />
					        CARIMBO DA ESCOLA
					    </center>
				    </td>
			    </tr>
		    </table>
		    <?php
		}
		?>
			<br />
			<hr>
			<h2> Quantidade total de provas inscritas nesse contexto:   <?= $qtdinscritos ?> </h2>
			<h2> Quantidade total de escolas nesse contexto:   <?= $qtdinscritosEscola ?> </h2>
			<div style='margin-left:22%'>
			    Relat&oacute;rio gerado em <?= date("d/m/Y H:i:s") ?>
			</div>
	</body>
</html>
<?php

class relProvaEscola {

    public $request;
    public $lst;
    public $dados;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);


        if ($this->dados['NOMEESCOLA']) {
            $this->dados['quadrado'] = "<div style='border:#000 1px solid;width:80px;height:80px;'></div>";
        }

    }

    private function getDados($param) {
        $param = array("txtIdEscola" => $_POST['cboEscola']);
        $this->lst = $this->sql->consultaConteudoRelProvaEscola($param);
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
