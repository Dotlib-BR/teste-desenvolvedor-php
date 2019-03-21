<template>
  <v-layout wrap>
    <v-flex sm12 md4>
      <v-select label="Campo" :items="fields" v-model="filter.field"></v-select>
    </v-flex>
    <v-spacer></v-spacer>
    <v-flex sm12 md7>
      <v-text-field label="Valor" v-model="filter.value"></v-text-field>
    </v-flex>
    <v-flex>
      <v-btn color="red darken-3" dark icon @click="remove">
        <v-icon>delete</v-icon>
      </v-btn>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  props: {
    fields: {
      required: true,
      type: Array
    },

    filter: {
      required: true,
      type: Object
    }
  },

  methods: {
    remove() {
      this.$emit('remove')
    }
  }
}
</script>
