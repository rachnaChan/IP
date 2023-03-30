import { createRouter, createWebHistory } from 'vue-router'
import Login from "../views/Login.vue"
import Register from "../views/Register.vue"

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    
    {
      path: '/',
      name: 'home',
      component: Login
    },

    {
      path: '/about',
      name: 'about',
      component: Register
    },
    
   
  ]
})

export default router