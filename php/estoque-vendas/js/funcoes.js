
function validarFormVazio(formulario){
		dados=$('#' + formulario).serialize(); // Recebe os dados do formulário
		d=dados.split('&'); // Verifica se os campos contém algum caracter
		vazios=0;
		for(i=0;i< d.length;i++){  // d.length: qtdd de caracteres
				controles=d[i].split("=");
				if(controles[1]=="A" || controles[1]==""){
					vazios++;
				}
		}
		return vazios;
	}
