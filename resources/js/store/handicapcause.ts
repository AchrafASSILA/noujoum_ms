import { defineStore } from "pinia";
import axiosClient from "../axios";
import { useErrorStore } from "./error";

import { useRouter } from "vue-router";

export const useHandicapCauseStore = defineStore("handicapcause", {
    state: () => ({
        handicapCauses: [],
    }),
    getters: {},
    actions: {
        async getCauses() {
            await axiosClient
                .get("/handicapcauses")
                .then((res: any) => {
                    this.handicapCauses = res.data?.handicapCauses;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async save(cause: any) {
            const formData = new FormData();
            formData.append("label", cause.label);
            await axiosClient.post("/handicapcauses", formData);
        },
        async update(cause: any) {
            const formData = new FormData();
            formData.append("_method", "put");
            formData.append("label", cause.label);
            await axiosClient.post("/handicapcauses/" + cause.id, formData);
        },
        async delete(cause: any) {
            await axiosClient.delete("/handicapcauses/" + cause.id);
        },
    },
});
