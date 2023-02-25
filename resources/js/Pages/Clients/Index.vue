<template>
    <AppLayout title="Lista de clientes" :options="options">
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

import ClientActionComponent from '@/Pages/Clients/components/Action'


export default {
    components: {
        AppLayout,
        Datatable,
        PreLoader,
        ClientActionComponent
    },
    data() {
        return {
            hidePreLoader: false,
            tableOptions: {},
            options: {
                register: true,
                route: route('clients.create'),
                title: 'Nuevo cliente'
            }
        }
    },
    created() {
        this.getData()
    },
    methods: {
        getData() {
            this.tableOptions = {
                tableName: 'clients',
                columns: [
                    {
                        title: 'Empresa',
                        key: 'business_name',
                        type: 'text',
                        sortable: true
                    },
                    {
                        title: 'Apellidos',
                        key: 'surname',
                        type: 'text',
                        sortable: true
                    },
                    {
                        title: 'Nombres',
                        key: 'name',
                        type: 'text',
                        sortable: true
                    },
                    {
                        title: 'Acciones',
                        type: 'component',
                        key: 'action',
                        componentName: ClientActionComponent
                    }
                ],
                source: route('clients.getClients'),
                search: true,
                checkbox: false,
                right_align: ['action']
            }

            this.hidePreLoader = true
        }
    }
}
</script>
