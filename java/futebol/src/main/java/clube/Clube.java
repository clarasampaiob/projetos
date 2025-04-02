package clube;

import java.math.BigDecimal;

public class Clube {

    private String nome;
    private int reputacaoHistorica;
    private BigDecimal saldoDisponivel;


    public Clube(String nome, int reputacaoHistorica, BigDecimal saldo){
        this.saldoDisponivel = saldo;
        this.nome = ((nome == null ) || (nome.isEmpty())) ? "Sem Clube" : nome;
        this.reputacaoHistorica = ((reputacaoHistorica >= 0) && (reputacaoHistorica <= 10)) ? reputacaoHistorica : 0;
    }

    public String getNome(){
        return this.nome;
    }

    public int getReputacao(){
        return this.reputacaoHistorica;
    }

    public BigDecimal getSaldo(){
        return this.saldoDisponivel;
    }

    public void setSaldo(BigDecimal saldo){
        this.saldoDisponivel = saldo;
    }


}
