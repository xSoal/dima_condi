<template>
    <div>
        <component :is="layout">
            <transition name="fade"  >
                <router-view />
            </transition>
        </component>
    </div>
</template>

<script>
    import LoginLayout from "../layouts/LoginLayout";
    import DashboardLayout from "../layouts/DashboardLayout";
    export default {
        name: "Index",
        components: {
            LoginLayout,
            DashboardLayout
        },
        data(){
            return {

            }
        },
        computed: {
            layout(){

                return (this.$route.meta.layout ) + "-layout";
                // return (this.$route.meta.layout || 'login') + "-layout";
            },
        }
    }
</script>

<style scoped>

</style>
