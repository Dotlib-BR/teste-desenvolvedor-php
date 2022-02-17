<template>
    <div class="navbar d-flex justify-content-between align-items-center px-3">
        <h3 class="logo"><i class="fa fa-star"></i> Logo Marca </h3>
        <a class="logout" @click.prevent="logout" href="#"> Sair <i class="fas fa-sign-out-alt"></i></a>
    </div>
</template>

<script>
    export default {
        name: 'NavbarComponent',

        methods: {
            logout() {
                this.$router.push({name: 'Login'});
            }
        },
    }
</script>

<style scoped>
    .navbar .logo {
        color: #fff;
    }

    .navbar .logout {
        color: #fff;
        text-decoration: none;
        font-size: 25px;
    }
</style>