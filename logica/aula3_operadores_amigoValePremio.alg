algoritmo "AULA 3"
// OPERAÇÕES BÁSICAS - AMIGO VALE PREMIO
   
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
    
    escreval ("Parabéns, seu desconto é de R$",desconto," reais. O valor do semestre é de R$",valor_total," reais")
    escreval ("Digite o número de parcelas para pagamento: ")
    leia (parcelas)
    
    valor_parcelas <- valor_total/parcelas
    escreval ("Suas parcelas serão no valor de R$",valor_parcelas," reais")
    
fimalgoritmo
