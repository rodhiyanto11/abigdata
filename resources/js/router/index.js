import Vue from 'vue'
import VueRouter from 'vue-router'

import item_index from '../components/Dashboard.vue';
import contact_index from '../components/Profile.vue';
import eav_index from '../components/Users.vue';
import eav_create from '../components/RolePages.vue';

Vue.use(VueRouter)

export default new VueRouter({
  mode: 'history',
  linkActiveClass: 'active',

  routes: [{
    path: '/items',
    component: item_index,
    name: 'item_index'
  }, {
    path: '/contact',
    component: eav_index ,
    name: 'contact_index' ,
    props: {entity_type_id: 1}
  }]
})
