import axios from 'axios'

import {
  inicializarCorredores,
  calcularMovimento,
  adicionarInimigo,
  iniciarCorrida,
  calcularBuffs,
  inicializarBuffs,
  obterElemento,
  adicionarAliado,
} from '../src/index'

let pistas = null;
let personagens = null

beforeAll(async () => {
  pistas = await axios.get('https://gustavobuttenbender.github.io/gus.github/corrida-maluca/pistas.json');
  personagens = await axios.get('https://gustavobuttenbender.github.io/gus.github/corrida-maluca/personagens.json');
})


it('Deve realizar um GET com axios', async () => {
  expect(pistas.status).toBe(200);
  expect(pistas.data).toBeDefined();
  expect(personagens.status).toBe(200);
  expect(personagens.data).toBeDefined();
});


it('Deve conseguir obter a pista corretamente', async () => {
  const pistaHimalaia = obterElemento(pistas.data, 1); 
  expect(pistaHimalaia).toBeDefined(); 
  expect(pistaHimalaia.nome).toBe('Himalaia');
});


it('Deve conseguir obter o corredor corretamente', async () => {
  const dickVigarista = obterElemento(personagens.data, 1); 
  expect(dickVigarista).toBeDefined(); 
  expect(dickVigarista.nome).toBe('Dick Vigarista');
});


it('Deve conseguir calcular a vantagem de tipo pista corretamente', async () => {
  const dickVigarista = obterElemento(personagens.data, 1); 
  const peterPerfeito = obterElemento(personagens.data, 10);
  const penelopeCharmosa = obterElemento(personagens.data, 6);

  const corredores = [dickVigarista, peterPerfeito, penelopeCharmosa];
  const pistaF1 = obterElemento(pistas.data, 2); 
  const corredoresUpgrade = inicializarCorredores(pistaF1, corredores);
  
  expect(corredoresUpgrade[0].velocidade).toBe(7);
  expect(corredoresUpgrade[0].drift).toBe(4);
  expect(corredoresUpgrade[0].aceleracao).toBe(6);
  expect(corredoresUpgrade[0].posicao).toBe(0);

  expect(corredoresUpgrade[1].velocidade).toBe(9);
  expect(corredoresUpgrade[1].drift).toBe(3);
  expect(corredoresUpgrade[1].aceleracao).toBe(4);
  expect(corredoresUpgrade[1].posicao).toBe(0);

  expect(corredoresUpgrade[2].velocidade).toBe(4);
  expect(corredoresUpgrade[2].drift).toBe(3);
  expect(corredoresUpgrade[2].aceleracao).toBe(5);
  expect(corredoresUpgrade[2].posicao).toBe(0);

});


it('Deve conseguir calcular o debuff de pista corretamente', async () => {
  const dickVigarista = obterElemento(personagens.data, 1); 
  const peterPerfeito = obterElemento(personagens.data, 10);
  const penelopeCharmosa = obterElemento(personagens.data, 6);

  const corredores = [dickVigarista, peterPerfeito, penelopeCharmosa];
  const pistaF1 = obterElemento(pistas.data, 2); 
  const buffsPista = inicializarBuffs(pistaF1);
  const corredoresUpgrade = inicializarCorredores(pistaF1, corredores);
  corredoresUpgrade[2] = adicionarAliado(corredoresUpgrade[2], corredoresUpgrade[1]);
  
  calcularMovimento(corredoresUpgrade[0], pistaF1, 1, corredoresUpgrade, buffsPista); 
  calcularMovimento(corredoresUpgrade[1], pistaF1, 1, corredoresUpgrade, buffsPista);
  calcularMovimento(corredoresUpgrade[2], pistaF1, 1, corredoresUpgrade, buffsPista); 

  const penelope = obterElemento(corredoresUpgrade, 6);
  expect(penelope.posicao).toBe((5));
  // (Aceleração 5) + (Aliado 1) + (Debuff Pista -1)
  
});



