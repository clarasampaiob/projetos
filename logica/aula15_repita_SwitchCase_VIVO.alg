Algoritmo "AULA 15"
// SERVI�OS DA VIVO

Var
opcao : inteiro
contratar: caractere
saldo: real
continua, problema: caractere
credito: real

Inicio

repita
      escreval ("DIGITE [1]: PROMO��O VIVO CONTROLE")
      escreval ("DIGITE [2]: RELATAR UM PROBLEMA")
      escreval ("DIGITE [3]: FAZER UMA RECARGA")
      escreval ("DIGITE [4]: SAIR")
      escreval ()

      leia (opcao)
      
      
     escolha opcao
         caso 1
              limpatela()
              escreval ("PROMO�AO VIVO CONTROLE")
              escreval ("4GB INTERNET")
              escreval ("LIGA��O ILIMITADA")
              escreval ("SMS ILIMITADO")
              escreval ("---------------------------------")
              escreval ("VALOR R$ 55,00")
              escreval ()
              escreval ("DESEJA CONTRATAR A PROMO��O? [SIM/NAO]")
               leia (contratar)
               
              se (contratar = "SIM") OU (contratar = "sim") ou (contratar = "S") ou (contratar = "s")  entao
                 escreval ("PARA EFETIVAR UMA TAXA � COBRADA")
                 escreval ("DIGITE SEU SALDO: ")
                 leia (saldo)
                 
                 se (saldo >= 55) entao
                    escreval ("A PROMO��O FOI CONTRATADA. DESEJA VOLTAR AO MENU ANTERIOR? [SIM/NAO]")
                    leia (continua)
                    limpatela()
                 senao
                      escreval ("SALDO INSUFICIENTE. DESEJA VOLTAR AO MENU ANTERIOR? [SIM/NAO]")
                      leia (continua)
                      limpatela()
                 fimse
              senao
                  escreval ("QUE PENA. CONFIRA AS OUTRAS PROMO��ES")
                  continua <- "sim"
                  timer (2500)
                  timer (0)
                  limpatela()
              fimse

         caso 2
              limpatela()
              escreval ("DIGITE O SEU PROBLEMA E VEREMOS COMO PODEMOS AJUDAR")
              leia (problema)
              

              escreval ("MENSAGEM ENVIADA COM SUCESSO. DESEJA VOLTAR AO MENU ANTERIOR? [SIM/NAO]")
              leia (continua)
              limpatela()

         caso 3
              limpatela ()
              escreval ("DIGITE OS CR�DITOS A COLOCAR R$ ")
              leia (credito)
              escreval ("VC COLOCOU ",credito," REAIS")
              timer (1000)
              timer(0)
              limpatela()

         caso 4
              limpatela()
              escreval ("A VIVO AGRADECE")
      fimescolha
      
ate (continua = "nao") ou (continua = "NAO") ou  (opcao = 4)

    se (continua = "nao") entao
         limpatela()
         escreval ("A VIVO AGRADECE")
    fimse

Fimalgoritmo
