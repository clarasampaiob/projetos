import axios from 'axios'

import {
  verificarSeAtorEstaEmSeriado,
  filtarPorAnoERetornarNome,
  calcularMediaTotalDeEpisodios,
  agruparTituloDasSeriesPorPropriedade,
} from '../src/metodos'

let resposta = null;

beforeAll(async () => {
  resposta = await axios.get('https://gustavobuttenbender.github.io/film-array/data/films.json');
})


it('Deve realizar um GET com axios', async () => {
  expect(resposta.status).toBe(200);
  expect(resposta.data).toBeDefined();
  //console.log(resposta.data);
});


it('Deve filtrar as series com ano de estreia maior ou igual a 2010 e retornar uma listagem com os nomes', async () => {
  const s2010 = filtarPorAnoERetornarNome(resposta.data, 2010);
  expect(s2010.length).toBe(2);

  const s2011 = filtarPorAnoERetornarNome(resposta.data, 2011);
  expect(s2011.length).toBe(1);

  const s2015 = filtarPorAnoERetornarNome(resposta.data, 2015);
  expect(s2015.length).toBe(1);

  const s2016 = filtarPorAnoERetornarNome(resposta.data, 2016);
  expect(s2016.length).toBe(2);

  const s2018 = filtarPorAnoERetornarNome(resposta.data, 2018);
  expect(s2018.length).toBe(1);

  const s2021 = filtarPorAnoERetornarNome(resposta.data, 2021);
  expect(s2021.length).toBe(1);

  const todasSeries = [
    ...s2010,
    ...s2011,
    ...s2015,
    ...s2016,
    ...s2018,
    ...s2021,
  ];

  //.log(todasSeries);
  expect(todasSeries.length).toBe(8);
});



it('Deve retornar true ao procurar ator que está em elenco', async () => {
 const presente = verificarSeAtorEstaEmSeriado(resposta.data, 'Winona Ryder');
 expect(presente).toBeTruthy(); 
});


it('Deve retornar false ao procurar ator que não participa de elenco', async () => {
  const presente = verificarSeAtorEstaEmSeriado(resposta.data, 'Clara Sampaio');
  expect(presente).toBeFalsy(); 
 });


 it('Deve calcular corretamente a media total de episódios de todas as series', async () => {
  const mediaEp = calcularMediaTotalDeEpisodios(resposta.data);
  expect(mediaEp).toBe(35.8);
 });


 it('Deve agrupar corretamente em um objeto os titulos das series baseado na Distribuidora', async () => {
  const grupoDistribuidora = agruparTituloDasSeriesPorPropriedade(resposta.data, 'distribuidora');
  console.log(grupoDistribuidora);
  expect(grupoDistribuidora).toEqual({
    Netflix: ['Stranger Things', 'Narcos'],
    HBO: ['Game Of Thrones', 'Band of Brothers', 'Westworld'],
    AMC: ['The Walking Dead', 'Breaking Bad'],
    CWI: ['Gus and Will The Masters of the Wizards'],
    JS: ['10 Days Why'],
    'USA Network': ['Mr. Robot'],
  });
 });


 it('Deve retornar false se serie for de ano anterior a 2010', async () => {
  const series = filtarPorAnoERetornarNome(resposta.data, 1999);
  expect(series).toBeFalsy();
});
