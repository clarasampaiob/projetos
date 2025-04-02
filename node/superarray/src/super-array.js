export const SuperArray = (itens = []) => {

  const array = {
    /**
     * Propriedade para acessar os itens
     */

    itens: [...itens],
  }

  /**
   * Adicionar um novo item ao final dos items
   */

  array.push = (item) => {
    const lastKey = array.itens.length; 
    console.log('Número de itens antes de inserir:', lastKey);
    array.itens[lastKey] = item;
    console.log('Número de itens após inserir:', array.itens.length);
    return array;
  };
  

  /**
   * Itera sobre cada um dos elementos do SuperArray enviando o item e o index
   * como segundo parametro
   */

  array.forEach = callback => {
    for (let i = 0; i < array.itens.length; i++) {
      callback(array.itens[i]); 
    }
    return array;
  }

  /**
   * Retorna um novo SuperArray com os itens mapeados
   */

  array.map = callback => {
    let newArray = [];
    for (let i = 0; i < array.itens.length; i++) {
      newArray.push(callback(array.itens[i]));
    }
    return SuperArray(newArray);
  }


  /**
   * Retorna um SuperArray novo com os itens filtrados
   */

  array.filter = callback => {
    let newArray = [];
    for (let i = 0; i < array.itens.length; i++) {
      if (callback(array.itens[i])) { 
        newArray.push(array.itens[i]);
      }
    }
    return SuperArray(newArray);
  }


  /**
   * Retorna o primeiro elemento do SuperArray que satisfazer o callback recebido
   * se não encontrar, deve retornar undefined
   */

  array.find = callback => {
    for (let i = 0; i < array.itens.length; i++) {
      if (callback(array.itens[i])) {
        return array.itens[i]; 
      }
    }
    return undefined;
  }

  /**
   * Reduz o SuperArray em um único valor
   */


  array.reduce = (callback, valorInicial) => {
    let acumulador = valorInicial;
    for (let i = 0; i < array.itens.length; i++) {
        acumulador = callback(acumulador, array.itens[i]); 
    }
    return acumulador;
  }

  return array
}
