import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import Hello2 from '@/components/Hello2'
import MarketCap from '@/components/MarketCap'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/Hello',
      name: 'Hello',
      component: Hello
    } ,
      {
      path: '/',
      name: 'Hello2',
      component: Hello2
    },
      {
      path: '/MarketCap',
      name: 'MarketCap',
      component: MarketCap
    }

  ]
})
