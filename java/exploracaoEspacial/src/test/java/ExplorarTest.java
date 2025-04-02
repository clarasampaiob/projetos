import naves.Nave;
import org.junit.Assert;
import org.junit.Test;
import planetas.Planeta;
import recursos.Recurso;

import java.util.*;

public class ExplorarTest {


    @Test
    public void deveFicarADerivaQuandoFaltarCombustivelParaIrAteUmPlaneta(){

        Recurso AGUA = new Recurso(180, 10);
        Recurso OXIGENIO = new Recurso(300, 2);
        Recurso SILICIO = new Recurso(60, 16);
        Recurso OURO = new Recurso(120, 25);
        Recurso FERRO = new Recurso(30, 32);


        List<Recurso> marteRecs = new ArrayList<Recurso>();
        marteRecs.add(AGUA);
        marteRecs.add(OXIGENIO);
        marteRecs.add(FERRO);

        List<Recurso> netunoRecs = new ArrayList<Recurso>();
        netunoRecs.add(SILICIO);
        netunoRecs.add(OURO);
        netunoRecs.add(AGUA);

        List<Recurso> venusRecs = new ArrayList<Recurso>();
        venusRecs.add(FERRO);
        venusRecs.add(OXIGENIO);
        venusRecs.add(AGUA);


        Planeta marte = new Planeta(10, marteRecs);
        marte.getSomaValores();
        marte.getSomaValorPorPeso();

        Planeta netuno = new Planeta(2, netunoRecs);
        netuno.getSomaValores();
        netuno.getSomaValorPorPeso();

        Planeta venus = new Planeta(6, venusRecs);
        venus.getSomaValores();
        venus.getSomaValorPorPeso();


        List<Planeta> planetas = new ArrayList<Planeta>();
        planetas.add(marte);
        planetas.add(netuno);
        planetas.add(venus);


        Nave falcon = new Nave(70);
        int startPosicao = falcon.getPosicaoNave();
        int startCombustivel = falcon.getQuantidadeDeCombustivel();
        List<Recurso> recursos = falcon.explorar(planetas);
        int endPosicao = falcon.getPosicaoNave();
        int endCombustivel = falcon.getQuantidadeDeCombustivel();


        System.out.println("Posição Final: " + endPosicao + ". Combustível Final: " + endCombustivel + ". Recursos Empty: " + recursos.isEmpty());
        Assert.assertTrue(recursos.isEmpty());
        Assert.assertEquals(4,falcon.getQuantidadeDeCombustivel());
        Assert.assertEquals(6,falcon.getPosicaoNave());
        Assert.assertNotEquals(startCombustivel, endCombustivel); // Qtdd de combustivel final diferente significa que a nave conseguiu começar a exploração
        Assert.assertNotEquals(startPosicao, endPosicao); // Posição final diferente de 0 significa que a nave não conseguiu retornar ao ponto inicial, ficando a deriva
    }



    @Test
    public void deveTerValorTotalQuandoExistirRecursosNoPlaneta(){

        Recurso AGUA = new Recurso(180, 10);
        Recurso OXIGENIO = new Recurso(300, 2);
        Recurso FERRO = new Recurso(30, 32);

        List<Recurso> marteRecs = new ArrayList<Recurso>();
        marteRecs.add(AGUA);
        marteRecs.add(OXIGENIO);
        marteRecs.add(FERRO);

        Planeta marte = new Planeta(10, marteRecs);
        marte.getSomaValores();

        Nave falcon = new Nave(100);
        List<Recurso> recursos = falcon.explorar(marte);

        Assert.assertFalse(recursos.isEmpty());
        Assert.assertTrue(marte.getSomaValores() > 0);
        Assert.assertEquals((180 + 300 + 30), marte.getSomaValores());
    }



