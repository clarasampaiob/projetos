export function filtarPorAnoERetornarNome(series, ano) {
  if(ano >= 2010){
    const filtradas = series.filter(serie => serie.anoEstreia === ano);
    return filtradas.map(serie => serie.titulo);
  }else{ 
    return false;
  }
}

export function verificarSeAtorEstaEmSeriado(series, nomeAtor) {
  return series.some(serie => serie.elenco.includes(nomeAtor));
}

export function calcularMediaTotalDeEpisodios(series) {
  const totalEpisodios = series.reduce((acumulado, serie) => acumulado + serie.numeroEpisodios, 0);
  return totalEpisodios / series.length;
}

export function agruparTituloDasSeriesPorPropriedade(series, propriedade) {
  return series.reduce((agrupado, serie) => {
    const chave = serie[propriedade]; 
    agrupado[chave] = agrupado[chave] || []; 
    agrupado[chave].push(serie.titulo); 
    return agrupado;
  }, {});
}
