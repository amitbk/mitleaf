/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
Vue.filter('formatDate', function(value) {
    if (value) {
      return moment(String(value)).format('DD MMM,YYYY hh:mm a')
    }
  });



Vue.component('plans-list', require('./components/Plans/PlansList.vue').default);
Vue.component('create-template', require('./components/Templates/CreateTemplate.vue').default);


Vue.component('firm-create', require('./components/Firms/FirmCreate.vue').default);
Vue.component('firm-edit-details', require('./components/Firms/FirmEditDetails.vue').default);
Vue.component('firm-frame', require('./components/Firms/FirmFrame.vue').default);

// widgets
Vue.component('image-preview', require('./components/widgets/ImagePreview.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: {

    }
});
