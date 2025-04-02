package veiculos;

import interfaces.Tripulacao;
import militares.*;

import java.math.BigDecimal;
import java.time.LocalDate;
import java.util.List;

public class Aviao extends Veiculo implements Tripulacao {

    public Aviao(Motoristas piloto, List<Militar> tripulacao, double kmLitro, BigDecimal precoLitro) {
        super(piloto, tripulacao, kmLitro, precoLitro);
    }


    @Override
    public boolean tripulacaoValida() {
        LocalDate hoje = LocalDate.now();
        boolean motoristaValido = false;

        if (this.piloto instanceof Elite) {
            Elite elite = (Elite) this.piloto;
            motoristaValido = (elite.getValidadeLicencaAviao().isAfter(hoje));
        }
        else if (this.piloto instanceof EspecialistaAr) {
            EspecialistaAr especialista = (EspecialistaAr) this.piloto;
            motoristaValido = (especialista.getValidadeLicencaAviao().isAfter(hoje));
        }
        else if (this.piloto instanceof PilotoAviao) {
            PilotoAviao piloto = (PilotoAviao) this.piloto;
            motoristaValido = (piloto.getValidadeLicencaAviao().isAfter(hoje));
        }

        boolean tripulacaoValida = (this.tripulacao.size() == 1);
        return motoristaValido && tripulacaoValida;
    }

}
