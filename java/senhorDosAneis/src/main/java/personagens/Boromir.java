package personagens;

import classes.Gondoriano;
import racas.Humano;

public class Boromir extends Gondoriano implements Humano {


    public Boromir() {
        super("Boromir", "B", 7, 6, 3, 40, "One does not simply walk into Mordor.");
    }


    @Override
    public void envelhecer() {
        this.danos += 2;
    }

}
