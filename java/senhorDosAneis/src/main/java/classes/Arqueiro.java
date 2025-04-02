package classes;

import game.Mapa;
import personagens.Personagem;

public class Arqueiro extends Personagem {

    private int p1;
    private int p2;
    private int p3;
    private int enemy;

    public Arqueiro(String nome, String apelido, int forca, int agilidade, int inteligencia, int constituicao, String fala) {
        super(nome, apelido, forca, agilidade, inteligencia, constituicao, fala);
    }

    @Override
    public void atacar(Mapa mapa) {
        if((!mapa.mapaVazio()) && (mapa.posicoesOcupadas() > 1)) {
            boolean mySoc = this.hasSociedade();
            boolean lutar = false;
            int distancia = 1;

            calcularPosicoes(mySoc, mapa.buscarPosicao(this));

            if (!mapa.posicaoLivre(this.p3)) { this.enemy = this.p3; distancia = 3;  lutar = true; }
            else if (!mapa.posicaoLivre(this.p2)) { this.enemy = this.p2; distancia = 2; lutar = true; }
            else if (!mapa.posicaoLivre(this.p1)) { this.enemy = this.p1; lutar = true; }

            if(lutar){
                Personagem inimigo = mapa.buscarCasa(this.enemy);
                boolean iniSoc = inimigo.hasSociedade();
                if (mySoc != iniSoc) {
                    int constituicao = inimigo.getConstituicao();
                    if (constituicao > 0) inimigo.setConstituicao(constituicao - (distancia * this.getAgilidade()));
                    if (inimigo.getConstituicao() <= 0) mapa.removerPersonagem(this.enemy);
                }
            }
        }
    }

    @Override
    public void move(Mapa mapa){
        int posicao = mapa.buscarPosicao(this);
        calcularPosicoes(this.hasSociedade(), posicao);

        if (mapa.posicaoLivre(this.p1)) {
            changePosicao(this.p1, mapa, posicao, this.hasSociedade());
            int newPosicao = mapa.buscarPosicao(this);
            if (mapa.posicaoLivre(this.p2)) {
                changePosicao(this.p2, mapa, newPosicao, this.hasSociedade());
            }
        }

    }


    public void calcularPosicoes(boolean mySoc, int myPosicao){
        if(mySoc){
            this.p1 = myPosicao + 1; this.p2 = myPosicao + 2; this.p3 = myPosicao + 3;
            if(this.p1 == 8) this.p3 = 0;
            if(this.p1 >= 9) { this.p1 = 9; this.p2 = 0; this.p3 = 1; }
            if(myPosicao == 9) { this.p1 = 0; this.p2 = 1; this.p3 = 2; }
        }else{
            this.p1 = myPosicao - 1; this.p2 = myPosicao - 2; this.p3 = myPosicao - 3;
            if(this.p1 == 1) this.p3 = 9;
            if(this.p1 == 0) { this.p2 = 9; this.p3 = 8; }
            if(this.p1 < 0) { this.p1 = 9; this.p2 = 8; this.p3 = 7; }
        }
    }


    public void changePosicao(int proximaPosicao, Mapa mapa, int posicaoAtual, boolean mySoc) {
        if (mySoc) {
            if ((proximaPosicao < 10) && (mapa.posicaoLivre(proximaPosicao))) { mapa.removerPersonagem(posicaoAtual); mapa.inserir((proximaPosicao), this); }
            if ((posicaoAtual == 9) && (mapa.posicaoLivre(0))) { mapa.removerPersonagem(posicaoAtual); mapa.inserir(0, this); }
        }else{
            if ((proximaPosicao >= 0) && (mapa.posicaoLivre(proximaPosicao))){ mapa.removerPersonagem(posicaoAtual); mapa.inserir(proximaPosicao, this); }
            if ((posicaoAtual == 0) && (mapa.posicaoLivre(9))){ mapa.removerPersonagem(posicaoAtual); mapa.inserir(9, this); }
        }
    }


}
