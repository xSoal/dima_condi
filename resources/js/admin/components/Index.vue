<template>
    <div>
        <component :is="layout">
            <transition name="fade">
                <router-view/>
            </transition>
        </component>
    </div>
</template>

<script>
    import LoginLayout from "../layouts/LoginLayout";
    import DashboardLayout from "../layouts/DashboardLayout";
    import Loader from "../reusable_components/Loader";
    import GlobalLoader from "../reusable_components/GlobalLoader";

    export default {
        name: "Index",
        components: {
            LoginLayout,
            DashboardLayout,
            GlobalLoader
        },
        data() {
            return {}
        },
        computed: {
            layout() {

                return (this.$route.meta.layout) + "-layout";
                // return (this.$route.meta.layout || 'login') + "-layout";
            },
        },
        mounted() {
            window._notification = this.$notification;
        }
    }
</script>

<style scoped>

</style>
