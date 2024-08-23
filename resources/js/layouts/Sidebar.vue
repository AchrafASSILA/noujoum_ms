<template>
    <div
        :class="[
            'sidebar-area position-fixed start-0 top-0 bg-black h-100vh transition',
            { active: layoutStore.open },
        ]"
        id="sidebar-area"
    >
        <div class="logo position-absolute start-0 end-0 top-0 bg-black">
            <a
                href="/"
                class="d-flex align-items-center text-white text-decoration-none"
            >
                <img
                    :src="authStore.logo"
                    style="width: 50px"
                    alt="logo-icon"
                />
                <span class="fw-bold ms-10">{{ authStore.appname }}</span>
            </a>
            <div class="border-bottom"></div>
            <button
                class="sidebar-burger-menu position-absolute lh-1 bg-transparent p-0 border-0"
                @click="changeLayout()"
            >
                <i class="ph-duotone ph-caret-double-right"></i>
            </button>
        </div>
        <div class="sidebar-menu">
            <ul
                class="sidebar-navbar-nav ps-0 mb-0 list-unstyled accordion"
                id="sidebarNavAccordion"
            >
                <li class="sidebar-nav-item">
                    <router-link to="/" class="sidebar-nav-link d-block">
                        <i class="flaticon-home-1"></i>
                        <span class="title">Home</span>
                    </router-link>
                </li>

                <li class="sub-title sidebar-nav-item">
                    <span class="d-block text-uppercase fw-medium"
                        >Gestion des clients</span
                    >
                </li>
                <li
                    class="sidebar-nav-item accordion-item bg-transparent border-0 rounded-0"
                >
                    <a
                        href="#"
                        class="accordion-button collapsed rounded-0 shadow-none bg-transparent d-block"
                        data-bs-toggle="collapse"
                        data-bs-target="#sd-client"
                        aria-expanded="false"
                        aria-controls="sd-client"
                    >
                        <i class="flaticon-people"></i>
                        <span class="title">Clients</span>
                    </a>
                    <div
                        id="sd-client"
                        class="accordion-collapse collapse"
                        data-bs-parent="#sd-client"
                    >
                        <div class="accordion-body">
                            <ul
                                class="sidebar-sub-menu ps-0 mb-0 list-unstyled"
                            >
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/clients"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Liste des clients
                                    </router-link>
                                </li>
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/archived-clients"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Les clients archivees
                                    </router-link>
                                </li>
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/new-client"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Nouveau client
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="sub-title sidebar-nav-item">
                    <span class="d-block text-uppercase fw-medium"
                        >Gestion financiere</span
                    >
                </li>
                <li
                    class="sidebar-nav-item accordion-item bg-transparent border-0 rounded-0"
                >
                    <a
                        href="#"
                        class="accordion-button collapsed rounded-0 shadow-none bg-transparent d-block"
                        data-bs-toggle="collapse"
                        data-bs-target="#sd-fn"
                        aria-expanded="false"
                        aria-controls="sd-fn"
                    >
                        <i class="flaticon-money"></i>
                        <span class="title">Gestion financiere</span>
                    </a>
                    <div
                        id="sd-fn"
                        class="accordion-collapse collapse"
                        data-bs-parent="#sd-fn"
                    >
                        <div class="accordion-body">
                            <ul
                                class="sidebar-sub-menu ps-0 mb-0 list-unstyled"
                            >
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/encaissements"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Encaissements
                                    </router-link>
                                </li>
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/new-encaissement"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Nouveau paiement
                                    </router-link>
                                </li>
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/etat-financier-per-services"
                                        class="sidebar-sub-menu-link"
                                    >
                                        État financier global
                                    </router-link>
                                </li>
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/services"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Les tarifs
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="sub-title sidebar-nav-item">
                    <span class="d-block text-uppercase fw-medium">Apps</span>
                </li>
                <li class="sidebar-nav-item">
                    <router-link
                        to="/edt"
                        class="sidebar-nav-link d-block pb-0 pt-0"
                    >
                        <i class="flaticon-calendar"></i>
                        <span class="title">Planning</span>
                    </router-link>
                </li>

                <li class="sidebar-nav-item">
                    <router-link
                        to="/users"
                        class="sidebar-nav-link d-block pb-0 pt-0"
                    >
                        <i class="flaticon-people"></i>
                        <span class="title">Utulisateures</span>
                    </router-link>
                </li>
                <li class="sidebar-nav-item">
                    <router-link
                        to="/sections"
                        class="sidebar-nav-link d-block pb-0 pt-0"
                    >
                        <i class="flaticon-shapes"></i>
                        <span class="title">Sections</span>
                    </router-link>
                </li>
                <li class="sidebar-nav-item">
                    <router-link
                        to="/modules"
                        class="sidebar-nav-link d-block pb-0 pt-0"
                    >
                        <i class="flaticon-sugar-cubes"></i>
                        <span class="title">Modules</span>
                    </router-link>
                </li>
                <li class="sidebar-nav-item">
                    <router-link
                        to="/sales"
                        class="sidebar-nav-link d-block pb-0 pt-0"
                    >
                        <i class="flaticon-layer-2"></i>
                        <span class="title">Salles</span>
                    </router-link>
                </li>
                <li class="sub-title sidebar-nav-item">
                    <span class="d-block text-uppercase fw-medium">Params</span>
                </li>
                <li
                    class="sidebar-nav-item accordion-item bg-transparent border-0 rounded-0"
                >
                    <a
                        href="#param"
                        class="accordion-button collapsed rounded-0 shadow-none bg-transparent d-block"
                        data-bs-toggle="collapse"
                        data-bs-target="#sidebarParam"
                        aria-expanded="false"
                        aria-controls="sidebarParam"
                    >
                        <i class="flaticon-setting"></i>
                        <span class="title">Paramétrages</span>
                    </a>
                    <div
                        id="sidebarParam"
                        class="accordion-collapse collapse"
                        data-bs-parent="#sidebarNavAccordion"
                    >
                        <div class="accordion-body">
                            <ul
                                class="sidebar-sub-menu ps-0 mb-0 list-unstyled"
                            >
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/config"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Config d'application
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { useAuthStore } from "../store/auth";
import { useLayoutStore } from "../store/layout";

const layoutStore = useLayoutStore();
const authStore = useAuthStore();
let changeLayout = () => {
    layoutStore.open = !layoutStore.open;
};
</script>

<style scoped>
/* .pb-0 {
    padding-bottom: 2px !important;
    padding-top: 2px !important;
}

.pb-0.active {
    padding-bottom: 12px !important;
    padding-top: 12px !important;
} */
</style>
