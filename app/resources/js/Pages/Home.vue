<template>

  <h1>this is home 🏠, {{ user }}</h1>
</template>

<script>
export default {
  props: {
    user: String
  },
  name: "Home"
}
</script>

<style scoped>

</style>