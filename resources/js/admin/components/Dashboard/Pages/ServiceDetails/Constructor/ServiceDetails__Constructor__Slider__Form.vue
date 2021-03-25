<template>
    <div>

        <div class="services__form" v-if="show">
            <a-form-model class="formCont" :model="formData" @submit="handleSubmit" @submit.native.prevent>

                <FormInput
                    :error="errors.name"
                    placeholder="Главный заголовок"
                    type="text"
                    iconType="plus"
                    v-model="formData.title"
                />

                <div class="slidesCont">
                    <div
                        v-for="(s, index) in formData.sliderData"
                        :key="s.uniq_key"
                    >

                        <ServiceDetails__Constructor__Slider__Form__SlideEl
                            v-model="formData.sliderData[index]"
                            @delete="deleteSliderElementHandler(s.uniq_key)"
                            :show="uniqKeyToShowDetailsSliderEl === s.uniq_key"
                            @onHeaderClick="onSliderElementTabClickHandler"
                        />

                    </div>
                    <div class="addSliderEl__cont">
                        <a-button
                            type="primary"
                            @click.native="$emit('addSliderEl')"
                        >
                            Добавить элемент слайдера <a-icon type="add"/>
                        </a-button>
                    </div>
                </div>


                <a-form-model-item>
                    <a-button
                        type="primary"
                        html-type="submit"
                        :disabled=" false "
                        @click="saveSliderDataHandler"
                    >
                        Сохранить <a-icon type="save"/>
                    </a-button>
                </a-form-model-item>


            </a-form-model>
        </div>
    </div>
</template>

<script>
    import FormInput from "../../../../../reusable_components/FormInput";
    import TextArea__Editor from "../../../../../reusable_components/TextArea__Editor";
    import ServiceDetails__Constructor__Slider__Form__SlideEl
        from "./ServiceDetails__Constructor__Slider__Form__SlideEl";
    import {mapActions, mapState} from "vuex";

    export default {
        name: "ServiceDetails__Constructor__Slider__Form",
        props: [
            "data"
        ],
        components: {
            FormInput,
            ServiceDetails__Constructor__Slider__Form__SlideEl
        },

        data() {
            const json_data = this.jsonToData(this.data.json_data);

            try {

            } catch (err) {

            }
            return {
                show: !!this.data,
                uniqKeyToShowDetailsSliderEl: null,
                errors: {},
                formData: {
                    title: this.data ? this.data.title :     null,
                    sliderData: json_data ?? null
                }
            }
        },

        computed: {
            ...mapState({}),
        },

        methods: {
            ...mapActions([
                'deleteServiceSliderElement',

            ]),
            jsonToData(json){
                var json_data = [];

                try{
                    let index = 0;
                    json_data = JSON.parse(json);
                    json_data = json_data.map(el => ({
                        ...el,
                        uniq_key: "" + el.title_left + (++index)
                    }));


                } catch (err) {
                    this.$notification['error']({
                        message: 'Ошибка при обработке данных'
                    });
                }


                return json_data;


            },
            deleteSliderElementHandler(uniq_key) {
                // this.updateServiceSliderElement({
                //     sliderId: this.data.id,
                //     sliderData: this.formData,
                //     sliderElementIndex: index
                // });

                const index = this.formData.sliderData.findIndex(el => el.uniq_key === uniq_key);
                const newData = [...this.formData.sliderData];
                newData.splice(index, 1);

                this.deleteServiceSliderElement({
                   parseJsonSliderData: newData
                });

            },
            handleSubmit() {
                console.log()
            },
            saveSliderDataHandler(){
                this.$emit('saveSliderData', {
                    data: this.formData.sliderData,
                    title: this.formData.title
                });
            },
            onSliderElementTabClickHandler(uniq_key){
                if(this.uniqKeyToShowDetailsSliderEl === uniq_key){
                    this.uniqKeyToShowDetailsSliderEl = null;
                    return;
                }
                this.uniqKeyToShowDetailsSliderEl = uniq_key;

                // indexToShowDetailsSliderEl = s.id
            }
        },

        watch: {
            // data: {
            //     deep: true,
            //     handler() {
            //         this.formData.sliderData = JSON.parse(this.data.json_data);
            //     }
            // },
            'data.json_data': function () {
                this.formData.sliderData = this.jsonToData(this.data.json_data);
            },
            'data.title': function () {
                this.formData.title = this.data.title;
            }
        }
    }
</script>

<style scoped>
    .addSliderEl__cont {
        text-align: center;
        margin-top: 15px;
    }
</style>
