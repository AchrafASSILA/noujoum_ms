import { defineStore } from "pinia";
import axiosClient from "../axios";

export const useUsersStore = defineStore("users", {
    state: () => ({
        users: [],
    }),
    getters: {},
    actions: {
        async getUsers() {
            await axiosClient
                .get("/users")
                .then((res: any) => {
                    this.users = res.data?.users;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async save(user: any) {
            const formData = new FormData();
            formData.append("name", user.name);
            formData.append("tel", user.tel);
            formData.append("email", user.email);
            formData.append("file", user.image);
            formData.append("role", user.role.id);
            formData.append("active", user.active);
            await axiosClient.post("/users", formData);
        },
        async update(user: any) {
            const formData = new FormData();
            formData.append("_method", "put");
            formData.append("name", user.name);
            formData.append("tel", user.tel);
            formData.append("email", user.email);
            formData.append("file", user.image);
            formData.append("role", user.role.id);
            formData.append("active", user.active);
            await axiosClient.post("/users/" + user.id, formData);
        },
        async delete(user: any) {
            await axiosClient.delete("/users/" + user.id);
        },
    },
});
