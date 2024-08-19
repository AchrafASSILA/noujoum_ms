<template>
    <MainLayout>
        <div class="row">
            <div class="col-xxxl-12">
                <div
                    class="card mb-25 border-0 rounded-0 bg-white calendar-card"
                >
                    <div
                        class="card-body p-15 p-sm-20 p-sm-25 p-lg-30 letter-spacing"
                    >
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-xxxl-3">
                <button
                    type="button"
                    class="default-btn mb-25 border-0 transition d-block w-100 text-center position-relative text-white fs-md-15 fs-lg-16 fw-medium pt-18 pb-18 ps-15 pe-15"
                >
                    Create New Event
                    <i
                        class="flaticon-plus lh-1 fs-13 position-relative top-1 ms-5"
                    ></i>
                </button>
            </div> -->
        </div>
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from "../../../layouts/MainLayout.vue";
import Swal from "sweetalert2";
import { onMounted, ref, Vue } from "vue";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import { useErrorStore } from "../../../store/error";
import { useCalendarStore } from "../../../store/calendar";
import Event from "./Event";
import interactionPlugin from "@fullcalendar/interaction";
// let eventRender = (info) => {
//     const EventClass = Vue.extend(Event);
//     //create our component instance
//     const event = new EventClass({
//         propsData: {
//             event: info.event,
//         },
//     });

//     // event.$on('edit', this.edit)

//     // event.$on('delete', this.delete)

//     // event.$mount();

//     // //assign created component to our eventObj with uuid as key (to destroy in future)
//     // this.eventsObj[event._uid] = event;

//     //set data-vue="{id}"
//     //append our compiled component to .fc-event
//     info.el.setAttribute("data-vue-id", event._uid);
//     info.el.appendChild(event.$el);
// };

onMounted(async () => {
    await getSeances();
    const calendarEl = document.getElementById("calendar");
    if (calendarEl && seances.value) {
        console.log(seances.value);
        const calendar = new Calendar(calendarEl, {
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
            eventClick: (info) => {
                console.log(info);
            },
            locale: "fr",
            navLinks: false,
            editable: true,
            dayMaxEvents: true,
            displayEventTime: true,
            events: [...seances.value],
        });
        calendar.render();
    }
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
let firstDay = ref(1);
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
let remove = (info) => {
    // var task = this.event.currentTarget.parentNode;
    // info.el.removeChild(task);
};
</script>
