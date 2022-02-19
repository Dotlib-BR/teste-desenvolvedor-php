<template>
    <DashboardComponent>
        <div slot="slot-pages" class="content-pages">
            <b-card class="card shadow mx-4">
                <b-row class="mx-2">
                    <b-col>
                        <h2 class="text-start"><i class="fas fa-toolbox"></i> {{form.name.text}}</h2>
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
                            <b-form-group id="input-group-cod_bars" label="Código de Barras" label-for="input-cod_bars">
                                <b-form-input id="input-cod_bars" v-model="form.cod_bars.text" :state="form.cod_bars.statsInput" :minlength="form.cod_bars.min" :maxlength="form.cod_bars.max" placeholder="Bar Code"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.cod_bars.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="4">
                            <b-form-group id="input-group-name" label="Nome Produto" label-for="input-name">
                                <b-form-input id="input-name" v-model="form.name.text" :state="form.name.statsInput" placeholder="Name"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.name.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="4">
                            <b-form-group id="input-group-value" label="Valor" label-for="input-value">
                                <b-form-input id="input-value" v-model="form.value.text" :state="form.value.statsInput" v-mask="'####.##'" placeholder="Value R$"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.value.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                    </b-row>
                    <b-row class="mt-4 px-2">
                        <b-col cols="12" md="4">
                            <b-form-group id="input-group-amount" label="Quantidade" label-for="input-amount">
                                <b-form-input id="input-amount" v-model="form.amount.text" :state="form.amount.statsInput" :maxlength="form.amount.max" placeholder="Amount"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.amount.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="3">
                            <b-form-group id="input-group-stats" label="Status" label-for="input-stats">
                                <b-form-select id="input-stats" v-model="form.stats.text" :state="form.stats.statsInput" :options="status" class="form-control"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.stats.erro   }}</b-form-invalid-feedback>
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

    export default {
        name: 'EditProductsComponent.vue',

        data() {
            return {
                form: {
                    cod_bars: {text: '', statsInput: null, erro: '', min: 10, max: 10},
                    name: {text: '', statsInput: null, erro: ''},
                    value: {text: '', statsInput: null, erro: ''},
                    amount: {text: '', statsInput: null, erro: '', max: 3},
                    stats: {text: null, statsInput: null, erro: ''},
                    last_update: '',
                },
                status: [{ text: 'Escolha...', value: null, disabled: true, }, { text: 'Ativo', value: 1 }, { text: 'Inativo', value: 0 }],
                /* Alert */
                dismissSecs: 3,
                dismissCountDown: 0,
                /* Valid Input */
                statsInput: null,
                statsButton: false,
            }
        },
        methods: {
            getProduct() {
                this.$http.get(`products/edit/${this.$route.params.product}`).then((response) => {
                    this.form.cod_bars.text = response.data.cod_bars
                    this.form.name.text = response.data.name
                    this.form.value.text = response.data.value
                    this.form.amount.text = response.data.amount
                    this.form.stats.text = response.data.stats
                    this.form.last_update = response.data.updated_at
                    this.formatarData()
                });
            },
            dataForm(option) {
                if (option == 'update') {
                    var data = { 
                        cod_bars: this.form.cod_bars.text, 
                        name: this.form.name.text, 
                        value: this.form.value.text,
                        amount: this.form.amount.text,
                        stats: this.form.stats.text, 
                    }
                    return data;

                } else if (option == 'statsInput') {
                    this.form.cod_bars.statsInput = true;
                    this.form.name.statsInput = true;
                    this.form.value.statsInput = true;
                    this.form.amount.statsInput = true;
                    this.form.stats.statsInput = true;
                } else if (option == 'statsInputNull') {
                    this.form.cod_bars.statsInput = null;
                    this.form.name.statsInput = null;
                    this.form.value.statsInput = null;
                    this.form.amount.statsInput = null;
                    this.form.stats.statsInput = null;
                }
            },
            validacao(error) {
                if(error.response.data.errors['cod_bars']) {
                    this.form.cod_bars.statsInput = false;
                    this.form.cod_bars.erro = error.response.data.errors['cod_bars'][0];
                } else {
                    this.form.cod_bars.statsInput = true;
                }

                if(error.response.data.errors['name']) {
                    this.form.name.statsInput = false;
                    this.form.name.erro = error.response.data.errors['name'][0];
                } else {
                    this.form.name.statsInput = true;
                }

                if(error.response.data.errors['value']) {
                    this.form.value.statsInput = false;
                    this.form.value.erro = error.response.data.errors['value'][0];
                } else {
                    this.form.value.statsInput = true;
                }

                if(error.response.data.errors['amount']) {
                    this.form.amount.statsInput = false;
                    this.form.amount.erro = error.response.data.errors['amount'][0];
                } else {
                    this.form.amount.statsInput = true;
                }

                if(error.response.data.errors['stats']) {
                    this.form.stats.statsInput = false;
                    this.form.stats.erro = error.response.data.errors['stats'][0];
                } else {
                    this.form.stats.statsInput = true;
                }

            },
            onSubmit() {
                this.$http.put(`/products/update/${this.$route.params.product}`, this.dataForm('update')).then((response) => {
                    console.log(response);
                    if (response.data == 'success') {
                        this.dataForm('statsInput');
                        this.statsButton = true
                        this.countDownChanged(this.dismissSecs)
                        
                        setTimeout(() => {
                            this.$router.push('/products')
                        }, 5000)
                    } 

                }, (error) => {
                    this.validacao(error);
                });
            },
            onBack() {
                this.$router.push('/products');
            },
            formatarData() {
                let data = this.form.last_update;
                this.form.last_update = moment(data).format('DD/MM/YYYY HH:mm:ss');
            },
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            },
        },
        created() {
            if (this.$route.params.product)
                this.getProduct()
        },
        components: {
            DashboardComponent,
        },
    }
</script>

<style src="./input.css" scoped/>