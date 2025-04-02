algoritmo "AULA 25"
// CADASTRO USUÁRIOS MATRIZ


var
  usuario: vetor[1..2,1..3] de caractere  // vetor[LINHA,COLUNA]
  linha, coluna: inteiro
  
inicio

      para linha <- 1 ate 2 faca
          para coluna <- 1 ate 3 faca

               se (coluna = 1) entao
                  escreval ("Email: ")
                  leia (usuario[linha,coluna])
               fimse

               se (coluna = 2) entao
                  escreval ("Senha: ")
                  leia (usuario[linha,coluna])
               fimse

               se (coluna = 3) entao
                  escreval ("CPF: ")
                  leia (usuario[linha,coluna])
               fimse

          fimpara // COLUNA
        fimpara // LINHA

        limpatela()
        para linha <- 1 ate 2 faca
             para coluna <- 1 ate 3 faca
                  escreval (usuario[linha,coluna])
             fimpara
        fimpara

fimalgoritmo

