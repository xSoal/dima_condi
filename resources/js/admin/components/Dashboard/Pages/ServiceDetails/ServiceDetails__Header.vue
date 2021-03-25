<template>
    <div>
        <a-page-header
            style="border: 1px solid rgb(235, 237, 240)"
            :title="data.category_name"

        >
<!--            <template slot="extra">-->
<!--                <a-button key="3">-->
<!--                    Operation-->
<!--                </a-button>-->
<!--                <a-button key="2">-->
<!--                    Operation-->
<!--                </a-button>-->
<!--                <a-button key="1" type="primary">-->
<!--                    Primary-->
<!--                </a-button>-->
<!--            </template>-->



            <div class="content">
                <div class="main">
                    <a-descriptions size="small" :column="3">
                        <a-descriptions-item label="Link">
                            <a :href="getLink(data.slug)" target="_blank">{{ getLink(data.slug) }}</a>
                        </a-descriptions-item>
                        <a-descriptions-item label="Создано">
                            {{data.created_at}}
                        </a-descriptions-item>
                        <a-descriptions-item label="Изменено">
                            {{data.updated_at}}
                        </a-descriptions-item>
                    </a-descriptions>
                </div>

            </div>
        </a-page-header>
    </div>
</template>

<script>

    export default {
        name: "ServiceDetails__Header",
        components: {

        },
        props: ['data'],
        methods: {
            getLink(link){
                return window.location.origin + "/" + link;
            }
        }
    }
</script>

<style scoped>

</style>
