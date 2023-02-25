<template>
    <AppLayout title="Nueva Categoría">
        <div class="card">

            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Categoría</span>
                </h3>
            </div>

            <div class="card-body py-3">
                <el-form @submit.prevent="submit()" class="form">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Set First Target</h1>

                        <div class="text-gray-400 fw-semobold fs-5">
                            If you need more info, please check
                            <a href="#" class="fw-bold link-primary">Project Guidelines</a>.
                        </div>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semobold mb-2">
                            <span class="required">Nombre</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                            data-bs-toggle="tooltip"
                            title="Specify a target name for future usage and reference"></i>
                        </label>

                        <el-form-item prop="name">
                            <el-input v-model="form.name" name="name"></el-input>
                            <div class="el-form-item__error" v-if="props.errors.name">{{ props.errors.name }}</div>
                        </el-form-item>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-lg btn-primary">
                            Guardar
                            <span class="svg-icon svg-icon-3 ms-2 me-0">
                                <inline-svg src="/images/icons/duotune/arrows/arr064.svg" />
                            </span>
                        </button>
                    </div>
                </el-form>
            </div>

        </div>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout'
    import { useForm } from '@inertiajs/inertia-vue3'
    import { defineProps } from 'vue'

    const props = defineProps({
        errors: Object
    })

    const form = useForm({
        name: ''
    });

    const submit = () => {
        form.post( route('categories.store'), {
            onSuccess: () => {
                Swal.fire({
                    text: "¡El formulario ha sido enviado con éxito!",
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
