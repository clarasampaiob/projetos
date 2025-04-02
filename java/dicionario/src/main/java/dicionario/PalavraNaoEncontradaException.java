package dicionario;

public class PalavraNaoEncontradaException extends RuntimeException {

    public PalavraNaoEncontradaException() {
      super("Palavra não encontrada");
    }

}
