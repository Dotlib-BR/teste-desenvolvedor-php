<template>
    <Combobox v-model="this.selected">
        <div class="relative mt-1">
            <div class="relative w-full text-left bg-white rounded-lg shadow-md cursor-default focus:outline-none
            focus-visible:ring-2 focus-visible:ring-opacity-75 focus-visible:ring-white
            focus-visible:ring-offset-teal-300 focus-visible:ring-offset-2 sm:text-sm overflow-hidden">
                <ComboboxInput
                        :displayValue="(costumer) => costumer.name"
                        class="w-full border-none focus:ring-0 py-2 pl-3 pr-10 text-sm leading-5 text-gray-900"
                        placeholder="Procure por um nome ou email"
                        @change="this.query = $event.target.value"
                />
                <ComboboxButton
                        class="absolute inset-y-0 right-0 flex items-center pr-2"
                >
                    <SelectorIcon aria-hidden="true" class="w-5 h-5 text-gray-400"/>
                </ComboboxButton>
            </div>
            <TransitionRoot
                    leave="transition ease-in duration-100"
                    leaveFrom="opacity-100"
                    leaveTo="opacity-0"
            >
                <ComboboxOptions
                        class="absolute w-full py-1 mt-1 overflow-scroll text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                >
                    <div
                            v-if="this.filteredCostumers.length === 0 && query !== ''"
                            class="cursor-default select-none relative py-2 px-4 text-gray-700"
                    >
                        Nothing found.
                    </div>

                    <ComboboxOption
                            v-for="costumer in this.filteredCostumers"
                            :key="costumer.id"
                            v-slot="{ selected, active }"
                            :value="costumer"
                            as="template"
                    >
                        <li :class="{'text-white bg-teal-600': active,'text-gray-900': !active,}"
                            class="cursor-default select-none relative py-2 pl-10 pr-4"
                        >
                <span
                        :class="{ 'font-medium': selected, 'font-normal': !selected }"
                        class="block truncate"
                >
                  {{ costumer.name }}
                    <br>
                    {{ costumer.email }}
                </span>
                            <span
                                    v-if="selected"
                                    :class="{ 'text-white': active, 'text-teal-600': !active }"
                                    class="absolute inset-y-0 left-0 flex items-center pl-3"
                            >
                  <CheckIcon aria-hidden="true" class="w-5 h-5"/>
                </span>
                        </li>
                    </ComboboxOption>
                </ComboboxOptions>
            </TransitionRoot>
        </div>
    </Combobox>
</template>

<script>
import {
  Combobox,
  ComboboxInput,
  ComboboxButton,
  ComboboxOptions,
  ComboboxOption,
  TransitionRoot,
} from '@headlessui/vue'
import {CheckIcon, SelectorIcon, QrcodeIcon} from '@heroicons/vue/solid'

export default {
  components: {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
    CheckIcon,
    SelectorIcon,
    QrcodeIcon,
  },
  data() {
    return {
      selected: this.costumers[0],
      query: ''
    }
  },
  computed: {
    filteredCostumers() {
      return this.query === ''
        ? this.costumers
        : this.costumers.filter((costumer) =>
          costumer.name
            .toLowerCase()
            .replace(/\s+/g, '')
            .includes(this.query.toLowerCase().replace(/\s+/g, ''))
        )
    }
  },
  watch: {
    selected(costumer) {
      this.$emit('selected', costumer)
    }
  },
  props: {
    costumers: {
      type: Array,
    },
  },
  methods: {}
}
</script>
