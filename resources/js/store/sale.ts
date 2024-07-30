import { defineStore } from "pinia";
import axiosClient from "../axios";

export const useSaleStore = defineStore("sale", {
    state: () => ({
        sales: [],
    }),
    getters: {},
    actions: {
        async getSales() {
            await axiosClient
                .get("/sales")
                .then((res: any) => {
                    this.sales = res.data.sales;
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
            await axiosClient.post("/sales", formData);
        },
        async update(section: any) {
            console.log(section.label);
            const formData = new FormData();
            formData.append("_method", "put");
            formData.append("label", section.label);
            formData.append("file", section.image);
            formData.append("active", section.active);
            await axiosClient.post("/sales/" + section.id, formData);
        },
        async delete(section: any) {
            await axiosClient.delete("/sales/" + section.id);
        },
    },
});
