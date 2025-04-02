package personagens;

import classes.Arqueiro;
import racas.Elfo;
import sociedades.Sociedades;

public class Legolas extends Arqueiro implements Elfo {

    private final Sociedades sociedade;
    private String falaElfica;

    public Legolas() {
        super("Legolas", "L", 5, 10, 6, 80, "They're taking the Hobbits to Isengard!");
        this.falaElfica = "I amar prestar aen, han mathon ne nem, han mathon ne chae, a han noston ned.";
        this.sociedade = Sociedades.ANEL;
    }


    @Override
    public String falarElfico() {
        return this.falaElfica;
    }


    @Override
    public boolean hasSociedade() {
        return true;
    }

    public Sociedades getSociedade() {
        return this.sociedade;
    }
}
