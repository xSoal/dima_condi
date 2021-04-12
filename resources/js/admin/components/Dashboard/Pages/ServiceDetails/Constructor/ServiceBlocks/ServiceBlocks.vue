<template>
    <div class="serviceBlockCont">
        <div v-if="serviceBlocksData">

            <div
                class="deleteCont"
                @click="deleteModalVisible = true"
            >
                <a-icon type="delete"/>
                <a-modal
                    title="Подтверждение удаления"
                    :visible="deleteModalVisible"
                    @ok="deleteHandler"
                    @cancel="deleteModalVisible = false"
                >
                    <p> Удалить? Точно??? </p>
                </a-modal>

            </div>



            <a-radio-group
                v-model="toogleStatus"
                button-style="solid"
                @change="toggleActiveHandler"
            >
                <a-radio-button value="on">
                    On
                </a-radio-button>
                <a-radio-button value="off">
                    Off
                </a-radio-button>
            </a-radio-group>

            <div>
                <FormInput
                    placeholder=" Хедер "
                    type="text"
                    iconType="plus"
                    v-model="serviceBlocksData.title"
                />
            </div>


            <div
                v-if="serviceBlocksBlocks"
            >
                <ServiceBlocks__Form__El
                    v-for="(s) in serviceBlocksBlocks"
                    :key="s.id"
                    :show="elToShowId === s.id"
                    :value="s"
                    @show="showElHandler"
                    @deleteServiceBlockElementChild="deleteServiceBlockChildElementHandler"
                />

            </div>

            <div style="text-align: center">
                <a-form-model-item>
                    <a-button
                        type="primary"
                        html-type="submit"
                        :disabled=" false "
                        @click="addServiceBlockElement"
                    >
                        Добавить элемент <a-icon type="add"/>
                    </a-button>
                </a-form-model-item>
            </div>


            <div >
                <a-form-model-item>
                    <a-button
                        type="primary"
                        html-type="submit"
                        :disabled=" false "
                        @click="saveAllServiceBlockData"
                    >
                        Сохранить <a-icon type="save"/>
                    </a-button>
                </a-form-model-item>
            </div>


        </div>
        <div
            v-else
            class="needActivateCont"
            @click="createHandler"
        >
            <a-button> Создать ?</a-button>
        </div>

    </div>
</template>

<script>
    import {mapActions, mapState} from "vuex";
    import ServiceBlocks__Form from "./ServiceBlocks__Form";
    import ServiceBlocks__Form__El from "./ServiceBlocks__Form__El";
    import _ from 'lodash';
    import FormInput from "../../../../../../reusable_components/FormInput";

    export default {
        name: "ServiceBlocks",
        components: {
            ServiceBlocks__Form,
            ServiceBlocks__Form__El,
            FormInput
        },
        data() {
            return {
                toogleStatus: 'off',
                elToShowId: null,
                deleteModalVisible: false,
            }
        },

        computed: {
            ...mapState({
                selectedServiceId: state => state.pages.selectedServiceId,
                serviceBlocksData: state => state.serviceBlocks.serviceBlocksData,
            }),

            serviceBlocksBlocks() {
                return this.serviceBlocksData?.service_block___block ?
                    this.serviceBlocksData?.service_block___block
                    : null
            },

            isActive() {
                return +this.serviceBlocksData?.is_active === 1 ? 'on' : 'off';
            },

        },

        methods: {
            ...mapActions([
                'getServiceBlocks',
                'setServiceBlocksStatus',
                'createServiceBlock',
                'deleteServiceBlock',
                'deleteServiceBlockChildElement',
                'addServiceBlockElement',
                'saveAllServiceBlockData'
            ]),

            async toggleActiveHandler(e) {
                const res = await this.setServiceBlocksStatus(e.target.value === 'on' ? 1 : 0);

                if (!res) {
                    this.toogleStatus = this.toogleStatus === 'on' ? 'off' : 'on'
                }
            },

            async deleteServiceBlockChildElementHandler(blockId) {
                const res = await this.deleteServiceBlockChildElement(blockId);
            },

            createHandler() {
                this.createServiceBlock(this.selectedServiceId);
            },

            deleteHandler() {
                this.deleteModalVisible = false;
                this.deleteServiceBlock();
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
            this.toogleStatus = this.isActive;
        },
        updated() {

        },
        mounted() {
            this.getServiceBlocks(this.selectedServiceId);
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
