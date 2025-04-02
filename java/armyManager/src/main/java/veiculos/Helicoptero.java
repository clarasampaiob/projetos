package veiculos;

import interfaces.Tripulacao;
import militares.*;

import java.math.BigDecimal;
import java.time.LocalDate;
import java.util.List;

public class Helicoptero extends Veiculo implements Tripulacao {

    public Helicoptero(Motoristas piloto, List<Militar> tripulacao, double kmLitro, BigDecimal precoLitro) {
        super(piloto, tripulacao, kmLitro, precoLitro);
    }

    @Override
    public boolean tripulacaoValida() {
        LocalDate hoje = LocalDate.now();
        boolean motoristaValido = false;

        if (this.piloto instanceof Elite) {
            Elite elite = (Elite) this.piloto;
            motoristaValido = (elite.getValidadeLicencaHelicoptero().isAfter(hoje));
        }
        else if (this.piloto instanceof EspecialistaAr) {
            EspecialistaAr especialista = (EspecialistaAr) this.piloto;
            motoristaValido = (especialista.getValidadeLicencaHelicoptero().isAfter(hoje));
        }
        else if (this.piloto instanceof PilotoHelicoptero) {
            PilotoHelicoptero piloto = (PilotoHelicoptero) this.piloto;
            motoristaValido = (piloto.getValidadeLicencaHelicoptero().isAfter(hoje));
        }

        boolean tripulacaoValida = ((!this.tripulacao.isEmpty()) && (this.tripulacao.size() <= 10));
        return motoristaValido && tripulacaoValida;
    }
}
