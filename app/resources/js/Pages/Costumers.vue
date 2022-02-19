<template>
    <app-layout title="C">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Clientes
            </h2>
        </template>

        <BaseModal :active="modal.active" :onModalClose="this.onModalClose">
            <form @submit.prevent="formSubmit" id="costumer-form">
                <div class="px-4 py-5 bg-white p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="first-name" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input v-model="modal.costumer.name" type="text" name="first-name" id="first-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="last-name" class="block text-sm font-medium text-gray-700">CPF</label>
                            <input v-model="modal.costumer.cpf" type="text" name="last-name" id="last-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <label for="email-address" class="block text-sm font-medium text-gray-700">Email</label>
                            <input v-model="modal.costumer.email" type="text" name="email-address" id="email-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                        </div>
                    </div>
                </div>
            </form>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 flex justify-between">
                <button type="submit" form="costumer-form" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
            </div>
        </BaseModal>

        <div class="pt-12 pb-16 md:pt-16 md:pb-24 ">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="mb-6 justify-between flex">
                    <Link  href="/costumers/create" :data="filters" as="button" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <PlusIcon class="-ml-1 mr-2 h-5 w-5 text-gray-500" aria-hidden="true" />
                        Novo
                    </Link>

                    <div class="ml-4 relative rounded-md shadow-sm md:w-72 w-full">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <SearchIcon class="text-gray-500 h-5 w-5"/>
                        </div>
                        <input type="text" name="search" class="focus:ring-indigo-500 focus:border-indigo-500
                        block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-md"
                               placeholder="Pesquisar por nome, cpf ou email..." v-model="search"/>
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
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CPF</th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Ações</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="costumer in pagination.data" :key="costumer.email" class="hover:bg-gray-100 cursor-pointer" v-on:click="$inertia.get('/orders',{search: costumer.email})">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full" :src="costumer.picture" alt="" />
                                                    </div>
                                                    <div class="ml-4">
                                                        <span class="text-sm font-medium text-gray-900">
                                                            {{ costumer.name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-500">{{ costumer.email }}</span>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-500">{{ costumer.cpf }}</span>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <TableItemMenuDropdown :editAction="this.editAction(costumer.id)" :deleteAction="this.deleteAction(costumer.id)"/>
                                            </td>
                                        </tr >
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
import { ChevronLeftIcon, ChevronRightIcon, PlusIcon, SearchIcon } from '@heroicons/vue/solid';
import Pagination from "@/Components/Pagination/Pagination";
import BaseModal from "@/Components/BaseModal";
import TableItemMenuDropdown from "@/Components/TableItemMenuDropdown";


export default defineComponent({
  name : "Costumers",
  data() {
    return {
      search: this.$props.filters.search,
    }
  },
  props: {
    modal: {
      type: Object,
      default: {
        active: false,
        costumer: {
          id: null,
          name: '',
          email: '',
        }
      }
    },
    pagination: Object,
    filters: Object
  },
  watch: {
    search: function (term) {
      Inertia.get('/costumers', {search: term}, {
        preserveState: true,
        replace: true
      });
    }
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
      Inertia.get('/costumers', this.filters);
    },
    formSubmit() {
      if (this.modal.costumer.id != null) {
        Inertia.put("/costumers/" + this.modal.costumer.id + window.location.search, this.modal.costumer, {
          onFinish: this.onModalClose
        })
      } else {
        Inertia.post("/costumers/" + window.location.search, this.modal.costumer, {
          onFinish: this.onModalClose
        })
      }
    },
    deleteAction(id) {
      return () => {
        Inertia.delete("/costumers/" + id + window.location.search)
      }
    },
    editAction(id) {
      return () => {
        Inertia.get("/costumers/" + id + "/edit" + window.location.search)
      }
    }
  },
  beforeCreate() {
    if (this.modal.costumer == null) {
      this.modal.costumer = {
        name: '',
        email: '',
        cpf: '',
      }
    }
  }
})
</script>

<style scoped>

</style>