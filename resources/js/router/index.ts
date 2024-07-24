import { createRouter, createWebHistory } from "vue-router";
import Home from '../pages/admin/Home.vue'
import Users from '../pages/admin/users/Users.vue'
const routes = [
    {
        path: "/",
        component: Home,
        name: "Home",
        meta: { requiresAuth: true },
    },
    {
        path: "/users",
        component: Users,
        name: "Users",
        meta: { requiresAuth: true },
    },
    // not found
    // {
    //     path: "/:pathMatch(.*)*",
    //     component: Notfound,
    // },
];

const router = createRouter({
    history: createWebHistory("/"),
    routes,
});

// router.beforeEach((to, from, next) => {
//     if (to.meta.requiresAuth && !store.state.authModule.token) {
//         next({ name: "Login" });
//     } else if (localStorage.getItem("TOKEN") && to.name == "Login") {
//         next({ name: "Home" });
//     } else {
//         next();
//     }
// });

export default router;