<template>
    <div>
        <div>Услуги</div>
        <div class="servicePages">
            <router-link
                v-for="s in serviceCategories"
                :key="`${s.id}__r`"
                :to="`/admin/pages/${s.id}`"
            >
                <div class="servicePage"
                     :key="s.id"
                     @click="selectCategoryHandler(s.id)"
                     :class=" +selectedCategoryId === +s.id ? 'chosen' : '' "
                >
                    {{s.category_name}}
                </div>
            </router-link>

        </div>
    </div>
</template>

<script>
    import {mapActions, mapState} from "vuex";

    export default {
        name: "Service__Categories",
        props: [
            'serviceCategories'
        ],
        data(){
            return {

            }
        },
        computed: {
            ...mapState({
                selectedCategoryId: state => state.pages.selectedCategoryId
            })
        },
        methods: {
            ...mapActions([
                'selectCategory'
            ]),
            selectCategoryHandler(id){
                this.selectCategory(id);
            }
        },
        mounted() {
            const categoryId = this.$route.params.id ?? null;
            if(categoryId){
                this.selectCategoryHandler(categoryId);
            }
        }
    }
</script>

<style scoped>

    .servicePages a {
        color: inherit;
        text-decoration: none;
    }

    .servicePages {
        display: flex;
        justify-content: flex-start;
        border-bottom: 1px solid #e7e7e7;
        padding: 10px;
        padding-bottom: 5px;
    }

    .servicePage {
        cursor: pointer;
        position: relative;
        padding-bottom: 10px;
        top:6px;
        border: 1px solid transparent;
        transition: .14s;

    }

    .servicePage:hover {
        border-bottom: 1px solid;
    }

    .servicePage.chosen {
        border-bottom: 1px solid;
    }

    .servicePages > a + a {
        margin-left: 25px;
    }


</style>
