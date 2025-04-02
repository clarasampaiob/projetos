package militares;

import java.math.BigDecimal;
import java.time.LocalDate;

public class EspecialistaTerrestre extends Motoristas{

    private LocalDate validadeLicencaCaminhao;
    private LocalDate validadeLicencaTanque;

    public EspecialistaTerrestre(BigDecimal salario, LocalDate caminhao, LocalDate tanque) {
        super(salario);
        this.pilotaAviao = false;
        this.pilotaHelicoptero = false;
        this.validadeLicencaCaminhao = caminhao;
        this.validadeLicencaTanque = tanque;
    }

    public LocalDate getValidadeLicencaCaminhao() {
        return validadeLicencaCaminhao;
    }

    public LocalDate getValidadeLicencaTanque() {
        return validadeLicencaTanque;
    }
}
