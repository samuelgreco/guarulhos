function salvarSenha(){
    var senhaAtual = document.getElementById('senhaatual').value;
    var novasenha = document.getElementById('novasenha').value;
    var novasenha2 = document.getElementById('novasenha2').value;
	
    if(!senhaAtual && !novasenha && !novasenha2) return;        
    if (novasenha != novasenha2){
        alert('As senhas devem coincidir')
    }else{
        var dados = "novasenha=" + novasenha;
        dados += "&senhaAtual="+senhaAtual;        
        dados += "&tipoRetorno=xml";
        dados += "&filtro=alterarSenha";
        var retorno = chamar_ajax('../php/alterarSenha.php', dados, false, 'txt', null);                    
        if (retorno == 1) {            
            alert('Salvo com sucesso!');
           window.location.href = "../rosto.php";        
        }else{
            alert(retorno);
        }
    }	
    document.getElementById('senhaatual').value = "";
    document.getElementById('novasenha').value = "";
    document.getElementById('novasenha2').value = "";
}