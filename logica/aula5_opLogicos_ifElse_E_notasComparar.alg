algoritmo "AULA 5"
// IF ELSE - OPERADORES LOGICOS - VERIFICAR SE NOTA1 � MAIOR QUE NOTA2

var
   n1,n2,result,media: real
   
inicio

      escreval ("N1: ")
      leia (n1)
      
      escreval ("N2: ")
      leia (n2)
      
      se (n1 > n2) entao
         result <- n1 - n2
         escreval ("N1 � maior que N2. A subtra��o �: ",result)
      fimse
      
      se (n1 < n2) entao
         result <- n1 + n2
         escreval ("N1 � menor que N2. A soma �: ",result)
      fimse
      
      media <- (n1+n2)/2

      se ((media >= 7) e (media <=10)) entao
         escreval ("Sua media �:",media,". Aprovado")
      senao
         escreval ("Vc est� reprovado! M�dia:",media)
      fimse

      
fimalgoritmo
