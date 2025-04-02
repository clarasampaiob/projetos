import { updateCresim } from "../menu/menu.js";
import { killCresim } from "./game.js";

export function commprarItem(item, cresim){
    killCresim(cresim);
    if(cresim.status == 'ATIVO'){   
        if(item.preco <= cresim.cresceleons){
            if(!cresim.itensComprados.some(comprado => comprado.id === item.id)){
                cresim.itensComprados.push(item);
                cresim.cresceleons -= item.preco;
                updateCresim(cresim, 'itensComprados', cresim.itensComprados);
                updateCresim(cresim, 'cresceleons', cresim.cresceleons);
                console.log('Compra realizada com sucesso!');
            }
            return true;
        }else{
            console.log('Saldo insuficiente para comprar o item.');
            return false;
        }
    } else {console.log("O Cresim está Inativo"); return false; }
}
  
  

export async function evoluirHabilidade(cresim, habilidade, item) {
    killCresim(cresim, 8000);
    if(cresim.status == 'ATIVO'){ 
        if((cresim.isBusy === false) && (cresim.energy >= 4)){
            if(commprarItem(item, cresim) === true){
                cresim.isBusy = true;
                let pontosItem = item.pontos;
                let aspiracao = 0;
                if (cresim.aspiration === habilidade) { aspiracao += 1; }
                
                if (cresim.habilidades[habilidade]) {
                    const habilidadeAtual = cresim.habilidades[habilidade];
                    
                    await sleep(8000);
                    console.log('Treinamento concluído com sucesso!');
                    cresim.isBusy = false;
    
                    cresim.habilidades[habilidade].pontos += pontosItem + aspiracao;
                    verificarSubidaDeNivel(habilidadeAtual);
                    
                    cresim.energy -= 4;
                    cresim.hygiene -= 2;

                    cresimLocalStorage(cresim, cresim.energy, cresim.hygiene);
                    
                    return true;
                } else { console.log('Habilidade não encontrada!'); cresim.isBusy = false; return false; }
            } else { console.log('Cresim sem Item necessário!'); return false; }
        } else { console.log('Cresim está ocupado ou sem energia!'); return false; }
    } else {console.log("O Cresim está Inativo"); return false; }   
}


function cresimLocalStorage(cresim, novaEnergia, novaHigiene){
    const novoCresim = {
        ...cresim,
        energy: novaEnergia,
        hygiene: novaHigiene
    };

    updateCresim(cresim, 'habilidades', novoCresim.habilidades);
    updateCresim(cresim, 'energy', novoCresim.energy);
    updateCresim(cresim, 'hygiene', novoCresim.hygiene);
}


export const verificarSubidaDeNivel = (habilidadeAtual) => {
    if (habilidadeAtual.pontos >= 17 && habilidadeAtual.nivel === 'JUNIOR') {
      habilidadeAtual.nivel = 'PLENO';
      console.log(`Habilidade subiu para o nível PLENO!`);
    } else if (habilidadeAtual.pontos > 26 && habilidadeAtual.nivel === 'PLENO') {
      habilidadeAtual.nivel = 'SENIOR';
      console.log(`Habilidade subiu para o nível SENIOR!`);
    }
};  



function sleep(ms) {
    return new Promise(resolve => {
        const end = Date.now() + ms;
        let i = 0;
        while (Date.now() < end) { i++; if(i == 1){console.log("Treinando habilidade, aguarde .....");} }
        resolve();
    });
}

// New Code