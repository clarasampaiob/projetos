package personagens;

import classes.Mago;
import racas.Maia;

public class Saruman extends Mago implements Maia {


    public Saruman() {
        super("Saruman", "S", 2, 2, 9, 70, "Against the power of Mordor there can be no victory.");
    }

    @Override
    public Object ressuscitar() {
        return null;
    }
}
