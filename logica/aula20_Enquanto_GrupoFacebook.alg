algoritmo "AULA 20"
// CADASTRO GRUPO FACEBOOK - 6 USUÁRIOS

var
  grupo, nome, email, resp: caractere
  cont: inteiro

inicio
      escreval ("Grupo: ")
      leia (grupo)

      cont <- 0
      enquanto ((cont < 6)) faca
               escreval ("Nome: ")
               leia (nome)

               escreval ("Email: ")
               leia (email)

               escreval ("Deseja cntinuar? [s/n] ")
               leia (resp)

               se (resp = "n") entao
                  cont <- 6
               senao
                    cont <- cont + 1
                    escreval (cont)
               fimse
    fimenquanto

fimalgoritmo

