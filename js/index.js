const MIN_LOGIN_LENGTH = 6;
const MIN_NAME_LENGTH = 6;
const MIN_PWD_LENGTH = 6;


function check(form){
	var msg = "";
	var login = form.login;
	if(login.value.length < MIN_LOGIN_LENGTH){
		msg += "Usuario muito curto. Minimo "+ MIN_LOGIN_LENGTH +" caracteres!\n";
		login.style.borderColor = "red";
	}

	var nome = form.name;
	if(nome.value.length < MIN_NAME_LENGTH){
		msg += "Nome muito curto. Minimo "+ MIN_NAME_LENGTH +" caracteres!\n";
		nome.style.borderColor = "red";
	}

	var s = form.senha[0];
	var s2 = form.senha[1];

	if(s.value.length < MIN_PWD_LENGTH && s.value.search("([0-9A-Z.@#$!%^&*?/~+])+") == -1){
		msg += "Senha deve ter ao menos um caractere especial, um numero e ser maior que "+ MIN_PWD_LENGTH +" digitos!\n";
		s.style.borderColor = "red";
	}

	if(s.value != s2.value){
		msg += "As senhas nao conferem!";
		s2.style.borderColor = "red";
	}

	if(msg){
		alert(msg);
		return false;
	}
	return true;
}

var inputs = document.getElementsByTagName('input');
for(var i = 0; i < inputs.length; i++){
	var borda = inputs[i].style.border;
	inputs[i].addEventListener("focus", function(){this.style.border = borda;});
}