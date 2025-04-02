package militares;

import java.math.BigDecimal;
import java.time.LocalDate;

public class Elite extends Motoristas{

    private LocalDate validadeLicencaAviao;
    private LocalDate validadeLicencaHelicoptero;
    private LocalDate validadeLicencaCaminhao;
    private LocalDate validadeLicencaTanque;

    public Elite(BigDecimal salario, LocalDate validadeLicencaAviao, LocalDate validadeLicencaHelicoptero, LocalDate validadeLicencaCaminhao, LocalDate validadeLicencaTanque) {
        super(salario);
        this.validadeLicencaAviao = validadeLicencaAviao;
        this.validadeLicencaHelicoptero = validadeLicencaHelicoptero;
        this.validadeLicencaCaminhao = validadeLicencaCaminhao;
        this.validadeLicencaTanque = validadeLicencaTanque;
    }

    public LocalDate getValidadeLicencaAviao() {
        return this.validadeLicencaAviao;
    }

    public LocalDate getValidadeLicencaHelicoptero() {
        return this.validadeLicencaHelicoptero;
    }

    public LocalDate getValidadeLicencaCaminhao() {
        return this.validadeLicencaCaminhao;
    }

    public LocalDate getValidadeLicencaTanque() {
        return this.validadeLicencaTanque;
    }
}
