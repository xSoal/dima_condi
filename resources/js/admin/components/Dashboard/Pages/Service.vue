<template>
    <div class="service">
        <div class="service__name">{{ data.category_name }}</div>
        <div class="service__delete" @click.prevent="deleteServiceHandler">
            <a-icon type="delete" />
        </div>

        <a-modal
            title="Подтверждение удаления"
            :visible="deleteModalVisible"
            :confirm-loading="deleteModalLoading"
            @ok="deleteOk"
            @cancel="deleteCancel"
        >
            <p> Напрочь удалить услугу <b>{{ data.category_name }}</b> с сайта? Точно??? </p>
        </a-modal>

    </div>
</template>

<script>
    import { mapActions } from 'vuex';
    export default {
        name: "Service",
        props: ['data'],
        data(){
            return {
                deleteModalVisible : false,
                deleteModalLoading: false
            }
        },
        methods: {
            ...mapActions([
                'deleteService'
            ]),
            deleteServiceHandler(){
                this.deleteModalVisible = true;
            },
            async deleteOk(){
                this.deleteModalLoading = true;
                const req = await this.deleteService(this.data.id);

            },
            deleteCancel(){
                this.deleteModalVisible = false;
            }
        }
    }
</script>

<style scoped>
    .service {
        flex: 1;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding-right: 35px;
        background-color: rgba(231, 231, 231, 0.15);
        border: 1px solid rgba(51, 136, 81, 0.15);
        margin: 5px;
        min-width: 150px;
        cursor: pointer;
    }

    .service:hover {
        border-color: #999;
    }


    .service__delete {
        position: absolute;
        top: 0;
        bottom: 3px;
        right: 7px;
        margin: auto;
        display: flex;
        align-items: center;
        font-size: 0.9rem;
    }

    .service__delete:hover i {
        color: #4e8870;

    }

    .service-active {
        border-color: #999;
    }
</style>
