<template>
    <div class="dark-swtich-btn">
        <button
            class="switch-toggle transition d-inline-block position-relative border-0 rounded-circle"
            id="switch-toggle"
            @click="toggleDarkMode"
        >
            <i class="flaticon-moon"></i>
        </button>
    </div>
</template>

<script lang="ts" setup>
import { onMounted, ref } from "vue";

let isDarkMode = ref(false);

let toggleDarkMode = () => {
    isDarkMode.value = !isDarkMode.value;
    document.body.classList.toggle("dark", isDarkMode.value);
    localStorage.setItem("dark", isDarkMode.toString());
};
onMounted(() => {
    const storedDarkMode = localStorage.getItem("dark");
    if (storedDarkMode) {
        isDarkMode.value = storedDarkMode === "true";
        document.body.classList.toggle("dark", isDarkMode.value);
    }
});
</script>
