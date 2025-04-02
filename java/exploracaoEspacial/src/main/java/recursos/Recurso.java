package recursos;

public class Recurso {

    private final int valor;
    private final int peso;

    public Recurso(int valor, int peso) {
        this.valor = valor;
        this.peso = peso;
    }

    public int getValor() {
        return this.valor;
    }

    public double dividirValorPorPeso(){
        return (double) this.valor/this.peso;
    }

}
