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
                <p v-else-if="loading">Loading...</p>
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
                lendings: [],
                loading: true
            }
        },
        created() {
            this.fetchLendings();
        },
        methods: {
            fetchLendings() {
                axios.get('/api/lendings')
                    .then(function(response) {
                        this.lendings = response.data;
                        this.loading = false;
                    }.bind(this))
                    .catch(function (error) {
                        this.loading=false;
                        console.log(error);
                    });
            }
        }
    }
</script>