    @Test
    public void deveTerValorPorPesoQuandoExistirRecursosNoPlaneta(){

        Recurso AGUA = new Recurso(180, 10);
        Recurso OXIGENIO = new Recurso(300, 2);
        Recurso OURO = new Recurso(120, 25);
        Recurso SILICIO = new Recurso(60, 16);

        List<Recurso> marteRecs = new ArrayList<Recurso>();
        marteRecs.add(AGUA);
        marteRecs.add(OXIGENIO);
        marteRecs.add(OURO);
        marteRecs.add(SILICIO);

        Planeta marte = new Planeta(10, marteRecs);
        marte.getSomaValorPorPeso();

        Nave falcon = new Nave(100);
        List<Recurso> recursos = falcon.explorar(marte);
        double valorEsperado = (AGUA.dividirValorPorPeso()) + (OXIGENIO.dividirValorPorPeso()) + (OURO.dividirValorPorPeso()) + (SILICIO.dividirValorPorPeso());

        Assert.assertFalse(recursos.isEmpty());
        Assert.assertTrue(marte.getSomaValorPorPeso() > 0);
        Assert.assertEquals(valorEsperado, marte.getSomaValorPorPeso(), 0.01);
    }



    @Test
    public void deveTerValorTotalZeradoQuandoNaoExistirNenhumRecurso(){

        Planeta marte = new Planeta(10, Collections.emptyList());
        Nave falcon = new Nave(100);
        List<Recurso> recursos = falcon.explorar(marte);

        Assert.assertTrue(recursos.isEmpty());
        Assert.assertEquals(0, marte.getSomaValores());
    }



    @Test
    public void deveTerValorPorPesoZeradoQuandoNaoExistirNenhumRecurso(){

        Planeta marte = new Planeta(10, Collections.emptyList());
        Nave falcon = new Nave(100);
        List<Recurso> recursos = falcon.explorar(marte);

        Assert.assertTrue(recursos.isEmpty());
        Assert.assertEquals(0.0, marte.getSomaValorPorPeso(), 0.01);
    }



    @Test
    public void explorarVariosPlanetas(){

        Recurso AGUA = new Recurso(180, 10);
        Recurso OXIGENIO = new Recurso(300, 2);
        Recurso SILICIO = new Recurso(60, 16);
        Recurso OURO = new Recurso(120, 25);
        Recurso FERRO = new Recurso(30, 32);

        List<Recurso> marteRecs = new ArrayList<Recurso>();
        marteRecs.add(OXIGENIO);
        marteRecs.add(FERRO);

        List<Recurso> netunoRecs = new ArrayList<Recurso>();
        netunoRecs.add(SILICIO);
        netunoRecs.add(OURO);
        netunoRecs.add(AGUA);
        netunoRecs.add(FERRO);

        List<Recurso> venusRecs = new ArrayList<Recurso>();
        venusRecs.add(FERRO);
        venusRecs.add(OXIGENIO);
        venusRecs.add(AGUA);

        Planeta marte = new Planeta(10, marteRecs);
        Planeta netuno = new Planeta(3,netunoRecs);
        Planeta venus = new Planeta(6, venusRecs);
        int combustivelGasto = 200 - ((10*3) + (7*3) + (3*3) + (3*3) + (7*3) + (10*3));
        int recursosColetados = (300+30) + (60+120+180+30) + (30+300+180);

        List<Planeta> planetas = new ArrayList<Planeta>();
        planetas.add(marte);
        planetas.add(netuno);
        planetas.add(venus);

        Nave falcon = new Nave(200);
        List<Recurso> recursos = falcon.explorar(planetas);
        System.out.println("Posição Final: " + falcon.getPosicaoNave() + ". Combustível Final: " + falcon.getQuantidadeDeCombustivel());

        Assert.assertFalse(recursos.isEmpty());
        Assert.assertEquals(0, falcon.getPosicaoNave());
        Assert.assertEquals(combustivelGasto, falcon.getQuantidadeDeCombustivel());
        Assert.assertEquals(recursosColetados, (marte.getSomaValores() + netuno.getSomaValores() + venus.getSomaValores()));
    }




