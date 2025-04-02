import { createCresim } from "../src/models/cresim.js";
import {
  tomarBanho,
} from '../src/models/higiene.js'

let cresimJosh;


beforeAll(async () => {
  cresimJosh = createCresim('Josh');
  cresimJosh.expiration = Date.now() + 1000000000000000000000;
})


it('Deve tomar banho', async () => {
    cresimJosh.cresceleons = 100;
    tomarBanho(cresimJosh);
    expect(cresimJosh.cresceleons).toBe(90); 
});


it('Não tomar banho se estiver Inativo', async () => {
  cresimJosh.expiration = 1739288400000;
  cresimJosh.cresceleons = 100;
  let banho = tomarBanho(cresimJosh);
  expect(banho).toBeFalsy; 
});

// New Code