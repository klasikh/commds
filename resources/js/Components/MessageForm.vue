<template>

    <admin-layout>

        <template #header>
            <h1 class="m-0">Messagerie</h1>
        </template>

        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <!-- <a href="" @click="showReq()"> -->
                    <a class="list-group-item d-flex justify-content-between align-items-center">

                        John Doe 
                        <span class="badge badge-pill badge-primary">0</span>
                    </a>

                <!-- /.col -->
                </div>
                <!-- /.row -->

            </div><!--/. container-fluid -->
        </section>
    </admin-layout>

</template>

<script>

import AdminLayout from "@/Layouts/AdminLayout"

export default {
    props: ['requests'],
    
    components: {
        AdminLayout,
    },
    methods: {
        showReq() {

        // }.then(function () {
        this.$router.push('/Requests/Index');
      },
    }
}
</script>

<style>

</style>
