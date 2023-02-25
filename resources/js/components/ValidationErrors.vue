<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

const errors = computed(() => usePage().props.value.errors);
const hasErrors = computed(() => Object.keys(errors.value).length > 0);
</script>

<template>
    <div v-if="hasErrors" class="alertBranch">
        <div class="alert alert-warning alertBranch" role="alert">
            <p v-for="(error, key) in errors" :key="key">{{ error }}</p>
        </div>
    </div>
</template>
