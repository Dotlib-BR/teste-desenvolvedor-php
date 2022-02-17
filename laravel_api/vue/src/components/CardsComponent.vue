<template>
    <div class="my_cards d-flex flex-column gap-2 text-light">
        <div class="top d-flex justify-content-between">
            <h3>{{type}}</h3>
            <p class="percentagem fs-5"><i class="fa fa-arrow-up"></i> {{percentagem}}%</p>
        </div>
        <div class="footer d-flex justify-content-between">
            <i :class="['fa-2x m-0', icon]"></i>
            <p class="qtd m-0 fs-4">{{qtd}}</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CardsComponent',

        props: {
            type: String,
            percentagem: String,
            icon: String,
            qtd: Number,
        }
    }
</script>

<style scoped>
    .my_cards {
        width: 100%;
        background-color: #8D86F4;
        padding: 15px;
        border-radius: 7px;
    }

    .top .percentagem {
        color: #79f287;
    }
</style>