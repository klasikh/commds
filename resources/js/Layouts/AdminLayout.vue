<template>


<div class="" id="app">
    <div class="wrapper" style="overflow: auto">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="/images/digicom_logo.png" alt="DigiCom" style="background-color: #ececec">
    </div> -->

    <!-- Navbar -->
    <NavBar />
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <SideBar />

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <slot name="header"></slot>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <slot></slot>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <Footer />
    </div>
</div>

</template>

<script>

import NavBar from "@/Components/NavBar"
import SideBar from "@/Components/SideBar"
import Footer from "@/Components/Footer"

export default {
    el: "#app",
    components: {
        NavBar,
        SideBar,
        Footer,
    },

    mounted() {
        this.init()
    },

    methods: {
        init() {
            let SELECTOR_LOADER = '.preloader'
            setTimeout(() => {
                // let $loader = $(SELECT_LOADER)
                let $loader = $(SELECTOR_LOADER)
                if($loader){
                    $loader.css('height', 0)
                    setTimeout(() => {
                        $loader.children().hide()
                    }, 200)
                }
            }, 2000)
        }
    }

}
</script>

<style>

</style>
