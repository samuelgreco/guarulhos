<?php
$class = new sumulaHandebol();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

   
    <head>
     <?php
        require_once 'head.php';
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Sumula Handebol</title>
        <link href="../css/estilo_sumula.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
  
        <div id="tabela_handebol" style='margin-top:1%'>
            <img src="../imagem/handebol.jpg" width="1100" height="1570" />
            <div id="tabela_handebol_n_jogo">
                <table width="64" border="0">
                    <tr>
                        <td>
                            <form id="form6" name="form6" method="post" action="">
                                <label>
                                    <input type="text" value="<?= $_POST['txtNJogo'] ?>" size="3" />
                                </label>
                            </form>
                        </td>
                    </tr>
                </table>
                <div id="tabela_handebol_competicao">
                    <table width="431" border="0">
                        <tr>
                            <td>
                                <label>
                                    <input type="text"size="3"  value="<?= $_POST['txtCompeticao'] ?>"/>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="tabela_handebol_data">
                <table width="152" border="0">
                    <tr>
                        <td>
                            <form id="form6" name="form6" method="post" action="">
                                <label style='margin-top:-6.33%'>
                                    <input type="text"  size="3" style='height:20px'  value="<?= $_POST['txtDtJogo']?>"/>
                                </label>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_handebol_sex">
                <table width="99" border="0">
                    <tr>
                        <td>
                            <form id="form7" name="form7" method="post" action="">
                                <label>
                                    <input type="text" style='font-size:12px' value="<?= $_POST['txtSexo']?>" size="3" />
                                </label>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_handebol_hora">
                <table width="55" border="0">
                    <tr>
                        <td width="49">
                            <form id="form8" name="form8" method="post" action="">
                                <label>
                                    <input type="text" value="<?= $_POST['cboHora']?>" style='width:70px' />
                                </label>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_handebol_local">
                <table width="269" border="0">
                    <tr>
                        <td width="263">
                            <form id="form5" name="form5" method="post" action="">
                                <label>
                                    <input type="text" value="<?= $_POST['cboLocal']?>" size="3" />
                                </label>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_handebol_time_A">
                <table width="170" border="0">
                    <tr>
                        <td width="163">
                            <form id="form3" name="form3" method="post" action="">	
                                <label>
                                    <input type="text" size="5" style='height:18px;width:200px'  value="<?= $_POST['txtTime1']?>" /><br></br>
                                </label>
                               
                            </form>
                        </td> 
                    </tr> 
                </table>    
            </div>    
            <div id="tabela_handebol_time_B">
                <table width="170" border="0">
                    <tr>
                        <td width="163">
                            <form id="form4" name="form4" method="post" action="">
                                <label>
                                    <input type="text" size="3" style='height:18px;width:200px' value="<?= $_POST['txtTime2']?>" />
                                </label>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_handebol_nome_A">
                <table width="199" border="0">
                    <tr>
                        <td width="193">
                            <form id="form2" name="form2" method="post" action="">
                                <label>
                                    <input type="text" size="3" value="<?= $_POST['txtTime1']?>" />
                                </label>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_handebol_equipe_A">
                 <table class=nomes width=552 style='margin-left:-1.9%;margin-top:-2%'>
                    <thead>
                        <tr>
                          <th width=65px></th>
                            <th width=240px></th>
                            <th width=29px></th>
                            <th width=30px></th>
                            <th width=29px></th>
                            <th width=29px></th>
                            <th width=31px></th>
                            <th width=29px></th>
                            <th width=30px></th>
                            <th width=29px></th>
                            <th width=29px></th>

                        </tr>
                    </thead>
                    <tbody>	
                        <?php
                        foreach ($class->lstTime1 as $k => $v) {
                            ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <div style='width:242px;white-space:nowrap;overflow: hidden;'>
                                        <?= $v['NOMEALUNO'] ?>
                                    </div>
                                </td>
                                <td>&nbsp;</td> 
                                <td>&nbsp;</td> 
                                <td>&nbsp;</td> 
                                <td>&nbsp;</td> 
                                <td>&nbsp;</td> 
                                <td>&nbsp;</td> 
                                <td>&nbsp;</td> 
                                <td>&nbsp;</td> 
                                <td>&nbsp;</td>

                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="tabela_handebol_nome_B">
                <table width="199" border="0" >
                    <tr>
                        <td width="193">
                            <form id="form1" name="form1" method="post" action="">
                                <label>
                                    <input type="text" value="<?= $_POST['txtTime2']?>" size="3" />
                                </label>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabela_handebol_equipe_B">
                <table class=nomes width=552 style='margin-left:-1.9%;margin-top:-2%'>
                    <thead>
                        <tr>
                          <th width=65px></th>
                            <th width=240px></th>
                            <th width=29px></th>
                            <th width=30px></th>
                            <th width=29px></th>
                            <th width=29px></th>
                            <th width=31px></th>
                            <th width=29px></th>
                            <th width=30px></th>
                            <th width=29px></th>
                            <th width=29px></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($class->lstTime2 as $k => $v) {
                            ?>
                            <tr>  
                                <td>&nbsp;</td>
                                <td>
                                    <div style='width:242px;white-space:nowrap;overflow: hidden;'> 
                                        <?= $v['NOMEALUNO'] ?>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
          <input type="button" class="Voltar" onclick="history.go(-1);" />
        </div>
    </body>
</html>
<?php

class sumulaHandebol {

    public $request;
    public $dados;
    public $lstTime1;
    public $lstTime2;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
        /*
          echo "<pre>";
          print_r($this->dados);
          echo "</pre>";
          exit;
         */
    }
 
    private function getDados($param) {
        require_once 'sumula_dados.php';
        $dados = new sumula_dados();
        $dados->getDados($this->request);                
        $this->dados=$dados->dados;
        $this->lstTime1 = $dados->lstTime1;
        $this->lstTime2 = $dados->lstTime2;
    }

    private function iniciar($param) {
        $this->request = $_POST;
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->request = $_GET;
        }        
    }

}

// FIM DA CLASSE
?>

