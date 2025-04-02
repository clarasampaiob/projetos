<template>
  <div class="container">
    <div class="left-panel">
      <button @click="buscarOperadoras">Buscar Operadoras</button>
    </div>
    <div class="right-panel">
      <div v-if="resultados && resultados.length > 0" class="table-container">
        <table>
          <thead>
            <tr>
              <th>Registro ANS</th>
              <th>Total Lucro</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="operadora in resultados" :key="operadora.registro_ans">
              <td>{{ operadora.registro_ans }}</td>
              <td> R$ {{ operadora.total_lucro }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else-if="resultados && resultados.length === 0">
        <p>Nenhum resultado encontrado.</p>
      </div>
      <div v-else>
        <p class="msg">Clique no botão para buscar as 20 operadoras com maior lucro</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'App',
  data() {
    return {
      resultados: null,
    };
  },
  methods: {
    buscarOperadoras() {
      axios
        .get('http://localhost:5000/buscar')
        .then((response) => {
          this.resultados = response.data;
        })
        .catch((error) => {
          console.error('Erro ao buscar operadoras:', error);
        });
    },
  },
};
</script>

<style scoped>
body, html {
  margin: 0;
  padding: 0;
}

.container {
  display: flex;
  min-height: 100vh;
}

.left-panel {
  flex: 1;
  display: flex;
  align-items: flex-start;
  justify-content: center;
  padding: 20px;
  background-color:rgb(31, 26, 78);
}

.left-panel button {
  padding: 10px 20px;
  font-size: 17px;
  cursor: pointer;
  margin-top: 20px;
}

.right-panel {
  flex: 3;
  padding: 20px;
}

.table-container {
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}

.msg{
  font-size: 20px;
}
</style>