<template>
    <div>
        <h3>Testing</h3>
        <button class="btn btn-primary" @click="teller++">Teller: {{ teller }}</button>
    </div>
</template>

<script>
    export default {
        name: "App",
        data: () => ({
            teller: 0
        })
    }
</script>

<style scoped>

</style>