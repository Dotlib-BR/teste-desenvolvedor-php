<template>
    <Link :href="link.url" v-if="link.active" class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
        {{ link.label }}
    </Link>
    <Link :href="link.url" v-if="!link.active" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
        {{ link.label }}
    </Link>
</template>
<script>

import { Link } from '@inertiajs/inertia-vue3';

export default {
  name: 'PaginationLink',
  props: {
    link: {}
  },
  components: {
    Link
  }
}
</script>