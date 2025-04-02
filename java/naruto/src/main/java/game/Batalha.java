package game;

public class Batalha {


    public Ninja lutar(Ninja n1, Ninja n2){

        Ninja vencedor = null;

        if("Itachi".equals(n1.getName())){
            vencedor = n1;
        }else if("Itachi".equals(n2.getName())){
            vencedor = n2;
        }else {

            n1.atacar(n2);
            n2.atacar(n1);

            n1.atacar(n2);
            n2.atacar(n1);

            n1.atacar(n2);
            n2.atacar(n1);

            int chakraN1 = n1.getChakra();
            int chakraN2 = n2.getChakra();

            if (chakraN1 > chakraN2) {
                vencedor = n1;
            } else if (chakraN2 > chakraN1) {
                vencedor = n2;
            } else {
                vencedor = n1;
            }
        }

        return vencedor;

    }
}
