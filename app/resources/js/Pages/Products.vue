<template>
    <app-layout title="C">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Produtos
            </h2>
        </template>

        <BaseModal :active="modal.active" :onModalClose="this.onModalClose">
            <form @submit.prevent="formSubmit" id="edit-form">
                <div class="px-4 py-5 bg-white p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="first-name" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input required v-model="modal.product.name" type="text" name="first-name" id="first-name" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="last-name" class="block text-sm font-medium text-gray-700">Código de Barras</label>
                            <input required v-model="modal.product.barcode" type="text" name="last-name" id="last-name" autocomplete="cpf" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                        </div>

                        <div class="col-span-2">
                            <label for="price" class="block text-sm font-medium text-gray-700">Preço</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm"> R$ </span>
                                </div>
                                <input required v-model="modal.product.price" step=".01" type="number" min="0" id="price" name="price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-8 pr-4 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 flex justify-between">
                <button type="submit" form="edit-form" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
            </div>
        </BaseModal>

        <div class="pt-12 pb-16 md:pt-16 md:pb-24 ">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="mb-6 justify-between flex">
                    <Link  href="/products/create" :data="filters" as="button" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <PlusIcon class="-ml-1 mr-2 h-5 w-5 text-gray-500" aria-hidden="true" />
                        Novo
                    </Link>

                    <div class="ml-4 relative rounded-md shadow-sm md:w-72 w-full">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <SearchIcon class="text-gray-500 h-5 w-5"/>
                        </div>
                        <input type="text" name="search" class="focus:ring-indigo-500 focus:border-indigo-500
                        block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-md"
                               placeholder="Pesquisar..." v-model="search"/>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                     <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 ">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código de Barras</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço</th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Ações</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="product in pagination.data" :key="product.id">

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ product.name }}</div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ product.barcode }}</div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-xs select-none pr-1">R$</span>
                                                <span class="text-sm text-gray-500">{{ product.price }}</span>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <TableItemMenuDropdown :editAction="this.editAction(product.id)" :deleteAction="this.deleteAction(product.id)"/>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                         <Pagination :paginated="pagination"></Pagination>
                     </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import {ChevronLeftIcon, ChevronRightIcon, PlusIcon, SearchIcon} from '@heroicons/vue/solid';
import Pagination from "@/Components/Pagination/Pagination";
import TableItemMenuDropdown from "@/Components/TableItemMenuDropdown";
import BaseModal from "@/Components/BaseModal";

export default defineComponent({
  name : "Products",
  data() {
    return {
      search: this.$props.filters.search
    }
  },
  props: {
    modal: {
      type: Object,
      default: {
        active: false
      }
    },
    pagination: Object,
    filters: Object
  },
  watch: {
    'search': function (term) {
      Inertia.get('/products', {search: term}, {
        preserveState: true,
        replace: true
      });
    }
  },
  computed: {
  },
  components: {
    Pagination,
    AppLayout,
    Link,
    ChevronLeftIcon,
    ChevronRightIcon,
    SearchIcon,
    PlusIcon,
    BaseModal,
    TableItemMenuDropdown
  },
  methods: {
    onModalClose() {
      Inertia.get('/products', this.filters, {
        replace: true
      });
    },
    formSubmit() {
      if (this.modal.product.id != null) {
        Inertia.put("/products/" + this.modal.product.id + window.location.search, this.modal.product, {
          onFinish: this.onModalClose
        })
      } else {
        Inertia.post("/products/" + window.location.search, this.modal.product, {
          onFinish: this.onModalClose
        })
      }
    },
    deleteAction(id) {
      return () => {
        Inertia.delete("/products/" + id + window.location.search)
      }
    },
    editAction(id) {
      return () => {
        Inertia.get("/products/" + id + "/edit" + window.location.search)
      }
    }
  },
  beforeCreate() {
    if (this.modal.product == null) {
      this.modal.product = {
        name: '',
        price: '',
        barcode: '',
      }
    }
  }
})
</script>

<style scoped>

</style>