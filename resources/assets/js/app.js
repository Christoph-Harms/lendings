
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import VueI18n from 'vue-i18n';
import Locales from './vue-i18n-locales.generated';


Vue.use(VueI18n);

const i18n = new VueI18n({
    locale: 'de',
    messages: Locales,
});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('items-index', require('./components/items/Index.vue'));

Vue.directive('tooltip', {
    bind: function(el, binding){
        $(el).tooltip({
            title: binding.value,
            placement: binding.arg,
            trigger: 'hover',
            container: 'body',
        })
    }
});

const app = new Vue({
    i18n,
    el: '#app'
});
