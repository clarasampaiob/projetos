import { updateCresim } from "../menu/menu.js";
import { verificarSubidaDeNivel } from '../models/habilidades.js';
import { killCresim } from "../models/game.js";

const LIFE_SPAN = 3600000;
const MAX_ENERGY = 32;

export const aplicarCheat = (cresim, codigoCheat, cheats) => {
    killCresim(cresim);
    if(cresim.status === 'INATIVO') {
        console.log("O Cresim está Inativo");   
        return cresim;
    }
    const cheat = cheats.find(c => c.codigo === codigoCheat.toUpperCase());

    if (!cheat) {
        return false;
    }

    let updatedCresim = { ...cresim };

    switch (cheat.categoria) {
        case 'SALARIO':
            updatedCresim.cresceleons = Math.floor(cresim.cresceleons * (1 + cheat.valor / 100));
            updateCresim(updatedCresim, 'cresceleons', updatedCresim.cresceleons);
            console.log(`Cheat aplicado: ${cheat.descricao}. Novo saldo: ${updatedCresim.cresceleons} Cresceleons.`);
            break;

        case 'ENERGIA':
            updatedCresim.energy = Math.min(MAX_ENERGY, cresim.energy + cheat.valor);
            updateCresim(updatedCresim, 'energy', updatedCresim.energy);
            console.log(`Cheat aplicado: ${cheat.descricao}. Nova energia: ${updatedCresim.energy}.`);
            break;

        case 'HABILIDADE':
            if (updatedCresim.habilidades[updatedCresim.aspiration]) {
                updatedCresim.habilidades[updatedCresim.aspiration].pontos += cheat.valor;
                verificarSubidaDeNivel(updatedCresim.habilidades[updatedCresim.aspiration]);
                updateCresim(updatedCresim, 'habilidades', updatedCresim.habilidades);
                console.log(`Cheat aplicado: ${cheat.descricao}. Pontos de habilidade aumentados para ${updatedCresim.habilidades[updatedCresim.aspiration].pontos}.`);
            } else {
                console.log('Aspiração não encontrada. Cheat não aplicado.');
                return false;
            }
            break;

        case 'VIDA':
            if (cheat.valor === 0) {
                updatedCresim.life = 0; 
                console.log(`Cheat aplicado: ${cheat.descricao}. Tempo de vida do Cresim zerado.`);
            } else {
                updatedCresim.life = Math.min(LIFE_SPAN, cresim.life + cheat.valor);
                console.log(`Cheat aplicado: ${cheat.descricao}. Novo tempo de vida: ${updatedCresim.life}ms.`);
            }
            updateCresim(updatedCresim, 'life', updatedCresim.life);
            break;
        default:
            return false;
    }

    return updatedCresim;
};

// New Code