<template>

    <div class="slide">

        <div
            class="slide__header"
            :class="show ? `slide__header-active` : ``"
            @click="$emit('onHeaderClick', value.uniq_key)"
        >
            <div class="slide__headerText">
                {{ localData.title_left }}
            </div>
            <div
                class="slide__headerButton"
                @click.stop="deleteModalVisible = true"
            >
                <a-icon type="delete" />
            </div>
            <a-modal
                title="Подтверждение удаления"
                :visible="deleteModalVisible"
                @ok="deleteOk"
                @cancel="deleteCancel"
            >
                <p> Напрочь удалить слайд <b>{{ localData.category_name }}</b> с сайта? Точно??? </p>
            </a-modal>
        </div>
        <div
            class="slide__body"
            v-if="show"
        >
            <FormInput
                placeholder="Заголовок слева"
                type="text"
                iconType="plus"
                v-model="localData.title_left"
            />

            <FormInput
                placeholder="Заголовок справа"
                type="text"
                iconType="plus"
                v-model="localData.title_right"
            />

            <FormInput
                placeholder="Страрая цена"
                type="number"
                iconType="plus"
                    v-model="localData.last_price"
            />


            <FormInput
                placeholder="Новая цена"
                type="number"
                iconType="plus"
                v-model="localData.price"
            />



            <TextArea__Editor
                v-model="localData.text"
            />

            <div>
<!--                <img-->
<!--                    class="slider_Image"-->
<!--                    :src="`/${localData.image}`"-->
<!--                    alt=""-->
<!--                >-->

                <FilePicker
                    :currentFileSrcProps="localData.image"
                    v-model="localData.image"
                />
            </div>
        </div>
    </div>
</template>

<script>
    import FormInput from "../../../../../reusable_components/FormInput";
    import TextArea__Editor from "../../../../../reusable_components/TextArea__Editor";
    import FilePicker from "../../../../../reusable_components/FilePicker/FilePicker";

    export default {
        name: "ServiceDetails__Constructor__Slider__Form__SlideEl",
        props: [
            'value', 'show'
        ],
        components: {
            FilePicker,
            FormInput,
            TextArea__Editor
        },
        data(){
            return {
                deleteModalVisible: false,
                localData: this.value
            }
        },
        methods: {
            // update(){
            //     this.$emit('input', this.localData)
            // },
            deleteOk(){
                this.$emit('delete', this.localData.uniq_key);
                this.deleteModalVisible = false;
            },
            deleteCancel(){
                this.deleteModalVisible = false;
            }
        },
        watch: {
            value(newData){
                this.localData = newData;
            }
        },
        mounted() {
            window.__store = this.$store;
        }
    }
</script>

<style scoped>

    .slide__header-active {
        background-color: #328847;
        color: white;
    }

    .slide  {
        margin-top: 10px;

    }

    .slide__header {
        position: relative;
        min-height: 45px;
        border-radius: 5px;
        border: 1px solid #e7e7e7;
        cursor: pointer;
        transition: .2s;
        user-select: none;
    }

    .slide__header:hover {
        border-color: #777;
    }

    .slide__headerText {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .slide__headerButton {
        position: absolute;
        right: 7px;
        top: 0;
        bottom: 3px;
        margin: auto;
        height: 25px;
        width: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .slide__headerButton i {
        font-size: 1rem;
        opacity: .5;
        transition: opacity 0.24s;
        cursor: pointer;
    }

    .slide__headerButton i:hover {
        opacity: 1;
    }

    .slide__body {
        padding: 15px 5px;
    }


</style>
