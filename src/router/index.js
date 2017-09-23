import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import Hello2 from '@/components/Hello2'
import Hello3 from '@/components/Hello3'
import MarketCap from '@/components/MarketCap'
import Ui from '@/components/Ui'
Vue.use(Router)



export default new Router({
  routes: [
    {
      path: '/Hello',
      name: 'Hello',
      component: Hello
    } ,
      {
      path: '/Hello2',
      name: 'Hello2',
      component: Hello2
    },
     {
      path: '/',
      name: 'Hello3',
      component: Hello3
    },
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
})
