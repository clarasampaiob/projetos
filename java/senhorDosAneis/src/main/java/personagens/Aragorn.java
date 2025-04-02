package personagens;

import classes.Gondoriano;
import racas.Humano;

public class Aragorn extends Gondoriano implements Humano {


    public Aragorn() {
        super("Aragorn", "A", 10, 7, 6, 60, "A day may come when the courage of men fails… but it is not THIS day.");
    }


    @Override
    public void envelhecer() {
        this.danos += 1;
    }

}
