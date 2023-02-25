<template>
    <AppLayout title="Editar stock">
        <div class="row g-7 pb-20">
            <div class="col-xl-8">
                <div class="card card-flush h-lg-100" id="kt_contacts_main">



                    <div class="card-body pt-5">
                        <form @submit.prevent="submit()" class="form">



                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    Producto:
                                </label>
                                <br>
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    {{  form.title  }}

                                </label>

                                <!-- <input type="text" class="form-control form-control-solid"
                                    :class="{ 'is-invalid': errors.title }" v-model="form.title" />
                                <div class="invalid-feedback" v-if="errors.title">
                                    {{  errors.title  }}
                                </div> -->
                            </div>

                            <div class="col-md-6">
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    Código de barra:
                                </label>

                                <br>
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    {{  form.barcode  }}

                                </label>

                                <!-- <input type="text" class="form-control form-control-solid"
                                    :class="{ 'is-invalid': errors.barcode }" v-model="form.barcode" />
                                <div class="invalid-feedback" v-if="errors.barcode">
                                    {{  errors.barcode  }}
                                </div> -->
                            </div>

                            <div class="separator mb-6"></div>

                            <div class="row mb-7">


                                <div class="col-md-6">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Stock</span>
                                    </label>

                                    <input type="number" min="0" class="form-control form-control-solid"
                                        :class="{ 'is-invalid': errors.stock }" v-model="form.stock" />
                                    <div class="invalid-feedback" v-if="errors.stock">
                                        {{  errors.stock  }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Alerta</span>
                                    </label>

                                    <input type="number" min="0" class="form-control form-control-solid"
                                        :class="{ 'is-invalid': errors.alert }" v-model="form.alert" />
                                    <div class="invalid-feedback" v-if="errors.alert">
                                        {{  errors.alert  }}
                                    </div>
                                </div>
                            </div>


                            <div class="separator mb-6"></div>

                            <div class="d-flex justify-content-end">
                                <Link :href="route('products.index')" data-kt-contacts-type="cancel"
                                    class="btn btn-light me-3">Cancelar</Link>

                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="row pb-20"></div>
        <div class="row pb-20"></div>
        <div class="row pb-20"></div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout'
import { useForm } from '@inertiajs/inertia-vue3'
import { defineProps, onMounted } from 'vue';

const props = defineProps({

    product: Object,
    errors: Object
})

const form = useForm({
    _method: 'PUT',

    stock: null,
    alert: null
});

onMounted(() => {

    form.title = props.product.title
    // form.detail = props.product.detail
    // form.category_id = props.product.category_id
    // form.variation = props.product.variation
    form.barcode = props.product.barcode
    // form.sku = props.product.sku
    // form.price = props.product.price,
    //     form.sale_price = props.product.sale_price
    form.stock = props.product.stock
    form.alert = props.product.alert

})

const submit = () => {
    form.post(route('products.updateStock', props.product.id), {
        onSuccess: () => {
            Swal.fire({
                text: "¡El formulario ha sido actualizado con éxito!",
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
