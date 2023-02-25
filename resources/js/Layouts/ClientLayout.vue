<template>
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

        <Navbar />

        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

            <SidebarClient />

            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ title }}</h1>
                            </div>

                        </div>
                    </div>

                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <div id="kt_app_content_container" class="app-container container-xxl">
                            <slot />
                        </div>
                    </div>
                </div>

                <Footer />
            </div>
        </div>
    </div>
</template>

<script setup>
    import { onMounted, ref } from 'vue'
    import Navbar from '@/components/Navbar'
    import SidebarClient from '@/components/SidebarClient'
    import Footer from '@/components/Footer'

    defineProps({
        title: String
    })
</script>
