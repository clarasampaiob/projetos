import { updateCresim } from "../menu/menu.js";
import { loadWorks } from "../services/apiCalls/calls.js";
import { killCresim } from "./game.js";

const LIFE_SPAN = 3600000; 
const INITIAL_CRESCELONS = 1500;
const MAX_ENERGY = 32;
const MAX_HYGIENE = 28;
const WORK_DURATION = 20000; 
const ENERGY_LOSS_WORK = 10;

const habilidades = {
  GASTRONOMIA: { nivel: "JUNIOR", pontos: 0 },
  PINTURA: { nivel: "JUNIOR", pontos: 0 },
  JOGOS: { nivel: "JUNIOR", pontos: 0 },
  JARDINAGEM: { nivel: "JUNIOR", pontos: 0 },
  MUSICA: { nivel: "JUNIOR", pontos: 0 },
};

export const createCresim = (name, aspiration) => {
  if (!name) {
    throw new Error("Nome é obrigatório.");
  }

  return {
    id: Date.now(),
    name,
    aspiration: aspiration ? aspiration.toUpperCase() : null,
    cresceleons: INITIAL_CRESCELONS,
    life: LIFE_SPAN,
    created: Date.now(),
    expiration: Date.now() + LIFE_SPAN,
    status: 'ATIVO',
    energy: MAX_ENERGY,
    hygiene: MAX_HYGIENE,
    isBusy: false,
    habilidades: { ...habilidades },
    relacionamentos: [],
    itensComprados: [],
  };
};

export const setAspiration = (cresim, aspiration) => {
  if (!isValidAspiration(aspiration)) {
    throw new Error(
      "Aspiração inválida. Escolha entre Gastronomia, Pintura, Jogos, Jardinagem ou Música."
    );
  }

  return {
    ...cresim,
    aspiration: aspiration.toUpperCase(),
    habilidades: {
      ...cresim.habilidades,
      [aspiration.toUpperCase()]: { nivel: "JUNIOR", pontos: 0 },
    },
  };
};

export const isValidAspiration = (aspiration) => {
  const validAspirations = [
    "GASTRONOMIA",
    "PINTURA",
    "JOGOS",
    "JARDINAGEM",
    "MUSICA",
  ];
  return validAspirations.includes(aspiration.toUpperCase());
};

export const dormir = (cresim, time) => {
  if (killCresim(cresim)) return;
  
  if (cresim.isBusy) {
    console.log(`${cresim.name} já está ocupado.`);
    return;
  }

  cresim.isBusy = true;
  updateCresim(cresim, "isBusy", cresim.isBusy)
  console.log(`${cresim.name} está dormindo...`);

  const tempoSegundos = time * 1000;

  setTimeout(() => {
    const baseRecovery = Math.floor(tempoSegundos / 5000) * 4;
    const bonusRecovery = Math.max(0, Math.floor((tempoSegundos - 5000) / 5000) * 2);
    const novoCresim = {
      ...cresim,
      energy: Math.min(MAX_ENERGY, cresim.energy + baseRecovery + bonusRecovery),
      isBusy: false,
    };

    updateCresim(novoCresim, "energy", novoCresim.energy);
    updateCresim(novoCresim, "isBusy", novoCresim.isBusy);

    console.log(`${novoCresim.name} acordou! Energia atual: ${novoCresim.energy}`);
  }, tempoSegundos);
};

export const trabalhar = async (cresim) => {
  if (cresim.isBusy) {
    console.log(`${cresim.name} já está ocupado.`)
    return;
  }

  if (cresim.energy <= 4) {
    console.log(`${cresim.name} está muito cansado para trabalhar.`)

    return
  }

  try {
    const empregos = await loadWorks();
    const emprego = empregos.find((e) => e.categoria === cresim.aspiration)
    
    if (!emprego) {
      console.log("Nenhum emprego disponível para essa aspiração.")

      return
    }
    
    const nivelHabilidade = cresim.habilidades[cresim.aspiration]?.nivel || "JUNIOR"
    const salarioBase = emprego.salario.find((s) => s.nivel === nivelHabilidade).valor
    
    let energiaGasta = Math.min(ENERGY_LOSS_WORK, cresim.energy - 2)
    let tempoTrabalho = (WORK_DURATION / ENERGY_LOSS_WORK) * energiaGasta
    let salarioTotal = (tempoTrabalho / WORK_DURATION) * salarioBase

    if (killCresim(cresim, tempoTrabalho)) return;

    if (cresim.energy <= 5) {
      const pontosRecalculo = 5 - cresim.energy
      const desconto = salarioBase * 0.1 * pontosRecalculo
      salarioTotal -= desconto
    }

    cresim.isBusy = true
    updateCresim(cresim, "isBusy", cresim.isBusy)
    console.log(`${cresim.name} está trabalhando como ${emprego.cargo}...`)

    setTimeout(() => {
      const novoCresim = {
        ...cresim,
        cresceleons: cresim.cresceleons + salarioTotal,
        energy: Math.max(0, cresim.energy - energiaGasta),
        hygiene: Math.max(0, cresim.hygiene - 4),
        isBusy: false,
      }

      updateCresim(novoCresim, "cresceleons", novoCresim.cresceleons)
      updateCresim(novoCresim, "energy", novoCresim.energy)
      updateCresim(novoCresim, "hygiene", novoCresim.hygiene)
      updateCresim(novoCresim, "isBusy", novoCresim.isBusy)

      console.log(`${novoCresim.name} terminou o trabalho! Ganhou ${salarioTotal.toFixed(2)} Cresceleons.`)
    }, tempoTrabalho)
  } catch (error) {
    console.error("Erro ao buscar empregos:", error)
  }
};

// New Code
