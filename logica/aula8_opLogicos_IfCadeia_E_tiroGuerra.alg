algoritmo "AULA 8"
// IF / OPERADORES LÓGICOS - TIRO DE GUERRA

var
   genero: caractere
   idade: inteiro
   
inicio

    escreval ("Idade: ")
    leia (idade)
    
    escreval ("Gênero: ")
    leia (genero)
    
    
    se ((genero = "m") e (idade >= 18) ) entao
       escreval ("Vc deve se alistar para o tiro de guerra")
    senao
       se ((genero = "m") e (idade < 18) ) entao
          escreval ("Vc precisa completar 18 anos")
       senao
            se (genero = "f") entao
               escreval ("O alistamento é só para homens")
            fimse
       fimse
    fimse
    
fimalgoritmo
