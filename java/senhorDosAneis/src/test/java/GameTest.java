import excecoes.*;
import game.Mapa;
import game.Simulador;
import org.junit.Assert;
import org.junit.Test;
import personagens.*;

public class GameTest {

    @Test
    public void deveVencerSociedadeQuandoAragornELegolasBatalharemContraOrcEGoblim()
            throws PersonagemJaEstaNoMapaException, PosicaoOcupadaException, SauronDominaOMundoException, PersonagemNaoEncontradoNoMapaException {
        // Início:  "|A|L| | | | | |O| |M|"
        String resultadoEsperado = "| | | | |A| | | | |L|";

        Aragorn aragorn = new Aragorn();
        Legolas legolas = new Legolas();
        Orc orc = new Orc();
        Goblim goblim = new Goblim();
        Mapa mapa = new Mapa();
        Simulador simulador = new Simulador(mapa);

        mapa.inserir(0, aragorn);
        mapa.inserir(1, legolas);
        mapa.inserir(7, orc);
        mapa.inserir(9, goblim);
        simulador.simular();
        System.out.println(mapa.exibir());

        System.out.println("Aragorn: " + mapa.buscarPosicao(aragorn) + ". Legolas: " + mapa.buscarPosicao(legolas));
        Assert.assertEquals(4, mapa.buscarPosicao(aragorn));
        Assert.assertEquals(9, mapa.buscarPosicao(legolas));
    }


    @Test(expected = SauronDominaOMundoException.class)
    public void deveLancarSauronDominaOMundoExceptionQuandoInimigosDerrotaremMembrosDaSociedade()
            throws PersonagemJaEstaNoMapaException, PosicaoOcupadaException, SauronDominaOMundoException, PersonagemNaoEncontradoNoMapaException {
        // Início: "|A| |I| | | | |U|O|M|"
        // Fim:    "| | | | | | |O|M| | |"

        Aragorn aragorn = new Aragorn();
        Gimli gimli = new Gimli();
        Urukhai urukhai = new Urukhai();
        Orc orc = new Orc();
        Goblim goblim = new Goblim();
        Mapa mapa = new Mapa();
        Simulador simulador = new Simulador(mapa);

        mapa.inserir(0, aragorn);
        mapa.inserir(2, gimli);
        mapa.inserir(7, urukhai);
        mapa.inserir(8, orc);
        mapa.inserir(9, goblim);
        simulador.simular();

    }


    @Test
    public void deveVencerSociedadeQuandoGandalfBatalharSozinhoContraSaruman()
            throws PersonagemJaEstaNoMapaException, PosicaoOcupadaException, SauronDominaOMundoException, PersonagemNaoEncontradoNoMapaException {
        // Início:  "|G| | | | | | | | |S|"
        String resultadoEsperado = "| | | | | | | | | |G|";

        Gandalf gandalf = new Gandalf();
        Saruman saruman = new Saruman();
        Mapa mapa = new Mapa();
        Simulador simulador = new Simulador(mapa);

        mapa.inserir(0, gandalf);
        mapa.inserir(9, saruman);
        simulador.simular();
        System.out.println(mapa.exibir());

        System.out.println("Gandalf: " + mapa.buscarPosicao(gandalf));
        Assert.assertEquals(9, mapa.buscarPosicao(gandalf));
    }


    @Test(expected = SauronDominaOMundoException.class)
    public void deveLancarSauronDominaOMundoExceptionQuandoLegolasBatalharSozinhoContraOrcEUrukhai()
            throws PersonagemJaEstaNoMapaException, PosicaoOcupadaException, SauronDominaOMundoException, PersonagemNaoEncontradoNoMapaException {
        // Início:  "|L| | | | | | | |U|O|"
        // Fim:     "| | | | | |U| | | | |";

        Legolas legolas = new Legolas();
        Orc orc = new Orc();
        Urukhai urukhai = new Urukhai();
        Mapa mapa = new Mapa();
        Simulador simulador = new Simulador(mapa);

        mapa.inserir(0, legolas);
        mapa.inserir(8, urukhai);
        mapa.inserir(9, orc);
        simulador.simular();

    }

    @Test(expected = SauronDominaOMundoException.class)
    public void deveLancarSauronDominaOMundoExceptionQuandoBoromirBatalharSozinhoContraUrukhai()
            throws PersonagemJaEstaNoMapaException, PosicaoOcupadaException, SauronDominaOMundoException, PersonagemNaoEncontradoNoMapaException {
        // Início:  "|B| | | | | | | | |U|"
        // Fim:     "| | | | |U| | | | | |";

        Boromir boromir = new Boromir();
        Urukhai urukhai = new Urukhai();
        Mapa mapa = new Mapa();
        Simulador simulador = new Simulador(mapa);

        mapa.inserir(0, boromir);
        mapa.inserir(9, urukhai);
        simulador.simular();

    }


