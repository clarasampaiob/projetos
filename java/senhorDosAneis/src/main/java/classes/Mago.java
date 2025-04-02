package classes;

import game.Mapa;
import personagens.Personagem;


public class Mago extends Personagem {
    public Mago(String nome, String apelido, int forca, int agilidade, int inteligencia, int constituicao, String fala) {
        super(nome, apelido, forca, agilidade, inteligencia, constituicao, fala);
    }

    @Override
    public void atacar(Mapa mapa) {
        if((!mapa.mapaVazio()) && (mapa.posicoesOcupadas() > 1)) {
            boolean mySoc = this.hasSociedade();
            for (int i = 0; i < 10; i++) {
                if (!mapa.posicaoLivre(i)) {
                    Personagem inimigo = mapa.buscarCasa(i);
                    boolean iniSoc = inimigo.hasSociedade();

                    if (mySoc != iniSoc) {
                        int constituicao = inimigo.getConstituicao();
                        if (constituicao > 0) inimigo.setConstituicao((constituicao - this.getInteligencia()));
                        if (inimigo.getConstituicao() <= 0) mapa.removerPersonagem(i);
                    }

                }
            }
        }
    }

    @Override
    public void move(Mapa mapa){
        if((!mapa.mapaVazio()) && (mapa.posicoesOcupadas() == 1)) {
            int posicao = mapa.buscarPosicao(this);
            mapa.removerPersonagem(posicao);
            if (this.hasSociedade()) {
                if (posicao < 9) mapa.inserir((posicao + 1), this); else mapa.inserir(0, this);
            }else{
                if (posicao > 0) mapa.inserir((posicao - 1), this); else mapa.inserir(9, this);
            }
        }
    }


}
