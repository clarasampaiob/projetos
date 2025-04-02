package militares;

import java.math.BigDecimal;
import java.time.LocalDate;

public class PilotoCaminhao extends Motoristas{

    private LocalDate validadeLicencaCaminhao;

    public PilotoCaminhao(BigDecimal salario, LocalDate caminhao) {
        super(salario);
        this.pilotaAviao = false;
        this.pilotaHelicoptero = false;
        this.pilotaTanque = false;
        this.validadeLicencaCaminhao = caminhao;
    }

    public LocalDate getValidadeLicencaCaminhao() {
        return validadeLicencaCaminhao;
    }
}
