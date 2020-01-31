<template>
    <div>
        <h3>Testing</h3>
        <div id="trainingen" ref="trainingen">
            <table>
                <thead>
                <tr>
                    <td>Naam</td>
                    <td>Duur (miunuten)</td>
                    <td>Kosten</td>
                    <td>Afbeelding</td>
                    <td>Acties</td>
                </tr>
                </thead>
                <tbody>
                <tr v-for="training in trainingen">
                    <td>@{{training.naam}}</td>
                    <td>@{{training.duration}}</td>
                    <td>@{{training.costs}}</td>
                    <td>@{{training.image_filename}}</td>
                    <td>
                        <a class="btn btn-sm btn-outline-primary">Bekijk</a>
                        <a class="btn btn-sm btn-outline-primary">Bewerk</a>
                        <button class="btn btn-outline-danger btn-sm">Verwijder
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        async mounted() {
            let {data} = await axios.get('/admin/trainingen');
            console.log(data);
            this.trainingen = data.trainingen;
        }
    }
</script>

<style scoped>

</style>