    @Test(expected = SauronDominaOMundoException.class)
    public void batalhaConstituicaoTeste100praTodos()
            throws PersonagemJaEstaNoMapaException, PosicaoOcupadaException, SauronDominaOMundoException, PersonagemNaoEncontradoNoMapaException {
        // Início:  "G |  | L | O |  |  |  | M |  | S |"
        // Fim:     "O |  |  |  |  |  |  |  |  | S |";

        Gandalf gandalf = new Gandalf();
        Legolas legolas = new Legolas();
        Saruman saruman = new Saruman();
        Orc orc = new Orc();
        Goblim goblim = new Goblim();

        // Constituição Teste
        gandalf.setConstituicaoTeste(100);
        legolas.setConstituicaoTeste(100);
        saruman.setConstituicaoTeste(100);
        orc.setConstituicaoTeste(100);
        goblim.setConstituicaoTeste(100);

        Mapa mapa = new Mapa();
        Simulador simulador = new Simulador(mapa);

        mapa.inserir(0, gandalf);
        mapa.inserir(2, legolas);
        mapa.inserir(3, orc);
        mapa.inserir(7, goblim);
        mapa.inserir(9, saruman);
        simulador.simular();

    }



    @Test
    public void instancias(){

        // PERSONAGENS
        Aragorn aragorn = new Aragorn();
        Legolas legolas = new Legolas();
        Orc orc = new Orc();
        Goblim goblim = new Goblim();
        Saruman saruman = new Saruman();
        Urukhai urukhai = new Urukhai();
        Gimli gimli = new Gimli();
        Gandalf gandalf = new Gandalf();
        Boromir boromir = new Boromir();

        aragorn.falar(); aragorn.envelhecer();
        boromir.falar(); boromir.envelhecer();
        urukhai.falar(); urukhai.envelhecer(); urukhai.grunir(); urukhai.getDanos();
        gandalf.falar(); gandalf.ressuscitar(); gandalf.getSociedade(); gandalf.setConstituicaoTeste(0);gandalf.ressuscitar();
        saruman.falar(); saruman.ressuscitar();
        legolas.falar(); legolas.falarElfico(); legolas.getSociedade();legolas.setConstituicao(100);legolas.setConstituicaoTeste(-2);
        goblim.falar(); goblim.grunir();
        orc.falar(); orc.grunir();
        gimli.falar(); gimli.beber(); gimli.beber(3); gimli.getSociedade(); gimli.beber(1);

        Assert.assertEquals(1, aragorn.getDanos());
        Assert.assertEquals(2, boromir.getDanos());
        Assert.assertEquals(null, saruman.ressuscitar());

    }

    @Test
    public void metodosMapa() throws PosicaoNaoExiste, PosicaoOcupadaException, PersonagemNaoEncontradoNoMapaException, PersonagemJaEstaNoMapaException {

        Mapa mapa = new Mapa();
        System.out.println(mapa.exibir());

        Gandalf gandalf = new Gandalf();
        Aragorn aragorn = new Aragorn();
        Orc orc = new Orc();
        Urukhai urukhai = new Urukhai();
        Saruman saruman = new Saruman();
        Goblim goblim = new Goblim();
        Legolas legolas = new Legolas();

        // INSERIR
        mapa.inserir(3, aragorn);
        mapa.inserir(7, urukhai);
        mapa.inserir(8, orc);


        // VERIFICAR SE POSIÇÃO ESTÁ LIVRE
        boolean ocupada = mapa.posicaoLivre(7);
        boolean livre = mapa.posicaoLivre(1);
        System.out.println("Posição 7 está livre? " + ocupada + ". Posição 1 está livre? " + livre);

        // BUSCAR POSIÇÃO PERSONAGEM
        int p1 = mapa.buscarPosicao(aragorn);
        int p2 = mapa.buscarPosicao(urukhai);
        int p3 = mapa.buscarPosicao(orc);
        System.out.println("Aragon Posição: " + p1 + ". Urukhai Posição: " + p2 + ". Orc Posição: " + p3);

        // PERSONAGEM NÃO ENCONTRADO NO MAPA - Gandalf
        Assert.assertThrows(PersonagemNaoEncontradoNoMapaException.class, () -> mapa.buscarPosicao(gandalf));
        System.out.println("Gandalf não foi encontrado");

        // EXCEPTIONS INSERÇÃO
        Assert.assertThrows(PersonagemJaEstaNoMapaException.class, () -> mapa.inserir(3, urukhai));
        System.out.println("Urukhai já está no Mapa");
        Assert.assertThrows(PosicaoOcupadaException.class, () -> mapa.inserir(7, gandalf));
        System.out.println("Gandalf não pode ir para a posição 7 pq já está ocupada pelo Urukhai");
        Assert.assertThrows(PosicaoNaoExiste.class, () -> mapa.inserir(10, gandalf));
        System.out.println("A posição 10 não existe no Mapa");

        // BUSCAR QUEM ESTÁ EM ALGUMA POSIÇÃO
        Personagem p4 = mapa.buscarCasa(8);
        System.out.println("O Personagem na posição 8 é: ");
        Assert.assertThrows(PersonagemNaoEstaNessaPosicao.class, () -> mapa.buscarCasa(9));
        System.out.println("Não há ninguém na posição 9");

    }


