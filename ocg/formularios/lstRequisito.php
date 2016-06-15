<?php
session_start();
$class = new lstRequisito();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require_once 'head_lst.php';
        ?>
        <script type="text/javascript" language="javascript" src="../js/lstLocal.js"></script>
        <style type="">
            .tbDados{
                margin-bottom: 2%;
                width: 70%;
            }
            .tdPesquisa{
                width: 60%;
            }
            .txtLocal{
                width: 100%;
            }
            .Pesquisar{
                padding-left:300px;
                padding-bottom:2%;
            }
        </style>
    </head>
    <body class="bodyLstRequisito">
        <div class="container">
            <h1>
                Requisitos                
            </h1>            
                <table class="display" id="tabela" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TIPO</th>
                            <th>GRUPO</th>
                            <th>NOME</th>
                            <th>DESCRI&Ccedil;&Atilde;O</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($class->lst as $k => $v) {
                            ?>    
                            <tr id="linha<?= $k ?>">
                                <td style="padding: 12px;">
                                    <?= $v[0] ?>
                                </td>
                                <td>
                                    <?= $v[1] ?>
                                </td>
                                <td style="text-align: left;">
                                    <?= $v[2] ?>
                                </td>
                                <td style="text-align: left;">
                                    <?= $v[3]?>
                                </td>
                                <td style="text-align: left;">
                                    <?= $v[4] ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?> 
                    </tbody>
                </table>
                <p></p>
                <br />
                <br />
        </div>
    </body>
</html>

<?php

class lstRequisito{

    public $request;
    public $lst;
    public $sql;

    public function __construct() {
        $this->iniciar($param);
        /*
          echo "<pre>";
          print_r($this->request);
          echo "</pre>";
          exit;
         */
        $this->getDados($param);
    }

    private function getDados($param) {
        $this->lst = $this->lstRequisitos($param);
        /* require_once '../php/sql.php';
          $this->sql = new sql();
          $this->sql->setTipoRetorno("php");
          $this->lst = $this->sql->lstAluno($param); */
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

    private function lstRequisitos($param) {
        $i = 0;
        $lst[($i++)] = array("<B>FEITO</B>", "Funcional", "Inscrição", "Inscrição de aluno", "A ferramenta não deve permitir a inscrição de um mesmo aluo em mais de uma categoria.");
        $lst[($i++)] = array("<B>FEITO</B>", "Funcional", "Inscrição", "Inscrição de aluno", "A ferramenta deve ser flexível para definir quantas inscrições um aluno pode fazer por modalidade de acordo com a categoria  do aluno.");
        $lst[($i++)] = array("RF003", "Funcional", "Inscrição", "Inscrição de aluno", "A ferramenta deve exigir um numero mínimo de inscritos por modalidade.	");
        $lst[($i++)] = array("RF004", "Funcional", "Inscrição", "Inscrição de aluno", "A ferramenta somente deve permitir a impressão dos comprovantes de inscrição após o fechamento do período de inscrição	");
        $lst[($i++)] = array("<B>FEITO</B>", "Funcional", "Inscrição", "Inscrição de aluno", "A ferramenta não deve permitir editar ou excluir inscrições após o fechamento do período de inscrição com exceção do administrador.	");
        $lst[($i++)] = array("<B>FEITO</B>", "Não Funcional", "Inscrição", "Inscrição de aluno", "A ferramenta de exibir o nome, sobrenome  e RG dos  inscritos.	");
        $lst[($i++)] = array("RNF002", "Não Funcional", "Relatório", "Sumulas", "A ferramenta deve exibir a formatação correta da sumula de Handebol.	");
        $lst[($i++)] = array("<B>FEITO</B>", "Não Funcional", "Relatório", "Quantitativo", "A ferramenta deve fornecer um relatório com o total de alunos inscritos e um total de alunos inscritos por escola sem duplicidade.	");
        $lst[($i++)] = array("<B>FEITO</B>", "Não Funcional", "Funcionalidades", "Caracteres", "A ferramenta deve tratar os caracteres especiais.	");
        $lst[($i++)] = array("<B>FEITO</B>", "Não funcional", "Usabilidade", "Layout", "O sistema seguirá o padrão de layout definido pela equipe de desenvolvimento, a fim de manter o padrão das aplicações e facilitar o acesso devido a familiarização com os demais sistemas da SE.");
        $lst[($i++)] = array("<B>FEITO</B>", "Não funcional", "Usabilidade", "Compatibilidade com navegadores mais acessados", "O sistema de funcionar quando acessados através dos navegadores: Internet Explorer, Firefox, Google Chrome, Colocar demais navegadores");
        $lst[($i++)] = array("<B><B>FEITO</B></B>", "Não funcional", "Desempenho", "Tempo de carregamento das tabelas do sistema", "Nenhuma tabela do sistema deverá demorar mais que XX segundos para ser carregada.	");
        $lst[($i++)] = array("<B>FEITO</B>", "Não funcional", "Confiabilidade", "Disponibilidade do sistema", "O sistema deve estar sempre disponível aos usuários	");
        $lst[($i++)] = array("RNF009", "Não funcional", "Portabilidade", "Acesso em aplicativos móveis", "O sistema deve funcionar em dispositivos móveis como celulares e tablets, sem a necessidade de modificar o layout das páginas.	");
        $lst[($i++)] = array("<B>FEITO</B>", "Não funcional", "Implementação", "Linguagem de programação", "O sistema deverá ser desenvolvido na linguagem PHP.	");
        $lst[($i++)] = array("<B>FEITO</B>", "Não funcional", "Implementação", "Banco de dados", "A ferramenta deverá ser migrada para a base de dados ORACLE.	");
        $lst[($i++)] = array("<B>FEITO</B>", "Não funcional", "Confiabilidade", "Quantidade de acessos simultâneos", "O sistema deve suportar até 200 usuários logados simultaneamente.	");
        return $lst;
    }

}

// FIM DA CLASSE
?>
