import { createCresim, setAspiration } from "../src/models/cresim.js";
import { loadItems } from "../src/services/apiCalls/calls.js";
import {
  evoluirHabilidade,
  commprarItem,
} from '../src/models/habilidades.js'

let items = null;
let cresimMock;
let cresimMockWithAspiration;

beforeAll(async () => {
  cresimMock = createCresim('clara');
  cresimMockWithAspiration = setAspiration(cresimMock, 'GASTRONOMIA');
  cresimMock.expiration = Date.now() + 1000000000000000000000;
  items = await loadItems();
})

it('Deve conseguir comprar um item de habilidade',() =>  {
    const gastronomiaItems = items.GASTRONOMIA;
    const itemMakita = gastronomiaItems[0];
    cresimMock.cresceleons = 10000000; 
    let comprou = commprarItem(itemMakita, cresimMock);
    if(comprou){
      const comprado = cresimMock.itensComprados.find(item => item.id === itemMakita.id);
      expect(comprado.id).toBe(itemMakita.id);
    //   console.log(comprado);
    //   console.log(cresimMock); 
    }
    expect(comprou).toBeTruthy();
  })

  
  it('Deve validar ao tentar comprar um item de habilidade sem Cresceleons suficientes',() =>  {
    const gastronomiaItems = items.GASTRONOMIA;
    const itemMakita = gastronomiaItems[0];
    cresimMock.cresceleons = 1500; 
    let comprou = commprarItem(itemMakita, cresimMock);
    if(comprou){
      const comprado = cresimMock.itensComprados.find(item => item.id === itemMakita.id);
      expect(comprado.id).toBe(itemMakita.id);
    //   console.log(comprado);
    //   console.log(cresimMock); 
    }
    // console.log(cresimMock);
    expect(comprou).toBeFalsy();
  })


  it('Deve conseguir concluir um ciclo de treino com habilidade que não é aspiração e receber os pontos corretamente', async () =>  {
    const gastronomiaItems = items.GASTRONOMIA;
    const itemMakita = gastronomiaItems[0];
    cresimMock.cresceleons = 15000000; 
    cresimMock.habilidades['GASTRONOMIA'].pontos = 0; 
    itemMakita.pontos = 20; 

    await evoluirHabilidade(cresimMock, 'GASTRONOMIA', itemMakita);

    expect(cresimMock.habilidades['GASTRONOMIA'].pontos).toBe(20);
    expect(cresimMock.energy).toBe(28);
    expect(cresimMock.habilidades['GASTRONOMIA'].nivel).toBe('PLENO');
    expect(cresimMock.isBusy).toBeFalsy;
  })


  it('Deve conseguir concluir um ciclo de treino com habilidade que é sua aspiração e receber os pontos corretamente', async () =>  {
    const gastronomiaItems = items.GASTRONOMIA;
    const itemMakita = gastronomiaItems[0];
    cresimMock.cresceleons = 15000000; 
    cresimMock.habilidades['GASTRONOMIA'].pontos = 0; 
    cresimMock.aspiration = 'GASTRONOMIA';
    itemMakita.pontos = 26; 

    await evoluirHabilidade(cresimMock, 'GASTRONOMIA', itemMakita);

    expect(cresimMock.habilidades['GASTRONOMIA'].pontos).toBe(27);
    expect(cresimMock.energy).toBe(24);
    expect(cresimMock.habilidades['GASTRONOMIA'].nivel).toBe('SENIOR');
    expect(cresimMock.isBusy).toBeFalsy;
  })


  it('Deve perder pontos de energia ao terminar um ciclo de treino', async () =>  {
    const gastronomiaItems = items.GASTRONOMIA;
    const itemMakita = gastronomiaItems[0];
    cresimMock.cresceleons = 15000000; 
    cresimMock.habilidades['GASTRONOMIA'].pontos = 0; 
    cresimMock.aspiration = 'GASTRONOMIA';
    itemMakita.pontos = 26; 

    await evoluirHabilidade(cresimMock, 'GASTRONOMIA', itemMakita);

    //  console.log(cresimMock);
    expect(cresimMock.energy).toBe(20);
    expect(cresimMock.isBusy).toBeFalsy;
  })


  it('Deve perder pontos de higiene ao terminar um ciclo de treino', async () =>  {
    const gastronomiaItems = items.GASTRONOMIA;
    const itemMakita = gastronomiaItems[0];
    cresimMock.cresceleons = 15000000; 
    cresimMock.hygiene = 10;

    await evoluirHabilidade(cresimMock, 'GASTRONOMIA', itemMakita);

    expect(cresimMock.hygiene).toBe(8);
    expect(cresimMock.isBusy).toBeFalsy;
  })
  

  it('Deve avançar o nivel de habilidade quando completar os pontos necessarios', async () =>  {
    const gastronomiaItems = items.GASTRONOMIA;
    const itemMakita = gastronomiaItems[0];
    cresimMock.cresceleons = 15000000; 
    cresimMock.habilidades['GASTRONOMIA'].pontos = 0; 
    cresimMock.aspiration = 'GASTRONOMIA';
    itemMakita.pontos = 26; 

    await evoluirHabilidade(cresimMock, 'GASTRONOMIA', itemMakita);

    expect(cresimMock.habilidades['GASTRONOMIA'].pontos).toBe(27);
    expect(cresimMock.habilidades['GASTRONOMIA'].nivel).toBe('SENIOR');
    expect(cresimMock.isBusy).toBeFalsy;
  })


  it('Cresin sem energia', async () =>  {
    const gastronomiaItems = items.GASTRONOMIA;
    const itemMakita = gastronomiaItems[0];
    cresimMock.cresceleons = 15000000; 
    cresimMock.hygiene = 10;
    cresimMock.energy = 3;

    let result = await evoluirHabilidade(cresimMock, 'GASTRONOMIA', itemMakita);

    expect(cresimMock.hygiene).toBe(10);
    expect(result).toBeFalsy;
    expect(cresimMock.isBusy).toBeFalsy;
  })


  it('Habilidade não encontrada', async () =>  {
    const gastronomiaItems = items.GASTRONOMIA;
    const itemMakita = gastronomiaItems[0];
    cresimMock.cresceleons = 15000000; 
    cresimMock.energy = 10;

    let result = await evoluirHabilidade(cresimMock, 'DANCAR', itemMakita);

    expect(result).toBeFalsy;
    expect(cresimMock.isBusy).toBeFalsy;
  })


  it('Não Deve Evoluir Habilidade se Não Tiver Item Necessário', async () =>  {
    const jogosItems = items.JOGOS;
    const itemMouse = jogosItems[1];
    cresimMock.cresceleons = 10;
    cresimMock.energy = 100; 
    
    let result = await evoluirHabilidade(cresimMock, 'JOGOS', itemMouse);
    expect(result).toBeFalsy;
  })


  it('Não Deve Evoluir Habilidade se Estiver Inativo', async () =>  {
    const jogosItems = items.JOGOS;
    const itemMouse = jogosItems[1];
    cresimMock.expiration = 1739288400000;
    
    let result = await evoluirHabilidade(cresimMock, 'JOGOS', itemMouse);
    expect(result).toBeFalsy;
  })

// New Code
  