it('Deve conseguir calcular o buff de posição de pista para 3 corredores', async () => {
  const dickVigarista = obterElemento(personagens.data, 1); 
  const peterPerfeito = obterElemento(personagens.data, 10);
  const penelopeCharmosa = obterElemento(personagens.data, 6);

  const corredores = [dickVigarista, peterPerfeito, penelopeCharmosa];
  const pistaF1 = obterElemento(pistas.data, 2); 
  const buffsPista = inicializarBuffs(pistaF1);
  const corredoresUpgrade = inicializarCorredores(pistaF1, corredores);
  corredoresUpgrade[2] = adicionarAliado(corredoresUpgrade[2], corredoresUpgrade[1]);
  

  calcularMovimento(corredoresUpgrade[0], pistaF1, 1, corredoresUpgrade, buffsPista); 
  calcularMovimento(corredoresUpgrade[1], pistaF1, 1, corredoresUpgrade, buffsPista);
  calcularMovimento(corredoresUpgrade[2], pistaF1, 1, corredoresUpgrade, buffsPista); 

  calcularBuffs(corredoresUpgrade, buffsPista);
  

  const penelope = obterElemento(corredoresUpgrade, 6);
  expect(penelope.posicao).toBe((6)); // (Aceleração +5) + (Aliado +1) + (Debuff Pista -1) + (Buff Pista +1)
  const dick = obterElemento(corredoresUpgrade, 1);
  expect(dick.posicao).toBe((6)); // (Aceleraçao +4) + (Vantagem Pista +2)
  const peter = obterElemento(corredoresUpgrade, 10);
  expect(peter.posicao).toBe((6)); // (Aceleraçao +2) + (Vantagem Pista +2) + (Buff Pista +2)
  
});



it('Deve conseguir calcular a próxima posição corretamente se estiver sob o buff de um aliado', async () => {
  const dickVigarista = obterElemento(personagens.data, 1); 
  const peterPerfeito = obterElemento(personagens.data, 10);
  const penelopeCharmosa = obterElemento(personagens.data, 6);

  const corredores = [dickVigarista, peterPerfeito, penelopeCharmosa];
  const pistaF1 = obterElemento(pistas.data, 2); 
  const buffsPista = inicializarBuffs(pistaF1);
  const corredoresUpgrade = inicializarCorredores(pistaF1, corredores);
  corredoresUpgrade[2] = adicionarAliado(corredoresUpgrade[2], corredoresUpgrade[1]);
  
  calcularMovimento(corredoresUpgrade[0], pistaF1, 1, corredoresUpgrade, buffsPista); 
  calcularMovimento(corredoresUpgrade[1], pistaF1, 1, corredoresUpgrade, buffsPista);
  calcularMovimento(corredoresUpgrade[2], pistaF1, 1, corredoresUpgrade, buffsPista); 

  const penelope = obterElemento(corredoresUpgrade, 6);
  expect(penelope.posicao).toBe((5));
  // (Aceleração 5) + (Aliado 1) + (Debuff Pista -1)
  
});



it('Deve conseguir calcular a próxima posição corretamente se estiver sob o debuff de um inimigo', async () => {
  const dickVigarista = obterElemento(personagens.data, 1); 
  const peterPerfeito = obterElemento(personagens.data, 10);
  const penelopeCharmosa = obterElemento(personagens.data, 6);

  const corredores = [dickVigarista, peterPerfeito, penelopeCharmosa];
  const pistaF1 = obterElemento(pistas.data, 2); 
  const buffsPista = inicializarBuffs(pistaF1);
  const corredoresUpgrade = inicializarCorredores(pistaF1, corredores);
  corredoresUpgrade[2] = adicionarInimigo(corredoresUpgrade[2], corredoresUpgrade[0]);
  
  calcularMovimento(corredoresUpgrade[0], pistaF1, 1, corredoresUpgrade, buffsPista); 
  calcularMovimento(corredoresUpgrade[1], pistaF1, 1, corredoresUpgrade, buffsPista);
  calcularMovimento(corredoresUpgrade[2], pistaF1, 1, corredoresUpgrade, buffsPista); 

  const penelope = obterElemento(corredoresUpgrade, 6);
  expect(penelope.posicao).toBe((3));
  // (Aceleração 5) + (Inimigo -1) + (Debuff Pista -1)
  
});



