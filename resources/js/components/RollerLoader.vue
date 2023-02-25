<template>
    <div class="spinner"></div>
</template>

<style scoped>
    @keyframes spinner {
        to {
            -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
        }
    }

    @-webkit-keyframes spinner {
        to {
            -webkit-transform: rotate(360deg);
        }
    }

    .spinner {
        min-width: 15px;
        min-height: 15px;
    }

    .spinner:before {
        content: 'Loading\2026';
        position: absolute;
        top: 6%;
        left: 50%;
        width: 15px;
        height: 15px;
        margin-left: -17px;
    }

    .spinner:not(:required):before {
        content: '';
        border-radius: 50%;
        border: 1px solid #fff;
        border-top-color: #ff2a4f;
        animation: spinner .6s linear infinite;
        -webkit-animation: spinner .6s linear infinite;
    }

    .spinner {
        position: relative;
        width: 15px;
        height: 15px;
    }
</style>
