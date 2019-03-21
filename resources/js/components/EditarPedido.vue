<template>
  <v-layout align-center justify-center>
    <v-flex md8>
      <v-card>
        <v-toolbar color="primary" dark>
          <v-toolbar-title>Criar Novo Pedido</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
          <v-alert
            :value="success"
            type="success"
            outline v-text="successMsg">
          </v-alert>
          <v-form ref="form">
            <v-select :items="clientes" item-text="Nome" item-value="id" label="Cliente" v-model="form.ClienteId" :error-messages="errors.ClienteId"></v-select>
            <v-select :items="produtos" item-text="Nome" item-value="id" label="Produto" v-model="form.ProdutoId" :error-messages="errors.ProdutoId"></v-select>
            <v-text-field :readonly="submitting" label="Quantidade" v-model="form.Quantidade" :error-messages="errors.Quantidade" type="number"></v-text-field>
            <v-menu
              v-model="menu"
              :close-on-content-click="false"
              :nudge-right="40"
              lazy
              transition="scale-transition"
              offset-y
              full-width
              min-width="290px">

              <template v-slot:activator="{ on }">
                <v-text-field
                  v-model="form.DtPedido"
                  label="Data do Pedido"
                  readonly
                  v-on="on"
                ></v-text-field>
              </template>

              <v-date-picker v-model="form.DtPedido" @input="menu = false" locale="pt-br"></v-date-picker>
            </v-menu>
            <v-select :items="statusItems" label="Status" v-model="form.Status" :error-messages="errors.Status"></v-select>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-btn :loading="submitting" color="primary" @click="submitForm">Salvar</v-btn>
          <v-btn :loading="submitting" color="yellow darken-4" @click="clearForm">Limpar</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  async mounted() {
    const clienteResponse = await axios.get('/api/clientes')
    this.clientes = clienteResponse.data.result.data
    const produtoResponse = await axios.get('/api/produtos')
    this.produtos = produtoResponse.data.result.data

    const id = localStorage.getItem('pedido-edit-id')
    if (!!id) {
      this.id = id
      const { data } = await axios.get(`/api/pedidos/${id}`)
      this.form.ClienteId = data.result.ClienteId
      this.form.ProdutoId = data.result.ProdutoId
      this.form.Quantidade = data.result.Quantidade
      this.form.DtPedido = data.result.DtPedido
      this.form.Status = data.result.Status
    } else {
      this.$router.go(-1)
    }
    localStorage.removeItem('pedido-edit-id')
  },

  data() {
    return {
      id: 0,
      menu: false,
      statusItems: [
        { text: 'Cancelado', value: -1 },
        { text: 'Em Aberto', value: 0 },
        { text: 'Pago', value: 1 }
      ],
      clientes: [],
      produtos: [],
      form: {
        ClienteId: '',
        ProdutoId: '',
        Quantidade: '',
        DtPedido: '',
        Status: ''
      },
      errors: {
        ClienteId: [],
        ProdutoId: [],
        Quantidade: [],
        DtPedido: [],
        Status: []
      },
      submitting: false,
      successMsg: '',
      success: false
    }
  },

  methods: {
    clearForm() {
      this.clearErrors()
      for (let key in this.form) {
        this.form[key] = ''
      }
    },

    setErrors(errors) {
      this.errors = errors
    },

    clearErrors() {
      for (let key in this.errors) {
        this.errors[key] = []
      }
    },

    async submitForm() {
      this.clearErrors()
      this.submitting = true

      const { data } = await axios.put(`/api/pedidos/${this.id}`, this.form)

      if (data.status === 'error') {
        this.setErrors(data.result)
      } else {
        this.successMsg = data.message
        this.success = true
        this.clearForm()
        this.$router.go(-1)
      }

      this.submitting = false
    }
  }
}
</script>
