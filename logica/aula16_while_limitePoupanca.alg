algoritmo "AULA 16"
// DEP�STIOS POUPAN�A

var
 max, valor_deposito, valor_total, saque: real

inicio

      escreval ("Valor m�ximo a guardar na poupan�a: R$")
      leia (max)

      enquanto (valor_total < max) faca

               escreval ("Valor a depositar: R$")
               leia (valor_deposito)

               valor_total <- valor_total + valor_deposito

               escreval ("Valor Total: R$", valor_total)

      fimenquanto


      se (valor_total > max) entao
            saque <- valor_total - max
            escreval ("Limite alcan�ado! Retire R$",saque," no caixa")
      fimse

fimalgoritmo

