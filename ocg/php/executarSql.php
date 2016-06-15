<?php

function executarSql($sql) {
    require_once("../../lib/php/bd_pdo.php");
    $banco = new Banco();
    $conn = $banco->conectar($bd);
    try {
        $sql = trim($sql);
        //echo $sql;exit;
        //$pdo = $this->conn->openConnection();
        //print_r($pdo);
        $stmt = $conn->prepare($sql);
        //echo $this->response["mensagem"];
        //exit;
        $stmt->execute();
        if (substr($sql, 0, 6) == "SELECT") {
        	$response = $stmt->fetchAll(PDO::FETCH_ASSOC);
        	return $response;
        }
        return true;
    } catch (PDOException $e) {
        $retorno = utf8_encode("Erro SQL! " . $e->getMessage() . " ==> " . $sql);
        echo $retorno;
        return false;
        
        //exit;
    }
    return null;
}

?> 