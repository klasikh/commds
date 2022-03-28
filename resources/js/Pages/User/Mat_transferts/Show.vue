<template>

  <div>
    <admin-layout>
      <section class="content">
        <div class="container-fluid" style="font-size:12px">
            <div>
                <button @click="makePDF"  class="btn btn-secondary text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none">Extrait PDF</button>
            </div>
            <br>
          <div class="row" id="">
            <div class="col-12" style="font-size:16px;" id="theDeliv">
                <div class="card px-2 py-4" >
                    <div style="padding:20px">
                            <div class="col-12 h4 text-center">BORDEREAU DE MOUVEMENT DE MATERIEL</div>
                            <br>
                            <div class="d-flex">
                                <div class="col-2">
                                    <img src="/images/sbee_icon.jpg" alt="">
                                </div>
                                <div class="col-3" style="border: 2px #000 solid; border-radius:20px; ; width:100%; padding:10px">
                                    <div class="h6">NUMERO :  {{ delivery.delivery_number }}</div><br>
                                    <div class="h6">DATE : {{ delivery.creation_date }} </div><br>
                                    <div class="h6">SENS : 
                                        <span v-if="delivery.sens == 1">ENTREE</span>
                                        <span v-if="delivery.sens == 2">SORTIE</span>
                                        <span v-if="delivery.sens == 3">REINTEGRATION</span>
                                    </div>
                                </div>
                                &nbsp;&nbsp;
                                <div class="col-7 d-flex" style="display:block; border: 2px #000 solid; border-radius:20px; ; width:100%;">
                                    <div class="col-5 h6 p-2">
                                        MAGASIN CEDANT : <br><br>
                                        MAGASIN BENEFICIAIRE : <br><br>
                                        DESTINATION : <br><br>
                                        AUTRES REFERENCES : 
                                    </div>
                                    <div class="col-7 h6">
                                        {{ delivery.leaving_mag }} <br><br>
                                        {{ delivery.benef_mag }} <br><br>
                                        {{ delivery.destination }} <br><br>
                                        {{ delivery.other_refs }} <br><br>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <table class="col row-spacing text-center table table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th class="h6">CODE ARTICLE</th>
                                        <th class="h6 text">DESIGNATION</th>
                                        <th class="h6">UNITE</th>
                                        <th class="h6">QUANTITE DEMANDEE</th>
                                        <th class="h6">QUANTITE LIVREE</th>
                                        <th class="h6">OBSERVATIONS</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr v-for="(mat, index) in materials" :key="index">
                                        <td>{{ mat.article_code }}</td>
                                        <td>{{ mat.designation }}</td>
                                        <td>{{ mat.stock_count }}</td>
                                        <td>{{ mat.asked_quantity }}</td>
                                        <td>{{ mat.delivery_quantity }}</td>
                                        <td>{{ mat.observations }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>  
                        <br>
                        <div class="d-flex">
                            <div class="" style="border: 2px #000 solid; border-radius:20px; padding:10px; width:20%">
                                <div class="h6 text-center">LE DEMANDEUR</div>
                                <div class="d-flex" style="font-size:14px">
                                    <p>
                                        SIGNATURE : <br>
                                        NOM ET PRENOMS : 
                                    </p>
                                    <p>
                                        {{ delivery.asker_sign }} <br>
                                        {{ delivery.asker_name }}
                                    </p>
                                </div>
                            </div> 
                            &nbsp;&nbsp;
                            <div class="" style="border: 2px #000 solid; border-radius:20px; padding:10px; width:20%">
                                <div class="h6 text-center">LE REFERANT APPRO</div>
                                <div class="d-flex" style="font-size:14px">
                                    <p>
                                        SIGNATURE : <br>
                                        NOM ET PRENOMS : 
                                    </p>
                                    <p>
                                        {{ delivery.rA_sign }} <br>
                                        {{ delivery.rA_name }}
                                    </p>
                                </div>
                            </div>
                            &nbsp;&nbsp;
                            <div class="" style="border: 2px #000 solid; border-radius:20px; padding:10px; width:20%">
                                <div class="h6 text-center">LE CHEF ENTREPOT</div>
                                <div class="d-flex" style="font-size:14px">
                                    <p>
                                        SIGNATURE : <br>
                                        NOM ET PRENOMS : 
                                    </p>
                                    <p>
                                        {{ delivery.mag_chief_sign }} <br>
                                        {{ delivery.mag_chief_name }}
                                    </p>
                                </div>
                            </div>
                            &nbsp;&nbsp;
                            <div class="" style="border: 2px #000 solid; border-radius:20px; padding:10px; width:20%">
                                <div class="h6 text-center">LE MAGASINIER</div>
                                <div class="d-flex" style="font-size:14px">
                                    <p>
                                        SIGNATURE : <br>
                                        NOM ET PRENOMS : 
                                    </p>
                                    <p>
                                        {{ delivery.mag_sign }} <br>
                                        {{ delivery.mag_name }}
                                    </p>
                                </div>
                            </div>  
                            &nbsp;&nbsp;
                            <div class="" style="border: 2px #000 solid; border-radius:20px; padding:10px; width:20%">
                                <div class="h6 text-center">L'ENLEVEUR</div>
                                <div class="d-flex" style="font-size:14px">
                                    <p>
                                        SIGNATURE : <br>
                                        NOM ET PRENOMS : 
                                    </p>
                                    <p>
                                        {{ delivery.taker_sign }} <br>
                                        {{ delivery.taker_name }}
                                    </p>
                                </div>
                            </div>   
                        </div>   
                        
                        <br>
                        <div class="d-flex">
                            <div class="col-4 h6">SBEE-DPAL-DP</div>
                            <div class="col-4 h6"></div>
                            <div class="col-4 h6 text-right">REF : PRC DPAL 105</div>
                        </div>  
                    </div>     
                </div>     
            </div>     

            <br>
              <div class="d-flex">
                <div style="float:left" class="col-4">
                    <button type="button" class="btn text-white" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" onclick="window.history.back()">Retour</button>
                </div>
                <!-- <div class="col-4">     
                </div>      -->
                <div class="text-center col-4" v-if="(user.grade_id == 4 && request.rA_approval === null &&  request.deliv_or === null) || (request.user_id == user.id && request.sent_or == 0 && request.token === null) || (user.grade_id == 7 && request.wh_chief_approval === null &&  request.deliv_or == 0) || (user.grade_id == 8 && request.cm_approval === null &&  request.deliv_or == 0)">
                    <!-- <form @submit.prevent="edit(delivery)"> -->
                        <a as="button" :href="route('user.mat_transferts.edit', delivery)" class="btn btn-primary text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                                Modifier
                        </a>
                    <!-- </form> -->
                </div>
                <div class="text-center col-4" v-if="request.user_id == user.id && request.sent_or == 0 && request.token === null">
                    <form @submit.prevent="deleteDeliv(delivery)">
                        <button as="button" type="submit" class="btn btn-danger text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                                Supprimer
                        </button>
                    </form>
                </div>
            </div>     
            <br><br>
        </div>     
      </section>

    </admin-layout>
  </div>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout';
    import html2canvas from 'html2canvas';
    import { jsPDF } from "jspdf";

    export default {
        props: ['user', 'request', 'delivery', 'materials'],
        components: {
            AdminLayout,
        },
        data() {
            return {
                form: this.$inertia.form({
                    id: this.delivery.id,
                    user_id: this.request.user_id,
                    title: this.request.title,
                }),
                request: this.request,
                delivery: this.delivery,
                materials: this.materials
            }
        },
        computed: {
            filters: {
                date: function(str) {
                    if (!str) { return '(n/a)'; }
                    str = new Date(str);
                    return str.getFullYear() + '-' + ((str.getMonth() < 9) ? '0' : '') + (str.getMonth() + 1) + '-' +
                    ((str.getDate() < 10) ? '0' : '') + str.getDate();
                }
            },
            
        },
        methods: {
            makePDF(){
                window.html2canvas = html2canvas;
                var doc = new jsPDF({
                    orientation: 'l', 
                    unit: 'px', 
                    format: [1099, 990]
                });
                doc.html(document.querySelector("#theDeliv"), {
                    callback: function(pdf) {
                        pdf.save("bordereau.pdf");
                    }
                });
            },
            getDate(){
                var dtToday = new Date();

                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate() + 1;
                var year = dtToday.getFullYear();

                var maxday = dtToday.getDate() + 30;

                if(month < 10)
                    month = '0' + month.toString();
                if(day < 10)
                    day = '0' + day.toString();


                var minDate = (year) + '-' + month + '-' + day;
                var maxDate = "2022-12-31";
                document.getElementById('pw_date').setAttribute('min', minDate);
                document.getElementById('pw_date').setAttribute('max', maxDate);
            },
            edit(delivery){
                this.form.get(route('user.mat_transferts.edit', delivery));
            },  
            deleteDeliv(delivery){
                // this.form.get(route('user.mat_transferts.destroy', delivery));
                Swal.fire({
                    title: 'Etes-vous sûr de vouloir supprimer ce bordereau ?',
                    text: "Si oui veuillez confirmer svp",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Retour',
                    confirmButtonText: 'Oui, supprimer !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post(route('user.mat_transferts.destroy', delivery), {
                            preserveScroll: true,
                            onSuccess: ()=> {
                                Swal.fire(
                                    'Supprimé !',
                                    'Le bordereau a été supprimé avec succès.',
                                    'success'
                                )
                            }
                        })
                    }
                })
            },  

        }

    }

</script>
