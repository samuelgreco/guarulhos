<?php

require_once("executarSql.php");
setlocale(LC_CTYPE, "pt_BR");
switch ($_POST['acao']) {
    case "salvar":
        Incluir();
        break;
    case "excluir":
        excluir();
        break;
    default:
        break;
}

function Incluir() {
    $sql = "DELETE FROM ocg_tabela WHERE idProva=" . $_POST['idProva'];
    executarSql($sql);

    $sql = "INSERT INTO ocg_tabela (idProva,Escola,placar,rodada,posicao) VALUES (";

    $dados = $_POST["tabela"];
    $dados = substr($dados, 0, strlen($dados) - 1);
    $dados = explode("|", $dados);
    $sqlS = array();
    for ($x = 0; $x < count($dados); $x = $x + 5) {
        $virgula = "";
        $campos = "";
        $apostrofo = "";
        for ($y = 0; $y < 5; $y++) {
            $apostrofo = "";
            if ($y == 1) {
                $apostrofo = "'";
            }
            if (empty($dados[($x + $y)])) {
                $dados[($x + $y)] = "0";
            }
            $campos .= $virgula . $apostrofo . $dados[($x + $y)] . $apostrofo;
            $virgula = ",";
        }
        $sqlS[(count($sqlS) + 1)] = utf8_decode($sql . $campos . ")");
    }
    $gravou = true;
    foreach ($sqlS as $k => $sql) {
        //echo $sql . "\n";
        if (executarSql($sql)) {
            if ($gravou) {
                $gravou = true;
            }
        } else {
            $gravou = false;
        }
    }
    echo $gravou;
}

function excluir() {
    $sql = "DELETE FROM ocg_tabela WHERE idProva=" . $_POST['txtID'];
    if (executarSql($sql)) {
        echo true;
    } else {
        echo false;
    }
}

?> 