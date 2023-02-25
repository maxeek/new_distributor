<template>
    <AppLayout title="Nuevo Producto">
        <div class="row g-7 pb-20">
            <div class="col-xl-8">
                <div class="card card-flush h-lg-100" id="kt_contacts_main">

                    <div class="card-header pt-7" id="kt_chat_contacts_header">
                        <div class="card-title">
                            <span class="svg-icon svg-icon-1 me-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                        fill="currentColor" />
                                    <path opacity="0.3"
                                        d="M17 22divC2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <h2>Ingrese los datos</h2>
                        </div>
                    </div>

                    <div class="card-body pt-5">
                        <form @submit.prevent="submit()" class="form">

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span class="required">Producto</span>
                                </label>

                                <input type="text" class="form-control form-control-solid"
                                    :class="{ 'is-invalid': errors.title }" v-model="form.title" />
                                <div class="invalid-feedback" v-if="errors.title">
                                    {{ errors.title }}
                                </div>
                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mt-3">Detalle</label>

                                <textarea class="form-control form-control-solid"
                                    :class="{ 'is-invalid': errors.detail }" v-model="form.detail" rows="3" />
                                <div class="invalid-feedback" v-if="errors.detail">
                                    {{ errors.detail }}
                                </div>
                            </div>

                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Categoría</span>
                                    </label>

                                    <select class="form-control form-control-solid"
                                        :class="{ 'is-invalid': errors.category_id }" v-model="form.category_id" @change="loadSubcategories">
                                        <option v-for="category in categories" :key="category.id" :value="category.id">
                                            {{ category.name }}</option>
                                    </select>
                                    <div class="invalid-feedback" v-if="errors.category_id">
                                        {{ errors.category_id }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Subcategoría</span>
                                    </label>

                                    <select class="form-control form-control-solid" :class="{ 'is-invalid': errors.subcategory_id }" v-model="form.subcategory_id">
                                        <option :value="null">-</option>
                                        <option v-for="subcategory in listSubcategories" :key="subcategory.id" :value="subcategory.id">{{ subcategory.name }}</option>
                                    </select>
                                    <div class="invalid-feedback" v-if="errors.subcategory_id">
                                        {{ errors.subcategory_id }}
                                    </div>
                                </div>
                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span class="required">Imagen</span>
                                </label>

                                <input type="file" class="form-control form-control-solid"
                                    :class="{ 'is-invalid': errors.file }" @input="form.file = $event.target.files[0]">
                                <div class="invalid-feedback" v-if="errors.file">
                                    {{ errors.file }}
                                </div>
                            </div>

                            <div class="separator mb-6"></div>

                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Código de barra</span>
                                    </label>

                                    <input type="text" class="form-control form-control-solid"
                                        :class="{ 'is-invalid': errors.barcode }" v-model="form.barcode" />
                                    <div class="invalid-feedback" v-if="errors.barcode">
                                        {{ errors.barcode }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">SKU</span>
                                    </label>

                                    <input type="text" class="form-control form-control-solid"
                                        :class="{ 'is-invalid': errors.sku }" v-model="form.sku" />
                                    <div class="invalid-feedback" v-if="errors.sku">
                                        {{ errors.sku }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Precio de compra</span>
                                    </label>

                                    <input type="number" min="0" step="any" class="form-control form-control-solid"
                                        :class="{ 'is-invalid': errors.price }" v-model="form.price" />
                                    <div class="invalid-feedback" v-if="errors.price">
                                        {{ errors.price }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Precio de venta</span>
                                    </label>

                                    <input type="number" min="0" step="any" class="form-control form-control-solid"
                                        :class="{ 'is-invalid': errors.sale_price }" v-model="form.sale_price" />
                                    <div class="invalid-feedback" v-if="errors.sale_price">
                                        {{ errors.sale_price }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Stock</span>
                                    </label>

                                    <input type="number" min="0" class="form-control form-control-solid"
                                        :class="{ 'is-invalid': errors.stock }" v-model="form.stock" />
                                    <div class="invalid-feedback" v-if="errors.stock">
                                        {{ errors.stock }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Alerta</span>
                                    </label>

                                    <input type="number" min="0" class="form-control form-control-solid"
                                        :class="{ 'is-invalid': errors.alert }" v-model="form.alert" />
                                    <div class="invalid-feedback" v-if="errors.alert">
                                        {{ errors.alert }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Variante</span>
                                    </label>
                                    <input type="number" class="form-control form-control-solid" step="1" min="1"
                                        :class="{ 'is-invalid': errors.variation }" v-model="form.variation">
                                    <div class="invalid-feedback" v-if="errors.variation">
                                        {{ errors.variation }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Orden</span>
                                    </label>
                                    <input type="number" class="form-control form-control-solid" step="1" min="1"
                                        :class="{ 'is-invalid': errors.order }" v-model="form.order">
                                    <div class="invalid-feedback" v-if="errors.order">
                                        {{ errors.order }}
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
import { defineProps, onMounted, ref } from 'vue';

const props = defineProps({
    categories: Array,
    subcategories: Array,
    product: Object,
    errors: Object
})

const form = useForm({
    _method: 'PUT',
    title: null,
    detail: null,
    category_id: null,
    subcategory_id: null,
    variation: null,
    file: null,
    barcode: null,
    sku: null,
    price: null,
    sale_price: null,
    stock: null,
    alert: null,
    order: null
});

onMounted(() => {

    form.title = props.product.title
    form.detail = props.product.detail
    form.category_id = props.product.category_id
    form.subcategory_id = props.product.subcategory_id
    form.variation = props.product.variation
    form.barcode = props.product.barcode
    form.sku = props.product.sku
    form.price = props.product.price
    form.sale_price = props.product.sale_price
    form.stock = props.product.stock
    form.alert = props.product.alert
    form.order = props.product.order

    loadSubcategories()

})

const listSubcategories = ref([])

const submit = () => {
    form.post(route('products.update', props.product.id), {
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

const loadSubcategories = () => {
    listSubcategories.value = []

    let filterSubcategories = props.subcategories.filter( subcategory => subcategory.category_id == form.category_id)

    listSubcategories.value = filterSubcategories
}
</script>
