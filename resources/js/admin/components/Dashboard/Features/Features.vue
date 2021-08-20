<template>
    <div>

        <h1>Наши приемущества</h1>

        <Features__Form
            v-if="features"
            @add="add"
            :data=" features "
        />



    </div>
</template>

<script>
    import {mapActions, mapState} from "vuex";
    import Features__Form from "./Features__Form";

    export default {
        name: "Features",
        components: {
            Features__Form
        },
        data() {
            return {

            }
        },

        computed: {

            ...mapState({
                features: state => state.features.features,
            }),


        },

        methods: {
            ...mapActions('features', [
                'get',
                'add',
            ]),



        },
        created() {

        },
        updated() {

        },
        mounted() {
            this.get();
        },
        watch: {

        }
    }
</script>

<style scoped>

</style>
