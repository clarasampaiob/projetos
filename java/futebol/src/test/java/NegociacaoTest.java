import clube.Clube;
import financeiro.Conservador;
import financeiro.Indiferente;
import financeiro.Mercenario;
import jogador.*;
import negociacao.Negociacao;
import org.junit.Assert;
import org.junit.Test;

import java.math.BigDecimal;
import java.math.RoundingMode;

public class NegociacaoTest {


    @Test
    public void naoDeveSerPossivelNegociarPorFaltaDeCaixaDisponivel(){

        Negociacao negociacao = new Negociacao();
        Clube clube = new Clube("Palmeiras", 4, BigDecimal.valueOf(15000));
        Goleiro goleiro = new Goleiro("Caio", 22, null, 6, new Mercenario(), BigDecimal.valueOf(10000), 20);

        System.out.println("Negociado: " + negociacao.negociar(clube, goleiro) + " Valor Jogador: " + goleiro.valorCompra());
        Assert.assertFalse(negociacao.negociar(clube, goleiro));
    }



    @Test
    public void deveCalcularCorretamenteOPrecoDoMeioCampoComMenosDeTrintaAnos() {

        Negociacao negociacao = new Negociacao();
        Clube clube = new Clube("Bragantino", 4, BigDecimal.valueOf(25000));
        MeioCampo jogador = new MeioCampo("César", 24, null, 7, new Indiferente(), BigDecimal.valueOf(1000));
        BigDecimal valorCompra = jogador.valorCompra();

        System.out.println("Negociado: " + negociacao.negociar(clube, jogador) + " Valor Jogador: " + jogador.valorCompra() + " Saldo Final Clube: " + clube.getSaldo());
        Assert.assertTrue(negociacao.negociar(clube, jogador));
        Assert.assertEquals(BigDecimal.valueOf(1000).setScale(2, RoundingMode.HALF_UP), valorCompra);
    }



    @Test
    public void deveCalcularCorretamenteOPrecoDoMeioCampoComMaisDeTrintaAnos() {

        Negociacao negociacao = new Negociacao();
        Clube clube = new Clube("Real Madrid", 7, BigDecimal.valueOf(25000));
        MeioCampo jogador = new MeioCampo("Júlio", 34, null, 10, new Mercenario(), BigDecimal.valueOf(10000));
        BigDecimal valorCompra = jogador.valorCompra();

        System.out.println("Negociado: " + negociacao.negociar(clube, jogador) + " Valor Jogador: " + jogador.valorCompra() + " Saldo Final Clube: " + clube.getSaldo());
        Assert.assertEquals(BigDecimal.valueOf(12600).setScale(2, RoundingMode.HALF_UP), valorCompra);
    }



    @Test
    public void deveSerPossivelNegociarUmGoleiroComUmClubeQueTemSaldoEmCaixa() {

        Negociacao negociacao = new Negociacao();
        Clube clube = new Clube("Grêmio", 10, BigDecimal.valueOf(100000000));
        Goleiro goleiro = new Goleiro("Marcelo Grohe", 33, null, 8, new Indiferente(), BigDecimal.valueOf(800500), 12);

        boolean foiPossivelNegociar = negociacao.negociar(clube, goleiro);

        Assert.assertTrue(foiPossivelNegociar);
    }



    @Test
    public void naoDeveSerPossivelNegociarUmAtacanteComUmClubeQueTemReputacaoHistoricaMenorQueASua() {

        Negociacao negociacao = new Negociacao();
        Clube clube = new Clube("Internacional", 3, BigDecimal.valueOf(100000000));
        Atacante atacante = new Atacante("Cristiano Ronaldo", 35, null, 10, new Conservador(), BigDecimal.valueOf(800500), 20);

        boolean foiPossivelNegociar = negociacao.negociar(clube, atacante);

        Assert.assertFalse(foiPossivelNegociar);
    }



    @Test
    public void compraGoleiro(){

        Goleiro jogador = new Goleiro("Adriano", 20, null, 6, new Indiferente(), BigDecimal.valueOf(1000), 10);
        BigDecimal valorJogador = jogador.valorCompra(); // 1000 + 40% = 1400
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1400.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }


