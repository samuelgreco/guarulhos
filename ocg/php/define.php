<?php

session_start();

switch ($_POST["filtro"])
{
	case 'IDPesquisa':
		$_SESSION["varID"] = $_POST["varID"];
		break;
		
	case 'DestroiSessao':
		unset($_SESSION["varID"]);
		unset($_SESSION["IDProfessor"]);
		break;
		
	case 'IDProfessor':
		if (isset($_SESSION["varIDProfessor"])) {
			echo $_SESSION["varIDProfessor"];
		}else{
			echo 0;
		}
	    break;
	case 'DefineLogin':
		$_SESSION["varIDEscola"] = $_POST["IDEscola"];
	    //print_r($_SESSION);
	    break;
	
	case 'GetLogin':
		if (isset($_SESSION["varIDEscola"])) {
			echo $_SESSION["varIDEscola"];
		}else{
			echo 0;
		}
	    break;
	    
	default:
		break;


}

?>