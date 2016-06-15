$().ready(function() {
	// Validação de formulário de adicionar e editar produtos
	$("#frmCadEscola").validate({
		rules: {
			"txtEscola": { required: true},
			"txtApelido": { required: true },
			"txtEmail": { required: true,
							email: true},
			"txtEndereco": { required: true },
			"txtNumero": { required: true },
			"txtComplemento": { required: false },
			"txtCEP": { required: false },
			"txtBairro": { required: true },
			"txtNomeDiretor":  { required: true },
			"txtRGDiretor":  { required: true },
			"txtFoneEscola":  { required: true },
			"txtFax":  { required: false },
			"txtFoneDiretor":  { required: true },
			"cboTipoEscola":  { required: true }
		},
		messages: {
			"txtEscola": "Preencha a Escola!",
			"txtApelido": "Preencha o Apelido!",
			"txtEmail": "Preencha o E-mail!",
			"txtEndereco": "Preencha o Endereço!",
			"txtNumero": "Preencha o Número!",
			"txtCEP": "Preencha o CEP!",
			"txtBairro": "Preencha o Bairro!",
			"txtNomeDiretor":  "Preencha o Nome do Diretor!",
			"txtRGDiretor":  "Prencha o RG do Diretor!",
			"txtFoneEscola":  "Preencha o telefone da Escola!",
			"txtFax":  "Preencha o Fax da Escola!",
			"txtFoneDiretor":  "Preencha o Telefone do Diretor!",
			"cboTipoEscola":  "Preencha o Tipo da Escola!"
		}
	});
	
	$("#frmCadProfessor").validate({
		rules: {
			"txtNome": { required: true, minlength: 3},
			"txtRG": { required: true, minlength: 3 },
			"txtCREF": { required: true, minlength: 3},
			"txtFone": { required: true, minlength: 3 },
			"txtEmail": { required: true, email: true, minlength: 3},
			"txtCelular": { required: true, minlength: 3 }
			/*"txtLogin":{required: true, minlength: 3},
			"txtSenha":{required: true, minlength: 3, maxlength: 8}*/
		},
		messages: {
			"txtNome": "Preencha o Nome!",
			"txtRG": "Preencha o RG!",
			"txtCREF": "Preencha o CREF!",
			"txtFone": "Preencha o Telefone!",
			"txtEmail": "Preencha o E-mail!",
			"txtCelular": "Preencha o Celular!"
			/*"txtLogin": "Preencha o Login!",
			"txtSenha": "A Senha deve conter de 3 a 8 caracteres!"*/
		}
	});
	
	$("#cmdSalvarProfessor").click(function(){
	    //$("#frmCadProfessor").valid();
	    if($("#frmCadProfessor").valid()){
	    	submitForm();	
	    }
	    
	});
	
	$("#frmCadModalidade").validate({
		rules: {
			"txtModalidade": { required: true, minlength: 3}
		},
		messages: {
			"txtModalidade": "Preencha a Modalidade!"
		}
	});
	
	$("#frmCadCategoria").validate({
		rules: {
			"txtCategoria": { required: true, minlength: 3},
			"txtIdadeMin": { required: true, range:[3, 25]},
			"txtIdadeMax": { required: true, range:[3, 25], min:$("#txtIdadeMin").val()}
		},
		messages: {
			"txtCategoria": "Preencha a Categoria!",
			"txtIdadeMin": {required:"Preencha a idade corretamente", 
							range: "A idade deve estar entre 3 e 25"},
			"txtIdadeMax": { required: "Preencha a idade corretamente", 
							 range: "A idade deve estar entre 3 e 25",
							 min:"A idade deve ser maior de " + $("#txtIdadeMin").val()}
		}
	});
	
	$("#frmCadProva").validate({
		rules: {
			"cboModalidade": { required: true},
			"cboCategoria": { required: true },
			"txtDesc": { required: true, minlength: 5 },
			"cboTipo": { required: true},
			"txtQtdeMax": { required: false}
		},
		messages: {
			"cboModalidade": "Escolha a Modalidade!",
			"cboCategoria": "Escolha a Categoria!",
			"txtDesc": "Preencha a Descrição!",
			"cboTipo": "Escolha o Tipo!"
		}
	});
	
	$("#frmCadAluno").validate({
		rules: {
			"cboEscola": { required: true},
			"txtNome": { required: true, minlength: 3 },
			"cboNascDia": { required: true},
			"cboNascMes": { required: true},
			"cboNascAno": { required: true},
			"txtRG":{required: false}
		},
		messages: {
			"cboEscola": "Escolha a Escola!",
			"txtNome": "Preencha corretamente o nome!",
			"cboNascDia": "Escolha o dia!",
			"cboNascMes": "Escolha o mês!",
			"cboNascAno": "Escolha o ano!",
			"txtRG":""
		}
	});
	
	$("#cmdSalvarAluno").click(function(){
	    //$("#frmCadProfessor").valid();
	    if($("#frmCadAluno").valid()){
	    	validar();	
	    }
	    
	});
	
});
