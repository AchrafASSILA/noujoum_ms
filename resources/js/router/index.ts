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
import EcronCalendar from "../pages/admin/edt/EcronCalendar.vue";
import EtatFinancierPerServices from "../pages/admin/encaissements/EtatFinancierPerServices.vue";
import Config from "../pages/admin/config/Config.vue";
import EtatJournalier from "../pages/admin/encaissements/EtatJournalier.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
        meta: {
            requiresAuth: true,
            roles: [
                "pinia",
                "admin",
                "assistant",
                "founder",
                "financial_agent",
                "coach",
            ],
        },
    },
    {
        path: "/users",
        name: "Users",
        component: Users,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "admin", "assistant", "founder"],
        },
    },
    {
        path: "/sections",
        name: "Sections",
        component: Sections,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "admin", "assistant", "founder"],
        },
    },
    {
        path: "/modules",
        name: "Modules",
        component: Modules,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "admin", "assistant", "founder"],
        },
    },
    {
        path: "/sales",
        name: "Sales",
        component: Sales,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "admin", "assistant", "founder"],
        },
    },
    {
        path: "/services",
        name: "Services",
        component: Services,
        meta: {
            requiresAuth: true,
            roles: [
                "pinia",
                "admin",
                "assistant",
                "financial_agent",
                "founder",
            ],
        },
    },
    {
        path: "/edt",
        name: "Edt",
        component: Calendar,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "admin", "assistant", "coach", "founder"],
        },
    },
    {
        path: "/edt-full",
        name: "EdtFull",
        component: EcronCalendar,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "admin", "assistant", "coach", "founder"],
        },
    },
    {
        path: "/clients",
        name: "Clients",
        component: Clients,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "admin", "assistant", "founder"],
        },
    },
    {
        path: "/encaissements",
        name: "Encaissements",
        component: Encaissements,
        meta: {
            requiresAuth: true,
            roles: [
                "pinia",
                "admin",
                "assistant",
                "financial_agent",
                "founder",
            ],
        },
    },
    {
        path: "/etat-financier-per-services",
        name: "EtatFinancierPerServices",
        component: EtatFinancierPerServices,
        meta: {
            requiresAuth: true,
            roles: [
                "pinia",
                "admin",
                "assistant",
                "financial_agent",
                "founder",
            ],
        },
    },
    {
        path: "/etat-journalier",
        name: "EtatJournalier",
        component: EtatJournalier,
        meta: {
            requiresAuth: true,
            roles: [
                "pinia",
                "admin",
                "assistant",
                "financial_agent",
                "founder",
            ],
        },
    },
    {
        path: "/new-encaissement",
        name: "NewEncaissement",
        component: NewEncaissement,
        meta: {
            requiresAuth: true,
            roles: [
                "pinia",
                "admin",
                "assistant",
                "financial_agent",
                "founder",
            ],
        },
    },
    {
        path: "/archived-clients",
        name: "ArchivedClients",
        component: ArchivedClients,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "admin", "assistant", "founder"],
        },
    },
    {
        path: "/client/:id",
        name: "Client",
        component: Client,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "admin", "assistant", "founder"],
        },
    },
    {
        path: "/new-client",
        name: "NewClient",
        component: AddClient,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "admin", "assistant", "founder"],
        },
    },
    {
        path: "/edit-client/:id",
        name: "EditClient",
        component: EditClient,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "admin", "assistant", "founder"],
        },
    },
    {
        path: "/config",
        name: "Config",
        component: Config,
        meta: {
            requiresAuth: true,
            roles: ["pinia", "admin", "assistant", "founder"],
        },
    },
    // auth
    {
        path: "/auth/login",
        name: "Login",
        component: Login,
        meta: {
            requiresAuth: false,
        },
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
        if (!to.meta.requiresAuth) {
            next();
        } else if (
            to.meta.roles &&
            to.meta.roles.includes(localStorage.getItem("ROLE"))
        ) {
            next();
        } else {
            console.log("to");

            next({ name: "Home" });
        }
    }
});

export default router;
