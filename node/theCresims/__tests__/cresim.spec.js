import { createCresim, setAspiration, dormir } from "../src/models/cresim.js";
import { reduceEnergy } from "../src/utils/utils.js";
import { loadItems } from "../src/services/apiCalls/calls.js";

let items = null;
let cresimMock;
let cresimMockWithAspiration;

beforeAll(async () => {
  cresimMock = createCresim('clara');
  cresimMockWithAspiration = setAspiration(cresimMock, 'GASTRONOMIA');
  items = await loadItems();
})

describe('The Cresim', () => {
  it('Deve conseguir criar um novo Cresim com nome, pontos de higiene e energia carregados e 1500 Cresceleons',() =>  {
    expect(cresimMock.name).toBe('clara');
    expect(cresimMock.hygiene).toBe(28);
    expect(cresimMock.energy).toBe(32);
    expect(cresimMock.cresceleons).toBe(1500);
  });

  it('Não deve conseguir criar um novo Cresim sem nome', () => {
    expect(() => createCresim()).toThrow('Nome é obrigatório.');
  });

  it("Deve conseguir atribuir uma aspiração ao Cresim", () => {
    const aspiration = "GASTRONOMIA";
    const cresimMockWithAspiration = setAspiration(cresimMock, aspiration);
    expect(aspiration).toStrictEqual(cresimMockWithAspiration.aspiration);
  });

  it('Deve lançar erro ao atribuir uma aspiração inválida', () => {
    expect(() => setAspiration(cresimMock, 'INVALID')).toThrow('Aspiração inválida.');
  });

  it("Deve validar os pontos de energia do personagem para que não passem de 32 pontos", () => {
    cresimMock.energy = 32;
    dormir(cresimMock, 10000);
    setTimeout(() => {
      expect(cresimMock.energy).toBe(32);
    }, 10000);
  });

  it("Deve validar os pontos de energia do personagem para que não fiquem negativados", () => {
    cresimMock.energy = 5;
    const result = reduceEnergy(cresimMock, 10);
    expect(result).toBe(false);
    expect(cresimMock.energy).toBe(5);
  });

  it('Deve recuperar energia após dormir', () => {
    cresimMock.energy = 20;
    cresimMock.isBusy = false;
    dormir(cresimMock, 10);
    setTimeout(() => {
      expect(cresimMock.energy).toBe(30);
      expect(cresimMock.isBusy).toBe(false);
    }, 10000);
  });

  it("Deve conseguir dormir e receber seus pontos de energia", () => {
    cresimMock.energy = 20;
    dormir(cresimMock, 10);
    setTimeout(() => {
      expect(cresimMock.energy).toBe(30);
    }, 10000);
  });

  it('Deve conseguir reduzir a energia do Cresim', () => {
    const resultadoEsperado = 20;
    reduceEnergy(cresimMock, 10);
    expect(cresimMock.energy).toBe(resultadoEsperado);
  });
});

// New Code