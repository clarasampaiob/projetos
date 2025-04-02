Algoritmo "AULA 12"
// SWITCH CASE - BONUS POR GRUPO BANCÁRIO
Var
   montante: real
   grupo_cliente: caractere
Inicio

   escreval ("BANCO ITAU")
   escreval ("Montante na sua Conta: ")
   leia (montante)
   escreval ("Grupo de Participação: [roxo/vermelho/outros]")
   leia (grupo_cliente)


     
     escolha grupo_cliente

             caso "roxo"
                  escreval ("Vc ganhou bonus de 100 reais. Montante: R$",montante+100," reais")
                  
             caso "vermelho"
                  escreval ("Vc ganhou bonus de 300 reais. Montante: R$",montante+300," reais")
                  
             outrocaso
                  escreval ("Vc ganhou bonus de 50 reais. Montante: R$",montante+50," reais")
                  
      fimescolha
      
Fimalgoritmo
