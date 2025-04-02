algoritmo "AULA 6"
// IF / OPERADOR LÓGICO

var
   nota: real

inicio

   escreval ("Nota Prova: ")
   leia (nota)


   se ((nota >= 9) e (nota <= 10)) entao
      escreval ("Classificação: EXCELENTE")
   fimse

   se (nota >= 8) e (nota < 9) entao
      escreval ("Classificação: MUITO BOM")
   fimse
   
   se (nota >= 7) e (nota < 8) entao
      escreval ("Classificação: BOM")
   fimse

   se (nota >= 6) e (nota < 7) entao
      escreval ("Classificação: SUFICIENTE")
   fimse

   se (nota < 6) entao
      escreval ("Classificação: INSUFICIENTE")
   fimse


  se (nota >=6 ) entao
     escreval ("VC ESTÁ APROVADO")
  senao
     escreval ("VC ESTA REPROVADO")
  fimse


fimalgoritmo
