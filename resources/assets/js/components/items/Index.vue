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
        <span
                id="fetch-failed"
                data-toggle="popover"
                :data-title="$t('items.popover.fetching_failed_title')"
                :data-content="$t('items.popover.fetching_failed_content')"
        />

        <!-- failModal -->
        <div class="modal fade" id="failModal" tabindex="-1" role="dialog" aria-labelledby="errorMessage">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="errorMessageTitle">{{ $t('items.popover.fetch_failed_title') }}</h4>
                    </div>
                    <div class="modal-body">
                        <p>{{ $t('items.popover.fetch_failed_content') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ $t('generic.close') }}</button>
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
                        this.items = response.data;
                        this.loading = false;
                    }.bind(this))
                    .catch(function (error) {
                        console.log(error);
                         $('#failModal').modal('show');

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