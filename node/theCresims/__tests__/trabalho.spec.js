import { createCresim } from "../src/models/cresim"
import { trabalhar } from "../src/models/cresim"
import { loadWorks } from "../src/services/apiCalls/calls";

let cresimMock;

beforeAll(async () => {
    cresimMock = createCresim('clara');
})
describe('The Cresim - Trabalha', () => {
    it('Deve carregar os Trabalhos da api corretamente', async () => {
        const works = await loadWorks();
        expect(works.length).toBeGreaterThan(0);
    })


    it("Deve perder os pontos de energia ao trabalhar uma jornada padrão", async () => {
        cresimMock.energy = 20
        await trabalhar(cresimMock)
        setTimeout(() => {
            expect(cresimMock.energy).toBe(10)
        }, 20000)
    })
    
    it("Deve receber o salario do dia ao trabalhar uma jornada padrão", async () => {
        const salarioEsperado = 160
        await trabalhar(cresimMock)
        setTimeout(() => {
            expect(cresimMock.cresceleons).toBe(1500 + salarioEsperado)
        }, 20000)
    })

    it("Deve receber o salario equivalente quando começar a trabalhar com os pontos de energia menores que 10", async () => {
        cresimMock.energy = 8
        await trabalhar(cresimMock)
        setTimeout(() => {
            expect(cresimMock.cresceleons).toBeGreaterThan(1500)
            expect(cresimMock.cresceleons).toBeLessThan(1500 + 160)
        }, 16000)
    })

    it("Deve validar para que o Cresim não consiga começar a trabalhar com os pontos de energia menores que 4", async () => {
        cresimMock.energy = 3
        await trabalhar(cresimMock)

        setTimeout(() => {
            expect(cresimMock.isBusy).toBe(false)
            expect(cresimMock.cresceleons).toBe(1500)
        }, 500)
    })

    it('Não deve trabalhar se o Cresim já estiver ocupado', async () => {
        cresimMock.isBusy = true;
        await trabalhar(cresimMock);
        expect(cresimMock.isBusy).toBe(true);
    });
      
    it('Não deve trabalhar se o Cresim estiver com energia insuficiente', async () => {
    cresimMock.energy = 4;
    await trabalhar(cresimMock);
    expect(cresimMock.energy).toBe(4);
    });
      
    it('Deve trabalhar e atualizar salário e energia corretamente', async () => {
        cresimMock.energy = 20;
        cresimMock.isBusy = false;
        cresimMock.aspiration = 'GASTRONOMIA';
        await trabalhar(cresimMock);
        setTimeout(() => {
            expect(cresimMock.cresceleons).toBeGreaterThan(1500);
            expect(cresimMock.energy).toBeLessThan(20);
            expect(cresimMock.hygiene).toBeLessThan(28);
            expect(cresimMock.isBusy).toBe(false);
        }, 20000);
    });

    it('Deve tratar o recalculo do salário se a energia por 5 ou menor', async () => {
        cresimMock.energy = 5;
        await trabalhar(cresimMock);
        setTimeout(() => {
            expect(cresimMock.cresceleons).toBe(1500);
        }, 5000);
    })

    it("Deve receber o salario equivalente quando começar a trabalhar com os pontos de energia menores que 10 e pontos de higiene menores que 4", async () => {
        cresimMock.energy = 8;
        cresimMock.hygiene = 3;
        await trabalhar(cresimMock);
        setTimeout(() => {
            expect(cresimMock.cresceleons).toBeGreaterThan(1500);
            expect(cresimMock.cresceleons).toBeLessThan(1500 + 160);
        }, 16000);
    })
})

// New Code