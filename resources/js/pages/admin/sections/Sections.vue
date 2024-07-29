<template>
    <MainLayout>
        <div v-if="loaded">
            <h4 class="mb-5 mb-sm-0 fw-bold">
                Sections / <span>{{ etapes?.length }}</span>
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
            </div>
            <!-- Button trigger modal -->

            <div
                class="align-center gap-10 sections-wrap pt-2 pb-2"
                v-if="etapes.length > 0"
            >
                <v-data-table
                    :headers="headers"
                    :items="etapes"
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
                                    <div class="etape-img">
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
                                                @click.prevent="setEtape(item)"
                                                data-bs-toggle="modal"
                                                data-bs-target="#basicModal"
                                            >
                                                <i
                                                    class="flaticon-pen lh-1 me-8 position-relative top-1"
                                                ></i>
                                                Edit
                                            </button>
                                        </li>
                                        <li>
                                            <button
                                                class="dropdown-item d-flex align-items-center"
                                                @click.prevent="
                                                    deleteEtape(item)
                                                "
                                            >
                                                <i
                                                    class="flaticon-delete lh-1 me-8 position-relative top-1"
                                                ></i>
                                                Delete
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
                                Edit etape
                            </h1>
                            <h1
                                v-else
                                class="modal-title fs-5"
                                id="addNiveauLabel"
                            >
                                Add Etape
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
                                    v-model="etape.label"
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
                                    >Color</label
                                >
                                <input
                                    id="style1"
                                    v-model="etape.color"
                                    type="color"
                                    class="form-control shadow-none text-black fs-md-15 fs-lg-16"
                                    aria-describedby="TitleHelp"
                                    placeholder="Enter title"
                                />
                            </div>
                            <div class="mb-mb-15 mb-md-20">
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
                                        Drop Files Here Or
                                        <span
                                            class="text-black fw-medium position-relative"
                                        >
                                            Click To Upload
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
                            <Errors v-if="errors" :errors="errors"></Errors>
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
                                @click="updateEtape()"
                                class="btn btn-primary"
                            >
                                Update etape
                            </button>
                            <button
                                v-else
                                type="button"
                                @click="saveEtape()"
                                class="btn btn-primary"
                            >
                                Save etape
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

// lifecycle
onMounted(async () => {
    // await getEtapes();
    // imageUrl.value = store.state.defaultImageInput;
    loaded.value = true;
});

// vars
let etapes = ref([
    {
        label: "section 1",
        alias: "section 1",
        color: "#000",
        iamge: "",
    },
    {
        label: "section 2",
        alias: "section 2",
        color: "#000",
        iamge: "",
    },
]);
let errors = ref([]);
let etape = ref({
    id: "",
    label: "",
    alias: "",
    color: "",
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
        title: "Title",
    },
    {
        align: "center",
        key: "image",
        sortable: true,
        title: "Icon",
    },
    { align: "end", key: "actions", title: "Actions" },
]);

// funcs
// let getEtapes = async () => {
//     await store
//         .dispatch("etapeModule/getEtapes")
//         .then((res) => {
//             etapes.value = store.state.etapeModule.etapes;
//         })
//         .catch((err) => {
//             console.log(err);
//         });
// };
// let updateEtape = async () => {
//     await store
//         .dispatch("etapeModule/updateEtape", etape.value)
//         .then(() => {
//             initialize();
//             Swal.fire("Success", "etape updates with success", "");
//             closeBtn.value.click();
//             getEtapes();
//         })
//         .catch((err) => {
//             errors.value = [];
//             errors.value.push(err.response.data.msg);
//         });
// };
// let saveEtape = async () => {
//     await store
//         .dispatch("etapeModule/saveEtape", etape.value)
//         .then(() => {
//             initialize();
//             Swal.fire("Success", "etape save with success", "");
//             closeBtn.value.click();
//             getEtapes();
//         })
//         .catch((err) => {
//             errors.value = [];
//             errors.value.push(err.response.data.msg);
//         });
// };
// let deleteEtape = async (et) => {
//     await Swal.fire({
//         title: "Do you want to delete this etape?",
//         showDenyButton: true,
//         showCancelButton: true,
//         confirmButtonText: "Yes",
//     }).then((result) => {
//         if (result.isConfirmed) {
//             store
//                 .dispatch("etapeModule/deleteEtape", et)
//                 .then(() => {
//                     Swal.fire("success", "etape delete with succes");
//                     getEtapes();
//                 })
//                 .catch((err) => {
//                     console.log(err);
//                 });
//         }
//     });
// };
// let initialize = () => {
//     errors.value = [];
//     etape.value = {
//         id: "",
//         label: "",
//         alias: "",
//     };
//     isEdit.value = false;
//     imageUrl.value = store.state.defaultImageInput;
// };
// let setEtape = (com) => {
//     etape.value = com;
//     isEdit.value = true;
//     imageUrl.value = etape.value.image;
// };

// let handleFileChange = (event) => {
//     const input = event.target;
//     etape.value.image = input.files?.[0] || null;
//     previewImage();
// };
// let previewImage = () => {
//     if (etape.value.image) {
//         const reader = new FileReader();
//         reader.onload = (event) => {
//             imageUrl.value = event.target?.result;
//         };
//         reader.readAsDataURL(etape.value.image);
//     } else {
//         imageUrl.value = "";
//     }
// };
</script>

<style scoped>
.btn-edit,
.btn-delete {
    padding: 2px;
    font-size: 13px;
}
.etape-img {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 50px;
    height: 50px;
    padding: 5px;
    margin: auto;
}
.etape-img img {
    width: 100%;
    height: 100%;
    object-fit: contain;
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
