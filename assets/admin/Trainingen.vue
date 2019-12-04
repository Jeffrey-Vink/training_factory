<template>
    <div>
        <table>
            <thead>
                <tr v-for="training in trainingen">{{ training.naam }}</tr>
            </thead>
        </table>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "Trainingen",
        data() {
            return {
                trainingen: {}
            }
        },
        async created() {
            const response = await axios.get('http://localhost:8000/admin/trainingen')
            this.trainingen = response.data
        }
    }
</script>

<style scoped>

</style>