    @Test
    public void removerPersonagens(){

        Mapa mapa = new Mapa();

        Gandalf gandalf = new Gandalf();
        Aragorn aragorn = new Aragorn();
        Goblim goblim = new Goblim();
        Saruman saruman = new Saruman();

        mapa.inserir(2, gandalf);
        mapa.inserir(3, saruman);
        mapa.inserir(4, goblim);
        mapa.inserir(5, aragorn);
        System.out.println(mapa.exibir());

        for(int i = 0; i < 10; i++){
            if(!mapa.posicaoLivre(i)){
                System.out.println(i + " nao ta livre");
                mapa.removerPersonagem(i);
            }
        }

        System.out.println(mapa.exibir());
        Assert.assertTrue(mapa.mapaVazio());

    }


    @Test
    public void ataqueMagoComSociedade(){

        Mapa mapa = new Mapa();

        Gandalf gandalf = new Gandalf();
        Aragorn aragorn = new Aragorn();
        Goblim goblim = new Goblim();
        Saruman saruman = new Saruman();

        aragorn.setConstituicaoTeste(100);
        goblim.setConstituicaoTeste(100);
        saruman.setConstituicaoTeste(100);

        mapa.inserir(8, gandalf);
        mapa.inserir(0, saruman);
        mapa.inserir(3, goblim);
        mapa.inserir(7, aragorn);
        System.out.println(mapa.exibir());

        gandalf.atacar(mapa);
        System.out.println("Saruman: " + saruman.getConstituicao() + ". Goblim: " + goblim.getConstituicao() + ". Aragorn: " + aragorn.getConstituicao());
        Assert.assertEquals(90, saruman.getConstituicao());
        Assert.assertEquals(90, goblim.getConstituicao());
        Assert.assertEquals(100, aragorn.getConstituicao());

    }


    @Test
    public void ataqueMagoSemSociedade(){

        Mapa mapa = new Mapa();

        Gandalf gandalf = new Gandalf();
        Aragorn aragorn = new Aragorn();
        Goblim goblim = new Goblim();
        Saruman saruman = new Saruman();

        aragorn.setConstituicaoTeste(100);
        goblim.setConstituicaoTeste(100);
        gandalf.setConstituicaoTeste(100);

        mapa.inserir(8, gandalf);
        mapa.inserir(0, saruman);
        mapa.inserir(3, goblim);
        mapa.inserir(7, aragorn);
        System.out.println(mapa.exibir());

        saruman.atacar(mapa);
        System.out.println("Gandalf: " + gandalf.getConstituicao() + ". Goblim: " + goblim.getConstituicao() + ". Aragorn: " + aragorn.getConstituicao());
        Assert.assertEquals(91, gandalf.getConstituicao());
        Assert.assertEquals(100, goblim.getConstituicao());
        Assert.assertEquals(91, aragorn.getConstituicao());

    }


    @Test
    public void magoNaoAtaca(){

        Mapa mapa = new Mapa();

        Gandalf gandalf = new Gandalf();
        Saruman saruman = new Saruman();
        Aragorn aragorn = new Aragorn();
        Goblim goblim = new Goblim();

        mapa.inserir(1, gandalf);
        gandalf.atacar(mapa);
        mapa.inserir(3, aragorn);
        gandalf.atacar(mapa);
        Assert.assertEquals(60, aragorn.getConstituicao());

        mapa.removerPersonagem(1);
        mapa.removerPersonagem(3);
        mapa.inserir(6, saruman);
        saruman.atacar(mapa);
        mapa.inserir(1, goblim);
        saruman.atacar(mapa);
        Assert.assertEquals(20, goblim.getConstituicao());

    }


    @Test
    public void moverMagoDaSociedadeComFrenteLivre(){

        Mapa mapa = new Mapa();

        Gandalf gandalf = new Gandalf();
        mapa.inserir(8, gandalf);
        System.out.println(mapa.exibir());

        gandalf.move(mapa);
        System.out.println(mapa.exibir());
        Assert.assertEquals(9,mapa.buscarPosicao(gandalf));

        gandalf.move(mapa);
        System.out.println(mapa.exibir());
        Assert.assertEquals(0,mapa.buscarPosicao(gandalf));

    }


