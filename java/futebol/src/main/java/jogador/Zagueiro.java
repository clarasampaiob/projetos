package jogador;

import clube.Clube;
import financeiro.ApetiteFinanceiro;

import java.math.BigDecimal;
import java.math.RoundingMode;

public class Zagueiro extends Jogador{

    public Zagueiro(String nome, int idade, Clube clubeAtual, int reputacaoHistorica, ApetiteFinanceiro apetiteFinanceiro, BigDecimal preco) {
        super(nome, idade, clubeAtual, reputacaoHistorica, apetiteFinanceiro, preco);
    }

    @Override
    public BigDecimal valorCompra(){

        BigDecimal valorJogador = this.preco;
        int apetite = this.apetiteFinanceiro.getValorOferta();

        valorJogador = valorAcrescidoApetiteFinanceiro(apetite, valorJogador);
        if(idade > 30) valorJogador = adicionarDesconto(20, valorJogador);

        return valorJogador.setScale(2, RoundingMode.HALF_UP);

    }
}
