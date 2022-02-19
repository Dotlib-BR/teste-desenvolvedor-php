<template>
    <DashboardComponent>
        <div slot="slot-pages" class="content-pages">
            <b-card class="card shadow mx-4">
                <b-row class="mx-2">
                    <b-col>
                        <h2 class="text-start"><i class="fas fa-box"></i> Pedido Nº{{form.id}}</h2>
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
                        <b-col cols="12" md="6">
                            <b-form-group id="input-group-client" label="Cliente" label-for="input-client">
                                <b-form-input id="input-client" v-model="form.client.text" readonly/>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group id="input-group-product" label="Produto" label-for="input-product">
                                <b-form-input id="input-product" v-model="form.product.text" readonly/>
                            </b-form-group>
                        </b-col>
                    </b-row>
                    <b-row class="mt-4 px-2">
                        <b-col cols="12" md="6">
                            <b-form-group id="input-group-date_pedido" label="Data do Pedido" label-for="input-date_pedido">
                                <b-form-input id="input-date_pedido" v-model="form.date_pedido.text" :state="form.date_pedido.statsInput" type="datetime-local"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.date_pedido.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group id="input-group-stats" label="Status" label-for="input-stats">
                                <b-form-select id="input-stats" v-model="form.stats.text" :state="form.stats.statsInput" :options="status" class="form-control"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.stats.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                    </b-row>

                    <div class="mt-4 d-flex gap-3 justify-content-center">
                        <b-button v-if="form.situation_stats == 1" pill @click="onSubmit" :disabled="statsButton" variant="info">Salvar</b-button>
                        <b-button v-else disabled aria-disabled="true" pill @click="onSubmit" variant="info">Salvar</b-button>
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
        name: 'EditPedidosComponent.vue',

        data() {
            return {
                form: {
                    id: '',
                    client: {text: ''},
                    product: {text: ''},
                    date_pedido: {text: '', statsInput: null, erro: ''},
                    stats: {text: null, statsInput: null, erro: ''},
                    situation_stats: '',
                    last_update: '',
                },
                status: [{ text: 'Escolha...', value: null, disabled: true, }, { text: 'Pago', value: 2 }, { text: 'Em Aberto', value: 1 }, { text: 'Cancelado', value: 0 }],
                /* Alert */
                dismissSecs: 3,
                dismissCountDown: 0,
                /* Valid Input */
                statsInput: null,
                statsButton: false,
            }
        },
        methods: {
            getPedido() {
                this.$http.get(`pedidos/edit/${this.$route.params.pedido}`).then((response) => {
                    this.form.id = response.data.id
                    this.form.client.text = response.data.name_client+' --- CPF: '+response.data.cpf_client
                    this.form.product.text = response.data.name_product+' --- R$ '+response.data.value_un_product+' un'
                    this.form.date_pedido.text = response.data.date_pedido
                    this.form.stats.text = response.data.stats
                    this.form.situation_stats = response.data.stats
                    this.form.last_update = response.data.updated_at
                    this.formatarData()
                });
            },
            dataForm(option) {
                if (option == 'update') {
                    var data = { 
                        id: this.form.id,
                        date_pedido: this.form.date_pedido.text, 
                        stats: this.form.stats.text, 
                    }
                    return data;

                } else if (option == 'statsInput') {
                    this.form.date_pedido.statsInput = true;
                    this.form.stats.statsInput = true;
                } else if (option == 'statsInputNull') {
                    this.form.date_pedido.statsInput = null;
                    this.form.stats.statsInput = null;
                }
            },
            validacao(error) {
                if(error.response.data.errors['date_pedido']) {
                    this.form.date_pedido.statsInput = false;
                    this.form.date_pedido.erro = error.response.data.errors['date_pedido'][0];
                } else {
                    this.form.date_pedido.statsInput = true;
                }

                if(error.response.data.errors['stats']) {
                    this.form.stats.statsInput = false;
                    this.form.stats.erro = error.response.data.errors['stats'][0];
                } else {
                    this.form.stats.statsInput = true;
                }

            },
            onSubmit() {
                console.log(this.dataForm('update'));
                this.$http.put(`/pedidos/update/${this.$route.params.pedido}`, this.dataForm('update')).then((response) => {
                    console.log(response);
                    if (response.data == 'success') {
                        this.dataForm('statsInput');
                        this.statsButton = true
                        this.countDownChanged(this.dismissSecs)
                        
                        setTimeout(() => {
                            this.$router.push('/pedidos')
                        }, 5000)
                    } 

                }, (error) => {
                    console.log(error);
                    this.validacao(error);
                });
            },
            onBack() {
                this.$router.push('/pedidos');
            },
            formatarData() {
                let date = this.form.last_update;
                this.form.last_update = moment(date).format('DD/MM/YYYY HH:mm:ss');
                let date_pedido = this.form.date_pedido.text;
                this.form.date_pedido.text = moment(date_pedido).format('YYYY-MM-DDThh:mm');
            },
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            },
        },
        created() {
            if (this.$route.params.pedido)
                this.getPedido()
        },
        components: {
            DashboardComponent,
        },
    }
</script>

<style src="./input.css" scoped/>