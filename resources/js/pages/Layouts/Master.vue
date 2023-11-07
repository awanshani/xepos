<script>
import Sidebar from "./Sidebar";
import Header from "./Header";
import ToolBar from "./ToolBar.vue";
import Footer from "./Footer";
import { defineComponent } from "vue";

export default defineComponent({
    name:'Master',
    props:{
        articles:Object
    },
    components: {Footer,Sidebar,Header,ToolBar}
})
</script>

<template>
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
          <Sidebar></Sidebar>
        </div>
    </div>

    <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <!--begin::Header-->
        <Header></Header>
        <!--end::Header-->
        <!--begin::Toolbar-->
        <ToolBar></ToolBar>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Row-->
                    <slot/>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <Footer></Footer>
        <!--end::Footer-->
    </div>
</template>
