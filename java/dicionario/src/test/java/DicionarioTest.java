import dicionario.Dicionario;
import dicionario.PalavraNaoEncontradaException;
import dicionario.TipoDicionario;
import org.junit.Assert;
import org.junit.Test;

import static org.junit.Assert.assertEquals;

public class DicionarioTest {

    @Test
    public void deveTraduzirCarroELivroDoInglesParaPortuguesEDoPortuguesParaOIngles() {
        Dicionario dicionario = new Dicionario();
        dicionario.adicionarPalavra("Carro", "Car", TipoDicionario.INGLES);
        dicionario.adicionarPalavra("Livro", "Book", TipoDicionario.INGLES);
        dicionario.adicionarPalavra("Tiger", "Tigre", TipoDicionario.PORTUGUES);
        dicionario.adicionarPalavra("Paper", "Papel", TipoDicionario.PORTUGUES);

        assertEquals("Car", dicionario.traduzir("carro", TipoDicionario.INGLES));
        assertEquals("Book", dicionario.traduzir("lIVRO", TipoDicionario.INGLES));

        assertEquals("Papel", dicionario.traduzir("pApEr", TipoDicionario.PORTUGUES));
        assertEquals("Tigre", dicionario.traduzir("TIGER", TipoDicionario.PORTUGUES));
    }



    @Test(expected = PalavraNaoEncontradaException.class)
    public void deveLancarExceptionQuandoUmaPalavraNaoForEncontrada() {
        Dicionario dicionario = new Dicionario();
        dicionario.adicionarPalavra("Programador", "Coder", TipoDicionario.INGLES);
        dicionario.adicionarPalavra("Pessoa", "Person", TipoDicionario.INGLES);

        String traducao = dicionario.traduzir("Caneta", TipoDicionario.INGLES);
    }


    @Test
    public void cadastrarPalavras(){

        Dicionario dicionario = new Dicionario();
        dicionario.adicionarPalavra("Carro", "Car", TipoDicionario.INGLES);
        dicionario.adicionarPalavra("Livro", "Book", TipoDicionario.INGLES);
        dicionario.adicionarPalavra("Tiger", "Tigre", TipoDicionario.PORTUGUES);
        dicionario.adicionarPalavra("Paper", "Papel", TipoDicionario.PORTUGUES);

        System.out.println("Dicionário Inglês: ");
        for (String chave : dicionario.getEn().keySet()) {
            System.out.println("Palavra: " + chave + ", Tradução: " + dicionario.getEn().get(chave));
        }

        System.out.println("Dicionário Português: ");
        for (String chave : dicionario.getPt().keySet()) {
            System.out.println("Palavra: " + chave + ", Tradução: " + dicionario.getPt().get(chave));
        }

        String traducao = dicionario.traduzir("Tiger", TipoDicionario.PORTUGUES);
        Assert.assertEquals("Tigre", traducao);

    }

}
