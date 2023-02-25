<template>

    <Link :href="route('clients.edit', rowData.id)"
        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
        <span class="svg-icon svg-icon-3">
            <inline-svg src="/images/icons/duotune/art/art005.svg" />
        </span>
    </Link>

</template>

<script>
export default {
    name: 'client-action-component',
    props: [
        'rowData'
    ]
}
</script>
