<template>
    <div>
        <div class="servicesList">
            <Service
                v-for="s in services"
                :key="s.id"
                :data="s"
                :isSelected="s.id === selectedServiceId"
                @click.native.prevent="selectService(s.id)"
                @deleteService="selectedServiceId = null"
                :selectedCategoryId="selectedCategoryId"
            />
        </div>
        <ServiceDetails
            v-if="selectedServiceId"

        />
    </div>
</template>

<script>
    import Service from "./Service";
    import {mapActions, mapState} from 'vuex';
    import ServiceDetails from "./ServiceDetails/ServiceDetails";

    export default {
        name: "Services",
        components: {
            ServiceDetails,
            Service,
        },
        data() {
            return {
                // serviceData: null
            }
        },
        computed: {
            ...mapState({
                services: state => state.pages.services,
                selectedServiceId: state => state.pages.selectedServiceId,
                selectedCategoryId: state => state.pages.selectedCategoryId
            })
        },
        methods: {
            ...mapActions(['selectService'])
        },
        watch: {
            $route(to, from) {

            }
        },
        mounted() {
            const serviceId = this.$route.params.serviceId ?? null;
            if(serviceId){
                this.selectService(+serviceId);
            }
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
