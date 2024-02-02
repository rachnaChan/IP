import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router";
import Homepage from "../views/Homepage.vue";
import Bookpage from "../views/Bookpage.vue";
import eventPage from "../views/event.vue";
import aboutPage from "../views/aboutUs.vue";
import contactPage from "../views/contactUs.vue";
import Bookdetail from "../views/Bookdetail.vue";
import AdminDashboard from "../views/admins/dashboard.vue";
import AdminCrudBooks from "../views/admins/crudBooks.vue";
import AdminCrudEvents from "../views/admins/crudEvents.vue";
import AdminCrudStaff from "../views/admins/crudStaff.vue";
import Login from "../views/login.vue";
import Unauthorized from "../views/UnauthorizedView.vue";
import listBook from "../views/listBook.vue";
//import listArrivalBook from "../views/arrivalBook.vue";
import store from "../store";


const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'home',
    component: Homepage,
    // component: Bookpage,
  },
  {
    path: '/book',
    name: 'book',
    component: Bookpage,
  },
  {
    path: '/book_information/:id',
    name: 'book_information',
    component: Bookdetail,
  },
  {
    path: '/book_all',
    name: 'book_all',
    component: listBook,
  },

  // {
  //     path: '/book_arrival',
  //     name: 'book_arrival',
  //     component: listArrivalBook,
  // },
  {
    path: '/event',
    name: 'event',
    component: eventPage,
  },
  {
    path: '/about',
    name: 'about',
    component: aboutPage,
  },
  {
    path: '/contact',
    name: 'contact',
    component: contactPage,
  },
  {
    path: '/admin/dashboard',
    name: 'adminDashboard',
    component: AdminDashboard,
    meta: { requiresAuth: true, role: "Admin" },

  },

  {
    path: '/admin/crudBooks',
    name: 'crudBooks',
    component: AdminCrudBooks,
    meta: { requiresAuth: true, role: "Admin" },

  },
  {
    path: '/admin/crudEvents',
    name: 'crudEvents',
    component: AdminCrudEvents,
    meta: { requiresAuth: true, role: "Admin" },

  },
  {
    path: '/admin/crudStaff',
    name: 'crudStaff',
    component: AdminCrudStaff,
    meta: { requiresAuth: true, role: "Admin" },

  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: { ensureLogout: true },
  },
  {
    path: '/unauthorized',
    name: 'unauthorized',
    component: Unauthorized,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});


router.beforeEach((to, from, next) => {
  // Check if the route requires authentication
  const requiresAuth = to.meta.requiresAuth;

  // Check if the user is authenticated by looking for the token in local storage
  const isAuthenticated = store.state.token;

  //to ensure that user is already logout in order to login or register
  const ensureLogout = to.matched.some((record) => record.meta.ensureLogout);

  //get role from vuex, so only certain user can go to certain route
  var roles = store.state.role;

  console.log(roles);
  console.log(requiresAuth);

  // check if they have already login, so they cannot go to login, register route
  if (isAuthenticated && ensureLogout) {
    alert("you have already logged in");
    next("/");
  }

  //check if the route require login or not and if user has login yet, if not it will route to login page
  if (requiresAuth && !isAuthenticated) {
    alert("you must log in first to continue!!!");
    // If the route requires authentication and the user is not authenticated, redirect to the login page
    next("/login");
  }
  // check if the route require login or not and if our user have what role
  else if (requiresAuth && roles != null) {
    const allowedRoles = to.meta.role;

    // if their role match with their the required of the route, they can access the page, otherwise it will route to unauthorized page
    if (allowedRoles && allowedRoles.includes(roles)) {
      next();
    } else {
      alert(
        "As " +
        roles +
        ", you do not have authorized for the page to this route"
      );
      next("/unauthorized");
    }
  } else {
    next();
  }
});

export default router;