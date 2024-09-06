<template>
    <MainLayout>
        <div v-if="loaded">
            <h4 class="mb-5 mb-sm-0 fw-bold">
                Les services / <span>{{ services?.length }}</span>
            </h4>
            <div
                class="card mb-25 border-0 rounded-0 bg-white letter-spacing mt-2"
            >
                <div
                    class="card-head box-shadow bg-white d-lg-flex align-items-center justify-content-end p-20 p-md-25 p-lg-30"
                >
                    <div class="d-sm-flex align-items-center">
                        <div
                            class="d-flex align-items-center mt-12 mt-lg-0 position-relative me-15 pr-1 pl-2"
                            style="
                                padding: 0 10px;
                                background: #f5f4fa;
                                height: 43px;
                                border-radius: 5px;
                            "
                        >
                            <input
                                v-model="search"
                                style="height: 43px"
                                type="text"
                                class="form-control shadow-none text-black rounded-0 border-0 quizz-search"
                                placeholder="Rechercher"
                            />
                            <button
                                type="submit"
                                class="bg-transparent text-primary transition p-0 border-0"
                            >
                                <i class="flaticon-search-interface-symbol"></i>
                            </button>
                        </div>

                        <button
                            @click="initialize()"
                            data-bs-toggle="modal"
                            data-bs-target="#basicModal"
                            class="default-btn text-nowrap position-relative ms-sm-10 transition border-0 fw-medium text-white pt-11 pb-11 ps-25 pe-25 pt-md-11 pb-md-11 ps-md-30 pe-md-30 rounded-1 bg-success fs-md-15 fs-lg-16 d-inline-block d-inline-block text-decoration-none"
                            style="
                                background-color: #06b48a !important;
                                margin: 0 !important;
                                height: 43px;
                            "
                        >
                            Nouveau service
                            <i
                                class="flaticon-plus position-relative ms-5 fs-12"
                            ></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- <div class="card p-4 mt-3">
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

                    <button
                        type="button"
                        class="btn btn-primary rounded-0"
                        @click="initialize()"
                        data-bs-toggle="modal"
                        data-bs-target="#basicModal"
                    >
                        <i
                            class="flaticon flaticon-plus fs-30 lh-1 position-relative top-2"
                        ></i>
                    </button>
                </div>
            </div> -->
            <!-- Button trigger modal -->

            <div
                class="align-center gap-10 sections-wrap pt-2 pb-2"
                v-if="services && services.length > 0"
            >
                <v-data-table
                    :headers="headers"
                    :items="services"
                    item-value="name"
                    :search="search"
                >
                    <template v-slot:item="{ item }">
                        <tr>
                            <th
                                class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0 text-center"
                            >
                                <div
                                    class="form-check d-flex align-items-center justify-content-center mb-0 text-center"
                                >
                                    {{ item.label }}
                                </div>
                            </th>
                            <th
                                class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0"
                            >
                                <div
                                    class="form-check d-flex align-items-center justify-content-center mb-0 p-0"
                                >
                                    <div class="section-img">
                                        <img :src="item.image" alt="" />
                                    </div>
                                </div>
                            </th>
                            <th class="lh-1 fw-medium text-center ps-2">
                                <span
                                    class="text-center"
                                    style="color: #33a570c9"
                                    >{{ item.priceLabel }}</span
                                >
                            </th>
                            <th
                                class="shadow-none lh-1 fw-medium text-center ps-2"
                            >
                                <span class="text-outline-grey text-center">{{
                                    item.section.label
                                }}</span>
                            </th>
                            <th
                                class="shadow-none lh-1 fw-medium text-center ps-2"
                            >
                                <span class="text-outline-grey text-center">
                                    {{ item.frequenc }}
                                </span>
                            </th>
                            <th
                                class="shadow-none lh-1 fw-medium text-center ps-2"
                            >
                                <span
                                    class="badge text-center"
                                    :class="item.enabledClass"
                                    >{{ item.enabledLabel }}</span
                                >
                            </th>
                            <th
                                class="shadow-none lh-1 fw-medium text-center ps-2"
                            >
                                <span
                                    class="badge text-center"
                                    :class="item.obligationClass"
                                    >{{ item.obligationLabel }}</span
                                >
                            </th>

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
                                                    setService(item)
                                                "
                                                data-bs-toggle="modal"
                                                data-bs-target="#basicModal"
                                            >
                                                <i
                                                    class="flaticon-pen lh-1 me-8 position-relative top-1"
                                                ></i>
                                                Modifier
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
                                Éditer le service {{ service.label }}
                            </h1>
                            <h1
                                v-else
                                class="modal-title fs-5"
                                id="addNiveauLabel"
                            >
                                Ajouter nouveau service
                            </h1>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-mb-15 mb-md-20">
                                        <label
                                            for="inputTitle"
                                            class="form-label fw-medium"
                                            >Titre</label
                                        >
                                        <input
                                            v-model="service.label"
                                            type="text"
                                            class="form-control shadow-none text-black fs-md-15 fs-lg-16"
                                            id="inputTitle"
                                            aria-describedby="TitleHelp"
                                            placeholder="Entrer le titre"
                                        />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-mb-15 mb-md-20">
                                        <label
                                            for="inputTitle"
                                            class="form-label fw-medium"
                                            >Fréquence</label
                                        >
                                        <VueMultiselect
                                            v-model="service.frequenc"
                                            :options="[
                                                'Mensuel',
                                                'Trimestriel',
                                                'Annuel',
                                                'Heure',
                                                'GroupementEntreprise',
                                            ]"
                                            :multiple="false"
                                            :close-on-select="true"
                                            placeholder="Choisissez fréquence"
                                        >
                                        </VueMultiselect>
                                        <!-- @select="showCalucalation()" -->
                                    </div>
                                </div>
                            </div>
                            <div class="mb-mb-15 mb-md-20">
                                <label
                                    for="inputTitle"
                                    class="form-label fw-medium"
                                    >Section</label
                                >
                                <VueMultiselect
                                    v-model="service.section"
                                    :options="sections"
                                    :multiple="false"
                                    :close-on-select="true"
                                    placeholder="Choisissez la section"
                                    label="label"
                                    value="id"
                                    track-by="id"
                                >
                                </VueMultiselect>
                            </div>

                            <div class="mb-mb-15 mb-md-20">
                                <label
                                    for="inputTitle"
                                    class="form-label fw-medium"
                                    >Le prix</label
                                >
                                <input
                                    v-model="service.price"
                                    type="number"
                                    class="form-control shadow-none text-black fs-md-15 fs-lg-16"
                                    id="inputTitle"
                                    aria-describedby="TitleHelp"
                                    placeholder="Entrer le prix"
                                />
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-mb-15 mb-md-20">
                                        <label
                                            for="inputTitle"
                                            class="form-label fw-medium"
                                            >Status (activer ou désactiver le
                                            service)</label
                                        >
                                        <v-switch
                                            inset
                                            color="success"
                                            label="Active"
                                            v-model="service.enabled"
                                        ></v-switch>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-mb-15 mb-md-20">
                                        <label
                                            for="inputTitle"
                                            class="form-label fw-medium"
                                            >Obligation</label
                                        >
                                        <v-switch
                                            inset
                                            color="success"
                                            label="Obligation"
                                            v-model="service.obligation"
                                        ></v-switch>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-mb-15 mb-md-20 mt-2">
                                <div
                                    class="file-upload text-center position-relative"
                                >
                                    <img
                                        width="150px"
                                        :src="imageUrl"
                                        alt="Uploaded Image"
                                        class="preview-image"
                                    />
                                    <span class="d-block text-muted">
                                        Déposez les fichiers ici ou
                                        <span
                                            class="text-black fw-medium position-relative"
                                        >
                                            Cliquez pour télécharger
                                        </span>
                                    </span>
                                    <input
                                        type="file"
                                        class="d-block shadow-none border-0 position-absolute start-0 end-0 top-0 bottom-0 z-1 opacity-0"
                                        ref="fileInput"
                                        @change="handleFileChange"
                                    />
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
                                Fermer
                            </button>
                            <button
                                v-if="isEdit"
                                type="button"
                                @click="updateService()"
                                class="btn btn-primary"
                            >
                                Modifier
                            </button>
                            <button
                                v-else
                                type="button"
                                @click="saveService()"
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
import { useErrorStore } from "../../../store/error";
import { useServiceStore } from "../../../store/service";
import { useSectionStore } from "../../../store/section";
import VueMultiselect from "vue-multiselect";

