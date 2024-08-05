import { defineStore } from "pinia";
import axiosClient from "../axios";
import { useErrorStore } from "./error";

import { useRouter } from "vue-router";

export const useSectionStore = defineStore("section", {
    state: () => ({
        sections: [],
    }),
    getters: {},
    actions: {
        async getSections() {
            await axiosClient
                .get("/sections")
                .then((res: any) => {
                    console.log(res.data);
                    this.sections = res.data?.sections;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async save(section: any) {
            const formData = new FormData();
            formData.append("label", section.label);
            formData.append("file", section.image);
            formData.append("active", section.active);
            await axiosClient.post("/sections", formData);
        },
        async update(section: any) {
            console.log(section.label);
            const formData = new FormData();
            formData.append("_method", "put");
            formData.append("label", section.label);
            formData.append("file", section.image);
            formData.append("active", section.active);
            await axiosClient.post("/sections/" + section.id, formData);
        },
        async delete(section: any) {
            await axiosClient.delete("/sections/" + section.id);
        },
    },
});
