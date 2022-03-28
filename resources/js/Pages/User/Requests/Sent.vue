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
                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Mes demandes soumises</strong></h3>

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
                        <th class="text">Statut</th>
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
                        <!-- <td style="text-align:justify; justify-content:wrap; word-wrap:wrap">{{ request.description }}</td> -->
                        <td>{{ request.created_at }}</td>
                        <td>
                          <div class="sh">
                            <span class="small" v-if="request.sent_or == 1 && request.sH_approval === null && request.rA_approval === null && request.dPal_approval === null">
                                <span class="badge badge-warning" style="border-radius:25px">En attente</span>
                            (SH)
                            </span>
                            <span class="small" v-if="request.sent_or == 1 && request.sH_approval === null && request.rA_approval === null && request.dPal_approval === null && request.on_treat == 1">
                                <span class="badge badge-secondary" style="border-radius:25px">Traitement</span>
                            (SH)
                            </span>
                            <span class="small" v-if="request.sent_or == 1 && request.sH_approval == 0 && request.rA_approval === null && request.dPal_approval === null" >
                                <span class="badge badge-danger" style="border-radius:25px">Rejetée</span>
                            (SH)
                            </span>
                            <span class="small" v-if="request.sent_or == 1 && request.sH_approval == 1 && request.rA_approval === null && request.dPal_approval === null" >
                                <span class="badge badge-info" style="border-radius:25px">Approuvée</span>
                            (SH)
                            </span>
                          </div>

                          <div class="ra">
                            <span class="small" v-if="request.sent_or == 1 && request.sH_approval !== null && request.rA_approval === null && request.dPal_approval === null" >
                                <span class="badge badge-warning" style="border-radius:25px">
                                    En attente
                                </span>
                                (RA)
                            </span>
                             <span class="small" v-if="request.sent_or == 1 && request.sH_approval !== null && request.rA_approval === null && request.dPal_approval === null && request.on_treat == 1" >
                                <span class="badge badge-warning" style="border-radius:25px">
                                    En attente
                                </span>
                                (RA)
                            </span>
                            <span class="small" v-if="request.sent_or == 1 && request.rA_approval == 0 && request.sH_approval !== null && request.dPal_approval === null">
                                <span class="badge badge-danger" style="border-radius:25px">
                                    Rejetée
                                </span>
                                (RA)
                            </span>
                            <span class="small" v-if="request.sent_or == 1 && request.rA_approval == 1 && request.sH_approval !== null && request.dPal_approval === null">
                                <span class="badge badge-info" style="border-radius:25px">
                                    Approuvée
                                </span>
                                (RA)
                            </span>
                          </div>

                          <div class="dpal">
                            <span class="small" v-if="request.sent_or == 1 && request.rA_approval !== null && request.dPal_approval === null">
                                <span class="badge badge-warning" style="border-radius:25px">
                                    En attente
                                </span>
                                (DPAL)
                            </span>
                            <span class="small" v-if="request.sent_or == 1 && request.sH_approval !== null && request.rA_approval !== null && request.dPal_approval === null && request.on_treat == 1">
                                <span class="badge badge-secondary" style="border-radius:25px">
                                    Traitement
                                </span>
                                (DPAL)
                            </span>
                            <span class="small" v-if="request.sent_or == 1 && request.dPal_approval == 0 && request.sH_approval !== null && request.rA_approval !== null">
                                <span class="badge badge-danger" style="border-radius:25px">
                                    Rejetée
                                </span>
                                (DPAL)
                            </span>
                            <span class="small" v-if="request.sent_or == 1 && request.dPal_approval == 1 && request.sH_approval !== null && request.rA_approval !== null" >
                                <span class="badge badge-info" style="border-radius:25px">
                                    Approuvée
                                </span>
                                (DPAL)
                            </span>
                          </div>
                          
                          <div class="cdl">
                            <span class="small" v-if="request.sent_or == 1 && request.sH_approval !== null && request.rA_approval !== null && request.dPal_approval !== null && request.cDL_approval === null">
                                <span class="badge badge-warning" style="border-radius:25px">
                                    En attente
                                </span>
                                (CDL)
                            </span>
                            <span class="small" v-if="request.sent_or == 1 && request.sH_approval !== null && request.rA_approval !== null && request.dPal_approval !== null && request.cDL_approval === null && request.on_treat == 1">
                                <span class="badge badge-secondary" style="border-radius:25px">
                                    Traitement
                                </span>
                                (CDL)
                            </span>
                            <span class="small" v-if="request.sent_or == 1 && request.cDL_approval == 0 && request.sH_approval !== null && request.rA_approval !== null && request.dPal_approval !== null">
                                <span class="badge badge-danger" style="border-radius:25px">
                                    Rejetée
                                </span>
                                (CDL)
                            </span>
                            <span class="small" v-if="request.sent_or == 1 && request.cDL_approval == 1 && request.sH_approval !== null && request.rA_approval !== null && request.dPalapproval !== null" >
                                <span class="badge badge-info" style="border-radius:25px">
                                    Approuvée
                                </span>
                                (CDL)
                            </span>
                          </div>

                          <!-- <div class="wh">
                            <span class="small" v-if="request.sent_or == 1 && request.sH_approval !== null && request.rA_approval !== null && request.dPal_approval !== null && request.cDL_approval !== null && request.wh_chief_approval === null">
                                <span class="badge badge-warning" style="border-radius:25px">
                                    En attente
                                </span>
                                (CE)
                            </span>
                            <span class="small" v-if="request.sent_or == 1 && request.wh_chief_approval == 1 && request.sH_approval !== null && request.rA_approval !== null && request.dPal_approval !== null && request.cDL_approval !== null" >
                                <span class="badge badge-info" style="border-radius:25px">
                                    Tranférée
                                </span>
                                (CE)
                            </span>
                          </div>

                          <div class="cm">
                            <span class="small" v-if="request.sent_or == 1 && request.dPal_approval !== null && request.cDL_approval !== null && request.wh_chief_approval !== null && request.cm_approval === null">
                                <span class="badge badge-warning" style="border-radius:25px">
                                    En attente
                                </span>
                                (CM)
                            </span>
                            <span class="small" v-if="request.sent_or == 1 && request.wh_chief_approval == 1 && request.sH_approval !== null && request.rA_approval !== null && request.dPal_approval !== null && request.cDL_approval !== null && request.wh_chief_approval !== null && request.cm_approval !== null" >
                                <span class="badge badge-info" style="border-radius:25px">
                                    Approuvée
                                </span>
                                (CM)
                            </span>
                          </div> -->
                            <span class="small" v-if="request.sent_or == 1 && request.dPal_approval !== null && request.sH_approval !== null && request.rA_approval !== null && request.dPal_approval !== null && request.cDL_approval !== null && request.final_process_date !== null && request.on_treat === null" >
                                <span class="badge badge-info bg-gray" style="border-radius:25px">
                                    Terminée
                                </span>
                            </span>
                        </td>
                        <td class="text-center" v-if="$page.props.auth.hasRole.user">
                            <button class="btn btn-xs btn-secondary" style="letter-spacing: 0.1em;" @click="showRequest(request)">
                                <i class="fa fa-eye"></i>
                            </button>
                            &nbsp; &nbsp;
                            <button class="btn btn-xs bg-orange" @click="undoRequest(request)">
                                <i class="fa fa-undo"></i>
                            </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- <div class="card-footer clearfix">
                  panigation links
                </div> -->
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
        props: ['requests', 'requests_count'],
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
            showRequest(request){
                this.$inertia.get(route('user.requests.show', [request]));
            },
            undoRequest(request) {
                Swal.fire({
                    title: 'Etes-vous sûr de vouloir annuler cette demande ?',
                    text: "Si oui veuillez confirmer svp",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Retour',
                    confirmButtonText: 'Oui, annuler!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$inertia.post(this.route('user.requests.undo', request), {
                            preserveScroll: true,
                            onSuccess: ()=> {
                                Swal.fire(
                                    'Annulée !',
                                    'La demande a été bien annulée',
                                    'success'
                                )
                            }
                        })
                    }
                })
            },
        }
    }
            // 'categories' => CategoryResource::collection(Category::latest()->simplePaginate(10)),

</script>

<style>

</style>
