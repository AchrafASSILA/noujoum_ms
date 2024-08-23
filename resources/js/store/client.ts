import { defineStore } from "pinia";
import axiosClient from "../axios";

export const useClientStore = defineStore("client", {
    state: () => ({
        clients: [],
        client: null,
    }),
    getters: {},
    actions: {
        async getClients() {
            await axiosClient
                .get("/clients")
                .then((res: any) => {
                    this.clients = res.data?.clients;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async client(id: number) {
            await axiosClient
                .get("/clients/" + id)
                .then((res: any) => {
                    this.client = res.data?.client;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async editClient(id: number) {
            await axiosClient
                .get("/clients/" + id + "/edit")
                .then((res: any) => {
                    this.client = res.data?.client;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async getArchivedClients() {
            await axiosClient
                .get("/archived-clients")
                .then((res: any) => {
                    this.clients = res.data?.clients;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async save(client: any) {
            const formData = new FormData();
            formData.append("name", client.name);
            formData.append("age", client.age);
            formData.append("adress", client.adress);
            formData.append("email", client.email);
            formData.append("tel", client.tel);
            formData.append("cin", client.cin);
            formData.append("region", client.region);
            formData.append("birthday", client.birthday);
            formData.append("province", client.province);
            formData.append("ville", client.ville);
            formData.append("arrondissement", client.arrondissement);
            formData.append("facebook", client.facebook);
            formData.append("instagram", client.instagram);
            formData.append("tiktok", client.tiktok);
            formData.append("whatsapp", client.whatsapp);
            formData.append("handicap", client.handicap);
            formData.append("typeHandicap", client.typeHandicap);
            formData.append("dateHandicap", client.dateHandicap);
            formData.append("causeHandicap", client.causeHandicap);
            formData.append("autonomie", client.autonomie);
            formData.append("file", client.image);
            formData.append("active", client.active);
            await axiosClient.post("/clients", formData);
        },
        async update(client: any) {
            const formData = new FormData();
            formData.append("_method", "put");
            formData.append("name", client.name);
            formData.append("age", client.age);
            formData.append("adress", client.adress);
            formData.append("email", client.email);
            formData.append("tel", client.tel);
            formData.append("cin", client.cin);
            formData.append("region", client.region);
            formData.append("dateNaissance", client.dateNaissance);
            formData.append("province", client.province);
            formData.append("ville", client.ville);
            formData.append("birthday", client.birthday);
            formData.append("arrondissement", client.arrondissement);
            formData.append("facebook", client.facebook);
            formData.append("instagram", client.instagram);
            formData.append("tiktok", client.tiktok);
            formData.append("whatsapp", client.whatsapp);
            formData.append("handicap", client.handicap);
            formData.append("typeHandicap", client.typeHandicap);
            formData.append("dateHandicap", client.dateHandicap);
            formData.append("causeHandicap", client.causeHandicap);
            formData.append("autonomie", client.autonomie);
            formData.append("file", client.image);
            formData.append("active", client.active);
            await axiosClient.post("/clients/" + client.id, formData);
        },
        async delete(client: any) {
            await axiosClient.delete("/clients/" + client.id);
        },
        async deleteTrached(client: any) {
            await axiosClient.delete("/delete-trached/" + client.id);
        },
        async unarchived(client: any) {
            const formData = new FormData();
            formData.append("id", client.id);
            await axiosClient.post("/unarchived-client/" + client.id, formData);
        },
    },
});
