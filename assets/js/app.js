import Vue from 'vue'
import App from './App.vue'
import Trainingen from "../admin/Trainingen"

new Vue({
    el: "#trainingen",
    components: {Trainingen}
});

var trainingDetails = new Vue({
   el: "#details",
   components: {Training}
});