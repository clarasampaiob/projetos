package militares;

import java.math.BigDecimal;
import java.time.LocalDate;

public class PilotoAviao extends Motoristas{

    private LocalDate validadeLicencaAviao;

    public PilotoAviao(BigDecimal salario, LocalDate aviao) {
        super(salario);
        this.pilotaCaminhao = false;
        this.pilotaHelicoptero = false;
        this.pilotaTanque = false;
        this.validadeLicencaAviao = aviao;
    }

    public LocalDate getValidadeLicencaAviao() {
        return validadeLicencaAviao;
    }
}
