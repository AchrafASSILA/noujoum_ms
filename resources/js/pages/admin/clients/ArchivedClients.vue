<template>
    <MainLayout>
        <div v-if="loaded">
            <h4 class="mb-5 mb-sm-0 fw-bold mb-5">
                Les clients archivee /
                <span>{{ clients?.length }}</span>
            </h4>
            <div
                class="card mb-25 border-0 rounded-0 bg-white letter-spacing mt-2"
            >
                <div
                    class="card-head box-shadow bg-white d-lg-flex align-items-center justify-content-between p-15 p-sm-20 p-md-25"
                >
                    <div class="d-sm-flex align-items-center">
                        <!-- <button
                            class="default-outline-btn position-relative transition fw-medium text-black pt-10 pb-10 ps-25 pe-25 pt-md-11 pb-md-11 ps-md-30 pe-md-30 rounded-1 bg-transparent fs-md-15 fs-lg-16 d-inline-block mb-10 mb-lg-0"
                            type="button"
                        >
                            Export
                            <i
                                class="flaticon-file-1 position-relative ms-5 top-2 fs-15"
                            ></i>
                        </button> -->
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
                                        <div class="text-center">
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
                                        </div>
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
                                                    <button
                                                        class="dropdown-item d-flex align-items-center"
                                                        @click.prevent="
                                                            unarchivedClient(
                                                                item
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="ph ph-archive-box lh-1 me-8 position-relative top-1"
                                                        ></i>
                                                        unarchiver
                                                    </button>
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
        .getArchivedClients()
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
        title: "Voulez-vous supprimer ce client ?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            clientStore
                .deleteTrached(client)
                .then(() => {
                    Swal.fire("Succès", "client supprimer avec succès");
                    getClients();
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    });
};
let unarchivedClient = async (client) => {
    await Swal.fire({
        title: "Voulez-vous disarchiver ce client ?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            clientStore
                .unarchived(client)
                .then(() => {
                    Swal.fire("Succès", "client disarchiver avec succès");
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
