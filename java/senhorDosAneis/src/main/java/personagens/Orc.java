package personagens;

import classes.Guerreiro;
import racas.Monstro;

public class Orc extends Guerreiro implements Monstro {


    public Orc() {
        super("Orc", "O", 7, 4, 1, 30, "Arrrggghhh");
    }


    @Override
    public String grunir() {
        return this.fala;
    }
}
