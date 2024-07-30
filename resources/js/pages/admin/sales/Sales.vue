<template>
    <MainLayout>
        <div v-if="loaded">
            <h4 class="mb-5 mb-sm-0 fw-bold">
                Sales / <span>{{ sales?.length }}</span>
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
                v-if="sales && sales.length > 0"
            >
                <v-data-table
                    :headers="headers"
                    :items="sales"
                    item-value="name"
                    :search="search"
                >
                    <template v-slot:item="{ item }">
                        <tr>
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
                                    <div class="section-img">
                                        <span>{{ item.active }}</span>
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
                                                @click.prevent="setSale(item)"
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
                                                    deleteSale(item)
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
                                Edit Sale
                            </h1>
                            <h1
                                v-else
                                class="modal-title fs-5"
                                id="addNiveauLabel"
                            >
                                Add Sale
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
                                    v-model="sale.label"
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
                                    >Enabled</label
                                >
                                <v-switch
                                    inset
                                    color="success"
                                    label="Active"
                                    v-model="sale.active"
                                ></v-switch>
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
                                @click="updateSale()"
                                class="btn btn-primary"
                            >
                                Update sale
                            </button>
                            <button
                                v-else
                                type="button"
                                @click="saveSale()"
                                class="btn btn-primary"
                            >
                                Save sale
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
import { useSaleStore } from "../../../store/sale";

// lifecycle
onMounted(async () => {
    await getSales();
    loaded.value = true;
});

// vars
let sales = ref([]);
let errors = ref([]);
let sale = ref({
    id: "",
    label: "",
    active: true,
});
let isEdit = ref(false);
let loaded = ref(false);
let closeBtn = ref("");

let search = ref("");

let headers = ref([
    {
        align: "start",
        key: "label",
        sortable: true,
        title: "Title",
    },
    {
        align: "center",
        key: "active",
        sortable: true,
        title: "Icon",
    },
    { align: "end", key: "actions", title: "Actions" },
]);
// stores
const saleStore = useSaleStore();
const errorStore = useErrorStore();
// funcs
let getSales = async () => {
    await saleStore
        .getSales()
        .then((res) => {
            sales.value = saleStore.sales;
        })
        .catch((err) => {
            console.log("hello");
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let updateSale = async () => {
    await saleStore
        .update(sale.value)
        .then(() => {
            initialize();
            Swal.fire("Success", "sale updates with success", "");
            closeBtn.value.click();
            getSales();
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let saveSale = async () => {
    await saleStore
        .save(sale.value)
        .then(() => {
            initialize();
            Swal.fire("Success", "sale save with success", "");
            closeBtn.value.click();
            getSales();
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let deleteSale = async (sal) => {
    await Swal.fire({
        title: "Do you want to delete this sale?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            saleStore
                .delete(sal)
                .then(() => {
                    Swal.fire("success", "sales delete with succes");
                    getSales();
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    });
};
let initialize = () => {
    errors.value = [];
    sale.value = {
        id: "",
        label: "",
        active: true,
    };
    isEdit.value = false;
};
let setSale = (sal) => {
    sale.value = sal;
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
</style>
