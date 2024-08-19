import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/admin/Home.vue";
import Users from "../pages/admin/users/Users.vue";
import Notfound from "../Components/Notfound.vue";
import Login from "../pages/auth/Login.vue";
import Sections from "../pages/admin/sections/Sections.vue";
import Sales from "../pages/admin/sales/Sales.vue";
import Services from "../pages/admin/services/Services.vue";
import Clients from "../pages/admin/clients/Clients.vue";
import AddClient from "../pages/admin/clients/AddClient.vue";
import Client from "../pages/admin/clients/Client.vue";
import EditClient from "../pages/admin/clients/EditClient.vue";
import ArchivedClients from "../pages/admin/clients/ArchivedClients.vue";
import Modules from "../pages/admin/modules/Modules.vue";
import Calendar from "../pages/admin/edt/Calendar.vue";
import Encaissements from "../pages/admin/encaissements/Encaissements.vue";
import NewEncaissement from "../pages/admin/encaissements/NewEncaissement.vue";

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
    {
        path: "/modules",
        name: "Modules",
        component: Modules,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "founder"],
        },
    },
    {
        path: "/sales",
        name: "Sales",
        component: Sales,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "founder"],
        },
    },
    {
        path: "/services",
        name: "Services",
        component: Services,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "founder"],
        },
    },
    {
        path: "/edt",
        name: "Edt",
        component: Calendar,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "founder"],
        },
    },
    {
        path: "/clients",
        name: "Clients",
        component: Clients,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "founder"],
        },
    },
    {
        path: "/encaissements",
        name: "Encaissements",
        component: Encaissements,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "founder"],
        },
    },
    {
        path: "/new-encaissement",
        name: "NewEncaissement",
        component: NewEncaissement,
        meta: {
            requiresAuth: true,
            // roles: ["pinia", "founder"],
        },
    },
    {
        path: "/archived-clients",
        name: "ArchivedClients",
        component: ArchivedClients,
        meta: {
            requiresAuth: true,
            // roles: ["pinia", "founder"],
        },
    },
    {
        path: "/client/:id",
        name: "Client",
        component: Client,
        meta: {
            requiresAuth: true,
            // roles: ["pinia", "founder"],
        },
    },
    {
        path: "/new-client",
        name: "NewClient",
        component: AddClient,
        meta: {
            requiresAuth: true,
            // roles: ["pinia", "founder"],
        },
    },
    {
        path: "/edit-client/:id",
        name: "EditClient",
        component: EditClient,
        meta: {
            requiresAuth: true,
            // roles: ["pinia", "founder"],
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

// router.beforeEach((to, from, next) => {
//     // if (to.meta.requiresAuth && !useAuthStore().token) {
//     if (to.meta.requiresAuth && !localStorage.getItem("TOKEN")) {
//         next({ name: "Login" });
//     } else if (localStorage.getItem("TOKEN") && to.name == "Login") {
//         next({ name: "Home" });
//     } else {
//         // if (
//         //     to.meta.roles &&
//         //     to.meta.roles.includes(localStorage.getItem("ROLE"))
//         // ) {
//         //     next();
//         //     console.log(to);
//         // } else {
//         //     console.log(to);

//         next({ name: "Home" });
//         // }
//     }
// });
router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !localStorage.getItem("TOKEN")) {
        next({ name: "Login" });
    } else if (localStorage.getItem("TOKEN") && to.name == "Login") {
        next({ name: "Home" });
    } else {
        next();
    }
});

export default router;
