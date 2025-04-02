package dicionario;

import java.util.HashMap;
import java.util.Map;

public class Dicionario {

    private Map<String, String> ingles;
    private Map<String, String> portugues;

    public Dicionario() {
        this.portugues = new HashMap<>();
        this.ingles = new HashMap<>();
    }

    public void adicionarPalavra(String palavra, String traducao, TipoDicionario dicionario){
        String palavraMin = palavra.toLowerCase();
        if (dicionario == TipoDicionario.PORTUGUES) {
            portugues.put(palavraMin, traducao);
        } else {
            ingles.put(palavraMin, traducao);
        }

    }

    public String traduzir(String palavra, TipoDicionario dicionarioDeBusca) {
        String traducao;
        String palavraMin = palavra.toLowerCase();

        if (dicionarioDeBusca == TipoDicionario.PORTUGUES) {
            traducao = this.portugues.get(palavraMin);
        } else {
            traducao = this.ingles.get(palavraMin);
        }

        if (traducao == null) {
            throw new PalavraNaoEncontradaException();
        } else {
            return traducao;
        }
    }


    public Map<String, String> getEn() {
        return this.ingles;
    }

    public Map<String, String> getPt() {
        return this.portugues;
    }

}
