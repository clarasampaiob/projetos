package calculadora;

public class Calculadora {

    // SOMA
    public double soma(double n1, double n2){
        return n1 + n2;
    }


    // SUBTRAÇÃO
    public double subtracao(double n1, double n2){
        return n1 - n2;
    }


    // MULTIPLICAÇÃO
    public double multiplicacao(double n1, double n2){
        return n1 * n2;
    }


    // DIVISÃO
    public double divisao(double n1, double n2){
        return n1 / n2;
    }


    // RAIZ QUADRADA
    public double raizQuad(double n){
        return Math.sqrt(n);
    }


    // EXPONENCIAÇÃO
    public double potencia(double n, double expoente){
        return Math.pow(n, expoente);
    }


    // BHASKARA
    public double bhaskara(double a, double b, double c){
        double b2 = potencia(b, 2);
        double delta = b2 - (4*a*c);
        double raizDelta = raizQuad(delta);
        double x1 = (-b + raizDelta) / 2*a;
        double x2 = (-b - raizDelta) / 2*a;
        return x1 + x2;
    }

}
