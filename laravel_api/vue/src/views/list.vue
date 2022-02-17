<template>
  <div>
    <div>
      <b-button v-b-modal.modal-1 class="me-3">Adicionar Usuário</b-button>
      <b-button @click="getListagem" variant="warning">Atualizar Lista</b-button>

      <b-modal id="modal-1" title="New User">
        <div class="row">
          <div class="col-6">
            <b-form-input v-model="nome" placeholder="nome"></b-form-input>
            {{nome}}
          </div>
          <div class="col-6"> 
            <b-form-input v-model="email" placeholder="E-mail"></b-form-input>
            {{email}}
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-12 text-end">
            <b-button @click="addUsuario" block variant="primary">Salvar</b-button>
          </div>
        </div>
      </b-modal>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Nome</th>
          <th scope="col">Email</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in listagem" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.nome }}</td>
          <td>{{ user.email }}</td>
          <td>
            <router-link :to="{name:'Editar', params:{usuario:user.id}}">
              <b-button variant="outline-primary">Editar</b-button>
            </router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      listagem: [],
      id: '',
      nome: '',
      email: ''
    };
  },
  methods: {
    adicionarListagem() {
        //
    },
    addUsuario() {
      var data = {name: this.nome, email: this.email}
      /* var data2 = {id: this.id, nome: this.nome, email: this.email} */
      this.$http.post('adicionar', data).then((response) => {
        console.log(response)
      })
      
      this.nome = ''
      this.email = ''
      this.getListagem()
    },
    getListagem() {
      this.$http.get('lista').then((response) => {
        this.listagem = response.data
      })
    }
  },
  created() {
    this.getListagem()
  },
};
</script>

<style lang="scss" scoped>
</style>