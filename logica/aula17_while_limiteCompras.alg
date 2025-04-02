algoritmo "AULA 17"
// LIMITE CRÉDITO


var
 limite, valor_total, valor: real
 produto: caractere
 

inicio

      escreval ("Limite: R$")
      leia (limite)
      
      enquanto (valor_total < limite) faca
      
               escreval ("Produto: ")
               leia (produto)
      
               escreval ("Valor: R$")
               leia (valor)
               
               valor_total <- valor_total + valor
               
               escreval ("Valor Total: R$", valor_total)
               
      fimenquanto
      
      
      se (valor_total > limite) entao
            escreval ("Limite alcançado! Você não pode comprar o produto ",produto," no valor de R$",valor)
            valor_total <- valor_total - valor
            escreval ("Valor Final: R$", valor_total)
      fimse


fimalgoritmo
