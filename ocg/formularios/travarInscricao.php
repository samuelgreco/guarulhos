		<?php
session_start();
$class = new travarInscricao();
//print_r($class->lst);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>        
        <style>
            .titulo{
                margin-bottom: 2%;
            }
            .tabela{
                width:100%;
                border:solid 1px #000;
                margin-bottom: 15%;
            }
            .tabela thead tr th{
                background: #4571b3;
                font-size: large;
                font-weight: bold;
                text-align: center;
            }
            .tabela tbody tr td{
                border:solid 2px #000;
             
            }
            #escolaInscricao,#escolaExclusao,#alunoInscricao,#alunoExclusao,#alunoInsert,#alunoDelete,#alunoUpdate{
                text-align: center;
            }
        </style>
    <script type="text/javascript" src="../js/travarInscricao.js"></script>
    </head>
    <body class="bodyTravaInscricao">
        <div class="container">
            <h1>
            	Travar Inscri&ccedil;&otilde;es de escola e aluno:
            </h1>
            <table id="tabela" class="tabela">
                <thead>
                    <tr>
                        <th>
                            Sujeito de Inscri&ccedil;&atilde;o
                        </th>
                        <th>
                            Inscri&ccedil;&atilde;o / Edi&ccedil;&atilde;o
                        </th>
                        <th>
                            Exclus&atilde;o
                        </th>
                    </tr>
                </thead>
                <tbody>                    
                    <tr>
                        <td class="tdEscola">
                            <h3 style='font-size:20px'>Escola</h3>
                        </td>
                        <td id="escolaInscricao" onclick="gravarTrava(this.id)">
                            <?= $class->getCadeado("escolaInscricao") ?>
                        </td>
                        <td id="escolaExclusao" onclick="gravarTrava(this.id)">                            
                            <?= $class->getCadeado("escolaExclusao") ?>                            
                        </td>                        
                    </tr>
                    <tr>
                        <td class="tdEscola">
                            <h3 style='font-size:20px'>
                                Aluno
                            </h3>
                        </td>
                        <td id="alunoInscricao" onclick="gravarTrava(this.id)">                            
                            <?= $class->getCadeado("alunoInscricao") ?>
                        </td>
                        <td id="alunoExclusao" onclick="gravarTrava(this.id)">                            
                            <?= $class->getCadeado("alunoExclusao") ?>
                        </td>                        
                    </tr>
                    <tr>
                        <td class="tdEscola">
                            <h3 style='font-size:20px'>
                                Aluno (Cadastro)
                            </h3>
                        </td>
                        <td id="alunoInsert" onclick="gravarTrava(this.id)">                            
                            <?= $class->getCadeado("alunoInsert") ?>
                        </td>
                        <td id="alunoDelete" onclick="gravarTrava(this.id)">                            
                            <?= $class->getCadeado("alunoDelete") ?>
                        </td>                        
                    </tr>
                    <tr>
                        <td class="tdEscola">
                            <h3 style='font-size:20px'>
                                Aluno(Atualizar Dados Cadastro)
                            </h3>
                        </td>
                        <td id="alunoUpdate" onclick="gravarTrava(this.id)">                            
                            <?= $class->getCadeado("alunoUpdate") ?>
                        </td>
                        <td id="#" >                            
                            &nbsp;
                        </td>                        
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>

<?php

class travarInscricao {

    public $request;
    public $dados;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        $this->getDados($param);
    }

    private function getDados($param) {
        $this->dados = $this->sql->lstTrava($param);
        $this->dados = $this->dados[0];
        /*
          echo "<pre>";
          print_r($this->lst );
          echo "</pre>";
          exit;
         */
    }

    private function iniciar($param) {
        require_once '../php/sql.php';
        // echo "<hr/>1";
        $this->sql = new sql();
        $this->sql->setTipoRetorno("php");

        $this->request = $_POST;
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->request = $_GET;
        }
    }

    public function getCadeado($param) {        
        $valor="";
        switch ($param) {
            case "escolaInscricao":$valor=$this->dados['ESCOLAINSCRICAO'];break;
            case "escolaExclusao":$valor=$this->dados['ESCOLAEXCLUSAO'];break;
            case "alunoInscricao":$valor=$this->dados['ALUNOINSCRICAO'];break;
            case "alunoExclusao":$valor=$this->dados['ALUNOEXCLUSAO'];break;
            case "alunoInsert":$valor=$this->dados['ALUNOINSERT'];break;
            case "alunoDelete":$valor=$this->dados['ALUNODELETE'];break;            
            case "alunoUpdate":$valor=$this->dados['ALUNOUPDATE'];break;
            default:
                break;
        }
        $retorno="<input type='hidden' id='".$param."_valor' value='".  $valor."' />";
        if ($valor == 1) {
            $retorno.= "<img width='40' src='../../lib/images/icones/aberto.jpg'/>";
        }else{
            $retorno.= "<img width='40' src='../../lib/images/icones/fechado.png'>";
        }
        return $retorno;
    }

}
?>
