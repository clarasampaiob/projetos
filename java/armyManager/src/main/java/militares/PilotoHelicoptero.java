package militares;

import java.math.BigDecimal;
import java.time.LocalDate;

public class PilotoHelicoptero extends Motoristas{

    private LocalDate validadeLicencaHelicoptero;

    public PilotoHelicoptero(BigDecimal salario, LocalDate helicoptero) {
        super(salario);
        this.pilotaAviao = false;
        this.pilotaCaminhao = false;
        this.pilotaTanque = false;
        this.validadeLicencaHelicoptero = helicoptero;
    }

    public LocalDate getValidadeLicencaHelicoptero() {
        return validadeLicencaHelicoptero;
    }
}
