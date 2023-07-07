import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import AboutView from "../views/AboutView.vue";
import MenuView from "../views/MenuView.vue";
import cartProduct from "../views/cartProduct.vue";
import productDetail from "../views/productDetail.vue";
import viewCartProduct from "../views/viewCartProduct.vue";


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
    path: "/menu/:id",
    name: "productdetail",
    component: productDetail,
  },
  {
    path: "/cartproduct",
    name: "cartproduct",
    component: cartProduct,
  },
  {
    path: "/viewcartproduct",
    name: "viewcartproduct",
    component: viewCartProduct,
  },

],

});


export default router;
