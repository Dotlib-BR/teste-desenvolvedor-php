<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <Listbox as="div" v-model="selected">
        <ListboxLabel class="block text-sm font-medium text-gray-700"> Status </ListboxLabel>
        <div class="mt-1 relative">
            <ListboxButton class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <span class="flex items-center">
                    <div class="inline-block w-2 h-2 mr-2 ml-1 bg-gray-200 rounded-full" v-if="selected.code === 0"></div>
                    <div class="inline-block w-2 h-2 mr-2 ml-1 bg-green-400 rounded-full" v-if="selected.code === 1"></div>
                    <div class="inline-block w-2 h-2 mr-2 ml-1 bg-red-500 rounded-full" v-if="selected.code === 2"></div>
                    <span class="ml-3 block truncate">{{ selected.name }}</span>
                </span>
                <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                </span>
            </ListboxButton>

            <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                <ListboxOptions class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                    <ListboxOption as="template" v-for="status in statuses" :key="status.code" :value="status" v-slot="{ active, selected }">
                        <li :class="[active ? 'text-white bg-indigo-600' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9']">
                            <div class="flex items-center">
                                <div class="inline-block w-2 h-2 mr-2 ml-1 bg-gray-200 rounded-full" v-if="status.code === 0"></div>
                                <div class="inline-block w-2 h-2 mr-2 ml-1 bg-green-400 rounded-full" v-if="status.code === 1"></div>
                                <div class="inline-block w-2 h-2 mr-2 ml-1 bg-red-500 rounded-full" v-if="status.code === 2"></div>
                                <span :class="[selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">
                                    {{ status.name }}
                                </span>
                            </div>

                            <span v-if="selected" :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </li>
                    </ListboxOption>
                </ListboxOptions>
            </transition>
        </div>
    </Listbox>
</template>

<script>
import { ref } from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'

const statuses = [
  {code: 0, name: 'Em aberto'},
  {code: 1, name: 'Pago'},
  {code: 2, name: 'Cancelado'},
]

export default {
  components: {
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
    CheckIcon,
    SelectorIcon,
  },
  setup() {
    const selected = ref(statuses[0])

    return {
      statuses,
      selected,
    }
  },
  watch: {
    selected(newValue) {
      this.$emit('selected', newValue.code)
    },
  },
}
</script>