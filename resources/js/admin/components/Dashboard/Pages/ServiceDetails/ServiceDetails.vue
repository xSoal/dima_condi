<template>
    <div>

        <template
            v-if="serviceData"
        >
            <ServiceDetails__Header
                :data="serviceData"
            />

            <a-tabs default-active-key="1">
                <a-tab-pane key="1" tab="Основное">
                    <ServiceDetails__TabMain :data="serviceData" />
                </a-tab-pane>
                <a-tab-pane key="2" tab="Главный слайдер сверху">
                    <ServiceDetails__Constructor__Slider/>
                </a-tab-pane>
            </a-tabs>
        </template>




    </div>
</template>

<script>
    import ServiceDetails__Header from "./ServiceDetails__Header";
    import ServiceDetails__TabMain from "./ServiceDetails__TabMain";
    import ServiceDetails__Constructor from "./Constructor/ServiceDetails__Constructor";
    import {mapState} from "vuex";
    import ServiceDetails__Constructor__Slider from "./Constructor/ServiceDetails__Constructor__Slider";

    export default {
        name: "ServiceDetails",
        data(){
          return {

          }
        },
        components: {
            ServiceDetails__Header,
            ServiceDetails__TabMain,
            ServiceDetails__Constructor,
            ServiceDetails__Constructor__Slider
        },
        computed: {
            ...mapState({
                selectedServiceId: state => state.pages.selectedServiceId,
                services: state => state.pages.services,
                serviceData: state => state.pages.services.find(el => {
                    return +el.id === +state.pages.selectedServiceId;
                }) ?? null,

            }),
        },

        mounted() {
        }
    }
</script>

<style scoped>

</style>
