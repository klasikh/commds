<template>

  <div>
    <admin-layout>
      <section class="content" id="app">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card px-2 py-2">
                <div class="">
                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Ajouter un bordereau</strong></h3>
                </div>
                <div class="modal-body overflow-hidden">
                    <div>
                        <span class="text-red">Tous les champs sont obligatoires (*)</span>
                    </div>
                    <div class="card card-primary">
                        <form @submit.prevent="saveDelivData" name="Myform">
                            <!-- <form :action="route('admin.users.store')" method="post"> -->
                            <!-- {{ csrf_field }} -->
                            <div class="card-body">

                            <div class="d-flex col-lg-12">
                                <div class="form-group" style="width:100%">

                                  <div class="d-flex col-lg-12">
                                    <div class="form-group" style="width:100%">
                                        <label for="phone_number" class="h5">Numéro du bordereau<span class="text-red">*</span></label>
                                        <input type="number" class="form-control" id="deliv_number" placeholder="DA/7887/2022" v-model="form.deliv_number" :class="{ 'is-invalid' : form.errors.deliv_number }" autocomplete="off" disabled>
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.deliv_number }">
                                            {{ form.errors.deliv_number }}
                                        </div>
                                    </div>
                                    <div class="form-group ml-4" style="width:100%">
                                        <label for="sex" class="h5">Sens<span class="text-red">*</span></label>
                                        <select class="form-control" id="sex" v-model="form.sens" :class="{ 'is-invalid' : form.errors.sens }">
                                            <!-- <option value=""> -- Sélectionner -- </option> -->
                                            <option value="1">ENTREE</option>
                                            <option value="1">SORTIE</option>
                                            <option value="2">REINTEGRATION</option>
                                        </select>
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.sens }">
                                            {{ form.errors.sens }}
                                        </div>
                                    </div>
                                   
                                </div>

                                <div class="table-responsive">
                                    <span id="error"></span>
                                    <table class="table table-bordered" id="other_piece">
                                      <tr>
                                        <th>Code article</th>
                                        <th>Désignation</th>
                                        <th>Unité</th>
                                        <th>Qté demandée</th>
                                        <th><button type="button" @click="addField()" id="addd" class="btn btn-success bg-green btn-sm"><i class="fa fa-plus"></i></button></th>
                                      </tr>
                                        
                                    </table>
                                </div> 
                                

<!-- <div class="row">
    <div class='col-md-6 col-md-offset-3 col-xs-6 col-offset-3 col-lg-6 col-lg-offset-3'>
        <button type="button" class="btn btn-default btn-primary" @click="ajouterLigne()"><span class="glyphicon glyphicon-plus"></span> Ajouter un joueur </button>
    </div>
</div> -->
                                  </div>

                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" onclick="window.history.back()">Retour</button>

                                <button type="submit" class="btn btn-info btn-style text-white"  style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" :disabled="!form.deliv_number || !form.sens || form.processing">Ajouter</button>
                            </div>
                        </form>
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
import axios from 'axios'

    export default {
        props: ['descri', 'deliv_number', 'today_date'],
        components: {
            AdminLayout,
        },
        data(){
            return {
                form: this.$inertia.form({
                    id: '',
                    deliv_number: this.deliv_number,
                    sens: this.sens,
                    article_code: '',
                    title: '', 
                    unit: '',
                    qte: '',
                }),
                deliv_number: this.deliv_number,
                // max_val = this.max_val,
                // title: document.getElementById("title1").val('') +' '+ document.getElementById("title1").val(''),
                
            }
        },
        computed:{
       
        },
        methods: {
          addField(){
                var i=0
                
                // if ( typeof this.i == 'undefined' ) this.i = 2;
                $(document).on('click', '#addd', function(){
                if(i < 10){
                    var html = '';
                    // if (i = 1) {
                    //     html +='<tr><th>Code article</th><th>Désignation</th><th>Unité</th><th>Qté demandée</th></tr>';
                    // }
                
                    html += '<tr>';
                    html += '<td><input type="text" class="form-control" name="article_code['+i+']" id="article_code'+i+'" placeholder="D672"  v-model="form.sens" :class="{ "is-invalid" : form.errors.article_code } required /></td>';
                    html += '<td><input type="text" class="form-control title" name="title[]" id="title'+i+'" placeholder="Désignation" v-model="form.title" :class="{ "is-invalid" : form.errors.title }" autocomplete="off" minlength="8" maxlength="100" required /></td>';
                    html += '<td><input type="number" class="form-control" min="1" name="unit[]" id="unit'+i+'" placeholder="07" required /></td>';
                    html += '<td><input type="number" class="form-control" min="1" name="qte[]" id="qte'+i+'" placeholder="13" required /></td>';
                    html += '<td><button type="button" onclick="removeField()" class="btn btn-danger btn-sm removee" style="background-color:darkred"><span class="fa fa-minus"></span></button></td></tr>';
                    
                     
                    $('#other_piece').append(html);   
                     i++;
                    console.log(i);
                    const parent = document.getElementById('newRow');
                    parent.value = i;
                }
                // const max_val = this.i
          })
                    
          },
          saveDelivData(){
            
            var elements = document.getElementById("title1");
            var title = $("#title1").val('');
            console.log(elements.value);
            console.log(title.value);

            // for (var i = 0, element; element = elements[i++];) {
            //       // if (element.type === "text" && element.value === "")
            //           console.log(element[i++].val())
            // }
            for (var a=0;a<document.Myform.length;a++){
              var allValues = document.Myform[a].val('');
              
            // axios.post('user.mat_transferts.store', {
              
            // })
            // .then(response => console.log(response))
            // .catch(error => console.log(error));
            }
            
              this.form.post(this.route('user.mat_transferts.store'), {
                    preserveScroll: true,
                    onSuccess:() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Nouvelle demande ajoutée avec succès !'
                        })
                    }
                })
          },
      }
    }
</script>

<style>

</style>