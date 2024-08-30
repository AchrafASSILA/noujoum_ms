<template>
    <MainLayout>
        <div v-if="loaded">
            <div class="d-flex justify-content-between">
                <h4 class="mb-5 mb-sm-0 fw-bold">
                    État financier global par services
                </h4>
                <div class="print d-flex">
                    <a
                        target="_blank"
                        href="/noujoum/export-etat-services-excel"
                        class="upload excel mr-1"
                        ><i
                            style="font-size: 24px; font-weight: 500"
                            class="ph ph-file-xls"
                        ></i
                    ></a>
                    <a
                        target="_blank"
                        href="/noujoum/impressions-export-etat-services-pdf"
                        class="upload pdf"
                        ><i
                            class="ph ph-file-pdf"
                            style="font-size: 24px; font-weight: 500"
                        ></i
                    ></a>
                </div>
            </div>

            <!-- Button trigger modal -->
            <div
                class="card mb-25 border-0 rounded-0 bg-white letter-spacing courses-list-card mt-4"
            >
                <div class="card-head box-shadow bg-white p-15 p-sm-20 p-md-25">
                    <div
                        class="align-center gap-10 sections-wrap pt-2 pb-2"
                        v-if="services && services.length > 0"
                    >
                        <div class="card-body p-15 p-sm-20 p-md-25">
                            <div class="table-responsive">
                                <table
                                    class="table text-nowrap align-middle mb-0"
                                >
                                    <thead>
                                        <tr>
                                            <th
                                                scope="col"
                                                class="text-uppercase fw-medium shadow-none text-body-tertiary fs-13 pt-0 ps-0"
                                            >
                                                Service
                                            </th>
                                            <th
                                                scope="col"
                                                class="text-uppercase fw-medium shadow-none text-body-tertiary fs-13 pt-0"
                                            >
                                                Chiffre d'affaire
                                            </th>
                                            <th
                                                scope="col"
                                                class="text-uppercase fw-medium shadow-none text-body-tertiary fs-13 pt-0"
                                            >
                                                Montant encaissé
                                            </th>
                                            <th
                                                scope="col"
                                                class="text-uppercase fw-medium shadow-none text-body-tertiary fs-13 pt-0"
                                            >
                                                Le reste à payé
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(item, index) in services"
                                            :key="index"
                                        >
                                            <th
                                                class="shadow-none fw-medium product-title ps-0"
                                            >
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <span class="mb-8 d-block">
                                                        {{ item.label }}
                                                    </span>
                                                </div>
                                            </th>
                                            <td
                                                class="shadow-none lh-1 fs-lg-16 fw-bold text-primary"
                                            >
                                                {{ item.chiffre_affaire }}
                                            </td>
                                            <td
                                                class="shadow-none lh-1 fs-lg-16 fw-bold text-primary"
                                            >
                                                {{ item.montant_encaisse }}
                                            </td>
                                            <td
                                                class="shadow-none lh-1 fs-lg-16 fw-bold text-primary"
                                            >
                                                {{ item.reste }}
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr
                                            :style="
                                                'background-color:' +
                                                total.color
                                            "
                                        >
                                            <th
                                                class="shadow-none fw-medium product-title ps-0"
                                            >
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <span class="mb-8 d-block">
                                                        Total
                                                    </span>
                                                </div>
                                            </th>
                                            <td
                                                class="shadow-none lh-1 fs-lg-16 fw-bold text-primary"
                                            >
                                                {{ total.total_ca }}
                                            </td>
                                            <td
                                                class="shadow-none lh-1 fs-lg-16 fw-bold text-primary"
                                            >
                                                {{ total.total_me }}
                                            </td>
                                            <td
                                                class="shadow-none lh-1 fs-lg-16 fw-bold text-primary"
                                            >
                                                {{ total.total_resteb }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
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
import Swal from "sweetalert2";
import Emptybox from "../../../Components/ui/EmptyBox.vue";
import Errors from "../../../Components/ui/Errors.vue";
import Loader from "../../../Components/ui/Loader.vue";
import { useErrorStore } from "../../../store/error";

import VueMultiselect from "vue-multiselect";
import { useEncaissementStore } from "../../../store/encaissement";

// lifecycle
onMounted(async () => {
    await getEtats();
    imageUrl.value =
        "https://www.eclosio.ong/wp-content/uploads/2018/08/default.png";
    loaded.value = true;
});

// vars
let services = ref([]);
let total = ref(null);

let loaded = ref(false);

let imageUrl = ref("");

// stores
const encaissementStore = useEncaissementStore();
const errorStore = useErrorStore();
// funcs
let getEtats = async () => {
    await encaissementStore
        .getEtats()
        .then((res) => {
            services.value = encaissementStore.services;
            total.value = encaissementStore.total;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
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
.upload {
    border: none;
    outline: none;
    border-radius: 25px;
    padding: 10px 18px;
    display: inline-flex;
    font-weight: 700;
    align-items: center;
    cursor: pointer;
    margin-left: 5px;
    -webkit-border-radius: 25px;
    -moz-border-radius: 25px;
    -ms-border-radius: 25px;
    -o-border-radius: 25px;
}
.excel {
    background-color: #dfffeb;
    color: #53b678;
}
.pdf {
    background-color: #ffeaea;
    color: #f23c3c;
}
</style>
