package planetas;

import recursos.Recurso;

import java.util.List;

public class Planeta {

    private final int posicao;
    private final List<Recurso> recursos;

    public Planeta(int posicao, List<Recurso> recursos) {
        this.posicao = posicao;
        this.recursos = recursos;
    }

    public int getSomaValores(){
        int soma = 0;
        for (Recurso rec : this.recursos) { soma += rec.getValor(); }
        return soma;
    }

    public double getSomaValorPorPeso(){
        double soma = 0;
        for (Recurso rec : this.recursos) { soma += rec.dividirValorPorPeso(); }
        return soma;
    }

    public int getPosicao(){
        return this.posicao;
    }

    public List<Recurso> getRecursos() {
        return this.recursos;
    }


}
