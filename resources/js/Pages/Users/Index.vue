<template>
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
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Lista de usuarios</span>
                    </h3>

                    <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                        title="Click para registrar Usuario">
                        <Link :href="route('users.create')" class="btn btn-sm btn-light-primary">
                        <span class="svg-icon svg-icon-3">
                            <inline-svg src="/images/icons/duotune/arrows/arr075.svg" />
                        </span>
                        Agregar Usuario
                        </Link>
                    </div>
                </div>

                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bold text-muted">
                                    <!-- <th class="w-25px">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input type="checkbox" class="form-check-input" />
                                    </div>
                                </th> -->
                                    <th class="min-w-140px">Usuario</th>
                                    <th class="min-w-140px">Correo electrónico</th>
                                    <!-- <th class="min-w-120px">Progress</th>  -->
                                    <th class="min-w-100px text-end">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="user in users.data" :key="user.id">
                                    <tr>
                                        <!-- <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input widget-9-check" type="checkbox" />
                                        </div>
                                    </td> -->
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <!-- <div class="symbol symbol-45px me-5">
                                                <img src="/images/avatars/300-1.jpg" alt="" />
                                            </div> -->
                                                <div class="d-flex justify-content-start flex-column">

                                                    {{ user.name }}



                                                </div>
                                            </div>
                                        </td>
                                        <td> {{ user.email }}</td>

                                        <td class="text-end">



                                            <Link :href="
                                                route(
                                                    'users.edit',
                                                    user.id
                                                )
                                            " class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <span class="svg-icon svg-icon-3">
                                                <inline-svg src="/images/icons/duotune/art/art005.svg" />
                                            </span>
                                            </Link>

                                            <!-- <a
                                            href="#"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                        >
                                            <span class="svg-icon svg-icon-3">
                                            <inline-svg
                                                src="/images/icons/duotune/general/gen027.svg"
                                            />
                                            </span>
                                        </a> -->
                                            <Link method="delete" :href="
                                                route(
                                                    'users.destroy',
                                                    user.id
                                                )
                                            " class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
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
    users: Object,
});
</script>
