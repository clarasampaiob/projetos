algoritmo "AULA 4"
// IF SIMPLES - SEXO FEM OU MASC

var
   genero: caractere
   
inicio

      escreval ("Genero: [f/m]")
      leia (genero)
      
      se (genero = "f") entao
         escreval ("Vc deve ir para o grupo de mulheres")
      fimse
      
      se (genero = "m") entao
         escreval ("Vc deve ir para o grupo de homens")
      fimse
      
fimalgoritmo
