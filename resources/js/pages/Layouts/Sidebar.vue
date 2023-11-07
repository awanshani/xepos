<template>
    <div id="kt_aside" class="aside pb-5 pt-5 pt-lg-0">
        <!--begin::Brand-->
        <div class="aside-logo py-8" id="kt_aside_logo">
            <!--begin::Logo-->
            <a href="../../demo6/dist/index.html" class="d-flex align-items-center">
                <img alt="Logo" :src="this.assetUrl+'assets/media/logos/logo-demo-6.svg'" class="h-45px logo" />
            </a>
            <!--end::Logo-->
        </div>
        <!--end::Brand-->
        <!--begin::Aside menu-->
        <div class="aside-menu flex-column-fluid" id="kt_aside_menu">
            <!--begin::Aside Menu-->
            <div class="hover-scroll-overlay-y my-2 my-lg-5 pe-lg-n1" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="5px">
                <!--begin::Menu-->
                <div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
                    <div class="menu-item py-2">
                        <a :class="this.$page.props.current_route=='companies.index'?'active':''" class="menu-link menu-center" :href="route('companies.index')">
										<span class="menu-icon me-0">
											<i class="bi bi-building fs-2"></i>
										</span>
                            <span class="menu-title">Companies</span>
                        </a>
                    </div>
                </div>
                <div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
                    <div class="menu-item py-2">
                        <a :class="this.$page.props.current_route=='employees.index'?'active':''" class="menu-link menu-center" :href="route('employees.index')">
										<span class="menu-icon me-0">
											<i class="bi bi-person fs-2"></i>
										</span>
                            <span class="menu-title">Employees</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import {AssetMixin} from "../../mixins/AssetMixin";

export default defineComponent({
    name: "Sidebar",
    mixins:[AssetMixin],
    mounted() {

    },
})
</script>

<style scoped>

</style>
