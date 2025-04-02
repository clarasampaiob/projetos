package jogador;

import clube.Clube;
import financeiro.ApetiteFinanceiro;
import java.math.BigDecimal;


public class Atacante extends Jogador{

    private int gols;

    public Atacante(String nome, int idade, Clube clubeAtual, int reputacaoHistorica, ApetiteFinanceiro apetiteFinanceiro, BigDecimal preco, int gols) {
        super(nome, idade, clubeAtual, reputacaoHistorica, apetiteFinanceiro, preco);
        this.gols = gols;
    }

    @Override
    public BigDecimal valorCompra(){

        BigDecimal valorJogador = this.preco;
        int apetite = this.apetiteFinanceiro.getValorOferta();

        valorJogador = valorAcrescidoApetiteFinanceiro(apetite, valorJogador);
        valorJogador = adicionarAcrescimo(this.gols, valorJogador);
        if(idade > 30) valorJogador = adicionarDesconto(25, valorJogador);

        return valorJogador;

    }


    @Override
    public boolean interessadoClube(Clube clube){
        return (clube.getReputacao() > this.reputacaoHistorica);
    }
}
