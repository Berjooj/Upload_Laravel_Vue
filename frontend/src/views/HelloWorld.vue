<template>
  <div class="container-fluid">
    <h1>{{ msg }}</h1>
    <p>
      For a guide and recipes on how to configure / customize this project,<br/>
      check out the
      <a href="https://cli.vuejs.org" target="_blank" rel="noopener"
      >vue-cli documentation</a
      >.
    </p>

    <!--    Mensagem caso não existam elementos na tabela-->
    <div class="alert-warning" role="alert" v-show="informacoes_basicas.length === 0">
      Nenhuma informação para ser mostrada.
    </div>

    <!--    Tabela-->
    <table class="table table-striped" v-show="informacoes_basicas.length > 0">
      <thead>
      <tr>
        <td>ID</td>
        <td>Dica</td>
        <td>Ferramentas</td>
      </tr>
      </thead>

      <tbody>
      <tr v-for="(informcao_basica, index) in informacoes_basicas" v-bind:key="informcao_basica.id">
        <td>{{ informcao_basica.id }}</td>
        <td>{{ informcao_basica.dica }}</td>
        <td>
          <button class="btn btn-secondary" v-on:click="editar(index)">Editar</button>
          <button class="btn btn-danger" v-on:click="remover(index)">Remover</button>
        </td>
      </tr>
      </tbody>
    </table>

    <!--  Form para adicionar-->
    <div class="form-group">
      <p>
        <input type="number" placeholder="Digite um id"
               name="idInformacoes"
               class="form-control"
               v-model="id"
        >
      </p>

      <p>
        <input type="text" placeholder="Digite um nome"
               name="dicaInformacoes"
               class="form-control"
               v-model="dica"
        >
      </p>
    </div>

    <button class="btn btn-primary" v-on:click="adicionar()">
      Adicionar
    </button>

  </div>
</template>

<script>
import Vue from 'vue'

export default {
  name: "HelloWorld",
  props: {
    msg: String,
  },
  data() {
    return {
      title: "HelloWorld",
      informacoes_basicas: [
        {id: 1, dica: "Tudo que está aqui dentro é retornado para o app"},
        {id: 2, dica: "v-for (item, index) para achar o indice da iteração"},
        {id: 3, dica: "V-for precisa de v-bind:key"},
        {id: 4, dica: "methods é onde ficam os métodos"},
        {id: 8, dica: `Versão do vue: ${Vue.version}`}
      ],
      id: '',
      dica: ''
    }
  },
  mounted() {
    this.msg = "Hello";
  },
  methods: {
    remover(index) {
      this.informacoes_basicas.splice(index, 1);
    },
    editar(index) {
      console.log(index);
    },
    adicionar() {

      this.informacoes_basicas.push({
        id: this.id,
        dica: this.dica
      });

      this.id = '';
      this.dica = '';
    }
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
