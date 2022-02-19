<template>
    <DashboardComponent>
        <div slot="slot-pages" class="content-pages">
            <b-card class="card p-3 shadow">
                <b-card-title>Produtos Cadastrados <span class="badge bg-info">{{items.length}}</span></b-card-title>
                <b-row class="m-0 p-0">
                    <b-col cols="11" class=" m-0 my-auto">
                        <b-alert
                            :show="dismissCountDown"
                            variant="success"
                            @dismissed="dismissCountDown=0"
                            @dismiss-count-down="countDownChanged"
                        >
                            Excluido com sucesso! Tabela será atualizada em {{ dismissCountDown }} seconds...
                        </b-alert>
                    </b-col>
                    <b-col cols="1" class="m-0 my-auto">
                        <div class="top text-end">
                            <router-link :to="{name:'ProductsNew'}">
                                <b-button pill variant="outline-success"><i class="fas fa-plus-circle"></i></b-button>
                            </router-link>
                        </div>
                    </b-col>
                </b-row>
                <div class="table table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">{{columnsName[0]}}</th>
                                <th scope="col">{{columnsName[1]}}</th>
                                <th scope="col">{{columnsName[2]}}</th>
                                <th scope="col">{{columnsName[3]}}</th>
                                <th scope="col">{{columnsName[4]}}</th>
                                <th scope="col">{{columnsName[5]}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in items" :key="product.id">
                                <td>{{product.id}}</td>
                                <td><router-link :to="{name:'ProductsShow', params:{product:product.id}}" class="text-decoration-none text-black">
                                    <i class="fas fa-exclamation-circle text-secondary"></i> {{product.name}}
                                </router-link></td>
                                <td>R$ {{product.value}}</td>
                                <td v-if="product.amount >= 75"><span class="badge rounded-pill bg-success">{{product.amount}} un</span></td>
                                <td v-else-if="product.amount < 75 && product.amount >= 25"><span class="badge rounded-pill bg-warning">{{product.amount}} un</span></td>
                                <td v-else-if="product.amount == 0"><span class="badge rounded-pill bg-dark">{{product.amount}} un</span></td>
                                <td v-else><span class="badge rounded-pill bg-danger">{{product.amount}} un</span></td>
                                <td v-if="product.stats == 1"><span class="badge rounded-pill bg-info">Sim</span></td>
                                <td v-else><span class="badge rounded-pill bg-secondary">Não</span></td>
                                <td>
                                    <router-link :to="{name:'ProductsEdit', params:{product:product.id}}">
                                        <b-button pill class="me-2" variant="outline-primary"><i class="fa fa-edit"></i></b-button>
                                    </router-link>
                                    <b-button pill @click="$bvModal.show(product.id)" variant="outline-danger"><i class="fa fa-trash-alt"></i></b-button>
                                    <b-modal :id="product.id" modal-cancel>
                                        <template #modal-title>
                                            Deseja excluir?
                                        </template>
                                        <div class="d-block text-center">
                                            <p class="fs-4 m-0 p-0">Excluir o produto <b>{{product.name}}</b>?</p>
                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> Todos os pedidos relacionados a este produto será excluído!</span>
                                        </div>
                                        <template #modal-footer="{ close }">
                                            <b-button pill class="px-3 my-0" @click="close()" variant="danger"><i class="fa fa-times fa-1x"></i></b-button>
                                            <b-button pill class="px-3 my-0" @click="del(product.id)" variant="success"><i class="fa fa-check fa-1x"></i></b-button>
                                        </template>
                                    </b-modal>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </b-card>
        </div>
    </DashboardComponent>
</template>

<script>
/* eslint-disable */
    import DashboardComponent from '../Dashboard/DashboardComponent.vue';

    export default {
        name: 'ProductsComponent',

        data() {
            return {
                perPage: 10,
                currentPage: 1,
                items: [],
                columnsName: ['#', 'Nome', 'Valor', 'Quantidades', 'Status', 'Ações'],
                /* Alert */
                dismissSecs: 3,
                dismissCountDown: 0,
            }
        },
        computed: {
            rows() {
                return this.items.length
            }
        },
        mounted () {
            this.getData();
        },
        methods: {
            async getData() {
                try {
                    this.$http.get('/products').then((response) =>{
                        this.items = response.data;
                    });
                } catch (error) {
                    console.error("Ocorreu um erro: "+ error.response.status);
                }
            },
            del(id) {
                this.$http.delete(`products/delete/${id}`).then((response) => {
                    console.log(response);
                    if(response.data == 'success'){
                        this.countDownChanged(this.dismissSecs);
                        this.$bvModal.hide(id);

                        setTimeout(() => {
                            this.getData();
                        }, 5000)
                    }
                })
            },
            toggleModal() {
                this.$refs['delete-modal'].toggle('#delete')
            },
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            },
        },
        components: {
            DashboardComponent,
        }
    }
</script>

<style src="./input.css" scoped/>