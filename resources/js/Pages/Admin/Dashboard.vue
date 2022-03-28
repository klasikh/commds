<template>

    <admin-layout>

        <template #header>
            <h1 class="m-0">Tableau de bord</h1>
        </template>

        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row" style="justify-content:center">
                <div class="col-12 col-sm-6 col-md-3" v-if="$page.props.auth.hasRole.superAdmin" >
                    <a :href="route('admin.admins.index')">
                        <div class="info-box text-black">
                            <span class="info-box-icon"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Administrateurs</span>
                                <span class="info-box-number">
                                    {{ admins }}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <a :href="route('admin.users.index')">
                        <div class="info-box text-black">
                        <span class="info-box-icon"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Utilisateurs</span>
                            <span class="info-box-number">
                                {{ users }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <a :href="route('admin.departments.index')">
                        <div class="info-box text-black">
                        <span class="info-box-icon"><i class="fas fa-cube"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Départements</span>
                            <span class="info-box-number">
                                {{ departments }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a :href="route('admin.services.index')">
                        <div class="info-box text-black">
                        <span class="info-box-icon"><i class="fas fa-cogs"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Services</span>
                            <span class="info-box-number">
                                {{ services }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
                
                <div class="col-12 col-sm-6 col-md-3">
                    <a :href="route('admin.grades.index')">
                        <div class="info-box text-black">
                        <span class="info-box-icon"><i class="fa-solid fa-school"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Fonctions</span>
                            <span class="info-box-number">
                                {{ grades }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a :href="route('admin.roles.index')">
                        <div class="info-box text-black">
                        <span class="info-box-icon"><i class="fa-solid fa-critical-role"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Rôles</span>
                            <span class="info-box-number">
                                {{ roles }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
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
    props: ['users', 'admins', 'departments', 'services', 'grades', 'roles'],

    components: {
        AdminLayout,
    },

    mounted() {
        this.salesChart()
        this.pieChart()
    },

    methods: {
          salesChart() {
                let ctx = document.getElementById('salesChart').getContext('2d')
                let salesChartData = {
                    datasets: [{
                        label               : 'Digital Goods',
                        backgroundColor     : 'rgba(60,141,188,0.9)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : [28, 48, 40, 19, 86, 27, 90]
                    }, {
                        label               : 'Electronics',
                        backgroundColor     : 'rgba(210, 214, 222, 1)',
                        borderColor         : 'rgba(210, 214, 222, 1)',
                        pointRadius         : false,
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : [65, 59, 80, 81, 56, 55, 40]
                    }],
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                }
                let salesChartOptions = {
                    maintainAspectRatio : false,
                    responsive : true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                        gridLines : {
                            display : false,
                        }
                        }],
                        yAxes: [{
                        gridLines : {
                            display : false,
                        }
                        }]
                    }
                }
                new Chart(ctx, {
                    type: 'line',
                    data: salesChartData,
                    options: salesChartOptions
                })
            },
            pieChart() {
                let ctx = document.getElementById('pieChart').getContext('2d')
                let pieChartData = {
                    datasets: [{
                        data: [700, 500, 400, 600, 300, 100],
                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
                    }],
                    labels: [ 'Chrome', 'IE', 'FireFox', 'Safari', 'Opera', 'Navigator'],
                }
                let pieChartOptions = {
                    legend: {
                        display: false
                    }
                }
                new Chart(ctx, {
                    type: 'doughnut',
                    data: pieChartData,
                    options: pieChartOptions
                })
            }
        }

    }
</script>

<style>

</style>