    @Test
    public void moverMagoSemSociedadeComFrenteLivre(){

        Mapa mapa = new Mapa();

        Saruman saruman = new Saruman();
        mapa.inserir(1, saruman);
        System.out.println(mapa.exibir());

        saruman.move(mapa);
        System.out.println(mapa.exibir());
        Assert.assertEquals(0,mapa.buscarPosicao(saruman));

        saruman.move(mapa);
        System.out.println(mapa.exibir());
        Assert.assertEquals(9,mapa.buscarPosicao(saruman));

    }


    @Test
    public void magosNaoPodemSeMover(){

        Mapa mapa = new Mapa();

        Gandalf gandalf = new Gandalf();
        Saruman saruman = new Saruman();
        mapa.inserir(8, gandalf);
        mapa.inserir(1, saruman);
        System.out.println(mapa.exibir());

        gandalf.move(mapa);
        saruman.move(mapa);
        System.out.println(mapa.exibir());
        Assert.assertEquals(8,mapa.buscarPosicao(gandalf));
        Assert.assertEquals(1,mapa.buscarPosicao(saruman));

    }


    @Test
    public void moverGuerreiroDaSociedadeComFrenteLivre(){

        Mapa mapa = new Mapa();

        Gandalf gandalf = new Gandalf();
        Aragorn aragorn = new Aragorn();
        Goblim goblim = new Goblim();

        mapa.inserir(8, aragorn);
        mapa.inserir(7, gandalf);
        mapa.inserir(5, goblim);
        System.out.println(mapa.exibir());

        aragorn.move(mapa);
        System.out.println(mapa.exibir());
        Assert.assertEquals(9,mapa.buscarPosicao(aragorn));

        aragorn.move(mapa);
        System.out.println(mapa.exibir());
        Assert.assertEquals(0,mapa.buscarPosicao(aragorn));

    }


    @Test
    public void moverGuerreiroSemSociedadeComFrenteLivre(){

        Mapa mapa = new Mapa();

        Gandalf gandalf = new Gandalf();
        Urukhai urukhai = new Urukhai();
        Goblim goblim = new Goblim();

        mapa.inserir(1, urukhai);
        mapa.inserir(2, gandalf);
        mapa.inserir(8, goblim);
        System.out.println(mapa.exibir());

        urukhai.move(mapa);
        System.out.println(mapa.exibir());
        Assert.assertEquals(0,mapa.buscarPosicao(urukhai));

        urukhai.move(mapa);
        System.out.println(mapa.exibir());
        Assert.assertEquals(9,mapa.buscarPosicao(urukhai));

    }


    @Test
    public void GuerreirosNaoPodemSeMover(){

        Mapa mapa = new Mapa();

        Gandalf gandalf = new Gandalf();
        Aragorn aragorn = new Aragorn();
        Goblim goblim = new Goblim();
        Urukhai urukhai = new Urukhai();

        mapa.inserir(5, aragorn);
        mapa.inserir(6, gandalf);
        mapa.inserir(0, goblim);
        mapa.inserir(1, urukhai);
        System.out.println(mapa.exibir());

        aragorn.move(mapa);
        urukhai.move(mapa);
        System.out.println(mapa.exibir());
        Assert.assertEquals(5,mapa.buscarPosicao(aragorn));
        Assert.assertEquals(1,mapa.buscarPosicao(urukhai));

    }



    @Test
    public void ataqueGuerreiroComSociedade(){

        Mapa mapa = new Mapa();

        Goblim goblim = new Goblim();
        Boromir boromir = new Boromir();
        Orc orc = new Orc();
        Aragorn aragorn = new Aragorn();

        mapa.inserir(0, goblim);
        mapa.inserir(9, boromir);
        mapa.inserir(3, orc);
        mapa.inserir(2, aragorn);
        System.out.println(mapa.exibir());

        System.out.println("Constituição Goblim: " + goblim.getConstituicao());
        boromir.atacar(mapa);
        System.out.println("Constituição Goblim: " + goblim.getConstituicao());

        System.out.println("Constituição Orc: " + orc.getConstituicao());
        aragorn.atacar(mapa);
        System.out.println("Constituição Orc: " + orc.getConstituicao());

        Assert.assertEquals(6, goblim.getConstituicao());
        Assert.assertEquals(10, orc.getConstituicao());
    }


