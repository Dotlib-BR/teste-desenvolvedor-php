<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="flex-1 flex justify-between sm:hidden">
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Anterior </a>
            <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Próxima </a>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div v-if="paginated.total > 0">
                <p class="text-sm text-gray-700">
                    Mostrando resultados de
                    {{ ' ' }}
                    <span class="font-medium">{{ paginated.from }}</span>
                    {{ ' ' }}
                    a
                    {{ ' ' }}
                    <span class="font-medium">{{ paginated.to }}</span>
                    {{ ' ' }}
                    &#124  total:
                    {{ ' ' }}
                    <span class="font-medium"> {{ paginated.total }}</span>
                </p>
            </div>
            <div v-if="paginated.total === 0">
                <p class="text-sm text-gray-700">
                    Não há resultados
                </p>
            </div>
            <div>
                <nav aria-label="Pagination" class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" v-if="paginated.links.length > 3">
                    <template v-if="paginated.current_page !== 1">
                        <Link :href="paginated.first_page_url"
                              class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Primeiro</span>
                            <ChevronDoubleLeftIcon aria-hidden="true" class="h-5 w-5"/>
                        </Link>

                        <Link :href="paginated.prev_page_url"
                              class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Anterior</span>
                            <ChevronLeftIcon aria-hidden="true" class="h-5 w-5"/>
                        </Link>
                    </template>

                    <template v-if="paginated.current_page === 1">
                        <PaginationLink :link="links[0]"/>
                        <PaginationLink :link="link" v-for="link in links.slice(1, 3)"></PaginationLink>
                    </template>

                    <template v-if="paginated.current_page !== paginated.last_page && paginated.current_page !== 1">
                        <PaginationLink :link="link" v-for="link in links.slice(paginated.current_page-2, paginated.current_page + 1)"></PaginationLink>
                    </template>

                    <template v-if="paginated.current_page === paginated.last_page">
                        <PaginationLink :link="link" v-for="link in links.slice(paginated.current_page - 3, paginated.last_page)"></PaginationLink>
                    </template>

                    <template v-if="paginated.current_page !== paginated.last_page">
                        <Link :href="paginated.next_page_url"
                              class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Próximo</span>
                            <ChevronRightIcon aria-hidden="true" class="h-5 w-5"/>
                        </Link>

                        <Link :href="paginated.last_page_url"
                              class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300
                              bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Primeiro</span>
                            <ChevronDoubleRightIcon aria-hidden="true" class="h-5 w-5"/>
                        </Link>
                    </template>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import {ChevronLeftIcon, ChevronRightIcon, ChevronDoubleRightIcon, ChevronDoubleLeftIcon } from '@heroicons/vue/solid'
import {Link} from '@inertiajs/inertia-vue3';
import PaginationLink from "@/Components/Pagination/PaginationLink";

export default {
  props: {
    paginated: Object,

  },
  components: {
    PaginationLink,
    ChevronLeftIcon,
    ChevronRightIcon,
    ChevronDoubleRightIcon,
    ChevronDoubleLeftIcon,
    Link
  },
  computed: {
    links() {
      return this.$props.paginated.links.slice(1, this.$props.paginated.links.length - 1);
    }
  }
}
</script>