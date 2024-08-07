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
                <img src="../assets/images/favicon.png" alt="logo-icon" />
                <span class="fw-bold ms-10">Noujoum</span>
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
                                        Clients List
                                    </router-link>
                                </li>
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/archived-clients"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Archived Clients
                                    </router-link>
                                </li>
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/new-client"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Add Client
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
                        <span class="title">Gestion financier</span>
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
                                        to="/users"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Encaissements
                                    </router-link>
                                </li>
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/add-user"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Nouveau paiement
                                    </router-link>
                                </li>
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/add-user"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Rapport financier
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
                    <span class="d-block text-uppercase fw-medium"
                        >Planing</span
                    >
                </li>
                <li
                    class="sidebar-nav-item accordion-item bg-transparent border-0 rounded-0"
                >
                    <a
                        href="#"
                        class="accordion-button collapsed rounded-0 shadow-none bg-transparent d-block"
                        data-bs-toggle="collapse"
                        data-bs-target="#sd-edt"
                        aria-expanded="false"
                        aria-controls="sd-edt"
                    >
                        <i class="flaticon-calendar-1"></i>
                        <span class="title">Planning</span>
                    </a>
                    <div
                        id="sd-edt"
                        class="accordion-collapse collapse"
                        data-bs-parent="#sd-edt"
                    >
                        <div class="accordion-body">
                            <ul
                                class="sidebar-sub-menu ps-0 mb-0 list-unstyled"
                            >
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/edt"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Emplois du temp
                                    </router-link>
                                </li>
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/add-user"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Add new emploi
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="sub-title sidebar-nav-item">
                    <span class="d-block text-uppercase fw-medium">Apps</span>
                </li>
                <li
                    class="sidebar-nav-item accordion-item bg-transparent border-0 rounded-0"
                >
                    <a
                        href="#"
                        class="accordion-button collapsed rounded-0 shadow-none bg-transparent d-block"
                        data-bs-toggle="collapse"
                        data-bs-target="#sidebarCollapseEleven"
                        aria-expanded="false"
                        aria-controls="sidebarCollapseEleven"
                    >
                        <i class="flaticon-user-3"></i>
                        <span class="title">Users</span>
                    </a>
                    <div
                        id="sidebarCollapseEleven"
                        class="accordion-collapse collapse"
                        data-bs-parent="#sidebarNavAccordion"
                    >
                        <div class="accordion-body">
                            <ul
                                class="sidebar-sub-menu ps-0 mb-0 list-unstyled"
                            >
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/users"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Users List
                                    </router-link>
                                </li>
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/add-user"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Add User
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
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
                        <span class="title">Parametrages</span>
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
                                        to="/sections"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Sections
                                    </router-link>
                                </li>
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/modules"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Modules
                                    </router-link>
                                </li>
                                <li class="sidebar-sub-menu-item">
                                    <router-link
                                        to="/sales"
                                        class="sidebar-sub-menu-link"
                                    >
                                        Sales
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
import { useLayoutStore } from "../store/layout";

const layoutStore = useLayoutStore();

let changeLayout = () => {
    layoutStore.open = !layoutStore.open;
};
</script>
