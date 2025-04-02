package game;

import excecoes.*;
import personagens.Personagem;

import java.util.HashMap;
import java.util.Map;

public class Mapa {

    private Map<Integer, Object> mapa;


    public Mapa() {
        mapa = new HashMap<>();
        for (int i = 0; i < 10; i++) { mapa.put(i, ""); }
    }



    public String exibir() {
        StringBuilder resumo = new StringBuilder(); // Sugestão Intellij
        for (int i = 0; i < mapa.size(); i++) {
            Object p = mapa.get(i);
            if (p instanceof Personagem) {
                Personagem personagem = (Personagem) p;
                if (personagem.getConstituicao() != 0) resumo.append(personagem.toString()); else continue;
            } else { resumo.append(p.toString()); }

            if (i <= mapa.size()) resumo.append(" | ");
        }
        return resumo.toString();
    }



    public boolean posicaoLivre(int posicao){
        Object personagem = mapa.get(posicao);
        return (personagem.equals(""));
    }


    public int buscarPosicao(Personagem personagem) {
        for (Map.Entry<Integer, Object> posicao : mapa.entrySet()) {
            Object dadosPersonagem = posicao.getValue();
            if (dadosPersonagem instanceof Personagem) {
                Personagem p = (Personagem) dadosPersonagem;
                if (p.equals(personagem)) return posicao.getKey();
            }
        }
        throw new PersonagemNaoEncontradoNoMapaException();
    }


    public void inserir(int posicao, Personagem personagem){
        if (mapa.containsKey(posicao)) {
            try{
                buscarPosicao(personagem);
                throw new PersonagemJaEstaNoMapaException();
            } catch (PersonagemNaoEncontradoNoMapaException e) {
                boolean posicaoLivre = posicaoLivre(posicao);
                if(posicaoLivre) mapa.put(posicao, personagem); else throw new PosicaoOcupadaException();
            }
        } else {
            throw new PosicaoNaoExiste();
        }
    }


    public Personagem buscarCasa(int posicao){
        Object localizacao = mapa.get(posicao);
        if (localizacao.equals("")) throw new PersonagemNaoEstaNessaPosicao();
        return (Personagem) localizacao;
    }


    public boolean mapaVazio() {
        for (int i = 0; i < mapa.size(); i++) {
            try {
                Object obj = this.buscarCasa(i);
                if (obj instanceof Personagem) return false;
            } catch (PersonagemNaoEstaNessaPosicao ignored) {}
        }
        return true;
    }


    public void removerPersonagem(int posicao){
        Object p = mapa.get(posicao);
        if (p instanceof Personagem) mapa.put(posicao, "");
    }


    public int posicoesOcupadas() {
        int cont = 0;
        for (Object o : mapa.values()) {
            if (o instanceof Personagem) cont++;
        }
        return cont;
    }





}
