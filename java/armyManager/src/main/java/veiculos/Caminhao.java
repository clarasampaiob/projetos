package veiculos;

import interfaces.Tripulacao;
import militares.*;

import java.math.BigDecimal;
import java.time.LocalDate;
import java.util.List;

public class Caminhao extends Veiculo implements Tripulacao {

    public Caminhao(Motoristas piloto, List<Militar> tripulacao, double kmLitro, BigDecimal precoLitro) {
        super(piloto, tripulacao, kmLitro, precoLitro);
    }


    @Override
    public boolean tripulacaoValida() {
        LocalDate hoje = LocalDate.now();
        boolean motoristaValido = false;

        if (this.piloto instanceof Elite) {
            Elite elite = (Elite) this.piloto;
            motoristaValido = (elite.getValidadeLicencaCaminhao().isAfter(hoje));
        }
        else if (this.piloto instanceof EspecialistaTerrestre) {
            EspecialistaTerrestre especialista = (EspecialistaTerrestre) this.piloto;
            motoristaValido = (especialista.getValidadeLicencaCaminhao().isAfter(hoje));
        }
        else if (this.piloto instanceof PilotoCaminhao) {
            PilotoCaminhao piloto = (PilotoCaminhao) this.piloto;
            motoristaValido = (piloto.getValidadeLicencaCaminhao().isAfter(hoje));
        }

        boolean tripulacaoValida = ((this.tripulacao.size() >= 5) && (this.tripulacao.size() <= 30));
        return motoristaValido && tripulacaoValida;
    }
}
