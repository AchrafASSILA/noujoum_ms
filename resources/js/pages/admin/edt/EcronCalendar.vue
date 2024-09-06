<template>
    <div v-if="loaded">
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
                                        style="
                                            padding-left: 5px;
                                            color: black;
                                            font-size: 13px;
                                            font-weight: 600;
                                        "
                                    >
                                        <span>{{ arg.timeText }}</span>
                                    </div>
                                    <div
                                        class="body cl-body"
                                        style="
                                            padding-left: 5px;
                                            color: black;
                                            font-size: 13px;
                                            font-weight: 600;
                                        "
                                    >
                                        <div
                                            class="head d-flex align-items-center"
                                        >
                                            <div class="img mr-1">
                                                <img
                                                    :src="
                                                        arg.event.extendedProps
                                                            .coach.image
                                                    "
                                                    alt=""
                                                />
                                            </div>

                                            <span>{{
                                                arg.event.extendedProps.coach
                                                    .name
                                            }}</span>
                                        </div>
                                        <div
                                            class="d-flex justify-content-between"
                                        >
                                            <span style="padding-left: 5px">{{
                                                arg.event.extendedProps.module
                                                    .label
                                            }}</span>
                                            <span style="padding-right: 5px">{{
                                                arg.event.extendedProps.sale
                                                    .label
                                            }}</span>
                                        </div>
                                    </div>
                                </toolbar>
                            </template>
                        </FullCalendar>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Loader v-else></Loader>
</template>

<script setup lang="ts">
import Swal from "sweetalert2";
import { onMounted, ref } from "vue";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import { useErrorStore } from "../../../store/error";
import { useCalendarStore } from "../../../store/calendar";
import interactionPlugin from "@fullcalendar/interaction";
import FullCalendar from "@fullcalendar/vue3";
import Emptybox from "../../../Components/ui/EmptyBox.vue";
import Errors from "../../../Components/ui/Errors.vue";
import Loader from "../../../Components/ui/Loader.vue";
onMounted(async () => {
    await getSeances();
    await getFormdata();
    calendarOptions.value.events = seances.value;
    loaded.value = true;
});

// vars
let seances = ref([]);
let days = ref([
    "Sunday",
    "Lundi",
    "Mardi",
    "Mercredi",
    "Jeudi",
    "Vendredi",
    "Samedi",
]);
let sections = ref([]);
let sales = ref([]);
let coachs = ref([]);
let modules = ref([]);

let loaded = ref(false);
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
    console.log(event);
};

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
    border: 1px solid rgb(0, 0, 0);
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
