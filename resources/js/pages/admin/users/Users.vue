<template>
    <MainLayout>
        <div v-if="loaded">
            <h4 class="mb-5 mb-sm-0 fw-bold">
                Les utulisateures/ <span>{{ users?.length }}</span>
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
                            v-if="false"
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
                            Nouvelle utulisateur
                            <i
                                class="flaticon-plus position-relative ms-5 fs-12"
                            ></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row" v-if="users && users.length > 0">
                <div
                    class="col-sm-6 col-lg-4 col-xxxl-3"
                    v-for="(user, index) in users"
                    :key="index"
                >
                    <div
                        class="card mb-25 border-0 rounded-0 bg-white seller-card"
                    >
                        <div class="card-body letter-spacing">
                            <div
                                class="mb-15 mb-md-20 mb-lg-25 d-flex align-items-center justify-content-between"
                            >
                                <div
                                    class="icon position-relative text-center rounded-circle"
                                    style="overflow: hidden"
                                >
                                    <img
                                        :src="user.image"
                                        class="position-absolute start-0 end-0 ms-auto me-auto user-image"
                                        alt="seller"
                                    />
                                </div>
                                <div class="dropdown">
                                    <button
                                        class="dropdown-toggle card-dot-btn lh-1 position-relative top-4 bg-transparent border-0 shadow-none p-0 transition"
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
                                                @click.prevent="setUser(user)"
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
                                                @click.prevent="setUser(user)"
                                                data-bs-toggle="modal"
                                                data-bs-target="#passwordModal"
                                            >
                                                <i
                                                    class="flaticon-lock lh-1 me-8 position-relative top-1"
                                                ></i>
                                                changer mot de passe
                                            </button>
                                        </li>
                                        <li>
                                            <button
                                                class="dropdown-item d-flex align-items-center"
                                                @click.prevent="
                                                    deleteUser(user)
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
                            </div>
                            <h5
                                class="fs-18 fw-semibold text-black mb-5 mb-md-8"
                            >
                                {{ user.name }}
                            </h5>
                            <span class="text-paragraph d-block">
                                Role:
                                <span class="text-primary fw-semibold">{{
                                    user.roleLabel
                                }}</span>
                            </span>
                            <ul
                                class="list mt-15 mt-lg-25 ps-0 mb-0 list-unstyled d-flex justify-content-between"
                            >
                                <li>
                                    <span
                                        class="d-block text-dark-emphasis text-uppercase fw-medium fs-12 mb-5 mb-md-8"
                                    >
                                        Tel :
                                    </span>
                                    <span class="d-block text-dark fw-medium">{{
                                        user.tel
                                    }}</span>
                                </li>
                                <li>
                                    <span
                                        class="d-block text-dark-emphasis text-uppercase fw-medium fs-12 mb-5 mb-md-8"
                                    >
                                        email
                                    </span>
                                    <span class="d-block text-dark fw-medium">{{
                                        user.email
                                    }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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
                                Éditer {{ user.name }}
                            </h1>
                            <h1
                                v-else
                                class="modal-title fs-5"
                                id="addNiveauLabel"
                            >
                                Ajouter nouveau utulisateur
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
                                            >Nom et prénom</label
                                        >
                                        <input
                                            v-model="user.name"
                                            type="text"
                                            class="form-control shadow-none text-black fs-md-15 fs-lg-16"
                                            id="inputTitle"
                                            aria-describedby="TitleHelp"
                                            placeholder="Entrer le nom et prénom"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-mb-15 mb-md-20">
                                        <label
                                            for="inputTitle"
                                            class="form-label fw-medium"
                                            >Tél</label
                                        >
                                        <input
                                            v-model="user.tel"
                                            type="text"
                                            class="form-control shadow-none text-black fs-md-15 fs-lg-16"
                                            id="inputTitle"
                                            aria-describedby="TitleHelp"
                                            placeholder="tél"
                                        />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-mb-15 mb-md-20">
                                        <label
                                            for="inputTitle"
                                            class="form-label fw-medium"
                                            >Email</label
                                        >
                                        <input
                                            v-model="user.email"
                                            type="text"
                                            class="form-control shadow-none text-black fs-md-15 fs-lg-16"
                                            id="inputTitle"
                                            aria-describedby="TitleHelp"
                                            placeholder="email"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-mb-15 mb-md-20">
                                <label
                                    for="inputTitle"
                                    class="form-label fw-medium"
                                    >Role</label
                                >
                                <VueMultiselect
                                    v-model="user.role"
                                    :options="roles"
                                    :multiple="false"
                                    :close-on-select="true"
                                    placeholder="Choisissez le role"
                                    label="Label"
                                    value="id"
                                    track-by="id"
                                >
                                </VueMultiselect>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-mb-15 mb-md-20">
                                        <label
                                            for="inputTitle"
                                            class="form-label fw-medium"
                                            >Status (activer ou désactiver
                                            )</label
                                        >
                                        <v-switch
                                            inset
                                            color="success"
                                            label="Active"
                                            v-model="user.active"
                                        ></v-switch>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-mb-15 mb-md-20 mt-2">
                                <div
                                    class="file-upload text-center position-relative"
                                >
                                    <div class="user-img-clips">
                                        <img
                                            width="150px"
                                            :src="imageUrl"
                                            alt="Uploaded Image"
                                            class="preview-image"
                                        />
                                    </div>
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
                                ref="closeBtns"
                            >
                                Fermer
                            </button>
                            <button
                                v-if="isEdit"
                                type="button"
                                @click="updateUser()"
                                class="btn btn-primary"
                            >
                                Modifier
                            </button>
                            <button
                                v-else
                                type="button"
                                @click="saveUser()"
                                class="btn btn-primary"
                            >
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- password changing  -->
            <div
                class="modal fade"
                id="passwordModal"
                tabindex="-1"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">
                                Éditer mot de passe pour {{ user.name }}
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
                                            >Mot de passe</label
                                        >
                                        <input
                                            v-model="form.password"
                                            type="password"
                                            class="form-control shadow-none text-black fs-md-15 fs-lg-16"
                                            id="inputTitle"
                                            aria-describedby="TitleHelp"
                                            placeholder="**********"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-mb-15 mb-md-20">
                                        <label
                                            for="inputTitle"
                                            class="form-label fw-medium"
                                            >Mot de passe confirmation</label
                                        >
                                        <input
                                            v-model="form.password_confirmation"
                                            type="password"
                                            class="form-control shadow-none text-black fs-md-15 fs-lg-16"
                                            id="inputTitle"
                                            aria-describedby="TitleHelp"
                                            placeholder="**********"
                                        />
                                    </div>
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
                                type="button"
                                @click="savePassword()"
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
<script setup lang="ts">
import { useUsersStore } from "../../../store/users";

import { onMounted, ref } from "vue";
import MainLayout from "../../../layouts/MainLayout.vue";
import { useErrorStore } from "../../../store/error";
import axiosClient from "../../../axios/index";
import VueMultiselect from "vue-multiselect";
import Swal from "sweetalert2";
import Emptybox from "../../../Components/ui/EmptyBox.vue";
import Errors from "../../../Components/ui/Errors.vue";

import Loader from "../../../Components/ui/Loader.vue";

// lifecycle hooks

onMounted(async () => {
    await getUsers();
    await getRoles();
    imageUrl.value =
        "https://www.eclosio.ong/wp-content/uploads/2018/08/default.png";
    loaded.value = true;
});

// vars
let users = ref([]);
let roles = ref([]);

let loaded = ref(false);
let closeBtn = ref("");
let closeBtns = ref("");
let imageUrl = ref("");
let user = ref({
    id: "",
    name: "",
    email: "",
    tel: "",
    role: "",
    image: "",
    active: true,
});
let form = ref({
    password: null,
    password_confirmation: null,
});
let isEdit = ref(false);
// stores

const userStore = useUsersStore();
const errorStore = useErrorStore();
// funcs
let getUsers = async () => {
    await userStore
        .getUsers()
        .then((res) => {
            users.value = userStore.users;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let getRoles = async () => {
    await axiosClient
        .get("roles")
        .then((res) => {
            roles.value = res.data.roles;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let updateUser = async () => {
    await userStore
        .update(user.value)
        .then(() => {
            initialize();
            Swal.fire("Succès", "Utulisateur mises à jour avec succès.", "");
            closeBtns.value.click();
            getUsers();
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let savePassword = async () => {
    await userStore
        .updatePassword(user.value, form.value)
        .then(() => {
            initialize();
            Swal.fire(
                "Succès",
                "Utulisateur mot de passe mises à jour avec succès.",
                ""
            );
            closeBtn.value.click();
            form.value = { password: null, password_confirmation: null };
            errorStore.errors = [];
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let saveUser = async () => {
    await userStore
        .save(user.value)
        .then(() => {
            initialize();
            Swal.fire("Succès", "Utulisateur sauvegardée avec succès", "");
            closeBtns.value.click();
            getUsers();
            errorStore.errors = [];
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let deleteUser = async (sec) => {
    await Swal.fire({
        title: "Voulez-vous supprimer ce utulisateur?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            userStore
                .delete(sec)
                .then(() => {
                    Swal.fire("Succès", "utulisateur supprimée avec succès");
                    getUsers();
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    });
};
let handleFileChange = (event) => {
    const input = event.target;
    user.value.image = input.files?.[0] || null;
    previewImage();
};
let previewImage = () => {
    if (user.value.image) {
        const reader = new FileReader();
        reader.onload = (event) => {
            imageUrl.value = event.target?.result;
        };
        reader.readAsDataURL(user.value.image);
    } else {
        imageUrl.value = "";
    }
};
let initialize = () => {
    user.value = {
        id: "",
        name: "",
        email: "",
        tel: "",
        role: "",
        image: "",
        active: true,
    };
    isEdit.value = false;

    errorStore.errors = [];
    imageUrl.value =
        "https://www.eclosio.ong/wp-content/uploads/2018/08/default.png";
};
let setUser = (us) => {
    console.log(us);
    user.value = us;
    isEdit.value = true;
};
</script>
<style scoped>
.user-image {
    width: 90%;
    height: 90%;
    object-fit: cover;
    border-radius: 50%;
}

.user-img-clips {
    border-radius: 50%;
    height: 150px;
    width: 150px;
    margin: auto;
    overflow: hidden;
}

.user-img-clips img {
    height: 100%;
    width: 100%;
    object-fit: cover;
}
</style>
