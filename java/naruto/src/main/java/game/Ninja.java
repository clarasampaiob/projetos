package game;

public class Ninja {

    private String nome;
    private int chakra;
    private Jutsu jutsu;



    public Ninja(String nome, Jutsu jutsu){
        this.chakra = 100;
        this.nome = nome;
        this.jutsu = jutsu;
    }


    public void receberGolpe(int golpe){
        this.chakra = this.chakra - golpe;
    }


    public void atacar(Ninja oponente){
        int meuDano = this.jutsu.getDano();
        oponente.receberGolpe(meuDano);
        int meuConsumo = this.jutsu.getConsumo();
        this.chakra = this.chakra - meuConsumo;
    }


    public int getChakra(){
        return this.chakra;
    }

    public String getName(){
        return this.nome;
    }

    public int getConsumoChakra(){ return this.jutsu.getConsumo(); }

    public int getDanoChakra(){ return this.jutsu.getDano(); }



}
