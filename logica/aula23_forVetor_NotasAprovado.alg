algoritmo "AULA 23"
// CADASTRO DE NOTAS

var
 questoes: vetor[1..3] de caractere
 nomeA: vetor[0..4] de caractere
 posicao, acertos, erros: inteiro

inicio

      // GUARDANDO O GABARITO DAS QUESTÕES
      para posicao <- 1 ate 3 faca

               escreval ("Insira a resposta da ", posicao," questão")
               leia (questoes[posicao])

      fimpara
      limpatela ()

      // DIGITANDO O GABARITO DO ALUNO A
      escreval ("Digite o nome do aluno: ")
      leia (nomeA[0])
      
      para posicao <- 1 ate 3 faca

               escreval ("Insira a resposta da ", posicao," questão")
               leia (nomeA[posicao])

               se (nomeA[posicao] = questoes[posicao]) entao
                  acertos <- acertos + 1
               senao
                  erros <- erros + 1
               fimse

               se (acertos > erros) entao
                  nomeA[4] <- "APROVADO"
               senao
                  nomeA[4] <- "REPROVADO"
               fimse

      fimpara
      limpatela ()

      // EXIBINDO RESULTADOS
      para posicao <- 0 ate 4 faca
           escreval (nomeA[posicao])
      fimpara


fimalgoritmo

