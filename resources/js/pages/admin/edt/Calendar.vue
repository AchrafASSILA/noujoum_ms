<template>
    <MainLayout>
        <div v-if="loaded">
            <div class="row">
                <div class="col-xxxl-6"></div>
                <div
                    class="col-xxxl-3"
                    v-if="
                        useAuthStore().role &&
                        otherRoles.includes(useAuthStore().role)
                    "
                >
                    <button
                        type="button"
                        @click="initialize()"
                        data-bs-toggle="modal"
                        data-bs-target="#basicModal"
                        class="default-btn mb-25 border-0 transition d-block w-100 text-center position-relative text-white fs-md-15 fs-lg-16 fw-medium pt-18 pb-18 ps-15 pe-15"
                    >
                        Nouvelle séance
                        <i
                            class="flaticon-plus lh-1 fs-13 position-relative top-1 ms-5"
                        ></i>
                    </button>
                </div>
                <div class="col-xxxl-3">
                    <router-link
                        to="/edt-full"
                        target="_blank"
                        type="button"
                        class="default-btn mb-25 border-0 text-none transition d-block w-100 text-center position-relative text-white fs-md-15 fs-lg-16 fw-medium pt-18 pb-18 ps-15 pe-15"
                    >
                        Afficher
                        <i
                            class="flaticon-view lh-1 fs-13 position-relative top-1 ms-5"
                        ></i>
                    </router-link>
                </div>
            </div>
            <div class="row">
                <div class="col-xxxl-12">
                    <div
                        class="card mb-25 border-0 rounded-0 bg-white calendar-card"
                    >
                        <div
                            class="card-body p-15 p-sm-20 p-sm-25 p-lg-30 letter-spacing"
                        >
                            <FullCalendar :options="calendarOptions">
                                <template v-slot:eventContent="arg">
                                    <!-- {{ arg }} -->
                                    <toolbar flat dense class="elvation-0">
                                        <div
                                            class="head d-flex align-items-center justify-content-between"
                                            style="padding-left: 5px"
                                        >
                                            <span>{{ arg.timeText }}</span>
                                            <div
                                                class="actions d-flex justify-content-end"
                                            >
                                                <button
                                                    v-if="
                                                        useAuthStore().role &&
                                                        otherRoles.includes(
                                                            useAuthStore().role
                                                        )
                                                    "
                                                    class="dropdown-item cl-btn"
                                                    @click.prevent="edit(arg)"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#basicModal"
                                                >
                                                    <i
                                                        class="flaticon-pen lh-1 position-relative top-1"
                                                    ></i>
                                                </button>
                                                <button
                                                    v-if="
                                                        useAuthStore().role &&
                                                        otherRoles.includes(
                                                            useAuthStore().role
                                                        )
                                                    "
                                                    class="dropdown-item cl-btn"
                                                    @click.prevent="remove(arg)"
                                                >
                                                    <i
                                                        class="flaticon-delete lh-1 position-relative top-1"
                                                    ></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="body cl-body">
                                            <div
                                                class="head d-flex align-items-center"
                                            >
                                                <div class="img mr-1">
                                                    <img
                                                        :src="
                                                            arg.event
                                                                .extendedProps
                                                                .coach.image
                                                        "
                                                        alt=""
                                                    />
                                                </div>

                                                <span>{{
                                                    arg.event.extendedProps
                                                        .coach.name
                                                }}</span>
                                            </div>
                                            <div
                                                class="d-flex justify-content-between"
                                            >
                                                <span
                                                    style="padding-left: 5px"
                                                    >{{
                                                        arg.event.extendedProps
                                                            .module.label
                                                    }}</span
                                                >
                                                <span
                                                    style="padding-right: 5px"
                                                    >{{
                                                        arg.event.extendedProps
                                                            .sale.label
                                                    }}</span
                                                >
                                            </div>
                                        </div>
                                    </toolbar>
                                </template>
                            </FullCalendar>
                        </div>
                    </div>
                </div>
            </div>
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
                                Éditer
                            </h1>
                            <h1
                                v-else
                                class="modal-title fs-5"
                                id="addNiveauLabel"
                            >
                                Nouvelle séance
                            </h1>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>

                        <div class="modal-body">
                            <div class="row mb-2">
                                <div class="col-6">
                                    <label
                                        for="inputTitle"
                                        class="form-label fw-medium"
                                        >Start :
                                    </label>
                                    <v-text-field
                                        v-model="seance.start"
                                        :active="menu1"
                                        :focus="menu1"
                                        label=""
                                        style="width: 100%"
                                        prepend-icon="mdi-clock-time-four-outline"
                                        readonly
                                    >
                                        <v-menu
                                            v-model="menu1"
                                            :close-on-content-click="false"
                                            activator="parent"
                                            transition="scale-transition"
                                        >
                                            <v-time-picker
                                                v-if="menu1"
                                                v-model="seance.start"
                                                format="24H"
                                                full-width
                                            ></v-time-picker>
                                        </v-menu>
                                    </v-text-field>
                                </div>
                                <div class="col-6">
                                    <label
                                        for="inputTitle"
                                        class="form-label fw-medium"
                                        >End :
                                    </label>
                                    <v-text-field
                                        v-model="seance.end"
                                        :active="menu2"
                                        :focus="menu2"
                                        label=""
                                        style="width: 100%"
                                        prepend-icon="mdi-clock-time-four-outline"
                                        readonly
                                    >
                                        <v-menu
                                            v-model="menu2"
                                            :close-on-content-click="false"
                                            activator="parent"
                                            transition="scale-transition"
                                        >
                                            <v-time-picker
                                                v-if="menu2"
                                                format="24H"
                                                v-model="seance.end"
                                                full-width
                                            ></v-time-picker>
                                        </v-menu>
                                    </v-text-field>
                                </div>
                            </div>

                            <div class="mb-mb-15 mb-md-20">
                                <label
                                    for="inputTitle"
                                    class="form-label fw-medium"
                                    >Module</label
                                >
                                <VueMultiselect
                                    v-model="seance.module"
                                    :options="modules"
                                    :multiple="false"
                                    :close-on-select="true"
                                    label="label"
                                    track-by="id"
                                    placeholder="Choisissez un module"
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
                                    >Coach</label
                                >
                                <VueMultiselect
                                    v-model="seance.coach"
                                    :options="coachs"
                                    :multiple="false"
                                    :close-on-select="true"
                                    label="name"
                                    track-by="id"
                                    placeholder="Choisissez un coach"
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
                                    >Salle</label
                                >
                                <VueMultiselect
                                    v-model="seance.sale"
                                    :options="sales"
                                    :multiple="false"
                                    :close-on-select="true"
                                    label="label"
                                    track-by="id"
                                    placeholder="Choisissez une salle"
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
                                    >Jour</label
                                >
                                <VueMultiselect
                                    v-model="seance.day"
                                    :options="days"
                                    :multiple="false"
                                    :close-on-select="true"
                                    label="label"
                                    track-by="id"
                                    placeholder="Choisissez un jour"
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
                                Fremer
                            </button>
                            <button
                                v-if="isEdit"
                                type="button"
                                @click="updateSeance()"
                                class="btn btn-primary"
                            >
                                Modifier
                            </button>
                            <button
                                v-else
                                type="button"
                                @click="saveSeance()"
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
import MainLayout from "../../../layouts/MainLayout.vue";
import Swal from "sweetalert2";
import { onMounted, ref } from "vue";
import timeGridPlugin from "@fullcalendar/timegrid";
import { useErrorStore } from "../../../store/error";
import { useCalendarStore } from "../../../store/calendar";
import interactionPlugin from "@fullcalendar/interaction";
import FullCalendar from "@fullcalendar/vue3";
import Errors from "../../../Components/ui/Errors.vue";
import Loader from "../../../Components/ui/Loader.vue";
import { VTimePicker } from "vuetify/labs/VTimePicker";

