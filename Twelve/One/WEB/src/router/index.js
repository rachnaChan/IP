import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    history: createWebHistory(
        import.meta.env.BASE_URL),
    routes: [{
            path: '/',
            name: 'login',
            component: () =>
                import ('../views/login.vue')
        },
        {
            path: '/register',
            name: 'register',
            component: () =>
                import ('../views/signup.vue')
        },
        {
            path: '/home',
            name: 'homeform',
            component: () =>
                import ('../views/home.vue')
        },
         {
            path: '/logout',
            name: 'logout',
            component: () =>
                import ('../views/login.vue')
        },
        //  {
        //     path: '/product',
        //     name: 'product',
        //     component: () =>
        //         import ('../views/categories/homePage.vue')
        // },

        {
            path: '/product',
            name: 'product',
            component: () =>
                import ('../views/Item-all/card-product.vue')
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: () =>
            import ('../views/admin/aDashboard.vue')
        },
        {
            path: '/categories',
            name: 'categories',
            component: () =>
            import ('../views/Item-all/card.vue') 
        },
        {
            path: '/items',
            name: 'items',
            component: () =>
            import ('../views/Item-all/card-item.vue') 
        },
        {
            path: '/products',
            name: 'products',
            component: () =>
            import ('../views/Item-all/HomePage.vue') 
        }
        
    ]
})

export default router