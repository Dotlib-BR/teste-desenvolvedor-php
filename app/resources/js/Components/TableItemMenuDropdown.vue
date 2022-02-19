<template>
    <Menu as="div" class="inline-block text-left">
        <div>
            <MenuButton
                    class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white text-indigo-600 hover:text-indigo-900"
            >
                Opções
                <ChevronDownIcon
                        aria-hidden="true"
                        class="w-5 h-5 ml-2 -mr-1 text-violet-200 hover:text-violet-100"
                />
            </MenuButton>
        </div>

        <transition
                enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0"
                enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in"
                leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0"
        >
            <MenuItems
                    class="absolute right-4 w-40 z-10 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            >
                <div class="px-1 py-1">
                    <MenuItem v-slot="{ active }">
                        <button :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900',
                                'group flex rounded-md items-center w-full px-2 py-2 text-sm',]"
                                v-on:click="editAction"
                        >
                            <PencilIcon
                                    :active="active"
                                    aria-hidden="true"
                                    class="w-5 h-5 mr-2 text-violet-400"
                            />
                            Editar
                        </button>
                    </MenuItem>
                </div>
                <div class="px-1 py-1">
                    <MenuItem v-slot="{ active }">
                        <button :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900',
                                'group flex rounded-md items-center w-full px-2 py-2 text-sm']"
                                v-on:click="deleteAction"
                        >
                            <TrashIcon
                                    :active="active"
                                    aria-hidden="true"
                                    class="w-5 h-5 mr-2 text-violet-400"
                            />
                            Apagar
                        </button>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script>
import {Menu, MenuButton, MenuItems, MenuItem} from '@headlessui/vue'
import {ChevronDownIcon, TrashIcon, PencilIcon} from '@heroicons/vue/solid'
import { Link } from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";

export default {
  components: {
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    Link,
    PencilIcon,
    ChevronDownIcon,
    TrashIcon,
  },
  props: {
    editAction: {
      type: Function,
    },
    deleteAction: {
      type: Function
    }
  },
}
</script>
