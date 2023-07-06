import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import AboutView from "../views/AboutView.vue";
import MenuView from "../views/MenuView.vue";
import cartPrduct from "../views/CartProduct.vue";
import productDetail from "../views/productDetail.vue";


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
    path: "/single-product/:id",
    name: "productdetail",
    component: productDetail,
  },
  {
    path: "/cart-product",
    name: "cartproduct",
    component: cartPrduct,
  },
],

});


export default router;