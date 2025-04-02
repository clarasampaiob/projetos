import { updateCresim } from "../menu/menu.js";
export function updateGameList(cresim, gameList) {
    const index = gameList.findIndex(item => item.id === cresim.id);
    if (index !== -1) {
        gameList[index] = { ...cresim }; 
    } else {
        console.log('Item não encontrado');
    }
}

export function killCresim(cresin, interval = null) {
    if (cresin.expiration < Date.now()) {
        cresin.status = "INATIVO"; 
        cresin.life = 0;
        updateCresim(cresin, 'status', cresin.status); 
        return true; 
    } else if (interval !== null && Date.now() <= (cresin.expiration + interval)) {
        return false; 
    }
}

export function finalizarGame(gameList) {
    const ativos = gameList.filter(cresim => cresim.status === "ATIVO");
    if (ativos.length > 0) { 
        console.log("Ainda Tem Jogadores Ativos"); 
        return false; 
    } else {
        console.log("Jogo Finalizado"); 
        return true; 
    }
}

// New Code