
import pokemons from './pokemons.json';
import { criarTreinador, capturarPokemon, subirNivel, evoluirPokemon } from '../src/index';



describe('Treinador nome correto', () => {
  it('Treinador será criado com nome correto', () => {
    const squirtle = pokemons.find(p => p.id === 1);
    const treinador = criarTreinador('Ash', 10, squirtle);
    expect(treinador.nome).toBe('Ash');
  })
})


describe('Treinador idade', () => {
  it('Treinador será criado com a idade correta', () => {
    const squirtle = pokemons.find(p => p.id === 1);
    const treinador = criarTreinador('Ash', 10, squirtle);
    expect(treinador.idade).toBe(10);
  })
})


describe('Treinador pokemon', () => {
  it('Treinador será criado com o pokemon inicial correto', () => {
    const squirtle = pokemons.find(p => p.id === 1);
    const treinador = criarTreinador('Ash', 10, squirtle);
    expect(treinador.pokemon[0].nome).toBe('Squirtle');
  })
})


describe('Capturar pokemon', () => {
  it('Treinador terá seus pokemons atualizados após nova captura', () => {
    const squirtle = pokemons.find(p => p.id === 1);
    const cyndaquil = pokemons.find(p => p.id === 4);
    const blastoise = pokemons.find(p => p.id === 3);

    const treinador = criarTreinador('Ash', 10, squirtle);

    capturarPokemon(treinador, cyndaquil);
    capturarPokemon(treinador, blastoise);
    expect(treinador.pokemon[0].levelInicial).toBe(3);
    expect(treinador.pokemon[1].levelInicial).toBe(2);
    expect(treinador.pokemon[2].levelInicial).toBe(10);
  })
})


describe('Nivel pokemon', () => {
  it('Deve subir o nível do pokemon corretamente', () => {
    const squirtle = pokemons.find(p => p.id === 1);
    squirtle.levelInicial = 1;
    subirNivel(squirtle);

    expect(squirtle.levelInicial).toBe(2);
  })
})


describe('Evoluir pokemon', () => {
  it('Deve evoluir pokemon ao atingir o nível necessário', () => {
    const squirtle = pokemons.find(p => p.id === 1);
    squirtle.levelInicial = 5;

    const evoluido = evoluirPokemon(squirtle);

    expect(evoluido.nome).toBe('Wartortle');
  })
})



describe('Nao Evoluir pokemon', () => {
  it('Não deve evoluir pokemon caso não possua o level necessário', () => {
    const quilava = pokemons.find(p => p.id === 5);
    
    const evoluido = evoluirPokemon(quilava);

    expect(evoluido.nome).toBe('Quilava');
  })
})