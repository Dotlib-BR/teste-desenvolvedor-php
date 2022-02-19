<template>
    <DashboardComponent>
        <div slot="slot-pages" class="content-pages">
            <b-card class="card shadow mx-4">
                <b-row class="mx-2">
                    <b-col>
                        <h2 class="text-start"><i class="fa fa-user"></i> {{show.name}}</h2>
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
                                <strong>Nome:</strong>
                                {{ show.name }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Email:</strong>
                                {{ show.email }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Data de Nascimento:</strong>
                                {{ show.date_birth }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>CPF:</strong>
                                {{ show.cpf | VMask('###.###.###-##') }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Telefone:</strong>
                                {{ show.phone | VMask('(##) ####-####') }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Status:</strong>
                                {{ show.stats == 0 ? 'Inativo' : 'Ativo' }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Cep:</strong>
                                {{ show.cep | VMask('#####-###') }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Endereço:</strong>
                                {{ show.address }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Complemento:</strong>
                                {{ show.complement }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Cidade:</strong>
                                {{ show.city }}
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="fs-3 m-0">
                                <strong>Sexo:</strong>
                                {{ show.sex == 0 ? 'Outro' : '' }}
                                {{ show.sex == 1 ? 'Feminino' : '' }}
                                {{ show.sex == 2 ? 'Masculino' : '' }}
                            </p>
                        </div>
                    </b-col>
                    <b-col md="6" class="d-flex justify-content-center align-items-center gap-3 mt-2">
                        <div>
                            <b-button pill class="px-3 my-0" @click="clients()" variant="primary">Clientes</b-button>
                        </div>
                        <div>
                            <router-link :to="{name:'ClientsEdit', params:{client:show.id}}">
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
        name: 'ShowClientsComponent.vue',

        data() {
            return {
                show: {
                    id: '',
                    client_id: '',
                    name: '',
                    email: '',
                    date_birth: '',
                    cpf: '',
                    phone: '',
                    stats: '',
                    cep: '',
                    address: '',
                    complement: '',
                    city: '',
                    sex: '',
                    last_update: '',
                },
            }
        },
        methods: {
            getClient() {
                this.$http.get(`clients/show/${this.$route.params.client}`).then((response) => {
                    this.show.id = response.data.id
                    this.show.name = response.data.name
                    this.show.email = response.data.email
                    this.show.date_birth = response.data.date_birth
                    this.show.cpf = response.data.cpf
                    this.show.phone = response.data.phone
                    this.show.stats = response.data.stats
                    this.show.cep = response.data.cep
                    this.show.address = response.data.address
                    this.show.complement = response.data.complement
                    this.show.city = response.data.city
                    this.show.sex = response.data.sex
                    this.show.last_update = response.data.updated_at
                    this.formatarData()
                    console.log(this.show.client_id);
                });
            },
            clients() {
                this.$router.push('/clients');
            },
            formatarData() {
                let date = this.show.last_update;
                this.show.last_update = moment(date).format('DD/MM/YYYY HH:mm:ss');
                let date_birth = this.show.date_birth;
                this.show.date_birth = moment(date_birth).format('DD/MM/YYYY');
            },
        },
        created() {
            if (this.$route.params.client)
                this.getClient()
        },
        components: {
            DashboardComponent,
        },
    }
</script>

<style src="./input.css" scoped/>