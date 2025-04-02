package excecoes;

public class PersonagemNaoEncontradoNoMapaException extends RuntimeException {

    public PersonagemNaoEncontradoNoMapaException() {
        super("Personagem não encontrado no Mapa");
    }
}
