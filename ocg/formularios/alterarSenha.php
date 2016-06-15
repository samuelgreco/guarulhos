<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8">
        <?php
        require_once 'head_lst.php';
        ?>
        <script src="../js/alterarSenha.js"></script>
        <title>Alterar Senha</title>
    </head>
    <body>
        <div class="container">
            <h1>Alterar Senha</h1>
            <input id="acao" name="acao" type="hidden" value="alterarSenha">
	            <table>
	                <tr>
	                    <td>
	                        <label>Senha Atual:</label>
	                    </td>
	                    <td>
	                        <input id="senhaatual" type="password" />
	                    </td>
	                </tr>
	                <tr>
	                    <td>
	                        <label>Nova Senha:</label>
	                    </td>
	                    <td>
	                        <input id="novasenha" maxlength="20" type="password" />
	                    </td>
	                </tr>
	                <tr>
	                    <td>
	                        <label>Repita a nova Senha:</label>
	                    </td>
	                    <td>
	                        <input id="novasenha2" maxlength="20" type="password" />
	                    </td>
	                </tr>
	            </table>
            <br />
            <input class="Salvar" name="cmdSalvarSenha" id="cmdSalvarSenha" type="button" value="Salvar" onclick="salvarSenha()" /> 
        </div>     
    </body>
</html>
