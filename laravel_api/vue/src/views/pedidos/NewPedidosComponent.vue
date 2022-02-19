<template>
    <DashboardComponent>
        <div slot="slot-pages" class="content-pages">
            <b-card class="card shadow mx-4">
                <b-row class="mx-2">
                    <b-col>
                        <h2 class="text-start"><i class="fas fa-box"></i> Novo Pedido</h2>
                    </b-col>
                </b-row>
                <hr class="mt-0 pt-0" />
                <b-row>
                    <b-col>
                        <b-alert
                            :show="dismissCountDownDanger"
                            variant="danger"
                            @dismissed="dismissCountDownDanger=0"
                            @dismiss-count-down="countDownChangedDanger"
                        >
                            Quantidade superior ao disponível no estoque! {{dismissCountDownDanger}}
                        </b-alert>
                    </b-col>
                </b-row>
                <b-form @submit="onSubmit">
                    <b-alert
                        :show="dismissCountDownSuccess"
                        variant="success"
                        @dismissed="dismissCountDownSuccess=0"
                        @dismiss-count-down="countDownChangedSuccess"
                    >
                        Tudo certo! Redirecionamento em {{ dismissCountDownSuccess }} seconds...
                    </b-alert>
                    <b-row class="mt-4 px-2">
                        <b-col cols="12" md="6">
                            <b-form-group id="input-group-client" label="Cliente" label-for="input-client">
                                <select id="input-group-client" v-model="form.client.text" :state="form.client.statsInput" class="form-control">
                                    <option v-for="client in clients" :key="client.id" :value="client.id">{{client.name}} --- CPF: {{client.cpf | VMask('###.###.###-##')}}</option>
                                </select>
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.client.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group id="input-group-product" label="Produto" label-for="input-product">
                                <select id="input-group-product" v-model="form.product.text" :state="form.product.statsInput" class="form-control">
                                    <option v-for="product in products" :key="product.id" :value="product.id">{{product.name+' --- Qtd:'+product.amount+' un'}}</option>
                                </select>
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.product.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                    </b-row>
                    <b-row class="mt-4 px-2">
                        <b-col cols="12" md="6">
                            <b-form-group id="input-group-amount" label="Quantidade" label-for="input-amount">
                                <b-form-input id="input-amount" v-model="form.amount.text" :state="form.amount.statsInput" :maxlength="form.amount.max" placeholder="Amount"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.amount.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group id="input-group-date_pedido" label="Data do Pedido" label-for="input-date_pedido">
                                <b-form-input id="input-date_pedido" v-model="form.date_pedido.text" :state="form.date_pedido.statsInput" type="datetime-local"  />
                                <b-form-invalid-feedback id="input-live-feedback">{{  form.date_pedido.erro   }}</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                    </b-row>

                    <div class="mt-4 d-flex gap-3 justify-content-center">
                        <b-button pill @click="onSubmit" :disabled="statsButton" variant="info">Novo</b-button>
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

    export default {
        name: 'EditProductsComponent.vue',

        data() {
            return {
                form: {
                    client: {statsInput: null, erro: ''},
                    product: {statsInput: null, erro: ''},
                    amount: {text: '', statsInput: null, erro: '', max: 3},
                    date_pedido: {text: '', statsInput: null, erro: ''},
                    last_update: '',
                },
                clients: [],
                products: [],
                /* Alert */
                dismissSecsSuccess: 3,
                dismissCountDownSuccess: 0,
                dismissSecsDanger: 5,
                dismissCountDownDanger: 0,
                /* Valid Input */
                statsInput: null,
                statsButton: false,
            }
        },
        methods: {
            getDados() {
                this.$http.get('/pedidos/create').then((response) => {
                    this.clients = response.data.clients
                    this.products = response.data.products
                });
            },
            dataForm(option) {
                if (option == 'add') {
                    var data = { 
                        client: this.form.client.text,
                        product: this.form.product.text,
                        amount: this.form.amount.text,
                        date_pedido: this.form.date_pedido.text, 
                    }
                    return data;

                } else if (option == 'statsInput') {
                    this.form.client.statsInput = true;
                    this.form.product.statsInput = true;
                    this.form.amount.statsInput = true;
                    this.form.date_pedido.statsInput = true;
                } else if (option == 'statsInputNull') {
                    this.form.client.statsInput = null;
                    this.form.product.statsInput = null;
                    this.form.amount.statsInput = null;
                    this.form.date_pedido.statsInput = null;
                }
            },
            validacao(error) {
                if(error.response.data.errors['client']) {
                    this.form.client.statsInput = false;
                    this.form.client.erro = error.response.data.errors['client'][0];
                } else {
                    this.form.client.statsInput = true;
                }

                if(error.response.data.errors['product']) {
                    this.form.product.statsInput = false;
                    this.form.product.erro = error.response.data.errors['product'][0];
                } else {
                    this.form.product.statsInput = true;
                }

                if(error.response.data.errors['amount']) {
                    this.form.amount.statsInput = false;
                    this.form.amount.erro = error.response.data.errors['amount'][0];
                } else {
                    this.form.amount.statsInput = true;
                }

                if(error.response.data.errors['date_pedido']) {
                    this.form.date_pedido.statsInput = false;
                    this.form.date_pedido.erro = error.response.data.errors['date_pedido'][0];
                } else {
                    this.form.date_pedido.statsInput = true;
                }

            },
            onSubmit(event) {
                this.$http.post('/pedidos/adicionar', this.dataForm('add')).then((response) => {
                    console.log(response);
                    if (response.data == 'success') {
                        this.dataForm('statsInput');
                        this.statsButton = true
                        this.countDownChangedSuccess(this.dismissSecsSuccess)
                        
                        setTimeout(() => {
                            this.$router.push('/pedidos')
                        }, 5000)

                    } else if (response.data == 'amount') {
                        this.countDownChangedDanger(this.dismissSecsDanger)
                    }

                }, (error) => {
                    console.log(error.response.data);
                    this.validacao(error);
                });
            },
            onBack() {
                this.$router.push('/pedidos');
            },
            countDownChangedSuccess(dismissCountDownSuccess) {
                this.dismissCountDownSuccess = dismissCountDownSuccess
            },
            countDownChangedDanger(dismissCountDownDanger) {
                this.dismissCountDownDanger = dismissCountDownDanger
            },
        },
        created() {
            this.getDados();
        },
        components: {
            DashboardComponent,
        },
    }
</script>

<style src="./input.css" scoped/>