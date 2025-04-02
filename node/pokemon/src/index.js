// inicie por aqui

import pokemons from '../__tests__/pokemons.json';


const criarTreinador = (nome, idade, pokemonInicial) => {
    return {
      nome,
      idade,
      pokemon: [pokemonInicial]
    };
  };


const capturarPokemon = (treinador, pokemon) => {
    treinador.pokemon.forEach(p => subirNivel(p));
    treinador.pokemon = treinador.pokemon.map(p => evoluirPokemon(p));
    treinador.pokemon.push(pokemon);
    return treinador;
};


const subirNivel = (pokemon) => {
    pokemon.levelInicial += 1;
};


const evoluirPokemon = (pokemon) => {
    if (pokemon.evolucao && pokemon.levelInicial >= pokemon.evolucao.level) {
        const evoluido = pokemons.find(p => p.id === pokemon.evolucao.id);
        return { ...evoluido };
      }
      return pokemon;
};



export { criarTreinador, capturarPokemon, subirNivel, evoluirPokemon };