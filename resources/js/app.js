/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import moment from 'moment';
import { Form, HasError, AlertError } from 'vform';
import Datepicker from 'vuejs-datepicker';
import VueProgressBar from 'vue-progressbar'

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.use(VueRouter);
Vue.use(VueProgressBar, {
    color: '#bffaf3',
  failedColor: '#874b4b',
  thickness: '20px',
  transition: {
    speed: '0.2s',
    opacity: '0s',
    termination: 300
  },
  autoRevert: true,
  location: 'top',
  inverse: false
})
window.form = Form;
window.Datepicker = Datepicker;

let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/users', component: require('./components/Users.vue').default }
  ]
  const router = new VueRouter({
      mode : 'history',
    routes // short for `routes: routes`
  })

  //==format text==\\
  Vue.filter('ucWords',function(text){
    return  text.charAt(0).toUpperCase() + text.slice(1);
  });
  Vue.filter('completedate',function(date){
      return moment(date).format('MMMM Do YYYY, h:mm:ss a');
  })
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    
});
