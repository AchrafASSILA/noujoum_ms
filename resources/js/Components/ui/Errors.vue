<template>
    <div v-if="errors" class="p-1">
        <div
            v-for="(error, index) in errors"
            v-bind:key="index"
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
            style="border-radius: 5px"
        >
            <div>
                <div v-for="(err, index) in error" v-bind:key="index">
                    {{ err }}
                </div>
                <button
                    v-if="false"
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
// imports

import { computed, ref } from "vue";
import { useErrorStore } from "../../store/error";

// stores
const errorStore = useErrorStore();
// props
let errors = computed(() => errorStore.errors);
</script>

<style></style>
