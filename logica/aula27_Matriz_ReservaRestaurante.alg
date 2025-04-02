algoritmo "AULA 27"
// RESERVA RESTAURANTE


Var
reserva: vetor[1..3,1..6] de caractere
linha,coluna: inteiro

Inicio
   para linha <- 1 ate 3 faca
      para coluna <- 1 ate 6 faca

         se (coluna = 1) entao
         escreval ("Nome: ")
         leia (reserva[linha,coluna])
         fimse

         se (coluna = 2) entao
         escreval ("Data: ")
         leia (reserva[linha,coluna])
         fimse

         se (coluna = 3) entao
         escreval ("Horário: ")
         leia (reserva[linha,coluna])
         fimse

         se (coluna = 4) entao
         escreval ("Numero Mesa: ")
         leia (reserva[linha,coluna])
         fimse

         se (coluna = 5) entao
         escreval ("Acompanhantes: ")
         leia (reserva[linha,coluna])
         fimse

         se (coluna = 6) entao
         escreval ("Local [AR LIVRE / ESTABELECIMENTO]: ")
         leia (reserva[linha,coluna])
         fimse

      fimpara
      limpatela()
   fimpara

   limpatela()
   
   
   para linha <- 1 ate 3 faca
      para coluna <- 1 ate 6 faca
           escreval (reserva[linha,coluna])
      fimpara
   fimpara


Fimalgoritmo