    @Test
    public void compraZagueiro(){

        Zagueiro jogador = new Zagueiro("Adriano", 20, null, 6, new Indiferente(), BigDecimal.valueOf(1000));
        BigDecimal valorJogador = jogador.valorCompra(); // 1000
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1000.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }


    @Test
    public void compraZagueiroMais30Anos(){

        Zagueiro jogador = new Zagueiro("Adriano", 35, null, 6, new Indiferente(), BigDecimal.valueOf(1000));
        BigDecimal valorJogador = jogador.valorCompra(); // 1000 - 20% = 800
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(800.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }

    @Test
    public void compraMeioCampo(){

        MeioCampo jogador = new MeioCampo("Adriano", 20, null, 6, new Indiferente(), BigDecimal.valueOf(1000));
        BigDecimal valorJogador = jogador.valorCompra(); // 1000
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1000.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }


    @Test
    public void compraMeioCampoMais30Anos(){

        MeioCampo jogador = new MeioCampo("Adriano", 35, null, 6, new Indiferente(), BigDecimal.valueOf(1000));
        BigDecimal valorJogador = jogador.valorCompra(); // 1000 - 30% = 700
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(700.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }


    @Test
    public void compraLateral(){

        Lateral jogador = new Lateral("Adriano", 28, null, 6, new Indiferente(), BigDecimal.valueOf(1000), 10);
        BigDecimal valorJogador = jogador.valorCompra(); // 1000 + 20% (2% por cruzamento)
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1200.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }


    @Test
    public void compraLateralMais28Anos(){

        Lateral jogador = new Lateral("Adriano", 35, null, 6, new Indiferente(), BigDecimal.valueOf(1000), 10);
        BigDecimal valorJogador = jogador.valorCompra(); // 1200 - 30% = 840
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(840.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }


    @Test
    public void compraAtacante(){

        Atacante jogador = new Atacante("Adriano", 28, null, 6, new Indiferente(), BigDecimal.valueOf(1000), 10);
        BigDecimal valorJogador = jogador.valorCompra(); // 1000 + 10% (1% por gol)
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1100.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }


    @Test
    public void compraAtacanteMais30Anos(){

        Atacante jogador = new Atacante("Adriano", 35, null, 6, new Indiferente(), BigDecimal.valueOf(1000), 10);
        BigDecimal valorJogador = jogador.valorCompra(); // 1100 - 25% = 840
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(825.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }



    @Test
    public void compraGoleiroConservadorConservador(){

        Goleiro jogador = new Goleiro("Adriano", 20, null, 6, new Conservador(), BigDecimal.valueOf(1000), 10);
        BigDecimal valorJogador = jogador.valorCompra(); // 1000 + 40% = 1400 + 40% =
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1960.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }


    @Test
    public void compraZagueiroConservador(){

        Zagueiro jogador = new Zagueiro("Adriano", 20, null, 6, new Conservador(), BigDecimal.valueOf(1000));
        BigDecimal valorJogador = jogador.valorCompra(); // 1000
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1400.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }


    @Test
    public void compraZagueiroMais30AnosConservador(){

        Zagueiro jogador = new Zagueiro("Adriano", 35, null, 6, new Conservador(), BigDecimal.valueOf(1000));
        BigDecimal valorJogador = jogador.valorCompra(); // 1000 - 20% = 800
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1120.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }

    @Test
    public void compraMeioCampoConservador(){

        MeioCampo jogador = new MeioCampo("Adriano", 20, null, 6, new Conservador(), BigDecimal.valueOf(1000));
        BigDecimal valorJogador = jogador.valorCompra(); // 1000
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1400.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }


    @Test
    public void compraMeioCampoMais30AnosConservador(){

        MeioCampo jogador = new MeioCampo("Adriano", 35, null, 6, new Conservador(), BigDecimal.valueOf(1000));
        BigDecimal valorJogador = jogador.valorCompra(); // 1000 - 30% = 700
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(980.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }


    @Test
    public void compraLateralConservador(){

        Lateral jogador = new Lateral("Adriano", 28, null, 6, new Conservador(), BigDecimal.valueOf(1000), 10);
        BigDecimal valorJogador = jogador.valorCompra(); // 1000 + 20% (2% por cruzamento)
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1680.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }


    @Test
    public void compraLateralMais28AnosConservador(){

        Lateral jogador = new Lateral("Adriano", 35, null, 6, new Conservador(), BigDecimal.valueOf(1000), 10);
        BigDecimal valorJogador = jogador.valorCompra(); // 1200 - 30% = 840
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1176.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }


    @Test
    public void compraAtacanteConservador(){

        Atacante jogador = new Atacante("Adriano", 28, null, 6, new Conservador(), BigDecimal.valueOf(1000), 10);
        BigDecimal valorJogador = jogador.valorCompra(); // 1000 + 10% (1% por gol)
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1540.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }


    @Test
    public void compraAtacanteMais30AnosConservador(){

        Atacante jogador = new Atacante("Adriano", 35, null, 6, new Conservador(), BigDecimal.valueOf(1000), 10);
        BigDecimal valorJogador = jogador.valorCompra(); // 1100 - 25% = 840
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1155.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Sem Clube", jogador.getClubeAtual());
    }


    @Test
    public void compraGoleiroMercenario(){

        Clube clube = new Clube("Internacional", 3, BigDecimal.valueOf(100000000));
        Goleiro jogador = new Goleiro("Adriano", 20, clube, 6, new Mercenario(), BigDecimal.valueOf(1000), 10);
        BigDecimal valorJogador = jogador.valorCompra(); // 1000 + 40% = 1400
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(2520.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Internacional", jogador.getClubeAtual());
    }


    @Test
    public void compraZagueiroMercenario(){

        Clube clube = new Clube("Internacional", 3, BigDecimal.valueOf(100000000));
        Zagueiro jogador = new Zagueiro("Adriano", 20, clube, 6, new Mercenario(), BigDecimal.valueOf(1000));
        BigDecimal valorJogador = jogador.valorCompra(); // 1000
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1800.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Internacional", jogador.getClubeAtual());
    }


    @Test
    public void compraZagueiroMais30AnosMercenario(){

        Clube clube = new Clube("Internacional", 3, BigDecimal.valueOf(100000000));
        Zagueiro jogador = new Zagueiro("Adriano", 35, clube, 6, new Mercenario(), BigDecimal.valueOf(1000));
        BigDecimal valorJogador = jogador.valorCompra(); // 1000 - 20% = 800
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1440.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Internacional", jogador.getClubeAtual());
    }

    @Test
    public void compraMeioCampoMercenario(){

        Clube clube = new Clube("Internacional", 3, BigDecimal.valueOf(100000000));
        MeioCampo jogador = new MeioCampo("Adriano", 20, clube, 6, new Mercenario(), BigDecimal.valueOf(1000));
        BigDecimal valorJogador = jogador.valorCompra(); // 1000
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1800.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Internacional", jogador.getClubeAtual());
    }


    @Test
    public void compraMeioCampoMais30AnosMercenario(){

        Clube clube = new Clube("Internacional", 3, BigDecimal.valueOf(100000000));
        MeioCampo jogador = new MeioCampo("Adriano", 35, clube, 6, new Mercenario(), BigDecimal.valueOf(1000));
        BigDecimal valorJogador = jogador.valorCompra(); // 1000 - 30% = 700
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1260.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Internacional", jogador.getClubeAtual());
    }


    @Test
    public void compraLateralMercenario(){

        Clube clube = new Clube("Internacional", 3, BigDecimal.valueOf(100000000));
        Lateral jogador = new Lateral("Adriano", 28, clube, 6, new Mercenario(), BigDecimal.valueOf(1000), 10);
        BigDecimal valorJogador = jogador.valorCompra(); // 1000 + 20% (2% por cruzamento)
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(2160.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Internacional", jogador.getClubeAtual());
    }


    @Test
    public void compraLateralMais28AnosMercenario(){

        Clube clube = new Clube("Internacional", 3, BigDecimal.valueOf(100000000));
        Lateral jogador = new Lateral("Adriano", 35, clube, 6, new Mercenario(), BigDecimal.valueOf(1000), 10);
        BigDecimal valorJogador = jogador.valorCompra(); // 1200 - 30% = 840
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1512.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Internacional", jogador.getClubeAtual());
    }


    @Test
    public void compraAtacanteMercenario(){

        Clube clube = new Clube("Internacional", 3, BigDecimal.valueOf(100000000));
        Atacante jogador = new Atacante("Adriano", 28, clube, 6, new Mercenario(), BigDecimal.valueOf(1000), 10);
        BigDecimal valorJogador = jogador.valorCompra(); // 1000 + 10% (1% por gol)
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1980.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Internacional", jogador.getClubeAtual());
    }


    @Test
    public void compraAtacanteMais30AnosMercenario(){

        Clube clube = new Clube("Internacional", 3, BigDecimal.valueOf(100000000));
        Atacante jogador = new Atacante("Adriano", 35, clube, 6, new Mercenario(), BigDecimal.valueOf(1000), 10);
        BigDecimal valorJogador = jogador.valorCompra(); // 1100 - 25% = 840
        System.out.println(valorJogador);
        BigDecimal valorEsperado = BigDecimal.valueOf(1485.00).setScale(2, RoundingMode.HALF_UP);
        Assert.assertEquals(valorEsperado, valorJogador);
        Assert.assertEquals("Internacional", jogador.getClubeAtual());
    }


    @Test
    public void cadastrarAtacantesReputacaoMaiorQue10ouNegativa(){

        Clube clube = new Clube("", 3, BigDecimal.valueOf(100000000));
        Atacante neymar = new Atacante("Neymar", 31, clube, 11, new Mercenario(), BigDecimal.valueOf(1000), 10);
        Atacante ronaldo = new Atacante("Ronaldo", 38, clube, -2, new Mercenario(), BigDecimal.valueOf(1000), 10);
        Assert.assertEquals(0, neymar.getReputacaoHistorica());
        Assert.assertEquals(0, ronaldo.getReputacaoHistorica());
    }


    @Test
    public void cadastrarClubeNull(){

        Clube clube = new Clube("", 15, BigDecimal.valueOf(100000000));
        Assert.assertEquals("Sem Clube", clube.getNome());
        Assert.assertEquals(0, clube.getReputacao());

    }


    @Test
    public void atacanteInteressadoClube(){

        Clube clube = new Clube("Internacional", 9, BigDecimal.valueOf(100000000));
        Atacante neymar = new Atacante("Neymar", 31, clube, 6, new Mercenario(), BigDecimal.valueOf(1000), 10);
        Atacante ronaldo = new Atacante("Ronaldo", 38, clube, 10, new Mercenario(), BigDecimal.valueOf(1000), 10);

        Assert.assertTrue(neymar.interessadoClube(clube));
        Assert.assertFalse(ronaldo.interessadoClube(clube));

    }


    @Test
    public void meioCampoInteressadoClube(){

        Clube clube = new Clube("Internacional", 5, BigDecimal.valueOf(100000000));
        MeioCampo paulo = new MeioCampo("Paulo", 31, clube, 9, new Mercenario(), BigDecimal.valueOf(1000));
        MeioCampo kaka = new MeioCampo("kaka", 25, clube, 6, new Mercenario(), BigDecimal.valueOf(1000));

        Assert.assertTrue(paulo.interessadoClube(clube));
        Assert.assertFalse(kaka.interessadoClube(clube));

    }


    @Test
    public void goleiroInteressadoClube(){

        Clube clube = new Clube("Internacional", 5, BigDecimal.valueOf(100000000));
        Goleiro jogador = new Goleiro("Adriano", 20, null, 6, new Indiferente(), BigDecimal.valueOf(1000), 10);

        Assert.assertTrue(jogador.interessadoClube(clube));

    }




}
