<template>
  <div class="lists">
    <div class="top">
      <p class="text-center"><strong>Últimos 5 {{description}}</strong> <span class="badge bg-info"></span></p>
      
    </div>

    <div class="content">
      <div class="table-responsive">
        <table class="table table-striped my_table">
          <thead>
            <tr>
              <th scope="col">{{columns[0]}}</th>
              <th scope="col">{{columns[1]}}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in data" :key="item.id">
              <th scope="row">{{item.id}}</th>
              <td v-if="description == 'Pedidos'">R$ {{item.value_total}}</td>
              <td v-else>{{item.name}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        name: 'ListsComponent',

        props: {
          data: Array,
          description: String,
          columns: [],
        },
    };
</script>

<style scoped>
    .lists {
        width: 100%;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
        background-color: white;
    }
</style>