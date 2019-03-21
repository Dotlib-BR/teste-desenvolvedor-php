<template>
  <v-layout align-center justify-center>
    <v-flex md8>
      <v-card>
        <v-toolbar color="primary" dark>
          <v-toolbar-title>
            Lista de Produtos
          </v-toolbar-title>
        </v-toolbar>
        
        <v-card-text>

          <Filtro v-for="(filtro, idx) in filtros" :key='idx' :fields="headers" :filter="filtro" v-on:remove="removerFiltro(idx)"/>

          <v-btn color="cyan darken-3" dark @click="addFiltro">
            Adicionar Filtro
          </v-btn>

          <v-btn v-if="this.filtros.length > 0" color="cyan darken-1" dark @click="fetchData">
            Aplicar Filtros
          </v-btn>

          <v-alert
            :value="noSelectedItemError"
            type="error"
            outline
          >
            Nenhum item está selecionado.
          </v-alert>

          <v-alert
            :value="showDeletedMsg"
            type="info"
            icon="info"
            outline
            v-html="deletedMsg">
          </v-alert>

          <v-data-table 
            v-model="selected" 
            :headers="headers" 
            :items="produtos"
            :total-items="totalItens"
            :loading="loading"
            :pagination.sync="pagination"
            :rows-per-page-items="[5, 10, 15, 20, { text: 'Todos', value: -1 }]"
            select-all>
            
            <template v-slot:items="props">
              <tr :active="props.selected" @click="props.selected = !props.selected" >
                <td><v-checkbox :input-value="props.selected" primary hide-details></v-checkbox></td>
                <td v-for="header in headers" :key="header.value" v-text="props.item[header.value]"></td>
              </tr>
            </template>

          </v-data-table>

        </v-card-text>

        <v-card-text>
          <v-speed-dial
            v-model="fab"
            fixed
            bottom
            right>

            <template v-slot:activator>
              <v-btn
                v-model="fab"
                dark
                fab
                color="pink">
                <v-icon>add</v-icon>
                <v-icon>close</v-icon>
              </v-btn>
            </template>

            <v-btn
              @click="deleteItems"
              dark
              fab
              small
              color="red darken-4">
              <v-icon>delete</v-icon>
            </v-btn>

            <v-btn
              @click="editarProduto"
              dark
              fab
              small
              color="yellow darken-4">
              <v-icon>edit</v-icon>
            </v-btn>
          
          </v-speed-dial>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import Filtro from './Filtro.vue'
export default {

  components: {
    Filtro
  },

  watch: {
    pagination: {
      deep: true,
      handler() {
        this.fetchData()
      }
    }
  },

  data() {
    return {
      filtros: [],
      noSelectedItemError: false,
      showDeletedMsg: false,
      deletedMsg: '',
      loading: false,
      fab: false,
      pagination: {},
      totalItens: 0,
      selected: [],
      produtos: [],
      headers: [
        { text: 'Código de Barras', value: 'CodBarras' },
        { text: 'Nome', value: 'Nome' },
        { text: 'Valor Unitário (R$)', value: 'ValorUnitario'}
      ]
    }
  },

  methods: {
    async fetchData() {
      let filters = {}

      this.filtros.forEach(filtro => {
        if (!!filtro.value) {
          if (!filters.hasOwnProperty(filtro.field)) {
            filters[filtro.field] = []
          }
          filters[filtro.field].push(filtro.value)
        }
      })

      let params = null

      if (_.isEmpty(filters)) {
        params = {
          ...this.pagination
        }
      } else {
        params = {
          ...this.pagination,
          filters
        }
      }

      this.loading = true
      let { data } = await axios.get('/api/produtos', {
        params
      })
      this.produtos = data.result.data
      this.totalItens = data.result.total
      this.loading = false
    },

    editarProduto() {
      this.noSelectedItemError = false

      if (this.selected.length === 0) {
        this.noSelectedItemError = true
      } else {
        localStorage.setItem('produto-edit-id', this.selected[0].id)
        this.$router.push('/editarProduto')
      }
    },

    async deleteItems() {
      this.showDeletedMsg = false
      this.noSelectedItemError = false

      if (this.selected.length === 0) {
        this.noSelectedItemError = true
      }
      else {
        const ids = this.selected.map(i => i.id)
        let { data } = await axios.delete('/api/produtos', {
          params: {
            ids
          }
        })

        let msg = ''
        for (let key in data.result)
          msg += data.result[key] + ' '
        this.deletedMsg = msg
        this.showDeletedMsg = true
        this.fetchData()
      }
    },

    addFiltro() {
      this.filtros.push({field: '', value: ''})
    },

    removerFiltro(idx) {
      this.filtros.splice(idx, 1)
    }
  }
}
</script>
