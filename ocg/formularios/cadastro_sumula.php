<?php
session_start();
$class = new cadSumula();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head.php';
        ?>
        <link href="../css/estilo_relatorioPrint.css" rel="stylesheet" type="text/css" media="print" />        
        <style type="">
            .tbDados{
                width: 100%;
            }
            .tdDados{
                width: 163px;
            }
            .txtDesc{
                width: 100%;
            }
            .txtNJogo{
                text-align: center;
                font-size:18px;
                width:100px
            }
            .Imprimir{
                display:none;
            }
        </style>
    <script type="text/javascript" src="../js/cadSumula.js"></script>
    </head>
    <body class="bodyCadastroSumula">
        <div class="container">
            <input type="hidden" value="<?= $class->response['mensagem'] ?>" id="msg"/>
            <h1>
                S&uacute;mula
                <a class="pull-right Voltar esconde" href="tabelaJogos.php?txtIdTabela=<?=$class->dados['IDTABELA']?>&txtIdProva=<?=$class->dados['IDTABELA']?>" /></a>
            </h1>
            <form action="<?= $class->dados['ARQUIVO_PRINT'] ?>" name="frmCadastro" class="frmCadastro" id="frmCadastro" method="post">
                <input type="hidden" name="filtro" id="filtro" value="imprimir"/>
                <input type="hidden" name="retorno" value="retorna"/>
                <input type="hidden" name="txtLocal" id="txtLocal" value=""/>
                <input type="hidden" name="txtID" id="txtID" value="<?= $class->dados['IDSUMULA'] ?>"/>
                <input name="txtIdProva" type="hidden" id="txtIdProva"  value="<?= $class->dados['IDPROVA'] ?>" />
                <input name="txtIdTabela" type="hidden" id="txtIdTabela"  value="<?= $class->dados['IDTABELA'] ?>" />
                <table class="table table-striped tbDados">
                    <tr align="center">
                        <td>
                            <label>Competi&ccedil;&atilde;o:</label><br />
                            <input name="txtCompeticao" style='width:250px;text-align:center' type="text" id="txtCompeticao" class="txtCompeticao" value="Olimpiadas Colegiais Guarulhenses"/>
                        </td>
                        <td colspan="1">
                            <label>Jogo N&ordm;:</label><br />
                            <input value="<?= $class->dados['NJOGO'] ?>" name="txtNJogo" type="text" class="txtNJogo" id="txtNJogo" readonly="readonly"/>                                
                        </td>
                        <td>
                            <label>Sigla:</label><br />
                            <input name="txtSigla" style='width:250px;text-align:center' type="text" id="txtSigla" value="<?= $class->dados['SIGLA'] ?>" class="txtSigla txtDesc" readonly="readonly" />
                        </td>
                    </tr>
                    <tr align="center" id="linha<?= $v['IDESCOLA'] ?>">
                        <td style='font-size:16px'>
                            <label style='font-size:13px'>Escola:</label><br />
                            <input name="txtTime1" id="txtTime1" style='text-align:center;font-size:15px;font-weight:bold' value='<?= $class->dados['TIME1'] ?>' type='text' />
                        </td>
                        <td class="tdDados" style='font-size:36px'>
                            X
                        </td>
                        <td style='font-size:16px'>
                            <label style='font-size:13px'>Escola:</label><br />
                            <input name="txtTime2" id="txtTime2" style='text-align:center;font-size:15px;font-weight:bold' value='<?= $class->dados['TIME2'] ?>' type='text' />
                        </td>
                    </tr>
                    <tr>&nbsp;</tr>
                    <tr>&nbsp;</tr>
                    <tr align="center">
                        <td>
                            <label>Modalidade da s&uacute;mula:</label><br /> <!--Acredito que ser o tipo. Exemplo:  sumulaBasquete, sumulaFutebol, sumulaFutsal, ...-->
                            <input class="txtModeloSumula" style='width:200px;text-align:center' name="txtModeloSumula" id="txtModeloSumula"  value="<?= $class->dados['DESCMODALIDADE'] ?>"  readonly="readonly"  type="text" />
                        </td>
                        <td>
                            <label> Sexo:</label><br />
                            <input value="<?= $class->dados['DESCSEXO'] ?>" style='text-align:center' name="txtSexo" class="txtSexo" id="txtSexo" readonly="readonly" type="text"/>
                        </td>
                        <td>
                            <label>Categoria:</label><br />   
                            <input value="<?= $class->dados['DESCCATEGORIA'] ?>" style='text-align:center' name="txtCategoria" type="text" class="txtCategoria" id="txtCategoria" readonly="readonly"/>
                        </td>
                    </tr>
                    <tr align="center">  
                        <td>
                            <label>Local:</label><br />                            
                            <select name="cboLocal" id="cboLocal" class="required validate[required] cboLocal tdDados">
                                <option value=""></option>
                                <?php
                                foreach ($class->lstLocal as $k => $v) {
                                    ?>
                                    <option value="<?= utf8_encode($v['LOCAL']) ?>" <?= $v['selected'] ?>><?= utf8_encode($v['LOCAL']) ?></option>								                            		
                                    <?php
                                }
                                ?>
                            </select>                                    
                        </td>  
                        <td>
                            <label>Data:</label><br />
                            <input value="<?= $class->dados['DATAJOGO'] ?>" name="txtDtJogo" type="text" class="txtDtJogo" id="txtDtJogo" maxlength="10" readonly="readonly"/>
                        </td>
                        <td>
                            <label>Hor&aacute;rio:</label><br />
                            <?= $class->dados['HORAJOGO'] ?>
                            <select name="cboHora" id="cboHora" class="cboHora tdDados" >
                                <option value=""></option>
                                <?php
                                foreach ($class->lstHora as $k => $v) {
                                    ?>
                                    <option value="<?= $v['hr'] ?>" <?= $v['selected'] ?>><?= $v['hr'] ?></option>								                            		
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">                            
                            <?php
                            if (!(empty($class->dados['ARQUIVO_PRINT']))) {
                                ?>
                                <input id='cmdImprimir' class='Imprimir pull-right' type='submit' value='Imprimir' />
                                <?php
                            }else{
                                ?>
                                <label class=" pull-right" style="color:red;font-size:x-large;">
                                    N&atilde;o consta script de impress&atilde;o
                                </label>                                
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                </table>  
            </form>
        </div>
    </body>
</html>

<?php

class cadSumula {

    public $request;
    public $dados;
    public $lstLocal;
    public $lstHora;
    public $lstTabela;
    public $lstModeloSumula;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        if ($this->request['filtro'] == "gravar") {
            $this->gravar($param);
        }
        $this->getDados($param);
        /*
          echo "<pre>";
          print_r($this->lstHora);
          echo "</pre>";
          exit;
         */
    }

    private function getDados($param) {


        $this->lstLocal = $this->sql->lstLocal($param);

        //$this->lstModeloSumula=$this->sql->lstModeloSumula($param);
        $lstHora = array("07:00", "07:30", "08:00", "08:30", "09:00", "09:30", "09:40", "10:00", "10:20", "10:30", "11:00", "11:30", "11:40", "12:00", "12:20", "12:30", "13:00", "13:30", "13:40", "14:00", "14:20", "14:30", "15:00", "15:30", "15:40", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30", "21:00", "21:30");

        if (($this->request['txtIdTabela'] > 0)) {
            $param = array("txtIdTabela" => $this->request['txtIdTabela'], "txtRodada" => $this->request['txtRodada']);
            $param['txtPosicaoIn'] = $this->request['txtPosicao'] . "," . ($this->request['txtPosicao'] + 1);
            $this->lstTabela = $this->sql->lstTabela($param);
            $this->dados['DESCSEXO'] = $this->lstTabela[0]['DESCSEXO'];
            $this->dados['IDPROVA'] = $this->lstTabela[0]['IDPROVA'];
            $this->dados['IDTABELA'] = $this->lstTabela[0]['IDPROVA'];
            $this->dados['ARQUIVO_PRINT'] = $this->lstTabela[0]['ARQUIVO_PRINT'];
            $this->dados['DESCMODALIDADE'] = $this->lstTabela[0]['DESCMODALIDADE'];
            $this->dados['DESCCATEGORIA'] = $this->lstTabela[0]['DESCCATEGORIA'];
            $this->dados['SIGLA'] = $this->lstTabela[0]['SIGLA'];
            $this->dados['NJOGO'] = $this->request['txtNumJogo'];
            $this->dados['TIME1'] = $this->lstTabela[0]['ESCOLA'];
            $this->dados['TIME2'] = $this->lstTabela[1]['ESCOLA'];
        } else {
            //header("Location: consultaSumula.php");
        }

        foreach ($lstHora as $k => $v) {
            $this->lstHora[$k]['hr'] = $v;
            if ($this->dados['HORAJOGO'] == $v) {
                $this->lstHora[$k]['selected'] = " selected";
            }
        }
    }

    private function gravar($param) {
        require_once '../php/Gravar.php';
        $gravar = new Gravar();
        $this->response = $gravar->gravarSumula($this->request);
        if (($this->response['codigo'] == 1) && (!($this->request['txtID'] > 0))) {
            $this->request['txtID'] = $gravar->getMaxId(array("campoId" => "IDSUMULA", "tabela" => "OCG_SUMULA"));
        }
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



