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
                        <span class="card-label fw-bold fs-3 mb-1">Condición de IVA</span>
                    </h3>

                    <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                        title="Click para registrar condición de IVA">
                        <Link :href="route('conditions.create')" class="btn btn-sm btn-light-primary">
                        <span class="svg-icon svg-icon-3">
                            <inline-svg src="/images/icons/duotune/arrows/arr075.svg" />
                        </span>
                        Agregar condición de IVA
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
                                    <th class="min-w-150px">Condición</th>
                                    <th class="min-w-140px">Alicuota</th>
                                    <!-- <th class="min-w-120px">Progress</th>  -->
                                    <th class="min-w-100px text-end">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="condition in conditions.data" :key="condition.id">
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

                                                    {{ condition.name }}



                                                </div>
                                            </div>
                                        </td>
                                        <td> {{ condition.aliquot }}%</td>
                                        <!-- <td class="text-end">
                                        <div
                                            class="d-flex flex-column w-100 me-2"
                                        >
                                            <div class="d-flex flex-stack mb-2">
                                                <span
                                                    class="text-muted me-2 fs-7 fw-semobold"
                                                >
                                                    50%
                                                </span>
                                            </div>

                                            <div class="progress h-6px w-100">
                                                <div
                                                    class="progress-bar bg-red"
                                                    role="progressbar"
                                                    style="width: 50%"
                                                    :aria-valuenow="50"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"
                                                ></div>
                                            </div>
                                        </div>
                                    </td> -->
                                        <td class="text-end">
                                            <!-- <a
                                            href="#"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                        >
                                            <span class="svg-icon svg-icon-3">
                                                <inline-svg
                                                    src="/images/icons/duotune/general/gen019.svg"
                                                />
                                            </span>
                                        </a> -->

                                            <Link :href="
                                                route(
                                                    'conditions.edit',
                                                    condition.id
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
                                                    'conditions.destroy',
                                                    condition.id
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
    conditions: Object,
});
</script>
