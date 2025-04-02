import { useQuestion } from '../services/question/use-question.js';
import { evoluirHabilidade } from '../models/habilidades.js';
import { setAspiration, isValidAspiration } from '../models/cresim.js';
import { dormir, trabalhar } from '../models/cresim.js';
import { tomarBanho } from '../models/higiene.js';
import { createCresim } from '../models/cresim.js';
import { aplicarCheat } from '../utils/cheats.js';
import { killCresim, finalizarGame } from '../models/game.js';
import { relacionar } from '../models/relacionamentos.js';
import { useLocalStorage } from '../services/local-storage/use-local-storage.js';
import { loadCheats, loadItems, loadRelacionamentos } from '../services/apiCalls/calls.js';

const promptCresimCreation = async () => {
  const name = await useQuestion('Qual o nome do seu Cresim?');
  let aspiration = await useQuestion('Escolha a aspiração do Cresim (Gastronomia, Pintura, Jogos, Jardinagem, Música):');

  while (!isValidAspiration(aspiration)) {
    console.log('Aspiração inválida. Escolha entre Gastronomia, Pintura, Jogos, Jardinagem ou Música.');
    aspiration = await useQuestion('Escolha a aspiração do Cresim:');
  }

  const cresim = createCresim(name);
  const cresimWithAspiration = setAspiration(cresim, aspiration);
  return cresimWithAspiration;
};

const saveCresim = (cresim) => {
    const localStorage = useLocalStorage();
    const existingCresims = localStorage.getObject('cresims') || [];
    localStorage.setObject('cresims', [...existingCresims, cresim]);
    console.log('Cresim criado com sucesso!');
  };

const findOneCresim = (id) => {
  const cresimsStorage = loadCresims();
  return cresimsStorage.find(c => c.id === id);
};

const loadCresims = () => {
    const localStorage = useLocalStorage();
    const cresimsStorage = localStorage.getObject('cresims') || [];
    return cresimsStorage;
};

export const updateCresim = (cresim, attribute, newValue) => {
  const localStorage = useLocalStorage();
  const cresimsStorage = localStorage.getObject('cresims') || [];
  const updatedCresims = cresimsStorage.map(c => {
    if (c.id === cresim.id) {
      return { ...c, [attribute]: newValue };
    }
    return c;
  });
  localStorage.setObject('cresims', updatedCresims);
};

let itensHabilidade = null;
let cheats = null;
let interacoes = null;
let cresims = loadCresims();

export const mainMenu = async () => {
  cheats = await loadCheats();
  itensHabilidade = await loadItems();
  interacoes = await loadRelacionamentos();
  console.log('\n=== MENU PRINCIPAL ===');
  console.log('1. Criar Cresim');
  console.log('2. Selecionar Cresim');
  console.log('3. Sair');

  const choice = await useQuestion('Escolha uma opção:');
  switch (choice) {
    case '1':
      const newCresim = await promptCresimCreation();
      saveCresim(newCresim);
      await mainMenu();
      break;
    case '2':
      cresims = loadCresims();
      if (cresims.length > 0 && cresims.some(c => c.status === 'ATIVO')) {
        await selectCresimMenu();
      } else {
        console.log('Nenhum Cresim disponível. Crie um novo Cresim.');
        await mainMenu();
      }
      break;
    case '3':
      console.log('Saindo...');
      process.exit(0);
    default:
      console.log('Opção inválida. Tente novamente.');
      await mainMenu();
  }
};

const selectCresimMenu = async () => {
  cresims = loadCresims();
  console.log('\nSelecione um Cresim:');
  cresims = cresims.filter(cresim => cresim.status === 'ATIVO');
  cresims.forEach((cresim, index) => {
    console.log(`${index + 1}. ${cresim.name} (${cresim.isBusy ? 'Ocupado' : 'Disponível'})`);
  });
  console.log(`${cresims.length + 1}. Matar Todos os Cresims`);
  console.log(`${cresims.length + 2}. Voltar`);

  const choice = await useQuestion('Escolha uma opção:');
  const choiceIndex = parseInt(choice) - 1;

  if (choiceIndex >= 0 && choiceIndex < cresims.length) {
    if (cresims[choiceIndex].isBusy) {
      console.log(`${cresims[choiceIndex].name} está ocupado. Escolha outro Cresim.`);
      await selectCresimMenu();
    } else {
      await cresimActionsMenu(cresims[choiceIndex]);
    }
  } else if (choiceIndex === cresims.length) {
    const updatedCresims = cresims.map(cresim => {
      if (cresim.status === 'ATIVO') {
        const cresimExpirado = {
          ...cresim,
          expiration: Date.now() - 10000
        };
        killCresim(cresimExpirado);
        return cresimExpirado;
      }
      return cresim; 
    });
    if (finalizarGame(updatedCresims)) {
      process.exit(0);
    }
  } else if (choiceIndex === cresims.length + 1) {
    await mainMenu();
  } else {
    console.log('Opção inválida. Tente novamente.');
    await selectCresimMenu();
  }
};

