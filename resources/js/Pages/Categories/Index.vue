<template>

    <!-- <AppLayout title="Lista de categorías" :options="options"> -->
    <AppLayout>
        <div v-if="$page.props.auth.roles[0] !== 'admin'">
            <div class="container-fluid">
                <div class="row p-19">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                <div class="jumbotron">
                                    <h1 class="text-center text-danger">
                                        Atención!!!
                                    </h1>
                                    <br>

                                    <h3 class="text-center">
                                        Acceso denegado
                                    </h3>
                                    <p class="text-center">
                                        No tiene permisos para acceder
                                    </p>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>


                                </div>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div v-if="$page.props.auth.roles[0] === 'admin'">
            <div class="card">
                <div class="card-body py-3">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">Categorías</span>
                        </h3>

                        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-trigger="hover" title="Click para registrar localidad">
                            <Link :href="route('categories.create')" class="btn btn-sm btn-light-primary">
                            <span class="svg-icon svg-icon-3">
                                <inline-svg src="/images/icons/duotune/arrows/arr075.svg" />
                            </span>
                            Nueva categoría
                            </Link>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bold text-muted">
                                    <th class="min-w-150px">Nombre</th>
                                    <th>Categoría principal</th>
                                    <th class="min-w-100px text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="category in categories.data" :key="category.id">
                                    <tr>
                                        <td>{{ category.name }}</td>
                                        <td>{{ category.category ? category.category.name : '-' }}</td>
                                        <td class="text-end">

                                            <Link :href="
                                                route(
                                                    'categories.edit',
                                                    category.id
                                                )
                                            " class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <span class="svg-icon svg-icon-3">
                                                <inline-svg src="/images/icons/duotune/art/art005.svg" />
                                            </span>
                                            </Link>

                                            <Link :href="route('categories.destroy', category.id)" method="delete"
                                                as="button"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                            <span class="svg-icon svg-icon-3">
                                                <inline-svg src="/images/icons/duotune/general/gen027.svg" />
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
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout";

defineProps({
    categories: Object,
})

const options = {
    register: true,
    route: route('categories.create'),
    title: 'Nueva categoría'
}
</script>
