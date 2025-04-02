import axios from "axios";


export const loadCheats = async () => {
  try {
    const response = await axios.get('https://emilyspecht.github.io/the-cresim/cheats.json');
    return response.data;
  } catch (error) {
    return 'Erro ao carregar cheats:' + error;
  }
};

export const loadWorks = async () => {
    try {
      const response = await axios.get('https://emilyspecht.github.io/the-cresim/empregos.json');
      return response.data;
    } catch (error) {
      return 'Erro ao carregar Works:' + error;
    }
};

export const loadRelacionamentos = async () => {
  try {
    const response = await axios.get('https://emilyspecht.github.io/the-cresim/interacoes.json');
    return response.data;
  } catch (error) {
    return 'Erro ao carregar interações:' + error;
  }
};

export const loadItems = async () => {
  try {
    const response = await axios.get('https://emilyspecht.github.io/the-cresim/itens-habilidades.json');
    return response.data;
  } catch (error) {
    return 'Erro ao carregar itens de habilidade:' + error;
  }
};

// New Code