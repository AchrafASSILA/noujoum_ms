<template>
    <MainLayout v-if="loaded">
        <div class="card mb-25 border-0 rounded-0 bg-white add-user-card">
            <div class="card-body p-15 p-sm-20 p-md-25 p-lg-30 letter-spacing">
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                <label
                                    class="d-block text-black fw-semibold mb-10"
                                >
                                    Titre
                                </label>
                                <input
                                    type="text"
                                    class="form-control shadow-none rounded-0 text-black"
                                    placeholder="Noujoum centre"
                                    v-model="config.title"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                <label
                                    class="d-block text-black fw-semibold mb-10"
                                >
                                    Email Address
                                </label>
                                <input
                                    type="email"
                                    class="form-control shadow-none rounded-0 text-black"
                                    placeholder="e.g. noujoum@gmail.com"
                                    v-model="config.email"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                <label
                                    class="d-block text-black fw-semibold mb-10"
                                >
                                    Téléphone
                                </label>
                                <input
                                    type="text"
                                    class="form-control shadow-none rounded-0 text-black"
                                    placeholder="e.g. +212 645142036"
                                    v-model="config.tel"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                <label
                                    class="d-block text-black fw-semibold mb-10"
                                >
                                    Address
                                </label>
                                <input
                                    type="passowrd"
                                    class="form-control shadow-none rounded-0 text-black"
                                    placeholder="Adress"
                                    v-model="config.adress"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                <label
                                    class="d-block text-black fw-semibold mb-10"
                                >
                                    Website
                                </label>
                                <input
                                    type="passowrd"
                                    class="form-control shadow-none rounded-0 text-black"
                                    placeholder="www.example.com"
                                    v-model="config.website"
                                />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div
                                class="file-upload text-center position-relative"
                            >
                                <img
                                    :src="imageUrl"
                                    width="150px"
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
                        <div class="col-md-12 mt-3">
                            <div
                                class="d-flex align-items-center justify-content-between"
                            >
                                <button
                                    class="default-btn transition border-0 fw-medium text-white pt-10 pb-10 ps-25 pe-25 pt-md-11 pb-md-11 ps-md-35 pe-md-35 rounded-1 fs-md-15 fs-lg-16 bg-success"
                                    type="submit"
                                    style="background-color: #06b48a !important"
                                    @click.prevent="saveConfig()"
                                >
                                    enregistrer
                                </button>
                                <router-link
                                    :to="'/clients'"
                                    type="button"
                                    class="bg-transparent p-0 border-0 text-danger lh-1 fw-medium"
                                >
                                    <span class="position-relative"
                                        >Cancel</span
                                    >
                                </router-link>
                            </div>
                        </div>
                        <Errors></Errors>
                    </div>
                </form>
            </div>
        </div>
    </MainLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<script setup>
import { ref, onMounted } from "vue";
import MainLayout from "../../../layouts/MainLayout.vue";
import Swal from "sweetalert2";
import Errors from "../../../Components/ui/Errors.vue";
import { useErrorStore } from "../../../store/error";
import { useConfigStore } from "../../../store/config";

// lifecycle
onMounted(async () => {
    await getConfigs();
    imageUrl.value = config.value.image;
    loaded.value = true;
});

// vars

let config = ref({
    title: "",
    tel: "",
    adress: "",
    email: "",
    website: "",
    image: "",
});
let loaded = ref(false);
let imageUrl = ref("");

// stores

const configStore = useConfigStore();
const errorStore = useErrorStore();

// funcs

let getConfigs = async () => {
    await configStore
        .getConfig()
        .then(() => {
            config.value = configStore.config;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response?.data?.msg);
        });
};
let saveConfig = async () => {
    await configStore
        .save(config.value)
        .then((res) => {
            localStorage.removeItem("APPNAME");
            localStorage.removeItem("LOGO");
            localStorage.setItem("APPNAME", configStore.config.title);
            localStorage.setItem("LOGO", configStore.config.image);
            Swal.fire("Succès", "mises à jour avec succès", "");
            errorStore.errors = [];
            location.reload();
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};

let handleFileChange = (event) => {
    const input = event.target;
    config.value.image = input.files?.[0] || null;
    previewImage();
};
let previewImage = () => {
    if (config.value.image) {
        const reader = new FileReader();
        reader.onload = (event) => {
            imageUrl.value = event.target?.result;
        };
        reader.readAsDataURL(config.value.image);
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
