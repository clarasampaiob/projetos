algoritmo "AULA 3"
// OPERA��ES B�SICAS - AMIGO VALE PREMIO
   
var
   mensalidade: real
   valor_semestre: real
   amigos_indicados: inteiro
   bonus_amigo: real
   desconto: real
   valor_total: real
   parcelas: inteiro
   valor_parcelas: real
   
inicio

    bonus_amigo <- 170
    escreval ("Valor da Mensalidade: R$")
    leia (mensalidade)
    
    valor_semestre <- mensalidade * 6
    escreval ("Valor do Semestre: R$",valor_semestre," reais")
    
    escreval ("Quantos Amigos vc indicou? ")
    leia (amigos_indicados)
    
    desconto <- amigos_indicados * bonus_amigo
    valor_total <- valor_semestre - desconto
    
    escreval ("Parab�ns, seu desconto � de R$",desconto," reais. O valor do semestre � de R$",valor_total," reais")
    escreval ("Digite o n�mero de parcelas para pagamento: ")
    leia (parcelas)
    
    valor_parcelas <- valor_total/parcelas
    escreval ("Suas parcelas ser�o no valor de R$",valor_parcelas," reais")
    
fimalgoritmo
