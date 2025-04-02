algoritmo "AULA 13"
// CARRINHO DE COMPRAS CLIENTE

var
produto, resp: caractere
valor, total: real

inicio

   repita
         escreval ("Produto: ")
         leia (produto)

         escreval ("Valor: R$")
         leia (valor)

         total <- total + valor

         escreval ("Deseja adicionar outro produto? [s/n]")
         leia (resp)

   ate (resp = "n")

   escreval ("O valor total a pagar é R$",total)

fimalgoritmo

