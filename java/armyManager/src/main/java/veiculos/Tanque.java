package veiculos;

import interfaces.Tripulacao;
import militares.*;

import java.math.BigDecimal;
import java.time.LocalDate;
import java.util.List;

public class Tanque extends Veiculo implements Tripulacao {

    public Tanque(Motoristas piloto, List<Militar> tripulacao, double kmLitro, BigDecimal precoLitro) {
        super(piloto, tripulacao, kmLitro, precoLitro);
    }


    @Override
    public boolean tripulacaoValida() {
        LocalDate hoje = LocalDate.now();
        boolean motoristaValido = false;

        if (this.piloto instanceof Elite) {
            Elite elite = (Elite) this.piloto;
            motoristaValido = (elite.getValidadeLicencaTanque().isAfter(hoje));
        }
        else if (this.piloto instanceof EspecialistaTerrestre) {
            EspecialistaTerrestre especialista = (EspecialistaTerrestre) this.piloto;
            motoristaValido = (especialista.getValidadeLicencaTanque().isAfter(hoje));
        }
        else if (this.piloto instanceof PilotoTanque) {
            PilotoTanque piloto = (PilotoTanque) this.piloto;
            motoristaValido = (piloto.getValidadeLicencaTanque().isAfter(hoje));
        }

        boolean tripulacaoValida =  (tripulacao.size() == 3);
        return motoristaValido && tripulacaoValida;
    }
}
