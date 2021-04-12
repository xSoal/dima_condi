<template>



    <div class="slide">

        <div
            class="slide__header"
            :class="show ? `slide__header-active` : ``"
            @click="$emit('show', value.id)"
        >
            <div class="slide__headerText">
                {{ value.title }}
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
                <p> Удалить таблицу <b>{{ value.title }}</b>? </p>
            </a-modal>
        </div>

        <div
            class="slide__body"
            v-if="show"
        >

            <FormInput
                placeholder="Название таблицы"
                type="text"
                iconType="plus"
                v-model="value.title"
            />



            <Table
                v-model="value.data"
            />


                <div style="text-align: center">
                    <a-form-model-item>
                        <a-button
                            type="primary"
                            :disabled=" false "
                            @click="editTable(value.id)"
                        >
                            Сохранить
                            <a-icon type="add"/>
                        </a-button>
                    </a-form-model-item>
                </div>

        </div>


    </div>
</template>

<script>


    import FilePicker from "../../../../../../reusable_components/FilePicker/FilePicker";
    import FormInput from "../../../../../../reusable_components/FormInput";
    import TextArea__Editor from "../../../../../../reusable_components/TextArea__Editor";
    import Table from "./Table";
    import {mapActions} from "vuex";

    export default {
        name: "ServiceFAQ__Form__El",
        props: [
            'value', 'show'
        ],
        components: {
            FilePicker,
            FormInput,
            TextArea__Editor,
            Table,
        },
        data(){
            return {
                deleteModalVisible: false,
            }
        },
        methods: {
            ...mapActions([
                'editTable'
            ]),


            // update(){
            //     this.$emit('input', this.localData)
            // },
            deleteOk(){

                this.$emit('delete', this.value.id);
                this.deleteModalVisible = false;
            },
            deleteCancel(){
                this.deleteModalVisible = false;
            }
        },
        watch: {

        },
        mounted() {

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
