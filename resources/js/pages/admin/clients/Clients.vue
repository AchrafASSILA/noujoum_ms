<template>
    <MainLayout>
        <div v-if="loaded">
            <div
                class="d-flex"
                style="justify-content: space-between; align-items: center"
            >
                <h4 class="mb-5 mb-sm-0 fw-bold mb-5">
                    Clients / <span>{{ clients?.length }}</span>
                </h4>

                <div class="text-right m-0">
                    <div class="dropdown show mb-20">
                        <button
                            class="btn btn-primary dropdown-toggle dropdown rounded-0"
                            href="#"
                            role="button"
                            id="dropdownMenuLink"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Actions
                        </button>
                        <div
                            class="dropdown-menu mt-2"
                            aria-labelledby="dropdownMenuLink"
                        >
                            <a
                                target="_blank"
                                href="/noujoum/impressions-clients"
                                class="dropdown-item"
                            >
                                <i
                                    class="flaticon-file-1 lh-1 me-8 position-relative top-1"
                                ></i>
                                export pdf
                            </a>
                            <a
                                href="/noujoum/exports-clients"
                                class="dropdown-item"
                            >
                                <i
                                    class="flaticon-file lh-1 me-8 position-relative top-1"
                                ></i>
                                export excel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="card mb-25 border-0 rounded-0 bg-white letter-spacing mt-2"
            >
                <div
                    class="card-head box-shadow bg-white d-lg-flex align-items-center justify-content-between p-15 p-sm-20 p-md-25"
                >
                    <div class="d-sm-flex align-items-center">
                        <router-link
                            class="default-btn position-relative transition border-0 fw-medium text-white pt-11 pb-11 ps-25 pe-25 pt-md-12 pb-md-12 ps-md-30 pe-md-30 rounded-1 bg-success fs-md-15 fs-lg-16 d-inline-block me-10 mb-10 mb-lg-0 text-decoration-none"
                            to="/new-client"
                            style="background-color: #06b48a !important"
                        >
                            Nouveau client
                            <i
                                class="flaticon-plus position-relative ms-5 fs-12"
                            ></i>
                        </router-link>
                    </div>
                    <div class="d-flex align-items-center">
                        <form
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
                    </div>
                </div>
                <div class="card-body p-15 p-sm-20 p-md-25">
                    <div
                        class="align-center gap-10 sections-wrap pt-2 pb-2"
                        v-if="clients && clients.length > 0"
                    >
                        <v-data-table
                            :headers="headers"
                            :items="clients"
                            item-value="name"
                            :search="search"
                        >
                            <template v-slot:item="{ item }">
                                <tr>
                                    <th
                                        class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0 text-center"
                                    >
                                        <a
                                            :href="'/noujoum/client/' + item.id"
                                            class="link text-center"
                                            style="
                                                color: black;
                                                text-decoration: none;
                                            "
                                        >
                                            <div
                                                class="ms-5 fs-md-15 fs-lg-16 text-center"
                                            >
                                                <img
                                                    :src="item.image"
                                                    class="rounded-circle me-8"
                                                    style="
                                                        width: 50px;
                                                        height: 50px;
                                                        object-fit: cover;
                                                    "
                                                    alt="user"
                                                />
                                                {{ item.name }}
                                            </div>
                                        </a>
                                    </th>

                                    <td
                                        class="shadow-none lh-1 fw-medium text-primary text-center"
                                    >
                                        {{ item.email }}
                                    </td>
                                    <td
                                        class="shadow-none lh-1 fw-medium text-black-emphasis text-center"
                                    >
                                        {{ item.tel }}
                                    </td>
                                    <td
                                        class="shadow-none lh-1 fw-medium text-muted text-center"
                                    >
                                        {{ item.handicapLabel }}
                                    </td>

                                    <td
                                        class="shadow-none lh-1 fw-medium text-body-tertiary text-end pe-0 text-center"
                                    >
                                        <div class="dropdown">
                                            <button
                                                class="dropdown-toggle lh-1 bg-transparent border-0 shadow-none p-0 transition"
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
                                                        :href="
                                                            '/noujoum/client/' +
                                                            item.id
                                                        "
                                                    >
                                                        <i
                                                            class="flaticon-view lh-1 me-8 position-relative top-1"
                                                        ></i>
                                                        voir
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        class="dropdown-item d-flex align-items-center"
                                                        :href="
                                                            '/noujoum/edit-client/' +
                                                            item.id
                                                        "
                                                    >
                                                        <i
                                                            class="flaticon-pen lh-1 me-8 position-relative top-1"
                                                        ></i>
                                                        modifier
                                                    </a>
                                                </li>
                                                <li>
                                                    <button
                                                        class="dropdown-item d-flex align-items-center"
                                                        @click.prevent="
                                                            deleteClient(item)
                                                        "
                                                    >
                                                        <i
                                                            class="flaticon-delete lh-1 me-8 position-relative top-1"
                                                        ></i>
                                                        supprimer
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </v-data-table>
                    </div>
                    <Emptybox v-else></Emptybox>
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
import Swal from "sweetalert2";

// lifecycle
onMounted(async () => {
    await getClients();
    loaded.value = true;
});

// vars
let clients = ref([]);
// let sections = ref([]);

let loaded = ref(false);

let search = ref("");
let imageUrl = ref("");

let headers = ref([
    {
        align: "center",
        key: "label",
        sortable: true,
        title: "Nom et prénom",
    },

    {
        align: "center",
        key: "email",
        sortable: true,
        title: "émail",
    },
    {
        align: "center",
        key: "tel",
        sortable: true,
        title: "Téléphone",
    },
    {
        align: "center",
        key: "handicap",
        sortable: true,
        title: "Handicap",
    },

    { align: "center", key: "actions", title: "Actions" },
]);
// stores
const clientStore = useClientStore();
const errorStore = useErrorStore();
// funcs
let getClients = async () => {
    await clientStore
        .getClients()
        .then((res) => {
            clients.value = clientStore.clients;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let deleteClient = async (client) => {
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
                    Swal.fire("Succès", "client archivé avec succès");
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
.dropdown-toggle::after {
    opacity: 1;
}
td .dropdown-toggle::after {
    opacity: 0;
}
</style>
