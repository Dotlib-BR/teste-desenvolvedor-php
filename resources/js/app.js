/* globals Vue */
import VueRouter from 'vue-router'
import Vuetify from 'vuetify'
import pt from 'vuetify/src/locale/pt.ts'
import 'vuetify/dist/vuetify.min.css'

// Componentes
import ListaClientes from './components/ListaClientes.vue'
import ListaProdutos from './components/ListaProdutos.vue'
import ListaPedidos from './components/ListaPedidos.vue'

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
      { path: '/listaPedidos', component: ListaPedidos }
    ]
  })

}).$mount('#app')
