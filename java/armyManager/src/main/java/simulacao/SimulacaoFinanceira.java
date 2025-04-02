package simulacao;

import interfaces.Tripulacao;
import veiculos.Veiculo;

import java.math.BigDecimal;
import java.math.RoundingMode;
import java.util.List;

public class SimulacaoFinanceira {

    private double distanciaViagem;
    private List<Veiculo> veiculos;
    private int duracaoMissao;
    private BigDecimal totCombustivel;
    private BigDecimal totSalarios;

    public SimulacaoFinanceira(double distanciaViagem, List<Veiculo> veiculos, int duracaoMissao) {
        this.distanciaViagem = distanciaViagem;
        this.veiculos = veiculos;
        this.duracaoMissao = duracaoMissao;
        this.totCombustivel = BigDecimal.ZERO;
        this.totSalarios = BigDecimal.ZERO;
    }


    public BigDecimal getCustoTotalMissao() {
        BigDecimal totalSalarios = BigDecimal.ZERO;
        BigDecimal totalCombustivel = BigDecimal.ZERO;

        for (Veiculo veiculo : this.veiculos) {
            totalSalarios = totalSalarios.add(veiculo.somaSalariotripulantes());
            BigDecimal gastoCombustivel = BigDecimal.valueOf(this.distanciaViagem / veiculo.getKmLitro()).multiply(veiculo.getPrecoLitro());
            totalCombustivel = totalCombustivel.add(gastoCombustivel);
        }

        this.totSalarios = totalSalarios.multiply(BigDecimal.valueOf(this.duracaoMissao));
        this.totCombustivel = totalCombustivel;
        return totalSalarios.multiply(BigDecimal.valueOf(this.duracaoMissao)).add(totalCombustivel).setScale(2, RoundingMode.HALF_UP);
    }


    public boolean todasTripulacoesValidas() {
        for (Veiculo veiculo : this.veiculos) {
            if (!(veiculo instanceof Tripulacao) || !((Tripulacao) veiculo).tripulacaoValida()) {
                return false;
            }
        }
        return true;
    }


    public BigDecimal getTotCombustivel() {
        return totCombustivel;
    }

    public BigDecimal getTotSalarios() {
        return totSalarios;
    }
}
