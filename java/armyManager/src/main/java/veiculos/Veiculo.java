package veiculos;

import militares.*;

import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.List;

public class Veiculo {

    protected Motoristas piloto;
    protected List<Militar> tripulacao = new ArrayList<>();
    protected double kmLitro;
    protected BigDecimal precoLitro;

    public Veiculo(Motoristas piloto, List<Militar> tripulacao, double kmLitro, BigDecimal precoLitro) {
        this.piloto = piloto;
        this.tripulacao = tripulacao;
        this.kmLitro = kmLitro;
        this.precoLitro = precoLitro;
    }

    public BigDecimal somaSalariotripulantes() {
        BigDecimal somaSalario = BigDecimal.ZERO;

        for (Militar membro : this.tripulacao) {
            somaSalario = somaSalario.add(membro.getSalario());
        }

        somaSalario = somaSalario.add(this.piloto.getSalario());

        return somaSalario;
    }


    public double getKmLitro() {
        return kmLitro;
    }

    public BigDecimal getPrecoLitro() {
        return precoLitro;
    }
}
