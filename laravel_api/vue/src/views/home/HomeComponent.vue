<template>
    <DashboardComponent>
        <div slot="slot-pages" class="content-pages">

            <header class="fs-2">
                <p>Dashboard</p>
            </header>

            <div class="">
                <div class="row">
                    <div class="col-12 col-lg-4 my-3">
                        <CardsComponent :type="'Clientes'" :percentagem="clientsAll.length" :icon="'fa fa-users'" />
                    </div>
                    <div class="col-12 col-lg-4 my-3">
                        <CardsComponent :type="'Produtos'" :percentagem="productsAll.length" :icon="'fa fa-toolbox'"/>
                    </div>
                    <div class="col-12 col-lg-4 my-3">
                        <CardsComponent :type="'Pedidos'" :percentagem="pedidosAll.length" :icon="'fa fa-box'"/>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12 col-lg-4 my-3">
                        <ListsComponent :data="clients" description="Clientes" :columns="['#', 'Nome']" />
                    </div>
                    <div class="col-12 col-lg-4 my-3">
                        <ListsComponent :data="products" description="Produtos" :columns="['#', 'Nome']" />
                    </div>
                    <div class="col-12 col-lg-4 my-3">
                        <ListsComponent :data="pedidos" description="Pedidos" :columns="['#', 'Valor Total']" />
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
                pedidos: [],
                clientsAll: [],
                productsAll: [],
                pedidosAll: [],
            }
        },
        mounted () {
            this.getData();
        },
        methods: {
            async getData() {
                try {
                    this.$http.get('/home').then((response) =>{
                        console.log(response.data.clients);
                        this.clients = response.data.clients;
                        this.products = response.data.products;
                        this.pedidos = response.data.pedidos;
                        this.clientsAll = response.data.clientsAll;
                        this.productsAll = response.data.productsAll;
                        this.pedidosAll = response.data.pedidosAll;
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