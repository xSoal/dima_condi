<template>
    <div class="servicesList">
        <Service
            v-for="s in services"
            :key="s.id"
            :data="s"
        />

    </div>
</template>

<script>
    import Service from "./Service";
    import {mapActions, mapState} from 'vuex';
    export default {
        name: "Services",
        components: {
            Service
        },

        computed: {
            ...mapState({
                services: state => state.pages.services,
            })
        },
        methods: {

        },
        mounted() {
        }

    }
</script>

<style scoped>

    .servicesList {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

</style>
