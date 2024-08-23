import { defineStore } from "pinia";
import axiosClient from "../axios";

export const useConfigStore = defineStore("config", {
    state: () => ({
        config: {},
    }),
    getters: {},
    actions: {
        async getConfig() {
            await axiosClient
                .get("/config")
                .then((res: any) => {
                    this.config = res.data?.config; 
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        
      
        async save(config: any) {
            const formData = new FormData();
            formData.append("title", config.title);
            formData.append("adress", config.adress);
            formData.append("email", config.email);
            formData.append("tel", config.tel); 
            formData.append("file", config.image); 
            formData.append("website", config.website); 
            await axiosClient.post("/config", formData);
        },
         
     
    },
});
