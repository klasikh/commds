<template>

    <admin-layout>

        <template #header>
            <h1 class="m-0">Tableau de bord</h1>
        </template>

        <section class="content text-center">
            <div class="container-fluid">
            
                <!-- Info boxes -->
                <div class="row" style="justify-content:center" v-if="$page.props.auth.info.grade_id !== 5 && $page.props.auth.info.grade_id !== 4 && $page.props.auth.info.grade_id !== 3 && $page.props.auth.info.grade_id !== 2 && $page.props.auth.info.grade_id !== 1 && $page.props.auth.info.grade_id !== 7 && $page.props.auth.info.grade_id !== 8 && $page.props.auth.info.grade_id !== 9  && $page.props.auth.info.grade_id !== 10">
                <div class="col-12 col-sm-6 col-md-3">
                    <a :href="route('user.requests.notsent')">
                        <div class="info-box text-black">
                            <!-- <span class="info-box-icon"><i class="fa fa-file"></i></span> -->

                            <div class="info-box-content">
                                <span class="info-box-text">Demandes non soumises</span>
                                <span class="info-box-number">
                                    {{ notSent }}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <a :href="route('user.requests.sent')">
                        <div class="info-box text-black">
                        <!-- <span class="info-box-icon"><i class="fa fa-file"></i></span> -->

                        <div class="info-box-content">
                            <span class="info-box-text">Demandes soumises</span>
                            <span class="info-box-number">
                                {{ sent }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <a :href="route('user.requests.finalized')">
                        <div class="info-box text-black">
                        <!-- <span class="info-box-icon"><i class="fa fa-file"></i></span> -->

                        <div class="info-box-content">
                            <span class="info-box-text">Demandes finalisées</span>
                            <span class="info-box-number">
                                {{ finalized }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
                </div>
                
                <div class="row text-center" style="justify-content:center" v-if="$page.props.auth.info.grade_id === 5 || $page.props.auth.info.grade_id === 4 || $page.props.auth.info.grade_id === 3 || $page.props.auth.info.grade_id === 2 || $page.props.auth.info.grade_id === 7 || $page.props.auth.info.grade_id === 8 || $page.props.auth.info.grade_id === 9  || $page.props.auth.info.grade_id === 10">
                <div class="col-12 col-sm-6 col-md-3">
                    <a :href="route('user.requests.received')">
                        <div class="info-box text-black">
                            <!-- <span class="info-box-icon"><i class="fa fa-file"></i></span> -->

                            <div class="info-box-content">
                                <span class="info-box-text">Demandes reçues</span>
                                <span class="info-box-number">
                                    {{ received }}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <a :href="route('user.requests.traited')">
                        <div class="info-box text-black">
                        <!-- <span class="info-box-icon"><i class="fa fa-file"></i></span> -->

                        <div class="info-box-content">
                            <span class="info-box-text">Demandes traitées</span>
                            <span class="info-box-number">
                                {{ traited }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                 <div class="col-12 col-sm-6 col-md-3" v-if="$page.props.auth.info.grade_id === 5 || $page.props.auth.info.grade_id === 4 || $page.props.auth.info.grade_id === 3 || $page.props.auth.info.grade_id === 2" >
                    <a :href="route('user.requests.onProcess')">
                        <div class="info-box text-black">
                        <!-- <span class="info-box-icon"><i class="fa fa-file"></i></span> -->

                        <div class="info-box-content">
                            <span class="info-box-text">Traitement en cours</span>
                            <span class="info-box-number">
                                {{ onProcess }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
            </div>
                <!-- /.row -->

            </div><!--/. container-fluid -->

              <!-- <div class="col-12 col-sm-6 col-md-3">
                    <a :href="route('sign')">
                        <div class="info-box text-black">
                        <span class="info-box-icon"><i class="fa fa-file"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Sign</span>
                            <span class="info-box-number">
                                {{ onProcess }}
                            </span>
                        </div>
                        
                        </div>
                        
                    </a>
                </div> -->
        </section>
    </admin-layout>

</template>

<script>

import AdminLayout from "@/Layouts/AdminLayout"

export default {
    props: ['notSent', 'sent', 'finalized', 'received', 'traited', 'onProcess'],
    
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
