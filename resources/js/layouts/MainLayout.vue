<template>
    <Header />
    <Sidebar />
    <div class="main-content d-flex flex-column transition overflow-hidden">
        <slot />
        <Footer />
    </div>
</template>

<script lang="ts" setup>
import { onMounted, watchEffect } from "vue";
import { useLayoutStore } from "../store/layout";
import Header from "./Header.vue";
import Sidebar from "./Sidebar.vue";
import Footer from "./Footer.vue";

onMounted(() => {
    document.body.classList.add("bg-body-secondary");
});
const stateStoreInstance = useLayoutStore();

watchEffect(() => {
    if (stateStoreInstance.open) {
        document.body.classList.remove("sidebar-show");
        document.body.classList.add("sidebar-hide");
    } else {
        document.body.classList.remove("sidebar-hide");
        document.body.classList.add("sidebar-show");
    }
});
</script>
