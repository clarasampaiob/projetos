import instrutores from './instrutores.json'
import { SuperArray } from '../src/super-array'

describe('Exemplo de testes', () => {
  it('Valor importado deve ser true', () => {
    expect(true).toBeTruthy()
  })
})



describe('SuperArray push method', () => {
  it('deve acrescentar um item no array', () => {
    const array = SuperArray([1, 2, 3]); 
    array.push(4); 
    const itemsAfter = array.itens.length; 
    expect(itemsAfter).toBe(4);
  });
});


describe('SuperArray forEach method', () => {
  it('deve percorrer todos os itens e imprimir o item', () => {
    console.log = jest.fn();
    const minhaLista = SuperArray([10, 20, 30]);

    minhaLista.forEach(item => {
      console.log(item);
    });

    expect(console.log).toHaveBeenCalledWith(10);
    expect(console.log).toHaveBeenCalledWith(20);
    expect(console.log).toHaveBeenCalledWith(30);
  });
});


describe('SuperArray filter method', () => {
  it('deve percorrer todos os itens e filtrar', () => {
    console.log = jest.fn();
    const meuArray = SuperArray([1, 2, 3])

    const meuArrayImpares = meuArray.filter(item => {
      return item % 2 !== 0
    })

    console.log = jest.fn();
    expect(meuArrayImpares.itens).toEqual([1, 3]);
  });
});


describe('SuperArray map method', () => {
  it('deve percorrer todos os itens e modificar', () => {
    console.log = jest.fn();
    const meuArray = SuperArray([1, 2, 3])

    const meuArrayDobrado = meuArray.map(item => {
      return item * 2;
    })

    expect(meuArrayDobrado.itens).toEqual([2, 4, 6]);
  });
});


describe('SuperArray find method', () => {
  it('deve percorrer todos os itens e encontrar o maior', () => {
    const meuArray = SuperArray([1, 2, 3])

    const primeiroNumeroMarioQue1 = meuArray.find(item => {
      return item > 1
    })

    expect(primeiroNumeroMarioQue1).toBe(2);
  });
});


describe('SuperArray reduce method', () => {
  it('deve percorrer todos os itens e somar seus valores', () => {
    const meuArray = SuperArray([1, 2, 3])
    
    const somaMeuArray = meuArray.reduce((acumulador, item) => {
      return acumulador += item
    }, 0)

    expect(somaMeuArray).toBe(6);
  });
});


describe('SuperArray push instrutor', () => {
  it('push deve adicionar um novo instrutor ao meu super array', () => {
    const meuSuperArray = SuperArray(instrutores);
    meuSuperArray.push({ nome: 'Clara', dandoAula: false });
  
    expect(meuSuperArray.itens.length).toBe(instrutores.length + 1);
    expect(meuSuperArray.itens[meuSuperArray.itens.length - 1]).toEqual({ nome: 'Clara', dandoAula: false });
  });
});


describe('SuperArray foreach instrutor', () => {
  it('forEach deve passar por todos os instrutores e chamando o callback esperado', () => {
    const meuSuperArray = SuperArray(instrutores);
    const callbackMock = jest.fn();
    meuSuperArray.forEach(callbackMock);

    expect(callbackMock).toHaveBeenCalledTimes(instrutores.length);
  });
});


describe('SuperArray filter instrutor', () => {
  it('filter deve retornar um novo array apenas com os instrutores que estão dando aula', () => {
    const meuSuperArray = SuperArray(instrutores);
    const instrutoresDandoAula = meuSuperArray.filter(instrutor => instrutor.dandoAula);

    expect(instrutoresDandoAula.itens.length).toBe(2);
    expect(instrutoresDandoAula.itens).toEqual([
        { "nome": "Gustavo Büttenbender Rodrigues", "dandoAula": true },
        { "nome": "William Cardozo", "dandoAula": true }
    ]);
  });
});


describe('SuperArray map instrutor', () => {
  it('map deve retornar um novo array com o numero de nomes que o instrutor tem', () => {
    const meuSuperArray = SuperArray(instrutores);
    const numerosDeNomes = meuSuperArray.map(instrutor => instrutor.nome.split(" ").length);
    expect(numerosDeNomes.itens).toEqual([2, 2, 2, 3, 2, 2, 2, 3]);
  });
});


describe('SuperArray find instrutor', () => {
  it('find deve retornar o primeiro instrutor que está dando aula', () => {
    const meuSuperArray = SuperArray(instrutores);
    const primeiroInstrutorDandoAula = meuSuperArray.find(instrutor => instrutor.dandoAula);
    expect(primeiroInstrutorDandoAula).toEqual({ "nome": "Gustavo Büttenbender Rodrigues", "dandoAula": true });
  });
});



describe('SuperArray reduce letras nomes instrutores', () => {
  it('reduce deve retornar o total de letras no nome dos instrutores', () => {
    const meuSuperArray = SuperArray(instrutores);
    const totalLetras = meuSuperArray.reduce((acumulador, instrutor) => acumulador + instrutor.nome.replace(/\s+/g, '').length, 0);
    expect(totalLetras).toBe(126);
  });
});


describe('SuperArray reduce boolean aulas instrutores', () => {
  it('reduce deve retornar um boolean se todos os instrutores estão dando aula', () => {
    const meuSuperArray = SuperArray(instrutores);
    
    const todosDandoAula = meuSuperArray.reduce((acc, instrutor) => acc && instrutor.dandoAula, true);
    expect(todosDandoAula).toBe(false);

    const meuSuperArray2 = SuperArray([
      { "nome": "Gustavo Büttenbender Rodrigues", "dandoAula": true },
      { "nome": "William Cardozo", "dandoAula": true }
    ])
      const todosDandoAula2 = meuSuperArray2.reduce((acc, instrutor) => acc && instrutor.dandoAula, true);
      expect(todosDandoAula2).toBe(true);
  });
});




