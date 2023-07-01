import { createRouter, createWebHistory } from 'vue-router'

import authBack from '@/method/libs/auth'
import login from '../views/login.vue'
import homeViews from '../views/homeV.vue'
import dashboard from '../views/dashboard/Dashboard.vue'
import category from '../views/dashboard/display/category.vue'
import item from '../views/dashboard/display/item.vue'
import product from '../views/dashboard/display/product.vue'


const router = createRouter({
    history: createWebHistory(
        import.meta.env.BASE_URL),
    routes: [{
            path: '/login',
            name: 'auth/login',
            // component: () =>
            //     import ('../views/login.vue')
            component: login
        },
        {
            path: '/register',
            name: 'auth/register',
            component: () =>
                import ('../views/signup.vue')
        },
        {
            path: '/',
            name: 'home',
            // component: () =>
            //     import ('../views/homeV.vue')
            component: homeViews
        },
         {
            path: '/logout',
            name: 'logout',
            component: () =>
                import ('../views/login.vue')
        },

        {
            path: '/dashboard',
            name: 'dashboard',
            component: dashboard,
            children: [
              {
                path: 'category',
                name: 'dashboard/category',
                component: category
              },
              {
                path: 'item',
                name: 'dashboard/item',
                component: item,
              },
              {
                path: 'product',
                name: 'dashboard/product',
                component: product,
              },
            ],
          },
        //  {
        //     path: '/product',
        //     name: 'product',
        //     component: () =>
        //         import ('../views/categories/homePage.vue')
        // },

        // {
        //     path: '/product',
        //     name: 'product',
        //     component: () =>
        //         import ('../views/Item-all/card-product.vue')
        // },
        // {
        //     path: '/dashboard',
        //     name: 'dashboard',
        //     component: () =>
        //     import ('../views/admin/aDashboard.vue')
        // },
        // {
        //     path: '/categories',
        //     name: 'categories',
        //     component: () =>
        //     import ('../views/Item-all/card.vue') 
        // },
        // {
        //     path: '/items',
        //     name: 'items',
        //     component: () =>
        //     import ('../views/Item-all/card-item.vue') 
        // },
        // {
        //     path: '/products',
        //     name: 'products',
        //     component: () =>
        //     import ('../views/Item-all/HomePage.vue') 
        // }
        
    ]
})

router.beforeEach(async (to, from, next) => {
  const me = await authBack.getMe();
  const isAuthenticated = !!me
  if (to.name.includes('dashboard') && !isAuthenticated) next({ name: 'auth/login' })
  if (to.name.includes('auth') && isAuthenticated) next({ name: 'dashboard' })
  else next()
})
export default router