<template>
    <div class="col-12" style="font-size:20px;">
        <div class="card px-2 py-4" v-if="request.user_id === user.id">
            <div style="padding:50px">
                <div class="d-flex">
                    <div class="h4 col-4">
                        SOCIETE BENINOISE <br>D'ENERGIE ELECTRIQUE <br><br>
                        DIRECTION GENERALE <br><br>
                        DIRECTION PATRIMOINE ACHATS ET LOGISTIQUE
                    </div>
                    <div class="col-4">
                        <img src="/images/sbee_logo.jpeg" alt="">
                    </div>
                    <div class="h4 col-4 mt-4">
                        DA/DT_No: {{ request.request_number }}
                    </div>

                </div>
                
                <br>
                <div class="d-flex">
                    <div class="col-3 bg-black"></div>
                    <div class="h4 col-6 text-center">
                        DEMANDE DE TRAVAUX 
                        <input type="checkbox" name="" id="" v-if="request.request_type_id  === 1 ? 'checked' : ''">
                        / ACHAT
                        <input type="checkbox" name="" id="" v-if="request.request_type_id  === 2 || request.request_type_id  === 3 ? 'checked' : ''">
                        <!-- <input type="checkbox" checked> -->
                    </div>
                    <div class="col-3 bg-black"></div>
                </div>
                
                <br>
                <div class="h5" v-for="(req_category, index) in req_categories" :key="index">
                    <input type="checkbox" name="" id="" > {{ req_category.name }}
                </div>
                <br>
                <div class="d-flex">
                    <div class="h4">Réquérant Service : </div> &nbsp;&nbsp;
                    <div class="">{{ user.name + ' ' + user.surname }}</div>
                </div>
                
                <br>
                <div class="d-flex">
                    <div class="h4">Désignation : </div> &nbsp;&nbsp;
                    <div class="">{{ request.title }}</div>
                </div>

                <br>
                <div class="d-flex">
                    <div class="h4">Référence/NR : </div> &nbsp;&nbsp;
                    <div class="">{{ request.reference }}</div>
                </div>

                <br>
                <div class="">
                    <h4>Description du défaut constaté ou produit(s) à acheter : </h4>
                    {{ request.asked_works }}
                </div>

                <br>
                <div class="d-flex">
                    <div class="col-4 h4">
                        Etabli par : {{ request.sH_id }} <br>
                        (Chef de Service) {{ request.sH_approval }} <br>
                        Date : {{ request.sH_approvalDate }}
                    </div>
                    <div class="col-4 h4">
                        Visa Chef Département <br>
                        {{ request.department_sign }}<br>
                        {{ request.department_signDate }}
                    </div>
                    <div class="col-4 h4">
                        Approbation du réquérant (Directeur) <br>
                        {{ chief_sign }} <br>
                        {{ request.chief_signDate }}
                    </div>
                </div>
                
                <br>
                <div class="d-flex">
                    <div class="col-3 bg-black"></div>
                    <div class="h4 col-6 text-center">
                        TRAVAUX DEMANDES
                    </div>
                    <div class="col-3 bg-black"></div>
                </div>
                <br>
                <div>
                    {{ request.description }}
                </div>

                <br>
                <div class="d-flex">
                    <div class="col-4 h4">
                        Visa Chef Service <br>
                        {{ request.sH_approval }} <br>
                        Date : {{ request.sH_approvalDate }}
                    </div>
                    <div class="col-4 h4">
                        Visa Chef Département <br>
                        {{ request.department_sign }}<br>
                        {{ request.department_signDate }}
                    </div>
                    <div class="col-4 h4">
                        Approuvé par (DPAL) Directeur <br>
                        {{ dPal_approval }} <br>
                        {{ request.dPal_approvalDate }}
                    </div>
                </div>

                <br>
                <div class="d-flex">
                    <div class="col-3 bg-black"></div>
                    <div class="h4 col-6 text-center">
                        TRANSMIS POUR
                    </div>
                    <div class="col-3 bg-black">
                    </div>
                </div>

                <br>
                <div class="h5" v-for="(trans_mention, index) in trans_mentions" :key="index">
                    <input type="checkbox" name="" id="" > {{ trans_mention.name }}
                </div>
                <br>

                <div class="d-flex">
                    <div class="col-4 h6">SEBEE-DPAL-DP</div>
                    <div class="col-4 h6">{{ Date.getDate() }}</div>
                    <div class="col-4 h6 text-right">REF : PRC DPAL 105</div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import AdminLayout from '@/Layouts/AdminLayout'

    export default {
        props: ['user', 'request', 'req_categories', 'trans_mentions'],
        components: {
            AdminLayout,
        },
        data() {
            return {
            }
        },
        computed: {
        },
        methods: {
            edit(request){
                this.$inertia.get(route('user.requests.edit', [request]));
            },
            send(request) {
                Swal.fire({
                    title: 'Voulez vous vraiment soumettre cette demande ?',
                    text: "Si voui veuillez confirmer svp",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Annuler',
                    confirmButtonText: 'Oui, soumettre!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.delete(this.route('user.requests.send', request), {
                            preserveScroll: true,
                            onSuccess: ()=> {
                                Swal.fire(
                                    'Supprimé !',
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
