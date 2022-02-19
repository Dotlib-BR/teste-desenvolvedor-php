<template>
    <app-layout title="C">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pedidos
            </h2>
        </template>

        <BaseModal :active="modal.active" :onModalClose="onModalClose">
            <form @submit.prevent="addFormSubmit" id="add_product">
                <div class="px-4 py-5 bg-white p-6 h-80">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block text-sm font-medium text-gray-700">Nome</label>
                            <CostumersCombobox :costumers="costumers" @selected="onCostumerPickerSelection" class="z-10"/>
                            <input type="hidden" name="add_order_costumer_id" v-model="orderForm.costumer_id" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <label for="add_order_bought_at" class="block text-sm font-medium text-gray-700">Comprado em</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input required v-model="orderForm.bought_at" type="datetime-local" min="0" id="add_order_bought_at" name="price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-8 pr-4 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" />
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <OrderStatusPicker class="z-10" @selected="(code) => {this.orderForm.status = code}"/>
                                <input type="hidden" name="add_order_costumer_id" v-model="orderForm.status" />
                            </div>
                        </div>
                    </div>
                </div>


                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm
                text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none
                focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
                </div>
            </form>
        </BaseModal>

        <div class="pt-12 pb-16 md:pt-16 md:pb-24 ">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="mb-6 justify-between flex">
                    <Link  href="/orders/create" :data="filters" as="button" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <PlusIcon class="-ml-1 mr-2 h-5 w-5 text-gray-500" aria-hidden="true" />
                        Novo
                    </Link>
                    <div class="ml-4 relative rounded-md shadow-sm md:w-72 w-full">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <SearchIcon class="text-gray-500 h-5 w-5"/>
                        </div>
                        <input type="text" name="search" class="focus:ring-indigo-500 focus:border-indigo-500
                        block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-md"
                               placeholder="Pesquisar..." v-model="filters.search"/>
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
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comprado em</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor Total</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Ações</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="order in modelPagination.data" :key="order.id" class="hover:bg-gray-100 cursor-pointer" @click="onRowClick($event, order)">

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ order.id }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full" :src="order.costumer.picture" alt="" />
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ order.costumer.name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ order.costumer.email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ order.bought_at }}</div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-xs select-none pr-1">R$</span>
                                                <span class="text-sm text-gray-500">{{ order.total_price }}</span>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="inline-block w-2 h-2 mr-2 ml-1 bg-gray-200 rounded-full" v-if="order.status === 0"></div>
                                                <div class="inline-block w-2 h-2 mr-2 ml-1 bg-green-400 rounded-full" v-if="order.status === 1"></div>
                                                <div class="inline-block w-2 h-2 mr-2 ml-1 bg-red-500 rounded-full" v-if="order.status === 2"></div>
                                                <span class="text-sm text-gray-500">{{ order.readable_status }}</span>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <TableItemMenuDropdown modelUrl="/orders" :modelId="order.id" :edit-action="editAction(order.id)" :delete-action="deleteAction(order.id)"/>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <Pagination :paginated="modelPagination"></Pagination>
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
import CostumersCombobox from "@/Components/CostumersCombobox";
import BaseModal from "@/Components/BaseModal";
import OrderStatusPicker from "@/Components/OrderStatusPicker";

export default defineComponent({
  name : "Orders",
  props: {
    modal: {
      type: Object,
      default: () => ({
        show: false,
      }),
    },
    modelPagination: Object,
    filters: Object,
    costumers: Array,
  },
  data: () => ({
    orderForm: {
      costumer_id: null,
      bought_at: null,
      status: null,
    }
  }),
  watch: {
    'filters.search': function (term) {
      Inertia.get('/orders', {search: term}, {
        preserveState: true,
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
    TableItemMenuDropdown,
    BaseModal,
    CostumersCombobox,
    OrderStatusPicker,
  },
  methods: {
    onModalClose() {
      Inertia.get('/orders', this.filters, {
        replace: true
      });
    },
    onRowClick(e, order) {
      // discard when event path has element id that starts with 'button'

      if (e.path.find(el => el.id.startsWith('headlessui-menu'))) {
        console.log('discard');
      }

      Inertia.get('/orders/' + order.id, {
      });
    },
    addFormSubmit() {
      Inertia.post('/orders', this.orderForm, {
        preserveState: true,
      });
    },
    onCostumerPickerSelection(costumer) {
      this.orderForm.costumer_id = costumer.id;
    },
    deleteAction(id) {
      return () => {
        Inertia.delete("/orders/" + id + window.location.search)
      }
    },
    editAction(id) {
      return () => {
        Inertia.get("/orders/" + id)
      }
    },
  },
  created() {

  }
})
</script>

<style scoped>

</style>