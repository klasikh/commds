<template>

  <div>
    <admin-layout>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card px-2 py-2">
                <div class="row bg-color-blue mx-3 mb-4 py-1" style="justify-content:center; justify-items:center; content:'' ">
                  <div class="card-header">
                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Mes demandes non soumises</strong></h3>

                    <div>
                        <div class="col-12 col-sm-6 col-md-3" style="text-align:center;justify-content:center;justify-items:center;content:'';">
                            <div class="info-box">
                            <!-- <span class="info-box-icon"><i class="fas fa-users"></i></span> -->

                            <div class="info-box-content">
                                <h5>
                                    {{ requests_count }}
                                    {{ requestText }}
                                </h5>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                    </div>
                  </div>
                </div>
                <div class="card-body table-responsive p-0">
                  <table id="myTable" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                    <thead>
                      <tr>
                        <th class="text-capitalize">No</th>
                        <th class="text-capitalize">Reference</th>
                        <th class="text">Type de demande</th>
                        <th class="text-capitalize">Titre</th>
                        <!-- <th class="text-capitalize">Description</th> -->
                        <th class="text">Ajouté le</th>
                        <th class="text-capitalize text-center" v-if="$page.props.auth.hasRole.user">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(request, index) in requests" :key="index">
                        <td>{{ request.request_number }}</td>
                        <td>{{ request.reference }}</td>
                        <td>
                          <span v-if="request.request_type_id === 1">Demande de travaux</span>
                          <span v-if="request.request_type_id === 2">Demande d'achat de production</span>
                          <span v-if="request.request_type_id === 3">Demande d'achat hors production</span>
                        </td>
                        <td>{{ request.title.substring(0, 12) + '...' }}</td>
                        <!-- <td style="text-wrap:wrap">{{ request.description }}</td> -->
                        <td>{{ request.created_at }}</td>
                        <td class="text-center" v-if="$page.props.auth.hasRole.user">
                            <button class="btn btn-xs btn-secondary" style="letter-spacing: 0.1em;" @click="showRequest(request)">
                                <i class="fa fa-eye"></i>
                            </button>
                            &nbsp; &nbsp;
                            <button class="btn btn-xs btn-primary" style="letter-spacing: 0.1em;" @click="editRequest(request)">
                                <i class="fa fa-pencil"></i>
                            </button>
                            &nbsp; &nbsp;
                            <button class="btn btn-xs btn-danger" @click="deleteRequest(request)">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
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
        props: ['user','requests', 'requests_count', 'request_type'],
        components: {
            AdminLayout,
        },
        data() {
            return {
              request: this.request
            }
        },
        computed: {
          requestText() {
              return this.requests_count <= 1 ? 'Demande' : 'Demandes';
          },
        },
        methods: {
            editRequest(request){
                this.$inertia.get(route('user.requests.edit', [request]));
            },
            showRequest(request){
                this.$inertia.get(route('user.requests.show', [request]));
            },
            deleteRequest(request){
                this.$inertia.get(this.route('user.requests.delete', request));
            },
        }
    }
</script>

<style>

</style>
