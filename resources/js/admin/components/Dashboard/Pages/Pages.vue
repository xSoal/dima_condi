    <template>
        <div>
            <div>Услуги</div>
            <div class="servicePages">
                <div class="servicePage"
                    v-for="s in serviceCategories"
                     :key="s.id"
                     @click.prevent="selectCategory(s.id)"
                     :class="{'chosen' : selectedCategoryId === s.id}"
                >
                    {{s.category_name}}
                </div>
            </div>
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
        export default {
            name: "Pages",
            components: {
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

                selectCategory(id){
                    this.$store.state.pages.selectedCategoryId = id;;
                    this.getServicesOfCategory();
                }
            },
            mounted() {
                this.getPages();

            },
        }
    </script>

    <style>

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

        .servicePage  + .servicePage{

            margin-left: 25px;
        }
    </style>
