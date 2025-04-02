package personagens;


import game.Mapa;

public abstract class Personagem {

    protected final String nome;
    protected final String apelido;
    protected final int forca;
    protected final int agilidade;
    protected final int inteligencia;
    protected int constituicao;
    protected String fala;


    protected Personagem(String nome, String apelido, int forca, int agilidade, int inteligencia, int constituicao, String fala) {
        this.nome = nome;
        this.apelido = apelido;
        this.forca = forca;
        this.agilidade = agilidade;
        this.inteligencia = inteligencia;
        this.constituicao = constituicao;
        this.fala = fala;
    }

    public String falar(){
        return this.fala;
    }

    public int getConstituicao() {
        return this.constituicao;
    }


    @Override
    public String toString() {
        return this.apelido;
    }

    public int getInteligencia() {
        return this.inteligencia;
    }

    public void setConstituicao(int constituicao) {
        if(constituicao > this.constituicao) constituicao = this.constituicao;
        if(constituicao < 0 ) this.constituicao = 0; else this.constituicao = constituicao;
    }

    public void setConstituicaoTeste(int constituicao) {
        if(constituicao < 0 ) this.constituicao = 0; else this.constituicao = constituicao;
    }

    public boolean hasSociedade(){
        return false;
    }

    public int getForca() {
        return this.forca;
    }

    public int getAgilidade() {
        return this.agilidade;
    }

    public String getNome() {
        return this.nome;
    }

    public abstract void atacar(Mapa mapa);
    public abstract void move(Mapa mapa);

}
