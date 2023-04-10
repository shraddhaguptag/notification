import { createRouter, createWebHistory } from 'vue-router'

//Notification Pages
const CreateNotification = () => import("@/notification/CreateNotification.vue");
const ListNotification = () => import("@/notification/List.vue");
const EditNotification = () => import("@/notification/EditNotification.vue");

var myrouter = new createRouter({
  history: createWebHistory(import.meta.env.VITE_APP_PATH),
  routes: [
    {
      name: 'create',
      path: '/create',
      component: CreateNotification
    },
    {
      name: 'home',
      path: '/',
      component: ListNotification
    },
    {
      name: 'edit',
      path: '/edit/:id',
      component: EditNotification
  }
  ]
});

export default myrouter;
