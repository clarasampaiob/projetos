Algoritmo "AULA 7"
// IF ELSE / OPERADORES LOGICOS - SALA LOTADA

Var
   pessoas_sala : inteiro
   maximo: inteiro
   conta: inteiro

Inicio
   escreval ("Digite o numero de pessoas que est�o na sala: ")
   leia (pessoas_sala)
   escreval ()



   se (pessoas_sala >= 10) entao
      escreval ("H� 10 pessoas na sala. A sala est� cheia")
   senao
        maximo <- 10
        conta <- maximo - pessoas_sala
        escreval ("faltam ", conta, " pessoas para encher a sala")
   fimse

Fimalgoritmo
