import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'

import MarketCap from '@/components/MarketCap'
import Ui from '@/components/Ui'
Vue.use(Router)



export default new Router({
 
    mode: 'history',
    

  routes: [
    {
      path: '/',
      name: 'Hello',
      component: Hello
    } ,
      {
      path: '/MarketCap',
      name: 'MarketCap',
      component: MarketCap
    } ,
       {
      path: '/Ui',
      name: 'Ui',
      component: Ui
    } 

    ] 
} )
