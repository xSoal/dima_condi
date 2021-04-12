<template>
    <div>

        <div class="services__form" v-if="show">
<!--            <a-form-model class="formCont" :model="formData" @submit="handleSubmit" @submit.native.prevent>-->

<!--                <FormInput-->
<!--                    :error="errors.name"-->
<!--                    placeholder="Главный заголовок"-->
<!--                    type="text"-->
<!--                    iconType="plus"-->
<!--                    v-model="formData.title"-->
<!--                />-->

<!--                <div class="slidesCont">-->
<!--                    <div-->
<!--                        v-for="(s, index) in formData.sliderData"-->
<!--                        :key="s.uniq_key"-->
<!--                    >-->

<!--                        <ServiceBlocks__Form__El-->
<!--                            v-model="formData.sliderData[index]"-->
<!--                            @delete="deleteSliderElementHandler(s.uniq_key)"-->
<!--                            :show="uniqKeyToShowDetailsSliderEl === s.uniq_key"-->
<!--                            @onHeaderClick="onSliderElementTabClickHandler"-->
<!--                        />-->

<!--                    </div>-->
<!--                    <div class="addSliderEl__cont">-->
<!--                        <a-button-->
<!--                            type="primary"-->
<!--                            @click.native="$emit('addSliderEl')"-->
<!--                        >-->
<!--                            Добавить элемент слайдера <a-icon type="add"/>-->
<!--                        </a-button>-->
<!--                    </div>-->
<!--                </div>-->


<!--                <a-form-model-item>-->
<!--                    <a-button-->
<!--                        type="primary"-->
<!--                        html-type="submit"-->
<!--                        :disabled=" false "-->
<!--                        @click="saveSliderDataHandler"-->
<!--                    >-->
<!--                        Сохранить <a-icon type="save"/>-->
<!--                    </a-button>-->
<!--                </a-form-model-item>-->


<!--            </a-form-model>-->
        </div>
    </div>
</template>

<script>
    import FormInput from "../../../../../../reusable_components/FormInput";
    import TextArea__Editor from "../../../../../../reusable_components/TextArea__Editor";
    import ServiceFAQ__Form__El from "./ServiceFAQ__Form__El";
    import {mapActions, mapState} from "vuex";

    export default {
        name: "ServiceFAQ__Form",
        props: [
            "data", "show"
        ],
        components: {
            FormInput,
            ServiceFAQ__Form__El
        },

        data() {

            return {

            }
        },

        computed: {
            ...mapState({}),
        },

        methods: {
            ...mapActions([
                'deleteServiceSliderElement',

            ]),

        },

        watch: {

        }
    }
</script>

<style scoped>
    .addSliderEl__cont {
        text-align: center;
        margin-top: 15px;
    }
</style>
