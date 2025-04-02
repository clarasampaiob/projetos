package militares;

import java.math.BigDecimal;

public class Motoristas extends Militar{

    protected boolean pilotaAviao;
    protected boolean pilotaHelicoptero;
    protected boolean pilotaCaminhao;
    protected boolean pilotaTanque;

    public Motoristas(BigDecimal salario) {
        super(salario);
        this.pilotaAviao = true;
        this.pilotaHelicoptero = true;
        this.pilotaCaminhao = true;
        this.pilotaTanque = true;
    }

}
