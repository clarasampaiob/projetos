package jogador;

import clube.Clube;
import financeiro.ApetiteFinanceiro;

import java.math.BigDecimal;
import java.math.RoundingMode;

public class Jogador {

    protected String nome;
    protected int idade;
    protected Clube clubeAtual;
    protected int reputacaoHistorica; // 1 - 10
    protected ApetiteFinanceiro apetiteFinanceiro;
    protected BigDecimal preco;


    public Jogador(String nome, int idade, Clube clubeAtual, int reputacaoHistorica, ApetiteFinanceiro apetiteFinanceiro, BigDecimal preco) {
        this.nome = nome;
        this.idade = idade;
        this.clubeAtual = (clubeAtual == null) ? new Clube("Sem Clube", 0, BigDecimal.valueOf(0)) : clubeAtual;
        this.apetiteFinanceiro = apetiteFinanceiro;
        this.preco = preco;
        this.reputacaoHistorica = ((reputacaoHistorica >= 0) && (reputacaoHistorica <= 10)) ? reputacaoHistorica : 0;
    }


    public BigDecimal valorAcrescidoApetiteFinanceiro(int apetite, BigDecimal valorJogador){
        if(apetite == 3) valorJogador = valorJogador.multiply(new BigDecimal("1.8"));
        if(apetite == 2) valorJogador = valorJogador.multiply(new BigDecimal("1.4"));
        return valorJogador;
    }


    public BigDecimal adicionarAcrescimo(double percentual, BigDecimal valorJogador){
        BigDecimal porcentagem = BigDecimal.valueOf(percentual);
        BigDecimal acrescimo = valorJogador.multiply(porcentagem).divide(BigDecimal.valueOf(100), 2, RoundingMode.HALF_UP);
        return valorJogador.add(acrescimo);
    }


    public BigDecimal adicionarDesconto(double porcentagem, BigDecimal valorJogador){
        BigDecimal percentual = BigDecimal.valueOf(porcentagem);
        BigDecimal desconto = valorJogador.multiply(percentual).divide(BigDecimal.valueOf(100), 2, RoundingMode.HALF_UP);
        return valorJogador.subtract(desconto).setScale(2, RoundingMode.HALF_UP);
    }


    public boolean interessadoClube(Clube clube){
        return (clube.getReputacao() >= 1);
    }


    public BigDecimal valorCompra(){
        return this.preco;
    }


    public void transferencia(Clube newClube){
        this.clubeAtual = newClube;
    }


    public String getClubeAtual(){
        return this.clubeAtual.getNome();
    }


    public int getReputacaoHistorica() {
        return reputacaoHistorica;
    }


}
