Algoritmo "AULA 9"
// E - OU / IDADE VOTAR

Var
   ano_atual: inteiro
   ano_nasc: inteiro
   idade: inteiro

Inicio

   escreval ("Digite o ano atual: ")
   leia (ano_atual)
   escreval ()

   escreval ("Digite o ano que voce nasceu: ")
   leia (ano_nasc)
   escreval ()

   idade <- ano_atual - ano_nasc


   se (idade < 16) entao
    escreval ("Voce tem ",idade, " anos e não pode votar")
   senao
      se ((idade >= 16) e (idade < 18)) ou (idade >= 65) entao
         escreval ("voce tem ",idade, " anos e seu voto é facultativo")
      senao
           se (idade >= 18) e (idade < 65) entao
              escreval ("voce tem ", idade, " anos e é obrigado a votar")
           fimse
      fimse
   fimse

Fimalgoritmo
