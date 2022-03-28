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
                            <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Suppression d'une demande</strong></h3>
                        </div>
                        <br><br>
                        <div class="h5">Désignation : {{ request.title }}</div>

                        <br><br><br>
                        <div class="d-flex">
                            <div style="float:left" class="col-5">
                                <button type="button" class="btn text-white" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" onclick="window.history.back()">Annuler</button>
                            </div>
                            <div class="text-right col-5">
                                <form @submit.prevent="confirmDelete(request)">
                                    <button as="button" type="submit" class="btn btn-danger text-right" role="button">
                                        Confirmer la suppression
                                    </button>
                                </form>
                            </div>
                        </div>
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
        props: ['request'],
        components: {
            AdminLayout,
        },
        data() {
            return {
                 form: this.$inertia.form({
                    id: this.request.id,
                    title: this.request.title,
                    request_number: this.request.request_number,
                    request_type_id: this.request.request_type_id,
                    reference: this.request.reference,
                    title: this.request.title,
                    description: this.request.description,
                    asked_works: this.request.asked_works,
                    estimated_amount: this.request.estimated_amount,
                    pw_date: this.request.pw_date,
                }),
                request: this.request
            }
        },
        computed: {},
        methods: {
            confirmDelete(request) {
                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Cette action est irréversible",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Annuler',
                    confirmButtonText: 'Oui, supprimer!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.delete(this.route('user.requests.destroy', request), {
                            preserveScroll: true,
                            onSuccess: ()=> {
                                Swal.fire(
                                    'Supprimée !',
                                    'La demande a été supprimée avec succès.',
                                    'success'
                                )
                            }
                        })
                    }
                })
            }
        }
    }
</script>

<style>

</style>
