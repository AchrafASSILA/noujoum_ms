<template>
    <MainLayout>
        <div class="card mb-25 border-0 rounded-0 welcome-lms-courses-box">
            <div
                class="card-body ps-15 pe-15 ps-sm-20 pe-sm-20 ps-md-25 pe-md-25 ps-lg-30 pe-lg-30 ps-xl-40 pe-xl-40 letter-spacing"
            >
                <div class="row align-items-center">
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
    </MainLayout>
</template>

<script setup lang="ts">
import { ref } from "vue";
import MainLayout from "../../layouts/MainLayout.vue";
import { useAuthStore } from "../../store/auth";

const authStore = useAuthStore();
const formattedDate = ref("");
</script>
