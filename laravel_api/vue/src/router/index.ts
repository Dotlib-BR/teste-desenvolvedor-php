import Vue from "vue";
import VueRouter, { RouteConfig } from "vue-router";
import LoginComponent from '../views/login/LoginComponent.vue';
import HomeComponent from '../views/home/HomeComponent.vue';
import ClientsComponent from '../views/clients/ClientsComponent.vue';
import ShowClientsComponent from '../views/clients/ShowClientsComponent.vue';
import EditClientsComponent from '../views/clients/EditClientsComponent.vue';
import NewClientsComponent from '../views/clients/NewClientsComponent.vue';
import ProductsComponent from '../views/products/ProductsComponent.vue';
import ShowProductsComponent from '../views/products/ShowProductsComponent.vue';
import EditProductsComponent from '../views/products/EditProductsComponent.vue';
import NewProductsComponent from '../views/products/NewProductsComponent.vue';
import PedidosComponent from '../views/pedidos/PedidosComponent.vue';
import ShowPedidosComponent from '../views/pedidos/ShowPedidosComponent.vue';
import EditPedidosComponent from '../views/pedidos/EditPedidosComponent.vue';
import NewPedidosComponent from '../views/pedidos/NewPedidosComponent.vue';

Vue.use(VueRouter);

const routes: Array<RouteConfig> = [
  {
    path: '/login',
    name: 'Login',
    component: LoginComponent,
  },
  {
    path: '/',
    name: 'Home',
    component: HomeComponent,
  },
  {
    path: '/clients',
    name: 'Clients',
    component: ClientsComponent,
  },
  {
    path: '/clients/show/:client',
    name: 'ClientsShow',
    component: ShowClientsComponent,
  },
  {
    path: '/clients/edit/:client',
    name: 'ClientsEdit',
    component: EditClientsComponent,
  },
  {
    path: '/clients/add',
    name: 'ClientsNew',
    component: NewClientsComponent,
  },
  {
    path: '/products',
    name: 'Products',
    component: ProductsComponent,
  },
  {
    path: '/products/show/:product',
    name: 'ProductsShow',
    component: ShowProductsComponent,
  },
  {
    path: '/products/edit/:product',
    name: 'ProductsEdit',
    component: EditProductsComponent,
  },
  {
    path: '/products/add',
    name: 'ProductsNew',
    component: NewProductsComponent,
  },
  {
    path: '/pedidos',
    name: 'Pedidos',
    component: PedidosComponent,
  },
  {
    path: '/pedidos/show/:pedido',
    name: 'PedidosShow',
    component: ShowPedidosComponent,
  },
  {
    path: '/pedidos/edit/:pedido',
    name: 'PedidosEdit',
    component: EditPedidosComponent,
  },
  {
    path: '/pedidos/add',
    name: 'PedidosNew',
    component: NewPedidosComponent,
  },
];

const router = new VueRouter({
  routes,
});

export default router;
