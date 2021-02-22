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

// uuid
import UUID from "vue-uuid";
Vue.use(UUID);

// BootstrapVue
import { BootstrapVue } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)

// sweetalert2
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);
// window.Vue.swal = in other files can be used like this

Vue.component('admin', require('./components/Admin.vue').default);
Vue.component('plans-list', require('./components/Plans/PlansList.vue').default);
Vue.component('create-template', require('./components/Templates/CreateTemplate.vue').default);
Vue.component('payment-capture', require('./components/PaymentCapture.vue').default);

// Home
Vue.component('posts', require('./components/Home/Posts.vue').default);
Vue.component('post', require('./components/Home/Post.vue').default);
Vue.component('post-create', require('./components/Posts/Create.vue').default);


Vue.component('firm-create', require('./components/Firms/FirmCreate.vue').default);
Vue.component('firm-edit-details', require('./components/Firms/FirmEditDetails.vue').default);
Vue.component('firm-post', require('./components/Firms/FirmPost.vue').default);

// widgets
Vue.component('image-preview', require('./components/widgets/ImagePreview.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import planServices from "./services/plans";
import postObj from "./obj/post";

const app = new Vue({
    el: '#app',
    data() {
      return {
        mitleaf: {},
        selectedFirmId: 0,
        isToggeled: false,
        url: null,

        templates: [],

        post: { ...postObj }
      }
    },
    components: {

    },
    methods: {
      toggleSidebar() {
        this.isToggeled = !this.isToggeled
      },
      setActiveMenu() {
        var url = window.location;
        const allLinks = document.querySelectorAll('.check-active-link a, .nav-item a');
        const currentLink = [...allLinks].filter(e => {
        return e.href == url;
        });
        if(!!currentLink[0])
          currentLink[0].classList.add("active")
        // currentLink[0].closest(".nav-treeview").style.display="block";
        // currentLink[0].closest(".has-treeview").classList.add("active");
      },
    },

    mounted() {
      this.setActiveMenu();

      planServices.getPlans().then(r => {
        this.mitleaf = r.data;
        this.selectedFirmId = this.mitleaf.firms[0].id;
      })
    }
});
