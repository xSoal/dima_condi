    <template>
        <div>
            <Service__Categories
                :serviceCategories="serviceCategories"
            />
            <addServiceBlock
                :selectedCategoryId="selectedCategoryId"
                v-if="selectedCategoryId"
            />
            <div class="services" >
                <Services v-if="services.length" />
            </div>
        </div>
    </template>

    <script>
        import {mapActions, mapState} from 'vuex';
        import addServiceBlock from "./addServiceBlock";
        import Services from './Services';
        import Service__Categories from "./Service__Categories";
        export default {
            name: "Pages",
            components: {
                Service__Categories,
                addServiceBlock,
                Services
            },
            data() {
                return {

                }
            },
            computed: {
                ...mapState({
                    serviceCategories: state => state.pages.serviceCategories,
                    services: state => state.pages.services,
                    selectedCategoryId: state => state.pages.selectedCategoryId
                })
            },
            methods: {
                async getPages() {
                    //const pagesData = await this.$API.get('/test');
                    const pagesData = await this.getServiceCategories();

                },
                ...mapActions([
                    'getServiceCategories',
                    'getServicesOfCategory'
                ]),

            },
            mounted() {
                this.getPages();

            },
        }
    </script>

    <style>


    </style>