    @Test
    public void ataqueGuerreiroSemSociedade(){

        Mapa mapa = new Mapa();

        Orc orc = new Orc();
        Boromir boromir = new Boromir();
        Legolas legolas = new Legolas();
        Urukhai urukhai = new Urukhai();

        mapa.inserir(5, orc);
        mapa.inserir(4, boromir);
        mapa.inserir(0, urukhai);
        mapa.inserir(9, legolas);
        System.out.println(mapa.exibir());

        System.out.println("Constituição Boromir: " + boromir.getConstituicao());
        orc.atacar(mapa);
        System.out.println("Constituição Boromir: " + boromir.getConstituicao());

        System.out.println("Constituição Legolas: " + legolas.getConstituicao());
        urukhai.atacar(mapa);
        System.out.println("Constituição Legolas: " + legolas.getConstituicao());

        Assert.assertEquals(26, boromir.getConstituicao());
        Assert.assertEquals(64, legolas.getConstituicao());

    }


    @Test
    public void guerreiroNaoAtaca(){

        Mapa mapa = new Mapa();

        Orc orc = new Orc();
        Goblim goblim = new Goblim();
        Boromir boromir = new Boromir();
        Legolas legolas = new Legolas();

        mapa.inserir(5, orc);
        mapa.inserir(4, goblim);
        mapa.inserir(8, boromir);
        mapa.inserir(9, legolas);
        System.out.println(mapa.exibir());

        System.out.println("Constituição Boromir: " + goblim.getConstituicao());
        orc.atacar(mapa);
        System.out.println("Constituição Boromir: " + goblim.getConstituicao());

        System.out.println("Constituição Boromir: " + legolas.getConstituicao());
        boromir.atacar(mapa);
        System.out.println("Constituição Boromir: " + legolas.getConstituicao());

        Assert.assertEquals(80, legolas.getConstituicao());
        Assert.assertEquals(20, goblim.getConstituicao());

        mapa.removerPersonagem(5);
        mapa.removerPersonagem(4);
        mapa.removerPersonagem(8);
        boromir.atacar(mapa);
        System.out.println(mapa.exibir());
        mapa.removerPersonagem(9);
        mapa.inserir(5, orc);
        orc.atacar(mapa);
        System.out.println(mapa.exibir());

    }


    @Test
    public void ataqueArqueiroComSociedade(){

        Mapa mapa = new Mapa();

        Orc orc = new Orc();
        Goblim goblim = new Goblim();
        Urukhai urukhai = new Urukhai();
        Saruman saruman = new Saruman();
        Legolas legolas = new Legolas();

        mapa.inserir(8, orc);
        mapa.inserir(9, goblim);
        mapa.inserir(0, saruman);
        mapa.inserir(7, legolas);
        System.out.println(mapa.exibir());

        legolas.atacar(mapa);
        System.out.println("Saruman será atacado. Constituição: 70. Constituição Final: " + saruman.getConstituicao());
        Assert.assertEquals(70 - (3*10), saruman.getConstituicao());

        mapa.removerPersonagem(0);
        System.out.println(mapa.exibir());
        legolas.atacar(mapa);
        System.out.println("Goblim será atacado. Constituição: 20. Constituição Final: " + goblim.getConstituicao());
        Assert.assertEquals(20 - (2*10), goblim.getConstituicao());

        mapa.removerPersonagem(9);
        System.out.println(mapa.exibir());
        legolas.atacar(mapa);
        System.out.println("Orc será atacado. Constituição: 30. Constituição Final: " + orc.getConstituicao());
        Assert.assertEquals(30 - 10, orc.getConstituicao());

        mapa.inserir(0, saruman);
        System.out.println(mapa.exibir());
        legolas.atacar(mapa);
        System.out.println("Saruman será atacado. Constituição: 40. Constituição Final: " + saruman.getConstituicao());
        Assert.assertEquals(40 - (3*10), saruman.getConstituicao());

        mapa.removerPersonagem(8);
        mapa.inserir(9, urukhai);
        System.out.println(mapa.exibir());
        legolas.atacar(mapa);
        System.out.println("Saruman será atacado. Constituição: 10. Constituição Final: " + saruman.getConstituicao());
        Assert.assertEquals(0, saruman.getConstituicao());

        mapa.removerPersonagem(0);
        System.out.println(mapa.exibir());
        legolas.atacar(mapa);
        System.out.println("urukhai será atacado. Constituição: 45. Constituição Final: " + urukhai.getConstituicao());
        Assert.assertEquals(45 - (2*10), urukhai.getConstituicao());

        mapa.removerPersonagem(9);
        mapa.inserir(0, urukhai);
        System.out.println(mapa.exibir());
        legolas.atacar(mapa);
        System.out.println("urukhai será atacado. Constituição: 25. Constituição Final: " + urukhai.getConstituicao());
        Assert.assertEquals(0, urukhai.getConstituicao());

        saruman.setConstituicaoTeste(100);
        orc.setConstituicaoTeste(100);
        urukhai.setConstituicaoTeste(100);
        goblim.setConstituicaoTeste(100);
        mapa.removerPersonagem(0);

        mapa.removerPersonagem(7);
        mapa.inserir(2, urukhai);
        mapa.inserir(1, orc);
        mapa.inserir(0, goblim);
        mapa.inserir(9, saruman);
        mapa.inserir(8, legolas);
        System.out.println(mapa.exibir());
        legolas.atacar(mapa);
        System.out.println("Orc será atacado. Constituição: 100. Constituição Final: " + orc.getConstituicao());
        Assert.assertEquals(100 - (3*10), orc.getConstituicao());

        mapa.removerPersonagem(1);
        System.out.println(mapa.exibir());
        legolas.atacar(mapa);
        System.out.println("Goblim será atacado. Constituição: 100. Constituição Final: " + goblim.getConstituicao());
        Assert.assertEquals(100 - (2*10), goblim.getConstituicao());

        mapa.removerPersonagem(8);
        mapa.removerPersonagem(9);
        mapa.inserir(3, saruman);
        mapa.inserir(9, legolas);
        System.out.println(mapa.exibir());
        legolas.atacar(mapa);
        System.out.println("Urukhai será atacado. Constituição: 100. Constituição Final: " + urukhai.getConstituicao());
        Assert.assertEquals(100 - (3*10), urukhai.getConstituicao());

        mapa.removerPersonagem(7);
        mapa.removerPersonagem(2);
        mapa.removerPersonagem(1);
        mapa.removerPersonagem(0);
        mapa.removerPersonagem(9);
        mapa.removerPersonagem(8);
        mapa.removerPersonagem(3);
        System.out.println(mapa.exibir());

        mapa.inserir(0, urukhai);
        mapa.inserir(9, orc);
        mapa.inserir(8, goblim);
        mapa.inserir(7, saruman);
        mapa.inserir(6, legolas);
        System.out.println(mapa.exibir());
        legolas.atacar(mapa);
        System.out.println("Orc será atacado. Constituição: 70. Constituição Final: " + orc.getConstituicao());
        Assert.assertEquals(70 - (3*10), orc.getConstituicao());

    }


