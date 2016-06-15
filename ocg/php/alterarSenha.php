<?php

session_start();
require_once ('executarSql.php');
switch ($_POST['filtro']) {
    case "alterarSenha":
        alterarSenha();
        break;
    default:
        break;
}

function alterarSenha() {
    $sql = "update ocg_usuario set senha= '" . utf8_decode(trim($_POST['novasenha'])) . "'";
    $sql.= " Where login = '" . $_SESSION['LOGIN'] . "' AND senha = '" . utf8_decode(trim($_POST["senhaAtual"])) . "'";
    $retorno = executarSql($sql);
    if ($retorno) {
        echo $retorno;
    } else {
        echo utf8_encode("Senha atual est� incorreta, verifique e tente novamente.");
    }
}

?>