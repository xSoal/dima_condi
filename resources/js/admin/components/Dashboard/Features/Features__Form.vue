<template>
    <div>

        <div class="services__form" >
            <a-form-model class="formCont"  @submit.native.prevent>

                <div class="slidesCont">
                    <div
                        v-for="(s, index) in data"
                        :key="s.id"
                    >
                        <Features__Form__El
                            v-model="data[index]"
                            :show="idToShow === s.id"
                            @onHeaderClick="onHeaderClickHadnler"
                        />

                    </div>
                    <div class="addSliderEl__cont">
                        <a-button
                            type="primary"
                            @click.native="$emit('add')"
                        >
                            Добавить элемент
                            <a-icon type="add"/>
                        </a-button>
                    </div>
                </div>

            </a-form-model>
        </div>
    </div>
</template>

<script>
    import FormInput from "../../../reusable_components/FormInput";
    import TextArea__Editor from "../../../reusable_components/TextArea__Editor";
    import Features__Form__El from "./Features__Form__El";
    import {mapActions, mapState} from "vuex";

    export default {
        name: "Features__Form",
        props: [
            "data"
        ],
        components: {
            FormInput,
            Features__Form__El
        },

        data() {
            return {
                idToShow: null
            }
        },

        computed: {
            ...mapState({}),
        },

        methods: {
            ...mapActions([
                'deleteServiceSliderElement',

            ]),

            onHeaderClickHadnler(id) {
                if (this.idToShow === id) {
                    this.idToShow = null;
                    return;
                }
                this.idToShow = id;


            }
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
