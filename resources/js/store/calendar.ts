import { defineStore } from "pinia";
import axiosClient from "../axios";
import { useErrorStore } from "./error";

import { useRouter } from "vue-router";

export const useCalendarStore = defineStore("calendar", {
    state: () => ({
        seances: [],
        sales: [],
        coachs: [],
        modules: [],
        sections: [],
        days: [],
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
        async formdata() {
            await axiosClient
                .get("/seances/create")
                .then((res: any) => {
                    this.sales = res.data?.sales;
                    this.sections = res.data?.sections;
                    this.modules = res.data?.modules;
                    this.days = res.data?.days;
                    this.coachs = res.data?.coachs;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async save(seance: any) {
            const formData = new FormData();
            formData.append("start", seance.start);
            formData.append("end", seance.end);
            // formData.append("section", seance.section.id);
            formData.append("module", seance.module.id);
            formData.append("sale", seance.sale.id);
            formData.append("coach", seance.coach.id);
            formData.append("day", seance.day.id);
            await axiosClient.post("/seances", formData);
        },
        async update(seance: any) {
            const formData = new FormData();
            formData.append("_method", "put");
            formData.append("start", seance.start);
            formData.append("end", seance.end);
            // formData.append("section", seance.section.id);
            formData.append("module", seance.module.id);
            formData.append("sale", seance.sale.id);
            formData.append("coach", seance.coach.id);
            formData.append("day", seance.day.id);
            await axiosClient.post("/seances/" + seance.id, formData);
        },
        async delete(seance: any) {
            await axiosClient.delete("/seances/" + seance);
        },
    },
});
