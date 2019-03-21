<template>
  <v-layout align-center justify-center>
    <v-flex md8>
      <v-card>
        <v-toolbar color="primary" dark>
          <v-toolbar-title>Criar Novo Cliente</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
          <v-alert
            :value="success"
            type="success"
            outline v-text="successMsg">
          </v-alert>
          <v-form ref="form">
            <v-text-field :readonly="submitting" label="CPF" v-model="form.CPF" :error-messages="errors.CPF"></v-text-field>
            <v-text-field :readonly="submitting" label="Nome" v-model="form.Nome" :error-messages="errors.Nome"></v-text-field>
            <v-text-field :readonly="submitting" label="E-mail" v-model="form.Email" :error-messages="errors.Email"></v-text-field>
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
        CPF: '',
        Nome: '',
        Email: ''
      },
      errors: {
        CPF: [],
        Nome: [],
        Email: []
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

      const { data } = await axios.post('/api/clientes', this.form)

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
