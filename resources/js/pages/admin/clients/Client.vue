<template>
    <MainLayout>
        <div v-if="loaded">
            <div class="row">
                <div class="col-xxl-8 order-2 order-xl-1">
                    <div
                        class="card mb-25 border-0 rounded-0 bg-white letter-spacing"
                    >
                        <div class="card-body p-10">
                            <ul class="settings-tabs ps-0 mb-0 list-unstyled">
                                <li>
                                    <router-link
                                        to="/account-settings"
                                        class="fs-md-15 fs-lg-16 fw-medium text-decoration-none d-block w-100 rounded-1 text-center transition"
                                    >
                                        Account Settings
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div
                        class="card mb-25 border-0 rounded-0 bg-white letter-spacing settings-card"
                    >
                        <div class="card-body p-15 p-sm-20 p-md-25 p-lg-30">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div
                                            class="form-group mb-15 mb-sm-20 mb-md-25"
                                        >
                                            <label
                                                class="d-block text-black fw-semibold mb-10"
                                            >
                                                First Name
                                            </label>
                                            <input
                                                type="text"
                                                class="form-control shadow-none rounded-0 text-black"
                                                placeholder="e.g. Adam"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="form-group mb-15 mb-sm-20 mb-md-25"
                                        >
                                            <label
                                                class="d-block text-black fw-semibold mb-10"
                                            >
                                                Last Name
                                            </label>
                                            <input
                                                type="text"
                                                class="form-control shadow-none rounded-0 text-black"
                                                placeholder="e.g. Smith"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="form-group mb-15 mb-sm-20 mb-md-25"
                                        >
                                            <label
                                                class="d-block text-black fw-semibold mb-10"
                                            >
                                                Email Address
                                            </label>
                                            <input
                                                type="email"
                                                class="form-control shadow-none rounded-0 text-black"
                                                placeholder="e.g. adam127704@gmail.com"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="form-group mb-15 mb-sm-20 mb-md-25"
                                        >
                                            <label
                                                class="d-block text-black fw-semibold mb-10"
                                            >
                                                Phone No
                                            </label>
                                            <input
                                                type="text"
                                                class="form-control shadow-none rounded-0 text-black"
                                                placeholder="e.g. +001 321 4567"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="form-group mb-15 mb-sm-20 mb-md-25"
                                        >
                                            <label
                                                class="d-block text-black fw-semibold mb-10"
                                            >
                                                Address
                                            </label>
                                            <input
                                                type="passowrd"
                                                class="form-control shadow-none rounded-0 text-black"
                                                placeholder="add your address here"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="form-group mb-15 mb-sm-20 mb-md-25"
                                        >
                                            <label
                                                class="d-block text-black fw-semibold mb-10"
                                            >
                                                Country
                                            </label>
                                            <select
                                                class="form-select shadow-none fw-semibold rounded-0"
                                            >
                                                <option selected>
                                                    United States
                                                </option>
                                                <option value="1">
                                                    Canada
                                                </option>
                                                <option value="2">
                                                    Germany
                                                </option>
                                                <option value="3">
                                                    Switzerland
                                                </option>
                                                <option value="4">
                                                    Australia
                                                </option>
                                                <option value="5">
                                                    Sweden
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div
                                            class="form-group mb-15 mb-sm-20 mb-md-25"
                                        >
                                            <label
                                                class="d-block text-black fw-semibold mb-10"
                                            >
                                                Add Your Bio
                                            </label>
                                            <div class="mb-0">
                                                <QuillEditor
                                                    theme="snow"
                                                    placeholder="Write your meta description"
                                                    toolbar="full"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div
                                            class="form-group mb-15 mb-sm-20 mb-md-25"
                                        >
                                            <label
                                                class="d-block text-black fw-semibold mb-10"
                                            >
                                                Select Your Skills
                                            </label>
                                            <select
                                                class="form-select shadow-none fw-semibold rounded-0"
                                            >
                                                <option selected>
                                                    UI/UX Designer
                                                </option>
                                                <option value="1">
                                                    Web Developer
                                                </option>
                                                <option value="2">
                                                    Web Designer
                                                </option>
                                                <option value="3">
                                                    Brand Designer
                                                </option>
                                                <option value="4">
                                                    Motion Designer
                                                </option>
                                            </select>
                                            <div class="members-list">
                                                <div
                                                    class="d-inline-block bg-gray rounded-1 fs-12 fw-medium text-primary p-5"
                                                >
                                                    Designer
                                                    <button
                                                        type="button"
                                                        class="bg-transparent p-0 border-0 lh-1 transition"
                                                    >
                                                        <i
                                                            class="flaticon-close"
                                                        ></i>
                                                    </button>
                                                </div>
                                                <div
                                                    class="d-inline-block bg-gray rounded-1 fs-12 fw-medium text-primary p-5"
                                                >
                                                    Brand Designer
                                                    <button
                                                        type="button"
                                                        class="bg-transparent p-0 border-0 lh-1 transition"
                                                    >
                                                        <i
                                                            class="flaticon-close"
                                                        ></i>
                                                    </button>
                                                </div>
                                                <div
                                                    class="d-inline-block bg-gray rounded-1 fs-12 fw-medium text-primary p-5"
                                                >
                                                    Motion Designer
                                                    <button
                                                        type="button"
                                                        class="bg-transparent p-0 border-0 lh-1 transition"
                                                    >
                                                        <i
                                                            class="flaticon-close"
                                                        ></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div
                                            class="d-flex align-items-center justify-content-between"
                                        >
                                            <button
                                                class="default-btn transition border-0 fw-medium text-white pt-10 pb-10 ps-25 pe-25 pt-md-11 pb-md-11 ps-md-35 pe-md-35 rounded-1 fs-md-15 fs-lg-16 bg-success"
                                                type="submit"
                                            >
                                                Save Changes
                                            </button>
                                            <button
                                                type="button"
                                                class="bg-transparent p-0 border-0 text-danger lh-1 fw-medium"
                                            >
                                                <i
                                                    class="flaticon-delete lh-1 me-1 position-relative top-2"
                                                ></i>
                                                <span class="position-relative"
                                                    >Cancel</span
                                                >
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 order-1 order-xl-2">
                    <div
                        class="card mb-25 border-0 rounded-0 bg-white profile-intro-card"
                    >
                        <div
                            class="card-body p-15 p-sm-20 p-sm-25 p-lg-30 letter-spacing"
                        >
                            <div
                                class="mb-15 mb-md-20 d-flex align-items-center justify-content-between"
                            >
                                <h5 class="card-title fw-bold mb-0 fs-lg-18">
                                    Profile Intro
                                </h5>
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
                                                    class="flaticon-view lh-1 me-8 position-relative top-1"
                                                ></i>
                                                View
                                            </a>
                                        </li>
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
                            <div class="user-info d-flex align-items-center">
                                <div class="image position-relative">
                                    <img
                                        :src="client.image"
                                        class="rounded-circle"
                                        width="85"
                                        height="85"
                                        alt="user"
                                    />
                                    <div
                                        class="file-upload text-center bg-white rounded-circle text-primary"
                                    >
                                        <i class="flaticon-add-photo"></i>
                                        <input type="file" />
                                    </div>
                                </div>
                                <div class="ms-20">
                                    <h5 class="text-black fw-black mb-1">
                                        {{ client.name }}
                                    </h5>
                                    <span class="d-block text-muted">{{
                                        client.email
                                    }}</span>
                                </div>
                            </div>
                            <div class="content position-relative">
                                <span
                                    class="d-block text-black fs-md-15 fs-lg-16 fw-medium mb-8"
                                >
                                    About Me
                                </span>
                                <p class="fs-md-15 mb-0 text-paragraph lh-base">
                                    This event combines all the data and backend
                                    information to the frontend.
                                </p>
                                <button
                                    type="button"
                                    class="border-0 d-inline-block p-0 rounded-circle text-center transition"
                                >
                                    <i class="ph-duotone ph-pencil-simple"></i>
                                </button>
                            </div>
                            <div class="content position-relative">
                                <span
                                    class="d-block text-black fs-md-15 fs-lg-16 fw-medium mb-8"
                                >
                                    Work
                                </span>
                                <p class="fs-md-15 mb-0 text-paragraph lh-base">
                                    Working as
                                    <span class="fw-medium"
                                        >UI/UX Designer</span
                                    >
                                </p>
                                <button
                                    type="button"
                                    class="border-0 d-inline-block p-0 rounded-circle text-center transition"
                                >
                                    <i class="ph-duotone ph-pencil-simple"></i>
                                </button>
                            </div>
                            <div class="row info-card">
                                <div
                                    class="col-6 col-sm-4 col-xxl-6 col-xxxl-4"
                                >
                                    <div class="info p-10 p-sm-15 p-md-20">
                                        <span
                                            class="d-block text-black-emphasis mb-1"
                                            >Follower</span
                                        >
                                        <h4
                                            class="d-block text-primary fw-black mb-0"
                                        >
                                            2325
                                        </h4>
                                    </div>
                                </div>
                                <div
                                    class="col-6 col-sm-4 col-xxl-6 col-xxxl-4"
                                >
                                    <div class="info p-10 p-sm-15 p-md-20">
                                        <span
                                            class="d-block text-black-emphasis mb-1"
                                            >Following</span
                                        >
                                        <h4
                                            class="d-block text-success fw-black mb-0"
                                        >
                                            1506
                                        </h4>
                                    </div>
                                </div>
                                <div
                                    class="col-6 col-sm-4 col-xxl-6 col-xxxl-4"
                                >
                                    <div class="info p-10 p-sm-15 p-md-20">
                                        <span
                                            class="d-block text-black-emphasis mb-1"
                                            >Likes</span
                                        >
                                        <h4
                                            class="d-block text-info fw-black mb-0"
                                        >
                                            10300
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Loader v-else></Loader>
    </MainLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<script setup>
