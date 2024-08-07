import { defineStore } from "pinia";
import axiosClient from "../axios";
import { useErrorStore } from "./error";

import { useRouter } from "vue-router";

export const useCalendarStore = defineStore("calendar", {
    state: () => ({
        seances: [],
    }),
    getters: {},
    actions: {
        async getSeances() {
            await axiosClient
                .get("/seances")
                .then((res: any) => {
                    this.seances = res.data?.seances;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async save(module: any) {
            const formData = new FormData();
            formData.append("label", module.label);
            formData.append("section", module.section.id);
            await axiosClient.post("/modules", formData);
        },
        async update(module: any) {
            const formData = new FormData();
            formData.append("_method", "put");
            formData.append("label", module.label);
            formData.append("section", module.section.id);
            await axiosClient.post("/modules/" + module.id, formData);
        },
        async delete(module: any) {
            await axiosClient.delete("/modules/" + module.id);
        },
    },
});
