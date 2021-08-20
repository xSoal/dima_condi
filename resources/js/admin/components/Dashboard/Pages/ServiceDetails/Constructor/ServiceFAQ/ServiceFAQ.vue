<template>
    <div class="serviceBlockCont">

        <div v-if="serviceFAQData">
            <ServiceFAQ__Form__El
                v-for="(s) in serviceFAQData"
                :key="s.id"
                :show="elToShowId === s.id"
                :value="s"
                @show="showElHandler"
                @delete="deleteHandler"
            />
        </div>


        <div style="text-align: center">
            <a-form-model-item>
                <a-button
                    type="primary"
                    html-type="submit"
                    :disabled=" false "
                    @click="addFAQ"
                >
                    Добавить элемент
                    <a-icon type="add"/>
                </a-button>
            </a-form-model-item>
        </div>




    </div>
</template>

<script>
    import {mapActions, mapState} from "vuex";
    import ServiceFAQ__Form from "./ServiceFAQ__Form";
    import ServiceFAQ__Form__El from "./ServiceFAQ__Form__El";

    import FormInput from "../../../../../../reusable_components/FormInput";

    export default {
        name: "ServiceFAQ",
        components: {
            ServiceFAQ__Form,
            ServiceFAQ__Form__El,
            FormInput
        },
        data() {
            return {
                elToShowId: null,
                deleteModalVisible: false,
            }
        },

        computed: {
            ...mapState({
                serviceFAQData: state => state.serviceFAQ.serviceFAQ
            }),


        },

        methods: {
            ...mapActions([
                'addFAQ',
                'getFAQ',
                'deleteFAQ',
                'saveFAQ'
            ]),

            deleteHandler(faqID) {
                this.deleteModalVisible = false;
                this.deleteFAQ(faqID);
            },

            showElHandler(elToShowId) {
                if (this.elToShowId === elToShowId) {
                    this.elToShowId = null
                } else {
                    this.elToShowId = elToShowId
                }
            },


        },
        created() {

        },
        updated() {

        },
        mounted() {
            this.getFAQ();
        },
        watch: {
            isActive(n1) {
                this.toogleStatus = n1;
            }
        }
    }
</script>

<style scoped>

    .serviceBlockCont {
        position: relative;
    }


    .needActivateCont {
        margin-top: 15px;

        display: flex;
        justify-content: center;
    }

    .needActivateCont > button {
        padding: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1rem;
    }


    .deleteCont {
        position: absolute;
        right: 5px;
        padding: 5px;
        cursor: pointer;
    }

    .deleteCont:hover i {
        color: green;
    }


</style>
