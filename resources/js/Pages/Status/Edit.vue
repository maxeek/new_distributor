<template>
    <!-- <AppLayout title="Editar Categoría"> -->
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

                <!-- <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Categoría</span>
                </h3>
            </div> -->

                <div class="card-body py-3">
                    <el-form @submit.prevent="submit()" class="form">
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Editar estado</h1>

                            <!-- <div class="text-gray-400 fw-semobold fs-5">
                            If you need more info, please check
                            <a href="#" class="fw-bold link-primary">Project Guidelines</a>.
                        </div> -->
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semobold mb-2">
                                <span class="required">Nombre</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>

                            <el-form-item prop="name">
                                <el-input v-model="form.name" name="name"></el-input>
                                <div class="el-form-item__error" v-if="props.errors.name">{{ props.errors.name }}</div>
                            </el-form-item>
                        </div>

                        <div class="text-end">
                            <Link :href="route('cities.index')" class="btn btn-lg btn-dark">
                            Cancelar
                            <span class="svg-icon svg-icon-3 ms-2 me-0">
                                <inline-svg src="/images/icons/duotune/arrows/arr088.svg" />
                            </span>
                            </Link>
                            <button type="submit" class="ms-2 btn btn-lg btn-primary">
                                Guardar
                                <span class="svg-icon svg-icon-3 ms-2 me-0">
                                    <inline-svg src="/images/icons/duotune/arrows/arr064.svg" />
                                </span>
                            </button>
                        </div>
                    </el-form>
                </div>

            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout'
import { useForm } from '@inertiajs/inertia-vue3'
import { defineProps, onMounted } from 'vue';

const props = defineProps({
    status: Object,
    errors: Object
})

const form = useForm({
    name: null
});

onMounted(() => {
    form.name = props.status.name
})

const submit = () => {
    form.put(route('status.update', props.status.id), {
        onSuccess: () => {
            Swal.fire({
                text: "¡Los datos han sido actualizados con éxito!",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "¡Ok, genial!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
            })
        }
    })
}
</script>
