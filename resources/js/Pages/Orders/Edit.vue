<template>
    <AppLayout>
        <div v-if="$page.props.auth.roles[0] === 'admin' || $page.props.auth.roles[0] === 'ventas' || $page.props.auth.roles[0] === 'despacho'">
            <div class="container">
                <div class="row">

                    <!-- Datos de la empresa -->
                    <div class="col-3 bg-white px-10 m-3 py-4">
                        <h4>
                            N° de órden: <span class="text-primary">{{ order.id }}</span>
                        </h4>

                        <div class="fw-bold mt-5">Fecha del pedido</div>
                        <div class="text-gray-600">{{ order.date }}</div>

                        <div class="fw-bold mt-5">N° de Cliente</div>
                        <div class="text-gray-600">{{ order.client_id }}</div>


                        <div class="fw-bold mt-5">Empresa</div>
                        <div class="text-gray-600"> {{ order.client.business_name }}</div>

                        <div class="fw-bold mt-5">Titular</div>
                        <div class="text-gray-600"> {{ order.client.surname + ", " + order.client.name }}</div>

                        <div class="fw-bold mt-5">Dirección</div>
                        <div class="text-gray-600">{{ order.client.address }}, {{ order.client.cities.name }}
                        </div>

                        <div class="fw-bold mt-5">Teléfono</div>
                        <div class="text-gray-600">{{ order.client.phone }}</div>
                    </div>
                    <!-- Datos de la órden  -->
                    <div class="col-8 bg-white px-10 m-3">

                        <h1 class="text text-center my-6">
                            Detalle del pedido
                            <button class="btn btn-sm btn-success btn-circle float-end" @click.prevent="printOrder">
                                <i class="fas fa-print"></i>
                            </button>
                        </h1>

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
                                                <td class="text-center">{{ detail.qty }}</td>
                                                <td>{{ detail.product.title }}</td>
                                                <td class="text-end">
                                                    <span class="me-4">$ {{ detail.up.toFixed(2) }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <span class="me-4">$ {{ detail.amount.toFixed(2) }}</span>
                                                </td>
                                            </tr>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th colspan="3" class="text-end">
                                                    <div class="fw-bold">Total:</div>
                                                </th>
                                                <th class="text-end">
                                                    <span class="text-primary me-4">${{ order.total.toFixed(2) }}</span>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="separator separator-dashed my-3"></div>

                                <div class="bg-dark p-2 text-dark bg-opacity-10 my-5 rounded">
                                    <div class="text text-center fw-bold m-2">Observación</div>
                                    <div class="text-gray-600">{{ order.observation }}</div>
                                    <div class="text text-left fw-bold m-2">Entrega pautada:
                                        <span class="text-primary me-4">{{ order.day }} {{ order.hour }}</span>
                                    </div>


                                    <div class="text text-center fw-bold m-2 mt-10"> Estado del Pedido</div>
                                    <div>
                                        <div v-if="order.status_id === 1">
                                            <h3 class="text text-center text-success">Enviado</h3>
                                        </div>
                                        <div v-if="order.status_id === 2">
                                            <h3 class="text text-center text-primary">Pendiente</h3>
                                        </div>
                                        <div v-if="order.status_id === 3">
                                            <h3 class="text text-center text-danger">Cancelado</h3>
                                        </div>
                                        <div class="text text-center mt-7" v-else>
                                            <div
                                                v-if="$page.props.auth.roles[0] === 'admin' || $page.props.auth.roles[0] === 'despacho'">

                                                <form @submit.prevent="submit" class="mb-6">
                                                    <span class="text-blue-600 font-bold p-4 text-left">Estado :</span>
                                                    <select v-model="form.status_id" aria-label="Default select example"
                                                        id="status_id">
                                                        <option v-for="st in statuses" :key="st.id"
                                                            v-bind:value="st.id">
                                                            {{ st.name }}
                                                        </option>
                                                    </select>

                                                    <button type="submit" class="ms-4 btn btn-sm btn-primary">
                                                        Procesar
                                                    </button>

                                                </form>


                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>


    </AppLayout>
</template>


<script>
import AppLayout from "@/Layouts/AppLayout";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        AppLayout,
        Link,
    },
    props: {
        order: Object,
        statuses: Object,
        errors: Object,


    },
    data() {
        return {
            form: {
                id: this.$props.order.id,
                status_id: this.$props.order.status_id,
                client_id: this.$props.order.client_id,
            },
        }
    },
    methods: {
        submit() {
            this.$inertia.put(
                route("orders.update", this.$props.order.status_id),
                this.form
            );
        },
        printOrder() {
            this.$inertia.get( route('orders.print', this.$props.order.id) )
        }
    },
};
</script>

<style scoped>
    .btn-circle{
        border-radius: 100%;
    }
</style>
