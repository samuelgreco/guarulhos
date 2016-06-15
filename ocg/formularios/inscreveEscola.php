<?php
session_start();
$class = new inscreveEscola();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>
        <link rel="stylesheet" type="text/css" href="../js/shadowbox/shadowbox.css" />
        <link href="../css/estilo_relatorioPrint.css" rel="stylesheet" type="text/css" media="print" />
        <script type="text/javascript" src="../js/shadowbox/shadowbox.js"></script>
        <script type="text/javascript" src="../js/inscreveEscola.js"></script>
    </head>
    <body>
        <div class="container">
            <h1 style='display:inline'>
                Escola: <?= utf8_decode($class->escola['NOME']) ?>
            </h1>
            <a href="../relatorios/relProvaEscola.php?txtIdEscola=<?= $class->escola['IDESCOLA'] ?>">
                <input type='button' style='margin-left:16%' value='Imprimir'class='Imprimir'/>
            </a>
            <a href="acessoEscola.php" class="Voltar">&nbsp;</a>            
            <table style="width:100%;">
                <tr>
                    <td>
                        <h1>
                            Escolha as modalidades e categorias desejadas:
                        </h1>
                    </td>
                    <td width=130 align='right'>
                    </td>
                    <td width=100 align='right'>
                        <a target='_blank' href='../relatorios/relProvaEscola.php?txtIdEscola=<?= $class->escola['IDESCOLA'] ?>'>
                            &nbsp;
                        </a>
                        <br/>
                    </td>
                </tr>
            </table>
            <br /><br /><br />

            <table width="750" border="2" id="tabela" class='tabelaa'>
                <tbody>
                    <?php
                    $i = 0;
                    $varUltimaMod = null;
                    foreach ($class->lst as $k => $v) {
                        /* $varModalidade = $varConsulta[$i]['m.descricao'];
                          $varTravaInclusao = $varConsulta[$i]['escolaInscricao'];
                          $varTravaExclusao = $varConsulta[$i]['escolaExclusao']; */
                        if (($v['DESCMODALIDADE']) != $varUltimaMod) {
                            ?>
                            <tr>
                                <td colspan=5>
                                    <h2>
                                        <?= utf8_encode($v['DESCMODALIDADE']) ?>
                                    </h2>
                                </td>
                            </tr>
                            <tr style='background:#3A9FBD;'>
                                <td style='text-align:center'>
                                    <b>
                                        <font size='3'>
                                            Prova
                                        </font>
                                    </b>
                                </td>
                                <td style='text-align:center'>
                                    <b>
                                        Categoria
                                    </b>
                                </td>
                                <td style='text-align:center'>
                                    <b>
                                        Sexo
                                    </b>
                                </td>
                                <td style='text-align:center'>
                                    <b>
                                        Respons&aacute;vel
                                    </b>
                                </td>
                                <td  style='text-align:center'>
                                
                             <b>  	Inscrever/Excluir
                               </b> </td>                                
                            </tr>
                            <tr>
                                <?php
                                $varUltimaMod = $v['DESCMODALIDADE'];
                            }
                            ?>
                            <td style="vertical-align: middle;text-align:center">
                                <?= strtoupper(utf8_encode($v['DESCPROVA'])) ?>
                            </td>
                            <td style='vertical-align: middle;text-align:center'>
                                <?= strtoupper(utf8_encode($v['DESCCATEGORIA'])) ?>
                            </td>
                            <td style='vertical-align: middle;text-align:center'>
                                <?= $v['SEXO'] ?>
                            </td>
                            <td style='vertical-align: middle;text-align:center;'> 
                                <?php
                                $nomeProfessor="";
                                if (($class->trava['ESCOLAINSCRICAO'] != 1) || $v['IDESCOLA'] > 0) {
                                    $nomeProfessor=$v['RESPONSAVEL'];                                    
                                }
                                if (empty($nomeProfessor)) {
                                ?>
                                <select id="cboProfessor_<?= $v['IDPROVA'] ?>" class="cboProfessor">
                                    <option value=""></option>
                                    <?php
                                    $selected = "";
                                    foreach ($class->lstProfessor as $k1 => $v1) {
                                        if ($v['IDPROFESSOR'] == $v1['IDPROFESSOR']) {
                                            $selected = " selected";
                                        }
                                        ?>
                                        <option value="<?= $v1['IDPROFESSOR'] ?>" <?= $selected ?>><?= strtoupper(utf8_encode($v1['NOME'])) ?></option>
                                        <?php
                                        $selected = "";
                                    }
                                    ?>
                                </select>
                                <?php
                                }else{
                                ?>    
                                <?=  utf8_encode($nomeProfessor)?>
                                    <?php
                                }
                                ?>
                            </td> 
                            <td id="td_<?= $class->escola['IDESCOLA'] ?>_<?= $v['IDPROVA'] ?>">
                                <?php
                                if ($v['IDESCOLA'] > 0) {
                                    if ($class->trava['ESCOLAEXCLUSAO'] == 0) {
                                        ?>                                    
                                        Encerrado                                    
                                        <?php
                                    } else {
                                        ?>                                        
                                        <a href="javascript:excluir(<?= $class->escola['IDESCOLA'] ?>,<?= $v['IDPROVA'] ?>);"><img style='width:40px;margin-left:36%' alt='Excluir Incri��o' src='../imagem/Excluir.png'></a>                                        
                                        <?php
                                    }
                                } else {
                                    if ($class->trava['ESCOLAINSCRICAO'] == 0) {
                                        ?>
                                        Encerrado
                                        <?php
                                    } else {
                                        ?>                                        
                                        <a href="javascript:inscrever(<?= $class->escola['IDESCOLA'] ?>,<?= $v['IDPROVA'] ?>);" ><img style='width:40px;margin-left:36%' alt='Inscrever' src='../imagem/Inscrever.png'></a>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>

<?php

class inscreveEscola {

    public $request;
    public $lst; //LST DE PROVA
    public $lstProfessor; //LST DE PROFESSOR DA ESCOLA
    public $escola;
    public $trava;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
    }

    private function getDados($param) {
        $this->trava = $this->sql->lstTrava($param);
        $this->trava = $this->trava[0];

        $param = array("txtID" => $this->request['txtIdEscola']);
        $this->escola = $this->sql->lstEscola($param);
        $this->escola = $this->escola[0];
        /*
          echo "<hr /><pre>";
          print_r($this->escola);
          echo "</pre><hr />";
          exit;
         */

        $param = array("txtIdEscola" => $this->request['txtIdEscola']);
        $this->lstProfessor = $this->sql->lstProfessor($param);

        $this->lst = $this->sql->lstEscolaInscrita($param);
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