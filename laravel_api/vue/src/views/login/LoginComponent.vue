<template>
  <div class="main">
    <div class="login">
      <div class="content-login">
        <header>
          <h1>Login do Sistema</h1>
        </header>
        <div class="form">
          <b-form @submit="onSubmit" v-if="show">
            <b-form-group
              id="input-group-1"
              label="Email"
              label-for="input-1"
              class="text-light text-start fs-5"
            >
              <b-form-input
                id="input-1"
                v-model="email"
                type="email"
                placeholder="Insira seu email..."
                required
              ></b-form-input>
            </b-form-group>

            <b-form-group
              id="input-group-2"
              label="Senha"
              label-for="input-2"
              class="text-light text-start fs-5 mt-3"
            >
              <b-form-input
                id="input-2"
                v-model="password"
                type="password"
                placeholder="Insira sua senha..."
                required
              ></b-form-input>
            </b-form-group>

            <div class="text-end">
                <b-button type="submit" variant="primary" class="mt-3 px-4 fs-5">Entrar</b-button>
            </div>
          </b-form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    name: 'LoginComponent',

    data() {
        return {
            email: "",
            password: "",
            show: true,
        };
    },
    methods: {
        onSubmit(event) {
          this.$router.push('/');
        },
    },
};
</script>

<style src="./input.css" scoped/>