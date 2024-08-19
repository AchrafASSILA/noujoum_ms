import { defineStore } from "pinia";
import axiosClient from "../axios";
import { useErrorStore } from "./error";

import { useRouter } from "vue-router";

export const useEncaissementStore = defineStore("encaissement", {
    state: () => ({
        encaissements: [],
        inscription: null,
    }),
    getters: {},
    actions: {
        async getEncaissements() {
            await axiosClient
                .get("/encaissements")
                .then((res: any) => {
                    this.encaissements = res.data.encaissements;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async getClientEncaissements(id: any) {
            await axiosClient
                .get("/encaissements-inscription/" + id)
                .then((res: any) => {
                    this.inscription = res.data.inscription;
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
        async makePayement(service: any, inscription: any) {
            const formData = new FormData();

            // for (let i = 0; i < services.length; i++) {
            //     formData.append("services[]", services[i].id);
            //     amount += services[i].amount;
            // }
            // formData.append("total", amount);
            formData.append("service", service.id);
            formData.append("inscription", inscription);
            await axiosClient.post("/encaissements", formData);
        },
        async saveAffectation(affecation: any) {
            const formData = new FormData();
            formData.append("inscription", affecation.inscription);
            formData.append("price", affecation.price);
            formData.append("service", affecation.service.id);
            await axiosClient.post("/encaissement-inscription", formData);
        },
        async deleteAffectation(id: any) {
            await axiosClient.delete("/encaissement-inscription/" + id);
        },
        async cancelPaiement(id: any) {
            await axiosClient.delete("/canceld-paiement/" + id);
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