it('Deve conseguir criar corredor corretamente somente com aliado', async () => {
  const dickVigarista = obterElemento(personagens.data, 1); 
  const peterPerfeito = obterElemento(personagens.data, 10);
  const penelopeCharmosa = obterElemento(personagens.data, 6);

  const corredores = [dickVigarista, peterPerfeito, penelopeCharmosa];
  const pistaF1 = obterElemento(pistas.data, 2); 
  const buffsPista = inicializarBuffs(pistaF1);
  const corredoresUpgrade = inicializarCorredores(pistaF1, corredores);
  corredoresUpgrade[2] = adicionarAliado(corredoresUpgrade[2], corredoresUpgrade[1]);
  
  calcularMovimento(corredoresUpgrade[0], pistaF1, 1, corredoresUpgrade, buffsPista); 
  calcularMovimento(corredoresUpgrade[1], pistaF1, 1, corredoresUpgrade, buffsPista);
  calcularMovimento(corredoresUpgrade[2], pistaF1, 1, corredoresUpgrade, buffsPista); 

  const penelope = obterElemento(corredoresUpgrade, 6);
  expect(penelope.posicao).toBe((5));
  // (Aceleração 5) + (Aliado 1) + (Debuff Pista -1)
  
});



it('Deve conseguir criar corredor corretamente somente com inimigo', async () => {
  const dickVigarista = obterElemento(personagens.data, 1); 
  const peterPerfeito = obterElemento(personagens.data, 10);
  const penelopeCharmosa = obterElemento(personagens.data, 6);

  const corredores = [dickVigarista, peterPerfeito, penelopeCharmosa];
  const pistaF1 = obterElemento(pistas.data, 2); 
  const buffsPista = inicializarBuffs(pistaF1);
  const corredoresUpgrade = inicializarCorredores(pistaF1, corredores);
  corredoresUpgrade[2] = adicionarInimigo(corredoresUpgrade[2], corredoresUpgrade[0]);
  
  calcularMovimento(corredoresUpgrade[0], pistaF1, 1, corredoresUpgrade, buffsPista); 
  calcularMovimento(corredoresUpgrade[1], pistaF1, 1, corredoresUpgrade, buffsPista);
  calcularMovimento(corredoresUpgrade[2], pistaF1, 1, corredoresUpgrade, buffsPista); 

  const penelope = obterElemento(corredoresUpgrade, 6);
  expect(penelope.posicao).toBe((3));
  // (Aceleração 5) + (Inimigo -1) + (Debuff Pista -1)
  
});



it('Deve conseguir criar corredor corretamente com aliado e inimigo', async () => {
  const dickVigarista = obterElemento(personagens.data, 1); 
  const peterPerfeito = obterElemento(personagens.data, 10);
  const penelopeCharmosa = obterElemento(personagens.data, 6);

  const corredores = [dickVigarista, peterPerfeito, penelopeCharmosa];
  const pistaF1 = obterElemento(pistas.data, 2); 
  const buffsPista = inicializarBuffs(pistaF1);
  const corredoresUpgrade = inicializarCorredores(pistaF1, corredores);
  corredoresUpgrade[2] = adicionarInimigo(corredoresUpgrade[2], corredoresUpgrade[0]);
  corredoresUpgrade[2] = adicionarAliado(corredoresUpgrade[2], corredoresUpgrade[1]);
  
  calcularMovimento(corredoresUpgrade[0], pistaF1, 1, corredoresUpgrade, buffsPista); 
  calcularMovimento(corredoresUpgrade[1], pistaF1, 1, corredoresUpgrade, buffsPista);
  calcularMovimento(corredoresUpgrade[2], pistaF1, 1, corredoresUpgrade, buffsPista); 

  const penelope = obterElemento(corredoresUpgrade, 6);
  expect(penelope.posicao).toBe((4));
  // (Aceleração 5) + (Inimigo -1) + (Aliado +1) + (Debuff Pista -1)
  
});



it('Deve impedir que corredor se mova negativamente mesmo se o calculo de velocidade seja negativo', async () => {
  const dickVigarista = obterElemento(personagens.data, 1); 
  const peterPerfeito = obterElemento(personagens.data, 10);
  const penelopeCharmosa = obterElemento(personagens.data, 6);
  
  const corredores = [dickVigarista, peterPerfeito, penelopeCharmosa];
  const pistaF1 = obterElemento(pistas.data, 2); 
  const buffsPista = inicializarBuffs(pistaF1);
  const corredoresUpgrade = inicializarCorredores(pistaF1, corredores);

  corredoresUpgrade[2].aceleracao = -20;
  corredoresUpgrade[2].velocidade = -20;
  corredoresUpgrade[2].drift = -20;
  
  calcularMovimento(corredoresUpgrade[0], pistaF1, 1, corredoresUpgrade, buffsPista); 
  calcularMovimento(corredoresUpgrade[1], pistaF1, 1, corredoresUpgrade, buffsPista);
  calcularMovimento(corredoresUpgrade[2], pistaF1, 1, corredoresUpgrade, buffsPista); 

  const penelope = obterElemento(corredoresUpgrade, 6);
  expect(penelope.posicao).toBe((0));
  // (Aceleração -20) + (Debuff Pista -1) -> zero
  
});



