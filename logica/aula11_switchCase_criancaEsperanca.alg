Algoritmo "AULA 11"
// SWITCH CASE / CRIANÇA ESPERANÇA

Var
   opcao: inteiro
   valor: real

Inicio

     escreval ("doação criança esperança")
     escreval ("digite [1]: doar 10 reais")
     escreval ("digite [2]: doar 20 reais")
     escreval ("digite [3]: doar 30 reais")
     escreval ("digite [4]: doar outros valores")
     
     leia (opcao)
     
     escolha opcao

             caso 1
                  escreval ("voce doou 10 reais")
                  
             caso 2
                  escreval ("voce doou 20 reais")
                  
             caso 3
                  escreval ("voce doou 30 reais")
                  
             caso 4
                  escreval ("digite o valor: ")
                  leia (valor)
                  escreval ("voce doou ",valor," reais")
                  
      fimescolha
      
Fimalgoritmo
