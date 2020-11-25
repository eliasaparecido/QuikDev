import Vue from 'vue'
import Router from 'vue-router'
import ListFilm from '@/components/ListFilm'
import Details from '@/components/Details'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'ListFilm',
      component: ListFilm
    },
    {
      path: '/details/:id',
      name: 'Details',
      component: Details
    }
  ]
})
