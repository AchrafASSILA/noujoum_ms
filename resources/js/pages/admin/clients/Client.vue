<template>
    <MainLayout>
        <div v-if="loaded">
            <div class="col-4">
                <div class="card mb-25 border-0 rounded-0 bg-white letter-spacing lead-info-box">
                    <div class="card-body p-15 p-sm-20 p-md-25 p-lg-30">
                        <div class="d-sm-flex align-items-start" style="justify-content: space-between">
                            <div class="profile-info d-sm-flex align-items-start">
                                <img :src="client.image" class="rounded" alt="user" />
                                <div class="title mt-12 mt-sm-0">
                                    <h5 class="text-black fw-medium mb-8">
                                        {{ client.name }}
                                    </h5>

                                    <span class="d-block fs-md-15 fs-lg-16 text-dark-emphasis mb-8">
                                        Handicap :
                                        {{ client.handicapLabel }}
                                    </span>
                                    <span class="d-block fs-md-15 fs-lg-16 text-dark-emphasis mb-8">
                                        Type :
                                        {{ client.typeHandicap }}
                                    </span>
                                    <span class="d-block fs-md-15 fs-lg-16 text-dark-emphasis mb-8">
                                        Date :
                                        {{ client.dateHandicap }}
                                    </span>
                                    <span class="d-block fs-md-15 fs-lg-16 text-dark-emphasis mb-8">
                                        Cause :
                                        {{ client.causeHandicap }}
                                    </span>
                                    <span class="d-block fs-md-15 fs-lg-16 text-dark-emphasis mb-8">
                                        Autonomie :
                                        {{ client.autonomie }}
                                    </span>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button
                                    class="dropdown-toggle card-dot-btn lh-1 position-relative top-4 bg-transparent border-0 shadow-none p-0 transition"
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="flaticon-dots"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center"
                                            :href="'/edit-client/' + client.id">
                                            <i class="flaticon-pen lh-1 me-8 position-relative top-1"></i>
                                            Modifier
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" class="dropdown-item d-flex align-items-center" :href="'/impressions-client-badge/' +
                                            client.id
                                            ">
                                            <i class="flaticon-printing lh-1 me-8 position-relative top-1"></i>
                                            Imprimer le badge
                                        </a>
                                    </li>
                                    <li>
                                        <button class="dropdown-item d-flex align-items-center"
                                            @click.prevent="deleteClient()">
                                            <i class="flaticon-delete lh-1 me-8 position-relative top-1"></i>
                                            Archiver
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="border-top mt-15 mb-15 mt-sm-20 mb-sm-20 mt-md-25 mb-md-25 mt-lg-30 mb-lg-30"></div>
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="fw-medium text-black-emphasis mb-0">
                                Informations
                            </h5>
                        </div>
                        <ul class="info mt-25 ps-0 mb-0 list-unstyled">
                            <li class="position-relative">
                                <div class="icon text-success rounded-circle text-center">
                                    <i class="flaticon-mail-inbox-app"></i>
                                </div>
                                <span class="d-block text-black mb-5 fw-semibold">Email</span>
                                <a :href="'mailto:' + client.email"
                                    class="d-inline-block fs-md-15 fs-lg-16 text-primary text-decoration-none">
                                    {{ client.email }}
                                </a>
                            </li>
                            <li class="position-relative">
                                <div class="icon text-info rounded-circle text-center">
                                    <i class="flaticon-telephone-call"></i>
                                </div>
                                <span class="d-block text-black mb-5 fw-semibold">Phone No</span>
                                <a :href="'tel:' + client.tel"
                                    class="d-inline-block fs-md-15 fs-lg-16 text-muted text-decoration-none">
                                    {{ client.tel }}
                                </a>
                            </li>
                            <li class="position-relative">
                                <div class="icon text-primary rounded-circle text-center">
                                    <i class="ph-bold ph-facebook-logo lh-1 fs-md-18"></i>
                                </div>
                                <span class="d-block text-black mb-5 fw-semibold">Facebook</span>
                                <a :href="client.facebook" target="_blank"
                                    class="d-inline-block fs-md-15 fs-lg-16 text-muted text-decoration-none">
                                    {{ client.facebook }}
                                </a>
                            </li>
                            <li class="position-relative">
                                <div class="icon text-primary rounded-circle text-center">
                                    <i class="ph-bold ph-instagram-logo lh-1 fs-md-18"></i>
                                </div>
                                <span class="d-block text-black mb-5 fw-semibold">Instagram</span>
                                <a :href="client.instagram" target="_blank"
                                    class="d-inline-block fs-md-15 fs-lg-16 text-muted text-decoration-none">
                                    {{ client.instagram }}
                                </a>
                            </li>
                            <li class="position-relative">
                                <div class="icon text-primary rounded-circle text-center">
                                    <i class="ph-bold ph-tiktok-logo lh-1 fs-md-18"></i>
                                </div>
                                <span class="d-block text-black mb-5 fw-semibold">Tiktok</span>
                                <a :href="client.tiktok" target="_blank"
                                    class="d-inline-block fs-md-15 fs-lg-16 text-muted text-decoration-none">
                                    {{ client.tiktok }}
                                </a>
                            </li>
                        </ul>
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
let deleteClient = async () => {
    await Swal.fire({
        title: "Voulez-vous archiver ce client ?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            clientStore
                .delete(client)
                .then(() => {
                    Swal.fire("success", "client archivé avec succès");
                    getClients();
                })
                .catch((err) => {
                    console.log(err);
                });
        }
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
