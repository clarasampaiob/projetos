package personagens;

import classes.Guerreiro;
import racas.Humano;
import racas.Monstro;

public class Urukhai extends Guerreiro implements Humano, Monstro {

    private int danos;
    private String grunido;

    public Urukhai() {
        super("Urukhai", "U", 8, 6, 3, 45, "Looks like meat's back on the menu boys!");
        this.grunido = "Uuurrrrrr";
        this.danos = 0;
    }


    @Override
    public void envelhecer() {
        this.danos += 2;
    }

    @Override
    public String grunir() {
        return this.grunido;
    }

    public int getDanos() {
        return this.danos;
    }
}
