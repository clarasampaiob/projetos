package jogador;

import clube.Clube;
import financeiro.ApetiteFinanceiro;
import java.math.BigDecimal;


public class Lateral extends Jogador{

    private int cruzamentosSucedidos;

    public Lateral(String nome, int idade, Clube clubeAtual, int reputacaoHistorica, ApetiteFinanceiro apetiteFinanceiro, BigDecimal preco, int cruzamentosSucedidos) {
        super(nome, idade, clubeAtual, reputacaoHistorica, apetiteFinanceiro, preco);
        this.cruzamentosSucedidos = cruzamentosSucedidos;
    }


    @Override
    public BigDecimal valorCompra(){

        BigDecimal valorJogador = this.preco;
        int apetite = this.apetiteFinanceiro.getValorOferta();

        valorJogador = valorAcrescidoApetiteFinanceiro(apetite, valorJogador);
        valorJogador = adicionarAcrescimo((this.cruzamentosSucedidos * 2), valorJogador);
        if(idade > 28) valorJogador = adicionarDesconto(30, valorJogador);

        return valorJogador;

    }
}
