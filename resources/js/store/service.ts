import { defineStore } from "pinia";
import axiosClient from "../axios";
import { useErrorStore } from "./error";

import { useRouter } from "vue-router";

export const useServiceStore = defineStore("service", {
    state: () => ({
        services: [],
    }),
    getters: {},
    actions: {
        async getSections() {
            await axiosClient
                .get("/services")
                .then((res: any) => {
                    this.services = res.data.services;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async save(service: any) {
            const formData = new FormData();
            formData.append("label", service.label);
            formData.append("file", service.image);
            formData.append("enabled", service.enabled);
            formData.append("obligation", service.obligation);
            formData.append("section", service.section?.id);
            formData.append("price", service.price);
            formData.append("frequenc", service.frequenc);
            await axiosClient.post("/services", formData);
        },
        async update(service: any) {
            const formData = new FormData();
            formData.append("_method", "put");
            formData.append("label", service.label);
            formData.append("file", service.image);
            formData.append("enabled", service.enabled);
            formData.append("obligation", service.obligation);
            formData.append("section", service.section?.id);
            formData.append("price", service.price);
            formData.append("frequenc", service.frequenc);
            await axiosClient.post("/services/" + service.id, formData);
        },
    },
});
