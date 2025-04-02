import { killCresim, finalizarGame, updateGameList } from "../src/models/game.js";
import { createCresim } from "../src/models/cresim.js";

let cresim;
let cresim2;
let cresim3;
let gameList = [];

beforeAll(async () => {
    cresim = createCresim('Vicky');
    cresim2 = createCresim('Matt');
    cresim3 = createCresim('Jeff');
})


it('Deve criar uma lista de cresims', () => {
    gameList.push(cresim);
    gameList.push(cresim2);
    gameList.push(cresim3);
    expect(gameList.length).toBeGreaterThan(0);
});


it('Deve Inativar Cresim', () => {
    cresim.expiration = 1739288400000;
    killCresim(cresim);
    updateGameList(cresim, gameList);
    expect(cresim.status).toBe('INATIVO');
    // console.log(gameList);
});


it('Não Deve Finalizar o Jogo', () => {
    expect(finalizarGame(gameList)).toBeFalsy;
});


it('Deve Finalizar o Jogo', () => {
    cresim2.expiration = 1739288400000;
    cresim3.expiration = 1739288400000;
    killCresim(cresim2);
    killCresim(cresim3);
    updateGameList(cresim2, gameList);
    updateGameList(cresim3, gameList);
    expect(cresim2.status).toBe('INATIVO');
    expect(cresim3.status).toBe('INATIVO');
    expect(finalizarGame(gameList)).toBeTruthy;
});

// New Code



