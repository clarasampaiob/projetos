algoritmo "AULA 24"
// CADASTRO USUÁRIO E SENHA

var
  usuario: vetor[1..2] de caractere
  posicao: inteiro
  
inicio

      para posicao <- 1 ate 2 faca
      
           se (posicao = 1) entao
              escreval ("Email: ")
              leia (usuario[posicao])
           fimse

           se (posicao = 2) entao
              escreval ("Senha: ")
              leia (usuario[posicao])
           fimse
      fimpara

      limpatela()

      para posicao <- 1 ate 2 faca
           escreval (usuario[posicao])
      fimpara

fimalgoritmo