// lifecycle
onMounted(async () => {
    await getServices();
    await getSections();
    imageUrl.value =
        "https://www.eclosio.ong/wp-content/uploads/2018/08/default.png";
    loaded.value = true;
});

// vars
let services = ref([]);
let sections = ref([]);
let errors = ref([]);
let service = ref({
    id: "",
    label: "",
    price: 0,
    enabled: true,
    obligation: false,
    section: 0,
    frequenc: "",
    alias: "",
    image: "",
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
        key: "image",
        sortable: true,
        title: "Icon",
    },
    {
        align: "center",
        key: "price",
        sortable: true,
        title: "Prix",
    },
    {
        align: "center",
        key: "section",
        sortable: true,
        title: "Section",
    },
    {
        align: "center",
        key: "frequenc",
        sortable: true,
        title: "Frequence",
    },
    {
        align: "center",
        key: "enabled",
        sortable: true,
        title: "Status",
    },
    {
        align: "center",
        key: "obligation",
        sortable: true,
        title: "Required",
    },
    { align: "center", key: "actions", title: "Actions" },
]);
// stores
const serviceStore = useServiceStore();
const sectionStore = useSectionStore();
const errorStore = useErrorStore();
// funcs
let getServices = async () => {
    await serviceStore
        .getSections()
        .then((res) => {
            services.value = serviceStore.services;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let getSections = async () => {
    await sectionStore
        .getSections()
        .then((res) => {
            sections.value = sectionStore.sections;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response?.data?.msg);
        });
};
let updateService = async () => {
    await serviceStore
        .update(service.value)
        .then(() => {
            initialize();
            Swal.fire("Succès", "service mises à jour avec succès", "");
            closeBtn.value.click();
            errorStore.errors = [];
            getServices();
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let saveService = async () => {
    await serviceStore
        .save(service.value)
        .then(() => {
            initialize();
            Swal.fire("Succès", "service enregistré avec succès", "");
            closeBtn.value.click();
            getServices();
            errorStore.errors = [];
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
// let deleteSection = async (sec) => {
//     await Swal.fire({
//         title: "Do you want to delete this section?",
//         showDenyButton: true,
//         showCancelButton: true,
//         confirmButtonText: "Yes",
//     }).then((result) => {
//         if (result.isConfirmed) {
//             serviceStore
//                 .delete(sec)
//                 .then(() => {
//                     Swal.fire("success", "sections delete with succes");
//                     getSections();
//                 })
//                 .catch((err) => {
//                     console.log(err);
//                 });
//         }
//     });
// };
let initialize = () => {
    errors.value = [];
    service.value = {
        id: "",
        label: "",
        price: 0,
        enabled: true,
        obligation: false,
        section: 0,
        frequenc: "",
        alias: "",
        image: "",
    };
    errorStore.errors = [];
    isEdit.value = false;
    imageUrl.value =
        "https://www.eclosio.ong/wp-content/uploads/2018/08/default.png";
};
let setService = (serv) => {
    service.value = serv;
    isEdit.value = true;
    imageUrl.value = serv.image;
};

let handleFileChange = (event) => {
    const input = event.target;
    service.value.image = input.files?.[0] || null;
    previewImage();
};
let previewImage = () => {
    if (service.value.image) {
        const reader = new FileReader();
        reader.onload = (event) => {
            imageUrl.value = event.target?.result;
        };
        reader.readAsDataURL(service.value.image);
    } else {
        imageUrl.value = "";
    }
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
