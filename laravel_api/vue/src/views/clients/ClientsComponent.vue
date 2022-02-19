<template>
    <DashboardComponent>
        <div slot="slot-pages" class="content-pages">
            <b-card class="card p-3 shadow">
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
                            <tr v-for="client in items" :key="client.id">
                                <th scope="row">{{client.id}}</th>
                                <td><router-link :to="{name:'ClientsShow', params:{client:client.id}}" class="text-decoration-none text-black">
                                    <i class="fas fa-exclamation-circle text-secondary"></i> {{client.name}}
                                </router-link></td>
                                <td>{{client.cpf}}</td>
                                <td>{{client.email}}</td>
                                <td v-if="client.stats == 1"><span class="badge rounded-pill bg-info">Sim</span></td>
                                <td v-else><span class="badge rounded-pill bg-secondary">Não</span></td>
                                <td>
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
                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> Todos os pedidos relacionados a este cliente será excluído!</span>
                                        </div>
                                        <template #modal-footer="{ close }">
                                            <b-button pill class="px-3 my-0" @click="close()" variant="danger"><i class="fa fa-times fa-1x"></i></b-button>
                                            <b-button pill class="px-3 my-0" @click="del(client.id)" variant="success"><i class="fa fa-check fa-1x"></i></b-button>
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
        name: 'ClientsComponent',

        data() {
            return {
                perPage: 10,
                currentPage: 1,
                items: [],
                columnsName: ['#', 'Nome', 'CPF', 'Email', 'Status', 'Ações'],
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
                    this.$http.get('/clients').then((response) =>{
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