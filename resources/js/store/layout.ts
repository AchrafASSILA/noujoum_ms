import { defineStore } from "pinia"

export const useLayoutStore = defineStore('layout', {
    state: () => (
        {
            open: false,

        }
    ),
    getters: {

    },
    actions: {
        // onChange() {
        //     this.open = !this.open
        //     console.log('hello')
        // },
    },
})