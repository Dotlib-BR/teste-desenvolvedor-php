<template>
    <nav class="sidebar-nav close">
        <header>
            <div class="image-text">
                <span class="image">
                    <i class="fa fa-user fa-2x text-light"></i>
                </span>

                <div class="text header-text">
                    <span class="name">CodingLab</span>
                    <span class="profession">Web Developer</span>
                </div>
            </div>
            
            <a href="#" @click.prevent="toggle"><i class="fas fa-chevron-right toggle"></i></a>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">
                    <a class="router-link" >
                        <i class="fa fa-search icon"></i>
                        <input type="serch" placeholder="Search...">
                    </a>
                </li>
                <ul class="menus-links">
                    <li class="nav-link">
                        <router-link class="router-link" :to="{name: 'Homea'}">
                            <i class="fa fa-home icon"></i>
                            <span class="text nav-text">Início</span>
                        </router-link>
                    </li>
                    <li class="nav-link">
                        <router-link class="router-link" :to="{name: 'Clients'}">
                            <i class="fa fa-box icon"></i>
                            <span class="text nav-text">Clientes</span>
                        </router-link>
                    </li>
                    <li class="nav-link">
                        <router-link class="router-link" :to="{name: 'List'}">
                            <i class="fa fa-store icon"></i>
                            <span class="text nav-text">Lista</span>
                        </router-link>
                    </li>
                    <li class="nav-link">
                        <router-link class="router-link" :to="{name: 'Homea'}">
                            <i class="fa fa-chart-bar icon"></i>
                            <span class="text nav-text">Vendas</span>
                        </router-link>
                    </li>
                    <li class="nav-link">
                        <router-link class="router-link" :to="{name: 'Homea'}">
                            <i class="fa fa-home icon"></i>
                            <span class="text nav-text">Relatórios</span>
                        </router-link>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a class="router-link" @click.prevent="logout" href="#">
                        <i class="fa fa-sign-out-alt icon"></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
                <li class="mode">
                    <div class="moon-sun">
                        <i class="fa fa-moon icon moon"></i>
                        <i class="fa fa-sun icon sun"></i>
                    </div>
                    <span class="mode-text text">Dark Mode</span>

                    <div class="toggle-switch" @click.prevent="theme">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: 'SidebarComponent',

        methods: {
            logout() {
                this.$router.push({name: 'Login'});
            },
            theme() {
                const theme = document.querySelector('body');
                theme  .classList.toggle("dark");
                /* alert('aaa'); */

                const modeText = document.querySelector(".mode-text")
                if (theme.classList.contains("dark")) {
                    modeText.innerText = "Light Mode";   
                } else {
                    modeText.innerText = "Dark Mode"; 
                }
            },
            toggle() {
                const sidebar_nav = document.querySelector('.sidebar-nav');
                sidebar_nav.classList.toggle("close");
                /* alert('aaa'); */
            },
        },
    }
</script>

<style src="./input.css" scoped/>