<template>
    <MainLayout>
        <div v-if="loaded">
            <h4 class="mb-5 mb-sm-0 fw-bold">
                Les utulisateures/ <span>{{ users?.length }}</span>
            </h4>
            <div
                class="card mb-25 border-0 rounded-0 bg-white letter-spacing mt-4"
            >
                <div
                    class="card-head box-shadow bg-white d-lg-flex align-items-center justify-content-between p-15 p-sm-20 p-md-25"
                >
                    <div class="d-sm-flex align-items-center"></div>
                    <div class="d-flex align-items-center">
                        <form
                            v-if="false"
                            class="search-box position-relative me-15"
                            @submit.prevent=""
                        >
                            <input
                                type="text"
                                v-model="search"
                                class="form-control shadow-none text-black rounded-0 border-0"
                                placeholder="Rechercher"
                            />
                            <button
                                type="submit"
                                class="bg-transparent text-primary transition p-0 border-0"
                            >
                                <i class="flaticon-search-interface-symbol"></i>
                            </button>
                        </form>
                        <button
                            class="default-btn position-relative transition border-0 fw-medium text-white pt-11 pb-11 ps-25 pe-25 pt-md-12 pb-md-12 ps-md-30 pe-md-30 rounded-1 bg-success fs-md-15 fs-lg-16 d-inline-block me-10 mb-10 mb-lg-0 text-decoration-none m-0"
                            @click="initialize()"
                            data-bs-toggle="modal"
                            data-bs-target="#basicModal"
                            style="
                                background-color: #06b48a !important;
                                margin-right: 0 !important;
                            "
                        >
                            Nouvelle utulisateur
                            <i
                                class="flaticon-plus position-relative ms-5 fs-12"
                            ></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row" v-if="users && users.length > 0">
                <div
                    class="col-sm-6 col-lg-4 col-xxxl-3"
                    v-for="(user, index) in users"
                    :key="index"
                >
                    <div
                        class="card mb-25 border-0 rounded-0 bg-white seller-card"
                    >
                        <div class="card-body letter-spacing">
                            <div
                                class="mb-15 mb-md-20 mb-lg-25 d-flex align-items-center justify-content-between"
                            >
                                <div
                                    class="icon position-relative text-center rounded-circle"
                                    style="overflow: hidden"
                                >
                                    <img
                                        :src="user.image"
                                        class="position-absolute start-0 end-0 ms-auto me-auto user-image"
                                        alt="seller"
                                    />
                                </div>
                                <div class="dropdown">
                                    <button
                                        class="dropdown-toggle card-dot-btn lh-1 position-relative top-4 bg-transparent border-0 shadow-none p-0 transition"
                                        type="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                    >
                                        <i class="flaticon-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a
                                                class="dropdown-item d-flex align-items-center"
                                                href="javascript:void(0);"
                                            >
                                                <i
                                                    class="flaticon-pen lh-1 me-8 position-relative top-1"
                                                ></i>
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="dropdown-item d-flex align-items-center"
                                                href="javascript:void(0);"
                                            >
                                                <i
                                                    class="flaticon-delete lh-1 me-8 position-relative top-1"
                                                ></i>
                                                Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h5
                                class="fs-18 fw-semibold text-black mb-5 mb-md-8"
                            >
                                {{ user.name }}
                            </h5>
                            <span class="text-paragraph d-block">
                                Role:
                                <span class="text-primary fw-semibold">{{
                                    user.roleLabel
                                }}</span>
                            </span>
                            <ul
                                class="list mt-15 mt-lg-25 ps-0 mb-0 list-unstyled d-flex justify-content-between"
                            >
                                <li>
                                    <span
                                        class="d-block text-dark-emphasis text-uppercase fw-medium fs-12 mb-5 mb-md-8"
                                    >
                                        Tel :
                                    </span>
                                    <span class="d-block text-dark fw-medium">{{
                                        user.tel
                                    }}</span>
                                </li>
                                <li>
                                    <span
                                        class="d-block text-dark-emphasis text-uppercase fw-medium fs-12 mb-5 mb-md-8"
                                    >
                                        email
                                    </span>
                                    <span class="d-block text-dark fw-medium">{{
                                        user.email
                                    }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <Emptybox v-else></Emptybox>
        </div>
        <Loader v-else></Loader>
    </MainLayout>
</template>
<script setup lang="ts">
import { useUsersStore } from "../../../store/users";
import get from "../../../axios/index";
import { onMounted, ref } from "vue";
import MainLayout from "../../../layouts/MainLayout.vue";
import { useErrorStore } from "../../../store/error";
import axiosClient from "../../../axios/index";

// lifecycle hooks

onMounted(async () => {
    await getUsers();
    await getRoles();
    imageUrl.value =
        "https://www.eclosio.ong/wp-content/uploads/2018/08/default.png";
    loaded.value = true;
});

// vars
let users = ref([]);
let roles = ref([]);

let loaded = ref(false);
let closeBtn = ref("");
let imageUrl = ref("");
// stores

const userStore = useUsersStore();
const errorStore = useErrorStore();
// funcs
let getUsers = async () => {
    await userStore
        .getUsers()
        .then((res) => {
            users.value = userStore.users;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let getRoles = async () => {
    await axiosClient
        .get("roles")
        .then((res) => {
            roles.value = res.data.roles;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
</script>
<style scoped>
.user-image {
    width: 90%;
    height: 90%;
    object-fit: cover;
    border-radius: 50%;
}
</style>
