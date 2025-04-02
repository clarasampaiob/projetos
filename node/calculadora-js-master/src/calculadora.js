export const OPERACAO_INVALIDA = 'OPERACAO_INVALIDA'

export const calculadora = (operacao, valores) => {
  
  let resultado;

  switch (operacao) {

    case 'soma':
      resultado = valores[0];
      for(let i = 1; i < valores.length; i++) {
        resultado += valores[i];
      } 
      break;


    case 'subtracao':
      resultado = valores[0];
      for(let i = 1; i < valores.length; i++) {
        resultado -= valores[i];
      } 
    break;


    case 'multiplicacao':
      resultado = valores[0];
      for(let i = 1; i < valores.length; i++) {
        resultado *= valores[i];
      } 
    break;


    case 'divisao':
      resultado = valores[0];
      for(let i = 1; i < valores.length; i++) {
        resultado /= valores[i];
      } 
    break;
    

    default:
      resultado = OPERACAO_INVALIDA;
    break;
  }

  return resultado;
  

}


const tresMaisQuatro = calculadora("soma", [3, 4])
console.log(tresMaisQuatro) // 7

const cemMenosDois = calculadora("subtracao", [2, 100])
console.log(cemMenosDois) // 98

const cemVezesDez = calculadora("multiplicacao", [10, 100])
console.log(cemVezesDez) // 1000

const divQuarentaECincoPorNove = calculadora("multiplicacao", [45, 9])
console.log(divQuarentaECincoPorNove) // 5

const operacaoInvalida = calculadora("ma oe", [1, 2, 3])
console.log(operacaoInvalida) // "OPERAÇÃO INVÁLIDA"

