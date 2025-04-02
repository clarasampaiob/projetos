algoritmo "AULA 15"
// SERVIÇOS VIVO

var
 opcao: inteiro
 saldo, recarga, soma: real
 contratar, voltarmenu, reclamacao: caractere
 
inicio

   repita

      escreval ("1 - Promoção VIVO Turbo")
      escreval ("2 - Fazer uma Recarga ")
      escreval ("3 - Fazer uma Reclamação")
      escreval ("4 - Sair")
      leia (opcao)

      escolha (opcao)

      caso 1

           escreval ("Digite seu saldo")
           leia (saldo)
           escreval ("PROMOÇÃO VIVO TURBO 55 REAIS")
           escreval ("Deseja contratar a promoção [s/n]")
           leia (contratar)

           se (contratar = "s") entao
              se (saldo >= 55) entao
                 escreval ("Promoção contratada")
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
            escreval ("Seu saldo atual é de R$ ",soma)

            escreval ("Deseja voltar ao menu? [s/n]")
            leia (voltarmenu)


       caso 3
            escreval ("Digite sua reclamação")
            leia (reclamacao)

            escreval ("Sua reclamação foi enviada")
            escreval ("Deseja voltar ao menu? [s/n]")
            leia (voltarmenu)


       caso 4
           escreval ("A VIVO agradece")
           voltarmenu <- "n"

      fimescolha
      
   ate (voltarmenu = "n")


fimalgoritmo


