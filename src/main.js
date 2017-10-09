// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

import VueResource from 'vue-resource';
import Vue2Filters from 'vue2-filters'

import VueFire from 'vuefire'
import Firebase from 'firebase'


// explicit installation required in module environments
Vue.use(VueFire)





Vue.use(Vue2Filters) ;
Vue.use(VueResource);
Vue.config.productionTip = false

Vue.filter('dob', function (value) {
    if (value == null) {
    	return '' 
    }
    else {   
     var today = new Date();
    var birthDate = new Date(value);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
		}
})



/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
