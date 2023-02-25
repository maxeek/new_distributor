<template>
    <AppLayout title="Lista de órdenes">

        <div
            v-if="$page.props.auth.roles[0] === 'admin' || $page.props.auth.roles[0] === 'ventas' || $page.props.auth.roles[0] === 'despacho'">

            <div v-if="!hidePreLoader">
                <pre-loader />
            </div>

            <div v-else class="card">

                <div class="card">
                    <div class="card-body py-3">

                        <Datatable :options="tableOptions" />

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Datatable from '@/components/Datatable'
import PreLoader from '@/components/PreLoader'

import OrderActionComponent from '@/Pages/Orders/components/Action'

export default {
    components: {
        AppLayout,
        Datatable,
        PreLoader,
        OrderActionComponent
    },
    data() {
        return {
            hidePreLoader: false,
            tableOptions: {},
        }
    },
    created() {
        this.getData()
    },
    methods: {
        getData() {
            axios.get(route('orders.supporting-data'))
                .then(response => {

                    const statuses = [
                        { text: "Todos", value: "all", selected: true },
                        ...response.data.statuses
                    ]

                    this.tableOptions = {
                        tableName: 'orders',
                        columns: [
                            {
                                title: 'Órden',
                                key: 'id',
                                type: 'text',
                                sortable: true
                            },
                            {
                                title: 'Fecha',
                                key: 'date',
                                type: 'text'
                            },
                            {
                                title: 'Empresa',
                                key: 'client_name',
                                type: 'text',

                            },
                            {
                                title: 'Estado',
                                key: 'status_name',
                                type: 'custom',
                                modifier: ( (value) => {

                                    let style = 'badge badge-'

                                    switch (value) {
                                        case 'Enviado':
                                            style += 'success'
                                            break;

                                        case 'Pendiente':
                                            style += 'primary'
                                            break;

                                        default:
                                            style += 'danger'
                                            break;
                                    }


                                    return {
                                        value,
                                        class: style
                                    }
                                })
                            },
                            {
                                title: 'Acciones',
                                type: 'component',
                                key: 'action',
                                componentName: OrderActionComponent
                            }
                        ],
                        source: route('orders.getOrders'),
                        search: true,
                        checkbox: false,
                        right_align: ['action'],
                        filters: [
                            {
                                title: 'Estado',
                                key: 'status',
                                type: 'dropdown',
                                languageType: "raw",
                                options: statuses
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
