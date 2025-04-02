algoritmo "AULA 16"
// DEPÓSTIOS POUPANÇA

var
 max, valor_deposito, valor_total, saque: real

inicio

      escreval ("Valor máximo a guardar na poupança: R$")
      leia (max)

      enquanto (valor_total < max) faca

               escreval ("Valor a depositar: R$")
               leia (valor_deposito)

               valor_total <- valor_total + valor_deposito

               escreval ("Valor Total: R$", valor_total)

      fimenquanto


      se (valor_total > max) entao
            saque <- valor_total - max
            escreval ("Limite alcançado! Retire R$",saque," no caixa")
      fimse

fimalgoritmo

