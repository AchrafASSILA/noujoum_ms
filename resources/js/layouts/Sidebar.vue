<template>
    <div
        :class="[
            'sidebar-area position-fixed start-0 top-0 bg-black h-100vh transition',
            { active: layoutStore.open },
        ]"
        id="sidebar-area"
    >
        <div class="logo position-absolute start-0 end-0 top-0 bg-black">
            <router-link
                to="/"
                class="d-flex align-items-center text-white text-decoration-none"
            >
                <img src="../assets/images/favicon.png" alt="logo-icon" />
                <span class="fw-bold ms-10">Noujoum</span>
            </router-link>
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
                        <i class="flaticon-more-1"></i>
                        <span class="title">Dashboard</span>
                    </router-link>
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
                <li class="sidebar-nav-item">
                    <router-link
                        to="/sections"
                        class="sidebar-nav-link d-block"
                    >
                        <i class="flaticon-more-1"></i>
                        <span class="title">Sections</span>
                    </router-link>
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
