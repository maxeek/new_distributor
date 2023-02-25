<template>
    <!-- <AppLayout title="Órdenes" v-model="order.id">{{ order.id }} -->
    <ClientLayout>

        <!-- <div class="bg-white app-container container-xxl d-flex flex-stack"> -->
        <div class="container">


            <div class="row">

                <!-- Datos de la empresa -->
                <div class="col-3 bg-white px-10 m-3 py-4">
                    <h4>
                        N° de órden: <span class="text-primary">{{ order.id }}</span>
                        <!-- <div class="text text-center text-primary">{{ order.id }}</div> -->

                    </h4>
                    <div class="fw-bold mt-5">Fecha del pedido</div>
                    <div class="text-gray-600"> {{ order.date }}
                    </div>

                    <div class="fw-bold mt-5">Estado del pedido</div>
                    <div class="text-gray-600"> {{ order.status.name }}</div>

                    <div class="fw-bold mt-5">N° de Cliente</div>
                    <div class="text-gray-600">{{ order.client_id }}</div>


                    <div class="fw-bold mt-5">Empresa</div>
                    <div class="text-gray-600"> {{ order.client.business_name }}</div>

                    <div class="fw-bold mt-5">Titular</div>
                    <div class="text-gray-600"> {{ order.client.surname + ", " + order.client.name }}</div>

                    <div class="fw-bold mt-5">Dirección</div>
                    <div class="text-gray-600">{{ order.client.address }}, {{ order.client.cities ? order.client.cities.name : '' }}
                    </div>

                    <div class="fw-bold mt-5">Teléfono</div>
                    <div class="text-gray-600">{{ order.client.phone }}</div>

                </div>
                <!-- Datos de la órden  -->
                <div class="col-8 bg-white px-10 m-3">

                    <h1 class="text text-center my-6">Detalle del pedido</h1>

                    <div class="row mb-6">

                        <div class="col">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="table-dark">
                                        <tr class="text-center">
                                            <th scope="col"> Cantidad</th>
                                            <th scope="col"> Detalle</th>
                                            <th scope="col"> Precio</th>
                                            <th scope="col"> Importe</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="detail in order.details" :key="detail.id">
                                            <td class="text-center">
                                                {{ detail.qty }}
                                            </td>
                                            <td>
                                                {{ detail.product.title }} x {{ detail.product_variant }}

                                            </td>
                                            <td class="text-end">
                                                <span class="me-4">$ {{ detail.up }}</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="me-4">$ {{ detail.amount }}</span>
                                            </td>
                                        </tr>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end">
                                                <div class="fw-bold">Total:</div>
                                            </th>
                                            <th class="text-end">
                                                <span class="text-primary me-4">${{order.total}}</span>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="separator separator-dashed my-3"></div>

                            <div class="bg-dark p-2 text-dark bg-opacity-10 my-5 rounded">
                                <div class="text text-center fw-bold m-2">Observación</div>
                                <div class="text-gray-600">{{ order.observation }}</div>
                            </div>

                        </div>
                    </div>


                </div>

            </div>
        </div>


    </ClientLayout>
</template>


<script>
import ClientLayout from "@/Layouts/ClientLayout";

export default {
    components: {
        ClientLayout
    },
    props: {
        order: Object
    }
};
</script>
