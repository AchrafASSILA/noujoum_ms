<template>
    <v-toolbar flat dense height="30px" class="elvation-0">
        <v-btn @click="clickHandler('edit')" color="white">
            <v-icon small>edit</v-icon>
        </v-btn>
        <v-btn @click="clickHandler('delete')" color="white">
            <v-icon small>delete</v-icon>
        </v-btn>
    </v-toolbar>
</template>
<script>
export default {
    name: 'Event',
    props: ['event']
    methods: {
        clickHandler(type) {
            this.$emit(type, this.event)
        }
    }
}
</script>
