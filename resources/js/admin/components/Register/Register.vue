<template>
    <div class="login form">
        <a-form-model :model="form" @submit="handleSubmit" @submit.native.prevent>
            <div class="errors">
                <div v-for="error in errors">
                    {{ error }}
                </div>
            </div>
            <a-form-model-item>
                <a-input v-model="form.login" placeholder="Login" autocomplete="off">
                    <a-icon slot="prefix" type="user" style="color:rgba(0,0,0,.25)" />
                </a-input>
            </a-form-model-item>
            <a-form-model-item>
                <a-input v-model="form.password" type="password" placeholder="Password">
                    <a-icon slot="prefix" type="lock" style="color:rgba(0,0,0,.25)" />
                </a-input>
            </a-form-model-item>
            <a-form-model-item>
                <a-input v-model="form.passwordConfirm" placeholder="Password Confirm">
                    <a-icon slot="prefix" type="lock" style="color:rgba(0,0,0,.25)" />
                </a-input>
            </a-form-model-item>
            <a-form-model-item>
                <a-button
                    type="primary"
                    html-type="submit"
                >
                    Log in
                </a-button>
            </a-form-model-item>
        </a-form-model>
    </div>
</template>

<script>


    export default {
        name: "Register",
        data() {
            return {
                errors: [],
                form: {
                    login: '',
                    password: '',
                    passwordConfirm: ''
                },
            };
        },
        methods: {
            handleSubmit(e) {
                this.errors = [];

                if(!this.form.login){
                    this.errors.push("Укажите пользователя");
                }

                if( !this.form.password || !this.form.passwordConfirm ){
                    this.errors.push('Пустой пароль или подтверждение');
                }

                if( this.form.password !== this.form.passwordConfirm ){
                    this.errors.push('Не совпадает пароль');
                }


                if( this.errors.length === 0 ){
                    const {
                        login,
                        password
                    } = this.form;

                    axios.post('/api/register', {
                        login,
                        password
                    }).then( response => console.log( response ) );

                }


            },
        },
    }

</script>

<style scoped>

    .errors {

    }

    .form {
        min-height: 500px;
        min-width: 500px;
        border: 1px solid white;
        border-radius: 4px;
        box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.15);
        padding: 45px;
        background-color: white;

        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
