algoritmo "AULA 8"
// IF / OPERADORES L�GICOS - TIRO DE GUERRA

var
   genero: caractere
   idade: inteiro
   
inicio

    escreval ("Idade: ")
    leia (idade)
    
    escreval ("G�nero: ")
    leia (genero)
    
    
    se ((genero = "m") e (idade >= 18) ) entao
       escreval ("Vc deve se alistar para o tiro de guerra")
    senao
       se ((genero = "m") e (idade < 18) ) entao
          escreval ("Vc precisa completar 18 anos")
       senao
            se (genero = "f") entao
               escreval ("O alistamento � s� para homens")
            fimse
       fimse
    fimse
    
fimalgoritmo
