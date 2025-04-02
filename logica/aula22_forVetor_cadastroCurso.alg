algoritmo "AULA 22"
// CADASTRO DE CURSO

var
 curso: vetor[1..4] de caractere
 posicao: inteiro

inicio

      escreval ("Curso: ")
      leia (curso[1])
      
      escreval ("Mensalidade: ")
      leia (curso[2])
      
      escreval ("Duração: ")
      leia (curso[3])
      
      escreval ("Universidade: ")
      leia (curso[4])
      
      limpatela()
      
      para posicao <- 1 ate 4 faca
           escreval (curso[posicao])
      fimpara

fimalgoritmo

