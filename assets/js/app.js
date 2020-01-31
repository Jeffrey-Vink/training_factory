import Vue from 'vue';

const AsyncComponent = () => ({
    // The component to load (should be a Promise)
    component: import('../admin/Trainingen.vue'),
    // A component to use while the async component is loading
    loading: 'LoadingComponent',
    // A component to use if the load fails
    error: 'ErrorComponent',
    // Delay before showing the loading component. Default: 200ms.
    delay: 200,
    // The error component will be displayed if a timeout is
    // provided and exceeded. Default: Infinity.
    timeout: 3000
});

new Vue({
    el: "#trainingen",
    components: { Trainingen }
});