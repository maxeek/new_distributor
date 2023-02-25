<template>
    <ClientLayout title="POS">
        <Pos :categories="categories" :subcategories="subcategories" :isClient="isClient" :client_id="client_id" />
    </ClientLayout>
</template>

<script setup>
import ClientLayout from '@/Layouts/ClientLayout'
import Pos from '@/components/Pos'

defineProps({
    categories: Array,
    subcategories: Array,
    isClient: Boolean,
    client_id: Number
})

</script>
