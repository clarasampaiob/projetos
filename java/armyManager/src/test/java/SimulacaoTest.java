import militares.*;
import org.junit.Assert;
import org.junit.Test;
import simulacao.SimulacaoFinanceira;
import veiculos.*;

import java.math.BigDecimal;
import java.math.RoundingMode;
import java.time.LocalDate;
import java.util.ArrayList;

import static org.junit.Assert.assertEquals;
import static org.junit.Assert.assertFalse;

public class SimulacaoTest {

    @Test
    public void deveCalcularOCustoTotalDaMissaoCorretamente() {

        ArrayList<Veiculo> veiculos = new ArrayList<>();

        veiculos.add(criarAviao());
        veiculos.add(criarTanque());
        veiculos.add(criarTanque());
        veiculos.add(criarTanque());
        veiculos.add(criarTanque());
        veiculos.add(criarTanque());

        SimulacaoFinanceira simulacao = new SimulacaoFinanceira(1137, veiculos, 1);

        BigDecimal custoTotal = simulacao.getCustoTotalMissao();

        // Se esse teste falhar por centavos de diferença (pequenas diferenças de arredondamento) o valor do teste pode ser ajustado.
        assertEquals(BigDecimal.valueOf(213623.83), custoTotal);
        assertFalse(simulacao.todasTripulacoesValidas());
    }

    private Tanque criarTanque() {

        Elite piloto = new Elite(BigDecimal.valueOf(3000),
                LocalDate.now().plusDays(20),
                LocalDate.now().plusDays(20),
                LocalDate.now().plusDays(20),
                LocalDate.now().plusDays(20));

        ArrayList<Militar> tripulacao = new ArrayList<>();

        tripulacao.add(new PilotoTanque(BigDecimal.valueOf(2500), LocalDate.now().minusYears(1)));
        tripulacao.add(new Militar(BigDecimal.valueOf(600)));
        tripulacao.add(new Militar(BigDecimal.valueOf(600)));

        return new Tanque(piloto, tripulacao, 0.22, BigDecimal.valueOf(3.46));
    }

    private Aviao criarAviao() {

        EspecialistaAr piloto = new EspecialistaAr(BigDecimal.valueOf(7000), LocalDate.now().plusDays(-20), LocalDate.now().plusDays(20));

        ArrayList<Militar> tripulacao = new ArrayList<>();

        tripulacao.add(new Militar(BigDecimal.valueOf(2500)));

        return new Aviao(piloto, tripulacao, 0.14, BigDecimal.valueOf(10));
    }



    @Test
    public void deveCalcularOCustoTotalComCombustivelCorretamente(){

        //Tripulação Avião
        Elite piloto = new Elite(BigDecimal.valueOf(3000), LocalDate.now().plusDays(20), LocalDate.now().plusDays(20), LocalDate.now().plusDays(20), LocalDate.now().plusDays(20));

        PilotoTanque caio = new PilotoTanque(BigDecimal.valueOf(10000), LocalDate.now().plusYears(5));
        Militar militar = new Militar(BigDecimal.valueOf(4000));

        ArrayList<Militar> tripulacao = new ArrayList<>();
        tripulacao.add(caio);
        tripulacao.add(militar);

        Aviao gol = new Aviao(piloto, tripulacao, 2, BigDecimal.valueOf(6));
        System.out.println(gol.tripulacaoValida());
        assertFalse(gol.tripulacaoValida());


        // Tripulação Tanque
        PilotoTanque pilotoTanque = new PilotoTanque(BigDecimal.valueOf(10000), LocalDate.now().plusYears(6));

        EspecialistaAr ar = new EspecialistaAr(BigDecimal.valueOf(10000),LocalDate.now().plusYears(3), LocalDate.now().minusYears(2));
        Elite elitista = new Elite(BigDecimal.valueOf(10000), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10));
        PilotoHelicoptero helic = new PilotoHelicoptero(BigDecimal.valueOf(20000), LocalDate.now().plusYears(5));

        ArrayList<Militar> tripulacao2 = new ArrayList<>();
        tripulacao2.add(helic);
        tripulacao2.add(elitista);
        tripulacao2.add(ar);

        Tanque tanque = new Tanque(pilotoTanque, tripulacao2, 10, BigDecimal.valueOf(5));
        System.out.println(tanque.tripulacaoValida());
        Assert.assertTrue(tanque.tripulacaoValida());


