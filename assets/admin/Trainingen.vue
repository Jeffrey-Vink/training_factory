<template>
    <div>
        <table class="table">
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
            <tr v-for="training in this.trainingen">
                <td>{{training.naam}}</td>
                <td>{{training.duration}}</td>
                <td>{{training.costs}}</td>
                <td>{{training.image_filename}}</td>
                <td>
                    <a class="btn btn-sm btn-outline-primary" v-on:click="showTraining = true" >Bekijk</a>
                    <a class="btn btn-sm btn-outline-primary">Bewerk</a>
                    <button class="btn btn-outline-danger btn-sm">Verwijder
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <div v-if="showTraining">
            <div class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Modal body text goes here.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import axios from 'axios'
    var showTraining;
    export default {
        name: "Trainingen",
        data() {
            return {
                trainingen: {}
            }
        },
        async created() {
            let {data} = await axios.get('/admin/trainingen');
            this.trainingen = data.trainingen;
        }
    }
</script>

<style scoped>

</style>