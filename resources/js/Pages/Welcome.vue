<template>
    <Head title="Bienvenido" />

    <h1 class="text-center mt-5">Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})</h1>
</template>

<script setup>
defineProps({
    laravelVersion: String,
    phpVersion: String,
})
</script>

<style scoped></style>
