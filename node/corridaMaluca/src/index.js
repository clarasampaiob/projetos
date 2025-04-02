
export function inicializarCorredores(pista, corredores) {
    return corredores.map(corredor => ({
      ...corredor,
      posicao: 0,
      lastPosicao: 0,
      velocidade: corredor.vantagem === pista.tipo ? corredor.velocidade + 2 : corredor.velocidade,
      drift: corredor.vantagem === pista.tipo ? corredor.drift + 2 : corredor.drift,
      aceleracao: corredor.vantagem === pista.tipo ? corredor.aceleracao + 2 : corredor.aceleracao,
      debuf: corredor.vantagem === pista.tipo ? false : true,
      aliado: 0,
      inimigo: 0,
      rodada: 0
    }));
  }


  export function inicializarBuffs(pista) {
    return pista.posicoesBuffs.map((posicao) => ({
        posicao: posicao,
        buff: 0,
    }));
  }


  export function calcularBuffs(corredores, buffsPista) {
    corredores.sort((a, b) => b.posicao - a.posicao); // Ordenar os corredores por posição final em ordem decrescente
    buffsPista.forEach(buff => {
      let buffAcumulado = buff.buff; 
      for (let i = 0; i < corredores.length; i++) {                    
        if (corredores[i].lastPosicao <= buff.posicao && corredores[i].posicao >= buff.posicao) {         
          corredores[i].posicao += buffAcumulado;
          buffAcumulado += 1; 
          buff.buff = buffAcumulado;        
        }        
      }    
    });
  }
   
  
  export function calcularMovimento(corredor, pista, rodada, corredores, buffsPista) {
    corredor.rodada = rodada;
    let atributo;

    if (rodada <= 3) { atributo = corredor.aceleracao > 0 ? corredor.aceleracao : 0; } 
    else if (rodada % 4 === 0) { atributo = corredor.drift > 0 ? corredor.drift : 0; } 
    else { atributo = corredor.velocidade > 0 ? corredor.velocidade : 0; }

    if (corredor.debuf == true) { atributo += pista.debuff; }
  
    if(corredor.posicao > 0){ atributo += buffsAliadosInimigos(corredores, corredor); }
    else{ if(corredor.aliado > 0){atributo += 1;} if(corredor.inimigo > 0){atributo -= 1;} }

    corredor.lastPosicao = corredor.posicao;
    corredor.posicao += atributo;
    if(corredor.posicao < 0){corredor.posicao = 0;}
    
    if (corredor.posicao >= pista.tamanho - 1 && corredor.nome === "Dick Vigarista") { corredor.posicao = corredor.lastPosicao; }          
  }
   
    
  export function iniciarCorrida(pista, corredores, buffsPista) {
    let vencedor = false;
    let rodada = 1;

  do{   
    calcularBuffs(corredores, buffsPista);
    for(let i = 0; i < corredores.length; i++){
      calcularMovimento(corredores[i], pista, rodada, corredores, buffsPista);  
    }
    corredores.sort((a, b) => b.posicao - a.posicao)
    console.log(corredores);
    if(corredores[0].posicao >= pista.tamanho){ vencedor = true; }
    rodada++;
  } while (!vencedor);
  
  console.log(corredores[0].nome); 
  return corredores[0].id; 
  }



  export function obterElemento(array, id){
    return array.find(elemento => elemento.id === id);
  }


  export function adicionarAliado(corredor, aliado) {
    return {
      ...corredor,
      aliado: aliado.id, 
    };
  }


  export function adicionarInimigo(corredor, inimigo) {
    return {
      ...corredor,
      inimigo: inimigo.id, 
    };
  }
  

export function buffsAliadosInimigos(corredores, corredor){
  let atributo = 0;
  let inimigoPosicao = 0;
  let aliadoPosicao = 0;
  const aliado = corredores.find(c => c.id === Number(corredor.aliado));
  const inimigo = corredores.find(c => c.id === Number(corredor.inimigo));

  if (aliado !== undefined) {
    if(aliado.rodada == corredor.rodada){ aliadoPosicao = aliado.lastPosicao; }
    else if(aliado.rodada < corredor.rodada){ aliadoPosicao = aliado.posicao; }
    const diferencaAliado = Math.abs(corredor.posicao - aliadoPosicao);
    if (diferencaAliado <= 2) { atributo += 1; }
  }
  
  if (inimigo !== undefined) {
    if(inimigo.rodada == corredor.rodada){ inimigoPosicao = inimigo.lastPosicao; }
    else if(inimigo.rodada < corredor.rodada){ inimigoPosicao = inimigo.posicao; }
    const diferencaInimigo = Math.abs(corredor.posicao - inimigoPosicao);
    if (diferencaInimigo <= 2) { atributo -= 1;}
  }

  return atributo;
}
  
  
 
  