<template>
    <div class="dashboardLayout">
        <LeftMenu/>
        <div class="dashBoard__contentOverflow">
            <DashboardHeader
                v-if="dashboardHeaderText"
                :dashboardHeaderText="dashboardHeaderText"
            />
            <div class="dashboard__content">
                <router-view/>
            </div>
        </div>
    </div>
</template>

<script>
    // #4e8870
    import LeftMenu from "../components/Dashboard/LeftMenu";
    import DashboardHeader from "../components/Dashboard/DashboardHeader";


    export default {
        name: "login-layout",
        components: {
            LeftMenu,
            DashboardHeader
        },
        data() {
            return {
                dashboardHeaderText: this.$route.meta.dashboardHeaderText ?? false,
            }
        },
        mounted() {
            console.log(this.$API)
        },
        methods: {}
    }
</script>

<style scoped>

    .dashboardLayout {
        width: 100%;
        min-height: 100vh;
        /*display: flex;*/
        /*justify-content: center;*/
        /*align-items: center;*/
        background-color: #eaedf1;
    }

    .dashBoard__contentOverflow {
        width: 100%;
        padding-left: calc(120px);
    }

    .dashboard__content {
        width: 97%;
        margin: auto;
        position: relative;
        bottom: 15px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.24);
        border-radius: 5px;
        background-color: white;
        min-height: 50vh;
        padding: 25px;
    }


</style>
