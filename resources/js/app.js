/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap';
import { createApp } from 'vue';
import CKEditor from '@ckeditor/ckeditor5-vue'; 
//Routes
import myrouter from './router';

//Notification
import Notification from './notification/Notification.vue';
import NotificationTest from './notification/NotificationTest.vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = createApp(Notification)
app.component('NotificationTest', NotificationTest);
app
    .use(myrouter)
    .use(CKEditor)
    .mount("#app")
