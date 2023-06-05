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
            name: 'signup',
            component: () =>
                import ('../views/signup.vue')
        },
        {
            path: '/home',
            name: 'homeView',
            component: () =>
                import ('../views/HomeView.vue')
        },
         {
            path: '/logout',
            name: 'logout',
            component: () =>
                import ('../views/login.vue')
        },
    ]
})

export default router