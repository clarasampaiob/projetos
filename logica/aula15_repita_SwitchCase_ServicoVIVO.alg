algoritmo "AULA 15"
// SERVI�OS VIVO

var
 opcao: inteiro
 saldo, recarga, soma: real
 contratar, voltarmenu, reclamacao: caractere
 
inicio

   repita

      escreval ("1 - Promo��o VIVO Turbo")
      escreval ("2 - Fazer uma Recarga ")
      escreval ("3 - Fazer uma Reclama��o")
      escreval ("4 - Sair")
      leia (opcao)

      escolha (opcao)

      caso 1

           escreval ("Digite seu saldo")
           leia (saldo)
           escreval ("PROMO��O VIVO TURBO 55 REAIS")
           escreval ("Deseja contratar a promo��o [s/n]")
           leia (contratar)

           se (contratar = "s") entao
              se (saldo >= 55) entao
                 escreval ("Promo��o contratada")
                 escreval ("Vc deseja voltar ao menu incial? [s/n]")
                 leia (voltarmenu)
              senao
                   escreval ("Saldo insuficiente. Deseja voltar ao menu?[s/n]")
                   leia (voltarmenu)
              fimse
           senao
               escreval ("Vc deseja voltar ao menu incial?[s/n]")
               leia (voltarmenu)
           fimse


       caso 2
            escreval ("Digite o valor da recarga")
            leia (recarga)

            escreval ("Digite seu saldo")
            leia (saldo)

            soma <- saldo + recarga
            escreval ("Seu saldo atual � de R$ ",soma)

            escreval ("Deseja voltar ao menu? [s/n]")
            leia (voltarmenu)


       caso 3
            escreval ("Digite sua reclama��o")
            leia (reclamacao)

            escreval ("Sua reclama��o foi enviada")
            escreval ("Deseja voltar ao menu? [s/n]")
            leia (voltarmenu)


       caso 4
           escreval ("A VIVO agradece")
           voltarmenu <- "n"

      fimescolha
      
   ate (voltarmenu = "n")


fimalgoritmo


