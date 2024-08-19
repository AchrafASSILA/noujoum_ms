import "./bootstrap";

import { createApp } from "vue";
import router from "./router";
import { createPinia } from "pinia";
import app from "./app.vue";

import { createBootstrap } from "bootstrap-vue-next";
// import Emptybox from "./components/ui/EmptyBox.vue";
// import Errors from "./components/ui/Errors.vue";
// import Loader from "./components/ui/Loader.vue";

// Add the necessary CSS
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue-next/dist/bootstrap-vue-next.css";

import "./assets/custom.scss";
import vuetify from "./vuetify";
// pinia for state management
const pinia = createPinia();
// app
const App = createApp(app);
// App.component("Emptybox", EmptyBox);
// App.component("Errors", Errors);
// App.component("Loader", Loader);
App.use(router);
App.use(pinia);

App.use(createBootstrap());

App.use(vuetify);
App.mount("#app");
// router.isReady().then(() => {
// });
