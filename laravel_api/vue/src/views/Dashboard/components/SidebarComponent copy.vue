<template>
    <div class="sidebar">
        <div class="top mt-5 d-flex flex-column justify-content-center align-items-center w-100">
            <div class="avatar d-flex justify-content-center align-items-center rounded-circle">
                <span><i class="fa fa-user fa-3x"></i></span>
            </div>
            <div class="info text-light mt-2 text-start">
                <p class="name fs-4">Danilo Lourenço</p>
                <p class="status fs-6"><i class="fas fa-circle text-success"></i> Online</p>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="menu mt-5 text-start">
                <li class="pb-2"><router-link class="menus" :to="{name: 'Homea'}"><i class="fa fa-home"></i> Início</router-link></li>
                <li class="pb-2"><router-link class="menus" :to="{name: 'Clients'}"><i class="fa fa-users"></i> Clientes</router-link></li>
                <li class="pb-2"><router-link class="menus" :to="{name: 'List'}"><i class="fa fa-box"></i> Lista</router-link></li>
                <li class="pb-2"><router-link class="menus" :to="{name: 'Homea'}"><i class="fa fa-store"></i> Vendas</router-link></li>
                <li class="pb-2"><router-link class="menus" :to="{name: 'Homea'}"><i class="fa fa-chart-bar"></i> Relatórios</router-link></li>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'SidebarComponent'
    }
</script>

<style scoped>
    * {
        text-decoration: none;
        list-style: none;
    }

    p {
        margin: 0;
    }

    .sidebar .top {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .sidebar .top .avatar {
        width: 80px;
        height: 80px;
        background-color: #CCC;
    }

    .sidebar .menu .menus {
        font-size: 22px;
        color: white;
    }
</style>