        // Todos Veiculos na Missão
        ArrayList<Veiculo> veiculos = new ArrayList<>();
        veiculos.add(tanque);
        veiculos.add(gol);


        // Simulação
        SimulacaoFinanceira simulacao = new SimulacaoFinanceira(100, veiculos, 2);

        BigDecimal custoTotal = simulacao.getCustoTotalMissao();
        assertEquals(BigDecimal.valueOf(134350).setScale(2, RoundingMode.HALF_UP), custoTotal.setScale(2, RoundingMode.HALF_UP));
        System.out.println("Custo Total: " + custoTotal);

        assertFalse(simulacao.todasTripulacoesValidas());
        System.out.println("Tripulações Válidas: " + simulacao.todasTripulacoesValidas());

        System.out.println("Total Combustível: " + simulacao.getTotCombustivel());
        System.out.println("Total Salários 2 Meses de Missão: " + simulacao.getTotSalarios());
        assertEquals(BigDecimal.valueOf(350).setScale(2, RoundingMode.HALF_UP), simulacao.getTotCombustivel().setScale(2, RoundingMode.HALF_UP));
        assertEquals(BigDecimal.valueOf(134000).setScale(2, RoundingMode.HALF_UP), simulacao.getTotSalarios().setScale(2, RoundingMode.HALF_UP));

    }



    @Test
    public void deveCalcularOCustoToralComSalariosCorretamente(){

        PilotoHelicoptero piloto = new PilotoHelicoptero(BigDecimal.valueOf(5000),LocalDate.now().plusYears(3));

        EspecialistaAr ar = new EspecialistaAr(BigDecimal.valueOf(10000),LocalDate.now().plusYears(3), LocalDate.now().minusYears(2));
        Elite elitista = new Elite(BigDecimal.valueOf(10000), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10));
        PilotoHelicoptero helic = new PilotoHelicoptero(BigDecimal.valueOf(20000), LocalDate.now().plusYears(5));
        PilotoTanque caio = new PilotoTanque(BigDecimal.valueOf(10000), LocalDate.now().plusYears(5));
        Militar militar = new Militar(BigDecimal.valueOf(4000));
        EspecialistaTerrestre terrestre = new EspecialistaTerrestre(BigDecimal.valueOf(2000), LocalDate.now().plusYears(3),LocalDate.now().plusYears(1));
        PilotoAviao aviaop = new PilotoAviao(BigDecimal.valueOf(10000), LocalDate.now().plusDays(280));
        PilotoCaminhao caminhoneiro = new PilotoCaminhao(BigDecimal.valueOf(3000),LocalDate.now().plusDays(300));

        ArrayList<Militar> tripulacao = new ArrayList<>();
        tripulacao.add(caio);
        tripulacao.add(militar);
        tripulacao.add(helic);
        tripulacao.add(elitista);
        tripulacao.add(ar);
        tripulacao.add(terrestre);
        tripulacao.add(aviaop);
        tripulacao.add(caminhoneiro);

        Helicoptero helicoptero = new Helicoptero(piloto, tripulacao,10,BigDecimal.valueOf(4.5));
        ArrayList<Veiculo> veiculos = new ArrayList<>();
        veiculos.add(helicoptero);

        SimulacaoFinanceira simulacao = new SimulacaoFinanceira(100, veiculos, 6);
        System.out.println("Custo Total Missão: R$ " + simulacao.getCustoTotalMissao() + ". Total Salário 6 Meses de Missão: R$ " + simulacao.getTotSalarios());
        Assert.assertEquals(BigDecimal.valueOf(444000), simulacao.getTotSalarios());

    }


    @Test
    public void validarTripulacaoCaminhao(){

        Elite elitista = new Elite(BigDecimal.valueOf(10000), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10));
        Militar militar = new Militar(BigDecimal.valueOf(4000));
        PilotoAviao aviaop = new PilotoAviao(BigDecimal.valueOf(10000), LocalDate.now().plusDays(280));
        PilotoCaminhao caminhoneiro = new PilotoCaminhao(BigDecimal.valueOf(3000),LocalDate.now().plusDays(300));
        EspecialistaTerrestre terrestre = new EspecialistaTerrestre(BigDecimal.valueOf(2000), LocalDate.now().plusYears(3),LocalDate.now().plusYears(1));
        Elite vencido = new Elite(BigDecimal.valueOf(10000), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10), LocalDate.now().minusWeeks(10), LocalDate.now().plusYears(10));

        // Tripulação inválida - Apenas 1 tripulante
        ArrayList<Militar> tripulacao = new ArrayList<>();
        tripulacao.add(aviaop);

        Caminhao caminhao = new Caminhao(caminhoneiro,tripulacao,5,BigDecimal.valueOf(8));
        Assert.assertFalse(caminhao.tripulacaoValida());

        // Tripulação Válida - Até 30 tripulantes
        for(int i = 0; i < 29; i++){ tripulacao.add(militar); }
        Assert.assertTrue(caminhao.tripulacaoValida());

        // Tripulação Inválida - Excesso de tripulantes
        for(int i = 0; i < 10; i++){ tripulacao.add(elitista); }
        Assert.assertFalse(caminhao.tripulacaoValida());

        // Tripulação Válida - 5 Tripulantes
        ArrayList<Militar> tripulantes = new ArrayList<>();
        for(int i = 0; i < 5; i++){ tripulantes.add(elitista); }

        // Tripulação Inválida - Motorista Aviador
        Caminhao carreta = new Caminhao(aviaop,tripulantes,5,BigDecimal.valueOf(8));
        Assert.assertFalse(carreta.tripulacaoValida());

        // Tripulação Válida - Motorista Elite
        Caminhao caminhaoPipa = new Caminhao(elitista,tripulantes,5,BigDecimal.valueOf(8));
        Assert.assertTrue(caminhaoPipa.tripulacaoValida());

        // Tripulação Válida - Motorista Especialista Terrestre
        Caminhao truck = new Caminhao(terrestre,tripulantes,5,BigDecimal.valueOf(8));
        Assert.assertTrue(truck.tripulacaoValida());

        // Tripulação Inválida - Motorista Licença Vencida
        Caminhao trucky = new Caminhao(vencido,tripulantes,5,BigDecimal.valueOf(8));
        Assert.assertFalse(trucky.tripulacaoValida());

    }


    @Test
    public void validarTripulacaoHelicoptero(){

        EspecialistaAr ar = new EspecialistaAr(BigDecimal.valueOf(10000),LocalDate.now().plusYears(3), LocalDate.now().plusYears(2));
        Elite elitista = new Elite(BigDecimal.valueOf(10000), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10));
        PilotoHelicoptero helic = new PilotoHelicoptero(BigDecimal.valueOf(20000), LocalDate.now().plusYears(5));
        PilotoTanque tanque = new PilotoTanque(BigDecimal.valueOf(10000), LocalDate.now().plusYears(5));
        Elite vencido = new Elite(BigDecimal.valueOf(10000), LocalDate.now().plusYears(10), LocalDate.now().minusMonths(10), LocalDate.now().minusWeeks(10), LocalDate.now().plusYears(10));

        // Tripulação inválida - Nenhum tripulante
        ArrayList<Militar> tripulacao = new ArrayList<>();
        Helicoptero helicoptero = new Helicoptero(helic, tripulacao, 3, BigDecimal.valueOf(2));
        Assert.assertFalse(helicoptero.tripulacaoValida());

        // Tripulação Válida - 10 tripulantes
        for(int i = 0; i < 10; i++){ tripulacao.add(elitista); }
        Assert.assertTrue(helicoptero.tripulacaoValida());

        // Tripulação Invalida - Piloto de Tanque
        Helicoptero helicop = new Helicoptero(tanque, tripulacao, 3, BigDecimal.valueOf(2));
        Assert.assertFalse(helicop.tripulacaoValida());

        // Tripulação Valida - Piloto Elite
        Helicoptero asus = new Helicoptero(elitista, tripulacao, 3, BigDecimal.valueOf(2));
        Assert.assertTrue(asus.tripulacaoValida());

        // Tripulação Valida - Piloto Especialista Ar
        Helicoptero aguia = new Helicoptero(ar, tripulacao, 3, BigDecimal.valueOf(2));
        Assert.assertTrue(aguia.tripulacaoValida());

        // Tripulação Inválida - Motorista Licença Vencida
        Helicoptero gol = new Helicoptero(vencido, tripulacao, 3, BigDecimal.valueOf(2));
        Assert.assertFalse(gol.tripulacaoValida());
    }



    @Test
    public void validarTripulacaoAviao(){

        EspecialistaAr ar = new EspecialistaAr(BigDecimal.valueOf(10000),LocalDate.now().plusYears(3), LocalDate.now().plusYears(2));
        Elite elitista = new Elite(BigDecimal.valueOf(10000), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10));
        PilotoTanque tanque = new PilotoTanque(BigDecimal.valueOf(10000), LocalDate.now().plusYears(5));
        Elite vencido = new Elite(BigDecimal.valueOf(10000), LocalDate.now().minusDays(280), LocalDate.now().minusMonths(10), LocalDate.now().minusWeeks(10), LocalDate.now().plusYears(10));
        PilotoAviao aviaop = new PilotoAviao(BigDecimal.valueOf(10000), LocalDate.now().plusDays(280));

        // Tripulação Válida - 1 tripulante
        ArrayList<Militar> tripulacao = new ArrayList<>();
        tripulacao.add(elitista);
        Aviao gol = new Aviao(aviaop, tripulacao, 2, BigDecimal.valueOf(6));
        Assert.assertTrue(gol.tripulacaoValida());

        // Tripulação Invalida - Piloto de Tanque
        Aviao airplane = new Aviao(tanque, tripulacao, 3, BigDecimal.valueOf(2));
        Assert.assertFalse(airplane.tripulacaoValida());

        // Tripulação Valida - Piloto Elite
        Aviao azul = new Aviao(elitista, tripulacao, 3, BigDecimal.valueOf(2));
        Assert.assertTrue(azul.tripulacaoValida());

        // Tripulação Valida - Piloto Especialista Ar
        Aviao aguia = new Aviao(ar, tripulacao, 3, BigDecimal.valueOf(2));
        Assert.assertTrue(aguia.tripulacaoValida());

        // Tripulação Inválida - Motorista Licença Vencida
        Aviao tam = new Aviao(vencido, tripulacao, 3, BigDecimal.valueOf(2));
        Assert.assertFalse(tam.tripulacaoValida());

        // Tripulação Inválida - +10 tripulantes
        for(int i = 0; i < 10; i++){ tripulacao.add(elitista); }
        Assert.assertFalse(gol.tripulacaoValida());
    }


    @Test
    public void validarTripulacaoTanque(){

        PilotoTanque tanq = new PilotoTanque(BigDecimal.valueOf(10000), LocalDate.now().plusYears(5));
        PilotoAviao aviaop = new PilotoAviao(BigDecimal.valueOf(10000), LocalDate.now().plusDays(280));
        Elite elitista = new Elite(BigDecimal.valueOf(10000), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10));
        EspecialistaTerrestre terrestre = new EspecialistaTerrestre(BigDecimal.valueOf(2000), LocalDate.now().plusYears(3),LocalDate.now().plusYears(1));
        Elite vencido = new Elite(BigDecimal.valueOf(10000), LocalDate.now().plusYears(10), LocalDate.now().plusYears(10), LocalDate.now().minusWeeks(10), LocalDate.now().minusYears(2));

        // Tripulação inválida - Apenas 1 tripulante
        ArrayList<Militar> tripulantes = new ArrayList<>();
        tripulantes.add(elitista);

        Tanque tanque = new Tanque(tanq, tripulantes, 2, BigDecimal.valueOf(4.5));
        Assert.assertFalse(tanque.tripulacaoValida());

        // Tripulação Válida - 3 tripulantes
        for(int i = 0; i < 2; i++){ tripulantes.add(elitista); }
        Assert.assertTrue(tanque.tripulacaoValida());

        // Tripulação Inválida - Motorista Aviador
        Tanque tank = new Tanque(aviaop,tripulantes,5,BigDecimal.valueOf(8));
        Assert.assertFalse(tank.tripulacaoValida());

        // Tripulação Válida - Motorista Elite
        Tanque tankao = new Tanque(elitista,tripulantes,5,BigDecimal.valueOf(8));
        Assert.assertTrue(tankao.tripulacaoValida());

        // Tripulação Válida - Motorista Especialista Terrestre
        Tanque tanqueGuerra = new Tanque(terrestre,tripulantes,5,BigDecimal.valueOf(8));
        Assert.assertTrue(tanqueGuerra.tripulacaoValida());

        // Tripulação Inválida - Motorista Licença Vencida
        Tanque tt = new Tanque(vencido,tripulantes,5,BigDecimal.valueOf(8));
        Assert.assertFalse(tt.tripulacaoValida());

    }


}
