<?php
setlocale(LC_CTYPE, "pt_BR");
require_once ('executarSql.php');
switch ( $_POST["acao"] ) {
	case "inscrever":Incluir();break;
	case "excluir":Excluir();break;	
	default:break;
}

function Incluir() {
    $sql = "INSERT INTO ocg_inscricao_aluno (DTSISTEMA,IDPROVA,IDESCOLA,IDALUNO) VALUES (SYSDATE,".$_POST['txtIdProva'];
    $sql.= "," .$_POST['txtIdEscola'] . "," . $_POST['txtIdAluno'].")";
    echo executarSql($sql);    
}

function Excluir() {
    $sql = "DELETE FROM ocg_inscricao_aluno WHERE idEscola = " . $_POST['txtIdEscola'] . " AND idProva = " . $_POST['txtIdProva']. " AND idAluno = " . $_POST['txtIdAluno'];
    echo executarSql($sql);    
}
?> 