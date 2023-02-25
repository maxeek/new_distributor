<template>
    <AppLayout>
        <Pos :categories="categories" :subcategories="subcategories" :clients="clients" :isClient="isClient" />
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout'
import Pos from '@/components/Pos'

const props = defineProps({
    categories: Array,
    subcategories: Array,
    clients: Array,
    isClient: Boolean
})

</script>
