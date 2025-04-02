package militares;

import java.math.BigDecimal;
import java.time.LocalDate;

public class EspecialistaAr extends Motoristas{

    private LocalDate validadeLicencaAviao;
    private LocalDate validadeLicencaHelicoptero;

    public EspecialistaAr(BigDecimal salario, LocalDate validadeLicencaAviao, LocalDate validadeLicencaHelicoptero) {
        super(salario);
        this.pilotaCaminhao = false;
        this.pilotaTanque = false;
        this.validadeLicencaHelicoptero = validadeLicencaHelicoptero;
        this.validadeLicencaAviao = validadeLicencaAviao;
    }

    public LocalDate getValidadeLicencaAviao() {
        return validadeLicencaAviao;
    }

    public LocalDate getValidadeLicencaHelicoptero() {
        return validadeLicencaHelicoptero;
    }
}
