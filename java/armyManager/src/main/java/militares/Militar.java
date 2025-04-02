package militares;

import java.math.BigDecimal;

public class Militar {

    protected BigDecimal salario;

    public Militar(BigDecimal salario) {
        this.salario = salario;
    }

    public BigDecimal getSalario() {
        return salario;
    }

    public void setSalario(BigDecimal salario) {
        this.salario = salario;
    }
}
