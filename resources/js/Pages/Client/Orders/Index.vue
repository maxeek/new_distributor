<template>
    <ClientLayout title="Lista de órdenes">
        <div class="card">
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th class="min-w-150px">Órden</th>
                                <th class="min-w-150px">Fecha</th>
                                <th class="min-w-120px">Estado</th>
                                <th class="min-w-100px text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="order in orders.data" :key="order.id">
                                <tr>
                                    <td>{{ order.id }}</td>
                                    <td>{{ order.date }}</td>
                                    <td>

                                        <div v-if="order.status_id === 1" class="badge badge-success">
                                            {{ order.status.name }}
                                        </div>
                                        <div v-if="order.status_id === 2" class="badge badge-primary">
                                            {{ order.status.name }}
                                        </div>

                                        <div v-if="order.status_id === 3" class="badge badge-danger">
                                            {{ order.status.name }}
                                        </div>
                                    </td>

                                    <td class="text-end">
                                        <Link :href="route('client.orders.show', order.id)"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <span class="svg-icon svg-icon-3">
                                                <inline-svg src="/images/icons/duotune/art/art002.svg" />
                                            </span>
                                        </Link>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </ClientLayout>
</template>

<script setup>
import ClientLayout from '@/Layouts/ClientLayout'

defineProps({
    orders: Object,
})

</script>