    @Test
    public void explorarSomenteUmPlaneta(){

        Recurso AGUA = new Recurso(180, 10);
        Recurso SILICIO = new Recurso(60, 16);
        Recurso OURO = new Recurso(120, 25);

        List<Recurso> netunoRecs = new ArrayList<Recurso>();
        netunoRecs.add(SILICIO);
        netunoRecs.add(OURO);
        netunoRecs.add(AGUA);

        Planeta netuno = new Planeta(5,netunoRecs);
        netuno.getSomaValores();
        netuno.getSomaValorPorPeso();

        Nave falcon = new Nave(100);
        int startPosicao = falcon.getPosicaoNave();
        falcon.explorar(netuno);
        System.out.println("Posição Final: " + falcon.getPosicaoNave() + ". Combustível Final: " + falcon.getQuantidadeDeCombustivel());

        Assert.assertEquals(360, netuno.getSomaValores());
        Assert.assertEquals(70, falcon.getQuantidadeDeCombustivel());
        Assert.assertEquals(startPosicao, falcon.getPosicaoNave()); // A nave conseguiu retornar
    }


    @Test
    public void naveFicaADerivaParaRetornarDaRotaDeUmUnicoPlaneta(){

        Recurso AGUA = new Recurso(180, 10);
        Recurso SILICIO = new Recurso(60, 16);
        Recurso OURO = new Recurso(120, 25);

        List<Recurso> netunoRecs = new ArrayList<Recurso>();
        netunoRecs.add(SILICIO);
        netunoRecs.add(OURO);
        netunoRecs.add(AGUA);

        Planeta netuno = new Planeta(10,netunoRecs);
        netuno.getSomaValores();
        netuno.getSomaValorPorPeso();

        Nave falcon = new Nave(35);
        int startPosicao = falcon.getPosicaoNave();
        List<Recurso> recursos = falcon.explorar(netuno);
        System.out.println("Posição Final: " + falcon.getPosicaoNave() + ". Combustível Final: " + falcon.getQuantidadeDeCombustivel());

        Assert.assertTrue(recursos.isEmpty());
        Assert.assertEquals(360, netuno.getSomaValores());
        Assert.assertEquals(5, falcon.getQuantidadeDeCombustivel());
        Assert.assertEquals(10, falcon.getPosicaoNave());
        Assert.assertNotEquals(startPosicao, falcon.getPosicaoNave()); // A nave não conseguiu retornar
    }



    @Test
    public void explorarPlanetasComPrioridadeCaso1(){

        Recurso AGUA = new Recurso(180, 10);
        Recurso OXIGENIO = new Recurso(300, 2);
        Recurso SILICIO = new Recurso(60, 16);
        Recurso OURO = new Recurso(120, 25);
        Recurso FERRO = new Recurso(30, 32);


        List<Recurso> marteRecs = new ArrayList<Recurso>();
        marteRecs.add(AGUA);
        marteRecs.add(OXIGENIO);
        marteRecs.add(FERRO);

        List<Recurso> netunoRecs = new ArrayList<Recurso>();
        netunoRecs.add(SILICIO);
        netunoRecs.add(OURO);
        netunoRecs.add(AGUA);
        netunoRecs.add(OXIGENIO);
        netunoRecs.add(FERRO);

        List<Recurso> venusRecs = new ArrayList<Recurso>();
        venusRecs.add(OXIGENIO);

        Planeta marte = new Planeta(1, marteRecs);
        Planeta netuno = new Planeta(10,netunoRecs);
        Planeta venus = new Planeta(6, venusRecs);

        List<Planeta> planetas = new ArrayList<Planeta>();
        planetas.add(marte);
        planetas.add(netuno);
        planetas.add(venus);


        Nave falcon = new Nave(160);
        Nave spaceFox = new Nave(160);

        // 1 - Prioridade por Posição Planeta
        List<Recurso> recursos1 = falcon.explorarComPrioridade(planetas, 1);
        int posicaoResultante1 = falcon.getPosicaoNave();
        int combustivelFinal1 = falcon.getQuantidadeDeCombustivel();

        // 2 - Prioridade por Recursos Planeta
        List<Recurso> recursos2 = spaceFox.explorarComPrioridade(planetas, 2);
        int posicaoResultante2 = spaceFox.getPosicaoNave();
        int combustivelFinal2 = spaceFox.getQuantidadeDeCombustivel();


        System.out.println("Posição Final Priorodade POSIÇÃO: " + posicaoResultante1 + ". Combustível Final: " + combustivelFinal1);
        System.out.println("Posição Final Prioridade SOMA RECURSOS: " + posicaoResultante2 + ". Combustível Final: " + combustivelFinal2);

        Assert.assertEquals(0, posicaoResultante1); // Falcon conseguiu completar seu trajeto
        Assert.assertNotEquals(0, posicaoResultante2); // SpaceFox não conseguiu completar seu trajeto
        Assert.assertTrue(combustivelFinal1 > combustivelFinal2); // Falcon gastou menos combustível no trajeto
        Assert.assertTrue(recursos2.isEmpty()); // SpaceFox ficou a deriva
        Assert.assertFalse(recursos1.isEmpty());
    }



