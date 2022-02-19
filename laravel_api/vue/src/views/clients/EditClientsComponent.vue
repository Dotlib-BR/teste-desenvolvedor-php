<template>
    <DashboardComponent>
        <div slot="slot-pages" class="content-pages">
            <b-card class="card shadow mx-4">
                <b-row class="mx-2">
                    <b-col>
                        <h2 class="text-start"><i class="fa fa-user"></i> {{form.name.text}}</h2>
                    </b-col>
                    <b-col>
                        <p class="text-end"><b>Última alteração: {{form.last_update}}</b></p>
                    </b-col>
                </b-row>
                <hr class="mt-0 pt-0" />
                <b-form @submit="onSubmit">
                    <b-alert
                        :show="dismissCountDown"
                        variant="success"
                        @dismissed="dismissCountDown=0"
                        @dismiss-count-down="countDownChanged"
                    >
                        Tudo certo! Redirecionamento em {{ dismissCountDown }} seconds...
                    </b-alert>
                    <b-row class="mt-4 px-2">
                        <b-col cols="12" md="4">
                            <b-form-group id="input-group-name" label="Seu Nome Completo" label-for="input-name">
                                <b-form-input id="input-name" v-model="form.name.text" :state="form.name.statsInput" placeholder="Name"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.name.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="4">
                            <b-form-group id="input-group-email" label="E-mail" label-for="input-email">
                                <b-form-input id="input-email" v-model="form.email.text" :state="form.email.statsInput" type="email" placeholder="E-mail" />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.email.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="4">
                            <b-form-group id="input-group-date_birth" label="Data de nascimento" label-for="input-date_birth">
                                <b-form-input id="input-date_birth" v-model="form.date_birth.text" :state="form.date_birth.statsInput" type="date"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.date_birth.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                    </b-row>
                    <b-row class="mt-4 px-2">
                        <b-col cols="12" md="3">
                            <b-form-group id="input-group-cpf" label="CPF" label-for="input-cpf">
                                <b-form-input id="input-cpf" v-model="form.cpf.text" :state="form.cpf.statsInput" v-mask="'###.###.###-##'" placeholder="CPF"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.cpf.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="3">
                            <b-form-group id="input-group-phone" label="Telefone" label-for="input-phone">
                                <b-form-input id="input-phone" v-model="form.phone.text" :state="form.phone.statsInput" v-mask="'(##) ####-####'" placeholder="Phone"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.phone.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="3">
                            <b-form-group id="input-group-stats" label="Status" label-for="input-stats">
                                <b-form-select id="input-stats" v-model="form.stats.text" :state="form.stats.statsInput" :options="status" class="form-control"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.stats.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="3">
                            <b-form-group id="input-group-sex" label="Sexo" label-for="input-sex">
                                <b-form-select id="input-sex" v-model="form.sex.text" :state="form.sex.statsInput" :options="sexos" class="form-control"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.sex.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                    </b-row>
                    <b-row class="mt-4 px-2">
                        <b-col cols="8" md="4">
                            <b-form-group id="input-group-cep" label="CEP" label-for="input-cep">
                                <b-form-input id="input-cep" v-model="form.cep.text" :state="form.cep.statsInput" v-mask="'#####-###'" placeholder="CEP"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.cep.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="1" md="1" class="pt-4">
                            <b-button pill @click="viaCep" :disabled="statsButton" variant="primary" class="text-light d-flex">
                                <b-spinner id="spin" role="stats" small label="Small Spinner" class="m-2 mt-1 mb-1 my-auto d-none"></b-spinner>
                                Buscar
                            </b-button>
                        </b-col>
                    </b-row>
                    <b-row class="mt-4 px-2">
                        <b-col cols="12" md="4">
                            <b-form-group id="input-group-address" label="Endereço" label-for="input-address">
                                <b-form-input id="input-address" v-model="form.address.text" :state="form.address.statsInput" readonly placeholder="Address"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.address.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="4">
                            <b-form-group id="input-group-complement" label="Complemento" label-for="input-complement">
                                <b-form-input id="input-complement" v-model="form.complement.text" :state="form.complement.statsInput" :readonly="form.address.text == '' ? true : false" placeholder="Complement"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.complement.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="4">
                            <b-form-group id="input-group-city" label="Cidade" label-for="input-city">
                                <b-form-input id="input-city" v-model="form.city.text" :state="form.city.statsInput" readonly placeholder="City"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.city.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        
                    </b-row>

                    <div class="mt-4 d-flex gap-3 justify-content-center">
                        <b-button pill @click="onSubmit" :disabled="statsButton" variant="info">Salvar</b-button>
                        <b-button pill @click="onBack" :disabled="statsButton" variant="dark" class="text-light">Voltar</b-button>
                    </div>
                </b-form>
            </b-card>
        </div>
    </DashboardComponent>
