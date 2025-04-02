package jogador;

import clube.Clube;
import financeiro.ApetiteFinanceiro;
import java.math.BigDecimal;


public class Goleiro extends Jogador {

    private int penaltisDefendidos;


    public Goleiro(String nome, int idade, Clube clubeAtual, int reputacaoHistorica, ApetiteFinanceiro apetiteFinanceiro, BigDecimal preco, int penaltisDefendidos) {
        super(nome, idade, clubeAtual, reputacaoHistorica, apetiteFinanceiro, preco);
        this.penaltisDefendidos = penaltisDefendidos;
    }


    @Override
    public BigDecimal valorCompra(){

        BigDecimal valorJogador = this.preco;
        int apetite = this.apetiteFinanceiro.getValorOferta();

        valorJogador = valorAcrescidoApetiteFinanceiro(apetite, valorJogador);
        valorJogador = adicionarAcrescimo((this.penaltisDefendidos * 4), valorJogador);

        return valorJogador;

    }

}
