package personagens;

import classes.Arqueiro;
import racas.Monstro;

public class Goblim extends Arqueiro implements Monstro {

    public Goblim() {
        super("Goblim", "M", 3, 6, 1, 20, "Iiisshhhh");
    }


    @Override
    public String grunir() {
        return this.fala;
    }
}
