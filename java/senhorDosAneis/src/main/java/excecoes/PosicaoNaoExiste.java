package excecoes;

public class PosicaoNaoExiste extends RuntimeException {

    public PosicaoNaoExiste() {
        super("Essa posição não existe");
    }
}
