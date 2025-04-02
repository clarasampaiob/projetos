algoritmo "AULA 18"
// CADASTRO DE USUÁRIOS

var
 user, senha: caractere
 cont, qtdd: inteiro

inicio

      escreval ("Quantos usuários deseja cadastrar?")
      leia (qtdd)

      cont <- 0
      enquanto (cont < qtdd) faca

               escreval ("ID: ",cont)
               
               escreval ("Usuário")
               leia (user)

               escreval ("Senha")
               leia (senha)
               
               escreval ()

               cont <- cont + 1

      fimenquanto

fimalgoritmo

