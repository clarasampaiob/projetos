algoritmo "AULA 21"
// CADASTRO DE LIVROS VETORES

var
 livro: vetor[1..4] de caractere
 posicao: inteiro

inicio

      para posicao <- 1 ate 4 faca

               escreval ("Posição: ",posicao)
               
               escreval ("Livro")
               leia (livro[posicao])

               limpatela ()

      fimpara
      
      para posicao <- 1 ate 4 faca

               escreval ("Livro: ", livro[posicao] )
      fimpara
      
      escreval ("Livro 1: ",livro[1])

fimalgoritmo