    @Test
    public void ataqueArqueiroSemSociedade(){

        Mapa mapa = new Mapa();

        Legolas legolas = new Legolas();
        Aragorn aragorn = new Aragorn();
        Gandalf gandalf = new Gandalf();
        Goblim goblim = new Goblim();

        legolas.setConstituicaoTeste(200);
        aragorn.setConstituicaoTeste(200);
        gandalf.setConstituicaoTeste(200);

        mapa.inserir(0, legolas);
        mapa.inserir(1, aragorn);
        mapa.inserir(2, gandalf);
        mapa.inserir(3, goblim);
        System.out.println(mapa.exibir());

        goblim.atacar(mapa);
        System.out.println("Legolas será atacado. Constituição: 200. Constituição Final: " + legolas.getConstituicao());
        Assert.assertEquals(200 - (3*6), legolas.getConstituicao());

        mapa.removerPersonagem(0);
        System.out.println(mapa.exibir());
        goblim.atacar(mapa);
        System.out.println("Aragorn será atacado. Constituição: 200. Constituição Final: " + aragorn.getConstituicao());
        Assert.assertEquals(200 - (2*6), aragorn.getConstituicao());

        mapa.removerPersonagem(1);
        System.out.println(mapa.exibir());
        goblim.atacar(mapa);
        System.out.println("Gandalf será atacado. Constituição: 200. Constituição Final: " + gandalf.getConstituicao());
        Assert.assertEquals(200 - 6, gandalf.getConstituicao());

        mapa.removerPersonagem(3);
        mapa.removerPersonagem(2);
        mapa.inserir(9, legolas);
        mapa.inserir(0, aragorn);
        mapa.inserir(1, gandalf);
        mapa.inserir(2, goblim);
        System.out.println(mapa.exibir());

        goblim.atacar(mapa);
        System.out.println("Legolas será atacado. Constituição: 182. Constituição Final: " + legolas.getConstituicao());
        Assert.assertEquals(182 - (3*6), legolas.getConstituicao());

        mapa.removerPersonagem(9);
        System.out.println(mapa.exibir());
        goblim.atacar(mapa);
        System.out.println("Aragorn será atacado. Constituição: 188. Constituição Final: " + aragorn.getConstituicao());
        Assert.assertEquals(188 - (2*6), aragorn.getConstituicao());

        mapa.removerPersonagem(0);
        System.out.println(mapa.exibir());
        goblim.atacar(mapa);
        System.out.println("Gandalf será atacado. Constituição: 194. Constituição Final: " + gandalf.getConstituicao());
        Assert.assertEquals(194 - 6, gandalf.getConstituicao());

        mapa.removerPersonagem(1);
        mapa.removerPersonagem(2);
        mapa.inserir(9, legolas);
        mapa.inserir(0, aragorn);
        mapa.inserir(8, gandalf);
        mapa.inserir(1, goblim);
        System.out.println(mapa.exibir());

        goblim.atacar(mapa);
        System.out.println("Gandalf será atacado. Constituição: 188. Constituição Final: " + gandalf.getConstituicao());
        Assert.assertEquals(188 - (3*6), gandalf.getConstituicao());

        mapa.removerPersonagem(0);
        mapa.removerPersonagem(1);
        mapa.inserir(0, goblim);
        System.out.println(mapa.exibir());
        goblim.atacar(mapa);
        System.out.println("Gandalf será atacado. Constituição: 170. Constituição Final: " + gandalf.getConstituicao());
        Assert.assertEquals(170 - (2*6), gandalf.getConstituicao());

        mapa.removerPersonagem(0);
        mapa.removerPersonagem(9);
        mapa.inserir(9, goblim);
        mapa.inserir(6, legolas);
        System.out.println(mapa.exibir());
        goblim.atacar(mapa);
        System.out.println("Legolas será atacado. Constituição: 164. Constituição Final: " + legolas.getConstituicao());
        Assert.assertEquals(164 - (3*6), legolas.getConstituicao());
    }


