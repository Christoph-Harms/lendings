<!--suppress JSUnusedGlobalSymbols -->
<template xmlns:v-tooltip="http://www.w3.org/1999/xhtml">
    <div class="row">
        <div v-show="loading" class="spinner center-block"></div>
        <div v-for="item in items" class="col-md-8 col-md-offset-2">
            <items-single :item="item"></items-single>
        </div>

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
    import SingleItem from "./Single.vue"
    export default {
        components: {
             "items-single": SingleItem
        },
        data () {
            return {
                items: [],
                loading: true,
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
            console.log('Items-index mounted, Bro.');
        },
        created () {
            console.log('Items-index created.');
            this.loadItems();
        }
    }
</script>