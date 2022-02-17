<template>
    <div>
        <h1>Editar usuário {{ this.$route.params.usuario }}</h1>
        <div class="row px-5">
          <div class="col-6">
            <b-form-input v-model="nome" placeholder="Nome"></b-form-input>
          </div>
          <div class="col-6"> 
            <b-form-input v-model="email" placeholder="E-mail"></b-form-input>
          </div>
        </div>
        <div class="row mt-4  px-5">
          <div class="col-12 text-end">
            <div class="row">
              <div v-if="excluido" class="alert alert-success col-6 text-center">
                Excluido com Sucesso!!
              </div>
              <div class="col-6 my-auto">
                <b-button @click="voltar" variant="info">Voltar</b-button>
                <b-button @click="excluir" block variant="danger ms-3">Excluir</b-button>
                <b-button @click="update" block variant="primary ms-3">Salvar</b-button>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
      data() {
        return {
          nome: "",
          email: "",
          excluido: false,
        };
      },
      methods: {
        getUsers() {
          this.$http.get(`editar/${this.$route.params.usuario}`).then((response) => {
            this.nome = response.data.nome
            this.email = response.data.email
          })
        },
        update() {
          var data = {name:this.nome, email:this.email}
          console.log(data);

          this.$http.put(`update/${this.$route.params.usuario}`, data).then((response) => {
            console.log(response)
          })
        },
        excluir() {
          this.$http.delete(`delete/${this.$route.params.usuario}`).then((response) => {
            if(response.data == 'success'){
              this.excluido = true

              setTimeout(() => {
                this.$router.push('/lista')
              }, 2000)
            }
          })
        },
        voltar() {
          this.$router.push('/lista')
        }
      },
      created() {
        this.getUsers()
      },
    }
</script>

<style lang="scss" scoped>

</style>