<template>
    <DashboardComponent>
        <div slot="slot-pages" class="content-pages">
            <b-card class="card shadow mx-4">
                <b-row class="mx-2">
                    <b-col>
                        <h2 class="text-start"><i class="fas fa-toolbox"></i> {{show.name}}</h2>
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
                                <strong>Código de Barras:</strong>
                                {{ show.cod_bars }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Nome:</strong>
                                {{ show.name }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Valor:</strong>
                                R$ {{ show.value }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Quantidade:</strong>
                                {{ show.amount }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Status:</strong>
                                {{ show.stats == 0 ? 'Inativo' : 'Ativo' }}
                            </p>
                        </div>
                    </b-col>
                    <b-col md="6" class="d-flex justify-content-center align-items-center gap-3 mt-2">
                        <div>
                            <b-button pill class="px-3 my-0" @click="products()" variant="primary">Produtos</b-button>
                        </div>
                        <div>
                            <router-link :to="{name:'ProductsEdit', params:{product:show.id}}">
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
        name: 'ShowProductsComponent.vue',

        data() {
            return {
                show: {
                    id: '',
                    cod_bars: '',
                    name: '',
                    value: '',
                    amount: '',
                    stats: '',
                    last_update: '',
                },
            }
        },
        methods: {
            getProduct() {
                this.$http.get(`products/show/${this.$route.params.product}`).then((response) => {
                    this.show.id = response.data.id
                    this.show.cod_bars = response.data.cod_bars
                    this.show.name = response.data.name
                    this.show.value = response.data.value
                    this.show.amount = response.data.amount
                    this.show.stats = response.data.stats
                    this.show.last_update = response.data.updated_at
                    this.formatarData()
                });
            },
            products() {
                this.$router.push('/products');
            },
            formatarData() {
                let data = this.show.last_update;
                this.show.last_update = moment(data).format('DD/MM/YYYY HH:mm:ss');
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