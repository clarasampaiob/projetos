package game;

public class Jutsu {

    private final int consumo;
    private final int dano;


    public Jutsu(int consumo, int dano){
        if(consumo > 5) this.consumo = 5; else this.consumo = consumo;
        if(dano > 10) this.dano = 10; else this.dano = dano;
    }

    public int getConsumo(){ return this.consumo; }

    public int getDano(){ return this.dano; }

}
