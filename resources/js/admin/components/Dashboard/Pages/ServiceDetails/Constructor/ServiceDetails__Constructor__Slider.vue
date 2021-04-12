<template>
    <div>
        <a-radio-group
            default-value=" off "
            v-model="isRadioToggleEnable"
            button-style="solid"
            @change="EnableSliderHandler"
        >
            <a-radio-button value="on">
                On
            </a-radio-button>
            <a-radio-button value="off">
                Off
            </a-radio-button>
        </a-radio-group>
        <div
            v-if="isSliderExist"
        >
            <ServiceDetails__Constructor__Slider__Form
                v-if="isSliderEnable"
                @addSliderEl="addSliderElHandler"
                @saveSliderData="saveSliderDataHandler"
                :data=" serviceSliderData "
            />

        </div>
    </div>
</template>

<script>
    import {mapActions, mapState} from "vuex";
    import ServiceDetails__Constructor__Slider__Form from "./ServiceDetails__Constructor__Slider__Form";

    export default {
        name: "ServiceDetails__Constructor__Slider",
        components: {
            ServiceDetails__Constructor__Slider__Form
        },
        data() {
            return {
                isRadioToggleEnable: 'off',
            }
        },

        computed: {
            test() {
                return 'test';
            },
            ...mapState({
                selectedServiceId: state => state.pages.selectedServiceId,
                selectedService: state => state.pages.services.find(el => +el.id === state.pages.selectedServiceId),
            }),

            defaultSliderData() {
                return {
                    title: this.selectedService.category_name,
                    is_active: 1,
                    service_id: this.selectedService.id,
                    json_data: JSON.stringify([{
                        title_left: "Левый заголовок",
                        title_right: "Правый заголовок",
                        image_small: "",
                        image: "",
                        last_price: 3000,
                        price: 1500,
                        text: "Текст слайда"
                    }])
                }
            },

            isSliderExist() {
                return this.selectedService && this.selectedService.slider;
            },

            isSliderEnable() {
                return +this.selectedService.slider.is_active === 1
                // this.selectedService.slider;
            },

            serviceSliderData() {

                if (!this.isSliderExist || !this.isSliderEnable) return null;
                return this.selectedService.slider;


                // return {
                //     ...data,
                //     json_data: JSON.stringify([
                //         ...JSON.parse(data.json_data),
                //         ...this.newJsonData
                //     ])
                // };

            },

        },

        methods: {
            ...mapActions([
                'createSlider',
                'addSliderEl',
                'updateServiceSliderAPI',
                'deactivateSlider',
                'activateSlider'
            ]),

            async createSliderHandler() {
                const res = await this.createSlider(this.defaultSliderData);
                if (res.error) {
                    this.isRadioToggleEnable = 'off';
                }
            },

            EnableSliderHandler(e) {
                if (e.target.value === 'on') {

                    if (!this.isSliderExist) {
                        this.createSliderHandler();
                    } else {
                        this.activateSlider();
                    }

                } else {
                    this.deactivateSlider();
                }
            },

            addSliderElHandler() {
                this.addSliderEl(this.defaultSliderData.json_data);
            },


            saveSliderDataHandler({data, title}) {
                this.updateServiceSliderAPI({
                    sliderData: {
                        ...this.serviceSliderData,
                        title,
                        json_data: JSON.stringify(data)
                    }
                });
            },


            checkForRadioToggleEnable() {
                if (this.isSliderExist && this.isSliderEnable) {
                    this.isRadioToggleEnable = 'on';
                    return
                }
                this.isRadioToggleEnable = 'off';
            },

        },
        created() {
            this.checkForRadioToggleEnable();
        },
        updated() {
            this.checkForRadioToggleEnable();
        },
        mounted() {

        },
        watch: {
            'selectedService.slider': function (value) {

            },
            selectedService(value) {

            }
        }
    }
</script>

<style scoped>

</style>
