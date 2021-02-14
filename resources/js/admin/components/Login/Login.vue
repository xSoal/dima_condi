<template>
    <div class="login form">
        <a-form-model :model="formData" @submit="handleSubmit" @submit.native.prevent>
            <a-form-model-item>
                <a-input v-model="formData.email" placeholder="Email" type="text">
                    <a-icon slot="prefix" type="user" style="color:rgba(0,0,0,.25)" />
                </a-input>
            </a-form-model-item>
            <a-form-model-item>
                <a-input v-model="formData.password" type="password" placeholder="Password">
                    <a-icon slot="prefix" type="lock" style="color:rgba(0,0,0,.25)" />
                </a-input>
            </a-form-model-item>
            <a-form-model-item>
                <a-button
                    type="primary"
                    html-type="submit"
                    :disabled=" formData.user === '' || formData.password === '' "
                >
                    Log in
                </a-button>
            </a-form-model-item>
        </a-form-model>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                formData: {
                    email: '',
                    password: '',
                },
            };
        },
        methods: {
            async handleSubmit(e) {
                const userData = await this.$API.tryAuth(this.formData.email, this.formData.password);
                if(userData.email){
                    // await this.$router.push({ name: 'dashboard' });
                    window.location.href = '/admin';
                } else {
                    this.$notification['error']({
                        message: 'Ошибка при авторизации'
                    });
                }
            },
        },
    }
</script>

<style scoped>

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

    .login {

    }


</style>
