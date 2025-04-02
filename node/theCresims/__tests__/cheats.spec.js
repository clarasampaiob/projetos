import { aplicarCheat } from "../src/utils/cheats";
import { loadCheats } from "../src/services/apiCalls/calls";
import { createCresim, setAspiration } from "../src/models/cresim";

let cheats = null;
let cresimMock;

beforeAll(async () => {
    cresimMock = createCresim('clara');
    cheats = await loadCheats();
})

describe('The Cresim - Cheats', () => {  
  it('Deve conseguir aplicar o cheat SORTENAVIDA e receber as recompensas', () => {
    const valorEsperado = 1650;
    const result = aplicarCheat(cresimMock, 'SORTENAVIDA', cheats);
    expect(result.cresceleons).toBe(valorEsperado);
  });

  it('Deve conseguir aplicar o cheat DEITADONAREDE e receber as recompensas', () => {
    const valorEsperado = 32; // valor da energia foi alterado anteriormente
    const result = aplicarCheat(cresimMock, 'DEITADONAREDE', cheats);
    expect(result.energy).toBe(valorEsperado);
  });

  it('Deve conseguir aplicar o cheat JUNIM e receber as recompensas para a habilidade escolhida', () => {
    const valorEsperado = 5;
    cresimMock = setAspiration(cresimMock, 'JOGOS');
    const result = aplicarCheat(cresimMock, 'JUNIM', cheats);
    expect(result.habilidades['JOGOS'].pontos).toBe(valorEsperado);
  });

  it('Não deve conseguir aplicar o cheat JUNIM e receber as recompensas para a habilidade escolhida', () => {
    const cresimNovo = createCresim('zé');
    const result = aplicarCheat(cresimNovo, 'JUNIM', cheats);
    expect(result).toBe(false);
  });

  it('Deve conseguir aplicar o cheat CAROLINAS e receber as recompensas', () => {
    const valorEsperado = 3600000;
    const result = aplicarCheat(cresimMock, 'CAROLINAS', cheats);
    expect(result.life).toBe(valorEsperado);
  });

  it('Deve conseguir aplicar o cheat SINUSITE e ter a vida zerada', () => {
    const result = aplicarCheat(cresimMock, 'SINUSITE', cheats);
    expect(result.life).toBe(0);
  });

  it('Não deve conseguir aplicar um cheat inexistente', () => {
    const result = aplicarCheat(cresimMock, 'CHEATINEXISTENTE', cheats);
    expect(result).toBe(false);
  })

  it('Não deve aplicar cheat se o Cresim estiver INATIVO', () => {
    cresimMock.status = 'INATIVO';
    const result = aplicarCheat(cresimMock, 'SORTENAVIDA', cheats);
    expect(result).toBe(cresimMock);
  })
});

// New Code
