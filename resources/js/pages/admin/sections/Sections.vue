<template>
    <MainLayout>
        <div v-if="loaded">
            <h4 class="mb-5 mb-sm-0 fw-bold">
                Les sections / <span>{{ sections?.length }}</span>
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
                            Nouvelle section
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
                v-if="sections && sections.length > 0"
            >
                <v-data-table
                    :headers="headers"
                    :items="sections"
                    item-value="name"
                    :search="search"
                >
                    <template v-slot:item="{ item }">
                        <tr :style="'border-bottom:2px solid ' + item.color">
                            <th
                                class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0"
                            >
                                <div
                                    class="form-check d-flex align-items-center mb-0"
                                >
                                    {{ item.label }}
                                </div>
                            </th>
                            <th
                                class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0"
                            >
                                <div
                                    class="form-check d-flex align-items-center mb-0"
                                >
                                    {{ item.activeLabel }}
                                </div>
                            </th>
                            <th
                                class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0"
                            >
                                <div
                                    class="form-check d-flex align-items-center mb-0"
                                >
                                    <div class="section-img">
                                        <img :src="item.image" alt="" />
                                    </div>
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
                                            <button
                                                class="dropdown-item d-flex align-items-center"
                                                @click.prevent="
                                                    setSection(item)
                                                "
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
                                                    deleteSection(item)
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
                                Éditer {{ section.label }}
                            </h1>
                            <h1
                                v-else
                                class="modal-title fs-5"
                                id="addNiveauLabel"
                            >
                                Nouvelle section
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
                                    v-model="section.label"
                                    type="text"
                                    class="form-control shadow-none text-black fs-md-15 fs-lg-16"
                                    id="inputTitle"
                                    aria-describedby="TitleHelp"
                                    placeholder="Entrer titre"
                                />
                            </div>
                            <div class="mb-mb-15 mb-md-20">
                                <label
                                    for="inputTitle"
                                    class="form-label fw-medium"
                                    >Active</label
                                >
                                <v-switch
                                    inset
                                    color="success"
                                    label="Active"
                                    v-model="section.active"
                                ></v-switch>
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
                                @click="updateSection()"
                                class="btn btn-primary"
                            >
                                Modifier
                            </button>
                            <button
                                v-else
                                type="button"
                                @click="saveSection()"
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

<script setup>
import { ref, onMounted } from "vue";
import MainLayout from "../../../layouts/MainLayout.vue";
import Swal from "sweetalert2";
import Emptybox from "../../../Components/ui/EmptyBox.vue";
import Errors from "../../../Components/ui/Errors.vue";
import Loader from "../../../Components/ui/Loader.vue";
import { useSectionStore } from "../../../store/section";
import { useErrorStore } from "../../../store/error";

// lifecycle
onMounted(async () => {
    await getSections();
    imageUrl.value =
        "https://www.eclosio.ong/wp-content/uploads/2018/08/default.png";
    loaded.value = true;
});

// vars
let sections = ref([]);
let errors = ref([]);
let section = ref({
    id: "",
    label: "",
    alias: "",
    active: true,
    image: "",
});
let isEdit = ref(false);
let loaded = ref(false);
let closeBtn = ref("");

let search = ref("");
let imageUrl = ref("");

let headers = ref([
    {
        align: "start",
        key: "label",
        sortable: true,
        title: "Titre",
    },
    {
        align: "start",
        key: "active",
        sortable: true,
        title: "Active",
    },
    {
        align: "center",
        key: "image",
        sortable: true,
        title: "Icon",
    },
    { align: "end", key: "actions", title: "Actions" },
]);
// stores
const sectionStore = useSectionStore();
const errorStore = useErrorStore();
// funcs
let getSections = async () => {
    await sectionStore
        .getSections()
        .then((res) => {
            sections.value = sectionStore.sections;
        })
        .catch((err) => {
            console.log("hello");
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let updateSection = async () => {
    await sectionStore
        .update(section.value)
        .then(() => {
            initialize();
            Swal.fire("Success", "Section mises à jour avec succès", "");
            closeBtn.value.click();
            getSections();
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let saveSection = async () => {
    await sectionStore
        .save(section.value)
        .then(() => {
            initialize();
            Swal.fire("Success", "Section sauvegardée avec succès", "");
            closeBtn.value.click();
            getSections();
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let deleteSection = async (sec) => {
    await Swal.fire({
        title: "Voulez-vous supprimer cette section ?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            sectionStore
                .delete(sec)
                .then(() => {
                    Swal.fire("success", "section supprimée avec succès");
                    getSections();
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    });
};
let initialize = () => {
    errors.value = [];
    section.value = {
        id: "",
        label: "",
        alias: "",
    };
    isEdit.value = false;
    imageUrl.value =
        "https://www.eclosio.ong/wp-content/uploads/2018/08/default.png";
};
let setSection = (sec) => {
    section.value = sec;
    isEdit.value = true;
    imageUrl.value = sec.image;
};

let handleFileChange = (event) => {
    const input = event.target;
    section.value.image = input.files?.[0] || null;
    previewImage();
};
let previewImage = () => {
    if (section.value.image) {
        const reader = new FileReader();
        reader.onload = (event) => {
            imageUrl.value = event.target?.result;
        };
        reader.readAsDataURL(section.value.image);
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
