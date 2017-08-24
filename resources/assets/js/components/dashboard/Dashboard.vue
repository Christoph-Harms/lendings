<template>
    <div id="dashboard">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <user-card :user="user"></user-card>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <my-lendings :lendings="lendings" v-if="lendings.length > 0"></my-lendings>
                <p v-else>You have no current lendings.</p>
            </div>
        </div>
    </div>
</template>

<script>
    import UserCard from "../user/UserCard.vue"
    import MyLendings from "./MyLendings.vue"

    export default {
        components: {
            "user-card": UserCard,
            "my-lendings": MyLendings
        },
        props: [
            'user'
        ],
        data() {
            return {
                lendings: []
            }
        },
        created() {
            this.fetchLendings();
        },
        methods: {
            fetchLendings() {
                this.lendings = [
                    {
                        'item' : {
                            'name': "Great Item"
                        },
                        'created_at': '2017-07-01 12:00'
                    }
                ];
            }
        }
    }
</script>