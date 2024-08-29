<template>
    <MainLayout>
        <div v-if="loaded">
            <h4 class="mb-5 mb-sm-0 fw-bold">
                Les modules/ <span>{{ modules?.length }}</span>
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
                            Nouveau module
                            <i
                                class="flaticon-plus position-relative ms-5 fs-12"
                            ></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->

            <div
                class="align-center gap-10 sections-wrap pt-2 pb-2"
                v-if="modules && modules.length > 0"
            >
                <v-data-table
                    :headers="headers"
                    :items="modules"
                    item-value="name"
                    :search="search"
                >
                    <template v-slot:item="{ item }">
                        <tr>
                            <th
                                class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0"
                            >
                                <div
                                    class="form-check d-flex align-items-center mb-0 justify-content-center p-0"
                                >
                                    {{ item.label }}
                                </div>
                            </th>
                            <th
                                class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0 justify-content-center"
                            >
                                <div
                                    class="form-check d-flex align-items-center mb-0 justify-content-center p-0"
                                >
                                    {{ item.sectionLabel }}
                                </div>
                            </th>
                            <th
                                class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0 justify-content-center"
                            >
                                <div
                                    class="color-block-span"
                                    :style="'background-color:' + item.color"
                                ></div>
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
                                            <button
                                                class="dropdown-item d-flex align-items-center"
                                                @click.prevent="setModule(item)"
                                                data-bs-toggle="modal"
                                                data-bs-target="#basicModal"
                                            >
                                                <i
                                                    class="flaticon-pen lh-1 me-8 position-relative top-1"
                                                ></i>
                                                modifier
                                            </button>
                                        </li>
                                        <li>
                                            <button
                                                class="dropdown-item d-flex align-items-center"
                                                @click.prevent="
                                                    deleteModule(item)
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
            <!-- Modal -->

            <div
                class="modal fade"
                id="basicModal"
                tabindex="-1"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 v-if="isEdit" class="modal-title fs-5">
                                Éditer {{ module.label }}
                            </h1>
                            <h1
                                v-else
                                class="modal-title fs-5"
                                id="addNiveauLabel"
                            >
                                Nouveau module
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
                                    >Titre</label
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
                                    >Pôle</label
                                >
                                <VueMultiselect
                                    v-model="module.section"
                                    :options="sections"
                                    :multiple="false"
                                    :close-on-select="true"
                                    label="label"
                                    track-by="id"
                                    placeholder="Choisissez un pôle"
                                    value="id"
                                >
                                    <template #noResult>
                                        Oops! No elements found. Consider
                                        changing the search query.
                                    </template>
                                </VueMultiselect>
                            </div>
                            <div class="mb-mb-15 mb-md-20">
                                <label
                                    for="inputTitle"
                                    class="form-label fw-medium"
                                    >Coleur</label
                                >
                                <div class="d-flex justify-content-center">
                                    <v-color-picker
                                        v-model="module.color"
                                        hide-inputs
                                    ></v-color-picker>
                                </div>
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
                                Fremer
                            </button>
                            <button
                                v-if="isEdit"
                                type="button"
                                @click="updateModule()"
                                class="btn btn-primary"
                            >
                                Modifier
                            </button>
                            <button
                                v-else
                                type="button"
                                @click="saveModule()"
                                class="btn btn-primary"
                            >
                                Enregistrer
                            </button>
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
import Swal from "sweetalert2";
import Emptybox from "../../../Components/ui/EmptyBox.vue";
import Errors from "../../../Components/ui/Errors.vue";
import Loader from "../../../Components/ui/Loader.vue";
import { useSectionStore } from "../../../store/section";
import { useErrorStore } from "../../../store/error";
import { useModuleStore } from "../../../store/module";

import VueMultiselect from "vue-multiselect";

// lifecycle
onMounted(async () => {
    await getModules();
    await getSections();
    imageUrl.value =
        "https://www.eclosio.ong/wp-content/uploads/2018/08/default.png";
    loaded.value = true;
});

// vars
let sections = ref([]);
let modules = ref([]);
let errors = ref([]);
let module = ref({
    id: "",
    label: "",
    color: "",
    section: 0,
});
let isEdit = ref(false);
let loaded = ref(false);
let closeBtn = ref("");

let search = ref("");
let imageUrl = ref("");

let headers = ref([
    {
        align: "center",
        key: "label",
        sortable: true,
        title: "Titre",
    },
    {
        align: "center",
        key: "sectionLabel",
        sortable: true,
        title: "Pôle",
    },
    {
        align: "center",
        key: "color",
        sortable: true,
        title: "Color",
    },
    { align: "end", key: "actions", title: "Actions" },
]);
// stores
const sectionStore = useSectionStore();
const moduleStore = useModuleStore();
const errorStore = useErrorStore();
// funcs
let getSections = async () => {
    await sectionStore
        .getSections()
        .then((res) => {
            sections.value = sectionStore.sections;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let getModules = async () => {
    await moduleStore
        .getModules()
        .then((res) => {
            modules.value = moduleStore.modules;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let updateModule = async () => {
    await moduleStore
        .update(module.value)
        .then(() => {
            initialize();
            Swal.fire("Succès", "Module mises à jour avec succès.", "");
            closeBtn.value.click();
            getModules();
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let saveModule = async () => {
    await moduleStore
        .save(module.value)
        .then(() => {
            initialize();
            Swal.fire("Succès", "Module sauvegardée avec succès", "");
            closeBtn.value.click();
            getModules();
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let deleteModule = async (sec) => {
    await Swal.fire({
        title: "Voulez-vous supprimer ce module?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            moduleStore
                .delete(sec)
                .then(() => {
                    Swal.fire("Succès", "module supprimée avec succès");
                    getModules();
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    });
};
let initialize = () => {
    errors.value = [];
    module.value = {
        id: "",
        label: "",
        color: "",
        section: "",
    };
    isEdit.value = false;
    imageUrl.value =
        "https://www.eclosio.ong/wp-content/uploads/2018/08/default.png";
};
let setModule = (mod) => {
    module.value = mod;
    console.log(module.value);
    isEdit.value = true;
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
.color-block-span {
    width: 40px;
    height: 40px;
    margin: auto;
    border-radius: 5px;
}
</style>
