<template>
    <Head title="Iniciar sesión - Cliente" />

    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
        style="background-image: url('images/background/14.png');">
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <form @submit.prevent="submit" class="form w-100" id="kt_login_signin_form">
                    <div class="tetx-center mb-10">
                        <h1 class="text-dark mb-3">Bienvenido cliente</h1>
                    </div>

                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bold text-dark">Correo</label>
                        <input type="text" v-model="form.email" class="form-control form-control-lg form-control-solid">

                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">
                                {{ errors.email }}
                            </div>
                        </div>
                    </div>

                    <div class="fv-row mb-10">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bold text-dark fs-6 mb-0">Contraseña</label>

                            <Link :href="route('password.request')" class="link-primary fs-6 fw-bold">
                            ¿Olvidaste tu contraseña?
                            </Link>
                        </div>

                        <input type="password" v-model="form.password"
                            class="form-control form-control-lg form-control-solid">

                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">
                                {{ errors.password }}
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label"> Iniciar Sesión </span>

                            <span class="indicator-progress">
                                Cargando...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>

                        <div class="text-center text-muted text-uppercase fw-bold mb-5"></div>

                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex flex-center flex-column-auto p-10">
            <div class="d-flex align-items-center fw-semobold fs-6">
                <a href="#" class="text-muted text-hover-primary px-2">About</a>
                <a href="#" class="text-muted text-hover-primary px-2">Contact</a>
                <a href="#" class="text-muted text-hover-primary px-2">Contact Us</a>
            </div>
        </div>
    </div>
</template>

<script setup>

import { useForm } from '@inertiajs/inertia-vue3'
import ValidationErrors from '@/components/ValidationErrors.vue'

defineProps({
    status: String,
    errors: Object
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('client-login.submit'), {
        onFinish: () => form.reset('password'),
    });
}
</script>
