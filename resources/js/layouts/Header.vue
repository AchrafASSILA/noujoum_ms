<template>
    <header
        v-if="authStore.token"
        id="header"
        class="header-area bg-white text-center text-md-start pt-15 pb-15 ps-15 pe-15 ps-md-20 pe-md-20 pe-lg-30 transition mb-25 position-fixed"
        :class="[
            'header-area bg-white text-center text-md-start pt-15 pb-15 ps-15 pe-15 ps-md-20 pe-md-20 pe-lg-30 transition mb-25 position-fixed',
            { sticky: isSticky },
        ]"
    >
        <div class="row align-items-center">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div
                    class="header-left-side justify-content-center justify-content-md-start d-flex align-items-center"
                >
                    <button
                        class="header-burger-menu transition position-relative lh-1 bg-transparent p-0 border-0"
                        id="header-burger-menu"
                        @click="layoutStore.open = !layoutStore.open"
                    >
                        <i class="flaticon-menu-3"></i>
                    </button>
                    <form class="search-box" v-if="false">
                        <div class="input-group">
                            <input
                                type="text"
                                class="form-control shadow-none rounded-0 border-0"
                                placeholder="Search here"
                            />
                            <button
                                class="default-btn position-relative transition border-0 fw-medium text-white pt-8 pb-8 ps-15 pe-15 pt-md-12 pb-md-12 ps-md-20 pe-md-20"
                                type="button"
                            >
                                Rechercher
                                <i
                                    class="flaticon-search-interface-symbol position-relative ms-5 top-1"
                                ></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-8 col-lg-7 col-md-6">
                <div
                    class="header-right-side d-flex align-items-center justify-content-center justify-content-md-end"
                >
                    <LightDarkSwtichBtn />

                    <div class="dropdown email-dropdown" v-if="false">
                        <button
                            class="dropdown-toggle p-0 position-relative bg-transparent border-0 transition lh-1"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="flaticon-email-2"></i>
                            <span
                                class="dot-badge position-absolute fw-bold rounded-circle text-white bg-success d-inline-block"
                                >1</span
                            >
                        </button>
                        <div
                            class="dropdown-menu rounded-0 bg-white border-0 start-auto end-0"
                        >
                            <div
                                class="title d-flex align-items-center justify-content-between"
                            >
                                <span class="text-black fw-bold"
                                    >Messages
                                    <span class="text-muted">(03)</span></span
                                >
                                <router-link
                                    to="/chat"
                                    class="text-decoration-none link-btn transition fw-medium text-primary"
                                    >Mark all As Read</router-link
                                >
                            </div>
                            <ul class="ps-0 mb-0 list-unstyled dropdown-body">
                                <li class="position-relative">
                                    <img
                                        src="../assets/images/user/user1.jpg"
                                        width="45"
                                        height="45"
                                        class="rounded-circle position-absolute"
                                        alt="user"
                                    />
                                    <span
                                        class="d-block fw-semibold text-black-emphasis"
                                        >Jacob Linowiski
                                        <span class="ms-5 text-muted fw-normal"
                                            >35 mins ago</span
                                        ></span
                                    >
                                    Hey Victor! Could you please...
                                    <router-link
                                        to="/chat"
                                        class="d-block position-absolute start-0 top-0 end-0 bottom-0 text-decoration-none"
                                    ></router-link>
                                    <span
                                        class="unread d-inline-block rounded-circle bg-primary position-absolute w-10 h-10"
                                    ></span>
                                </li>
                                <li class="text-muted position-relative">
                                    <img
                                        src="../assets/images/user/user2.jpg"
                                        width="45"
                                        height="45"
                                        class="rounded-circle position-absolute"
                                        alt="user"
                                    />
                                    <span
                                        class="d-block fw-semibold text-black-emphasis"
                                        >Angela Carter
                                        <span class="ms-5 text-muted fw-normal"
                                            >1 day ago</span
                                        ></span
                                    >
                                    How are you Victor? Would you please...
                                    <router-link
                                        to="/chat"
                                        class="d-block position-absolute start-0 top-0 end-0 bottom-0 text-decoration-none"
                                    ></router-link>
                                </li>
                                <li class="text-muted position-relative">
                                    <img
                                        src="../assets/images/user/user3.jpg"
                                        width="45"
                                        height="45"
                                        class="rounded-circle position-absolute"
                                        alt="user"
                                    />
                                    <span
                                        class="d-block fw-semibold text-black-emphasis"
                                        >Brad Traversy
                                        <span class="ms-5 text-muted fw-normal"
                                            >2 days ago</span
                                        ></span
                                    >
                                    Hey Victor! Could you please...
                                    <router-link
                                        to="/chat"
                                        class="d-block position-absolute start-0 top-0 end-0 bottom-0 text-decoration-none"
                                    ></router-link>
                                </li>
                            </ul>
                            <div class="text-center dropdown-footer">
                                <router-link
                                    to="/chat"
                                    class="link-btn text-decoration-none position-relative d-inline-block transition fw-medium fw-medium text-primary"
                                >
                                    View All Messages
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown notification-dropdown" v-if="false">
                        <button
                            class="dropdown-toggle p-0 position-relative bg-transparent border-0 transition lh-1"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="flaticon-bell-2"></i>
                            <span
                                class="dot-badge position-absolute fw-bold rounded-circle text-white bg-primary d-inline-block"
                            >
                                3
                            </span>
                        </button>
                        <div
                            class="dropdown-menu rounded-0 bg-white border-0 start-auto end-0"
                        >
                            <div
                                class="title d-flex align-items-center justify-content-between"
                            >
                                <span class="text-black fw-bold"
                                    >Notifications
                                    <span class="text-muted">(03)</span></span
                                >
                                <router-link
                                    to="/notifications"
                                    class="text-decoration-none link-btn transition text-primary fw-medium"
                                >
                                    Clear All
                                </router-link>
                            </div>
                            <ul class="ps-0 mb-0 list-unstyled dropdown-body">
                                <li class="text-muted position-relative">
                                    <div
                                        class="icon rounded-circle position-absolute text-center"
                                    >
                                        <i
                                            class="ph-bold ph-chat-centered-dots"
                                        ></i>
                                    </div>
                                    <span class="d-block text-black-emphasis"
                                        >You have requested to
                                        <strong class="fw-semibold"
                                            >withdrawal</strong
                                        ></span
                                    >
                                    2 hrs ago
                                    <router-link
                                        to="/notifications"
                                        class="d-block position-absolute start-0 top-0 end-0 bottom-0 text-decoration-none"
                                    ></router-link>
                                    <span
                                        class="unread d-inline-block rounded-circle bg-primary position-absolute w-10 h-10"
                                    ></span>
                                </li>
                                <li class="text-muted position-relative">
                                    <div
                                        class="icon rounded-circle position-absolute text-center"
                                    >
                                        <i class="ph-bold ph-user-plus"></i>
                                    </div>
                                    <span class="d-block text-black-emphasis">
                                        <strong class="fw-semibold"
                                            >A new user</strong
                                        >
                                        added in Adlash
                                    </span>
                                    3 hrs ago
                                    <router-link
                                        to="/notifications"
                                        class="d-block position-absolute start-0 top-0 end-0 bottom-0 text-decoration-none"
                                    ></router-link>
                                    <span
                                        class="unread d-inline-block rounded-circle bg-primary position-absolute w-10 h-10"
                                    ></span>
                                </li>
                                <li class="text-muted position-relative">
                                    <div
                                        class="icon rounded-circle position-absolute text-center"
                                    >
                                        <i
                                            class="ph-bold ph-chat-centered-dots"
                                        ></i>
                                    </div>
                                    <span class="d-block text-black-emphasis">
                                        You have requested to
                                        <strong class="fw-semibold"
                                            >withdrawal</strong
                                        >
                                    </span>
                                    1 day ago
                                    <router-link
                                        to="/notifications"
                                        class="d-block position-absolute start-0 top-0 end-0 bottom-0 text-decoration-none"
                                    ></router-link>
                                </li>
                            </ul>
                            <div class="text-center dropdown-footer">
                                <router-link
                                    to="/notifications"
                                    class="link-btn text-decoration-none text-primary position-relative d-inline-block transition fw-medium fw-medium"
                                >
                                    See All Notifications
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown profile-dropdown">
                        <button
                            class="dropdown-toggle text-start fs-14 text-black-emphasis d-flex align-items-center p-0 position-relative bg-transparent border-0 transition lh-1"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <img
                                :src="authStore.image"
                                class="rounded"
                                width="44"
                                height="44"
                                alt="admin"
                            />
                            <span
                                class="title d-none d-lg-block ms-10 ms-lg-15"
                            >
                                <span class="d-block fw-bold mb-5 mb-md-8">{{
                                    authStore.name
                                }}</span>
                                <span
                                    class="text-body-emphasis fw-semibold fs-13"
                                    >{{ authStore.role }}</span
                                >
                            </span>
                        </button>
                        <div
                            class="dropdown-menu rounded-0 bg-white border-0 start-auto end-0"
                        >
                            <ul class="ps-0 mb-0 list-unstyled dropdown-body">
                                <li
                                    class="text-body-secondary fw-semibold transition position-relative"
                                >
                                    <i class="flaticon-user-2"></i>
                                    My Account
                                    <router-link
                                        to="/profile"
                                        class="d-block position-absolute start-0 top-0 end-0 bottom-0 text-decoration-none"
                                    ></router-link>
                                </li>

                                <li
                                    class="text-body-secondary fw-semibold transition position-relative"
                                >
                                    <i class="flaticon-logout"></i>
                                    Logout
                                    <button
                                        @click.prevent="logout()"
                                        class="btn d-block position-absolute start-0 top-0 end-0 bottom-0 text-decoration-none"
                                    ></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script lang="ts" setup>
import { ref, onMounted } from "vue";
import LightDarkSwtichBtn from "./LightDarkSwtichBtn.vue";
import { useRouter } from "vue-router";
import { useLayoutStore } from "../store/layout";
import { useAuthStore } from "../store/auth";

// stores
const layoutStore = useLayoutStore();
const isSticky = ref(false);
const authStore = useAuthStore();
let router = useRouter();

// life cycle
onMounted(() => {
    window.addEventListener("scroll", () => {
        let scrollPos = window.scrollY;
        isSticky.value = scrollPos >= 100;
    });
});

// logout
let logout = async () => {
    await authStore.logout().then((res) => {
        if (true) {
            router.push({ path: "/auth/login" });
        }
    });
};
</script>
