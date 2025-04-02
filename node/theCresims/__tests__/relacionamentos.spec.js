import { createCresim } from "../src/models/cresim.js";
import axios from 'axios'
import { loadRelacionamentos } from "../src/services/apiCalls/calls.js";
import {
  buscarArrayKey,
  relacionar,
} from '../src/models/relacionamentos.js'


let interacoes = null;
let cresimGabi;
let cresimJosh;


beforeAll(async () => {
  cresimGabi = createCresim('Gabi');
  cresimJosh = createCresim('Josh');
  cresimGabi.expiration = Date.now() + 1000000000000000;
  cresimJosh.expiration = Date.now() + 1000000000000000;
  interacoes = await loadRelacionamentos();
})

it('Deve evoluir o relacionamento de dois Cresims para AMIZADE', async () => {
    const interacao = interacoes.NEUTRO.find(atividade => atividade.id === 3);
    for(let i=0; i < 3; i++){ await relacionar(cresimGabi, cresimJosh, interacao, interacoes); } 
    let keyJosh = buscarArrayKey(cresimGabi, cresimJosh);
    let keyGabi = buscarArrayKey(cresimJosh, cresimGabi);
    expect(cresimGabi.relacionamentos[keyJosh].tipo).toBe('AMIZADE');
    expect(cresimJosh.relacionamentos[keyGabi].tipo).toBe('AMIZADE');
    // console.log(cresimGabi);
    // console.log(cresimJosh);
});
  

it('Deve recuar o relacionamento de dois Cresims para INIMIZADE', async () => {
    const interacao = interacoes.NEUTRO.find(atividade => atividade.id === 6);
    for(let i=0; i < 6; i++){ await relacionar(cresimGabi, cresimJosh, interacao, interacoes); } 
    let keyJosh = buscarArrayKey(cresimGabi, cresimJosh); 
    let keyGabi = buscarArrayKey(cresimJosh, cresimGabi); 
    expect(cresimGabi.relacionamentos[keyJosh].tipo).toBe('INIMIZADE');
    expect(cresimJosh.relacionamentos[keyGabi].tipo).toBe('INIMIZADE');
    // console.log(cresimGabi);
    // console.log(cresimJosh);
});


it('Deve descontar os pontos de energia em uma interação entre dois Cresims', async () => {
    const interacao = interacoes.NEUTRO.find(atividade => atividade.id === 4);
    cresimGabi.energy = 40;
    cresimJosh.energy = 30;
    for(let i=0; i < 2; i++){ await relacionar(cresimGabi, cresimJosh, interacao, interacoes); } 
    expect(cresimGabi.energy).toBe(36);
    expect(cresimJosh.energy).toBe(28);
    // console.log(cresimGabi);
    // console.log(cresimJosh);
});


it('Deve evoluir o relacionamento de dois Cresims para AMOR e Desbloquear Categoria', async () => {
  const interacao = interacoes.NEUTRO.find(atividade => atividade.id === 3);
  for(let i=0; i < 8; i++){ await relacionar(cresimGabi, cresimJosh, interacao, interacoes); } 
  let keyJosh = buscarArrayKey(cresimGabi, cresimJosh); 
  let keyGabi = buscarArrayKey(cresimJosh, cresimGabi); 
  expect(cresimGabi.relacionamentos[keyJosh].tipo).toBe('AMOR');
  expect(cresimJosh.relacionamentos[keyGabi].tipo).toBe('AMOR');
  // console.log(cresimGabi);
  const interacao2 = interacoes.AMOR.find(atividade => atividade.id === 1);
  for(let i=0; i < 2; i++){ await relacionar(cresimGabi, cresimJosh, interacao2, interacoes); }
  // console.log(cresimJosh);
  // console.log(cresimGabi);
  expect(cresimGabi.relacionamentos[keyJosh].pontos).toBe(36);
  expect(cresimJosh.relacionamentos[keyGabi].pontos).toBe(36);
});


it('Deve Impedir Acesso a Categorias Bloqueadas', async () => {
  const interacao = interacoes.NEUTRO.find(atividade => atividade.id === 3);
  await relacionar(cresimGabi, cresimJosh, interacao, interacoes); 
  let keyJosh = buscarArrayKey(cresimGabi, cresimJosh); 
  let keyGabi = buscarArrayKey(cresimJosh, cresimGabi); 
  expect(cresimGabi.relacionamentos[keyJosh].tipo).toBe('AMOR');
  expect(cresimJosh.relacionamentos[keyGabi].tipo).toBe('AMOR');
  const interacao2 = interacoes.INIMIZADE.find(atividade => atividade.id === 1);
  for(let i=0; i < 2; i++){ await relacionar(cresimGabi, cresimJosh, interacao2, interacoes); }
  // console.log(cresimJosh);
  // console.log(cresimGabi);
  expect(cresimGabi.relacionamentos[keyJosh].pontos).toBe(40);
  expect(cresimJosh.relacionamentos[keyGabi].pontos).toBe(40);
});


it('Deve Retroceder o Relacionamento', async () => {
  const interacao = interacoes.NEUTRO.find(atividade => atividade.id === 6);
  for(let i=0; i < 8; i++){ await relacionar(cresimGabi, cresimJosh, interacao, interacoes); } 
  let keyJosh = buscarArrayKey(cresimGabi, cresimJosh); 
  let keyGabi = buscarArrayKey(cresimJosh, cresimGabi); 
  expect(cresimGabi.relacionamentos[keyJosh].tipo).toBe('AMIZADE');
  expect(cresimJosh.relacionamentos[keyGabi].tipo).toBe('AMIZADE');

  const interacao2 = interacoes.AMIZADE.find(atividade => atividade.id === 2);
  await relacionar(cresimGabi, cresimJosh, interacao2, interacoes); 
  for(let i=0; i < 3; i++){ await relacionar(cresimGabi, cresimJosh, interacao, interacoes); }
  expect(cresimGabi.relacionamentos[keyJosh].tipo).toBe('NEUTRO');
  expect(cresimJosh.relacionamentos[keyGabi].tipo).toBe('NEUTRO');

  for(let i=0; i < 5; i++){ await relacionar(cresimGabi, cresimJosh, interacao, interacoes); }
  expect(cresimGabi.relacionamentos[keyJosh].tipo).toBe('INIMIZADE');
  expect(cresimJosh.relacionamentos[keyGabi].tipo).toBe('INIMIZADE');

  const interacao3 = interacoes.INIMIZADE.find(atividade => atividade.id === 2);
  await relacionar(cresimGabi, cresimJosh, interacao3, interacoes); 
  await relacionar(cresimGabi, cresimJosh, interacao, interacoes); 
  // console.log(cresimGabi);
  // console.log(cresimJosh) ;
});


it('Não Relacionar com Cresim Inativo', async () => {
  cresimGabi.expiration = 1739288400000;
  const interacao = interacoes.NEUTRO.find(atividade => atividade.id === 6);
  let relacao = await relacionar(cresimGabi, cresimJosh, interacao, interacoes);  
  expect(relacao).toBeFalsy;
});

 // New Code 

