import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/admin/Home.vue";
import Users from "../pages/admin/users/Users.vue";
import Notfound from "../Components/Notfound.vue";
import Login from "../pages/auth/Login.vue";
import { useAuthStore } from "@/store/auth";
import Sections from "../pages/admin/sections/Sections.vue";

// let authStore = useAuthStore();

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "founder"],
        },
    },
    {
        path: "/users",
        name: "Users",
        component: Users,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "founder"],
        },
    },
    {
        path: "/sections",
        name: "Sections",
        component: Sections,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "founder"],
        },
    },
    // auth
    {
        path: "/auth/login",
        name: "Login",
        component: Login,
    },
    // not found
    {
        path: "/:pathMatch(.*)*",
        component: Notfound,
    },
];

const router = createRouter({
    history: createWebHistory("/"),
    routes,
});

router.beforeEach((to, from, next) => {
    // if (to.meta.requiresAuth && !useAuthStore().token) {
    if (to.meta.requiresAuth && !localStorage.getItem("TOKEN")) {
        next({ name: "Login" });
    } else if (localStorage.getItem("TOKEN") && to.name == "Login") {
        next({ name: "Home" });
    } else {
        if (
            to.meta.roles &&
            to.meta.roles.includes(localStorage.getItem("ROLE"))
        ) {
            next();
            console.log(to);
        } else {
            console.log(to);

            next({ name: "Home" });
        }
    }
});

export default router;
