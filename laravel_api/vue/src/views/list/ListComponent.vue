<template>
    <DashboardComponent>
        <div slot="slot-pages" class="content-pages">
            <p>ListComponent</p>
        </div>
    </DashboardComponent>
    <!-- <div>
        <p>Home nosso system</p>
    </div> -->
</template>

<script>
    import DashboardComponent from '../Dashboard/DashboardComponent.vue';

    export default {
        name: 'ListComponent',

        components: {
            DashboardComponent,
        }
    }
</script>

<style src="./input.css" scoped/>