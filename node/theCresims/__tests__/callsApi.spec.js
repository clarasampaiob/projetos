import axios from "axios";
import { loadCheats, loadItems, loadRelacionamentos,loadWorks } from "../src/services/apiCalls/calls";

jest.mock('axios');
describe('loadCallsApi', () => {
    
    it('Deve retornar os Cheats corretamente', async () => {
        const mockData = { cheats: ['cheat1', 'cheat2'] };
        axios.get.mockResolvedValue({ data: mockData });

        const result = await loadCheats();

        expect(result).toEqual(mockData);
        expect(axios.get).toHaveBeenCalledWith('https://emilyspecht.github.io/the-cresim/cheats.json');
    });

    it('Deve retornar erro ao simular erro na requisição dos Cheats', async () => {
        const mockError = new Error('Network Error');
        axios.get.mockRejectedValue(mockError);

        const result = await loadCheats();

        expect(result).toBe('Erro ao carregar cheats:' + mockError);
        expect(axios.get).toHaveBeenCalledWith('https://emilyspecht.github.io/the-cresim/cheats.json');
    });

    it('Deve retornar os Items corretamente', async () => {
        const mockData = { cheats: ['cheat1', 'cheat2'] };
        axios.get.mockResolvedValue({ data: mockData });

        const result = await loadItems();

        expect(result).toEqual(mockData);
        expect(axios.get).toHaveBeenCalledWith('https://emilyspecht.github.io/the-cresim/itens-habilidades.json');
    });

    it('Deve retornar erro ao simular erro na requisição dos Items', async () => {
        const mockError = new Error('Network Error');
        axios.get.mockRejectedValue(mockError);

        const result = await loadItems();

        expect(result).toBe('Erro ao carregar itens de habilidade:' + mockError);
        expect(axios.get).toHaveBeenCalledWith('https://emilyspecht.github.io/the-cresim/itens-habilidades.json');
    });

    it('Deve retornar os Relacionamentos corretamente', async () => {
        const mockData = { cheats: ['cheat1', 'cheat2'] };
        axios.get.mockResolvedValue({ data: mockData });

        const result = await loadRelacionamentos();

        expect(result).toEqual(mockData);
        expect(axios.get).toHaveBeenCalledWith('https://emilyspecht.github.io/the-cresim/interacoes.json');
    });

    it('Deve retornar erro ao simular erro na requisição dos Relacionamentos', async () => {
        const mockError = new Error('Network Error');
        axios.get.mockRejectedValue(mockError);

        const result = await loadRelacionamentos();

        expect(result).toBe('Erro ao carregar interações:' + mockError);
        expect(axios.get).toHaveBeenCalledWith('https://emilyspecht.github.io/the-cresim/interacoes.json');
    });

    it('Deve retornar os trabalhos corretamente', async () => {
        const mockData = { cheats: ['cheat1', 'cheat2'] };
        axios.get.mockResolvedValue({ data: mockData });

        const result = await loadWorks();

        expect(result).toEqual(mockData);
        expect(axios.get).toHaveBeenCalledWith('https://emilyspecht.github.io/the-cresim/itens-habilidades.json');
    });

    it('Deve retornar erro ao simular erro na requisição dos trabalhos', async () => {
        const mockError = new Error('Network Error');
        axios.get.mockRejectedValue(mockError);

        const result = await loadWorks();

        expect(result).toBe('Erro ao carregar Works:' + mockError);
        expect(axios.get).toHaveBeenCalledWith('https://emilyspecht.github.io/the-cresim/itens-habilidades.json');
    });
});

// New Code