<template>
    <div class="user__cont">
        <div
            class="user__header"
            :class="isShow ? 'active' : ''"
            @click="isShow = !isShow"
        >
            {{ user.name }}
        </div>

        <User__AddOrEdit
            v-if="isShow"
            :userProps="user"
            mode="edit"
        />


    </div>
</template>

<script>

    import {mapActions} from "vuex";
    import User__AddOrEdit from "./User__AddOrEdit";

    export default {
        name: "Users__El",
        props: ['user'],
        components: {
            User__AddOrEdit
        },
        data(){
            return {
                isShow: false,
            }
        },
        methods: {
            ...mapActions('users', [
                'deleteUser',
                'editUser'
            ])
        }
    }
</script>

<style scoped>
    .user__cont {
        margin-top: 5px;
    }

    .user__header {
        padding: 10px 15px;
        text-align: center;
        border-radius: 4px;
        font-size: 1.15rem;
        cursor: pointer;
        user-select: none;
    }
    .user__header.active {
        background-color: green;

    }
</style>
