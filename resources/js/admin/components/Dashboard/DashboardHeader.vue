<template>
    <div class="dashboardHeader"
    >
        <div class="header">{{dashboardHeaderText}}</div>
    </div>
</template>

<script>
    import variables from "../../variables";

    export default {
        name: "DashboardHeader",
        props: ['dashboardHeaderText'],
        computed: {
            color() {
                return variables.mainColor;
            }
        }
    }
</script>

<style scoped>
    .dashboardHeader {
        width: 100%;
        height: 75px;
        padding: 15px;
        /*background-color: #4e8870;*/
        background: linear-gradient(170deg, #338851, #31883d);
        text-align: center;
    }
    .header {
        color: white;
        font-size: 1.4rem;
    }
</style>
