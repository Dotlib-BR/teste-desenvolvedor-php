/* globals Vue */
import VueRouter from 'vue-router'
import Vuetify from 'vuetify'
import pt from 'vuetify/src/locale/pt.ts'
import 'vuetify/dist/vuetify.min.css'

// Componentes
import ListaClientes from './components/ListaClientes.vue'
import ListaProdutos from './components/ListaProdutos.vue'
import ListaPedidos from './components/ListaPedidos.vue'
import NovoCliente from './components/NovoCliente.vue'
import EditarCliente from './components/EditarCliente.vue'
import NovoProduto from './components/NovoProduto.vue'
import EditarProduto from './components/EditarProduto.vue'
import NovoPedido from './components/NovoPedido.vue'
import EditarPedido from './components/EditarPedido.vue'

require('./bootstrap')
Vue.use(VueRouter)
Vue.use(Vuetify, {
  lang: {
    locales: { pt },
    current: 'pt'
  }
})

new Vue({
  data: {
    drawer: false
  },

  router: new VueRouter({
    routes: [
      { path: '/', component: ListaClientes },
      { path: '/listaProdutos', component: ListaProdutos },
      { path: '/listaPedidos', component: ListaPedidos },
      { path: '/novoCliente', component: NovoCliente },
      { path: '/editarCliente', component: EditarCliente },
      { path: '/novoProduto', component: NovoProduto },
      { path: '/editarProduto', component: EditarProduto },
      { path: '/novoPedido', component: NovoPedido },
      { path: '/editarPedido', component: EditarPedido }
    ]
  })

}).$mount('#app')
