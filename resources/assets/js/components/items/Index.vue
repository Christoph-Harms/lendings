<!--suppress JSUnusedGlobalSymbols -->
<template xmlns:v-tooltip="http://www.w3.org/1999/xhtml">
    <div class="row">
        <div v-show="loading" class="spinner center-block"></div>
        <div v-for="item in items" class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ item.name }}</div>
                <div class="panel-body">
                    More details for the item...
                </div>
                <div class="panel-footer clearfix">
                    <div class="btn-group pull-right" role="group" aria-label="Available actions">
                        <button
                                @click="lendItem(item.id)"
                                v-tooltip:top="$t('tooltips.lend_item')"
                                class="btn btn-primary"
                        >
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                        </button>
                        <button
                                v-show="isAdmin"
                                class="btn btn-danger"
                                v-tooltip:top="$t('tooltips.delete_item')"
                        >
                            <span class="glyphicon glyphicon-remove"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                items: [],
                loading: true,
            }
        },
        computed: {
            isAdmin () {
                return window.isAdmin;
            }
        },
        methods: {
            loadItems () {
                this.loading = true;
                axios.get('/api/items')
                    .then(function (response) {
                        console.log(response);
                        this.items = response.data;
                        this.loading = false;
                    }.bind(this))
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            lendItem (id) {
                console.log("Lending item with id " + id);
            },
        },
        mounted () {
            console.log('Items-index mounted.');
        },
        created () {
            console.log('Items-index created.');
            this.loadItems();
        }
    }
</script>