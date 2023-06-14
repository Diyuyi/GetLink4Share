import { defineStore } from 'pinia'

export const useNavbar = defineStore('navbareId', {
    state: () => ({
        selectedKeys: [],

    }),
    actions: {
        onselectedKey(data) {
            this.selectedKeys = data
        }
    }
})