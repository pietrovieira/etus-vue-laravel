import Vue from "vue";
import VueRouter from "vue-router";
import Home from "@/views/Home.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "home",
    component: Home
  },
  {
    path: "/dashboard",
    name: "dashboard",
    component: () => import("@/views/Dashboard.vue")
  },
  {
    path: "/detail/:id",
    name: "detail",
    component: () => import("@/views/Detail.vue")
  },
  {
    path: "/add-product",
    name: "add-product",
    component: () => import("@/views/FormProduct.vue")
  },
  {
    path: "/edit-product",
    name: "edit-product",
    component: () => import("@/views/FormProduct.vue")
  },
  {
    path: "/login",
    name: "login",
    component: () => import("@/views/Login.vue")
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
