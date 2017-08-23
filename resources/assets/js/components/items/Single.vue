<template xmlns:v-tooltip="http://www.w3.org/1999/xhtml">
    <div :class="panelClass">
        <div class="panel-body">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object" :src="item.img_url" :alt="item.name + '_image'">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{ item.name }}</h4>
                    <p>{{ item.description }}</p>
                </div>
            </div>
        </div>
        <div class="panel-footer clearfix">
            <div class="btn-group pull-right" role="group" aria-label="Available actions">
                <button
                        v-show="item.available"
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
</template>

<script>
    export default {
        props: [
            'item'
        ],
        computed: {
            isAdmin () {
                return window.isAdmin;
            },
            panelClass() {
                return [
                    'panel',
                    'panel-' + (this.item.available ? 'default' : 'danger')
                ]
            }
        },
        mounted() {
            console.log('Single item mounted.')
        }
    }
</script>

<style>
    .media-object {
        width: 128px;
        height: 128px;
    }
</style>