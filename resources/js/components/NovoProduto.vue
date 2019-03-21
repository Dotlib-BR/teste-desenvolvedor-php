<template>
  <v-layout align-center justify-center>
    <v-flex md8>
      <v-card>
        <v-toolbar color="primary" dark>
          <v-toolbar-title>Criar Novo Produto</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
          <v-alert
            :value="success"
            type="success"
            outline v-text="successMsg">
          </v-alert>
          <v-form ref="form">
            <v-text-field :readonly="submitting" label="Código de Barras" v-model="form.CodBarras" :error-messages="errors.CodBarras"></v-text-field>
            <v-text-field :readonly="submitting" label="Nome" v-model="form.Nome" :error-messages="errors.Nome"></v-text-field>
            <v-text-field :readonly="submitting" label="Valor Unitário (R$)" v-model="form.ValorUnitario" :error-messages="errors.ValorUnitario"></v-text-field>
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
  data() {
    return {
      form: {
        CodBarras: '',
        Nome: '',
        ValorUnitario: ''
      },
      errors: {
        CodBarras: [],
        Nome: [],
        ValorUnitario: []
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

      const { data } = await axios.post('/api/produtos', this.form)

      if (data.status === 'error') {
        this.setErrors(data.result)
      } else {
        this.successMsg = data.message
        this.success = true
        this.clearForm()
      }

      this.submitting = false
    }
  }
}
</script>
