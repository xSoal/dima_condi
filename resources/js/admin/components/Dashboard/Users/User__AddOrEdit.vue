<template>
    <div>

        <FormInput
            placeholder="Логин"
            type="text"
            iconType="plus"
            v-model="user.name"
            :error="errors.name"
        />

        <FormInput
            placeholder="Email"
            type="text"
            iconType="plus"
            v-model="user.email"
            :error="errors.email"
        />

        <FormInput
            placeholder="Пароль"
            type="text"
            iconType="plus"
            v-model="user.password"
            :error="errors.password"
        />

        <FormInput
            placeholder="Прдтверждение пароля"
            type="text"
            iconType="plus"
            v-model="user.password_confirm"
            :error="errors.password_confirm"
        />


        <a-button
            type="primary"
            @click.native="submit"
        >
            Сохранить
            <a-icon type="add"/>
        </a-button>

    </div>
</template>

<script>
    import {mapActions} from "vuex";
    import FormInput from "../../../reusable_components/FormInput";


    export default {
        name: "User__Add",
        components: {
            FormInput
        },
        props: [
            "mode", "userProps"
        ],
        data() {

            return {
                user: {
                    id: this.userProps?.id ?? null,
                    name: this.userProps?.name ?? '',
                    email: this.userProps?.email ?? '',
                    password: '',
                    password_conform: ''
                },
                errors: {}
            }
        },

        methods: {
            ...mapActions('users', [
                'addUser', 'editUser'
            ]),
            validateEmail(email) {
                const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            },

            validateForm() {
                this.errors = {};


                if (!this.user || !this.email || !this.password || !this.password_confirm) {
                    for (const [key, value] of Object.entries(this.user)) {
                        if (!value) {
                            this.errors[key] = true;
                        }
                    }
                }

                if (this.user.password !== this.user.password_confirm) {
                    this.errors.password_confirm = 'Не совпадает пароль';
                }

                return Object.keys(this.errors).length === 0;
            },
            async submit() {

                if (!this.validateForm()) return;


                if (this.mode === 'add') {
                    const res = await this.addUser(this.user);

                    if (res) {
                        this.$emit('close_add_user')
                    }

                }
                console.log(this.mode, '!PJ @ KLJAJS:KLASJDK')
                if (this.mode === 'edit') {
                    alert('edit')
                }

            }
        }
    }
</script>

<style scoped>

</style>
