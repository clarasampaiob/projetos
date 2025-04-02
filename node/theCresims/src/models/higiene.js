import { killCresim } from "./game.js";
export async function tomarBanho(cresin){
    killCresim(cresin);
    if(cresin.status == 'ATIVO'){ 
        cresin.cresceleons -= 10;
        await sleep(3000);
        cresin.hygiene = 28;
    } else { console.log("Cresim Inativo"); return false; }
}


function sleep(ms) {
    let i = 0;
    return new Promise(resolve => {
        const end = Date.now() + ms;
        while (Date.now() < end) {i++; if(i == 1){console.log("Tomando Banho ........");}}
        resolve();
    });
}

// New Code