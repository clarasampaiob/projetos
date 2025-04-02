package militares;

import java.math.BigDecimal;
import java.time.LocalDate;

public class PilotoTanque extends Motoristas{

    private LocalDate validadeLicencaTanque;

    public PilotoTanque(BigDecimal salario, LocalDate tanque) {
        super(salario);
        this.pilotaAviao = false;
        this.pilotaCaminhao = false;
        this.pilotaHelicoptero = false;
        this.validadeLicencaTanque = tanque;
    }

    public LocalDate getValidadeLicencaTanque() {
        return validadeLicencaTanque;
    }
}
