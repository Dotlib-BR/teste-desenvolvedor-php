import Vue from "vue";
import VueRouter, { RouteConfig } from "vue-router";
import Home from "../views/Home.vue";
import list from '../views/list.vue';
import edit from '../views/edit.vue';
import LoginComponent from '../views/login/LoginComponent.vue';
import HomeComponent from '../views/home/HomeComponent.vue';
import ListComponent from '../views/list/ListComponent.vue';
import ClientsComponent from '../views/clients/ClientsComponent.vue';
import EditClientsComponent from '../views/clients/EditClientsComponent.vue';

Vue.use(VueRouter);

const routes: Array<RouteConfig> = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/about",
    name: "About",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/About.vue"),
  },
  {
    path: '/lista',
    name: 'Lista',
    component: list
  },
  {
    path: '/editar/:usuario',
    name: 'Editar',
    component: edit
  },
  {
    path: '/login',
    name: 'Login',
    component: LoginComponent,
  },
  {
    path: '/home',
    name: 'Homea',
    component: HomeComponent,
  },
  {
    path: '/list',
    name: 'List',
    component: ListComponent,
  },
  {
    path: '/clients',
    name: 'Clients',
    component: ClientsComponent,
  },
  {
    path: '/clients/edit/:client',
    name: 'ClientsEdit',
    component: EditClientsComponent,
  },
  {
    path: '/clients/edit',
    name: 'ClientsNew',
    component: EditClientsComponent,
  },
];

const router = new VueRouter({
  routes,
});

export default router;
