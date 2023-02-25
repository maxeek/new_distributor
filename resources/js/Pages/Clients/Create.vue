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
                            <h1 class="mb-3">Crear cliente</h1>


                        </div>

                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semobold mb-2">
                                <span class="required">Empresa</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>

                            <el-form-item prop="name">
                                <el-input v-model="form.business_name" name="business_name"></el-input>
                                <div class="el-form-item__error" v-if="props.errors.business_name">
                                    {{ props.errors.business_name }}
                                </div>
                            </el-form-item>
                        </div>


                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semobold mb-2">
                                <span class="required">CUIT</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>

                            <el-form-item prop="name">
                                <el-input v-model="form.cuit" name="cuit" type="number"></el-input>
                                <div class="el-form-item__error" v-if="props.errors.cuit">
                                    {{ props.errors.cuit }}
                                </div>
                            </el-form-item>
                        </div>


                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semobold mb-2">
                                <span class="required">Apellido</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>

                            <el-form-item prop="name">
                                <el-input v-model="form.surname" name="surname"></el-input>
                                <div class="el-form-item__error" v-if="props.errors.surname">
                                    {{ props.errors.surname }}
                                </div>
                            </el-form-item>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semobold mb-2">
                                <span class="required">Nombres</span>
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
                                <span class="required">Dirección</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>

                            <el-form-item prop="name">
                                <el-input v-model="form.address" name="address"></el-input>
                                <div class="el-form-item__error" v-if="props.errors.address">
                                    {{ props.errors.address }}
                                </div>
                            </el-form-item>
                        </div>







                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semobold mb-2">
                                <span class="required">Localidad</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>

                            <select v-model="form.city_id" class="form-select form-select-lg mb-3"
                                aria-label=".form-select-lg example" id="city_id">
                                <option v-for="city in cities" :key="city.id" v-bind:value="city.id">
                                    {{ city.name }}
                                </option>
                            </select>
                        </div>




                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semobold mb-2">
                                <span>Teléfono</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>

                            <el-form-item prop="name">
                                <el-input v-model="form.phone" name="phone"></el-input>
                                <div class="el-form-item__error" v-if="props.errors.phone">
                                    {{ props.errors.phone }}
                                </div>
                            </el-form-item>
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semobold mb-2">
                                <span class="required">Correo</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>

                            <el-form-item prop="name">
                                <el-input v-model="form.email" name="email" type="email"></el-input>
                                <div class="el-form-item__error" v-if="props.errors.email">
                                    {{ props.errors.email }}
                                </div>
                            </el-form-item>
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semobold mb-2">
                                <span class="required">Condición de IVA</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>

                            <select v-model="form.condition_id" class="form-select form-select-lg mb-3"
                                aria-label=".form-select-lg example" id="condition_id">
                                <option v-for="condition in conditions" :key="condition.id" v-bind:value="condition.id">
                                    {{ condition.name }}
                                </option>
                            </select>
                        </div>







                        <div class="text-end">
                            <Link :href="route('clients.index')" class="btn btn-lg btn-dark">
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
import AppLayout from "@/Layouts/AppLayout";
import { useForm } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";

const props = defineProps({
    errors: Object,
    cities: Array,
    conditions: Array,
});

const form = useForm({
    condition_id: null,
    city_id: null,
    cuit: null,
    business_name: null,
    surname: null,
    name: null,
    address: null,
    email: null,
    phone: null,
});

const submit = () => {
    form.post(route("clients.store"), {
        onSuccess: () => {
            Swal.fire({
                text: "¡Los datos han sido enviados con éxito!",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "¡Ok, genial!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
            });
        },
    });
};
</script>
