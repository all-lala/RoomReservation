import Vue from 'vue';
import VueRouter, { RouteConfig } from 'vue-router';
import Home from '@/views/Home.vue';
declare var BASE_URL: any;

Vue.use(VueRouter)

const routes: Array<RouteConfig> = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/about',
    name: 'About',
    component: () => import(/* webpackChunkName: "about" */ '@/views/About.vue')
  },
  {
    path: '/booking',
    name: 'Booking',
    component: () => import('@/views/Booking.vue')
  },
  {
    path: '/rooms',
    name: 'Rooms',
    component: () => import('@/views/Room/Rooms.vue')
  },
  {
    path: '/room/:id/:action',
    name: 'Room',
    component: () => import('@/views/Room/Room.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: BASE_URL,
  routes
})

export default router
