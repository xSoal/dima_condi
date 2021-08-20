<template>
    <div>

        <div>
            Users
        </div>

        <div class="">
            <a-button
                type="primary"
                @click.native="addUserOpen = !addUserOpen"
            >
                Дбавить пользователя
                <a-icon type="add"/>
            </a-button>
        </div>

        <User__AddOrEdit
            v-if="addUserOpen"
            @close_add_user="addUserOpen = false"
            mode="add"
        />


        <Users__El
            v-for="user in users"
            :user="user"
            :key="user.id"
        />


    </div>
</template>

<script>

    import API from "../../../api";
    import {mapActions, mapState} from "vuex";
    import User__AddOrEdit  from './User__AddOrEdit'
    import Users__El from "./Users__El";



    export default {
        name: "Users",
        components: {
            Users__El,
            User__AddOrEdit
        },

        data(){
            return {
                localUsers : {},
                addUserOpen: false
            }
        },


        computed: {
            ...mapState('users',[
                'users'
            ])
        },

        methods: {
            ...mapActions('users',[
                'getUsers'
            ]),
        },
        mounted() {
            this.getUsers()

        }

    }
</script>

<style scoped>

</style>
