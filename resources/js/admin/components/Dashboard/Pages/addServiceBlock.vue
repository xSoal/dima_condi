<template>

    <div class="services__addBlock">
        <div class="services__icon" @click.prevent="show = !show">
            <a-button type="primary" shape="circle" icon="plus" />
        </div>
        <transition name="slide-fade">
            <div class="services__form" v-if="show">
                <a-form-model class="formCont" :model="formData" @submit="handleSubmit" @submit.native.prevent>
                    <a-form-model-item
                        :validate-status="errors.name ? 'error' : '' "
                        :help="errors.name"
                    >
                        <a-input v-model="formData.name" placeholder="Название услуги" type="text">
                            <a-icon slot="prefix" type="plus" style="color:rgba(0,0,0,.25)"
                                    validate-status="error"
                            />
                        </a-input>
                    </a-form-model-item>
                    <a-form-model-item
                        :validate-status="errors.slug ? 'error' : '' "
                        :help="errors.slug"
                    >
                        <a-input v-model="formData.slug" placeholder="Ссылка" type="text">
                            <a-icon slot="prefix" type="plus" style="color:rgba(0,0,0,.25)" />
                        </a-input>
                    </a-form-model-item>
                    <a-form-model-item>
                        <a-button
                            type="primary"
                            html-type="submit"
                            :disabled=" false "
                        >
                            <a-icon type="plus" />
                        </a-button>
                    </a-form-model-item>
                </a-form-model>
            </div>
        </transition>


    </div>
</template>

<script>
    import {mapActions} from 'vuex';
    export default {
        name: "addServiceBlock",
        props: [
            "selectedCategoryId"
        ],
        data(){
            return {
                show: false,
                formData: {
                    name: '',
                    slug: ''
                },
                errors: {

                }
            }
        },
        methods: {
            ...mapActions([
                'addService'
            ]),
            async handleSubmit(){
                const request = await this.addService({
                    catId: this.selectedCategoryId,
                    name: this.formData.name,
                    slug: this.formData.slug
                });

                if( request.error ){

                    this.errors = request.data.errors;

                    this.$notification['error']({
                        message: request.data.message ?? 'Ошибка'
                    });
                } else {
                    this.formData.name = '';
                    this.formData.slug = '';
                }

            }
        }
    }
</script>

<style >



    .services__addBlock {
        margin: 15px 0;
    }

    .services__form {
        margin-top: 15px;
    }

    .formCont {
        /*display: flex;*/
    }



    .ant-form-item {

    }

    .slide-fade-enter-active {
        transition: all .3s ease-in;
    }
    .slide-fade-leave-active {
        transition: all .3s ease-in;
    }
    .slide-fade-enter, .slide-fade-leave-to {
        transform: translateX(-50px);
        opacity: 0;
    }

</style>
