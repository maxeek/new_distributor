<template>
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

        <Navbar />

        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

            <Sidebar />

            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                <h1
                                    class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                    {{ title }}</h1>
                            </div>

                            <div class="d-flex align-items-center gap-2 gap-lg-3" v-if="options && options.register">
                                <a :href="route('products.export')" target="_blank" class="btn btn-sm fw-bold btn-success" v-if="route().current('products.*')">
                                    <i class="fa fa-file-excel"></i> Exportar
                                </a>
                                <button @click.prevent="updatePrice" class="btn btn-sm fw-bold btn-primary"
                                    v-if="route().current('products.*')">Actualizar precios
                                </button>
                                <Link :href="options.route" class="btn btn-sm fw-bold btn-primary">{{ options.title }}</Link>
                            </div>
                        </div>
                    </div>

                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <div id="kt_app_content_container" class="app-container container-xxl">
                            <slot />
                        </div>
                    </div>
                </div>

                <Footer />
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import Navbar from '@/components/Navbar'
import Sidebar from '@/components/Sidebar'
import Footer from '@/components/Footer'
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'

defineProps({
    title: String,
    options: {
        type: Object,
        require: false
    }
})
const form = useForm({
    name: null
})
const updatePrice = () => {

    console.log("fdjls")
    form.post(route('products.updatePrice'), {
        onStart: () => {
            console.log("iniciando")
            Swal.fire({
                text: "¡Actualizando precios!",
                icon: "success",
                showConfirmButton: false,
            });
        },
        onSuccess: () => {
            Swal.close();
        },
    })
}
</script>
