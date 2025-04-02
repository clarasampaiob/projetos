package excecoes;

public class PersonagemNaoEstaNessaPosicao extends RuntimeException {

  public PersonagemNaoEstaNessaPosicao() {
    super("Não há ninguém aqui!");
    }
}
