package negociacao;

import clube.Clube;
import jogador.Jogador;

import java.math.BigDecimal;

public class Negociacao {

    public boolean negociar(Clube clube, Jogador jogador){
        boolean interessado = jogador.interessadoClube(clube);
        BigDecimal valorCompra = jogador.valorCompra();
        BigDecimal saldo = clube.getSaldo();

        if((interessado) && (saldo.compareTo(valorCompra) >= 0)) {
            jogador.transferencia(clube);
            clube.setSaldo(saldo.subtract(valorCompra));
            return true;
        }

        return false;
    }

}
