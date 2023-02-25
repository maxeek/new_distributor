<template>
    <AppLayout title="Lista de productos" :options="options">

        <div v-if="$page.props.auth.roles[0] !== 'admin' && $page.props.auth.roles[0] !== 'almacén'">
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

        <div v-if="$page.props.auth.roles[0] == 'admin' || $page.props.auth.roles[0] == 'almacén'">


            <div v-if="!hidePreLoader">
                <pre-loader />
            </div>

            <div v-else class="card">
                <div class="card-body py-3">

                    <Datatable :options="tableOptions" />

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Datatable from '@/components/Datatable'
import PreLoader from '@/components/PreLoader'

import ProductActionComponent from '@/Pages/Products/components/Action'

export default {
    components: {
        AppLayout,
        Datatable,
        PreLoader,
        ProductActionComponent
    },
    data() {
        return {
            hidePreLoader: false,
            tableOptions: {},
            options: {
                register: true,
                route: route('products.create'),
                title: 'Nuevo producto'
            }
        }
    },
    created() {
        this.getData()
    },
    methods: {
        getData() {
            axios.get(route('products.supporting-data'))
                .then(response => {

                    const categories = [
                        { text: "Todos", value: "all", selected: true },
                        ...response.data.categories
                    ]

                    this.tableOptions = {
                        tableName: 'products',
                        columns: [
                            {
                                title: 'Código',
                                key: 'barcode',
                                type: 'text'
                            },
                            {
                                title: 'Producto',
                                key: 'title',
                                type: 'text'
                            },
                            {
                                title: 'Categoría',
                                key: 'category_name',
                                type: 'text',
                                sortable: true
                            },
                            {
                                title: 'Precio',
                                key: 'sale_price',
                                type: 'text'
                            },
                            {
                                title: 'Acciones',
                                type: 'component',
                                key: 'action',
                                componentName: ProductActionComponent
                            }
                        ],
                        source: route('products.getProduct'),
                        search: true,
                        checkbox: false,
                        right_align: ['action', 'sale_price'],
                        filters: [
                            {
                                title: 'Categoría',
                                key: 'category',
                                type: 'dropdown',
                                languageType: "raw",
                                options: categories
                            }
                        ]
                    }
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => {
                    this.hidePreLoader = true
                })
        }
    }
}

</script>
