import './bootstrap';

import { createApp } from 'vue';
import router from "./router";
import { createPinia } from 'pinia'
import app from "./app.vue";

import { createBootstrap } from 'bootstrap-vue-next'

// Add the necessary CSS
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-next/dist/bootstrap-vue-next.css'

import "./assets/custom.scss";
// pinia for state management 
const pinia = createPinia()
// app 
const App = createApp(app)
App.use(createBootstrap());

App.use(pinia).use(router).mount('#app')