    @Test
    public void explorarPlanetasComPrioridadeCaso2(){

        Recurso AGUA = new Recurso(180, 10);
        Recurso OXIGENIO = new Recurso(300, 2);
        Recurso SILICIO = new Recurso(60, 16);
        Recurso OURO = new Recurso(120, 25);
        Recurso FERRO = new Recurso(30, 32);


        List<Recurso> marteRecs = new ArrayList<Recurso>();
        marteRecs.add(AGUA);
        marteRecs.add(OXIGENIO);
        marteRecs.add(FERRO);

        List<Recurso> netunoRecs = new ArrayList<Recurso>();
        netunoRecs.add(AGUA);
        netunoRecs.add(OXIGENIO);
        netunoRecs.add(FERRO);
        netunoRecs.add(SILICIO);

        List<Recurso> venusRecs = new ArrayList<Recurso>();
        venusRecs.add(OXIGENIO);
        venusRecs.add(SILICIO);
        venusRecs.add(OURO);
        venusRecs.add(AGUA);
        venusRecs.add(FERRO);

        Planeta marte = new Planeta(4, marteRecs);
        Planeta netuno = new Planeta(8,netunoRecs);
        Planeta venus = new Planeta(5, venusRecs);

        List<Planeta> planetas = new ArrayList<Planeta>();
        planetas.add(marte);
        planetas.add(netuno);
        planetas.add(venus);


        Nave falcon = new Nave(160);
        Nave spaceFox = new Nave(160);

        // 1 - Prioridade por Posição Planeta
        List<Recurso> recursos1 = falcon.explorarComPrioridade(planetas, 1);
        int posicaoResultante1 = falcon.getPosicaoNave();
        int combustivelFinal1 = falcon.getQuantidadeDeCombustivel();

        // 2 - Prioridade por Recursos Planeta
        List<Recurso> recursos2 = spaceFox.explorarComPrioridade(planetas, 2);
        int posicaoResultante2 = spaceFox.getPosicaoNave();
        int combustivelFinal2 = spaceFox.getQuantidadeDeCombustivel();


        System.out.println("Posição Final Priorodade POSIÇÃO: " + posicaoResultante1 + ". Combustível Final: " + combustivelFinal1);
        System.out.println("Posição Final Prioridade SOMA RECURSOS: " + posicaoResultante2 + ". Combustível Final: " + combustivelFinal2);

        Assert.assertEquals(0, posicaoResultante1); // Falcon conseguiu completar seu trajeto
        Assert.assertEquals(0, posicaoResultante2); // SpaceFox conseguiu completar seu trajeto
        Assert.assertTrue(combustivelFinal1 > combustivelFinal2); // Falcon gastou menos combustível no trajeto
        Assert.assertFalse(recursos2.isEmpty());
        Assert.assertFalse(recursos1.isEmpty());
    }


}
