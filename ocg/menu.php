<?php
session_start();
$idperfil = $_SESSION["varIDPerfil"];
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <link rel="stylesheet" href="css/estilo_menu.css">
            <script src="../../lib/js/jquery-1.10.2.js"></script>
            <script type="text/javascript" src="../../lib/js/ajax.js"></script>
            <script type="text/javascript" src="../../lib/js/select.js"></script>
            <script type="text/javascript" src="../../lib/js/objeto.js"></script>
            <script src="../../lib/js/script.js"></script>
            <script src="js/menu.js"></script>
    </head>
    <body class="bodyMenu">
        <label id="menu" onClick="startAnimation()"><center>MENU</center></label>
        <br />
        <div id="menuInteiro">
            <div id="cssmenu">
                <ul>
                    <li class="last">
                        <a href="formularios/acessoEscola.php" target="mainFrame">
                            <span>
                                Acesso Escola
                            </span>
                        </a>
                    </li>
                    <?php
                if ($_SESSION['IDPERFIL'] ==1) {
                    ?>
                    <li class="has-sub">
                        <a href="#">
                            <span>
                                Consultas
                            </span>
                        </a>
                        <ul class="last">
                            <li>
                                <a href="formularios/consultaEscola.php" target="mainFrame">
                                    Escolas
                                </a>
                            </li>
                             <li>
                                <a href="formularios/consultaAluno.php" target="mainFrame">
                                    Alunos
                                </a>
                            </li>
                              <li>
                                <a href="formularios/consultaProfessor.php" target="mainFrame">
                                    Professores
                                </a>
                            </li>
                              <li>
                                <a href="formularios/consultaModalidade.php" target="mainFrame">
                                    Modalidade
                                </a>
                            </li>
                              <li>
                                <a href="formularios/consultaCategoria.php" target="mainFrame">
                                    Categoria
                                </a>
                            </li>	
                              <li>
                                <a href="formularios/consultaProva.php" target="mainFrame">
                                    Prova
                                </a>
                            </li>
                            <li>
                                <a href="formularios/gerarTabela.php" target="mainFrame">
                                     Gerar Tabela
                                </a>
                            </li>
                              <li>
                                <a href="formularios/consultaLocal.php" target="mainFrame">
                                    Local
                                </a>
                            </li>
               <!--                <li>
                                <a href="formularios/consultaTabela.php" target="mainFrame" >
                                    Tabela
                                </a>
                            </li> -->
                            <li>
                                <a href="formularios/travarInscricao.php" target="mainFrame">
                                    Travar Inscri&ccedil;&atilde;o
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="#">
                            <span>
                                Relat&oacute;rios
                            </span>
                        </a>
                        <ul>
                            <li>
                                <a href="formularios/relEscolaModalidade.php" target="mainFrame">
                                    Escola por modalidade
                                </a>
                            </li>
                            <li>
                                <a href="formularios/relProvaAluno.php" target="mainFrame">
                                    Inscritos por escola
                                </a>
                            </li>
                            <li>
                                <a href="formularios/relSelecionaEscola.php" target="mainFrame">
                                    Prova por escola
                                </a>
                            </li>
                            <li>
                                <a href="formularios/fichaindividual.php" target="mainFrame">
                                    Ficha Individual
                                </a>
                            </li>
                            <li>
                                <a href="relatorios/relContatoEscola.php" target="mainFrame">
                                    Contato Escola
                                </a>
                            </li>
                        </ul>
                    </li>
                   <?php
                }
                    ?>
                   <li class="last">
                        <a href="formularios/alterarsenha.php" target="mainFrame">
                            <span>
                                Alterar Senha
                            </span>
                        </a>
                    </li>
                    <li class="last">
                        <a href="javascript:sair();">
                            <span>
                                Sair
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </body>
    <html>
        <script type="text/javascript">
            function sair() {
                var varXML = chamar_ajax('../cil/php/define.php', 'filtro=DestroiSessao', false, 'text', null);
                if (varXML == 1) {
                    window.open('.', '_parent');
                }
            }

            $("#accordion > li").click(function () {
                if (false == $(this).next().is(':visible')) {
                    $('#accordion > ul').slideUp(300);
                }
                $(this).next().slideToggle(300);
            });

            $('#accordion > ul:eq(0)').show();

            var anima;

            function startAnimation() {
                var tinicio = 220;
                var tfim = 70;
                var tamanho;
                var tmenu = parseInt(window.parent.document.getElementById('fraCorpo').cols);
                if (tmenu >= tinicio) {
                    tamanho = tfim;
                    pace = -10;
                    document.getElementById('menuInteiro').style.visibility = 'hidden';
                    //document.getElementById('menuInteiro').style.width = '1px';
                    //document.getElementById('cssmenu').style.width = '1px';
                } else {
                    tamanho = tinicio;
                    pace = 10;
                    document.getElementById('menuInteiro').style.visibility = 'visible';
                }

                anima = setInterval(function () {
                    animation(tamanho, pace)
                }, 2);
            }

            function animation(x, pace) {
                var menu = window.parent.document.getElementById('fraCorpo');
                var tmenu = parseInt(window.parent.document.getElementById('fraCorpo').cols);
                if (tmenu == x) {
                    clearInterval(anima);
                }

                menu.cols = " " + (tmenu + pace) + ",*";
            }
        </script>