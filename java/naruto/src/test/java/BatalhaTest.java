import game.Batalha;
import game.Jutsu;
import game.Ninja;
import org.junit.Assert;
import org.junit.Test;

public class BatalhaTest{


    @Test
    public void deveRetornarPrimeiroNinjaComoVencedorQuandoEmpatar(){

        Jutsu j1 = new Jutsu(5, 1);
        Ninja n1 = new Ninja("Sasuke", j1);

        Jutsu j2 = new Jutsu(5, 1);
        Ninja n2 = new Ninja("Nagato", j2);

        Batalha bat = new Batalha();
        Assert.assertSame(n1, bat.lutar(n1, n2));
    }


    @Test
    public void deveRetornarSegundoNinjaComoVencedorQuandoONomeForItachi(){

        Jutsu j1 = new Jutsu(3, 8);
        Ninja n1 = new Ninja("Sasuke", j1);

        Jutsu j2 = new Jutsu(4, 4);
        Ninja n2 = new Ninja("Itachi", j2);

        Batalha bat = new Batalha();
        Assert.assertSame(n2, bat.lutar(n1, n2));
    }


    @Test
    public void deveRetornarPrimeiroNinjaComoVencedorQuandoONomeForItachi(){

        Jutsu j1 = new Jutsu(4, 2);
        Ninja n1 = new Ninja("Itachi", j1);

        Jutsu j2 = new Jutsu(1, 7);
        Ninja n2 = new Ninja("Gaara", j2);

        Batalha bat = new Batalha();
        Assert.assertSame(n1, bat.lutar(n1, n2));
    }


    @Test
    public void deveRetornarNinjaComJutsuMaisForteSeOsDoisGastamOMesmoChakra(){

        Jutsu j1 = new Jutsu(4, 2);
        Ninja n1 = new Ninja("Sakura", j1);

        Jutsu j2 = new Jutsu(4, 7);
        Ninja n2 = new Ninja("Gaara", j2);

        Batalha bat = new Batalha();
        Assert.assertSame(n2, bat.lutar(n1, n2));
    }


    @Test
    public void deveAtualizarOChakraDoOponenteDeAcordoComODanoDoJutsoQuandoAtacar(){

        Jutsu j1 = new Jutsu(5, 10);
        Ninja n1 = new Ninja("Sakura", j1);

        Jutsu j2 = new Jutsu(5, 8);
        Ninja n2 = new Ninja("Gaara", j2);

        int chakraEsperado = 90;
        n1.atacar(n2);

        Assert.assertEquals(chakraEsperado, n2.getChakra());
    }

    @Test
    public void verificarConsumoeDanoComValorSuperior(){

        Jutsu j1 = new Jutsu(8, 12);
        Ninja n1 = new Ninja("Sakura", j1);

        Jutsu j2 = new Jutsu(4, 7);
        Ninja n2 = new Ninja("Gaara", j2);

        Batalha bat = new Batalha();
        Assert.assertEquals(5, n1.getConsumoChakra());
        Assert.assertEquals(10, n1.getDanoChakra());

    }



}



