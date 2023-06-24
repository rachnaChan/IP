import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import AboutView from "../views/AboutView.vue";
import MenuView from "../views/MenuView.vue";
import cake from "../views/cake.vue";
import cookie from "../views/cookie.vue";
import cupcake from "../views/cupcake.vue";
import donut from "../views/donut.vue";
import drink from "../views/drink.vue";
import gummy from "../views/gummy.vue";
import cakes from "../views/cakes.vue";
import cookies from "../views/cookies.vue";
import cupcakes from "../views/cupcakes.vue";
import donuts from "../views/donuts.vue";
import drinks from "../views/drinks.vue";
import gummies from "../views/gummies.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },

    {
      path: "/about",
      name: "about",
      component: AboutView,
    },

    {
      path: "/menu",
      name: "menu",
      component: MenuView,
    },
    {
      path: "/cake",
      name: "cake",
      component: cake,
    },
    {
      path: "/cookie",
      name: "cookie",
      component: cookie,
    },
    {
      path: "/donut",
      name: "donut",
      component: donut,
    },
    {
      path: "/drink",
      name: "drink",
      component: drink,
    },
    {
      path: "/gummy",
      name: "gummy",
      component: gummy,
    },
    {
      path: "/cupcake",
      name: "cupcake",
      component: cupcake,
    },

    {
      path: "/cakes",
      name: "cakes",
      component: cakes,
    },
    {
      path: "/cookies",
      name: "cookies",
      component: cookies,
    },
    {
      path: "/donuts",
      name: "donuts",
      component: donuts,
    },
    {
      path: "/drinks",
      name: "drinks",
      component: drinks,
    },
    {
      path: "/gummies",
      name: "gummies",
      component: gummies,
    },
    {
      path: "/cupcakes",
      name: "cupcakes",
      component: cupcakes,
    },
  ],
});


export default router;
