<template>
    <div class="leftMenu">
        <template v-for="page in pages">
            <router-link :to="page.to">
                <div class="page">

                    <div class="pageHrefCont">
                        <a-icon class="icon" :type="page.icon"/>
                        <span class="page_text">{{ page.text }}</span>
                    </div>
                </div>
            </router-link>
        </template>
    </div>
</template>

<script>
    export default {
        name: "LeftMenu",
        data() {
            return {
                pages: [
                    {
                        icon: "unordered-list",
                        text: 'страницы',
                        to: {
                            name: 'pages'
                        }
                    },
                    {
                        icon: "unordered-list",
                        text: 'главная',
                        to: {
                            name: 'dashboard'
                        }
                    },
                    {
                        icon: "unordered-list",
                        text: 'файлы',
                        to: {
                            name: 'files'
                        }
                    },
                    {
                        icon: "unordered-list",
                        text: 'фичи',
                        to: {
                            name: 'features'
                        }
                    },
                    {
                        icon: "unordered-list",
                        text: 'users',
                        to: {
                            name: 'users'
                        }
                    }
                ]
            }
        }
    }
</script>

<style scoped>
    .leftMenu {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 120px;
        height: 100vh;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.24);
        /*display: flex;*/
        /*justify-content: center;*/
        /*flex-wrap: wrap;*/
        /*align-items: flex-start;*/
        background-color: white;
    }

    .router-link-exact-active .page {
        background-color: #4e8870;
        color: white;
    }

    .page {
        width: 100%;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        padding: 7px 10px;

    }

    .page  {
        padding: 5px auto;
        transition: .25s;
        cursor: pointer;
    }

    .page:hover  {
        background-color: #4e8870;
        color: white;
    }

    a {
        color: #444;
    }

    .page i {
        color: #4e8870;
    }

    .page_text {
        padding-left: 5px;
    }

    .pageHrefCont {
        display: flex;
        width: 100%;
        justify-content: flex-start;
    }

</style>
