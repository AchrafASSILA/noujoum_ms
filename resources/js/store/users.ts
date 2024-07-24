import { defineStore } from "pinia"

export const useUsersStore = defineStore('users', {
    state: () => (
        {
            users: ['achraf', 'taha'],

        }
    ),
    getters: {

    },
    actions: {
        increment() {
            this.count++
        },
    },
})