import { updateCresim } from "../menu/menu.js";
import { killCresim } from "./game.js";

export function criar(cresim1, cresim2){
    cresim1.relacionamentos.push({
        nome: cresim2.name,
        pontos: 0,
        tipo: 'NEUTRO',
    });

    cresim2.relacionamentos.push({
        nome: cresim1.name,
        pontos: 0,
        tipo: 'NEUTRO',
    });

    updateCresim(cresim1, 'relacionamentos', cresim1.relacionamentos);
    updateCresim(cresim2, 'relacionamentos', cresim2.relacionamentos);
}


export function validarInteracao(categoria, atv, interacoes) {
    const nome = atv.interacao;
    let valido = false;    

    if(categoria === 'INIMIZADE'){
        if(interacoes['INIMIZADE'].some(item => item.interacao === nome)){ valido = true; }  
    }

    if((categoria === 'AMIZADE') || (categoria === 'AMOR')){
        if(interacoes['AMIZADE'].some(item => item.interacao === nome)){ valido = true; }  
    }

    if(categoria === 'AMOR'){
        if(interacoes['AMOR'].some(item => item.interacao === nome)){ valido = true; } 
    }

    if((categoria === 'NEUTRO') || (categoria === 'INIMIZADE') || (categoria === 'AMIZADE') || (categoria === 'AMOR')){
        if(interacoes['NEUTRO'].some(item => item.interacao === nome)){ valido = true; } 
    }

    return valido;
}


export function evoluirRelacao(pontoAtual){
    if(pontoAtual < 0){ return 'INIMIZADE';}
    else if((pontoAtual > 10) && (pontoAtual <= 25)){ return 'AMIZADE';}
    else if(pontoAtual >= 26){ return 'AMOR';}
    else { return 'NEUTRO';}
}


export function buscarArrayKey(cresim1, cresim2){
    return cresim1.relacionamentos.findIndex((relacao) => relacao.nome === cresim2.name);
}


export async function relacionar(cresim1, cresim2, interacao, interacoes){
    killCresim(cresim1);
    killCresim(cresim2);
    if((cresim1.status == 'ATIVO') && (cresim2.status == 'ATIVO')){ 
        const temRelacionamento = cresim1.relacionamentos.some((relacao) => relacao.nome == cresim2.name);
        if(!temRelacionamento){ criar(cresim1, cresim2); }

        const keyCresim1 = buscarArrayKey(cresim2, cresim1);   
        const keyCresim2 = buscarArrayKey(cresim1, cresim2); 

        if(validarInteracao(cresim1.relacionamentos[keyCresim2].tipo, interacao, interacoes)){
            await sleep(2000*(interacao.energia));
            cresim1.relacionamentos[keyCresim2].pontos += interacao.pontos;
            cresim2.relacionamentos[keyCresim1].pontos += interacao.pontos;
            let evolucao = evoluirRelacao(cresim1.relacionamentos[keyCresim2].pontos);
            cresim1.relacionamentos[keyCresim2].tipo = evolucao;
            cresim2.relacionamentos[keyCresim1].tipo = evolucao;
            cresim1.energy -= interacao.energia;
            cresim2.energy -= Math.ceil((interacao.energia)/2);

            updateCresim(cresim1, 'relacionamentos', cresim1.relacionamentos);
            updateCresim(cresim2, 'relacionamentos', cresim2.relacionamentos);
            updateCresim(cresim1, 'energy', cresim1.energy);
            updateCresim(cresim2, 'energy', cresim2.energy);
        }else {
            console.log(`Interação "${interacao.interacao}" não é permitida para o relacionamento atual (${cresim1.relacionamentos[keyCresim2].tipo}).`);
        }
    } else {console.log("O Cresim está Inativo"); return false; }  
}

function sleep(ms) {
    return new Promise(resolve => {
        const end = Date.now() + ms;
        let i = 0;
        while (Date.now() < end) { i++; if(i == 1){console.log("Interagindo .....");} }
        resolve();
    });
}

// New Code