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
    },
});
