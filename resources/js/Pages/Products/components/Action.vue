<template>

    <!-- <button @click.prevent="openModalStock(rowData.id)"
        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
        <span class="svg-icon svg-icon-3">
            <inline-svg src="/images/icons/duotune/art/art002.svg" />
        </span>
    </button> -->

    <div v-if="$page.props.auth.roles[0] === 'almacén'">

        <Link :href="route('products.editstock', rowData.id)"
            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
        <span class="svg-icon svg-icon-3">
            <inline-svg src="/images/icons/duotune/art/art002.svg" />
        </span>
        </Link>

    </div>
    <div v-if="$page.props.auth.roles[0] === 'admin'">

        <Link :href="route('products.editstock', rowData.id)"
            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
        <span class="svg-icon svg-icon-3">
            <inline-svg src="/images/icons/duotune/art/art002.svg" />
        </span>
        </Link>

        <Link :href="route('products.edit', rowData.id)"
            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
        <span class="svg-icon svg-icon-3">
            <inline-svg src="/images/icons/duotune/art/art005.svg" />
        </span>
        </Link>
        <Link :href="route('products.destroy', rowData.id)" method="delete" as="button"
            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
        <span class="svg-icon svg-icon-3">
            <inline-svg src="/images/icons/duotune/general/gen027.svg" />
        </span>
        </Link>
    </div>
    <div class="modal fade" id="modalStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="stock" class="text-start">Stock</label>
                        <input type="number" v-model="form.stock" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" @click.prevent="submit">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'product-action-component',
    props: [
        'rowData'
    ],
    data() {
        return {
            form: this.$inertia.form({
                stock: null
            }),
            showModal: false
        }
    },
    methods: {
        // openModalStock() {
        //     this.form.stock = null
        //     $('#modalStock').modal('show')

        //     this.form.stock = this.rowData.stock
        // },
        submit() {
            this.form.put(route('products.updateStock', this.rowData.id), {
                onSuccess: () => {

                    $('#modalStock').modal('hide')

                    Swal.fire({
                        text: "¡El stock ha sido actualizado con éxito!",
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
    }
}
</script>
