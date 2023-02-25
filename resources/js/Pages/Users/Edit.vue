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


                <div class="card-body py-3">
                    <el-form @submit.prevent="submit()" class="form">
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Editar Usuario</h1>


                        </div>

                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semobold mb-2">
                                <span class="required">Nombre de usario</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>

                            <el-form-item prop="name">
                                <el-input v-model="form.name" name="name"></el-input>
                                <div class="el-form-item__error" v-if="props.errors.name">
                                    {{ props.errors.name }}
                                </div>
                            </el-form-item>
                        </div>


                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semobold mb-2">
                                <span class="required">Correo electrónico</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>

                            <el-form-item prop="email">
                                <el-input v-model="form.email" name="email"></el-input>
                                <div class="el-form-item__error" v-if="props.errors.email">
                                    {{ props.errors.email }}
                                </div>
                            </el-form-item>

                            <label class="d-flex align-items-center fs-6 fw-semobold mb-2">
                                <span class="required">Contraseñao</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <el-form-item prop="password">
                                <el-input v-model="form.password" name="password"></el-input>
                                <div class="el-form-item__error" v-if="props.errors.password">
                                    {{ props.errors.password }}
                                </div>
                            </el-form-item>

                            <div class="d-flex flex-column mb-8 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semobold mb-2">
                                    <span class="required">Rol</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                        title="Specify a target name for future usage and reference"></i>
                                </label>

                                <select v-model="form.rol" class="form-select form-select-lg mb-3"
                                    aria-label="form-select-lg example" id="rol">
                                    <option v-for="rol in roles" :key="rol.id" v-bind:value="rol.id">
                                        {{ rol.name }}
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class="text-end">
                            <Link :href="route('users.index')" class="btn btn-lg btn-dark">
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
    user: Object,
    roles: Object,
    errors: Object
})

const form = useForm({
    name: null,
    password: null,
    email: null,
    rol: null,

});

onMounted(() => {
    form.name = props.user.name,
        form.password = props.user.password,
        form.email = props.user.email,
        form.rol = props.user.rol
})

const submit = () => {
    form.put(route('users.update', props.user.id), {
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
