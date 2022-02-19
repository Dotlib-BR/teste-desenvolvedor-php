<template>
    <DashboardComponent>
        <div slot="slot-pages" class="content-pages">
            <b-card class="card shadow mx-4">
                <b-row class="mx-2">
                    <b-col>
                        <h2 class="text-start"><i class="fas fa-box"></i> Pedido Nº{{show.id}}</h2>
                    </b-col>
                    <b-col>
                        <p class="text-end"><b>Última alteração: {{show.last_update}}</b></p>
                    </b-col>
                </b-row>
                <hr class="mt-0 pt-0" />
                <b-row>
                    <b-col cols="12" md="6" class="text-center">
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>ID:</strong>
                                {{ show.id }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Nome Cliente:</strong>
                                {{ show.name_client }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Email Cliente:</strong>
                                {{ show.email_client }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>CPF Cliente:</strong>
                                {{ show.cpf_client | VMask('###.###.###-##') }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Código de Barras Produto:</strong>
                                {{ show.cod_bars_product }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Nome Produto:</strong>
                                {{ show.name_product }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Valor Produto:</strong>
                                R$ {{ show.value_un_product }} un
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Quantidade:</strong>
                                {{ show.amount }} un
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Valor Total:</strong>
                                R$ {{ show.value_total }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Data Pedido:</strong>
                                {{ show.date_pedido }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Status:</strong>
                                {{ show.stats == 0 ? 'Cancelado' : '' }}
                                {{ show.stats == 1 ? 'Em Aberto' : '' }}
                                {{ show.stats == 2 ? 'Pago' : '' }}
                            </p>
                        </div>
                    </b-col>
                    <b-col md="6" class="d-flex justify-content-center align-items-center gap-3 mt-2">
                        <div>
                            <b-button pill class="px-3 my-0" @click="pedidos()" variant="primary">Pedidos</b-button>
                        </div>
                        <div>
                            <router-link :to="{name:'PedidosEdit', params:{pedido:show.id}}">
                                <b-button pill class="px-3 my-0" variant="secondary">Editar</b-button>
                            </router-link>
                        </div>
                        <div>
                            <b-button pill class="px-3 my-0" variant="info" href="javascript:history.back()">Voltar</b-button>
                        </div>
                    </b-col>    
                </b-row>
            </b-card>
        </div>
    </DashboardComponent>
</template>

<script>
/* eslint-disable */
    import DashboardComponent from '../Dashboard/DashboardComponent';
    import moment from 'moment';

    export default {
        name: 'ShowPedidosComponent.vue',

        data() {
            return {
                show: {
                    id: '',
                    name_client: '',
                    email_client: '',
                    cpf_client: '',
                    cod_bars_product: '',
                    name_product: '',
                    value_un_product: '',
                    amount: '',
                    value_total: '',
                    date_pedido: '',
                    stats: '',
                    last_update: '',
                },
            }
        },
        methods: {
            getPedido() {
                this.$http.get(`pedidos/show/${this.$route.params.pedido}`).then((response) => {
                    this.show.id = response.data.id
                    this.show.name_client = response.data.name_client
                    this.show.email_client = response.data.email_client
                    this.show.cpf_client = response.data.cpf_client
                    this.show.cod_bars_product = response.data.cod_bars_product
                    this.show.name_product = response.data.name_product
                    this.show.value_un_product = response.data.value_un_product
                    this.show.amount = response.data.amount
                    this.show.value_total = response.data.value_total
                    this.show.date_pedido = response.data.date_pedido
                    this.show.stats = response.data.stats
                    this.show.last_update = response.data.updated_at
                    this.formatarData()
                });
            },
            pedidos() {
                this.$router.push('/pedidos');
            },
            formatarData() {
                let date = this.show.last_update;
                this.show.last_update = moment(date).format('DD/MM/YYYY HH:mm:ss');
                let date_pedido = this.show.date_pedido;
                this.show.date_pedido = moment(date_pedido).format('DD/MM/YYYY HH:mm');
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