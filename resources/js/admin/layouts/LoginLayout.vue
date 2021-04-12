<template>
    <div class="loginContainer">
        <router-view/>
    </div>
</template>

<script>
    export default {
        name: "login-layout",
        mounted() {
        },
        methods: {

        }
    }
</script>

<style scoped>

    .loginContainer {
        width: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #eaedf1;
    }



</style>
