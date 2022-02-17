<template>
  <div class="lists">
    <div class="top">
      <p class="text-start"><strong>{{description}}</strong> <span class="badge bg-info">{{data.length}}</span></p>
      
    </div>

    <div class="content">
      <table class="table table-striped my_table">
        <thead>
          <tr>
            <th scope="col">{{columns[0]}}</th>
            <th scope="col">{{columns[1]}}</th>
            <th scope="col">{{columns[2]}}</th>
            <th scope="col">{{columns[3]}}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in data" :key="item.id">
            <th scope="row">{{item.id}}</th>
            <td>{{item.name}}</td>
            <td>{{(description == 'Clientes') ? item.email : item.valor}}</td>
            <td>{{item.phone}}</td>
            
          </tr>
        </tbody>
      </table>
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