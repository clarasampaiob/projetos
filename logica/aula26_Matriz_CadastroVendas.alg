algoritmo "AULA 26"
// CADASTRO DE VENDAS MATRIZ


var
  venda: vetor[1..2,1..4] de caractere
  linha, coluna: inteiro
  
inicio

      para linha <- 1 ate 2 faca
          para coluna <- 1 ate 4 faca

               se (coluna = 1) entao
                  escreval ("Cliente: ")
                  leia (venda[linha,coluna])
               fimse

               se (coluna = 2) entao
                  escreval ("Produto: ")
                  leia (venda[linha,coluna])
               fimse

               se (coluna = 3) entao
                  escreval ("Qtdd: ")
                  leia (venda[linha,coluna])
               fimse

               se (coluna = 4) entao
                  escreval ("Valor: R$ ")
                  leia (venda[linha,coluna])
               fimse

          fimpara // coluna
        fimpara // linha

        limpatela()
        
        para linha <- 1 ate 2 faca
             para coluna <- 1 ate 4 faca
                  escreval (venda[linha,coluna])
             fimpara
        fimpara

fimalgoritmo

