import calculadora.Calculadora;
import org.junit.Assert;
import org.junit.Test;


public class CalculosTest {

    @Test
    public void deveSomarCorretamenteQuandoOsValoresForemInteiros(){

        // DADOS
        int n1 = 9;
        int n2 = 4;
        double resposta = 13;
        double resultado = 0;

        // PROCESSOS
        Calculadora obj = new Calculadora();
        resultado = obj.soma(n1, n2);

        // ASSERT
        Assert.assertEquals(resposta, resultado, 0.01);
        System.out.println("A soma dos números " + n1 + " e " + n2 + " é: " + resultado);

    }



    @Test
    public void deveMultiplicarCorretamenteQuandoNumerosForemInteiros(){

        // DADOS
        int n1 = 8;
        int n2 = 5;
        double resposta = 40;
        double resultado = 0;

        // PROCESSOS
        Calculadora obj = new Calculadora();
        resultado = obj.multiplicacao(n1, n2);

        // ASSERT
        Assert.assertEquals(resposta, resultado, 0.01);
        System.out.println("A multiplicação do número " + n1 + " por " + n2 + " é: " + resultado);

        

    }



    @Test
    public void deveDividirCorretamenteQuandoNumerosForemInteiros(){

        // DADOS
        int n1 = 10;
        int n2 = 4;
        double resposta = 2.5;
        double resultado = 0;

        // PROCESSOS
        Calculadora obj = new Calculadora();
        resultado = obj.divisao(n1, n2);

        // ASSERT
        Assert.assertEquals(resposta, resultado, 0.01);
        System.out.println("A divisão do número " + n1 + " por " + n2 + " é: " + resultado);

        

    }



    @Test
    public void deveDividirCorretamenteQuandoNumerosPossuemPontosFlutuantes(){

        // DADOS
        double n1 = 14.5;
        double n2 = 2.5;
        double resposta = 5.8;
        double resultado = 0;

        // PROCESSOS
        Calculadora obj = new Calculadora();
        resultado = obj.divisao(n1, n2);

        // ASSERT
        Assert.assertEquals(resposta, resultado, 0.01);
        System.out.println("A divisão do número " + n1 + " por " + n2 + " é: " + resultado);

        

    }



    @Test
    public void deveSubtrairCorretamenteQuandoNumerosPossuemPontosFlutuantes(){

        // DADOS
        double n1 = 14.5;
        double n2 = 9.5;
        double resposta = 5;
        double resultado = 0;

        // PROCESSOS
        Calculadora obj = new Calculadora();
        resultado = obj.subtracao(n1, n2);

        // ASSERT
        Assert.assertEquals(resposta, resultado, 0.01);
        System.out.println("A subtração dos números " + n1 + " e " + n2 + " é: " + resultado);

        

    }



    @Test
    public void deveCalcularRaizQuadrada(){

        // DADOS
        double n = 20.5;
        double resposta = 4.527692569068709;
        double resultado = 0;

        // PROCESSOS
        Calculadora obj = new Calculadora();
        resultado = obj.raizQuad(n);

        // ASSERT
        Assert.assertEquals(resposta, resultado, 0.01);
        System.out.println("A raiz quadrada do número " + n + " é: " + resultado);

    

    }



    @Test
    public void deveCalcularExponenciacao(){

        // DADOS
        double n = 10;
        double expoente = 2;
        double resposta = 100;
        double resultado = 0;

        // PROCESSOS
        Calculadora obj = new Calculadora();
        resultado = obj.potencia(n, expoente);

        // ASSERT
        Assert.assertEquals(resposta, resultado, 0.01);
        System.out.println("A potência de " + n + " elevado à " + expoente + " é: " + resultado);

    

    }



    @Test
    public void deveSomarNumerosBhaskara(){

        // DADOS
        double a = 1;
        double b = 8;
        double c = -9;
        double resposta = -8;
        double resultado = 0;

        // PROCESSOS
        Calculadora obj = new Calculadora();
        resultado = obj.bhaskara(a, b, c);

        // ASSERT
        Assert.assertEquals(resposta, resultado, 0.01);

        // Dados do site https://mundoeducacao.uol.com.br/matematica/formula-bhaskara.htm

    }


















}
