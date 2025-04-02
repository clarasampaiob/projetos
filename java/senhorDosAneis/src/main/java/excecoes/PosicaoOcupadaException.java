package excecoes;

public class PosicaoOcupadaException extends RuntimeException {

    public PosicaoOcupadaException() {
        super("Essa posição já está ocupada!");
    }

}