it('Deve impedir que o Dick Vigarista vença a corrida se estiver a uma rodada de ganhar', async () => {
  const dickVigarista = obterElemento(personagens.data, 1); 
  const peterPerfeito = obterElemento(personagens.data, 10);
  const penelopeCharmosa = obterElemento(personagens.data, 6);
   
  const corredores = [dickVigarista, peterPerfeito, penelopeCharmosa];
  const pistaF1 = obterElemento(pistas.data, 2); 
  const buffsPista = inicializarBuffs(pistaF1);
  const corredoresUpgrade = inicializarCorredores(pistaF1, corredores);
  corredoresUpgrade[0].posicao = 19; // Tamanho Pista 20
  // console.log(corredoresUpgrade);
  
  calcularMovimento(corredoresUpgrade[0], pistaF1, 1, corredoresUpgrade, buffsPista); 
  calcularMovimento(corredoresUpgrade[1], pistaF1, 1, corredoresUpgrade, buffsPista);
  calcularMovimento(corredoresUpgrade[2], pistaF1, 1, corredoresUpgrade, buffsPista); 

  const dick = obterElemento(corredoresUpgrade, 1);
  expect(dick.posicao).toBe((19));
    
});



it('Deve conseguir completar uma corrida com um vencedor', async () => {
  const dickVigarista = obterElemento(personagens.data, 1); 
  const peterPerfeito = obterElemento(personagens.data, 10);
  const penelopeCharmosa = obterElemento(personagens.data, 6);
   
  const corredores = [dickVigarista, peterPerfeito, penelopeCharmosa];
  const pistaHimalaia = obterElemento(pistas.data, 1); 
  pistaHimalaia.debuff = -1; // Para Teste de Mesa Fornecido
 
  const buffsPista = inicializarBuffs(pistaHimalaia);
  const corredoresUpgrade = inicializarCorredores(pistaHimalaia, corredores);
  corredoresUpgrade[0] = adicionarInimigo(corredoresUpgrade[0], corredoresUpgrade[1]);
  corredoresUpgrade[0] = adicionarAliado(corredoresUpgrade[0], corredoresUpgrade[2]);

  let vencedor = iniciarCorrida(pistaHimalaia, corredoresUpgrade, buffsPista);
  expect(vencedor).toBe((10));
  
});



it('Deve conseguir calcular as novas posições corretamente de uma rodada para a próxima', async () => {
  const dickVigarista = obterElemento(personagens.data, 1); 
  const peterPerfeito = obterElemento(personagens.data, 10);

  const corredores = [dickVigarista, peterPerfeito];
  const pistaF1 = obterElemento(pistas.data, 2); 
  const buffsPista = inicializarBuffs(pistaF1);
  const corredoresUpgrade = inicializarCorredores(pistaF1, corredores);
  
  // RODADA 1
  calcularMovimento(corredoresUpgrade[0], pistaF1, 1, corredoresUpgrade, buffsPista); 
  calcularMovimento(corredoresUpgrade[1], pistaF1, 1, corredoresUpgrade, buffsPista);

  calcularBuffs(corredoresUpgrade, buffsPista);

  const dick1 = obterElemento(corredoresUpgrade, 1);
  expect(dick1.posicao).toBe((6)); // (Aceleraçao +4) + (Vantagem Pista +2)
  const peter1 = obterElemento(corredoresUpgrade, 10);
  expect(peter1.posicao).toBe((5)); // (Aceleraçao +2) + (Vantagem Pista +2) + (Buff Pista +1)


  // RODADA 2
  calcularMovimento(corredoresUpgrade[0], pistaF1, 1, corredoresUpgrade, buffsPista); 
  calcularMovimento(corredoresUpgrade[1], pistaF1, 1, corredoresUpgrade, buffsPista);

  calcularBuffs(corredoresUpgrade, buffsPista);

  const dick2 = obterElemento(corredoresUpgrade, 1);
  expect(dick2.posicao).toBe((12)); // (Aceleraçao +4) + (Vantagem Pista +2)
  const peter2 = obterElemento(corredoresUpgrade, 10);
  expect(peter2.posicao).toBe((9)); // (Aceleraçao +2) + (Vantagem Pista +2) 
  
});