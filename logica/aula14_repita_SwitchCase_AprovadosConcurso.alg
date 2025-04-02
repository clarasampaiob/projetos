algoritmo "AULA 14"
// APROVADOS EM CONCURSO

var
opcao, acertos, aprovados, reprovados: inteiro
resp, resp2, nome: caractere

inicio


   repita
         escreval ("Nome: ")
         leia (nome)

         escreval ("Número de acertos [max 100 questões]")
         leia (acertos)

         se (acertos >= 65) entao
            aprovados <- aprovados + 1
         senao
              reprovados <- reprovados + 1
         fimse

         escreval ("Deseja continuar? [s/n]")
         leia (resp)

   ate (resp = "n")


   repita
      escreval ("OPÇÕES: ")
      escreval ("[1] APROVADOS")
      escreval ("[2] REPROVADOS")
      leia (opcao)

      escolha opcao

              caso 1
                   escreval ("Aprovados: ", aprovados)
                   escreval ("Deseja ver os Reprovados? [s/n]")
                   leia (resp2)
                   se (resp2 = "s") entao
                       escreval ("Reprovados: ", reprovados)
                       resp2 <- "n"
                   fimse

              caso 2
                   escreval ("Reprovados: ", reprovados)
                   escreval ("Deseja ver os Aprovados? [s/n]")
                   leia (resp2)
                   se (resp2 = "s") entao
                       escreval ("Aprovados: ", aprovados)
                       resp2 <- "n"
                   fimse

              outrocaso
                   escreval ("Opção Inválida! Deseja retornar ao menu incial? [s/n]")
                   leia (resp2)

       fimescolha
       
    ate (resp2 = "n")




fimalgoritmo
