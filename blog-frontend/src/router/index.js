import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Login from '../views/Login.vue'
import Register from "../views/Register.vue";
import RegisterNew from "../views/User/RegisterNew.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    // {
    //   path: '/register',
    //   name: 'register',
    //   component: Register
    // },
    {
      path: '/register',
      name: 'register',
      component: RegisterNew
    }
  ]
})

export default router
