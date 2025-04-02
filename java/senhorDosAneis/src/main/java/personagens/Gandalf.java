package personagens;

import classes.Mago;
import racas.Maia;
import sociedades.Sociedades;

public class Gandalf extends Mago implements Maia {

    private final Sociedades sociedade;

    public Gandalf() {
        super("Gandalf", "G", 2, 3, 10, 80, "A Wizard is never late, nor is he early. He arrives precisely when he means to.");
        this.sociedade = Sociedades.ANEL;
    }


    @Override
    public Object ressuscitar() {
        if(this.constituicao == 0) return new Gandalf();
        return null;
    }

    @Override
    public boolean hasSociedade() {
        return true;
    }


    public Sociedades getSociedade() {
        return this.sociedade;
    }
}
