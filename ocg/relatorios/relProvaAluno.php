<?php
session_start();
$class = new relProvaAluno();
$qtdinscritos = 0;
$qtdinscritosalunos = 0;
?>
<!DOCTYPE style PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
       <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <link href="../css/estilo_relatorio.css" rel="stylesheet" type="text/css" />
        <link href="../css/estilo_relatorioPrint.css" rel="stylesheet" type="text/css" media="print" />
        <link charset="utf-8" type="text/css" rel="stylesheet" href="../../../lib/css/estilo.css" />
        <style type="text/css">
        	.bodyRelProvaAluno	{
    			padding-left: 20px;
				width:900px; 
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
    <body class="bodyRelProvaAluno">
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
                    <b><font size=6>Prova / Aluno</b></font>
                    <div align=center>
                        <i>Prova por Aluno</i>
                    </div>
                </td>
            </tr>
        </table>		
        <table style="width:100%;">
            <tbody>
                <?php
                if (count($class->lst) > 0) {
                    foreach ($class->lst as $k => $v) {
                        if ($v['IDESCOLA'] != $class->lst[($k - 1)]['IDESCOLA']) {
                            ?>
                            <tr>
                                <th class='tabela' colspan="4" >
                                    <span>Escola:</span>
                                    <b style='font-size:17px'> <?= utf8_encode($v['NOMEESCOLA']) ?></b><tr></tr>
                            	</th>
                            </tr>
                            <?php
                        }

                        if ($v['IDALUNO'] != $class->lst[($k - 1)]['IDALUNO']) {
                            ?>
                            <tr>
                                <th colspan="4" class="cor" style='font-size:13px; border-top:solid 2px;'>
                                    <?= strtoupper(utf8_encode($v['NOMEALUNO'])) ?>
                                    <?php $qtdinscritosalunos++; ?>
                                </th>
                            </tr>
                            <?php
                        }
                        if (!$v['IDINSCRICAO'] > 0) {
                            ?>
                            <tr>
                                <td colspan=2 style="text-align:center;font-size:12px;font-style:italic;padding-bottom:1%;">
                                <center>
                                    Aluno n&atilde;o est&aacute; inscrito em nenhuma prova.
                                    </center>
                                    <?php $qtdinscritosalunos--; ?>
                                    <br /><br />
                                </td>
                            </tr>
                            <?php
                        } else {
                            ?>
                            <tr>
                                <td class="tdAluno">
                                    <b>Prova:</b>
                                    <?= utf8_encode($v['DESCPROVA']) ?>
                                </td>
                                <td class="tdAluno">
                                	<b>Categoria:</b>
                                    <?= utf8_encode($v['DESCCATEGORIA']) ?>
                                </td>
                                <td class="tdAluno">
                                    <b>Sexo:</b>
                                    <?= utf8_encode($v['SEXO']) ?>
                                </td>
                                <td class="tdAluno">
                                    <b>Tipo:</b>
                                    <?= utf8_encode($v['TIPODISPUTA']) ?>
                                    <?php $qtdinscritos++; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan=2 style='text-align: center; font-style: italic;margin-left:20%'>
                            Escola n&atilde;o est&aacute; inscrita em nenhuma prova.
                        </td>
                    </tr>    
                    <?php
                } //fechamento do else
                ?>    
            </tbody>
        </table>
        <br />
        <hr>
        <h2>Total Inscri&ccedil;&otilde;es de provas nesse contexto:   <?= $qtdinscritos ?></h2>
        <h2>Total de Alunos diferentes inscritos nesse contexto:   <?= $qtdinscritosalunos ?></h2>
        <div align="center">
        	Relat&oacute;rio gerado em <?= date("d/m/Y H:i:s") ?>
        </div>
    </body>
</html>

<?php

class relProvaAluno {

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
        $param = array("txtIdEscola" => $_POST['cboEscola']);
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

// FIM DA CLASSE
?>