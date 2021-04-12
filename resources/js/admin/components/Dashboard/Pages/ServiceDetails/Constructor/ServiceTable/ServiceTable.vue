<template>
    <div class="serviceBlockCont">


        <div v-if="tablesData">
            <ServiceTable__Form__El
                v-for="(s) in tablesData"
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

                    :disabled=" false "
                    @click="addTable"
                >
                    Добавить
                    <a-icon type="add"/>
                </a-button>
            </a-form-model-item>
        </div>





    </div>
</template>

<script>
    import {mapActions, mapState} from "vuex";
    import FormInput from "../../../../../../reusable_components/FormInput";
    import ServiceTable__Form__El from "./ServiceTable__Form__El";

    export default {
        name: "ServiceTable",
        components: {
            ServiceTable__Form__El
        },
        data() {
            return {
                elToShowId: null,
            }
        },

        computed: {
            ...mapState({
                tablesData: state => state.serviceTables.tablesData,

            }),

        },

        methods: {

            ...mapActions([
                'addTable',
                'getTables',
                'deleteTable',

            ]),

            showElHandler(id){
                if(id === this.elToShowId){
                   return this.elToShowId = null
                }
                this.elToShowId = id;
            },
            deleteHandler(id){
                this.deleteTable(id);
            }

        },
        created() {
            this.getTables();
        },
        updated() {

        },
        mounted() {

        },
        watch: {

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