    @Test
    public void arqueirosNaoAtacam(){

        Mapa mapa = new Mapa();

        Gandalf gandalf = new Gandalf();
        Legolas legolas = new Legolas();
        Goblim goblim = new Goblim();
        Urukhai urukhai = new Urukhai();

        gandalf.setConstituicaoTeste(100);
        urukhai.setConstituicaoTeste(100);
        legolas.setConstituicaoTeste(100);
        goblim.setConstituicaoTeste(100);

        mapa.inserir(6, gandalf);
        mapa.inserir(4, legolas);
        System.out.println(mapa.exibir());
        legolas.atacar(mapa);

        mapa.inserir(0, goblim);
        mapa.inserir(9, urukhai);
        System.out.println(mapa.exibir());
        goblim.atacar(mapa);

        Assert.assertEquals(100, urukhai.getConstituicao());
        Assert.assertEquals(100, gandalf.getConstituicao());
        Assert.assertEquals(100, legolas.getConstituicao());
        Assert.assertEquals(100, goblim.getConstituicao());

        mapa.removerPersonagem(9);
        mapa.removerPersonagem(6);
        mapa.removerPersonagem(4);
        System.out.println(mapa.exibir());
        goblim.atacar(mapa);
        mapa.removerPersonagem(0);
        mapa.inserir(5, legolas);
        legolas.atacar(mapa);
        System.out.println(mapa.exibir());

    }


    @Test
    public void arqueiroComSociedadeSeMove(){

        Mapa mapa = new Mapa();

        Gandalf gandalf = new Gandalf();
        Legolas legolas = new Legolas();

        mapa.inserir(6, gandalf);
        mapa.inserir(0, legolas);

        System.out.println(mapa.exibir());
        legolas.move(mapa);
        System.out.println(mapa.exibir());
        System.out.println("----------------");
        Assert.assertEquals(2, mapa.buscarPosicao(legolas));

        mapa.removerPersonagem(2);
        mapa.inserir(7, legolas);
        System.out.println(mapa.exibir());
        legolas.move(mapa);
        System.out.println(mapa.exibir());
        System.out.println("----------------");
        Assert.assertEquals(9, mapa.buscarPosicao(legolas));

        mapa.removerPersonagem(9);
        mapa.inserir(8, legolas);
        System.out.println(mapa.exibir());
        legolas.move(mapa);
        System.out.println(mapa.exibir());
        System.out.println("----------------");
        Assert.assertEquals(0, mapa.buscarPosicao(legolas));

        mapa.removerPersonagem(0);
        mapa.inserir(9, legolas);
        System.out.println(mapa.exibir());
        legolas.move(mapa);
        System.out.println(mapa.exibir());
        System.out.println("----------------");
        Assert.assertEquals(1, mapa.buscarPosicao(legolas));

        mapa.removerPersonagem(1);
        mapa.removerPersonagem(6);
        mapa.inserir(9, gandalf);
        mapa.inserir(7, legolas);
        System.out.println(mapa.exibir());
        legolas.move(mapa);
        System.out.println(mapa.exibir());
        System.out.println("----------------");
        Assert.assertEquals(8, mapa.buscarPosicao(legolas));

        mapa.removerPersonagem(9);
        mapa.inserir(0, gandalf);
        System.out.println(mapa.exibir());
        legolas.move(mapa);
        System.out.println(mapa.exibir());
        System.out.println("----------------");
        Assert.assertEquals(9, mapa.buscarPosicao(legolas));

        mapa.removerPersonagem(0);
        mapa.inserir(1, gandalf);
        System.out.println(mapa.exibir());
        legolas.move(mapa);
        System.out.println(mapa.exibir());
        System.out.println("----------------");
        Assert.assertEquals(0, mapa.buscarPosicao(legolas));

    }


