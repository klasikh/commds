<template>
    <div>
        <admin-layout>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                          <div class="card px-2 py-2">
                            <div class="row bg-color-blue mx-3 mb-4 py-1">
                                <div class="card-header">
                                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Liste des mémos</strong></h3>

                                    <div>
                                        <div class="col-12 col-sm-6 col-md-3" style="text-align:center;justify-content:center;justify-items:center;content:''; float:left">
                                            <div class="info-box">
                                            <!-- <span class="info-box-icon"><i class="fas fa-users"></i></span> -->

                                            <div class="info-box-content">
                                                <h5>
                                                    {{ memos_count }}
                                                    {{ memoText }}
                                                </h5>
                                            </div>
                                            <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table  id="myTable" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-capitalize">Titre</th>
                                                <th class="text">De la part de </th>
                                                <th class="text">Vérifiée par</th>
                                                <th class="text">Créé le</th>
                                                <!-- <th class="text-capitalize text-center" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">Actions</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="memo in memos" :key="memo.id">
                                                <td>{{ memo.title }}</td>
                                                <td>{{ memo.author }}</td>
                                                <td>{{ memo.receiver }}</td>
                                                <td>{{ memo.created_at }}</td>
                                                <!-- <td class="text-center" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin"> -->
                                                    <!-- <button class="btn btn-xs btn-primary" style="letter-spacing: 0.1em;" @click="showRequest(memo)"> -->
                                                        <!-- <i class="fa fa-pencil"></i> -->
                                                    <!-- </button> -->
                                                    <!-- &nbsp; &nbsp; -->
                                                    <!-- <button class="btn btn-xs btn-danger" @click="deletememo(memo)">
                                                        <i class="fa fa-trash"></i>
                                                    </button> -->
                                                <!-- </td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </admin-layout>
    </div>
</template>

<script>

    import AdminLayout from '@/Layouts/AdminLayout'

    export default {
        props: ['memos', 'memos_count', 'users', 'the_dep'],
        components: {
            AdminLayout,
        },
        data() {
            return {

            }
        },
        computed: {
            memoText() {
                return this.memos_count <= 1 ? 'Mémo' : 'Mémos';
            },
        },
        methods: {
            showRequest(memo){
                this.$inertia.get(route('user.requests.show', [memo.request_id]));
            },
        }
    }

</script>