const cresimActionsMenu = async (cresim) => {
  console.log(`\nCresim selecionado: ${cresim.name}`);
  console.log('1. Ver informações');
  console.log('2. Trabalhar');
  console.log('3. Treinar habilidade');
  console.log('4. Dormir');
  console.log('5. Tomar banho');
  console.log('6. Relacionar');
  console.log('7. Matar Cresim');
  console.log('8. Voltar');

  const choice = await useQuestion('Escolha uma opção:');
  if (aplicarCheat(cresim, choice, cheats)) await cresimActionsMenu(cresim);

  let cresimAtualizado = findOneCresim(cresim.id);
  switch (choice) {
    case '1':
      mostrarInformacoesCresim(cresimAtualizado);
      await cresimActionsMenu(cresim);
      break;
    case '2':
      await trabalhar(cresimAtualizado);
      await cresimActionsMenu(cresim);
      break;
    case '3':
      await treinarHabilidadeMenu(cresim);
      break;
    case '4':
      const sleepTime = await useQuestion('Por quanto tempo (em segundos) você quer dormir?');
      dormir(cresimAtualizado, parseInt(sleepTime));
      await cresimActionsMenu(cresim);
      break;
    case '5':
      await tomarBanho(cresimAtualizado);
      console.log(`${cresim.name} tomou banho.`);
      await cresimActionsMenu(cresim);
      break;
    case '6':
      await relacionarMenu(cresimAtualizado);
      break;
    case '7':
      const cresimExpirado = {
        ...cresimAtualizado,
        expiration: Date.now() - 10000,
      }
      killCresim(cresimExpirado);
      console.log(`${cresim.name} foi morto.`);
      await mainMenu();
      break;
    case '8':
      await mainMenu();
      break;
    default:
      console.log('Opção inválida.');
      await cresimActionsMenu(cresim);
  }
};

function mostrarInformacoesCresim(cresim) {
  console.log(`\n=== Informações do Cresim ===`);
  console.log(`Nome: ${cresim.name}`);
  console.log(`Aspiração: ${cresim.aspiration}`);
  console.log(`Cresceleons: ${cresim.cresceleons}`);
  console.log(`Energia: ${cresim.energy}`);
  console.log(`Higiene: ${cresim.hygiene}`);
  console.log(`Ocupado: ${cresim.isBusy ? 'Sim' : 'Não'}`);
  console.log(`\n=== Habilidades ===`);
  for (const [habilidade, detalhes] of Object.entries(cresim.habilidades)) {
      console.log(`${habilidade}: Nível ${detalhes.nivel}, Pontos ${detalhes.pontos}`);
  }
  console.log(`\n=== Itens Comprados ===`);
  if (cresim.itensComprados.length > 0) {
      cresim.itensComprados.forEach(item => console.log(`- ${item.nome} (${item.preco} Cresceleons)`));
  } else {
      console.log('Nenhum item comprado.');
  }
  console.log(`\n=== Relacionamentos ===`);
  if (cresim.relacionamentos.length > 0) {
      cresim.relacionamentos.forEach(relacao => console.log(`- ${relacao.nome}: ${relacao.tipo} (${relacao.pontos} pontos)`));
  } else {
      console.log('Nenhum relacionamento.');
  }
  console.log(`\n============================`);
}

const treinarHabilidadeMenu = async (cresim) => {
  console.log('\nEscolha uma habilidade para treinar:');
  const habilidades = Object.keys(itensHabilidade);
  habilidades.forEach((habilidade, index) => console.log(`${index + 1}. ${habilidade}`));
  console.log(`${habilidades.length + 1}. Voltar`);

  const choice = await useQuestion('Escolha uma opção:');
  const choiceIndex = parseInt(choice) - 1;

  if (choiceIndex >= 0 && choiceIndex < habilidades.length) {
    await escolherItemParaTreinar(cresim, habilidades[choiceIndex]);
  } else if (choiceIndex === habilidades.length) {
    await cresimActionsMenu(cresim);
  } else {
    console.log('Opção inválida.');
    await treinarHabilidadeMenu(cresim);
  }
};

