<template>
    <div class="d-table w-100 large-loader-container">
        <div class="d-table-cell align-middle">
            <div class="loader"></div>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>

<style scoped>
    .large-loader-container {
    height: 55vh;
    }

    .small-loader-container {
    height: 25vh !important;
    }

    .loader {
    margin: auto;
    width: 50px;
    height: 50px;
    border: 4px solid #f3f3f3;
    border-radius: 50%;
    border-top: 4px solid #45a2ff;
    border-right: 4px solid #45a2ff;
    border-bottom: 4px solid #45a2ff;
    -webkit-animation: spin 1.5s linear infinite;
    animation: spin 1s linear infinite;
    }

    .loader-small {
    width: 30px;
    height: 30px;
    }

    .loader-large {
    width: 80px;
    height: 80px;
    }

    @-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
    }
    }

    @keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
    }
    }
</style>
