<template>
    <div class="dashboardHeader"
    >
        <div class="header"
             ref="header"
        >
            <span>{{dashboardHeaderText}}</span>
            <GlobalLoader
                v-if="globalLoading"
            />
        </div>

    </div>
</template>

<script>
    import variables from "../../variables";
    import GlobalLoader from "../../reusable_components/GlobalLoader";
    import {mapState} from "vuex";

    export default {
        name: "DashboardHeader",
        props: ['dashboardHeaderText'],
        components: {
            GlobalLoader
        },
        data(){
            return {
                listenerScroll: null,
                loopInterval: null
            }
        },
        computed: {
            ...mapState({
                globalLoading: state => state.globalLoading
            }),
            color() {
                return variables.mainColor;
            }
        },
        mounted() {
            let timer = 0;

            this.loopInterval = setInterval(()=>{
                timer = 1;
            }, 25);

            this.listenerScroll = window.addEventListener('scroll', (e)=>{
                if(timer === 1){
                    this.$refs.header.style.top = window.pageYOffset + 'px';
                    timer = 0;
                }

            });
        },
        beforeDestroy() {
            window.removeEventListener('scroll', this.listenerScroll);
            window.clearInterval(this.loopInterval);
        }
    }
</script>

<style>
    .dashboardHeader {
        width: 100%;
        height: 75px;
        padding-bottom: 15px;
        /*background-color: #4e8870;*/
        background: linear-gradient(170deg, #338851, #31883d);
        text-align: center;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .header {
        color: white;
        font-size: 1.4rem;
        position: relative;
        top: 0;
        transition: top .25s;
        background: linear-gradient(170deg, #338851, #31883d);
        z-index: 5;
        padding: 5px 15px;
        border-radius: 10px;
    }

    .header > * {
        margin: auto 5px;
    }

    .header span {

    }

</style>
