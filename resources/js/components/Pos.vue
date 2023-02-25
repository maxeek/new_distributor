<template>
    <div class="d-flex flex-column flex-xl-row">
        <div class="d-flex flex-row-fluid me-xl-9 mb-2 mb-xl-0">
            <div class="card card-flush card-p-0 bg-transparent border-0">
                <div class="card-body">

                    <div class="row mb-4">
                        <template v-if="viewPanel == 'subcategory'">
                            <div class="col-12">
                                <button class="btn btn-sm btn-primary" @click.prevent="backCategory()"><i
                                        class="fas fa-chevron-left"></i> Regresar</button>
                            </div>
                        </template>
                        <template v-if="viewPanel == 'product'">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Buscar</label>
                                    <input id="search" type="search" class="form-control" placeholder="Buscando..."
                                        @keyup="searchData" v-model="formSearch.search">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="">&nbsp;</label>
                                <button class="btn btn-sm btn-primary float-end" @click.prevent="backSubcategory()"><i
                                        class="fas fa-chevron-left"></i> Regresar</button>
                            </div>
                        </template>
                    </div>

                    <div class="row mb-4 scroll" style="display: flex; height: 450px; overflow-y: scroll;">
                        <template v-if="viewPanel == 'category'">
                            <div v-for="category in categories" :key="category.id" class="col-xl-4 col-sm-3" role="button"
                                @click="filterSubcategory(category.id)">
                                <div class="card card-flush p-6 pb-5 mw-100 mb-3">
                                    <div class="card-body text-center">
                                        <img :src="category.img != null ? '/storage/categories/' + category.img : '/images/default-product.png'"
                                            class="rounded-3 mb-4 w-100" alt="" />

                                        <div class="mb-2">
                                            <div class="text-center">
                                                <span
                                                    class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">{{
                                                        category.name
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <template v-else-if="viewPanel == 'subcategory'">
                            <template v-if="listSubcategories.length > 0">
                                <div v-for="subcategory in listSubcategories" :key="subcategory.id"
                                    class="col-xl-4 col-sm-3" role="button" @click="filterProduct(subcategory.id)">
                                    <div class="card card-flush p-6 pb-5 mw-100 mb-3">
                                        <div class="card-body text-center">
                                            <img :src="subcategory.img != null ? '/storage/categories/' + subcategory.img : '/images/default-product.png'"
                                                class="rounded-3 mb-4 w-100" alt="" />

                                            <div class="mb-2">
                                                <div class="text-center">
                                                    <span
                                                        class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">{{
                                                            subcategory.name
                                                        }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                                <div class="col-12">
                                    <div class="card card-flush p-6 pb-5 mw-100 mb-3">
                                        <h3 class="text-center">No existen subcategorías</h3>
                                    </div>
                                </div>
                            </template>
                        </template>

                        <template v-else-if="viewPanel == 'product'">
                            <template v-if="listProducts.length > 0">
                                <div v-for="(product, index) in listProducts"
                                    v-show="(form.pag - 1) * form.num_results <= index && form.pag * form.num_results > index"
                                    :key="product.id" class="col-xl-4 col-sm-3" :class="{ 'disabled': product.stock == 0 }"
                                    @click="product.stock <= 0 ? '' : addToCart(product)" role="button">
                                    <div class="card card-flush p-6 pb-5 mw-100 mb-3">
                                        <div class="card-body text-center">

                                            <div class="check" v-if="form.cart.some(x => x.productId == product.id)">
                                                <i class="fa fa-check-circle fa-2x"></i>
                                            </div>

                                            <img :src="product.img != null ? '/storage/products/' + product.img : '/images/default-product.png'"
                                                class="rounded-3 mb-4 w-100" alt="" />

                                            <div class="mb-2">
                                                <div class="text-center">
                                                    <span
                                                        class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">{{
                                                            product.title
                                                        }}</span>
                                                </div>
                                            </div>

                                            <span class="text-success text-end fw-bold fs-1" v-if="product.stock > 0">{{
                                                product.sale_price.toFixed(2) }}</span>
                                            <span class="text-success text-end fw-bold fs-1" v-else>SIN STOCK</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-sm btn-primary me-3 anterior" v-show="form.pag != 1"
                                        @click.prevent="backPage">
                                        <span aria-hidden="true">Anterior</span>
                                    </button>
                                    <button class="btn btn-sm btn-primary siguiente"
                                        v-show="form.pag * form.num_results / listProducts.length < 1"
                                        @click.prevent="nextPage">
                                        <span aria-hidden="true">Siguiente</span>
                                    </button>
                                </div>
                            </template>
                            <template v-else>
                                <div class="col-12">
                                    <div class="card card-flush p-6 pb-5 mw-100 mb-3">
                                        <h3 class="text-center">No existen productos</h3>
                                    </div>
                                </div>
                            </template>
                        </template>

                    </div>
                </div>
            </div>
        </div>

        <div class="flex-row-auto w-xl-425px">
            <div class="card card-flush bg-body" id="kt_pos_form">
                <div class="card-header pt-5">
                    <h6 class="text-gray-800">Carrito</h6>


                </div>
                <div class="card-body pt-0">

                    <div class="table-responsive mb-8" v-if="form.cart.length > 0">
                        <table class="table align-middle gs-0 gy-4 my-0" style="white-space: nowrap;">
                            <thead>
                                <tr>
                                    <th class="min-w-175px">Producto</th>
                                    <th class="w-125px"></th>
                                    <th class="w-60px">Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in form.cart" :key="item.id" :data-kt-pos-element="item"
                                    :data-kt-pos-item-price="item.price">
                                    <td class="pe-0">
                                        <div class="d-flex align-items-center">
                                            <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-6 me-1">
                                                {{ `${item.name} x ${item.variation}` }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="pe-0">
                                        <!--begin::Dialer-->
                                        <div class="position-relative d-flex align-items-center" data-kt-dialer="true"
                                            data-kt-dialer-min="1" data-kt-dialer-max="10" data-kt-dialer-step="1"
                                            data-kt-dialer-decimals="0">
                                            <!--begin::Decrease control-->
                                            <button @click="addQty(item, -1)" type="button"
                                                class="btn btn-icon btn-sm btn-light btn-icon-gray-400"
                                                data-kt-dialer-control="decrease">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                                <span class="svg-icon svg-icon-3x">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect x="6" y="11" width="12" height="2" rx="1"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                            <!--end::Decrease control-->
                                            <!--begin::Input control-->
                                            <input v-model="item.qty" type="text"
                                                class="form-control border-0 text-center px-0 fs-3 fw-bold text-gray-800 w-30px"
                                                @keypress="addQty(item, null)" />
                                            <!--end::Input control-->
                                            <!--begin::Increase control-->
                                            <button @click="addQty(item, 1)" type="button"
                                                class="btn btn-icon btn-sm btn-light btn-icon-gray-400"
                                                data-kt-dialer-control="increase">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                <span class="svg-icon svg-icon-3x">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1"
                                                            transform="rotate(-90 11 18)" fill="currentColor" />
                                                        <rect x="6" y="11" width="12" height="2" rx="1"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                            <!--end::Increase control-->
                                        </div>
                                        <!--end::Dialer-->
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-primary fs-2" data-kt-pos-element="item-total">
                                            {{ item.price.toFixed(2) }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <!--begin::Summary-->
                    <div class="d-flex flex-stack bg-success rounded-3 p-6 mb-11" v-if="form.cart.length > 0">
                        <!--begin::Content-->
                        <div class="fs-6 fw-bold text-white">
                            <span class="d-block lh-1 mb-2">Subtotal</span>
                            <span class="d-block mb-2">Descuento</span>
                            <span class="d-block fs-2qx lh-1">Total</span>
                        </div>
                        <!--end::Content-->
                        <!--begin::Content-->
                        <div class="fs-6 fw-bold text-white text-end">
                            <span class="d-block lh-1 mb-2" data-kt-pos-element="total">
                                {{ priceFormat(getSubtotalPrice) }}
                            </span>
                            <span class="d-block mb-2" data-kt-pos-element="discount">
                                $ <input type="text" v-model="form.discount" style="max-width: 50px; text-align: end;">
                            </span>
                            <span class="d-block fs-2qx lh-1" data-kt-pos-element="grant-total">
                                {{ priceFormat(getTotalPrice) }}
                            </span>
                        </div>
                        <!--end::Content-->
                    </div>

                    <template v-if="form.cart.length > 0">

                        <button @click="clear" type="button" class="btn btn-light-danger">
                            <i class="fas fa-trash"></i> Eliminar todo
                        </button>

                        <div class="fv-row mb-7" v-if="!isClient">
                            <label class="fw-semibold form-label mt-3">
                                <span class="required">Cliente</span>
                            </label>

                            <select class="form-control form-control-solid" v-model="form.client_id">
                                <option v-for="client in clients" :key="client.id" :value="client.id">{{
                                    client.business_name
                                }}</option>
                            </select>
                        </div>

                        <div lass="fv-row mb-7">
                            <label class="fs-6 fw-semibold form-label mt-3">
                                <span class="required">Día</span>
                            </label>
                            <select v-model="form.day" class="m-2 fs-6 fw-semibold form-control mt-3" name="day">
                                <option value="Lunes" selected>Lunes</option>
                                <option value="Martes">Martes </option>
                                <option value="Miércoles">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sábado">Sábado</option>
                            </select>
                        </div>

                        <div lass="fv-row mb-7">
                            <label class="m-2 fs-6 fw-semibold form-label mt-3">
                                <span class="required">Hora</span>
                            </label>
                            <select v-model="form.hour" class="m-2 fs-6 fw-semibold form-control mt-3" name="hour">
                                <option value="8:00" selected>8:00</option>
                                <option value="9:00">9:00 </option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                            </select>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold form-label mt-3">Observación</label>
                            <textarea class="form-control form-control-solid" v-model="form.observation"
                                rows="5"></textarea>
                        </div>

                        <button @click.prevent="submit" class="btn btn-primary fs-1 w-100 py-4">Registrar</button>
                    </template>

                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
import { computed, onMounted, ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
    categories: Array,
    subcategories: Array,
    clients: Array,
    isClient: Boolean
})

const form = useForm({
    client_id: null,
    observation: null,
    day: null,
    hour: null,
    discount: 0,
    cart: [],
    buttonLoader: false,
    isDisabled: false,
    hidePreLoader: false,

    num_results: 12, // Numero de resultados por página
    pag: 1, // Página inicial> 0
})

const formSearch = useForm({
    search: null,
    category_id: null,
    subcategory_id: null
})

const viewPanel = ref('category')
const listSubcategories = ref([])
const listProducts = ref([])

const getSubtotalPrice = computed(() => {
    return form.cart.reduce(
        (total, item) => total + item.qty * item.price,
        0
    ).toFixed(2)
})

const getTotalPrice = computed(() => {
    return (getSubtotalPrice.value - form.discount).toFixed(2)
})

const addToCart = (product => {
    const index = findCartIndex(product)

    if (index === -1) {
        form.cart.push({
            productId: product.id,
            name: product.title,
            variation: product.variation,
            price: product.sale_price * product.variation,
            qty: 1
        })
    } else {
        form.cart[index].qty += 1
    }

    syncLocalStorage()

    beep()
})

const findCartIndex = (product => {
    return form.cart.findIndex((p) => p.productId === product.id)
})

const addQty = ((item, qty) => {
    const index = form.cart.findIndex((i) => i.productId === item.productId)

    if (index === -1) {
        return
    }

    let afterAdd = parseInt(item.qty)

    if (qty != null) {
        afterAdd = parseInt(item.qty) + qty
    }

    if (afterAdd === 0) {
        form.cart.splice(index, 1)
        clearSound()
    } else {
        form.cart[index].qty = afterAdd
        beep()
    }

    syncLocalStorage()

})

const beep = (() => {
    playSound("/sound/beep-29.mp3")
})

const clearSound = (() => {
    playSound("/sound/button-21.mp3")
})

const playSound = (src => {
    const sound = new Audio()
    sound.src = src
    sound.play()
})

const priceFormat = (number => {
    return number ? `$ ${number}` : `$ 0`
})

const clear = (() => {
    form.cart = []
    form.observation = null
    form.day = null
    form.hour = null
    form.discount = 0

    localStorage.removeItem('cart')

    clearSound()
})

const submit = (() => {

    if (form.client_id == '') {
        Swal.fire({
            text: "Debe seleccionar un cliente",
            icon: "warning",
            buttonsStyling: false,
            confirmButtonText: "Ok",
            customClass: {
                confirmButton: "btn btn-primary",
            },
        })
        return
    }

    form.transform(data => ({
        ...data,
        subtotal: getSubtotalPrice.value,
        total: getTotalPrice.value
    })).post(props.isClient ? route('client.orders.store') : route('orders.store'), {
        onStart: () => {
            Swal.fire({
                text: "¡Procesando el pedido!",
                icon: "success",
                showConfirmButton: false
            })
        },
        onSuccess: () => {
            Swal.close()

            localStorage.removeItem('cart')
        }
    })
})

const searchData = (() => {
    let timer;
    form.pag = 1

    if (formSearch.search) {
        if (timer) {
            clearTimeout(timer)
        }

        timer = setTimeout(() => {
            readData()
        }, 400)
    } else {
        readData()
    }
})

const readData = (() => {

    axios.post(route('pos.filterProduct'), formSearch)
        .then(response => {
            listProducts.value = response.data
            viewPanel.value = 'product'
        })
})

const filterSubcategory = ((category_id) => {
    let list = props.subcategories.filter(subcategory => subcategory.category_id == category_id)

    listSubcategories.value = list
    viewPanel.value = 'subcategory'
    formSearch.category_id = category_id
})

const backCategory = (() => {
    viewPanel.value = 'category'
    formSearch.category_id = null
})

const filterProduct = ((subcategory_id) => {

    formSearch.subcategory_id = subcategory_id

    searchData()
})

const backSubcategory = (() => {
    viewPanel.value = 'subcategory'
    formSearch.subcategory_id = null
})

const syncLocalStorage = () => {
    localStorage.setItem('cart', JSON.stringify(form.cart))
}

onMounted(() => {
    form.cart = JSON.parse(localStorage.getItem('cart')) || [];
})

const backPage = () => {
    form.pag -= 1
    document.querySelector(".scroll").scrollTop = 0
}

const nextPage = () => {
    form.pag += 1
    document.querySelector(".scroll").scrollTop = 0
}

</script>

<style scoped>
.check {
    position: absolute;
    top: 10px;
    left: 150px;
    right: 0;
    margin: 0 auto;
}

.check i {
    color: green;
}
</style>
