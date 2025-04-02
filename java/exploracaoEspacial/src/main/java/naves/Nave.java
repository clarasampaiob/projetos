package naves;

import planetas.Planeta;
import recursos.Recurso;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.List;


public class Nave {

    private int combustivel;
    private int posicao;
    List<Recurso> recursosColetados;
    private List<Planeta> planetasVisitados;


    public Nave(int combustivel){
        this.combustivel = combustivel;
        this.posicao = 0;
        this.recursosColetados = new ArrayList<>();
        this.planetasVisitados = new ArrayList<>();
    }

    public int getQuantidadeDeCombustivel(){
        return this.combustivel;
    }

    public int getPosicaoNave(){
        return this.posicao;
    }

    private boolean avancar(List<Planeta> planetas, List<Recurso> recursos) {
        return movimentar(planetas, recursos, true);
    }

    private void retornar(List<Planeta> planetas) {
        movimentar(planetas, null, false);
    }

    private void prosseguir(List<Planeta> planetas){
        Collections.reverse(planetas);
        Planeta planetaStart = new Planeta(0, Collections.emptyList());
        planetas.add(planetaStart);
        retornar(planetas);
    }

    public List<Recurso> explorar(List<Planeta> planetas){
        List<Recurso> recursos = new ArrayList<>();
        if(avancar(planetas, recursos)) prosseguir(planetas);
        return this.recursosColetados;
    }

    public List<Recurso> explorar(Planeta planeta){
        List<Recurso> recursos = new ArrayList<>();
        List<Planeta> planetas = new ArrayList<>();
        planetas.add(planeta);
        if(avancar(planetas, recursos)) prosseguir(planetas);
        return this.recursosColetados;
    }

    public List<Recurso> explorarComPrioridade(List<Planeta> planetas, int prioridade){
        List<Recurso> recursos = new ArrayList<>();
        if (prioridade == 1) planetas.sort(Comparator.comparingInt(Planeta::getPosicao));
        else if (prioridade == 2) planetas.sort(Comparator.comparingDouble(Planeta::getSomaValorPorPeso).reversed());
        if(avancar(planetas, recursos)) prosseguir(planetas);
        return this.recursosColetados;
    }

    private boolean movimentar(List<Planeta> planetas, List<Recurso> recursos, boolean coletarRecursos) {
        boolean prosseguir = true;

        for (int i = 0; i < planetas.size(); i++) {
            Planeta planeta = planetas.get(i);
            int distancia;

            if (i > 0) {
                Planeta planetaAnterior = planetas.get(i - 1);
                distancia = Math.abs(planetaAnterior.getPosicao() - planeta.getPosicao());
            } else distancia = Math.abs(this.posicao - planeta.getPosicao());

            int combustivelNecessario = distancia * 3;

            if (this.combustivel >= combustivelNecessario) {
                this.combustivel -= combustivelNecessario;
                this.posicao = planeta.getPosicao();
                if ((coletarRecursos) && (recursos != null) && (!this.planetasVisitados.contains(planeta))) {
                    recursos.addAll(planeta.getRecursos());
                    this.recursosColetados = recursos;
                    this.planetasVisitados.add(planeta);
                }
            } else {
                if (!this.recursosColetados.isEmpty()) this.recursosColetados.clear();
                prosseguir = false;
            }
        }

        return prosseguir;
    }

}
