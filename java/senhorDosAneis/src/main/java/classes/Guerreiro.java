package classes;

import game.Mapa;
import personagens.Personagem;

public class Guerreiro extends Personagem {
    public Guerreiro(String nome, String apelido, int forca, int agilidade, int inteligencia, int constituicao, String fala) {
        super(nome, apelido, forca, agilidade, inteligencia, constituicao, fala);
    }

    @Override
    public void atacar(Mapa mapa) {
        if((!mapa.mapaVazio()) && (mapa.posicoesOcupadas() > 1)) {
            boolean mySoc = this.hasSociedade();
            int myPosicao = mapa.buscarPosicao(this);
            int enemy;

            if(mySoc) enemy = myPosicao + 1; else enemy = myPosicao - 1;
            if(enemy == 10) enemy = 0;
            if(enemy < 0) enemy = 9;

            if (!mapa.posicaoLivre(enemy)) {
                Personagem inimigo = mapa.buscarCasa(enemy);
                boolean iniSoc = inimigo.hasSociedade();

                if (mySoc != iniSoc) {
                    int constituicao = inimigo.getConstituicao();
                    if (constituicao > 0) inimigo.setConstituicao(constituicao - (2 * this.getForca()));
                    if (inimigo.getConstituicao() <= 0) mapa.removerPersonagem(enemy);
                }
            }
        }
    }


    @Override
    public void move(Mapa mapa){
        int posicao = mapa.buscarPosicao(this);
        if (this.hasSociedade()) {
            if (((posicao + 1) < 10) && (mapa.posicaoLivre(posicao + 1))){ mapa.removerPersonagem(posicao); mapa.inserir((posicao + 1), this); }
            if (((posicao + 1) == 10) && (mapa.posicaoLivre(0))){ mapa.removerPersonagem(posicao); mapa.inserir(0, this); }
        }else{
            if ((posicao > 0) && (mapa.posicaoLivre(posicao - 1))){ mapa.removerPersonagem(posicao); mapa.inserir((posicao - 1), this); }
            if ((posicao == 0) && (mapa.posicaoLivre(9))){ mapa.removerPersonagem(posicao); mapa.inserir(9, this); }
        }
    }


}
