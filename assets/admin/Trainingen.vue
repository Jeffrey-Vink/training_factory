<template>
    <div>
        <table>
            <thead>
                <tr v-for="training in trainingen">
                    <td>{{ training.naam }}</td>
                </tr>
            </thead>
        </table>
    </div>
</template>

<script>
    export default {
        name: "Trainingen",
        data() {
            return {
                trainingen: {}
            }
        },
        async created() {
            const response = await fetch('http://localhost:8000/admin/trainingen');
            this.trainingen = response.data
        }
    }
</script>

<style scoped>

</style>