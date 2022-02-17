<template>
    <DashboardComponent>
        <div slot="slot-pages" class="content-pages">
            <b-card class="card p-3">
                <b-card-title>Clientes Cadastrados <span class="badge bg-info">{{items.length}}</span></b-card-title>
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
                            <router-link :to="{name:'ClientsNew'}">
                                <b-button pill variant="outline-success"><i class="fa fa-user-plus"></i></b-button>
                            </router-link>
                        </div>
                    </b-col>
                </b-row>
                <div class="table">
                    <!-- <table class="table table-striped myTable">
                        <thead>
                            <tr>
                                <th>{{columnsName[0]}}</th>
                                <th>{{columnsName[1]}}</th>
                                <th>{{columnsName[2]}}</th>
                                <th>{{columnsName[3]}}</th>
                                <th>{{columnsName[4]}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="client in clients" :key="client.id">
                                <th scope="row">{{client.id}}</th>
                                <td>{{client.name}}</td>
                                <td>{{client.cpf}}</td>
                                <td>{{client.email}}</td>
                                <td>
                                    <router-link :to="{name:'ClientsEdit', params:{client:client.id}}">
                                        <b-button class="me-2" variant="outline-primary"><i class="fa fa-edit"></i></b-button>
                                    </router-link>
                                    <b-button variant="outline-danger"><i class="fa fa-trash-alt"></i></b-button>
                                </td>
                            </tr>
                        </tbody>
                    </table> -->
                    <b-table-simple striped>
                        <b-thead>
                            <b-tr>
                                <b-th>{{columnsName[0]}}</b-th>
                                <b-th>{{columnsName[1]}}</b-th>
                                <b-th>{{columnsName[2]}}</b-th>
                                <b-th>{{columnsName[3]}}</b-th>
                                <b-th>{{columnsName[4]}}</b-th>
                            </b-tr>
                        </b-thead>
                        <b-tbody>
                            <b-tr v-for="client in items" :key="client.id">
                                <b-td>{{client.id}}</b-td>
                                <b-td>{{client.name}}</b-td>
                                <b-td>{{client.cpf}}</b-td>
                                <b-td>{{client.email}}</b-td>
                                <b-td>
                                    <router-link :to="{name:'ClientsEdit', params:{client:client.id}}">
                                        <b-button pill class="me-2" variant="outline-primary"><i class="fa fa-edit"></i></b-button>
                                    </router-link>
                                    <b-button pill @click="$bvModal.show(client.id)" variant="outline-danger"><i class="fa fa-trash-alt"></i></b-button>
                                    <b-modal :id="client.id" modal-cancel>
                                        <template #modal-title>
                                            Deseja excluir?
                                        </template>
                                        <div class="d-block text-center">
                                            <p class="fs-4 m-0 p-0">Excluir o cliente <b>{{client.name}}</b>?</p>
                                        </div>
                                        <template #modal-footer="{ close }">
                                            <b-button pill class="px-3 my-0" @click="close()" variant="danger"><i class="fa fa-times fa-1x"></i></b-button>
                                            <b-button pill class="px-3 my-0" @click="del(client.id)" variant="success"><i class="fa fa-check fa-1x"></i></b-button>
                                        </template>
                                    </b-modal>
                                </b-td>
                            </b-tr>
                        </b-tbody>
                    </b-table-simple>
                    <!-- <b-table striped hover :items="items"></b-table> -->
                </div>
            </b-card>
        </div>
    </DashboardComponent>
</template>

<script>
/* eslint-disable */
    import DashboardComponent from '../Dashboard/DashboardComponent.vue';

    export default {
        name: 'HomeComponent',

        data() {
            return {
                perPage: 10,
                currentPage: 1,
                items: [],
                columnsName: ['#', 'Nome', 'CPF', 'Email', 'Ações'],
                /* Alert */
                dismissSecs: 5,
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
                    this.$http.get('/clients/list').then((response) =>{
                        this.items = response.data;
                    });
                } catch (error) {
                    console.error("Ocorreu um erro: "+ error.response.status);
                }
            },
            del(id) {
                this.$http.delete(`clients/delete/${id}`).then((response) => {
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