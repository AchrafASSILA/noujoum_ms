<template>
    <MainLayout>
        <div class="card mb-25 border-0 rounded-0 welcome-lms-courses-box">
            <div
                class="card-body ps-15 pe-15 ps-sm-20 pe-sm-20 ps-md-25 pe-md-25 ps-lg-30 pe-lg-30 ps-xl-40 pe-xl-40 letter-spacing"
            >
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="content">
                            <span
                                class="d-block fw-bold mb-5"
                                id="current-date"
                            >
                                {{ formattedDate }}
                            </span>
                            <h2 class="fw-semibold mb-8 text-white">
                                Bienvenu, {{ authStore.name }}
                            </h2>
                        </div>
                    </div>
                    <div
                        class="col-xxl-6 text-center text-xxl-end mt-15 mt-md-0"
                    >
                        <img
                            src="https://boti.education/lms/assets/images/welcome/welcome3.png"
                            class="main-image"
                            alt="welcome-image"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div
            v-if="loaded"
            class="card mb-25 border-0 rounded-0 bg-white number-of-tickets-box"
        >
            <div class="card-body p-15 p-sm-20 p-sm-25 p-lg-30 letter-spacing">
                <div
                    class="d-sm-flex align-items-center justify-content-between"
                >
                    <h6 class="card-title fw-bold mb-0">État annuel</h6>
                </div>
                <div id="numberOfTicketsChart" class="chart">
                    <apexchart
                        type="bar"
                        height="300"
                        :options="dataServices"
                        :series="chartServices"
                    ></apexchart>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup lang="ts">
import { onMounted, ref } from "vue";
import MainLayout from "../../layouts/MainLayout.vue";
import { useAuthStore } from "../../store/auth";
import axiosClient from "../../axios";

onMounted(async () => {
    await axiosClient.get("/statistics/etats").then((res: any) => {
        for (let i = 0; i < res.data.months.length; i++) {
            dataServices.value.xaxis.categories.push(res.data.months[i]);
        }
        chartServices.value[0].data = res.data.servicesValues;
    });
    loaded.value = true;
});

const authStore = useAuthStore();
const formattedDate = ref("");
let loaded = ref(false);

let dataServices = ref({
    chart: {
        type: "bar",
        height: 600,
        toolbar: {
            show: false,
        },
    },
    plotOptions: {
        bar: {
            borderRadius: 3,
            horizontal: false,
            columnWidth: "42%",
            endingShape: "rounded",
            borderRadiusApplication: "end",
        },
    },
    colors: ["#6560F0", "#6FD3F7", "#F3C44C", "#06B48A"],
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: 4,
        show: true,
        colors: ["transparent"],
    },
    yaxis: {
        show: true,
        tickAmount: 5,
        labels: {
            show: true,
            style: {
                fontFamily: "Red Hat Display, sans-serif",
                colors: ["#9C9AB6"],
                fontSize: "12px",
                fontWeight: 500,
            },
        },
        axisBorder: {
            show: true,
            color: "#eeeeee",
        },
    },
    xaxis: {
        categories: [],
        labels: {
            show: true,
            style: {
                fontFamily: "Red Hat Display, sans-serif",
                colors: "#9C9AB6",
                fontSize: "12px",
                fontWeight: 500,
            },
        },
        axisTicks: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
    },
    legend: {
        show: true,
        fontWeight: 500,
        fontSize: "12px",
        position: "bottom",
        horizontalAlign: "center",
        fontFamily: "Red Hat Display, sans-serif",
        labels: {
            colors: "#9C9AB6",
        },
        markers: {
            offsetX: -2,
        },
        itemMargin: {
            horizontal: 8,
            vertical: 5,
        },
    },
    fill: {
        opacity: 1,
    },
    tooltip: {
        style: {
            fontSize: "14px",
            fontFamily: "Red Hat Display, sans-serif",
        },
    },
    grid: {
        show: true,
        strokeDashArray: 5,
        borderColor: "#d9e9ef",
    },
});
let chartServices = ref([
    {
        name: "Total (DH)",
        data: [],
    },
]);
</script>
