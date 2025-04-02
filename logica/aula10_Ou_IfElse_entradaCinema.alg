Algoritmo "AULA 10"
// E - OU / ENTRADA CINEMA

Var
   carteira: caractere
   dinheiro: real

Inicio

   escreval ("Valor: ")
   leia (dinheiro)

   escreval ("Carteira Estudante: [s/n]")
   leia (carteira)

   se (((carteira = "s") e (dinheiro >= 10)) ou (dinheiro >=20)) entao
      escreval ("Vc pode assistir o filme")
   senao
      escreval ("Vc não pode assistir o filme")
   fimse

Fimalgoritmo
