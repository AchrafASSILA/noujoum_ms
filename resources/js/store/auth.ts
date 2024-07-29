import { defineStore } from "pinia";
import axiosClient from "../axios";
import { useErrorStore } from "./error";

import { useRouter } from "vue-router";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: localStorage.getItem("USER"),
        role: localStorage.getItem("ROLE"),
        image: localStorage.getItem("IMAGE"),
        token: localStorage.getItem("TOKEN"),
        name: localStorage.getItem("NAME"),
        // router: useRouter(),
    }),
    getters: {},
    actions: {
        async login(email: string, passwrod: string) {
            const formData = new FormData();
            const errorStore = useErrorStore();
            formData.append("email", email);
            formData.append("password", passwrod);
            await axiosClient
                .post("/login", formData)
                .then((res: any) => {
                    console.log(res.data.token);
                    localStorage.setItem("TOKEN", res.data.token);
                    localStorage.setItem("ROLE", res.data.user.role);
                    localStorage.setItem("NAME", res.data.user.name);
                    localStorage.setItem("IMAGE", res.data.user.image);
                    localStorage.setItem("USER", res.data.user);
                    errorStore.errors = [];
                    // this.router.push({ path: "/" });
                    // console.log("hello");
                })
                .catch((err) => {
                    errorStore.errors = [];
                    errorStore.errors.push(err!.response!.data!.msg);
                });
        },
        async logout() {
            await axiosClient
                .post("/logout")
                .then((res) => {
                    localStorage.removeItem("TOKEN");
                    localStorage.removeItem("NAME");
                    localStorage.removeItem("ROLE");
                    localStorage.removeItem("IMAGE");
                    localStorage.removeItem("USER");
                    // this.router.push({ path: "/auth/login" });
                    // console.log("lgoout");
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
});