import { ref, onMounted } from "vue";
import MainLayout from "../../../layouts/MainLayout.vue";
import Emptybox from "../../../Components/ui/EmptyBox.vue";
import Loader from "../../../Components/ui/Loader.vue";
import { useErrorStore } from "../../../store/error";
import { useClientStore } from "../../../store/client";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const id = route.params.id;
// lifecycle
onMounted(async () => {
    await getClient();
    loaded.value = true;
});

// vars
let client = ref(null);
// let sections = ref([]);

let loaded = ref(false);

let search = ref("");
let imageUrl = ref("");

// stores
const clientStore = useClientStore();
const errorStore = useErrorStore();
const router = useRouter();
// funcs
let getClient = async () => {
    await clientStore
        .client(id)
        .then(() => {
            client.value = clientStore.client;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
</script>

<style scoped>
.btn-edit,
.btn-delete {
    padding: 2px;
    font-size: 13px;
}
.section-img {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 80px;
    height: 80px;
    margin: 5px;
    margin-left: auto;
    margin-right: auto;
    overflow: hidden;
    border-radius: 50%;
}
.section-img img {
    width: 100%;
    height: 100%;
    /* object-fit: contain; */
}
#style1 {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 80px;
    height: 80px;
    background-color: transparent;
    border: none;
    cursor: pointer;
}
#style1::-webkit-color-swatch {
    border-radius: 15px;
    border: none;
}
#style1::-moz-color-swatch {
    border-radius: 15px;
    border: none;
}
.card {
    border-radius: 0;
    border: 0;
}
.quizz-search {
    line-height: 1;
    font-size: 14px;
    border-radius: 5px;
    color: var(--splash-black-color) !important;

    background: #f5f4fa;
    padding-top: 14px;
    padding-bottom: 14px;
}
</style>
