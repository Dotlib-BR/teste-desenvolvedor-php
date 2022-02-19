<template>
    <app-layout title="C">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pedido #{{ order.id }}
            </h2>
        </template>

        <BaseModal :active="modal.active" :onModalClose="()=>{this.modal.active = false}">
            <form @submit.prevent="addFormSubmit" id="add_product">
                <div class="px-4 py-5 bg-white p-6 h-80">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block text-sm font-medium text-gray-700">Nome</label>
                            <ProductsCombobox class="mt-1 w-full py-2 px-3" :products="this.products" @selected="productSelected"/>
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="add_product_ammount" class="block text-sm font-medium text-gray-700">Quantidade</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input required v-model="modal.amount" step=".01" type="number" min="0" id="add_product_ammount" name="price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-8 pr-4 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" />
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="add_product_id" v-model="modal.product.id" />

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm
                text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none
                focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
                </div>
            </form>
        </BaseModal>

        <div class="pt-16 pb-24">
            <div class="max-w-5xl mx-auto px-6 lg:px-8">
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
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr>
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
                                                    <div class="inline-block w-2 h-2 mr-2 ml-1 bg-gray-200 rounded-full" v-if="order.status === 0"></div>
                                                    <div class="inline-block w-2 h-2 mr-2 ml-1 bg-green-400 rounded-full" v-if="order.status === 1"></div>
                                                    <div class="inline-block w-2 h-2 mr-2 ml-1 bg-red-500 rounded-full" v-if="order.status === 2"></div>
                                                    <span class="text-sm text-gray-500">{{ order.readable_status }}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden shadow-xl sm:rounded-lg mt-4">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 ">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código de barras</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="product in order.products ">
                                                <td class="px-6 py-3 whitespace-nowrap">
                                                    <div class="text-sm text-gray-500">{{ product.id }}</div>
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap">
                                                    <div class="text-sm text-gray-500">{{ product.name }}</div>
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap">
                                                    <div class="text-sm text-gray-500">{{ product.barcode }}</div>
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap">
                                                    <span class="text-xs select-none pr-1">R$</span>
                                                    <span class="text-sm text-gray-500">{{ product.price }}</span>
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap">
                                                    <span class="text-sm text-gray-500">{{ product.pivot.quantity }}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button v-on:click="modal.active = true" class="flex justify-center items-center mt-4 h-16 w-full text-sm font-medium border-gray-300 border-dashed border-2 transition rounded-lg text-gray-300 hover:text-gray-500 hover:border-gray-500 ">
                    <PlusIcon class="w-6 h-6 mr-2"></PlusIcon>
                    Adicionar produto
                </button>
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
import ProductsCombobox from "@/Components/ProductsCombobox";

export default defineComponent({
  name : "Order",
  props: {
    order: Object,
    products: Array,
  },
  data: () => ({
    modal: {
      active: false,
      amount: 1,
      product: {
        id: null,
        name: null,
        barcode: null,
        price: null,
      },
    },
  }),
  components: {
    ProductsCombobox,
    Pagination,
    AppLayout,
    Link,
    ChevronLeftIcon,
    ChevronRightIcon,
    SearchIcon,
    PlusIcon,
    BaseModal,
    TableItemMenuDropdown,
  },
  methods: {
    addFormSubmit() {
      Inertia.put(`/orders/${this.order.id}/products`, {
        product_id: this.modal.product.id,
        quantity: this.modal.amount,
      });
    },
    productSelected(orderProduct) {
      this.modal.product = orderProduct
    },
  },
})
</script>

<style scoped>

</style>