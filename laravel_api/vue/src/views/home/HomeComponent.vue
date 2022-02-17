<template>
    <DashboardComponent>
        <div slot="slot-pages" class="content-pages">

            <header class="fs-2">
                <p>Inicio</p>
                <h1>Editar usuário {{ this.$route.params.usuario }}</h1>
            </header>

            <div class="">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <CardsComponent :type="'Clientes'" :percentagem="'7'" :icon="'fa fa-users'" :qtd="clients.length" />
                    </div>
                    <div class="col-12 col-md-3">
                        <CardsComponent :type="'Produtos'" :percentagem="'12'" :icon="'fa fa-box'" :qtd="products.length" />
                    </div>
                    <div class="col-12 col-md-3">
                        <CardsComponent :type="'Vendas'" :percentagem="'3'" :icon="'fa fa-store'" :qtd="clients.length" />
                    </div>
                    <div class="col-12 col-md-3">
                        <CardsComponent :type="'Relatórios'" :percentagem="'5'" :icon="'fa fa-chart-bar'" :qtd="products.length" />
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12 col-md-6">
                        <ListsComponent :data="clients" description="Clientes" :columns="['#', 'Nome', 'Email', 'Phone']" />
                    </div>
                    <div class="col-12 col-md-6">
                        <ListsComponent :data="products" description="Produtos" :columns="['#', 'Nome', 'Valor']" />
                    </div>
                </div>
            </div>
            
        </div>
    </DashboardComponent>
    <!-- <div>
        <p>Home nosso system</p>
    </div> -->
</template>

<script>
/* eslint-disable */
    import DashboardComponent from '../Dashboard/DashboardComponent.vue';
    import CardsComponent from '../../components/CardsComponent.vue'
    import ListsComponent from '../../components/ListsComponent.vue'

    export default {
        name: 'HomeComponent',

        data() {
            return {
                clients: [],
                products: [],

            }
        },
        mounted () {
            this.getData();
        },
        methods: {
            async getData() {
                /* this.$http.get('/users', 'await').then((response) =>{
                    console.log(response)

                    if(response.status == 200) {
                        this.users = response.data
                    } else {
                        console.error("Deu ruim");
                    }
                }) */
                try {
                    this.$http.get('/home').then((response) =>{
    
                        this.clients = response.data.clients;
                        this.products = response.data.products;
                    });
                    
                } catch (error) {
                    console.error("Ocorreu um erro: "+ error.response.status);
                }
                
            },
        },

        components: {
            DashboardComponent,
            CardsComponent,
            ListsComponent,
        }
    }
</script>

<style src="./input.css" scoped/>