package classes;

import sociedades.Sociedades;

public class Gondoriano extends Guerreiro{

    protected int danos;
    protected final Sociedades sociedade;

    public Gondoriano(String nome, String apelido, int forca, int agilidade, int inteligencia, int constituicao, String fala) {
        super(nome, apelido, forca, agilidade, inteligencia, constituicao, fala);
        this.sociedade = Sociedades.ANEL;
        this.danos = 0;
    }


    @Override
    public boolean hasSociedade() { return true; }

    public int getDanos() { return danos; }
}
