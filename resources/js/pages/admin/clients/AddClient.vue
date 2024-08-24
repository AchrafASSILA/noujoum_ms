<template>
    <MainLayout>
        <div class="card mb-25 border-0 rounded-0 bg-white add-user-card">
            <div class="card-body p-15 p-sm-20 p-md-25 p-lg-30 letter-spacing">
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                <label
                                    class="d-block text-black fw-semibold mb-10"
                                >
                                    Nom et prénom
                                </label>
                                <input
                                    type="text"
                                    class="form-control shadow-none rounded-0 text-black"
                                    placeholder="Nom et prénom"
                                    v-model="client.name"
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
                                    placeholder="Email Address"
                                    v-model="client.email"
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
                                    placeholder="Téléphone"
                                    v-model="client.tel"
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
                                    placeholder="Address"
                                    v-model="client.adress"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                <label
                                    class="d-block text-black fw-semibold mb-10"
                                >
                                    Date de naissance
                                </label>
                                <input
                                    class="form-select shadow-none fw-semibold rounded-0"
                                    type="date"
                                    v-model="client.birthday"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                <label
                                    class="d-block text-black fw-semibold mb-10"
                                >
                                    CIN
                                </label>
                                <input
                                    type="passowrd"
                                    class="form-control shadow-none rounded-0 text-black"
                                    placeholder="CIN"
                                    v-model="client.cin"
                                />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                <label
                                    class="d-block text-black fw-semibold mb-10"
                                >
                                    Région
                                </label>
                                <VueMultiselect
                                    v-model="client.region"
                                    :options="regionsList"
                                    :multiple="false"
                                    :close-on-select="true"
                                    placeholder="Région"
                                    label="region"
                                    value="region"
                                    track-by="region"
                                >
                                </VueMultiselect>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                <label
                                    class="d-block text-black fw-semibold mb-10"
                                >
                                    Province
                                </label>
                                <input
                                    type="passowrd"
                                    class="form-control shadow-none rounded-0 text-black"
                                    placeholder="Province"
                                    v-model="client.province"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                <label
                                    class="d-block text-black fw-semibold mb-10"
                                >
                                    Ville
                                </label>

                                <VueMultiselect
                                    v-model="client.ville"
                                    :options="citiesList"
                                    :multiple="false"
                                    :close-on-select="true"
                                    placeholder="Région"
                                    label="ville"
                                    value="ville"
                                    track-by="ville"
                                >
                                </VueMultiselect>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                <label
                                    class="d-block text-black fw-semibold mb-10"
                                >
                                    Arrondissement
                                </label>
                                <input
                                    type="passowrd"
                                    class="form-control shadow-none rounded-0 text-black"
                                    placeholder="Arrondissement"
                                    v-model="client.arrondissement"
                                />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                <v-switch
                                    inset
                                    color="success"
                                    label="Handicap"
                                    v-model="client.handicap"
                                ></v-switch>
                            </div>
                        </div>
                        <div v-if="client.handicap" class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                    <label
                                        class="d-block text-black fw-semibold mb-10"
                                    >
                                        Type Handicap
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control shadow-none rounded-0 text-black"
                                        placeholder=""
                                        v-model="client.typeHandicap"
                                    />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                    <label
                                        class="d-block text-black fw-semibold mb-10"
                                    >
                                        cause handicap
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control shadow-none rounded-0 text-black"
                                        placeholder=""
                                        v-model="client.causeHandicap"
                                    />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                    <label
                                        class="d-block text-black fw-semibold mb-10"
                                    >
                                        Date d'handicap
                                    </label>
                                    <input
                                        class="form-select shadow-none fw-semibold rounded-0"
                                        type="date"
                                        v-model="client.dateHandicap"
                                    />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-15 mb-sm-20 mb-md-25">
                                    <label
                                        class="d-block text-black fw-semibold mb-10"
                                    >
                                        autonomie
                                    </label>
                                    <input
                                        v-if="false"
                                        type="text"
                                        class="form-control shadow-none rounded-0 text-black"
                                        placeholder=""
                                        v-model="client.autonomie"
                                    />
                                    <VueMultiselect
                                        v-model="client.autonomie"
                                        :options="['Oui', 'Non']"
                                        :multiple="false"
                                        :close-on-select="true"
                                        placeholder="Région"
                                    >
                                    </VueMultiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="d-block text-black fw-semibold mb-10">
                                Ajouter un lien vers les réseaux sociaux
                            </label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div
                                        class="form-group mb-15 mb-sm-20 mb-md-25"
                                    >
                                        <div class="input-group">
                                            <span
                                                class="input-group-text rounded-0 fs-14 fw-bold text-primary"
                                            >
                                                <i
                                                    class="ph-bold ph-facebook-logo lh-1 fs-md-18"
                                                ></i>
                                            </span>
                                            <input
                                                type="text"
                                                class="form-control shadow-none rounded-0 text-black"
                                                placeholder="facebook@example.com"
                                                v-model="client.facebook"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        class="form-group mb-15 mb-sm-20 mb-md-25"
                                    >
                                        <div class="input-group">
                                            <span
                                                class="input-group-text rounded-0 fs-14 fw-bold text-primary"
                                            >
                                                <i
                                                    class="ph-fill ph-tiktok-logo lh-1 fs-md-18"
                                                ></i>
                                            </span>
                                            <input
                                                type="text"
                                                class="form-control shadow-none rounded-0 text-black"
                                                placeholder="tiktok@example.com"
                                                v-model="client.tiktok"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        class="form-group mb-15 mb-sm-20 mb-md-25"
                                    >
                                        <div class="input-group">
                                            <span
                                                class="input-group-text rounded-0 fs-14 fw-bold text-primary"
                                            >
                                                <i
                                                    class="ph-bold ph-instagram-logo lh-1 fs-md-18"
                                                ></i>
                                            </span>
                                            <input
                                                type="text"
                                                class="form-control shadow-none rounded-0 text-black"
                                                placeholder="instagram@example.com"
                                                v-model="client.instagram"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        class="form-group mb-15 mb-sm-20 mb-md-25"
                                    >
                                        <div class="input-group">
                                            <span
                                                class="input-group-text rounded-0 fs-14 fw-bold text-primary"
                                            >
                                                <i
                                                    class="ph-bold ph-whatsapp-logo lh-1 fs-md-18"
                                                ></i>
                                            </span>
                                            <input
                                                type="text"
                                                class="form-control shadow-none rounded-0 text-black"
                                                placeholder="Whatsapp"
                                                v-model="client.whatsapp"
                                            />
                                        </div>
                                    </div>
                                </div>
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
                                    @click.prevent="saveClient()"
                                >
                                    Enregistrer
                                </button>
                                <router-link
                                    type="button"
                                    to="/clients"
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
import { useClientStore } from "../../../store/client";
import { useRouter } from "vue-router";
import VueMultiselect from "vue-multiselect";
import citiesList from "../../../data/cities";
import regionsList from "../../../data/regions";
// lifecycle
onMounted(async () => {
    imageUrl.value =
        "https://www.eclosio.ong/wp-content/uploads/2018/08/default.png";
    loaded.value = true;
});

// vars

let client = ref({
    id: "",
    name: "",
    email: "",
    tel: "",
    age: "",
    adress: "",
    active: true,
    cin: "",
    region: "",
    dateNaissance: "",
    province: "",
    ville: "",
    arrondissement: "",
    facebook: "",
    instagram: "",
    tiktok: "",
    whatsapp: "",
    handicap: false,
    typeHandicap: "",
    dateHandicap: "",
    causeHandicap: "",
    autonomie: "",
    image: "",
});
let loaded = ref(false);
let closeBtn = ref("");

let imageUrl = ref("");
const router = useRouter();

// stores
const clientStore = useClientStore();
const errorStore = useErrorStore();
// funcs

let saveClient = async () => {
    await clientStore
        .save(client.value)
        .then(() => {
            Swal.fire("Succès", "Client sauvegardée avec succès", "");
            router.push("/clients");
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};

let handleFileChange = (event) => {
    const input = event.target;
    client.value.image = input.files?.[0] || null;
    previewImage();
};
let previewImage = () => {
    if (client.value.image) {
        const reader = new FileReader();
        reader.onload = (event) => {
            imageUrl.value = event.target?.result;
        };
        reader.readAsDataURL(client.value.image);
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
