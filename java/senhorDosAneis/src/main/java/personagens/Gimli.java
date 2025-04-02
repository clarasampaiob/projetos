package personagens;

import classes.Guerreiro;
import racas.Anao;
import sociedades.Sociedades;

public class Gimli extends Guerreiro implements Anao {

    private final Sociedades sociedade;
    private String falaBeudo;

    public Gimli() {
        super("Gimli", "I", 9, 2, 4, 60,  "Let them come. There is one Dwarf yet in Moria who still draws breath.");
        this.falaBeudo =  "What did I say? He can't hold his liquor!";
        this.sociedade = Sociedades.ANEL;
    }


    @Override
    public void beber() { this.falaBeudo = "To bebendo"; }

    public void beber(int vezes){
        if(vezes == 3) this.fala = this.falaBeudo;
    }

    @Override
    public boolean hasSociedade() {
        return true;
    }

    public Sociedades getSociedade() {
        return this.sociedade;
    }
}
