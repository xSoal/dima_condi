<template>
    <div>

        <a-form-model class="formCont" :model="formData" @submit="handleSubmit" @submit.native.prevent>

                <div>
                    <a-checkbox
                        :checked="formData.is_main === 1"
                        @change="clickIsMain"
                    >
                        Главная страница
                    </a-checkbox>
                </div>


            <FormInput
                :error="errors.category_name"
                placeholder="Названия услуги"
                type="text"
                iconType="plus"
                v-model="formData.category_name"
                key="1"
            />
            <FormInput
                :error="errors.slug"
                placeholder="Ссылка"
                type="text"
                iconType="plus"
                v-model="formData.slug"
                key="2"
            />
            <FormInput
                :error="errors.title"
                placeholder="seo Title"
                type="text"
                iconType="plus"
                v-model="formData.title"
                key="3"
            />
            <FormInput
                :error="errors.description"
                placeholder="seo Description"
                type="text"
                iconType="plus"
                v-model="formData.description"
                key="4"
            />

<!--            <FormInput-->
<!--                :error="errors.text"-->
<!--                placeholder="Основной текст"-->
<!--                type="text"-->
<!--                iconType="plus"-->
<!--                v-model="formData.text"-->
<!--                key="5"-->
<!--            />-->
<!--            -->
            <div>
                <br>
                <p>Основной текст</p>
                <TextArea__Editor
                    :style="errors.text ? 'border: 1px solid red;' : '' "
                    v-model="formData.text"
                />
                <div >
                    <span v-if="errors.text"
                          style="color: red;"
                    >{{ errors.text.toString() }}</span>
                </div>
            </div>


            <a-form-model-item>
                <a-button
                    type="primary"
                    html-type="submit"
                    :disabled=" false "
                >
                    <a-icon type="save"/>
                </a-button>
            </a-form-model-item>
        </a-form-model>
    </div>
</template>

<script>
    import FormInput from "../../../../reusable_components/FormInput";
    import {mapActions, mapState} from "vuex";
    import TextArea__Editor from "../../../../reusable_components/TextArea__Editor";


    export default {
        name: "ServiceDetails__TabMain",
        components: {
            FormInput,
            TextArea__Editor
        },
        props: ['data'],
        data() {
            return {
                errors: {},
                formData: {
                    category_name: this.data.category_name,
                    slug: this.data.slug,
                    title: this.data.title,
                    description: this.data.description,
                    text: this.data.text,
                    is_main: this.data.is_main
                }
            }
        },
        computed: {
            // ...mapState({
            //     selectedServiceId: state => state.pages.selectedServiceId
            // }),
            // serviceData() {
            //
            //     let data = this.$store.state.pages.services.find(s => s.id === this.selectedServiceId);
            //
            //     console.log(' !! !  ! !')
            //
            //
            //     this.formData.category_name = data.category_name;
            //     this.formData.slug = data.slug;
            //     this.formData.title = data.title;
            //     this.formData.description = data.description;
            //     this.formData.text = data.text;
            //
            //     this.errors = {}
            //
            // }

        },
        methods: {
            ...mapActions([
                "updateService"
            ]),
            clickIsMain(e){
                this.formData.is_main = e.target.checked ? 1 : 0;
                this.handleSubmit();
            },
            async handleSubmit() {

                const request = await this.updateService(this.formData);

                if (request.error) {
                    this.errors = request.data.errors;

                } else {
                    this.errors = {};

                }

            }
        },
        watch: {
            data( newData ) {
                this.formData = newData;
                this.errors = {};
            }
        }
    }
</script>

<style scoped>

</style>