import VueMultiselect from "vue-multiselect";
import { useAuthStore } from "../../../store/auth";
onMounted(async () => {
    await getSeances();
    await getFormdata();
    calendarOptions.value.events = seances.value;
    loaded.value = true;
});

// vars
let seances = ref([]);

let sections = ref([]);
let sales = ref([]);
let coachs = ref([]);
let days = ref([]);
let modules = ref([]);

let loaded = ref(false);
let seance = ref({
    id: "",
    start: "",
    end: "",
    sale: "",
    module: "",
    section: "",
    coach: "",
    day: "",
});
let isEdit = ref(false);
let menu1 = ref(false);
let menu2 = ref(false);
let closeBtn = ref("");

// stores
const calendarStore = useCalendarStore();
const errorStore = useErrorStore();
// funcs
let getSeances = async () => {
    await calendarStore
        .getSeances()
        .then((res) => {
            seances.value = calendarStore.seances;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let getFormdata = async () => {
    await calendarStore
        .formdata()
        .then((res) => {
            sections.value = calendarStore.sections;
            sales.value = calendarStore.sales;
            modules.value = calendarStore.modules;
            coachs.value = calendarStore.coachs;
            days.value = calendarStore.days;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let remove = async (event: any) => {
    console.log(event);
    console.log(event.event.id);
    await Swal.fire({
        title: "Voulez-vous supprimer cette séance ?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            calendarStore
                .delete(event.event.id)
                .then(() => {
                    Swal.fire("success", "séance supprimée avec succès");
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    });
    await getSeances();
    calendarOptions.value.events = seances.value;
};
let edit = async (event: any) => {
    seance.value.start = event.event.extendedProps.startReal;
    seance.value.end = event.event.extendedProps.endReal;
    seance.value.coach = event.event.extendedProps.coach;
    seance.value.sale = event.event.extendedProps.sale;
    seance.value.module = event.event.extendedProps.module;
    seance.value.day = event.event.extendedProps.day;
    seance.value.id = event.event.id;
    isEdit.value = true;
    console.log(event);
};
let updateSeance = async () => {
    await calendarStore
        .update(seance.value)
        .then(() => {
            initialize();
            Swal.fire("Succès", "Séance mises à jour avec succès.", "");
            closeBtn.value.click();
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
    await getSeances();
    calendarOptions.value.events = seances.value;
};
let saveSeance = async () => {
    await calendarStore
        .save(seance.value)
        .then(() => {
            initialize();
            Swal.fire("Succès", "Séance sauvegardée avec succès", "");
            closeBtn.value.click();
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
    await getSeances();
    calendarOptions.value.events = seances.value;
};
let initialize = () => {
    seance.value = {
        id: "",
        start: "",
        end: "",
        sale: "",
        module: "",
        section: "",
        coach: "",
        day: "",
    };
    isEdit.value = false;
};
let otherRoles = ref(["admin", "pinia", "founder", "assistant"]);
let calendarOptions = ref({
    plugins: [timeGridPlugin, interactionPlugin],
    initialView: "timeGridWeek",
    headerToolbar: {
        left: "",
        center: "title",
        right: "",
    },
    allDaySlot: false,
    slotMinTime: "08:00:00",
    slotMaxTime: "24:00:00",
    firstDay: 1,
    dayHeaderFormat: {
        weekday: "long",
    },
    // eventClick: (info) => {
    //     console.log(info);
    // },
    locale: "fr",
    navLinks: false,
    editable: false,
    dayMaxEvents: true,
    displayEventTime: true,
    events: [...seances.value],
});
</script>
<style scoped>
.cl-btn {
    width: fit-content;
    border: 1px solid white;
    border-radius: 7px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 5px;
    padding: 5px;
}
.cl-body {
    height: 65%;
    margin: 5px 0;
    padding-left: 5px;
}
.cl-body .img {
    width: 30px;
    height: 30px;
    overflow: hidden;
    border-radius: 50%;
    margin-right: 5px;
    margin-bottom: 5px;
}
.cl-body .img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
