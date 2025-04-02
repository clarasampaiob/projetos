package excecoes;

public class PersonagemJaEstaNoMapaException extends RuntimeException {

    public PersonagemJaEstaNoMapaException() {
      super("Esse personagem já está no mapa!");
    }
}
