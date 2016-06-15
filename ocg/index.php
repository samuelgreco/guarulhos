<?php
session_start();
$class = new index();
?>
<html>
    <head>    
        <title>OCG</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">        
        <link charset="utf-8" type="text/css" rel="stylesheet" href="../../lib/css/jquery.validationEngine.css" />        
        <link charset="utf-8" type="text/css" rel="stylesheet" href="../../lib/css/estilo.css"/>
        <link charset="utf-8" type="text/css" rel="stylesheet" href="css/style.css">

        <style type="text/css">
            <!--
            .style4 {
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 10px;
            }
            -->
            <!--
            body {
                background: #FFFFFF;
                text-align:center;
                margin: 0px;
                padding: 0px;

            }

            #caixa_senha  {
                position: relative; 
                width:700px;
                margin:0 auto;
                height:auto;
                margin-top:100px;
                margin-bottom:0px;

            }

            #caixa_topo {
                background:url(imagem/fundo_topo.png) no-repeat;
                width:650px;
                height:26px;
                display:block;			
                margin: 0 auto;

            }

            #caixa_meio {
                background: url(imagem/fundo_meio.png) repeat-y;
                width:650px;
                height: auto;
                display:block;
                margin: 0 auto;
                padding:0px;
                margin-top:0px;
            }

            #caixa_baixo{

                background: url(imagem/fundo_baixo.png) no-repeat;
                width:650px;
                height:23px;
                margin: 0 auto;
            }

            #caixa {
                width:400px;
                height:auto;
                margin: 0 auto;
                padding:10px;
            }
            -->
            <!--
            .style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
            -->
        </style>
        <script charset="utf-8" type="text/javascript" src="../../lib/js/jquery-1.10.2.js"></script>
        <script charset="utf-8" type="text/javascript" src="../../lib/js/jquery.validationEngine-ptBr.js"></script>
        <script charset="utf-8" type="text/javascript" src="../../lib/js/jquery.validationEngine.js"></script>
        <script charset="utf-8" type="text/javascript" src="../../lib/js/ajax.js"></script>
        <script charset="utf-8" type="text/javascript" src="../../lib/js/select.js"></script>
        <script charset="utf-8" type="text/javascript" src="../../lib/js/objeto.js"></script>
        <script charset="utf-8" type="text/javascript" src="js/index.js"></script>
    </head>
    <body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <input type="hidden" id="msg" value="<?=$class->response['msg']?>" />
        <div id="caixa_senha">
            <div id="caixa_topo"></div>
            <div id="caixa_meio">
                <div id="caixa">
                    <img src="imagem/ocg.png" >
                    <br />                    <br />
                    <form name="frmLogin" id="frmLogin" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <input type="hidden" name="filtro" value="validar" />
                        <table width="400" border="0">
                            <tr>
                                <td width="113"></td>
                                <td width="223">
                                    <label> <span class="style3">Login</span><br>
                                        <input type="text" name="txtNome" id="txtNome" value="" class="validate[required] txtNome" />
                                    </label>

                                </td>
                                <td width="50">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <label> <span class="style3">Senha</span><br>
                                        <input type="password" name="txtSenha" id="txtSenha" onkeypress="return Enter(event)" value="" class="validate[required] txtSenha" />
                                    </label>
                                    </form>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                        <table width="400" border="0">
                            <tr>
                                <td width="116">&nbsp;</td>
                                <td width="86"> 
                                    <input type="button" class="Login" id="btn_ok" value="Entrar" style="margin-left:25%;" onClick="testar()" /></td>
                                <td width="184">&nbsp;</td>
                            </tr>
                        </table>
                    </form>
                </div>
                <br>
                <br>
                <span class="style4">  <font size=2>Secretaria de Esporte, Recreação e Lazer </font><br> Secretaria de Educação <br> <i>Departamento de Planejamento e Informática na Educação  <br> Departamento Técnico Processamento de Dados Educacionais <i></i></span><br>
                <span class="style4"> <font size=2>V 2.0 </font></span><br>
            </div>

            <div id="caixa_baixo"></div>
        </div>
        <!-- ImageReady Slices (Untitled-1) -->
        <!-- End ImageReady Slices -->
    </body>
</html>
<?php

class index {

    public $request;
    public $response;
    public $dados;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        if ($_POST['filtro'] == "validar") {
            $this->validar($param);
        }
    }

    private function validar($param) {
        $this->dados = $this->sql->validarLogin($this->request);
        $this->dados = $this->dados[0];
        if ($this->dados['IDPROFESSOR'] > 0) {
            header("location:raiz.php");
        }else{
            $this->response['msg']="Login sem sucesso!";
        }
        //print_r($this->dados);
        //exit;
    }

    private function iniciar($param) {
        require_once 'php/sql.php';
        $this->sql = new sql();
        $this->sql->setTipoRetorno("php");
        $this->request = $_POST;
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->request = $_GET;
        }
    }

}
?>