    @Test
    public void arqueiroSemSociedadeSeMove(){

        Mapa mapa = new Mapa();

        Gandalf gandalf = new Gandalf();
        Goblim goblim = new Goblim();

        mapa.inserir(0, gandalf);
        mapa.inserir(3, goblim);

        System.out.println(mapa.exibir());
        goblim.move(mapa);
        System.out.println(mapa.exibir());
        System.out.println("----------------");
        Assert.assertEquals(1, mapa.buscarPosicao(goblim));

        mapa.removerPersonagem(0);
        mapa.inserir(8, gandalf);
        System.out.println(mapa.exibir());
        goblim.move(mapa);
        System.out.println(mapa.exibir());
        System.out.println("----------------");
        Assert.assertEquals(9, mapa.buscarPosicao(goblim));

        mapa.removerPersonagem(9);
        mapa.removerPersonagem(8);
        mapa.inserir(0, goblim);
        mapa.inserir(7, gandalf);
        System.out.println(mapa.exibir());
        goblim.move(mapa);
        System.out.println(mapa.exibir());
        System.out.println("----------------");
        Assert.assertEquals(8, mapa.buscarPosicao(goblim));

        mapa.removerPersonagem(7);
        mapa.removerPersonagem(8);
        mapa.inserir(2, goblim);
        mapa.inserir(9, gandalf);
        System.out.println(mapa.exibir());
        goblim.move(mapa);
        System.out.println(mapa.exibir());
        System.out.println("----------------");
        Assert.assertEquals(0, mapa.buscarPosicao(goblim));

        mapa.removerPersonagem(0);
        mapa.removerPersonagem(9);
        mapa.inserir(2, goblim);
        mapa.inserir(0, gandalf);
        System.out.println(mapa.exibir());
        goblim.move(mapa);
        System.out.println(mapa.exibir());
        System.out.println("----------------");
        Assert.assertEquals(1, mapa.buscarPosicao(goblim));

        mapa.removerPersonagem(0);
        mapa.inserir(9, gandalf);
        System.out.println(mapa.exibir());
        goblim.move(mapa);
        System.out.println(mapa.exibir());
        System.out.println("----------------");
        Assert.assertEquals(0, mapa.buscarPosicao(goblim));

        mapa.removerPersonagem(9);
        mapa.inserir(8, gandalf);
        System.out.println(mapa.exibir());
        goblim.move(mapa);
        System.out.println(mapa.exibir());
        System.out.println("----------------");
        Assert.assertEquals(9, mapa.buscarPosicao(goblim));

    }



    @Test
    public void encontrarPersonagem() throws PosicaoNaoExiste, PersonagemNaoEstaNessaPosicao, PosicaoOcupadaException, PersonagemNaoEncontradoNoMapaException, PersonagemJaEstaNoMapaException {

        Urukhai urukhai = new Urukhai();
        Gandalf gandalf = new Gandalf();
        Boromir boromir = new Boromir();

        Mapa mapa = new Mapa();
        mapa.inserir(7, urukhai);
        mapa.inserir(3, gandalf);
        mapa.inserir(0, boromir);

        Personagem presente = mapa.buscarCasa(7);
        String m = mapa.exibir();
        System.out.println(m);
        System.out.println("Quem está na posição 7 é: " + presente);

        Assert.assertEquals("U", presente.toString());
    }



    @Test
    public void naoEncontrarPersonagem() throws PosicaoNaoExiste, PersonagemNaoEstaNessaPosicao, PosicaoOcupadaException, PersonagemNaoEncontradoNoMapaException, PersonagemJaEstaNoMapaException {

        Urukhai urukhai = new Urukhai();

        Mapa mapa = new Mapa();
        mapa.inserir(7, urukhai);

        String m = mapa.exibir();
        System.out.println(m);
        System.out.println("Urukhai não está na Posição 3, ele está na " + mapa.buscarPosicao(urukhai));

        Assert.assertThrows(PersonagemNaoEstaNessaPosicao.class, () -> mapa.buscarCasa(3));

    }


}


