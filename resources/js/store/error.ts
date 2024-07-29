import { defineStore } from "pinia";

export const useErrorStore = defineStore("error", {
    state: () => ({
        errors: [],
    }),
    getters: {},
    actions: {},
});