</template>

<script>
/* eslint-disable */
    import DashboardComponent from '../Dashboard/DashboardComponent';
    import moment from 'moment';
    const axios = require('axios');

    export default {
        name: 'EditClientsComponent.vue',

        data() {
            return {
                form: {
                    name: {text: '', statsInput: null, erro: ''},
                    email: {text: '', statsInput: null, erro: ''},
                    date_birth: {text: '', statsInput: null, erro: ''},
                    cpf: {text: '', statsInput: null, erro: ''},
                    phone: {text: '', statsInput: null, erro: ''},
                    stats: {text: null, statsInput: null, erro: ''},
                    cep: {text: '', statsInput: null, erro: ''},
                    address: {text: '', statsInput: null, erro: ''},
                    complement: {text: '', statsInput: null, erro: ''},
                    city: {text: '', statsInput: null, erro: ''},
                    sex: {text: null, statsInput: null, erro: ''},
                    last_update: '',
                },
                status: [{ text: 'Escolha...', value: null, disabled: true, }, { text: 'Ativo', value: 1 }, { text: 'Inativo', value: 0 }],
                sexos: [{ text: 'Escolha...', value: null, disabled: true, }, { text: 'Masculino', value: '2' }, { text: 'Feminino', value: '1' }, { text: 'Outro', value: '0' }],
                /* Alert */
                dismissSecs: 3,
                dismissCountDown: 0,
                /* Valid Input */
                statsInput: null,
                statsButton: false,
                /* verificação */
                cep_const: '',
            }
        },
        methods: {
            getClient() {
                this.$http.get(`clients/edit/${this.$route.params.client}`).then((response) => {
                    this.form.name.text = response.data.name
                    this.form.email.text = response.data.email
                    this.form.date_birth.text = response.data.date_birth
                    this.form.cpf.text = response.data.cpf
                    this.form.phone.text = response.data.phone
                    this.form.stats.text = response.data.stats
                    this.form.cep.text = response.data.cep
                    this.form.address.text = response.data.address
                    this.form.complement.text = response.data.complement
                    this.form.city.text = response.data.city
                    this.form.sex.text = response.data.sex
                    this.form.last_update = response.data.updated_at
                    this.cep_const = response.data.cep
                    this.formatarData()
                });
            },
            dataForm(option) {
                if (option == 'update') {
                    var data = { 
                        name: this.form.name.text, 
                        email: this.form.email.text, 
                        date_birth: this.form.date_birth.text, 
                        cpf: this.form.cpf.text, 
                        phone: this.form.phone.text, 
                        stats: this.form.stats.text, 
                        cep: this.form.cep.text, 
                        address: this.form.address.text, 
                        complement: this.form.complement.text, 
                        city: this.form.city.text, 
                        sex: this.form.sex.text,
                    }
                    return data;

                } else if (option == 'statsInput') {
                    this.form.name.statsInput = true;
                    this.form.email.statsInput = true;
                    this.form.date_birth.statsInput = true;
                    this.form.cpf.statsInput = true;
                    this.form.phone.statsInput = true;
                    this.form.stats.statsInput = true;
                    this.form.cep.statsInput = true;
                    this.form.address.statsInput = true;
                    this.form.complement.statsInput = true;
                    this.form.city.statsInput = true;
                    this.form.sex.statsInput = true;
                } else if (option == 'statsInputNull') {
                    this.form.name.statsInput = null;
                    this.form.email.statsInput = null;
                    this.form.date_birth.statsInput = null;
                    this.form.cpf.statsInput = null;
                    this.form.phone.statsInput = null;
                    this.form.stats.statsInput = null;
                    this.form.cep.statsInput = null;
                    this.form.address.statsInput = null;
                    this.form.complement.statsInput = null;
                    this.form.city.statsInput = null;
                    this.form.sex.statsInput = null;
                }
            },
            validacao(error) {
                if(error.response.data.errors['name']) {
                    this.form.name.statsInput = false;
                    this.form.name.erro = error.response.data.errors['name'][0];
                } else {
                    this.form.name.statsInput = true;
                }

                if(error.response.data.errors['email']) {
                    this.form.email.statsInput = false;
                    this.form.email.erro = error.response.data.errors['email'][0];
                } else {
                    this.form.email.statsInput = true;
                }

                if(error.response.data.errors['date_birth']) {
                    this.form.date_birth.statsInput = false;
                    this.form.date_birth.erro = error.response.data.errors['date_birth'][0];
                } else {
                    this.form.date_birth.statsInput = true;
                }

                if(error.response.data.errors['cpf']) {
                    this.form.cpf.statsInput = false;
                    this.form.cpf.erro = error.response.data.errors['cpf'][0];
                } else {
                    this.form.cpf.statsInput = true;
                }

                if(error.response.data.errors['phone']) {
                    this.form.phone.statsInput = false;
                    this.form.phone.erro = error.response.data.errors['phone'][0];
                } else {
                    this.form.phone.statsInput = true;
                }

                if(error.response.data.errors['stats']) {
                    this.form.stats.statsInput = false;
                    this.form.stats.erro = error.response.data.errors['stats'][0];
                } else {
                    this.form.stats.statsInput = true;
                }

                if(error.response.data.errors['cep']) {
                    this.form.cep.statsInput = false;
                    this.form.cep.erro = error.response.data.errors['cep'][0];
                } else {
                    this.form.cep.statsInput = true;
                }

                if(error.response.data.errors['address']) {
                    this.form.address.statsInput = false;
                    this.form.address.erro = error.response.data.errors['address'][0];
                } else {
                    this.form.address.statsInput = true;
                }

                if(error.response.data.errors['complement']) {
                    this.form.complement.statsInput = false;
                    this.form.complement.erro = error.response.data.errors['complement'][0];
                } else {
                    this.form.complement.statsInput = true;
                }

                if(error.response.data.errors['city']) {
                    this.form.city.statsInput = false;
                    this.form.city.erro = error.response.data.errors['city'][0];
                } else {
                    this.form.city.statsInput = true;
                }

                if(error.response.data.errors['sex']) {
                    this.form.sex.statsInput = false;
                    this.form.sex.erro = error.response.data.errors['sex'][0];
                } else {
                    this.form.sex.statsInput = true;
                }

            },
            onSubmit() {
                if (this.form.cep.text != this.cep_const) {
                    this.viaCep()
                    this.cep_const = this.form.cep.text

                } else {
                    this.$http.put(`/clients/update/${this.$route.params.client}`, this.dataForm('update')).then((response) => {
                        if (response.data == 'success') {
                            this.dataForm('statsInput');
                            this.statsButton = true
                            this.countDownChanged(this.dismissSecs)
                            
                            setTimeout(() => {
                                this.$router.push('/clients')
                            }, 5000)
                        } 

                    }, (error) => {
                        this.validacao(error);
                    });
                }
            },
            onBack() {
                this.$router.push('/clients');
            },
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            },
            formatarData() {
                let data = this.form.last_update;
                this.form.last_update = moment(data).format('DD/MM/YYYY HH:mm:ss');
            },
            viaCep() {
                if (this.form.cep.text.length == 9) {
                    axios.get(`https://viacep.com.br/ws/${this.form.cep.text}/json/`).then((response) => {
                        if (!response.data.erro) {
                            document.getElementById('spin').classList.remove('d-none');
                            setTimeout(() => {
                                document.getElementById('spin').classList.add('d-none');
                                this.form.address.text = response.data.logradouro;
                                this.form.complement.text = response.data.complemento;
                                this.form.city.text = response.data.localidade;
                                this.form.cep.statsInput = true
                            }, 1000)

                        } else {
                            this.form.address.text = '';
                            this.form.complement.text = '';
                            this.form.city.text = '';
                            this.form.cep.erro = 'CEP inválido'
                            this.form.cep.statsInput = false
                        }
                    });
                } else {
                    this.form.cep.erro = 'CEP incompleto'
                    this.form.cep.statsInput = false
                    this.form.address.text = '';
                    this.form.complement.text = '';
                    this.form.city.text = '';
                }
            }
        },
        created() {
            if (this.$route.params.client)
                this.getClient()
        },
        components: {
            DashboardComponent,
        },
    }
</script>

<style src="./input.css" scoped/>