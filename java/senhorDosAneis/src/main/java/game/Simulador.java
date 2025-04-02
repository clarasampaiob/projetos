package game;

import excecoes.SauronDominaOMundoException;
import personagens.Personagem;



public class Simulador extends Mapa{

    private Mapa mapa;
    String vencedor;
    int inSociedade;

    public Simulador(Mapa mapagame) {
        super();
        this.mapa = mapagame;
        this.inSociedade = 0;
        this.vencedor = "";
    }


    public void simular() {
        if(!mapa.mapaVazio()) {
            boolean stop = false;

            do{
                totalSociedadeMembers(mapa);
                if (this.inSociedade == 0) throw new SauronDominaOMundoException();
                stop = loop(mapa);
            } while (!stop);

            if(vencedor.isEmpty()) loop(mapa);
        }
    }




    public boolean loop(Mapa mapa) {
        Personagem ultimoFighter = null;

        for (int i = 0; i < 10; i++) {
            if (!mapa.posicaoLivre(i)) {
                Personagem fighter = mapa.buscarCasa(i);
                if(fighter != ultimoFighter){
                    fighter.atacar(mapa);
                    fighter.move(mapa);
                    if ((fighter.hasSociedade()) && (mapa.buscarPosicao(fighter) == 9)) {
                        this.vencedor = fighter.getNome();
                        break;
                    }

                    ultimoFighter = fighter;
                }

            }
        }

        return !vencedor.isEmpty();
    }




    private void totalSociedadeMembers(Mapa mapa) {
        int total = 0;
        for (int i = 0; i < 10; i++) {
            if (!mapa.posicaoLivre(i)) {
                Personagem fighter = mapa.buscarCasa(i);
                if (fighter.hasSociedade()) total++;
            }
        }
        this.inSociedade = total;
    }

}