const escolherItemParaTreinar = async (cresim, habilidade) => {
  console.log(`\nEscolha um item para treinar ${habilidade}:`);
  const itens = itensHabilidade[habilidade];
  itens.forEach((item, index) => console.log(`${index + 1}. ${item.nome} (Pontos: ${item.pontos}, Preço: ${item.preco} Cresceleons)`));
  console.log(`${itens.length + 1}. Voltar`);

  const choice = await useQuestion('Escolha uma opção:');
  const choiceIndex = parseInt(choice) - 1;

  if (choiceIndex >= 0 && choiceIndex < itens.length) {
    await evoluirHabilidade(cresim, habilidade, itens[choiceIndex]);
  }
  await cresimActionsMenu(cresim);
};

const relacionarMenu = async (cresimAtual) => {
  const cresimsDisponiveis = cresims.filter(c => !c.isBusy && c.id !== cresimAtual.id);

  if (cresimsDisponiveis.length === 0) {
    console.log('Nenhum Cresim disponível para interagir.');
    await cresimActionsMenu(cresimAtual);
    return;
  }

  console.log('\nEscolha um Cresim para interagir:');
  cresimsDisponiveis.forEach((cresim, index) => {
    console.log(`${index + 1}. ${cresim.name}`);
  });
  console.log(`${cresimsDisponiveis.length + 1}. Voltar`);

  const choice = await useQuestion('Escolha uma opção:');
  const choiceIndex = parseInt(choice) - 1;

  if (choiceIndex >= 0 && choiceIndex < cresimsDisponiveis.length) {
    const cresimEscolhido = cresimsDisponiveis[choiceIndex];
    await escolherInteracaoMenu(cresimAtual, cresimEscolhido);
  } else if (choiceIndex === cresimsDisponiveis.length) {
    await cresimActionsMenu(cresimAtual);
  } else {
    console.log('Opção inválida. Tente novamente.');
    await relacionarMenu(cresimAtual);
  }
};

const escolherInteracaoMenu = async (cresim1, cresim2) => {
  const relacionamento = cresim1.relacionamentos.find(rel => rel.nome === cresim2.name) || { tipo: 'NEUTRO' };

  console.log(`\nEscolha uma interação com ${cresim2.name} (Relacionamento: ${relacionamento.tipo}):`);

  const interacoesDisponiveis = [];
  if (relacionamento.tipo === 'INIMIZADE') {
    interacoesDisponiveis.push(...interacoes.INIMIZADE);
  }
  if (relacionamento.tipo === 'NEUTRO' || relacionamento.tipo === 'INIMIZADE' || relacionamento.tipo === 'AMIZADE' || relacionamento.tipo === 'AMOR') {
    interacoesDisponiveis.push(...interacoes.NEUTRO);
  }
  if (relacionamento.tipo === 'AMIZADE' || relacionamento.tipo === 'AMOR') {
    interacoesDisponiveis.push(...interacoes.AMIZADE);
  }
  if (relacionamento.tipo === 'AMOR') {
    interacoesDisponiveis.push(...interacoes.AMOR);
  }

  interacoesDisponiveis.forEach((interacao, index) => {
    console.log(`${index + 1}. ${interacao.interacao} (Energia: ${interacao.energia}, Pontos: ${interacao.pontos})`);
  });
  console.log(`${interacoesDisponiveis.length + 1}. Voltar`);

  const choice = await useQuestion('Escolha uma opção:');
  const choiceIndex = parseInt(choice) - 1;

  if (choiceIndex >= 0 && choiceIndex < interacoesDisponiveis.length) {
    const interacaoEscolhida = interacoesDisponiveis[choiceIndex];
    await relacionar(cresim1, cresim2, interacaoEscolhida, interacoes);
    console.log(`${cresim1.name} interagiu com ${cresim2.name} usando "${interacaoEscolhida.interacao}".`);
    await cresimActionsMenu(cresim1);
  } else if (choiceIndex === interacoesDisponiveis.length) {
    await relacionarMenu(cresim1);
  } else {
    console.log('Opção inválida. Tente novamente.');
    await escolherInteracaoMenu(cresim1, cresim2);
  }
};

// New Code