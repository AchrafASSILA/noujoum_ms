<template>
    <MainLayout>
        <div v-if="loaded">
            <h4 class="mb-5 mb-sm-0 fw-bold">
                Encaissements/ <span>{{ encaissements?.length }}</span>
            </h4>

            <div class="card p-4 mt-3">
                <div class="d-flex text-right justify-content-end">
                    <div
                        class="input-group search-box"
                        style="margin-right: 10px"
                    >
                        <input
                            type="text"
                            class="form-control shadow-none rounded-0 border-0 mr-1"
                            style="background-color: #f5f4fa"
                            placeholder="Search here"
                            v-model="search"
                        />
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->

            <div
                class="align-center gap-10 sections-wrap pt-2 pb-2"
                v-if="encaissements && encaissements.length > 0"
            >
                <v-data-table
                    :headers="headers"
                    :items="encaissements"
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
                            <th
                                class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0"
                            >
                                <div
                                    class="form-check d-flex align-items-center mb-0 justify-content-center p-0"
                                >
                                    {{ item.amount }}
                                </div>
                            </th>
                            <th
                                class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0"
                            >
                                <div
                                    class="form-check d-flex align-items-center mb-0 justify-content-center p-0"
                                >
                                    {{ item.recunumber }}
                                </div>
                            </th>
                            <th
                                class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0 justify-content-center"
                            >
                                <div
                                    class="form-check d-flex align-items-center mb-0 justify-content-center p-0"
                                >
                                    {{ item.mode }}
                                </div>
                            </th>
                            <th
                                class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0 justify-content-center"
                            >
                                <div
                                    class="form-check d-flex align-items-center mb-0 justify-content-center p-0"
                                >
                                    {{ item.canceled ? item.canceled : "non" }}
                                </div>
                            </th>

                            <td
                                class="shadow-none lh-1 fw-medium text-body-tertiary text-end pe-0"
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
                                            <!-- @click.prevent="setModule(item)" -->
                                            <button
                                                v-if="false"
                                                class="dropdown-item d-flex align-items-center"
                                                data-bs-toggle="modal"
                                                data-bs-target="#basicModal"
                                            >
                                                <i
                                                    class="flaticon-eye lh-1 me-8 position-relative top-1"
                                                ></i>
                                                voir
                                            </button>
                                        </li>
                                        <li>
                                            <!-- @click.prevent="setModule(item)" -->
                                            <a
                                                target="_blank"
                                                :href="
                                                    '/impressions-encaissement-recu/' +
                                                    item.id
                                                "
                                                class="dropdown-item d-flex align-items-center"
                                            >
                                                <i
                                                    class="flaticon-printing lh-1 me-8 position-relative top-1"
                                                ></i>
                                                imprimer
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </template>
                </v-data-table>
            </div>

            <Emptybox v-else></Emptybox>
            <!-- Modal -->

            <!-- <div
                class="modal fade"
                id="basicModal"
                tabindex="-1"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 v-if="isEdit" class="modal-title fs-5">
                                Edit Module
                            </h1>
                            <h1
                                v-else
                                class="modal-title fs-5"
                                id="addNiveauLabel"
                            >
                                Add Module
                            </h1>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-mb-15 mb-md-20">
                                <label
                                    for="inputTitle"
                                    class="form-label fw-medium"
                                    >Title</label
                                >
                                <input
                                    v-model="module.label"
                                    type="text"
                                    class="form-control shadow-none text-black fs-md-15 fs-lg-16"
                                    id="inputTitle"
                                    aria-describedby="TitleHelp"
                                    placeholder="Enter title"
                                />
                            </div>
                            <div class="mb-mb-15 mb-md-20">
                                <label
                                    for="inputTitle"
                                    class="form-label fw-medium"
                                    >Section</label
                                >
                                <VueMultiselect
                                    v-model="module.section"
                                    :options="sections"
                                    :multiple="false"
                                    :close-on-select="true"
                                    label="label"
                                    track-by="id"
                                    placeholder="Choisissez une section"
                                    value="id"
                                >
                                    <template #noResult>
                                        Oops! No elements found. Consider
                                        changing the search query.
                                    </template>
                                </VueMultiselect>
                            </div>
                            <Errors></Errors>
                        </div>

                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                                ref="closeBtn"
                            >
                                Close
                            </button>
                            <button
                                v-if="isEdit"
                                type="button"
                                @click="updateModule()"
                                class="btn btn-primary"
                            >
                                Update module
                            </button>
                            <button
                                v-else
                                type="button"
                                @click="saveModule()"
                                class="btn btn-primary"
                            >
                                Save module
                            </button>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <Loader v-else></Loader>
    </MainLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
<script setup>
import { ref, onMounted } from "vue";
import MainLayout from "../../../layouts/MainLayout.vue";
import Swal from "sweetalert2";
import Emptybox from "../../../Components/ui/EmptyBox.vue";
import Errors from "../../../Components/ui/Errors.vue";
import Loader from "../../../Components/ui/Loader.vue";
import { useErrorStore } from "../../../store/error";

import VueMultiselect from "vue-multiselect";
import { useEncaissementStore } from "../../../store/encaissement";

// lifecycle
onMounted(async () => {
    await getEncaissements();
    imageUrl.value =
        "https://www.eclosio.ong/wp-content/uploads/2018/08/default.png";
    loaded.value = true;
});

// vars
let encaissements = ref([]);
let errors = ref([]);

let isEdit = ref(false);
let loaded = ref(false);
let closeBtn = ref("");

let search = ref("");
let imageUrl = ref("");

let headers = ref([
    {
        align: "center",
        key: "name",
        sortable: true,
        title: "Client",
    },
    {
        align: "center",
        key: "amount",
        sortable: true,
        title: "Montant",
    },
    {
        align: "center",
        key: "recunumber",
        sortable: true,
        title: "Numero du recu",
    },
    {
        align: "center",
        key: "mode",
        sortable: true,
        title: "Mode de paiement",
    },
    {
        align: "center",
        key: "canceled",
        sortable: true,
        title: "Canceled",
    },
    { align: "end", key: "actions", title: "Actions" },
]);
// stores
const encaissementStore = useEncaissementStore();
const errorStore = useErrorStore();
// funcs
let getEncaissements = async () => {
    await encaissementStore
        .getEncaissements()
        .then((res) => {
            encaissements.value = encaissementStore.encaissements;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};

// let deleteModule = async (sec) => {
//     await Swal.fire({
//         title: "Do you want to delete this module?",
//         showDenyButton: true,
//         showCancelButton: true,
//         confirmButtonText: "Yes",
//     }).then((result) => {
//         if (result.isConfirmed) {
//             moduleStore
//                 .delete(sec)
//                 .then(() => {
//                     Swal.fire("success", "module delete with succes");
//                     getModules();
//                 })
//                 .catch((err) => {
//                     console.log(err);
//                 });
//         }
//     });
// };

// let setEncaissement = (mod) => {
//     module.value = mod;
//     console.log(module.value);
//     isEdit.value = true;
// };
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
    height: 70px;
    margin: 5px;
    margin-left: auto;
    margin-right: auto;
    overflow: hidden;
    border-radius: 5px;
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
</style>
